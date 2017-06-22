# SQL Manager 2005 Lite for MySQL 3.7.7.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : ptm


SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the `ci_sessions` table : 
#

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Structure for the `companies` table : 
#

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id_company` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` text,
  `company_description` text,
  PRIMARY KEY (`id_company`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Structure for the `inventories` table : 
#

DROP TABLE IF EXISTS `inventories`;

CREATE TABLE `inventories` (
  `id_inventory` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `inventory_category_id` int(11) NOT NULL,
  `inventory_mark` text NOT NULL,
  `inventory_model` text NOT NULL,
  `inventory_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inventory_quantity` int(11) DEFAULT NULL,
  `inventory_buy_price` float DEFAULT NULL,
  `inventory_description` text,
  PRIMARY KEY (`id_inventory`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

#
# Structure for the `inventories_categories` table : 
#

DROP TABLE IF EXISTS `inventories_categories`;

CREATE TABLE `inventories_categories` (
  `id_inventory_category` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `inventory_category_name` text NOT NULL,
  PRIMARY KEY (`id_inventory_category`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

#
# Structure for the `kardexes` table : 
#

DROP TABLE IF EXISTS `kardexes`;

CREATE TABLE `kardexes` (
  `id_kardex` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) NOT NULL,
  `kardex_code` text NOT NULL,
  `kardex_serial` text NOT NULL,
  `kardex_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kardex_start_date` date NOT NULL,
  PRIMARY KEY (`id_kardex`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

#
# Structure for the `kardexes_status` table : 
#

DROP TABLE IF EXISTS `kardexes_status`;

CREATE TABLE `kardexes_status` (
  `id_kardex_status` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `kardex_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `maintenance_id` int(11) DEFAULT NULL,
  `kardex_status_value` enum('en funcionamiento - nuevo','en funcionamiento - bueno','en funcionamiento - regular','en funcionamiento - tiende a malo','inactivo/respaldo - bueno','inactivo/respaldo - regular','inactivo/respaldo - tiende a malo','nuevo en almacen','en reparacion - regular','en reparacion - tiende a malo','baja') NOT NULL,
  `kardex_status_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kardex_status_register_date` date DEFAULT NULL,
  `kardex_status_description` text,
  PRIMARY KEY (`id_kardex_status`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

#
# Structure for the `locations` table : 
#

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `location_name` text NOT NULL,
  `location_description` text,
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

#
# Structure for the `login_attempts` table : 
#

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Structure for the `maintenances` table : 
#

DROP TABLE IF EXISTS `maintenances`;

CREATE TABLE `maintenances` (
  `id_maintenance` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `location_id` int(11) NOT NULL,
  `maintenance_register_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `maintenance_description` text NOT NULL,
  PRIMARY KEY (`id_maintenance`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

#
# Structure for the `members` table : 
#

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `object_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `member_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_select_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Structure for the `modules` table : 
#

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_label` text,
  `module_name` text,
  `module_uri` text,
  `module_order_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Structure for the `posts` table : 
#

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `post_type_selectable_id` int(11) DEFAULT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_status_date` int(11) DEFAULT NULL,
  `post_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_is_private` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

#
# Structure for the `projects` table : 
#

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `post_id` int(11) NOT NULL,
  `project_start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `project_end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `priority_select_id` int(11) DEFAULT NULL,
  `project_percent_completed` float(9,1) NOT NULL DEFAULT '0.0',
  `project_points` int(11) DEFAULT '0',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Structure for the `role_privileges` table : 
#

DROP TABLE IF EXISTS `role_privileges`;

CREATE TABLE `role_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `privilege_id` int(11) DEFAULT NULL,
  `role_privileges_status` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=624 DEFAULT CHARSET=latin1;

#
# Structure for the `roles` table : 
#

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `role_type` text,
  `role_name` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

#
# Structure for the `selectables` table : 
#

DROP TABLE IF EXISTS `selectables`;

CREATE TABLE `selectables` (
  `id_selectable` int(11) NOT NULL AUTO_INCREMENT,
  `selectable_value` text,
  `selectable_column_name` text,
  `selectable_sub_group` char(4) DEFAULT NULL,
  `selectable_order_by` int(11) DEFAULT NULL,
  `selectable_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_selectable`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

#
# Structure for the `tasks` table : 
#

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `post_id` int(11) NOT NULL,
  `task_start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `task_end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `priority_select_id` int(11) DEFAULT NULL,
  `task_percent_completed` float(9,1) NOT NULL DEFAULT '0.0',
  `task_points` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Structure for the `user_autologin` table : 
#

DROP TABLE IF EXISTS `user_autologin`;

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Structure for the `user_posts` table : 
#

DROP TABLE IF EXISTS `user_posts`;

CREATE TABLE `user_posts` (
  `id_user_post` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `action_status_select_id` int(11) DEFAULT NULL,
  `user_post_register_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_post_sorter` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user_post`)
) ENGINE=MyISAM AUTO_INCREMENT=4852 DEFAULT CHARSET=latin1;

#
# Structure for the `user_profiles` table : 
#

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `name` text COLLATE utf8_bin,
  `last_name` text COLLATE utf8_bin,
  `language` enum('english','spanish') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Structure for the `user_roles` table : 
#

DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `id_user_role` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_role_status` text,
  PRIMARY KEY (`id_user_role`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

#
# Structure for the `users` table : 
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Data for the `inventories` table  (LIMIT 0,500)
#

INSERT INTO `inventories` (`id_inventory`, `post_id`, `inventory_category_id`, `inventory_mark`, `inventory_model`, `inventory_register_date`, `inventory_quantity`, `inventory_buy_price`, `inventory_description`) VALUES 
  (6,NULL,6,'HEWLETT PACKARD','PROLIANT ML 350 G6','2017-05-19 20:23:51',NULL,NULL,NULL),
  (7,NULL,7,'DAHUA','S/R','2017-05-19 20:37:55',NULL,NULL,NULL),
  (8,NULL,8,'CISCO','SF100-24V2','2017-05-19 20:39:31',NULL,NULL,NULL),
  (9,NULL,6,'DELL','POWER EDGE 2900','2017-05-19 20:42:59',NULL,NULL,NULL),
  (10,NULL,9,'ACER','  V173','2017-05-19 20:49:28',NULL,NULL,NULL),
  (11,NULL,8,'SISCO','PSZ20171A93','2017-05-19 20:50:52',NULL,NULL,NULL),
  (12,NULL,10,'DELTA','GES1-13R202035','2017-05-22 13:07:29',NULL,NULL,NULL),
  (13,NULL,10,'DELTA','S/R','2017-05-22 13:24:49',NULL,NULL,NULL),
  (14,NULL,11,'LG','32LK330','2017-05-22 14:50:06',NULL,NULL,NULL),
  (15,NULL,12,'HEWLETT PACKARD','L1710','2017-05-22 15:06:24',NULL,NULL,NULL),
  (16,NULL,13,'NUMBER PLATE','S/R','2017-05-22 15:08:56',NULL,NULL,NULL),
  (17,NULL,6,'DELL','QUAD CORE 3.2 GHZ. T20','2017-05-22 15:41:34',NULL,NULL,NULL),
  (18,NULL,14,'HEWLETT PACKARD','COMPAQ DC5700','2017-05-22 15:46:16',NULL,NULL,NULL),
  (19,NULL,15,'EPSON','TM-T88V M244A','2017-05-22 15:57:01',NULL,NULL,NULL),
  (20,NULL,8,'CISCO','CISSF110-24-NA','2017-05-22 16:01:07',NULL,NULL,NULL),
  (21,NULL,16,'FOXCONN','','2017-05-22 16:24:08',NULL,NULL,NULL),
  (22,NULL,14,'ACER','VERITON','2017-05-24 15:01:22',NULL,NULL,NULL),
  (23,NULL,7,'HIKVISION','DS-7208HQHI-F1/N','2017-06-01 23:18:28',NULL,NULL,NULL),
  (24,NULL,17,'HIKVISION','DS-2CE16C0T-IT5','2017-06-01 23:22:28',NULL,NULL,NULL),
  (25,NULL,17,'VICOM','VIR-30NG-4N1-1MP','2017-06-01 23:26:15',NULL,NULL,NULL),
  (26,NULL,8,'SISCO','CISSF110-24-NA','2017-06-04 23:34:24',NULL,NULL,NULL),
  (27,NULL,6,'DELL','T130','2017-06-04 23:36:18',NULL,NULL,NULL),
  (28,NULL,16,'FOXCONN','31sddfsdTX','2017-06-15 10:59:42',NULL,NULL,NULL),
  (29,NULL,16,'FOXCONN','TSXSDSD2333','2017-06-15 11:02:54',NULL,NULL,NULL);

COMMIT;

#
# Data for the `inventories_categories` table  (LIMIT 0,500)
#

INSERT INTO `inventories_categories` (`id_inventory_category`, `post_id`, `inventory_category_name`) VALUES 
  (6,NULL,'SERVIDOR'),
  (7,NULL,'DVR'),
  (8,NULL,'SWITCH'),
  (9,NULL,'MONITOR'),
  (10,NULL,'BANCO DE BATERIAS'),
  (11,NULL,'Monitor TV'),
  (12,NULL,'MONITOR LCD 17'''''),
  (13,NULL,'CAMARA DE RECONOCIMIENTO'),
  (14,NULL,'Equipo PC torre'),
  (15,NULL,'IMPRESORA TERMICA'),
  (16,NULL,'NANO PC'),
  (17,NULL,'CAMARA EXTERNA');

COMMIT;

#
# Data for the `kardexes` table  (LIMIT 0,500)
#

INSERT INTO `kardexes` (`id_kardex`, `post_id`, `inventory_id`, `kardex_code`, `kardex_serial`, `kardex_register_date`, `kardex_start_date`) VALUES 
  (14,NULL,6,'24312000233','MXQ9370678','2017-05-19 20:23:51','0000-00-00'),
  (15,NULL,7,'24350000026','S/R','2017-05-19 20:37:55','0000-00-00'),
  (16,NULL,8,'24350000075','PSZ185119VL','2017-05-19 20:39:31','0000-00-00'),
  (17,NULL,9,'24312000232','BLXWKH1','2017-05-19 20:42:59','0000-00-00'),
  (18,NULL,10,'24312000119','ETLE10D0929260D8078602','2017-05-19 20:49:28','0000-00-00'),
  (19,NULL,11,'24350000106','CISSF110-24-NA','2017-05-19 20:50:52','0000-00-00'),
  (20,NULL,12,'24312000235','A0Y09700131WE','2017-05-22 13:07:29','0000-00-00'),
  (21,NULL,13,'24312000236','S/R','2017-05-22 13:24:49','0000-00-00'),
  (22,NULL,14,'24350000002','107RMWV0X929','2017-05-22 14:50:06','0000-00-00'),
  (23,NULL,15,'24312000137','3CQ9343G2T','2017-05-22 15:06:24','0000-00-00'),
  (24,NULL,16,'24370000101','S/R','2017-05-22 15:08:56','0000-00-00'),
  (25,NULL,16,'24370000102','S/R','2017-05-22 15:09:28','0000-00-00'),
  (26,NULL,17,'24312000305','8SFQ772','2017-05-22 15:41:34','0000-00-00'),
  (27,NULL,18,'24312000038','MXJ81604R1','2017-05-22 15:46:16','0000-00-00'),
  (28,NULL,19,'4312000619','MXFF341431','2017-05-22 15:57:01','0000-00-00'),
  (29,NULL,20,'24350000101','PSZ19071B57','2017-05-22 16:01:07','0000-00-00'),
  (30,NULL,21,'','THF11F020550900484','2017-05-22 16:24:08','0000-00-00'),
  (31,NULL,22,'24312000017','PS00819669936000310100','2017-05-24 15:01:22','0000-00-00'),
  (32,NULL,17,'24312000303','J9FQ772','2017-05-24 16:03:44','0000-00-00'),
  (33,NULL,23,'','696005196','2017-06-04 23:18:28','0000-00-00'),
  (34,NULL,24,'','636473875','2017-06-04 23:22:28','0000-00-00'),
  (35,NULL,25,'','22MAR16003823','2017-06-04 23:26:15','0000-00-00'),
  (36,NULL,26,'24350000100','','2017-06-04 23:34:24','0000-00-00'),
  (37,NULL,27,'4312000229','','2017-06-04 23:36:18','0000-00-00'),
  (38,NULL,21,'24312000293','','2017-06-04 23:55:25','0000-00-00'),
  (39,NULL,21,'24312000289','','2017-06-04 23:56:33','0000-00-00'),
  (40,NULL,28,'6464655','646465','2017-06-15 10:59:42','0000-00-00'),
  (41,NULL,29,'667897','233SDD','2017-06-15 11:02:54','0000-00-00');

COMMIT;

#
# Data for the `kardexes_status` table  (LIMIT 0,500)
#

INSERT INTO `kardexes_status` (`id_kardex_status`, `post_id`, `kardex_id`, `location_id`, `maintenance_id`, `kardex_status_value`, `kardex_status_timestamp`, `kardex_status_register_date`, `kardex_status_description`) VALUES 
  (25,NULL,14,2,NULL,'en funcionamiento - regular','2017-05-19 20:23:51','2017-05-19',''),
  (26,NULL,15,2,NULL,'en funcionamiento - regular','2017-05-19 20:37:55','2017-05-19',''),
  (27,NULL,16,2,NULL,'en funcionamiento - regular','2017-05-19 20:39:31','2017-05-19',''),
  (28,NULL,17,2,NULL,'en funcionamiento - regular','2017-05-19 20:42:59','2017-05-19',''),
  (29,NULL,17,2,29,'inactivo/respaldo - regular','2017-05-19 20:45:57','2017-05-19',NULL),
  (30,NULL,14,2,29,'inactivo/respaldo - regular','2017-05-19 20:45:57','2017-05-19',NULL),
  (31,NULL,18,1,NULL,'en funcionamiento - regular','2017-05-19 20:49:28','2017-05-19',''),
  (32,NULL,19,1,NULL,'en funcionamiento - nuevo','2017-05-19 20:50:52','2017-05-19',''),
  (33,NULL,19,1,30,'en funcionamiento - bueno','2017-05-19 20:51:33','2017-05-19',NULL),
  (34,NULL,19,1,31,'en funcionamiento - bueno','2017-05-19 20:56:17','2017-05-19',NULL),
  (35,NULL,18,1,31,'en funcionamiento - regular','2017-05-19 20:56:17','2017-05-19',NULL),
  (36,NULL,16,2,32,'en funcionamiento - regular','2017-05-19 20:58:09','2017-05-19',NULL),
  (37,NULL,18,1,33,'en funcionamiento - regular','2017-05-19 21:19:42','2017-05-19',NULL),
  (38,NULL,20,2,NULL,'en funcionamiento - regular','2017-05-22 13:07:29','2017-05-22',''),
  (39,NULL,21,2,NULL,'en funcionamiento - regular','2017-05-22 13:24:49','2017-05-22',''),
  (40,NULL,22,2,NULL,'en funcionamiento - regular','2017-05-22 14:50:06','2017-05-22',''),
  (41,NULL,23,2,NULL,'en funcionamiento - regular','2017-05-22 15:06:24','2017-05-22',''),
  (42,NULL,24,2,NULL,'en funcionamiento - regular','2017-05-22 15:08:56','2017-05-22',''),
  (43,NULL,25,2,NULL,'en funcionamiento - regular','2017-05-22 15:09:28','2017-05-22',''),
  (44,NULL,26,3,NULL,'en funcionamiento - regular','2017-05-22 15:41:34','2017-05-22',''),
  (45,NULL,27,25,NULL,'en funcionamiento - regular','2017-05-22 15:46:16','2017-05-22',''),
  (46,NULL,28,25,NULL,'en funcionamiento - regular','2017-05-22 15:57:01','2017-05-22',''),
  (47,NULL,29,3,NULL,'en funcionamiento - regular','2017-05-22 16:01:07','2017-05-22',''),
  (48,NULL,29,3,34,'en funcionamiento - regular','2017-05-22 16:04:27','2017-04-06',NULL),
  (49,NULL,26,3,34,'en funcionamiento - regular','2017-05-22 16:04:27','2017-04-06',NULL),
  (50,NULL,30,13,NULL,'en funcionamiento - regular','2017-05-22 16:24:08','2017-05-20',''),
  (51,NULL,30,13,35,'en funcionamiento - regular','2017-05-22 16:25:47','2017-05-20',NULL),
  (52,NULL,31,2,NULL,'en funcionamiento - regular','2017-05-23 15:01:22','2017-05-23',''),
  (53,NULL,31,58,36,'en funcionamiento - regular','2017-05-23 15:23:38','2017-05-23',NULL),
  (54,NULL,32,2,NULL,'en funcionamiento - nuevo','2017-05-24 16:03:44','2017-05-16',''),
  (55,NULL,32,2,29,'en funcionamiento - bueno','2017-05-19 02:00:00','2017-05-19',NULL),
  (57,NULL,33,53,NULL,'en funcionamiento - nuevo','2017-06-01 23:18:28','2017-06-01',''),
  (58,NULL,34,50,NULL,'en funcionamiento - nuevo','2017-06-01 23:22:28','2017-06-01','720P, IR distance 80m, DC 12V, 5W MAX'),
  (59,NULL,35,50,NULL,'en funcionamiento - nuevo','2017-06-01 23:26:15','2017-06-01','IR Waterproof Camera, LEN: 2.8mm, SYSTEM: NTSC, Power: DC12V/210mA, CCTV'),
  (60,NULL,36,53,NULL,'en funcionamiento - nuevo','2017-06-04 23:34:24','2017-06-01',''),
  (61,NULL,37,53,NULL,'en funcionamiento - nuevo','2017-06-04 23:36:18','2017-06-01',''),
  (62,NULL,35,50,39,'en funcionamiento - nuevo','2017-06-01 23:45:40','2017-06-01',NULL),
  (63,NULL,34,50,39,'en funcionamiento - nuevo','2017-06-01 23:45:40','2017-06-01',NULL),
  (64,NULL,37,53,40,'en funcionamiento - nuevo','2017-06-01 23:49:04','2017-06-01',NULL),
  (65,NULL,36,53,40,'en funcionamiento - nuevo','2017-06-01 23:49:04','2017-06-01',NULL),
  (66,NULL,33,53,40,'en funcionamiento - nuevo','2017-06-01 23:49:04','2017-06-01',NULL),
  (67,NULL,38,12,NULL,'en funcionamiento - nuevo','2017-06-04 23:55:25','2017-05-29',''),
  (68,NULL,39,23,NULL,'en funcionamiento - nuevo','2017-06-04 23:56:33','2017-05-29',''),
  (69,NULL,38,12,41,'en funcionamiento - nuevo','2017-05-28 23:58:03','2017-05-28',NULL),
  (70,NULL,39,23,42,'en funcionamiento - nuevo','2017-05-29 00:00:19','2017-05-28',NULL),
  (71,NULL,40,16,NULL,'en funcionamiento - nuevo','2017-06-15 10:59:42','2017-06-15',''),
  (72,NULL,40,16,44,'en funcionamiento - nuevo','2017-06-15 11:00:49','2017-06-15',NULL),
  (73,NULL,40,16,45,'en funcionamiento - nuevo','2017-06-15 11:01:20','2017-06-15',NULL),
  (74,NULL,41,62,NULL,'en funcionamiento - nuevo','2017-06-15 11:02:54','2017-06-15',''),
  (75,NULL,41,62,46,'en funcionamiento - nuevo','2017-06-15 11:03:31','2017-06-15',NULL);

COMMIT;

#
# Data for the `locations` table  (LIMIT 0,500)
#

INSERT INTO `locations` (`id_location`, `parent_id`, `location_name`, `location_description`) VALUES 
  (1,NULL,'ORLP',''),
  (2,1,'Autopista',''),
  (3,1,'Achica Arriba',''),
  (4,1,'Patacamaya A',''),
  (5,1,'Patacamaya B',''),
  (6,1,'Sica Sica',''),
  (7,1,'Urujara',''),
  (8,1,'Corapata',''),
  (9,1,'Laja',''),
  (10,2,'Autopista, carril1',NULL),
  (11,2,'Autopista, carril2',NULL),
  (12,2,'Autopista, carril3',NULL),
  (13,3,'Achica Arriba, carril1',NULL),
  (14,7,'Autopista, Dormitorio',NULL),
  (15,1,'ORLP, Oficina RRHH',NULL),
  (16,15,'ORLP, Escritorio Servicios General',NULL),
  (17,2,'Autopista, carril4',NULL),
  (18,2,'Autopista, carril5',NULL),
  (19,2,'Autopista, carril4',NULL),
  (20,2,'Autopista, carril5',NULL),
  (21,2,'Autopista, carril6',NULL),
  (22,2,'Autopista, carril7',NULL),
  (23,2,'Autopista, carril8',NULL),
  (24,3,'Achica Arriba, carril2',NULL),
  (25,3,'Achica Arriba, carril3',NULL),
  (28,4,'Patacamaya A, Carril2',NULL),
  (30,7,'Urujara, Carril1',NULL),
  (33,7,'Urujara, Carril2',NULL),
  (34,8,'Corapata, Carril1',NULL),
  (36,5,'Patacamaya B, Carril1',NULL),
  (39,5,'Patacamaya B, Carril2',NULL),
  (40,5,'Patacamaya B, Carril3',NULL),
  (42,8,'Corapata, carril2',NULL),
  (44,9,'Laja, Carril1',NULL),
  (47,9,'Laja, Carril2',NULL),
  (48,9,'Laja, Carril3',NULL),
  (50,6,'Sica Sica, carril1',NULL),
  (51,6,'Sica Sica, carril2',NULL),
  (52,7,'Urujara, Oficina',NULL),
  (53,6,'Sica Sica, Oficina',NULL),
  (54,5,'Patacamaya B, Oficina',NULL),
  (55,4,'Patacamaya A,, oficina',NULL),
  (56,9,'Laja, oficina',NULL),
  (57,8,'Corapata, oficina',NULL),
  (58,2,'Autopista, oficina',NULL),
  (59,3,'Achica Arriba, oficina',NULL),
  (60,15,'ORLP, Escritorio RRHH',NULL),
  (61,15,'ORLP, Escritorio Asistente RRHH',NULL),
  (62,15,'ORLP, Escritorio, Asistente Servicios Generales',NULL),
  (63,1,'ORLP, oficina RAF',NULL),
  (64,63,'ORLP, Escritorio RAF',NULL),
  (65,63,'ORLP, Escritorio Contaduria',NULL),
  (66,63,'ORLP, Escritorio Ventanilla Unica',NULL);

COMMIT;

#
# Data for the `maintenances` table  (LIMIT 0,500)
#

INSERT INTO `maintenances` (`id_maintenance`, `post_id`, `location_id`, `maintenance_register_date`, `maintenance_description`) VALUES 
  (29,NULL,2,'2017-05-19 20:45:57','Reemplazo por equipo Nuevo'),
  (30,NULL,1,'2017-05-19 20:51:33','Se instalo en reemplado de equipo antiguo'),
  (31,NULL,1,'2017-05-19 20:56:17','Limpieza de equipos'),
  (32,NULL,2,'2017-05-19 20:58:09','Cambio de Patch Cores'),
  (33,NULL,1,'2017-05-19 21:19:42','Limpieza general'),
  (34,NULL,3,'2017-04-06 16:04:27','Instalacion y/o recambio de equipo SERVIDOR y SWITCH CISCO'),
  (35,NULL,13,'2017-05-20 16:25:47','correccion de falla de rosetas por version atigua de WIN_SISCAP en carril 1, reten de Achica Arriba'),
  (36,NULL,58,'2017-05-23 16:00:00','En equipo SUPERVISOR Se reinstalo sistema operativo Ubuntu con windows7 virtualizado y paquetes ofimanticos'),
  (38,NULL,6,'2017-06-01','Cambio de cableado de red de Oficina y los 2 Carriles'),
  (39,NULL,50,'2017-06-02','Instalacion de 2 camaras Externas\r\n'),
  (40,NULL,53,'2017-06-02','Cambio/Instalacion de SERVIDOR, SWITCH\r\n DVR de equipos Viejos por equipos NUEVOS'),
  (41,NULL,12,'2017-05-29','Instalacion de NANO PC en Carril'),
  (42,NULL,23,'2017-05-29','Instalacion de NANO PC en Carril'),
  (43,NULL,59,'2017-05-29','En equipo SUPERVISOR Se reinstalo sistema operativo Ubuntu con windows7 virtualizado y paquetes ofimanticos'),
  (44,NULL,16,'2017-06-15','Reinstalacion de sistema operativo'),
  (45,NULL,16,'2017-06-15','Reinstalacion de sistema operativo con windows 8'),
  (46,NULL,62,'2017-06-15','Reinstalacion de OFFICE 2010'),
  (47,NULL,1,'2017-06-19',''),
  (48,NULL,1,'2017-06-19',''),
  (49,NULL,1,'2017-06-19',''),
  (50,NULL,1,'2017-06-19',''),
  (51,NULL,1,'2017-06-19',''),
  (52,NULL,1,'2017-06-19',''),
  (53,NULL,1,'2017-06-19',''),
  (54,NULL,1,'2017-06-19',''),
  (55,NULL,1,'2017-06-19',''),
  (56,NULL,1,'2017-06-19','adfasd'),
  (57,NULL,1,'2017-06-19','asfsdaf'),
  (58,NULL,1,'2017-06-19','asdf'),
  (59,NULL,2,'2017-06-22','asdfasdf'),
  (60,NULL,2,'2017-06-22','asdfasd'),
  (61,NULL,2,'2017-06-22','asdfasdf'),
  (62,NULL,2,'2017-06-22','asdfsdf'),
  (63,NULL,2,'2017-06-22','asdfasdf asdfasdf'),
  (64,NULL,2,'2017-06-22','asdf asdfadsf'),
  (65,NULL,2,'2017-06-22','asdfasdf asdfasdf'),
  (66,NULL,2,'2017-06-22','asdf asdfasd asdf'),
  (67,NULL,2,'2017-06-22','asdfsdf asdfasdf'),
  (68,NULL,2,'2017-06-22','asdfasd asdfasdf asdfasdf'),
  (69,NULL,2,'2017-06-22','asdf asdfasdfasd asdf'),
  (70,NULL,2,'2017-06-22','assdf sdfasdf asdfasdf');

COMMIT;

#
# Data for the `posts` table  (LIMIT 0,500)
#

INSERT INTO `posts` (`id_post`, `parent_id`, `project_id`, `task_id`, `user_id`, `company_id`, `post_type_selectable_id`, `post_title`, `post_content`, `post_register_date`, `post_status_date`, `post_modified_date`, `post_is_private`) VALUES 
  (16,63,NULL,NULL,0,NULL,16,'Boom-camaras-seguridad-edificios-Angeles.jpg','','2017-06-22 01:07:09',2147483647,'2017-06-22 00:49:54',NULL),
  (17,64,NULL,NULL,0,NULL,16,'2105984_orig.jpg','','2017-06-22 01:07:11',2147483647,'2017-06-22 00:51:32',NULL),
  (18,65,NULL,NULL,0,NULL,16,'kithe.gif','','2017-06-22 01:07:13',2147483647,'2017-06-22 00:52:35',NULL),
  (19,66,NULL,NULL,0,NULL,16,'Camara-Domo.jpg','','2017-06-22 01:07:15',2147483647,'2017-06-22 00:55:06',NULL),
  (20,67,NULL,NULL,0,NULL,16,'tumblr_oazswzTJ3X1uuzehdo1_1280.jpg','','2017-06-22 01:07:19',2147483647,'2017-06-22 00:58:59',NULL),
  (21,68,NULL,NULL,0,NULL,16,'alumno_carrera_soporte.jpg','','2017-06-22 01:13:58',2147483647,'2017-06-22 01:12:01',NULL),
  (22,69,NULL,NULL,0,NULL,16,'mantenimiento-camara-amabato-f418bcd86d31916fcb4a31a64fff8387.jpg','','2017-06-22 01:13:47',2147483647,'2017-06-22 01:13:47',NULL),
  (23,70,NULL,NULL,0,NULL,16,'kithe.gif','','2017-06-22 01:38:28',2147483647,'2017-06-22 01:38:28',NULL);

COMMIT;

#
# Data for the `selectables` table  (LIMIT 0,500)
#

INSERT INTO `selectables` (`id_selectable`, `selectable_value`, `selectable_column_name`, `selectable_sub_group`, `selectable_order_by`, `selectable_description`) VALUES 
  (4,'valid','time_status',NULL,1,NULL),
  (5,'observed','time_status',NULL,2,NULL),
  (6,'corrected','time_status',NULL,3,NULL),
  (1,'in_menu','privilege_visibility',NULL,1,NULL),
  (2,'special','privilege_visibility',NULL,2,NULL),
  (3,'when_required','privilege_visibility',NULL,3,NULL),
  (11,'project','post_type',NULL,1,NULL),
  (12,'task','post_type',NULL,2,NULL),
  (13,'message','post_type',NULL,3,NULL),
  (15,'comment','post_type',NULL,5,NULL),
  (16,'file','post_type',NULL,6,NULL),
  (17,'time_record','post_type',NULL,7,NULL),
  (18,'fee','post_type',NULL,8,NULL),
  (19,'active','project_status',NULL,1,NULL),
  (20,'paused','project_status',NULL,3,NULL),
  (21,'completed','project_status',NULL,4,NULL),
  (22,'canceled','project_status',NULL,5,NULL),
  (23,'1','project_priority',NULL,1,'valid only projects and tasks'),
  (24,'2','project_priority',NULL,2,NULL),
  (25,'3','project_priority',NULL,3,NULL),
  (26,'4','project_priority',NULL,4,NULL),
  (27,'5','project_priority',NULL,5,NULL),
  (28,'6','project_priority',NULL,6,NULL),
  (29,'7','project_priority',NULL,7,NULL),
  (30,'8','project_priority',NULL,8,NULL),
  (31,'9','project_priority',NULL,9,NULL),
  (32,'10','project_priority',NULL,10,NULL),
  (14,'discussion','post_type',NULL,4,NULL),
  (33,'created','user_post_action_status','OB',1,'Created'),
  (34,'modified','user_post_action_status','OB',2,'Modified'),
  (35,'uploaded','user_post_action_status','OB',3,'Uploaded'),
  (36,'moved_to_trash','user_post_action_status','OB',4,'Moved to trash'),
  (37,'restored','user_post_action_status','OB',5,'Restored'),
  (49,'active','member_status',NULL,1,NULL),
  (50,'inactive','member_status',NULL,2,NULL),
  (51,'in_process','project_status',NULL,2,NULL),
  (52,'started','user_post_action_status','PR',6,NULL),
  (53,'completed','user_post_action_status','PR',7,NULL),
  (54,'started','user_post_action_status','TA',9,NULL),
  (55,'in_process','user_post_action_status','TA',10,NULL),
  (56,'paused','user_post_action_status','TA',11,NULL),
  (57,'completed','user_post_action_status','TA',12,NULL),
  (58,'created','user_post_action_status','TA',8,NULL);

COMMIT;

#
# Data for the `user_posts` table  (LIMIT 0,500)
#

INSERT INTO `user_posts` (`id_user_post`, `user_id`, `post_id`, `user_role_id`, `action_status_select_id`, `user_post_register_date`, `user_post_sorter`) VALUES 
  (4847,1,19,1,35,'2017-06-22 00:55:06',NULL),
  (4848,1,20,1,35,'2017-06-22 00:58:59',NULL),
  (4849,1,21,1,35,'2017-06-22 00:58:59',NULL),
  (4850,1,22,1,35,'2017-06-22 00:58:59',NULL),
  (4851,1,23,1,35,'2017-06-22 00:58:59',NULL);

COMMIT;

