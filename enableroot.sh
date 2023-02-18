sudo echo Falcon1101|sudo passwd root --stdin > /dev/null 2>&1
sudo sed -i "s/\#PermitRootLogin.*/PermitRootLogin yes/g" /etc/ssh/sshd_config 
sudo sed -i "s/\#PasswordAuthentication.*/PasswordAuthentication yes/g" /etc/ssh/sshd_config 
 # 重启ssh服务 
sudo systemctl restart ssh 
