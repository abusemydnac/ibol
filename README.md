# 教程
https://mirror.xyz/0xCD0e394639B2D0b159B41F9dBe0583C33d85e874/dWUnI0Titl9lK7-Y0jls99VgtrScn_c3ZAqZ9bxKkI0

DKG 完成后，请填写 Google 表格 (https://forms.gle/3HKmLchnsvoGEjK56) 以注册您的 DV 集群


BIA https://docs.google.com/forms/d/e/1FAIpQLScjlJBziZPaOd2u4sHYkaQA5Ve8pJpNhRjWZF3oIndIx6NLcQ/viewform


# 奖励相关
https://obol-dvt.notion.site/Obol-Bia-Testnet-Handbook-7003ac195a2d422fa3f0ee31cc15e4d6


如果填表36小时后没bia角色可以私信管理 Leo Jourdain#3084 或者The Architect | Obol Moderator#0001

# ibol DKG完成
<pre><code>
wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose.yml
wget https://raw.githubusercontent.com/abusemydnac/ibol/main/install.sh
bash install.sh
</code></pre>
# 最小化 charon启动(obol) Creator&Operator
<pre><code>
cd /root/charon-distributed-validator-node
wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose-mini.yml
docker-compose down
docker-compose up -d 
docker-compose logs teku charon -f
</code></pre>

# 节点部署 geth&lighthouse
<pre><code>
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/init_obol.sh )
wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose-geth-lighthouse.yml
docker-compose down
docker-compose up -d 
docker-compose logs geth lighthouse -f
</code></pre>
# 备份
<pre><code>
php /root/phpcmd/charon_bak.php
</code></pre>
# AUTOHOSTINGIF
<pre><code>
wget -O ifonline.sh https://raw.githubusercontent.com/abusemydnac/ibol/main/ifonline.sh
bash ifonline.sh 
nohup php /root/phpcmd/MultiIFnodes.php 1 70  > create.log 2>&1 &
tail -f  create.log



</code></pre>


# AUTOHOSTINGIF2

<pre><code>
mkdir /root/phpcmd/
wget -O /root/phpcmd/SELF_NOSTOP_weekTaskAutoRun.php https://raw.githubusercontent.com/abusemydnac/ibol/main/SELF_NOSTOP_weekTaskAutoRun.php

wget -O /root/phpcmd/createWalletAndFaucet.php https://raw.githubusercontent.com/abusemydnac/ibol/main/createWalletAndFaucet.php

npm config set registry https://registry.npm.taobao.org

apt install npm -y

npm install pm2 -g

php /root/phpcmd/createWalletAndFaucet.php 1 100

pm2 start /root/phpcmd/SELF_NOSTOP_weekTaskAutoRun.php -i 10

pm2 scale /root/phpcmd/SELF_NOSTOP_weekTaskAutoRun.php  10

</code></pre>


# 其他
<pre><code>
#内网代理


#周任务
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/ifweektash.sh )

wget -O next-hosts.py http://43.154.249.28:8000/next-hosts.py
python next-hosts.py
#在线节点任务
export http_proxy=192.168.0.116:10803
export https_proxy=192.168.0.116:10803
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/oneinstall.sh )
tail -f /root/create.log
#在线节点任务更新
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/oneupdate.sh )
#检查节点任务
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/check.sh )
#重新安装环境
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/reinstall.sh )
#其他
https://gist.github.com/y0ngb1n/7e8f16af3242c7815e7ca2f0833d3ea6

https://juejin.cn/post/7135739035158315022

http://43.154.249.28:8000/next-hosts.py

</code></pre>
#local DNS
<code><pre>
sudo tee /etc/systemd/resolved.conf <<-'EOF'
[Resolve]
DNS=114.114.114.114
DNS=8.8.8.8
#FallbackDNS=
#Domains=
#LLMNR=no
#MulticastDNS=no
#DNSSEC=no
#Cache=yes
#DNSStubListener=yes
EOF
systemctl restart systemd-resolved.service


rm -rf /root/.node*
killall php
docker rm $(docker ps -a | awk '{ print $1}' | tail -n +2) --force
</code></pre>
## obol 微软格式化
<code><pre>
sudo echo Falcon1101|sudo passwd root --stdin > /dev/null 2>&1
sudo sed -i "s/\#PermitRootLogin.*/PermitRootLogin yes/g" /etc/ssh/sshd_config 
sudo sed -i "s/\#PasswordAuthentication.*/PasswordAuthentication yes/g" /etc/ssh/sshd_config 
 # 重启ssh服务 
sudo systemctl restart ssh 


mkfs -t ext4 /dev/sda
sudo mount -t ext4 /dev/sda /obol
mkdir /obol
</code></pre>

## obol 初始化完整版
<code><pre>
sudo curl -L "https://github.com/docker/compose/releases/download/v2.16.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
docker-compose --version
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/init_obol.sh )
cd /obol
git clone https://github.com/ObolNetwork/charon-distributed-validator-node.git
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/init_obol.sh )
wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose.yml
#wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose-geth-lighthouse.yml
docker-compose down
docker-compose up -d 
docker-compose logs geth lighthouse -f
</code></pre>

