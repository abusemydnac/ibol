#检查任务情况
mkdir /root/phpcmd
cd /root/phpcmd
wget -O HostingPointsCheck.php https://raw.githubusercontent.com/abusemydnac/ibol/main/HostingPointsCheck.php
dockernum=$(docker ps |grep node|wc -l)
nohup php /root/phpcmd/HostingPointsCheck.php 1 $dockernum  > check.log 2>&1 &
tail -f  check.log
