CREATE TABLE IF NOT EXISTS `login`.`categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `category_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL ,
  `parent_id` int(11) NOT NULL,
  `category_description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='category data';
