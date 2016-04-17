CREATE TABLE IF NOT EXISTS `login`.`products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing product_id of each product, unique index',
  `product_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'product''s name, unique',
  `product_id_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'product''s id hash in salted and hashed format',
  `product_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'product''s title',
  `product_description` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'product''s description',
  `product_bid_price` int(10) NOT NULL COMMENT 'product bid price',
  `product_max_price`  int(10) NOT NULL COMMENT 'product max price',
   `category_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_name` (`product_name`),
  FOREIGN KEY (`category_name`) REFERENCES categories(`category_name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='product data';
