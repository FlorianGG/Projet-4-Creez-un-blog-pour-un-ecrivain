DROP DATABASE IF  EXISTS Blog;
CREATE DATABASE IF NOT EXISTS Blog DEFAULT CHARACTER SET 'utf8' ;
USE Blog;

-- -----------------------------------------------------
-- Table `Blog`.`user`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS user (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	pseudo VARCHAR(70) NOT NULL,
	email VARCHAR(255) NOT NULL,
	pass VARCHAR(255) NOT NULL)
ENGINE=INNODB;

INSERT INTO user (pseudo, email, pass) VALUES
('admin', 'admin@gmail.com', '$2y$10$l65.5FkhEkkTXPurgUTOauF4kq0lphGg23Q2hn2Get/w/sJZYTedm'),
('john', 'john@gmail.com', '$2y$10$U.MLILmoiRBz31dRbdRPGuetO9wFByc7dbc9qtragduWj39kiO2zC');

CREATE UNIQUE INDEX `UX_user_email` ON `user` (`email`);
CREATE UNIQUE INDEX `UX_user_pseudo` ON `user` (`pseudo`);



-- -----------------------------------------------------
-- Table `Blog`.`admin`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS admin (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	pseudo VARCHAR(70) NOT NULL,
	email VARCHAR(255) NOT NULL,
	pass VARCHAR(255) NOT NULL)
ENGINE=INNODB;

INSERT INTO admin (pseudo, email, pass) VALUES
('admin', 'admin@gmail.com', '$2y$10$l65.5FkhEkkTXPurgUTOauF4kq0lphGg23Q2hn2Get/w/sJZYTedm');

CREATE UNIQUE INDEX `UX_admin_email` ON `admin` (`email`);
CREATE UNIQUE INDEX `UX_admin_pseudo` ON `admin` (`pseudo`);


-- -----------------------------------------------------
-- Table `Blog`.`article`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS article (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(70) NOT NULL,
	content LONGTEXT NOT NULL,
	dateArticle DATETIME NOT NULL,
	adminId INT UNSIGNED,
	isDraft VARCHAR(6),
	CONSTRAINT fk_adminId_id
		FOREIGN KEY (adminId)
		REFERENCES admin(id)
		ON DELETE SET NULL)
ENGINE=INNODB;

CREATE UNIQUE INDEX `UX_article_title` ON `article` (`title`);


INSERT INTO article (title, content, dateArticle, adminId, isDraft) VALUES
('Article 1', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	, '2017-06-05 13:50:00', 1, NULL),
('Article 2', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	 , '2017-06-05 13:51:00', 1, NULL),
('Article 3', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	, '2017-06-05 13:52:00', 1, NULL),
('Article 4', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	, '2017-06-05 13:53:00', 1, NULL),
('Article 5', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	, '2017-06-05 13:54:00', 1, NULL),
('Article 6', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	 , '2017-06-05 13:54:30', 1, NULL),
('Article 7', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	, '2017-06-05 13:55:00', 1, NULL),
('Article 8', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	, '2017-06-05 13:56:00', 1, NULL),
('Article 9', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	, '2017-06-05 13:57:00', 1, NULL),
('Article 10', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	 , '2017-06-05 13:58:00', 1, NULL),
('Article 11', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	, '2017-06-05 14:00:00', 1, NULL),
('Article 12', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	, '2017-06-05 14:01:00', 1, NULL),
('Article 13', '<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<ul style="text-align: justify;">
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></li>
<li><span style="color: #808080;"><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: center;"><span style="color: #808080;"><em><span style="font-family: arial, helvetica, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></em></span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>
<p style="text-align: justify;"><span style="font-family: arial, helvetica, sans-serif; color: #808080;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.</span></p>'
	, '2017-06-05 14:02:00', 1, NULL);

-- -----------------------------------------------------
-- Table `Blog`.`commentaire`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS  comment (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	content LONGTEXT NOT NULL,
	dateComment DATETIME NOT NULL,
	idParent INT NOT NULL DEFAULT 0,
	userId INT UNSIGNED,
	articleId INT UNSIGNED NOT NULL,
	CONSTRAINT fk_userId_id
		FOREIGN KEY (userId)
		REFERENCES user(id)
		ON DELETE CASCADE,
	CONSTRAINT fk_articleId_id
		FOREIGN KEY (articleId)
		REFERENCES article(id)
		ON DELETE CASCADE)
ENGINE=INNODB;

INSERT INTO comment (content, dateComment, idParent, userId, articleId) VALUES
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet assumenda rem labore rerum autem voluptates fuga porro sapiente inventore! Repellendus neque cum, eius cumque voluptas in dicta libero quae voluptate.'
	, '2017-06-06 13:50:00', 0, 2, 1),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet assumenda rem labore rerum autem voluptates fuga porro sapiente inventore! Repellendus neque cum, eius cumque voluptas in dicta libero quae voluptate.'
	, '2017-06-06 13:51:00', 0, 2, 1),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad nulla incidunt, quas veniam. Eius assumenda mollitia nulla odio optioad, maxime rem animi in impedit consectetur quae omnis illum ea.'
	 , '2017-06-06 13:51:00', 0, 2, 2),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad nulla incidunt, quas veniam. Eius assumenda mollitia nulla odio optioad, maxime rem animi in impedit consectetur quae omnis illum ea.'
	 , '2017-06-06 13:52:00', 3, 2, 2),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.'
	, '2017-06-06 13:52:00', 0, 2, 3),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem eligendi, animi esse obcaecati et repellat natus! Sunt, molestias excepturi quaerat nemo recusandae, quidem dignissimos ipsum voluptas officia quod possimus eos?'
	, '2017-06-06 13:53:00', 0, 2, 4),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem eligendi, animi esse obcaecati et repellat natus! Sunt, molestias excepturi quaerat nemo recusandae, quidem dignissimos ipsum voluptas officia quod possimus eos?'
	, '2017-06-06 13:54:00', 0, 2, 4),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet assumenda rem labore rerum autem voluptates fuga porro sapiente inventore! Repellendus neque cum, eius cumque voluptas in dicta libero quae voluptate.'
	, '2017-06-06 13:54:00', 0, 2, 5),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad nulla incidunt, quas veniam. Eius assumenda mollitia nulla odio optioad, maxime rem animi in impedit consectetur quae omnis illum ea.'
	 , '2017-06-06 13:54:30', 0, 2, 6),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.'
	, '2017-06-06 13:55:00', 0, 2, 7),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.'
	, '2017-06-06 13:56:00', 10, 2, 7),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.'
	, '2017-06-06 13:56:00', 10, 2, 7),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.'
	, '2017-06-06 14:00:00', 0, 2, 7),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.'
	, '2017-06-06 14:00:00', 13, 2, 7),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.'
	, '2017-06-06 13:56:00', 13, 2, 7),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem eligendi, animi esse obcaecati et repellat natus! Sunt, molestias excepturi quaerat nemo recusandae, quidem dignissimos ipsum voluptas officia quod possimus eos?'
	, '2017-06-06 13:56:00', 0, 2, 8),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit.Eveniet assumenda rem labore rerum autem voluptates fuga porro sapiente inventore! Repellendus neque cum, eius cumque voluptas in dicta libero quae voluptate.'
	, '2017-06-06 13:57:00', 0, 2, 9),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad nulla incidunt, quas veniam. Eius assumenda mollitia nulla odio optioad, maxime rem animi in impedit consectetur quae omnis illum ea.'
	 , '2017-06-06 13:58:00', 0, 2, 10),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas autem, officiis ipsum aliquam molestiae, cupiditate harum repudiandae nobis culpa ullam voluptatem mollitia vel assumenda nam quo est, neque aliquid ratione.'
	, '2017-06-06 14:00:00', 0, 2, 11),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem eligendi, animi esse obcaecati et repellat natus! Sunt, molestias excepturi quaerat nemo recusandae, quidem dignissimos ipsum voluptas officia quod possimus eos?'
	, '2017-06-06 14:01:00', 0, 2, 12),
('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet ipsam modi soluta facere consequuntur, sequi eos quasi velit dolorem, minus sunt! Iste ullam rerum vitae repellendus numquam, sed pariatur dignissimos.'
	, '2017-06-06 14:02:00', 0, 2, 13);
