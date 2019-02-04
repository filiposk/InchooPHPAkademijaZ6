DROP DATABASE IF EXISTS social_network;
CREATE DATABASE social_network CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
use social_network;

CREATE TABLE post(
id int not null primary key auto_increment,
content text,
image text,
dateCreated timestamp not null DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)engine=InnoDb;

INSERT INTO post (content) values ('evo danas opet pada kiša'), ('jedem jagode');