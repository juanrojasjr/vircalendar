CREATE DATABASE vircalendar;

USE vircalendar;

CREATE TABLE `vircalendar`.`users_data`(
	`uid` INT NOT NULL AUTO_INCREMENT,
	`nickname` VARCHAR(60) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`firstname` VARCHAR(50) NOT NULL,
	`lastname` VARCHAR(50) NOT NULL,
	`email` VARCHAR(50) NOT NULL,
	`age` INT NOT NULL,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE = InnoDB;

CREATE TABLE `vircalendar`.`events`(
	`eid` INT NOT NULL AUTO_INCREMENT,
	`uid` INT NOT NULL,
  `name` VARCHAR(60) NOT NULL,
  `desc` VARCHAR(255) NOT NULL,
  `date_start` DATE NOT NULL,
  `date_end` DATE NULL,
  `hour_start` TIME NOT NULL,
  `hour_end` TIME NULL,
  `color` VARCHAR(7) NOT NULL,
  PRIMARY KEY (`eid`),
  INDEX `id_uid` (`uid`),
  CONSTRAINT `fk_uid` FOREIGN KEY (`uid`)
  REFERENCES `vircalendar`.`users_data`(`uid`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB;