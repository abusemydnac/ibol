wget -O /etc/apt/sources.list https://gist.githubusercontent.com/vczb/694d55169f67a3b2ad20df1385a3e983/raw/7f73c9b98bf70b0c0d87d49301a552f78d5efd86/sources.list
echo " Docker......."

apt-get update -y
apt-get install ca-certificates curl gnupg lsb-release -y
mkdir -p /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --batch --yes  --dearmor -io  /etc/apt/keyrings/docker.gpg 

echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
  $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null
apt-get update -y
# apt-get install  docker-ce=5:20.10.23~3-0~ubuntu-focal -y
apt-get install docker-ce docker-ce-cli containerd.io docker-compose-plugin -y
apt-get install php -y
apt install php7.4-cli -y
sudo curl -L "https://github.com/docker/compose/releases/download/v2.16.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

sudo chmod +x /usr/local/bin/docker-compose
docker-compose --version


mkdir /obol
cd /obol
git clone https://github.com/ObolNetwork/charon-distributed-validator-node.git
cd /obol/charon-distributed-validator-node



