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

INSERT INTO admin (name, email, pass) VALUES
('admin', 'admin@gmail.com', 'admin');

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


INSERT INTO article (title, content, dateArticle, adminId) VALUES
('Article 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Eveniet assumenda rem labore rerum autem voluptates fuga porro sapiente 
	inventore! Repellendus neque cum, eius cumque voluptas in dicta libero 
	quae voluptate.', '2017-06-05 13:50:00', 1),
('Article 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Ad nulla incidunt, quas veniam. Eius assumenda mollitia nulla odio opti
	oad, maxime rem animi in impedit consectetur quae omnis illum ea.'
	 , '2017-06-05 13:51:00', 1),
('Article 3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiand
	ae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neq
	ue aliquid ratione.', '2017-06-05 13:52:00', 1),
('Article 4', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Rem eligendi, animi esse obcaecati et repellat natus! Sunt, molestias ex
	cepturi quaerat nemo recusandae, quidem dignissimos ipsum voluptas offi
	cia quod possimus eos?', '2017-06-05 13:53:00', 1),
('Article 5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Eveniet assumenda rem labore rerum autem voluptates fuga porro sapiente 
	inventore! Repellendus neque cum, eius cumque voluptas in dicta libero 
	quae voluptate.', '2017-06-05 13:54:00', 1),
('Article 6', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Ad nulla incidunt, quas veniam. Eius assumenda mollitia nulla odio opti
	oad, maxime rem animi in impedit consectetur quae omnis illum ea.'
	 , '2017-06-05 13:54:30', 1),
('Article 7', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiand
	ae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neq
	ue aliquid ratione.', '2017-06-05 13:55:00', 1),
('Article 8', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Rem eligendi, animi esse obcaecati et repellat natus! Sunt, molestias ex
	cepturi quaerat nemo recusandae, quidem dignissimos ipsum voluptas offi
	cia quod possimus eos?', '2017-06-05 13:56:00', 1),
('Article 9', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Eveniet assumenda rem labore rerum autem voluptates fuga porro sapiente 
	inventore! Repellendus neque cum, eius cumque voluptas in dicta libero 
	quae voluptate.', '2017-06-05 13:57:00', 1),
('Article 10', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Ad nulla incidunt, quas veniam. Eius assumenda mollitia nulla odio opti
	oad, maxime rem animi in impedit consectetur quae omnis illum ea.'
	 , '2017-06-05 13:58:00', 1),
('Article11', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiand
	ae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neq
	ue aliquid ratione.', '2017-06-05 14:00:00', 1),
('Article 12', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Rem eligendi, animi esse obcaecati et repellat natus! Sunt, molestias ex
	cepturi quaerat nemo recusandae, quidem dignissimos ipsum voluptas offi
	cia quod possimus eos?', '2017-06-05 14:01:00', 1),
('Article 13', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
	Eveniet ipsam modi soluta facere consequuntur, sequi eos quasi velit dol
	orem, minus sunt! Iste ullam rerum vitae repellendus numquam, sed paria
	tur dignissimos.', '2017-06-05 14:02:00', 1);

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
