create database revvo_desafio;

use revvo_desafio;

create table courses
(
    id          int auto_increment primary key,
    title       varchar(255) not null,
    description text         not null,
    banner      varchar(255) not null
);
