create table if not exists rokuchan.rokuchan (
    id int not null auto_increment,
    name varchar(255) not null,
    content mediumtext,
    primary key (id)
)
