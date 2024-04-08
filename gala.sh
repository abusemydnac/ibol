#!/bin/bash

set +ex

API_KEY=$1


sudo NEEDRESTARTMODE=a apt update && sudo apt upgrade -y
sudo apt install pm-utils -y
sudo apt install rfkill -y
sudo apt install docker.io -y
sudo wget --trust-server-names https://links.gala.com/DownloadLinuxNode
sudo tar xzvf *.tar.gz
sudo ./gala-node/install.sh -y
sudo gala-node config api-key $API_KEY


sudo gala-node workload add founders 
sudo gala-node workload add townstar 
sudo gala-node workload add player 
sudo gala-node start

sudo rfkill block wifi
sudo rfkill block bluetooth

file_content="#!/bin/sh -e
gala-node start
rfkill block wifi
rfkill block bluetooth
pm-powersave true
exit 0"

echo -e "$file_content" | sudo tee "/etc/rc.local" > /dev/null

sudo chmod +x /etc/rc.local
