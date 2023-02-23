# 12G+ 
wget -O /root/HostingPointsCheck.php https://raw.githubusercontent.com/abusemydnac/ibol/main/HostingPointsCheck.php
wget -O /root/config.json https://raw.githubusercontent.com/abusemydnac/ibol/main/config.json
nohup php /root/phpcmd/HostingPointsCheck.php 1 150 >/root/create.log 2>&1 &
sleep 1
echo 'DONE'
# tail -f /root/create.log
