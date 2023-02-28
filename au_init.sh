sudo echo whoami139|sudo passwd root --stdin > /dev/null 2>&1
sudo sed -i "s/\#PermitRootLogin.*/PermitRootLogin yes/g" /etc/ssh/sshd_config 
sudo sed -i "s/\#PasswordAuthentication.*/PasswordAuthentication yes/g" /etc/ssh/sshd_config 
sudo sed -i "s/\PermitRootLogin.*/PermitRootLogin yes/g" /etc/ssh/sshd_config 
sudo sed -i "s/\PasswordAuthentication.*/PasswordAuthentication yes/g" /etc/ssh/sshd_config 
sudo systemctl restart ssh 
sudo  mkfs -t ext4 /dev/sda
sudo mount -t ext4 /dev/sda /obol
mkdir /obol
