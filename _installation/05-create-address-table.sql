CREATE TABLE IF NOT EXISTS `login`.`address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
   `Address1` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
   `Address2` varchar(120) COLLATE utf8_unicode_ci,
   `Address3` varchar(120) COLLATE utf8_unicode_ci,
    `City` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `State` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `Country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`address_id`),
  UNIQUE KEY `user_id` (`user_id`),
  FOREIGN KEY (`user_id`) references `users`(`user_id`)
  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='address data';
