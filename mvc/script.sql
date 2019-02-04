DROP DATABASE IF EXISTS social_network;
CREATE DATABASE social_network CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
use social_network;

CREATE TABLE post(
id int not null primary key auto_increment,
content text
)engine=InnoDb;

INSERT INTO post (content) values ('evo danas opet pada kiša'), ('jedem jagode');