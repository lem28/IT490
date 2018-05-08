#!/bin/bash
re='^[0-9]+$'
curr_time=$(date "+%m-%d-%y | %h-%m-%s")
git_src="https://github.com/JonathanNisbet/IT490.git"
## credentials
backend_user="jnisbet"
backend_pass="asohail20"
mysql_user="jnisbet"
mysql_pass="Jonathan723"
mysql_accounts="accounts"
mysql_userdata="userdata"
rmq_user="ubuntu"
rmq_pass="ubuntu64"
## directories
dir_deploy_home="/home/deploy/"
dir_deploy_base="/home/deploy/git/IT490/"
## src / backup
dir_bak_mysql="bak_mysql/"
dir_bak_backend="bak_backend/"
dir_dest_backend="/var/www/"
dir_dest_mysql="/home/$mysql_user/mysql/"
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
if [[ "$1" == "prod" ]]; then
	backend_server=$backend_user@$prod_backend
	mysql_server=$mysql_user@$prod_mysql
	rmq_server=$rmq_user@$prod_rmq
elif [[ "$1" == "qa" ]]; then
	backend_server=$backend_user@$qa_backend
	mysql_server=$mysql_user@$qa_mysql
	rmq_server=$rmq_user@$qa_rmq
elif [[ "$1" == "dev" ]]; then
	backend_server=$backend_user@$dev_backend
	mysql_server=$mysql_user@$dev_mysql
	rmq_server=$rmq_user@$dev_rmq
else
	echo "Please input a cluster. Available clusters: prod (Production), qa (Quality Assurance) or dev (Development)."
	exit 0
fi
## commence jiggling ##
## cd ${dir_deploy_home}${dir_bak_backend} && cp $(ls -t *.tar | tail -1) ${dir_deploy_base}orchestrator/${dir_bak_backend}latest_archive.tar
## cat ${dir_deploy_base}orchestrator/${dir_bak_backend}archive.tar | sshpass -p$backend_pass ssh ${backend_server} "cd /home/jnisbet/git/IT490-1/ && tar xvf -"


version=$(mysql -uroot -pubuntu64 -s -N -e "use packages;	select curr_ver from cluster_info where cluster_id = '$1';")
if [[ "$2" == "rollback" || "$2" == "rb" ]]; then
	version="$(($version - 1))"
elif [[ "$2" =~ $re ]]; then
	version=$2
fi
echo "Deploying version $version"


sshpass -p$backend_pass ssh -o StrictHostKeyChecking=no ${backend_server} "cd /home/jnisbet/git/IT490-1/ && rm -rf * && tar xf - ." < "${dir_deploy_home}${dir_bak_backend}"${version}"_archive.tar"


## cleanup
if [[ "$1" == "prod" ]]; then
	sshpass -p$backend_pass ssh -o StrictHostKeyChecking=no ${backend_server} "cd /home/jnisbet/git/IT490-1/back/;
	echo $backend_pass | sudo -S cp .db/accountsdb.php accountsdb.php;
	echo $backend_pass | sudo -S cp .db/userdb.php userdb.php;
	echo $backend_pass | sudo -S cp .db/forumdb.php forumdb.php;"
elif [[ "$1" == "qa" ]]; then
	sshpass -p$backend_pass ssh -o StrictHostKeyChecking=no ${backend_server} "cd /home/jnisbet/git/IT490-1/back/;
	echo $backend_pass | sudo -S cp .db/accountsdb0.php accountsdb.php;
	echo $backend_pass | sudo -S cp .db/userdb0.php userdb.php;
	echo $backend_pass | sudo -S cp .db/forumdb0.php forumdb.php;"
else
	sshpass -p$backend_pass ssh -o StrictHostKeyChecking=no ${backend_server} "cd /home/jnisbet/git/IT490-1/back/;
	echo $backend_pass | sudo -S cp .db/accountsdb1.php accountsdb.php;
	echo $backend_pass | sudo -S cp .db/userdb1.php userdb.php;
	echo $backend_pass | sudo -S cp .db/forumdb1.php forumdb.php;"
fi
