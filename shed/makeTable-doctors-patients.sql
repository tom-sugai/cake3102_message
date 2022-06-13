use my_cake3;

create table doctors (
id int auto_increment primary key,
name varchar(30) not null,
created datetime,
modified datetime
 ) charset=utf8mb4;

create table patients (
id int auto_increment primary key,
doctor_id int not null,
name varchar(30) not null,
created datetime,
modified datetime
 ) charset=utf8mb4;