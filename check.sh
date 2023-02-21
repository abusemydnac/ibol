#检查任务情况
mkdir /root/phpcmd
cd /root/phpcmd
wget -O MultiIFnodes.php https://raw.githubusercontent.com/abusemydnac/ibol/main/MultiIFnodes.php
nohup php /root/phpcmd/MultiIFnodes.php 1 $(docker ps |grep node|wc -l)  > check.log 2>&1 &
tail -f  check.log
