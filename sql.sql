create database vue_students character set 'utf8' collate 'utf8-general-ci';
use vue_students;
create table students(
		idstudent int auto_increment primary key not null,
		name varchar(50) not null,
		email varchar(50) not null,
		web varchar(100) not null
	);