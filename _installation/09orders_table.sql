CREATE TABLE IF NOT EXISTS `login`.`orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `payment_verified` int(4) DEFAULT 0,
  
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `product_id` (`product_id`),
  FOREIGN KEY (`user_name`) REFERENCES users(`user_name`)
  	ON DELETE CASCADE
  	ON UPDATE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='order data';
