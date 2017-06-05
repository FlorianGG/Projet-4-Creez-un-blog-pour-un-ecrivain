DROP DATABASE IF  EXISTS Blog;
CREATE DATABASE IF NOT EXISTS Blog DEFAULT CHARACTER SET 'utf8' ;
USE Blog;

-- -----------------------------------------------------
-- Table `Blog`.`user`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS user (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(70) NOT NULL,
	email VARCHAR(255) NOT NULL,
	pass VARCHAR(255) NOT NULL)
ENGINE=INNODB;

-- -----------------------------------------------------
-- Table `Blog`.`admin`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS admin (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(70) NOT NULL,
	email VARCHAR(255) NOT NULL,
	pass VARCHAR(255) NOT NULL)
ENGINE=INNODB;

-- -----------------------------------------------------
-- Table `Blog`.`article`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS  article (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(70) NOT NULL,
	content LONGTEXT NOT NULL,
	dateArticle DATETIME NOT NULL,
	adminId INT NOT NULL,
	CONSTRAINT fk_adminId_id
		FOREIGN KEY (adminId)
		REFERENCES admin(id))
ENGINE=INNODB;

-- -----------------------------------------------------
-- Table `Blog`.`commentaire`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS  commentaire (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(70) NOT NULL,
	content LONGTEXT NOT NULL,
	dateArticle DATETIME NOT NULL,
	idParent INT NOT NULL DEFAULT 0,
	userId INT NOT NULL,
	articleId INT NOT NULL,
	CONSTRAINT fk_userId_id
		FOREIGN KEY (userId)
		REFERENCES Blog.user (id),
	CONSTRAINT fk_articleId_id
		FOREIGN KEY (articleId)
		REFERENCES article(id))
ENGINE=INNODB;
