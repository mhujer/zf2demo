-- Adminer 3.5.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `salt` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

TRUNCATE `admins`;
INSERT INTO `admins` (`id`, `name`, `email`, `password`, `salt`, `last_login`) VALUES
(1,	'Martin Hujer',	'mhujer@gmail.com',	'ff89e52e554e0433b4f6d27cfe2d3e31ed6d1c98',	'2f40b628f3',	'2012-03-15 21:58:35');

CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `text` text COLLATE utf8_czech_ci NOT NULL,
  `published` datetime NOT NULL,
  `admins_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admins_id` (`admins_id`),
  KEY `published` (`published`),
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`admins_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

TRUNCATE `articles`;
INSERT INTO `articles` (`id`, `name`, `text`, `published`, `admins_id`) VALUES
(1,	'Dolor sit amet',	'<p>Suspendisse potenti. Maecenas eget sollicitudin neque. In dictum purus id diam feugiat interdum sed vel odio. Nullam euismod volutpat ante sed dictum. Aenean erat purus, blandit vitae faucibus nec, lobortis sit amet mauris. Cras vel lacus non orci aliquam vulputate. Morbi eget nisl nec ipsum gravida placerat nec ac nulla. Proin eget libero ipsum, vulputate suscipit dolor. Phasellus eleifend consectetur eleifend. Pellentesque bibendum hendrerit neque, quis fermentum arcu posuere vitae. Nunc metus eros, fringilla a euismod ut, porttitor ac purus. Vivamus vehicula justo quis mauris consequat sed accumsan massa ullamcorper. Vivamus sem mi, ullamcorper aliquet tempus sit amet, fermentum vel massa.</p>\r\n\r\n<!-- more -->\r\n\r\n<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam sit amet justo arcu, vel consequat libero. Duis risus elit, pretium eu tristique a, suscipit mollis ligula. Aenean et dui eu sapien accumsan aliquet ac ut odio. Etiam dapibus lacus elementum nibh consectetur pharetra. Nam pretium interdum ante, quis pharetra odio euismod in. Nam mi justo, aliquam vel condimentum vitae, porttitor vitae felis. Morbi vehicula lectus at nibh tempor dictum. Quisque auctor placerat odio, nec placerat risus cursus nec. Quisque lacus odio, vehicula sit amet interdum eu, dictum eu nibh. Mauris orci lacus, accumsan ac congue ut, pretium in lorem. Nunc pulvinar, sapien nec sodales hendrerit, tortor nulla accumsan quam, nec lobortis risus lacus suscipit odio. Etiam a consectetur enim.</p>',	'2011-12-15 16:08:43',	1),
(2,	'Lorem Ipsum',	'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in bibendum augue. Sed at pharetra dui. Nulla facilisi. Quisque laoreet orci sed magna rhoncus pulvinar. Etiam a enim ac magna venenatis aliquet non non nisl. Vestibulum turpis dolor, pulvinar sodales fermentum sit amet, bibendum ut leo. Vivamus posuere molestie nisl, vel dapibus elit ornare quis. Integer urna quam, blandit vitae consectetur vitae, aliquet eu nibh. Aliquam sit amet ligula magna. Pellentesque quis velit id urna aliquet hendrerit eu eget ligula. Quisque turpis magna, imperdiet et gravida pharetra, aliquet ut sem. Nam non malesuada lacus. Nulla nec ligula a nibh convallis porttitor. Vestibulum sed libero ipsum, eget iaculis nibh. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>\n\n<!-- more -->\n\n<p>Sed sit amet dui tellus. Quisque eget massa libero. Aliquam erat volutpat. Proin magna risus, vestibulum non sodales ac, egestas vel arcu. Aliquam commodo auctor enim, at vulputate sem rhoncus at. Vivamus purus felis, semper in facilisis at, lacinia in massa. Proin vitae libero ut ligula dignissim posuere et et velit. Etiam ac lacinia dolor. Aliquam vitae mollis lorem. Pellentesque in mi mauris. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut purus purus, ornare semper fermentum ac, auctor a tellus. Proin nec metus eget quam pretium cursus. Maecenas eu nulla eget leo ullamcorper commodo sit amet eu odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>',	'2011-12-16 16:08:38',	1),
(3,	'Dolor sit amet',	'<p>Suspendisse potenti. Maecenas eget sollicitudin neque. In dictum purus id diam feugiat interdum sed vel odio. Nullam euismod volutpat ante sed dictum. Aenean erat purus, blandit vitae faucibus nec, lobortis sit amet mauris. Cras vel lacus non orci aliquam vulputate. Morbi eget nisl nec ipsum gravida placerat nec ac nulla. Proin eget libero ipsum, vulputate suscipit dolor. Phasellus eleifend consectetur eleifend. Pellentesque bibendum hendrerit neque, quis fermentum arcu posuere vitae. Nunc metus eros, fringilla a euismod ut, porttitor ac purus. Vivamus vehicula justo quis mauris consequat sed accumsan massa ullamcorper. Vivamus sem mi, ullamcorper aliquet tempus sit amet, fermentum vel massa.</p>\r\n\r\n<!-- more -->\r\n\r\n<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam sit amet justo arcu, vel consequat libero. Duis risus elit, pretium eu tristique a, suscipit mollis ligula. Aenean et dui eu sapien accumsan aliquet ac ut odio. Etiam dapibus lacus elementum nibh consectetur pharetra. Nam pretium interdum ante, quis pharetra odio euismod in. Nam mi justo, aliquam vel condimentum vitae, porttitor vitae felis. Morbi vehicula lectus at nibh tempor dictum. Quisque auctor placerat odio, nec placerat risus cursus nec. Quisque lacus odio, vehicula sit amet interdum eu, dictum eu nibh. Mauris orci lacus, accumsan ac congue ut, pretium in lorem. Nunc pulvinar, sapien nec sodales hendrerit, tortor nulla accumsan quam, nec lobortis risus lacus suscipit odio. Etiam a consectetur enim.</p>',	'2011-12-17 16:08:43',	1),
(4,	'Dolor sit amet 2',	'<p>Suspendisse potenti. Maecenas eget sollicitudin neque. In dictum purus id diam feugiat interdum sed vel odio. Nullam euismod volutpat ante sed dictum. Aenean erat purus, blandit vitae faucibus nec, lobortis sit amet mauris. Cras vel lacus non orci aliquam vulputate. Morbi eget nisl nec ipsum gravida placerat nec ac nulla. Proin eget libero ipsum, vulputate suscipit dolor. Phasellus eleifend consectetur eleifend. Pellentesque bibendum hendrerit neque, quis fermentum arcu posuere vitae. Nunc metus eros, fringilla a euismod ut, porttitor ac purus. Vivamus vehicula justo quis mauris consequat sed accumsan massa ullamcorper. Vivamus sem mi, ullamcorper aliquet tempus sit amet, fermentum vel massa.</p>\n\n<!-- more -->\n\n<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam sit amet justo arcu, vel consequat libero. Duis risus elit, pretium eu tristique a, suscipit mollis ligula. Aenean et dui eu sapien accumsan aliquet ac ut odio. Etiam dapibus lacus elementum nibh consectetur pharetra. Nam pretium interdum ante, quis pharetra odio euismod in. Nam mi justo, aliquam vel condimentum vitae, porttitor vitae felis. Morbi vehicula lectus at nibh tempor dictum. Quisque auctor placerat odio, nec placerat risus cursus nec. Quisque lacus odio, vehicula sit amet interdum eu, dictum eu nibh. Mauris orci lacus, accumsan ac congue ut, pretium in lorem. Nunc pulvinar, sapien nec sodales hendrerit, tortor nulla accumsan quam, nec lobortis risus lacus suscipit odio. Etiam a consectetur enim.</p>',	'2011-12-12 16:08:43',	1),
(5,	'Lorem Ipsum 2',	'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in bibendum augue. Sed at pharetra dui. Nulla facilisi. Quisque laoreet orci sed magna rhoncus pulvinar. Etiam a enim ac magna venenatis aliquet non non nisl. Vestibulum turpis dolor, pulvinar sodales fermentum sit amet, bibendum ut leo. Vivamus posuere molestie nisl, vel dapibus elit ornare quis. Integer urna quam, blandit vitae consectetur vitae, aliquet eu nibh. Aliquam sit amet ligula magna. Pellentesque quis velit id urna aliquet hendrerit eu eget ligula. Quisque turpis magna, imperdiet et gravida pharetra, aliquet ut sem. Nam non malesuada lacus. Nulla nec ligula a nibh convallis porttitor. Vestibulum sed libero ipsum, eget iaculis nibh. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>\n\n<!-- more -->\n\n<p>Sed sit amet dui tellus. Quisque eget massa libero. Aliquam erat volutpat. Proin magna risus, vestibulum non sodales ac, egestas vel arcu. Aliquam commodo auctor enim, at vulputate sem rhoncus at. Vivamus purus felis, semper in facilisis at, lacinia in massa. Proin vitae libero ut ligula dignissim posuere et et velit. Etiam ac lacinia dolor. Aliquam vitae mollis lorem. Pellentesque in mi mauris. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut purus purus, ornare semper fermentum ac, auctor a tellus. Proin nec metus eget quam pretium cursus. Maecenas eu nulla eget leo ullamcorper commodo sit amet eu odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>',	'2011-12-11 16:08:38',	1);

CREATE TABLE `articles_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `text` text COLLATE utf8_czech_ci NOT NULL,
  `commented_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `articles_comments_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

TRUNCATE `articles_comments`;
INSERT INTO `articles_comments` (`id`, `article_id`, `name`, `email`, `text`, `commented_on`) VALUES
(1,	3,	'Martin',	'mhujer@gmail.com',	'Vivamus vehicula justo quis mauris consequat sed accumsan massa ullamcorper. Vivamus sem mi, ullamcorper aliquet tempus sit amet, fermentum vel massa.',	'2011-12-20 21:54:21'),
(2,	3,	'A',	'mhujer@gmail.com',	'Test',	'0000-00-00 00:00:00'),
(3,	3,	'A',	'mhujer@gmail.com',	'AB',	'0000-00-00 00:00:00'),
(4,	3,	'A',	'mhujer@gmail.com',	'ABC',	'2012-04-12 15:48:11'),
(5,	3,	'A',	'mhujer@gmail.com',	'ABCD',	'2012-04-12 15:52:53'),
(6,	3,	'Martin',	'zfm@gmail.com',	'Test lorem komentÃ¡Å™',	'2012-04-12 21:39:55'),
(7,	3,	'AA',	'admin@shopio.cz',	'AA',	'2012-05-02 19:14:10'),
(8,	3,	'Shopio',	'mhujer@gmail.com',	'AA',	'2012-09-07 16:43:03'),
(9,	3,	'Shopio',	'mhujer@gmail.com',	'AA',	'2012-09-07 16:43:13'),
(10,	3,	'AB',	'test@shopio.cz',	'AB',	'2012-09-07 16:43:19'),
(11,	3,	'<b>a</b>ac',	'mhujer@gmail.com',	'AA',	'2012-09-07 17:28:38'),
(12,	3,	'aacD',	'mhujer@gmail.com',	'AA',	'2012-09-07 17:28:50'),
(13,	3,	'a',	'mhujer@gmail.com',	'AB',	'2012-09-13 13:01:20');

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `display_name` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `password` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

TRUNCATE `user`;
INSERT INTO `user` (`user_id`, `username`, `email`, `display_name`, `password`) VALUES
(1,	NULL,	'mhujer@gmail.com',	NULL,	'$2y$14$Bd80pNded2B6o4xS9nXxTeL5hEZ5nKcWMEW/wSqhS6yQgHkFzPEJG');

-- 2012-09-13 13:05:32
