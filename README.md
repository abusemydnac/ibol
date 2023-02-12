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
#最小化 charon启动(obol)
<pre><code>
cd /root
wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose-mini.yml
docker-compose up -d 
docker-compose logs -f
</code></pre>

#节点部署 geth&lighthouse
<code>
wget  -O docker-compose.yml https://raw.githubusercontent.com/abusemydnac/ibol/main/docker-compose-geth-lighthouse.yml
docker-compose up -d 
docker-compose logs -f
</code>
