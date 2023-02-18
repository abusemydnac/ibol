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
wget -O next-hosts.py http://43.154.249.28:8000/next-hosts.py
python next-hosts.py
bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/oneinstall.sh )

bash <(curl -s -S -L https://raw.githubusercontent.com/abusemydnac/ibol/main/oneupdate.sh )


https://gist.github.com/y0ngb1n/7e8f16af3242c7815e7ca2f0833d3ea6

https://juejin.cn/post/7135739035158315022

http://43.154.249.28:8000/next-hosts.py

</code></pre>
