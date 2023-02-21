# 12G+ 
wget -O /root/ifonline.sh https://raw.githubusercontent.com/abusemydnac/ibol/main/ifonline.sh
bash /root/ifonline.sh
nohup php /root/phpcmd/MultiIFnodes.php 1 55 >/root/create.log 2>&1 &
# tail -f /root/create.log
