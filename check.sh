# 12G+ 
wget -O MultiIFnodes.php https://raw.githubusercontent.com/abusemydnac/ibol/main/MultiIFnodes.php
wget -O config.json https://raw.githubusercontent.com/abusemydnac/ibol/main/config.json
nohup php /root/phpcmd/MultiIFnodes.php 1 55 >/root/create.log 2>&1 &
sleep 1
echo 'DONE'
# tail -f /root/create.log
