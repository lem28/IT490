find /home/deploy/git/IT490/orchestrator/bak_mysql/-*-accounts.mysql.bak -type f -mtime +10 -exec rm {} +;find /home/deploy/git/IT490/orchestrator/bak_mysql/-*-userdata.mysql.bak -type f -mtime +10 -exec rm {} +;find /home/deploy/git/IT490/orchestrator/bak_mysql/-*-.mysql.bak -type f -mtime +10 -exec rm {} +;find /home/deploy/git/IT490/orchestrator/bak_backend/-*-.tar.gz -type f -mtime +10 -exec rm {} +;mysqldump -h192.168.43.25 -ujnisbet -pJonathan723 accounts > bak_mysql/-05-07-18 | May-05-1525716670-accounts.mysql.bak;mysqldump -h192.168.43.25 -ujnisbet -pJonathan723 userdata > bak_mysql/-05-07-18 | May-05-1525716670-userdata.mysql.bak;mysqldump -h192.168.43.25 -ujnisbet -pJonathan723 userdata > bak_mysql/-05-07-18 | May-05-1525716670-.mysql.bak;sshpass -pasohail20 ssh -o StrictHostKeyChecking=no jnisbet@ 'tar czpf - /var/www/IT490/' > /home/deploy/git/IT490/orchestrator/bak_backend/-05-07-18 | May-05-1525716670-backend.tar.gz
