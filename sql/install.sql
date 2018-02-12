drop database if exists it490;
create database if not exists it490;
use it490;
drop table if exists users;
create table users
(
	user_id INT(128) NOT NULL primary key auto_increment,
	user_email varchar(100),
	user_pw varchar(24),
	user_first_name varchar(32) DEFAULT NULL,
	user_last_name varchar(32) DEFAULT NULL,
	first_login UNIX_TIMESTAMP(),
	last_login  UNIX_TIMESTAMP()
);