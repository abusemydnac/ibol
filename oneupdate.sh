# 12G+ 
mkdir /root/phpcmd
cd /root/phpcmd
wget -O /root/phpcmd/MultiIFnodes.php https://raw.githubusercontent.com/abusemydnac/ibol/main/MultiIFnodes.php
wget -O /root/phpcmd/config.json https://raw.githubusercontent.com/abusemydnac/ibol/main/config.json
nohup php /root/phpcmd/MultiIFnodes.php 1 70 >/root/create.log 2>&1 &
tail -f /root/create.log
