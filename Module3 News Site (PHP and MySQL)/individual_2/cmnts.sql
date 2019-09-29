mysql> show create table cmnts;
+-------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Table | Create Table                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
+-------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| cmnts | CREATE TABLE `cmnts` (
  `cmnt_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `author` mediumint(8) unsigned NOT NULL,
  `story` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`cmnt_id`),
  KEY `author` (`author`),
  KEY `story` (`story`),
  CONSTRAINT `cmnts_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`),
  CONSTRAINT `cmnts_ibfk_2` FOREIGN KEY (`story`) REFERENCES `stories` (`story_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 |
+-------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
1 row in set (0.00 sec)