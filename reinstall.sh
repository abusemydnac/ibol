#重新开启线程
docker pull ghcr.io/iron-fish/ironfish:latest
docker rm $(docker ps -a | awk '{ print $1}' | tail -n +2) --force
cd /root/
mkdir /root/phpcmd
cd /root/phpcmd
wget -O MultiIFnodes.php https://raw.githubusercontent.com/abusemydnac/ibol/main/MultiIFnodes.php
wget -O config.json https://raw.githubusercontent.com/abusemydnac/ibol/main/config.json
nohup php /root/phpcmd/MultiIFnodes.php 1 40  > create.log 2>&1 &
tail -f  create.log
