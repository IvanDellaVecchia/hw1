create database hw1;
use hw1;


create table users(
	name varchar(255) not null,
    surname varchar(255) not null,
    email varchar(255) not null,
    username varchar(255) primary key,
    profile varchar(255),
    password varchar(255) not null
);

create table posts(
	id integer primary key auto_increment,
    user varchar(255) not null,
    image varchar(255) not null,
    description varchar(255),
    nlikes integer default 0,
    foreign key(user) references users(username) on delete cascade on update cascade
);

CREATE TABLE likes (
    user varchar(255) not null,
    post integer not null,
    foreign key(user) references users(username) on delete cascade on update cascade,
    foreign key(post) references posts(id) on delete cascade on update cascade,
    primary key(user, post)
);

DELIMITER //
CREATE TRIGGER likes_trigger
AFTER INSERT ON likes
FOR EACH ROW
BEGIN
UPDATE posts 
SET nlikes = nlikes + 1
WHERE id = new.post;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER unlikes_trigger
AFTER DELETE ON likes
FOR EACH ROW
BEGIN
UPDATE posts 
SET nlikes = nlikes - 1
WHERE id = old.post;
END //
DELIMITER ;