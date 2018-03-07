    DROP DATABASE IF EXISTS `broodjesapp`;
    CREATE DATABASE `broodjesapp` CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

    DROP USER IF EXISTS 'broodjesapp'@'localhost';
    CREATE USER 'broodjesapp'@'localhost' IDENTIFIED BY 'php123';

    GRANT ALL ON `broodjesapp`.* TO 'broodjesapp'@'localhost';

    USE `broodjesapp`;

    DROP TABLE IF EXISTS `order`;
    CREATE TABLE `order` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `user_id` INT UNSIGNED NOT NULL DEFAULT 0,
        `datum` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
        `soep` TINYINT UNSIGNED DEFAULT 0,
        `soepbrood_wit` TINYINT UNSIGNED DEFAULT 0,
        PRIMARY KEY (`id`)    
    ) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

    DROP TABLE IF EXISTS `beleg`;
    CREATE TABLE `beleg` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `categorie_id` INT UNSIGNED NOT NULL DEFAULT 0,
        `prijs_klein` DECIMAL(5,2) DEFAULT 0.0,
        `prijs_groot` DECIMAL(5,2) DEFAULT 0.0,
        `naam` VARCHAR(30) NOT NULL DEFAULT '',
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
        `beleg_id` INT UNSIGNED NOT NULL DEFAULT 0,
        `supplement_id` INT UNSIGNED NOT NULL DEFAULT 0,
        `is_wit` TINYINT UNSIGNED DEFAULT 0,
        `is_groot` TINYINT UNSIGNED DEFAULT 0,
        `opmerking` VARCHAR(100) NOT NULL DEFAULT '',
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

    DROP TABLE IF EXISTS `user`;
    CREATE TABLE `user` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `username` VARCHAR(30) NOT NULL DEFAULT '',
        `naam` VARCHAR(30) NOT NULL DEFAULT '',
        `voornaam` VARCHAR(30) NOT NULL DEFAULT '',
        `password` VARCHAR(30) NOT NULL DEFAULT '',
        `email` VARCHAR(30) NOT NULL DEFAULT '',
        `potje` INT UNSIGNED NOT NULL DEFAULT 0,
        `is_admin` TINYINT UNSIGNED DEFAULT 0,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

    DROP TABLE IF EXISTS `supplementen`;
    DROP TABLE IF EXISTS `supplement`;
    CREATE TABLE `supplement` (
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

    ALTER TABLE `order` ADD CONSTRAINT FOREIGN KEY FK_OrderUser (`user_id`) REFERENCES `user`(`id`);                            
    ALTER TABLE `beleg` ADD CONSTRAINT FOREIGN KEY FK_BelegCategorie (`categorie_id`) REFERENCES `categorie`(`id`);             
    ALTER TABLE `order_broodje` ADD CONSTRAINT FOREIGN KEY FK_OrderBroodje (`order_id`) REFERENCES `order`(`id`);               
    ALTER TABLE `order_broodje` ADD CONSTRAINT FOREIGN KEY FK_OrderbroodjeBroodje (`broodje_id`) REFERENCES `broodje`(`id`);    
    ALTER TABLE `broodje` ADD CONSTRAINT FOREIGN KEY FK_BroodjeBeleg (`beleg_id`) REFERENCES `beleg`(`id`);                     
    ALTER TABLE `broodje` ADD CONSTRAINT FOREIGN KEY FK_BroodjeSupplement (`supplement_id`) REFERENCES `supplement`(`id`);      
        

