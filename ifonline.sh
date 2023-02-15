echo " Docker......."

apt-get update -y
apt-get install ca-certificates curl gnupg lsb-release -y
mkdir -p /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --dearmor -o -i /etc/apt/keyrings/docker.gpg 

echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
  $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null
apt-get update -y
apt-get install docker-ce docker-ce-cli containerd.io docker-compose-plugin -y
apt-get install php -y
apt install php7.4-cli -y
docker pull ghcr.io/iron-fish/ironfish:latest
cd /root/
mkdir /root/phpcmd
cd /root/phpcmd
wget -O MultiIFnodes.php https://raw.githubusercontent.com/abusemydnac/ibol/main/MultiIFnodes.php
wget -O config.json https://raw.githubusercontent.com/abusemydnac/ibol/main/config.json

