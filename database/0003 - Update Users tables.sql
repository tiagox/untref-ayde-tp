SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Update users table
ALTER TABLE  `users`
  ADD  `weekly_hours` INT( 11 ) NOT NULL DEFAULT  '40' ;
