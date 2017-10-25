create database shoes;
use shoes;

create table members(
ID varchar(30) NOT NULL primary key,
PWD varchar(30) NOT NULL,
tag VARCHAR(50),
isChanged tinyInt(1),
spot varchar(50));
create table ewha_station(
spot varchar(100),
e_num int(10));

insert into ewha_station values("신촌방면",1);
insert into ewha_station values("신촌",1);
insert into ewha_station values("이화여자대학교",2);
insert into ewha_station values("이대부고",2);
insert into ewha_station values("이대부중",2);
insert into ewha_station values("이대부초",2);
insert into ewha_station values("이화여자대학교",3);
insert into ewha_station values("이화여대",3);
insert into ewha_station values("서울과학종합대학교",3);
insert into ewha_station values("서울서부보호관찰소",3);
insert into ewha_station values("서울서부보호관찰소",4);
insert into ewha_station values("대흥동",5);
insert into ewha_station values("마포아트센터",5);
insert into ewha_station values("한서초등학교",6);
insert into ewha_station values("양원주부학교",6);