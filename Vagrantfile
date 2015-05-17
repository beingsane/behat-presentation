# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    config.vm.box = "hashicorp/precise32"

    config.vm.define :server do |server_config|
        server_config.vm.network :private_network, :ip => "192.168.33.12"

        server_config.vm.provision "puppet" do |puppet|
            puppet.manifest_file = "server.pp"
        end
    end
end

