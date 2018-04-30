##############
SQL FOR PRODUCT TABLE
##############
CREATE TABLE IF NOT EXISTS `product` (
  `pID` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `pDesc` text COLLATE utf8_unicode_ci,
  `pPrice` decimal(10,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`pID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


**************
CREATE ORDER
**************

** normally an order table would include a user id as a column, but in this instance it does not **


CREATE TABLE IF NOT EXISTS `order` (
  `oID` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `p_id` smallint(3) unsigned DEFAULT NULL,
  `p_qty` smallint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`oID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;