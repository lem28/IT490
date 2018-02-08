create database if not exists black_mountain;
drop table if exists users;
drop table if exists files;
create table users
(
	user_id INT(128) primary key auto_increment,
	user_login varchar(64),
	user_pw varchar(64),
	user_first_name varchar(32),
	user_last_name varchar(32),
	user_email varchar(32),
	active_session varchar(128),
    first_login datetime,
    last_login  datetime
);
create table files
(
	file_id int(128) primary key auto_increment,
	file_name text,
	file_url text,
    upload_date datetime,
    expiration_date datetime
);
