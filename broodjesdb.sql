DROP DATABASE IF EXISTS `broodjesapp`;
CREATE DATABASE `broodjesapp` CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP USER IF EXISTS 'broodjesapp'@'localhost';
CREATE USER 'broodjesapp'@'localhost' IDENTIFIED BY 'php123';

GRANT ALL ON `broodjesapp`.* TO 'broodjesapp'@'localhost';

USE `broodjesapp`;

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` VARCHAR(30) NOT NULL DEFAULT '',
    `datum` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `soep` TINYINT UNSIGNED DEFAULT 0,
    `soepbrood_wit` TINYINT UNSIGNED DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP TABLE IF EXISTS `beleg`;
CREATE TABLE `beleg` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `categorie` VARCHAR(30) NOT NULL DEFAULT '',
    `prijs_klein` DECIMAL(5,2) DEFAULT 0.0,
    `prijs_groot` DECIMAL(5,2) DEFAULT 0.0,
    `beleg` VARCHAR(30) NOT NULL DEFAULT '',
    `omschrijving` VARCHAR(100) NOT NULL DEFAULT '',
    PRIMARY KEY(`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP TABLE IF EXISTS `soep`;
CREATE TABLE `soep` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `soep` VARCHAR(30) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP TABLE IF EXISTS `order_broodje`;
CREATE TABLE `order_broodje` (
    `broodje_id` INT UNSIGNED NOT NULL,
    `order_id` INT UNSIGNED NOT NULL,
    `aantal` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`broodje_id`, `order_id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';


DROP TABLE IF EXISTS `broodje`;
CREATE TABLE `broodje` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `beleg_id` INT NOT NULL DEFAULT 0,
    `is_wit` TINYINT UNSIGNED DEFAULT 0,
    `is_groot` TINYINT UNSIGNED DEFAULT 0,
    `opmerking` VARCHAR(100) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `naam` VARCHAR(30) NOT NULL DEFAULT '',
    `voornaam` VARCHAR(30) NOT NULL DEFAULT '',
    `password` VARCHAR(255) NOT NULL DEFAULT '',
    `email` VARCHAR(30) NOT NULL DEFAULT '',
    `potje` DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0,
    `is_admin` TINYINT UNSIGNED DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP TABLE IF EXISTS `supplementen`;
CREATE TABLE `supplementen` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `supplement` VARCHAR(30) NOT NULL DEFAULT '',
    `prijs` DECIMAL(5,2) NOT NULL DEFAULT 0.0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `categorie` VARCHAR(30) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';