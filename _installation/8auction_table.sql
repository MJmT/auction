CREATE TABLE IF NOT EXISTS `login`.`auctions` (

`product_id` int(11) NOT NULL,
`current_highest_bid` int(11) UNSIGNED NOT NULL,
`previous_highest_bid` int(11) UNSIGNED NOT NULL,
`current_bid_user` int(11) UNSIGNED NOT NULL,
`previous_bid_user` int(11) UNSIGNED NOT NULL,
 PRIMARY KEY (`product_id`),
 FOREIGN KEY (`product_id`) REFERENCES products(`product_id`)
 ON DELETE CASCADE
 ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='auction table';