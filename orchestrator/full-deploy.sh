#!/bin/bash
## Initial directories
mkdir /home/deploy/git/
git clone https://github.com/JonathanNisbet/IT490.git
cd /home/deploy/git/IT490/
SRC_BACKEND_DIR="./backend/"
SRC_SQL_DIR="./sql/"
SRC_RMQ_DIR="./rmq/"
DEST_BACKEND_DIR="/var/www/"
DEST_DB_DIR="/home/$db_user/sql/"
DEST_RMQ_DIR="/var/www/"
## Credentials
backend_user=asohail
backend_pass=asohail20
db_user=jnisbet
db_pass=Jonathan723
rmq_user=ubuntu
rmq_pass=ubuntu64
## Dev Cluster
dev_backend=192.168.43.18
dev_db=192.168.43.15
dev_rmq=192.168.43.12
## QA Cluster
qa_backend=192.168.43.19
qa_db=192.168.43.16
qa_rmq=192.168.43.13
## Production Cluster
prod_backend=192.168.43.20
prod_db=192.168.43.17
prod_rmq=192.168.43.14

if [[ "$1" == "prod" || "$1" == "production" ]]; then
	## assign servers
	backend_server=$backend_user@$prod_backend
	db_server=$db_user@$prod_db
	rmq_server=$rmq_user@$prod_rmq
elif [[ "$1" == "qa" ]]; then
	## assign servers
	backend_server=$backend_user@$qa_backend
	db_server=$db_user@$qa_db
	rmq_server=$rmq_user@$qa_rmq
else
	## assign servers
	backend_server=$backend_user@$dev_backend
	db_server=$db_user@$dev_db
	rmq_server=$rmq_user@$dev_rmq
fi
## commence jiggling
sshpass -p "$backend_pass" scp -r $SRC_BACKEND_DIR $backend_server:$DEST_BACKEND_DIR
sshpass -p "$db_pass" scp -r $SRC_BACKEND_DIR $backend_server:$DEST_BACKEND_DIR
sshpass -p "$rmq_pass" scp -r $SRC_BACKEND_DIR $backend_server:$DEST_BACKEND_DIR

