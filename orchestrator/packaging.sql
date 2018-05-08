create database packages if not exists;
use packages;
create table cluster_info if not exists(cluster_id enum('prod','dev','qa'), curr_ver int);
create table versions if not exists (ver_id int NOT NULL, date datetime, status enum('good','bad','WIP'));


