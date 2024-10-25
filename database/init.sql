use revvo_desafio;

create table users
(
    id           int auto_increment primary key,
    name         varchar(255) not null,
    email        varchar(255) not null,
    password     varchar(255) not null,
    avatar       varchar(255) not null,
    first_access boolean default 0 null
);

create table courses
(
    id          int auto_increment primary key,
    title       varchar(255) not null,
    description text         not null,
    banner      varchar(255) not null
);