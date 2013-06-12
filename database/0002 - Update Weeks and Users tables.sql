SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Update weeks table
ALTER TABLE  `weeks`
  ADD  `month` INT NOT NULL AFTER  `end` ;

-- Update users table
ALTER TABLE  `users`
  ADD  `name` VARCHAR(255) NOT NULL AFTER  `password` ,
  ADD  `salary` INT NOT NULL AFTER  `name` ;

ALTER TABLE  `users`
  CHANGE  `id`  `id` INT(11) NOT NULL AUTO_INCREMENT ;

-- Update reported_hours table
ALTER TABLE `reported_hours`
  ADD FOREIGN KEY (`user_id`)
  REFERENCES `users`(`id`)
  ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `reported_hours`
  ADD FOREIGN KEY (`project_id`)
  REFERENCES `projects`(`id`)
  ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `reported_hours`
  ADD FOREIGN KEY (`week_id`)
  REFERENCES `weeks`(`id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

-- View for reporte de costos
CREATE
 ALGORITHM = UNDEFINED
 VIEW `weekly_cost`
 AS SELECT
  p.id AS project_id,
  p.name AS project,
  w.month,
  w.begin AS week_begin,
  w.end AS week_end,
  u.id AS user_id,
  u.name AS developer,
  rh.hours * ((u.salary * (13/12) * 1.3) / 40) AS weekly_cost
FROM reported_hours rh
  JOIN users u ON rh.user_id = u.id
  JOIN projects p ON rh.project_id = p.id
  JOIN weeks w ON rh.week_id = w.id ;
