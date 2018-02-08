drop table if exists files;
create table files
(
	file_id int(128) primary key auto_increment,
	file_name text,
	file_url text,
    upload_date datetime,
    expiration_date datetime
);
