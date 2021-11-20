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

-- Agregar un usuario DEMO
INSERT INTO `users_data`(`nickname`, `password`, `firstname`, `lastname`, `email`, `age`) VALUES ('demo','$2y$10$0ZoS7SAR0cpky9RfrITIlONdXUVv1U45zWjS2R.6ZOyHpugoSE35G','demo','demo','demo@demo.com','26');

-- Agregar dos eventos DEMO
INSERT INTO `events`(`uid`, `name`, `desc`, `date_start`, `date_end`, `hour_start`, `hour_end`, `color`) VALUES
(1,'Evento demo 1','Descripción del evento demo 1',CURDATE(),DATE_ADD(CURDATE(), INTERVAL 3 DAY),CURRENT_TIME,CURRENT_TIME+INTERVAL 2 HOUR,'#396EB0'),
(1,'Evento demo 2','Descripción del evento demo 2',CURDATE(),DATE_ADD(CURDATE(), INTERVAL 3 DAY),CURRENT_TIME+INTERVAL 3 HOUR,CURRENT_TIME+INTERVAL 4 HOUR,'#FFAB4C'),
(1,'Evento demo 3','Descripción del evento demo 3',DATE_ADD(CURDATE(), INTERVAL 5 DAY),DATE_ADD(CURDATE(), INTERVAL 10 DAY),CURRENT_TIME,CURRENT_TIME+INTERVAL 2 HOUR,'#FF6D6D')