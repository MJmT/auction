CREATE TABLE IF NOT EXISTS `login`.`orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id_hex` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `order_type` int(4) NOT NULL,
  `payment_verified` int(4) DEFAULT 0,
  
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `product_id` (`product_id`),
  FOREIGN KEY (`user_name`) REFERENCES users(`user_name`)
  	ON DELETE CASCADE
  	ON UPDATE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='order data';
