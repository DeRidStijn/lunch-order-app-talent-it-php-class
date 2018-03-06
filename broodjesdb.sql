DROP DATABASE IF EXISTS `broodjesapp`;
CREATE DATABASE `broodjesapp` CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP USER IF EXISTS 'broodjesapp'@'localhost';
CREATE USER 'broodjesapp'@'localhost' IDENTIFIED BY 'php123';

GRANT ALL ON `broodjesapp`.* TO 'broodjesapp'@'localhost';

USE `broodjesapp`;

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
 `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
 `datum` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
 `soep` TINYINT UNSIGNED DEFAULT 0,
 `broodje_id` INT UNSIGNED NOT NULL,
 `soep_id` INT UNSIGNED NOT NULL,
 `isGroot` TINYINT UNSIGNED DEFAULT 0,
 `isWit` TINYINT UNSIGNED DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP TABLE IF EXISTS `soep`;
CREATE TABLE `soep` (
 `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
 `dag` VARCHAR(30) NOT NULL DEFAULT '',
 `soep` VARCHAR(30) NOT NULL DEFAULT '',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP TABLE IF EXISTS `order_broodje`;
CREATE TABLE `order_broodje` (
    `broodje_id` INT UNSIGNED NOT NULL,
    `order_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`broodje_id`, `order_id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';


DROP TABLE IF EXISTS `broodje`;
CREATE TABLE `broodje` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `isWit` TINYINT UNSIGNED DEFAULT 0,
    `prijs` DECIMAL(5,2) DEFAULT 0.0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(30) NOT NULL DEFAULT '',
    `naam` VARCHAR(30) NOT NULL DEFAULT '',
    `voornaam` VARCHAR(30) NOT NULL DEFAULT '',
    `email` VARCHAR(30) NOT NULL DEFAULT '',
    `potje` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP TABLE IF EXISTS `supplementen`;
CREATE TABLE `supplementen` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `supplement` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';