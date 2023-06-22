CREATE DATABASE IF NOT EXISTS `shiperp-technical-exam`;
USE `shiperp-technical-exam`;

CREATE TABLE IF NOT EXISTS `providers` (
	`provider_id` int NOT NULL AUTO_INCREMENT,
    `provider_name` varchar(255) NOT NULL,
    `provider_url` TEXT NOT NULL,
    PRIMARY KEY (`provider_id`)
);