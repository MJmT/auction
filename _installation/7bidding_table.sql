CREATE TABLE IF NOT EXISTS `login`.`bids` (
`user_id` int(11) UNSIGNED NOT NULL,
`user_bid_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`product_id` int(11) UNSIGNED NOT NULL,
`bid_amount` int(11) UNSIGNED NOT NULL,
`bid_time` DATETIME,

 PRIMARY KEY(`user_bid_id`,`user_id`,`product_id`),

 FOREIGN KEY (`product_id`) REFERENCES products(`product_id`)
 ON DELETE CASCADE
 ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='bidding table';