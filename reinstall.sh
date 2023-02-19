#重新开启线程
#rm -rf /root/.node*/*
docker rm $(docker ps -a | awk '{ print $1}' | tail -n +2) --force
docker pull ghcr.io/iron-fish/ironfish:latest
cd /root/
mkdir /root/phpcmd
cd /root/phpcmd
wget -O MultiIFnodes.php https://raw.githubusercontent.com/abusemydnac/ibol/main/MultiIFnodes.php
wget -O config.json https://raw.githubusercontent.com/abusemydnac/ibol/main/config.json
chmod -R 777 /root/phpcmd/config.json
chmod -R 777 /root/.node*
#nohup php /root/phpcmd/MultiIFnodes.php 1 40  > /root/autorun.log 2>&1 &
php /root/phpcmd/MultiIFnodes.php 1 40 2>&1 | tee -a /root/autorun.log 2>/dev/null >/dev/null &
