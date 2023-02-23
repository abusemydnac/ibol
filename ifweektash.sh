#交互任务
docker run -itd --restart=always --name node --volume /root/.node$i:/root/.ironfish ghcr.io/iron-fish/ironfish:latest start
wget -O /root/phpcmd/SELF_NOSTOP_weekTaskAutoRun.php https://raw.githubusercontent.com/abusemydnac/ibol/main/SELF_NOSTOP_weekTaskAutoRun.php
wget -O /root/phpcmd/createWalletAndFaucet.php https://raw.githubusercontent.com/abusemydnac/ibol/main/createWalletAndFaucet.php
wget -O /root/phpcmd/changeNodeGraffiti.php https://raw.githubusercontent.com/abusemydnac/ibol/main/changeNodeGraffiti.php
npm config set registry https://registry.npm.taobao.org
apt install npm -y
npm install pm2 -g
php /root/phpcmd/changeNodeGraffiti.php
docker exec  node bash -c 'ironfish config:set enableTelemetry true'
docker exec  node bash -c 'ironfish config:set maxPeers 10'
php /root/phpcmd/createWalletAndFaucet.php 1 35
#pm2 start /root/phpcmd/SELF_NOSTOP_weekTaskAutoRun.php -i 2
#pm2 scale /root/phpcmd/SELF_NOSTOP_weekTaskAutoRun.php 4
