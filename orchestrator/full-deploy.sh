#!/bin/bash
curr_time=$(date "+%m-%d-%y | %h-%m-%s")
git_src="https://github.com/JonathanNisbet/IT490.git"
## credentials
backend_user="asohail"
backend_pass="asohail20"
mysql_user="jnisbet"
mysql_pass="jonathan723"
mysql_accounts="accounts"
mysql_userdata="userdata"
rmq_user="ubuntu"
rmq_pass="ubuntu64"
## initial directories
dir_base="/home/deploy/orchestrator/"
dir_bak_mysql="bak_mysql/"
dir_bak_backend="bak_backend/"
dir_src_backend="backend/"
dir_src_mysql="mysql/"
dir_src_rmq="rmq/"
dir_dest_backend="/var/www/"
dir_dest_mysql="/home/$mysql_user/"
## dev cluster
dev_backend="192.168.43.18"
dev_mysql="192.168.43.15"
dev_rmq="192.168.43.12"
## qa cluster
qa_backend="192.168.43.19"
qa_mysql="192.168.43.16"
qa_rmq="192.168.43.13"
## production cluster
prod_backend="192.168.43.20"
prod_mysql_master_host="192.168.43.17"
prod_mysql_slave_host="192.168.43.25"
prod_rmq="192.168.43.14"
## assign servers with user input
if [[ "$1" == "prod" || "$1" == "production" ]]; then
	backend_server=$backend_user@$prod_backend
	mysql_server=$mysql_user@$prod_mysql
	rmq_server=$rmq_user@$prod_rmq
elif [[ "$1" == "qa" || "$1" == "staging" ]]; then
	backend_server=$backend_user@$qa_backend
	mysql_server=$mysql_user@$qa_mysql
	rmq_server=$rmq_user@$qa_rmq
else
	backend_server=$backend_user@$dev_backend
	mysql_server=$mysql_user@$dev_mysql
	rmq_server=$rmq_user@$dev_rmq
fi
## commence jiggling
git clone 
## tar up shit
tar -czvf backend.tar.gz $dir_base$dir_src_backend
tar -czvf rmq.tar.gz $dir_base$dir_src_rmq
tar -czvf mysql.tar.gz $dir_base$dir_src_backend
## scp shit
sshpass -p "$backend_pass" scp -r $src_backend_dir $backend_server:$dest_backend_dir
sshpass -p "$mysql_pass" scp -r $src_backend_dir $backend_server:$dest_backend_dir
sshpass -p "$rmq_pass" scp -r $src_backend_dir $backend_server:$dest_backend_dir

