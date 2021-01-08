CREATE TABLE `user_accounts` (
  `id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(150) COLLATE 'utf8_unicode_ci' NOT NULL COMMENT 'User Email',
  `name` varchar(150) COLLATE 'utf8_unicode_ci' NOT NULL COMMENT 'User Full Name',
  `mobile` varchar(15) COLLATE 'utf8_unicode_ci' NOT NULL COMMENT 'User Mobile No',
  `password` varchar(255) COLLATE 'utf8_unicode_ci' NOT NULL COMMENT 'User Password',
  `profile` varchar(255) COLLATE 'utf8_unicode_ci' NULL COMMENT 'User Profile Img',
  `date_add` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'User account create date and time',
  `date_upd` datetime NULL COMMENT 'User account update date and time'
) ENGINE='InnoDB' COLLATE 'utf8_unicode_ci';

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(2) NOT NULL,
  `category_id` int(2) NOT NULL,
  `deleted` smallint(1) NOT NULL DEFAULT '0',
  `date_add` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_$
  `date_upd` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `product_images` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `product_id` int(10) NOT NULL,
  `image_name` varchar(150) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL
) ENGINE='InnoDB' COLLATE 'utf8_unicode_ci';

CREATE TABLE `product_categories` (
  `id` int(2) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category_name` varchar(150) COLLATE 'utf8_unicode_ci' NOT NULL,
  `date_add` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE='InnoDB' COLLATE 'utf8_unicode_ci';

CREATE TABLE `product_comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `product_id` int(10) NOT NULL,
  `name` varchar(150) COLLATE 'utf8_unicode_ci' NOT NULL,
  `email` varchar(150) COLLATE 'utf8_unicode_ci' NOT NULL,
  `comment` varchar(255) COLLATE 'utf8_unicode_ci' NOT NULL,
  `date_add` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_upd` datetime NULL
) ENGINE='InnoDB' COLLATE 'utf8_unicode_ci';