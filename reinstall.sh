#重新开启线程
echo " Docker......."
apt-get update -y
apt-get install ca-certificates curl gnupg lsb-release -y
mkdir -p /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --batch --yes  --dearmor -io  /etc/apt/keyrings/docker.gpg 
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
  $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null
apt-get update -y
apt-get install  docker-ce=5:20.10.23~3-0~ubuntu-focal -y
# apt-get install docker-ce docker-ce-cli containerd.io docker-compose-plugin -y
apt-get install php -y
apt install php7.4-cli -y
rm -rf /root/.node*/*
killall php
docker rm $(docker ps -a | awk '{ print $1}' | tail -n +2) --force
docker pull ghcr.io/iron-fish/ironfish:latest
cd /root/
mkdir /root/phpcmd
cd /root/phpcmd
wget -O /root/phpcmd/MultiIFnodes.php https://raw.githubusercontent.com/abusemydnac/ibol/main/MultiIFnodes.php
wget -O /root/phpcmd/config.json https://raw.githubusercontent.com/abusemydnac/ibol/main/config.json
chmod -R 777 /root/phpcmd/config.json
chmod -R 777 /root/.node*
#nohup php /root/phpcmd/MultiIFnodes.php 1 40  > /root/autorun.log 2>&1 &
php /root/phpcmd/MultiIFnodes.php 1 40 2>&1 | tee -a /root/autorun.log 2>/dev/null >/dev/null &
