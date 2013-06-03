SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Create database
CREATE DATABASE `reportedecostos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `reportedecostos`;

-- Create user
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, FILE, INDEX, ALTER, CREATE TEMPORARY TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER ON *.* TO 'costos'@'localhost' IDENTIFIED BY PASSWORD '*CD6EC557306795B3E1D83D81B87176F53971C4D9';
GRANT ALL PRIVILEGES ON `reportedecostos`.* TO 'costos'@'localhost';

-- Create tables
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `rol` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `users` (`id`, `username`, `password`, `rol`) VALUES
(1, 'user@mail.com', MD5('password'), 1);

