CREATE TABLE IF NOT EXISTS `login`.`products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing product_id of each product, unique index',
  `product_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'product''s name, unique',
  `product_id_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'product''s id hash in salted and hashed format',
  `product_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'product''s title',
  `product_description` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'product''s description',
  `product_price` float(10) NOT NULL COMMENT 'product price',
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_name` (`product_name`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='product data';
