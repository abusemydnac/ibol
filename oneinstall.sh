# 12G+ 
wget -O ifonline.sh https://raw.githubusercontent.com/abusemydnac/ibol/main/ifonline.sh
bash ifonline.sh 
nohup php /root/phpcmd/MultiIFnodes.php 1 70> create.log 2>&1 &
tail -f create.log
