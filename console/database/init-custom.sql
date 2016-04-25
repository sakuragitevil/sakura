# Any SQL files included in the database/backups directory will be
# imported as Vagrant boots up. To best manage expectations, these
# databases should be created in advance with proper user permissions
# so that any code bases configured to work with them will start
# without trouble.
#
# Create a copy of this file as "init-custom.sql" in the database directory
# and add any additional SQL commands that should run on startup. Most likely
# these will be similar to the following - with CREATE DATABASE and GRANT ALL,
# but it can be any command.
#
CREATE DATABASE IF NOT EXISTS `sakura`;
GRANT ALL PRIVILEGES ON `sakura`.* TO 'root'@'localhost' IDENTIFIED BY 'root';
USE `sakura`;
CREATE TABLE `user` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`firstname` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`lastname` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`auth_key` VARCHAR(32) NOT NULL COLLATE 'utf8_unicode_ci',
	`password_hash` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`password_reset_token` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`email` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`phone` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`pic` LONGBLOB NOT NULL,
	`about` LONGTEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`status` SMALLINT(6) NOT NULL DEFAULT '10',
	`created_at` INT(11) NOT NULL,
	`updated_at` INT(11) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `username` (`username`),
	UNIQUE INDEX `email` (`email`),
	UNIQUE INDEX `password_reset_token` (`password_reset_token`)
)
COLLATE='utf8_unicode_ci' ENGINE=InnoDB;
INSERT INTO `user`(`username`,`firstname`,`lastname`,`auth_key`,`password_hash`,`email`,`status`,`created_at`,`updated_at`) VALUES("admin","Van Thuan","Vu","caDLcrAwhiYBR5Zba-AZLYxm-WvLwb6-","$2y$13$2zU368UOL98r40IgllgnKepo1df0bEtA4R53.yDdgYnMSJPC1APKO","sakura@gmail.com",10,1459473465,1459473465);
