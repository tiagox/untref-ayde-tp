SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Update users table
ALTER TABLE `users`
  CHANGE `rol` `rol` ENUM('admin', 'pmo', 'manager', 'developer') NOT NULL DEFAULT 'developer' ;

ALTER TABLE `users`
  ADD `entry_date` DATE NOT NULL ;
