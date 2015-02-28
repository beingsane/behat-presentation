exec { "apt-update":
  command => "/usr/bin/apt-get update"
}

# MySql Server
package { "mysql-server":
  ensure  => installed,
  require => Exec["apt-update"],
}

file { "/etc/mysql/conf.d/allow_external.cnf":
  owner    => mysql,
  group    => mysql,
  mode     => 0644,
  content  => template("/vagrant/manifests/allow_external.cnf"),
  require  => Package["mysql-server"],
  notify   => Service["mysql"],
}

service { "mysql":
  ensure     => running,
  enable     => true,
  hasstatus  => true,
  hasrestart => true,
  require    => Package["mysql-server"],
}

exec { "store-schema":
  unless  => "mysql -uroot store",
  command => "mysqladmin -uroot create store",
  path    => "/usr/bin/",
  require => Service["mysql"],
}

exec { "remove-anonymous-user":
  command => "mysql -uroot -e \"DELETE FROM mysql.user \
                                WHERE user=''; \
                                FLUSH PRIVILEGES\"",
  onlyif  => "mysql -u' '",
  path    => "/usr/bin",
  require => Service["mysql"],
}

exec { "mysql-user":
  unless   => "mysql -ustore -p123456 store",
  command  => "mysql -uroot -e \"GRANT ALL PRIVILEGES ON \
                                 store.* TO 'store'@'%' \
                                 IDENTIFIED BY '123456';\"",
  path     => "/usr/bin/",
  require  => Exec["store-schema"],
}

# HTTP Server
package { "apache2":
  ensure  => installed,
  require => Exec["apt-update"],
}

