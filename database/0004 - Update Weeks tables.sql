SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Update weeks table
ALTER TABLE `weeks`
  ADD COLUMN `week_in_month` INT(11) NOT NULL  AFTER `end` ,
  ADD COLUMN `year` INT(11) NOT NULL  AFTER `month`
