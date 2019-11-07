DROP DATABASE IF EXISTS blog;
CREATE DATABASE blog CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE blog;
CREATE TABLE categories(
  id int PRIMARY KEY AUTO_INCREMENT,
  category_name varchar(100) NOT NULL UNIQUE,
  status tinyint(1) DEFAULT '1'
);
CREATE TABLE users(
  id int PRIMARY KEY AUTO_INCREMENT,
  username varchar(100) NOT NULL UNIQUE,
  email varchar(100) NOT NULL UNIQUE,
  password varchar(100) NOT NULL
);
CREATE TABLE posts(
  id int PRIMARY KEY AUTO_INCREMENT,
  post_title varchar(255) NOT NULL,
  content text NULL,
  category_id int NOT NULL,
  user_id int NOT NULL,
  FOREIGN KEY fk_user_id(user_id) REFERENCES users(id),
  FOREIGN key fk_category_id(category_id) REFERENCES categories(id)
)