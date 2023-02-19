echo " Docker......."

apt-get update -y
apt-get install ca-certificates curl gnupg lsb-release -y
mkdir -p /etc/apt/keyrings
# http://mirrors.aliyun.com/docker-ce/linux/ubuntu/gpg
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --batch --yes  --dearmor -io  /etc/apt/keyrings/docker.gpg 
# http://mirrors.aliyun.com/docker-ce/linux/ubuntu
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] http://mirrors.aliyun.com/docker-ce/linux/ubuntu \
  $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null

apt-get update -y
apt-get install docker-ce docker-ce-cli containerd.io docker-compose-plugin -y

cd /root/

echo " container......."
# Clone this repo
git clone https://github.com/ObolNetwork/charon-distributed-validator-node.git

# chmod
sudo chmod -R 777 charon-distributed-validator-node

# Change directory
cd charon-distributed-validator-node

# fix
mkdir  /root/charon-distributed-validator-node/.charon
sudo chmod -R 777  /root/charon-distributed-validator-node/.charon


#doccker-compose
sudo curl -L "https://github.com/docker/compose/releases/download/v2.16.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

sudo chmod +x /usr/local/bin/docker-compose

cd /root/charon-distributed-validator-node/
# Create your charon ENR private key, this will create a charon-enr-private-key file in the .charon directory
docker run --rm -v "$(pwd):/opt/charon" obolnetwork/charon:v0.13.0 create enr
