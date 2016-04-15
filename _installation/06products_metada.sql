CREATE TABLE IF NOT EXISTS `login`.`products_metadata` (
  `product_id` int(11) NOT NULL,
  `product_start` DATETIME,
  `product_expiry` DATETIME,
  `product_auction_start` DATETIME,
  `product_auction_end` DATETIME,
  
  PRIMARY KEY (`product_id`)
  
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='product metadata';

DELIMITER $$

CREATE TRIGGER IF NOT EXISTS `after_product_insert`
	AFTER INSERT ON `products`
	FOR EACH ROW
	BEGIN
	INSERT INTO `products_metadata`(`product_id`,`product_start`,`product_expiry`)
		VALUES((SELECT MAX(product_id) from products), NOW(), DATE_ADD(NOW(),INTERVAL 7 DAY));
	END$$

DELIMITER ;	