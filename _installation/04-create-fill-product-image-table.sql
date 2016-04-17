CREATE TABLE IF NOT EXISTS `login`.`product_images` (
	 `product_id` int(11) NOT NULL COMMENT 'auto incrementing product_id of each product, unique index',
	 `product_image_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'product_image_name unique',
	 `product_image`  mediumblob NOT NULL COMMENT 'product image unique',
	 PRIMARY KEY (`product_id`),
	 FOREIGN KEY (`product_id`) REFERENCES products(`product_id`)
	 ON DELETE CASCADE
	 ON UPDATE CASCADE
	 )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='product data';