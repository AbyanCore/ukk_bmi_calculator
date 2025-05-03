create database ukk_bmi_db;

use ukk_bmi_db;

create table User (
  id int not null primary key auto_increment,
  fullname varchar(100) not null,
  nip varchar(20),
  gender enum("Pria","Wanita") not null,
  photo varchar(100) not null,
  password varchar(255) not null,
  userType enum("admin","guru","siswa","lainnya") not null
);

create table UserBMI (
  id int not null primary key auto_increment,
  user_id int not null,
  weight float not null,
  height float not null,
  ideal_weight float not null,
  status_weight enum("gemuk","ideal","kurus") not null,
  foreign key (user_id) references User(id) on delete cascade on update cascade
);
