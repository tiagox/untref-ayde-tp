SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Create tables
DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `reported_hours`;
CREATE TABLE IF NOT EXISTS `reported_hours` (
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `week_id` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`project_id`,`week_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `weeks`;
CREATE TABLE IF NOT EXISTS `weeks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

