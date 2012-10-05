-- CREATE DATABASE `kultura`;
USE `kultura`;

DROP TABLE `event`;
CREATE TABLE `event` (
`event_id` INT PRIMARY KEY,
`venue_id` INT,
`when` DATETIME,
`url` TEXT,
`title` TEXT,
`description` TEXT,
`entry` TEXT,
`flyer` TEXT
);

DROP TABLE `venue`;
CREATE TABLE `venue` (
venue_id INT PRIMARY KEY,
title TEXT,
url TEXT,
lat INT,
lng INT
);
