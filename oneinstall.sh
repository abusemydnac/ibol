# 12G+ 
wget -O /root/ifonline.sh https://raw.githubusercontent.com/abusemydnac/ibol/main/ifonline.sh
bash /root/ifonline.sh
nohup php /root/phpcmd/MultiIFnodes.php 1 65 >/root/create.log 2>&1 &
sleep 15
echo 'DONE'
# tail -f /root/create.log
