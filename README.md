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


# 运行脚本 查看系统

<pre><code>

apt install dos2unix -y
wget -O test.sh 43.154.249.28:8000/auto_obol.php
dos2unix test.sh 
bash test.sh



apt install sysstat -y
sar -u 1 2
sar -r 1 2

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
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/au_init.sh )
</code></pre>

## obol 初始化完整版
<code><pre>

mkdir /obol
cd /obol
git clone https://github.com/ObolNetwork/charon-distributed-validator-node.git
cd /obol/charon-distributed-validator-node
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/init_obol.sh )
#wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose.yml
#wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose-geth-lighthouse.yml
docker-compose down
docker-compose up -d 
docker-compose logs geth lighthouse -f




echo -e "{\n\t\"registry-mirrors\": [\"https://registry.docker-cn.com\"]\n}" > /etc/docker/daemon.json

{
  "registry-mirrors": [
    "https://hub-mirror.c.163.com",
    "https://mirror.baidubce.com",
    "https://registry.docker-cn.com",
    "https://reg-mirror.qiniu.com",
    "https://dockerhub.azk8s.cn",
    "https://docker.mirrors.ustc.edu.cn"
  ]
}

systemctl daemon-reload
systemctl restart docker
docker info
systemctl daemon-reload
systemctl restart docker
docker info

sudo mkdir /obol
sudo mkfs -t ext4 /dev/vdb
sudo mount -t ext4 /dev/vdb /obol

sudo mkdir -p /etc/systemd/system/docker.service.d
sudo touch /etc/systemd/system/docker.service.d/proxy.conf
[Service]
Environment="HTTP_PROXY=http://20.68.173.22:8888/"
Environment="HTTPS_PROXY=http://20.68.173.22:8888/"
Environment="NO_PROXY=localhost,127.0.0.1,.example.com"
systemctl daemon-reload
systemctl restart docker
docker info

bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/obol_cn.sh )

</code></pre>
#geth先运行
<code><pre>
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/spug_init_obol.sh )
cd /obol/charon-distributed-validator-node
wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose-geth.yml
docker-compose down
docker-compose up -d
docker ps

# docker-compose-lighthouse.yml
cd /obol/charon-distributed-validator-node
docker rm -f root-geth-1
wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose-lighthouse.yml
docker-compose down
docker-compose up -d
docker ps

# docker-compose-charon.yml
cd /obol/charon-distributed-validator-node
docker rm -f root-geth-1
wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose-charon.yml
docker-compose down
docker-compose up -d
docker ps

# docker-compose.yml
cd /obol/charon-distributed-validator-node
docker rm -f root-geth-1
wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose.yml
docker-compose down
docker-compose up -d
docker ps

</code></pre>
