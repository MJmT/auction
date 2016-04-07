CREATE TABLE IF NOT EXISTS `login`.`address` (
  `address_id` int(11) IDENTITY(1,1) NOT NULL,
  `user_id` int(11) NOT NULL,
   `Address1` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
   `Address2` varchar(120) COLLATE utf8_unicode_ci,
   `Address3` varchar(120) COLLATE utf8_unicode_ci,
    `City` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
