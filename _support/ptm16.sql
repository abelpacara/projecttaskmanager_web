# SQL Manager 2005 Lite for MySQL 3.7.7.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : ptm


SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the `ci_sessions` table : 
#

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Structure for the `inventories` table : 
#

CREATE TABLE `inventories` (
  `id_inventory` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_category_id` int(11) NOT NULL,
  `inventory_reference_code` text,
  `inventory_mark` text NOT NULL,
  `inventory_model` text NOT NULL,
  `inventory_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inventory_quantity` int(11) DEFAULT NULL,
  `inventory_buy_price` float DEFAULT NULL,
  `inventory_description` text,
  PRIMARY KEY (`id_inventory`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

#
# Structure for the `inventories_categories` table : 
#

CREATE TABLE `inventories_categories` (
  `id_inventory_category` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_category_name` text NOT NULL,
  PRIMARY KEY (`id_inventory_category`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

#
# Structure for the `kardexes` table : 
#

CREATE TABLE `kardexes` (
  `id_kardex` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) NOT NULL,
  `purchase_item_id` int(11) DEFAULT NULL,
  `kardex_code` text NOT NULL,
  `kardex_serial` text NOT NULL,
  `kardex_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kardex_start_date` date NOT NULL,
  `kardex_description` text,
  PRIMARY KEY (`id_kardex`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;

#
# Structure for the `kardexes_status` table : 
#

CREATE TABLE `kardexes_status` (
  `id_kardex_status` int(11) NOT NULL AUTO_INCREMENT,
  `kardex_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `maintenance_id` int(11) DEFAULT NULL,
  `kardex_status_value` enum('en funcionamiento - nuevo','en funcionamiento - bueno','en funcionamiento - regular','en funcionamiento - tiende a malo','inactivo/respaldo - bueno','inactivo/respaldo - regular','inactivo/respaldo - tiende a malo','nuevo en almacen','en reparacion - regular','en reparacion - tiende a malo',' en almacen/para reparacion','baja') NOT NULL,
  `kardex_status_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kardex_status_register_date` date DEFAULT NULL,
  `kardex_status_description` text,
  PRIMARY KEY (`id_kardex_status`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=latin1;

#
# Structure for the `locations` table : 
#

CREATE TABLE `locations` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `location_name` text NOT NULL,
  `location_type` enum('oficina - regional','estacion de peaje','carril',' oficina-estacion') DEFAULT NULL,
  `location_system_type` enum('SISCEP','SISCAP','SISSAP') DEFAULT NULL,
  `location_description` text,
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

#
# Structure for the `login_attempts` table : 
#

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

CREATE TABLE `maintenances` (
  `id_maintenance` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `maintenance_register_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `maintenance_description` text NOT NULL,
  PRIMARY KEY (`id_maintenance`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

#
# Structure for the `offices` table : 
#

CREATE TABLE `offices` (
  `id_office` int(11) NOT NULL AUTO_INCREMENT,
  `office_name` text,
  `office_shortname` text,
  `office_description` text,
  `office_status` text,
  PRIMARY KEY (`id_office`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Structure for the `orders` table : 
#

CREATE TABLE `orders` (
  `id_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `posts` table : 
#

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `post_type` enum('project','discussion','task','comment') NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Structure for the `purchases` table : 
#

CREATE TABLE `purchases` (
  `id_purchase` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_start_process_date` date DEFAULT NULL,
  `purchase_store_dateentry` date DEFAULT NULL,
  `purchase_name` text,
  `purchase_description` text,
  PRIMARY KEY (`id_purchase`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Structure for the `purchases_items` table : 
#

CREATE TABLE `purchases_items` (
  `id_purchase_item` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) DEFAULT NULL,
  `inventory_category_id` int(11) DEFAULT NULL,
  `purchase_item_quantity` int(11) DEFAULT NULL,
  `purchase_item_description` text,
  PRIMARY KEY (`id_purchase_item`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

#
# Structure for the `user_autologin` table : 
#

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Structure for the `user_profiles` table : 
#

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Structure for the `users` table : 
#

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Data for the `inventories` table  (LIMIT 0,500)
#

INSERT INTO `inventories` (`id_inventory`, `inventory_category_id`, `inventory_reference_code`, `inventory_mark`, `inventory_model`, `inventory_register_date`, `inventory_quantity`, `inventory_buy_price`, `inventory_description`) VALUES 
  (6,6,NULL,'HEWLETT PACKARD','PROLIANT ML 350 G6','2017-05-19 20:23:51',NULL,NULL,NULL),
  (7,7,NULL,'DAHUA','S/R','2017-05-19 20:37:55',NULL,NULL,NULL),
  (8,8,NULL,'CISCO','SF100-24V2','2017-05-19 20:39:31',NULL,NULL,NULL),
  (9,6,NULL,'DELL','POWER EDGE 2900','2017-05-19 20:42:59',NULL,NULL,NULL),
  (10,9,NULL,'ACER','  V173','2017-05-19 20:49:28',NULL,NULL,NULL),
  (11,8,NULL,'CISCO','PSZ20171A93','2017-11-10 10:36:13',NULL,NULL,NULL),
  (12,10,NULL,'DELTA','GES1-13R202035','2017-05-22 13:07:29',NULL,NULL,NULL),
  (13,10,NULL,'DELTA','S/R','2017-05-22 13:24:49',NULL,NULL,NULL),
  (14,11,NULL,'LG','32LK330','2017-05-22 14:50:06',NULL,NULL,NULL),
  (15,12,NULL,'HEWLETT PACKARD','L1710','2017-05-22 15:06:24',NULL,NULL,NULL),
  (16,13,NULL,'NUMBER PLATE','S/R','2017-05-22 15:08:56',NULL,NULL,NULL),
  (17,6,NULL,'DELL','QUAD CORE 3.2 GHZ. T20','2017-05-22 15:41:34',NULL,NULL,NULL),
  (18,14,NULL,'HEWLETT PACKARD','COMPAQ DC5700','2017-05-22 15:46:16',NULL,NULL,NULL),
  (19,15,NULL,'EPSON','TM-T88V M244A','2017-05-22 15:57:01',NULL,NULL,NULL),
  (20,8,NULL,'CISCO','CISSF110-24-NA','2017-05-22 16:01:07',NULL,NULL,NULL),
  (21,16,NULL,'FOXCONN','','2017-05-22 16:24:08',NULL,NULL,NULL),
  (22,14,NULL,'ACER','VERITON','2017-05-24 15:01:22',NULL,NULL,NULL),
  (23,7,NULL,'HIKVISION','DS-7208HQHI-F1/N','2017-06-01 23:18:28',NULL,NULL,NULL),
  (24,19,NULL,'HIKVISION','DS-2CE16C0T-IT5','2017-11-10 10:23:16',NULL,NULL,NULL),
  (25,19,NULL,'VICOM','VIR-30NG-4N1-1MP','2017-11-10 10:23:26',NULL,NULL,NULL),
  (27,6,NULL,'DELL','T130','2017-06-04 23:36:18',NULL,NULL,NULL),
  (28,16,NULL,'FOXCONN','NT-IBT19-A','2017-11-07 21:14:41',NULL,NULL,NULL),
  (29,14,NULL,'HEWLETT PACKARD','HP PRO 3130 MT','2017-11-07 21:19:19',NULL,NULL,NULL),
  (30,14,NULL,'DELL','VOSTRO 3250','2017-11-08 09:07:14',NULL,NULL,NULL),
  (31,14,NULL,'HEWLETT PACKARD','Pavilion A1514N','2017-11-08 10:34:08',NULL,NULL,NULL),
  (32,18,NULL,'HEWLETT PACKARD','HP COMPAQ DX2400 MICROTOWER','2017-11-08 11:06:07',NULL,NULL,NULL),
  (38,8,NULL,'D-LINK','','2017-11-10 15:40:43',NULL,NULL,NULL),
  (39,20,NULL,'','','2017-11-10 15:42:22',NULL,NULL,NULL),
  (40,6,NULL,'DELL','','2017-11-10 16:08:58',NULL,NULL,NULL),
  (41,22,NULL,'FORZA','SL-1012LCD-U','2017-11-10 16:26:21',NULL,NULL,NULL),
  (42,9,NULL,'SURE','','2017-11-10 16:27:38',NULL,NULL,NULL),
  (43,15,NULL,'EPSON','TM-T88V','2017-11-10 16:28:46',NULL,NULL,NULL),
  (44,23,NULL,'EBOX','D300','2017-11-10 16:35:56',NULL,NULL,NULL),
  (45,24,NULL,'ARGOX','AS-8020CL','2017-11-10 16:41:11',NULL,NULL,NULL),
  (46,18,NULL,'','','2017-11-10 17:03:43',NULL,NULL,NULL),
  (47,9,NULL,'','','2017-11-10 17:08:20',NULL,NULL,NULL),
  (48,25,NULL,'HEWLETT PACKARD','P1102w','2017-11-10 17:10:47',NULL,NULL,NULL),
  (49,23,NULL,'EBOX','','2017-11-10 18:39:07',NULL,NULL,NULL),
  (50,23,NULL,'EBOX','C800','2017-11-10 18:40:38',NULL,NULL,NULL),
  (51,9,NULL,'ACER','V173','2017-11-10 18:44:35',NULL,NULL,NULL),
  (52,22,NULL,'FORZA','FX1500LCD-U','2017-11-13 08:29:29',NULL,NULL,NULL),
  (53,9,NULL,'LENOVO','D186WA','2017-11-13 15:05:28',NULL,NULL,NULL),
  (54,13,'','','','2017-11-13 15:48:11',NULL,NULL,NULL),
  (55,14,'','','','2017-11-13 16:39:58',NULL,NULL,NULL),
  (56,8,'','CISCO','CISSF110-24','2017-11-13 18:00:41',NULL,NULL,NULL),
  (57,9,'','HEWLETT PACKARD','L1710','2017-11-14 19:55:47',NULL,NULL,NULL),
  (58,20,'','VICOM','GS738E','2017-11-14 20:01:44',NULL,NULL,NULL),
  (59,20,'','','EN-DVJ30-70','2017-11-14 20:05:33',NULL,NULL,NULL),
  (60,26,'','LENOVO','M700','2017-11-15 17:09:19',NULL,NULL,NULL),
  (61,9,NULL,'HEWLETT PACKARD','TS-17SV','2017-11-15 18:54:20',NULL,NULL,NULL),
  (62,25,NULL,'HEWLETT PACKARD','LASER JET P2015 dn','2017-11-24 12:17:44',NULL,NULL,NULL),
  (63,27,NULL,'SAMSUNG','LS19D300HY/ZS','2017-12-19 16:31:49',NULL,NULL,NULL),
  (64,8,NULL,'CISCO','SF110D-08','2017-12-28 12:09:51',NULL,NULL,NULL),
  (65,27,NULL,'SAMSUNG','S19D300NY','2017-12-28 14:02:10',NULL,NULL,NULL),
  (66,34,NULL,'VICOM','EN-VI50-60','2017-12-28 14:07:30',NULL,NULL,NULL),
  (67,7,NULL,'DAHUA','DHI-HCVR4108HS-S2','2017-12-28 14:29:09',NULL,NULL,NULL),
  (68,20,NULL,'DAHUA','DH-HAC-HDW1000MN','2017-12-28 16:38:39',NULL,NULL,NULL),
  (69,19,NULL,'HIKVISION','DS-2CE16COT-IT5','2017-12-28 17:02:15',NULL,NULL,NULL),
  (70,9,NULL,'SAMSUNG','S19D300HY','2017-12-28 17:16:47',NULL,NULL,NULL);

COMMIT;

#
# Data for the `inventories_categories` table  (LIMIT 0,500)
#

INSERT INTO `inventories_categories` (`id_inventory_category`, `inventory_category_name`) VALUES 
  (6,'SERVIDOR'),
  (7,'DVR'),
  (8,'SWITCH'),
  (9,'MONITOR'),
  (10,'BANCO DE BATERIAS'),
  (11,'Monitor TV'),
  (12,'MONITOR LCD 17'''''),
  (13,'CAMARA DE RECONOCIMIENTO'),
  (14,'Equipo PC torre'),
  (15,'IMPRESORA TERMICA'),
  (16,'NANO PC'),
  (18,'CPU torre'),
  (19,'CAMARA EXTERNA HD'),
  (20,'CAMARA INTERNA'),
  (22,'UPS'),
  (23,'MINI PC'),
  (24,'LECTOR DE CODIGO DE BARRAS'),
  (25,'IMPRESORA LASER'),
  (26,'SMALL FACTOR PC'),
  (27,'MONITOR LED 19'),
  (28,'MONITOR TOUCH 15'),
  (29,'DVR 8 puertos, HD, full HD'),
  (30,'CAMARA EXTERNA FULL HD'),
  (31,'TELEVISOR LED 40'),
  (32,'ESCANER DE ALTO TRAFICO'),
  (33,'IMPRESORA DE ETIQUETAS AUTOHADESIVAS'),
  (34,'CAMARA DE VIGILANCIA');

COMMIT;

#
# Data for the `kardexes` table  (LIMIT 0,500)
#

INSERT INTO `kardexes` (`id_kardex`, `parent_id`, `inventory_id`, `purchase_item_id`, `kardex_code`, `kardex_serial`, `kardex_register_date`, `kardex_start_date`, `kardex_description`) VALUES 
  (14,NULL,6,NULL,'24312000233','MXQ9370678','2017-05-19 20:23:51','0000-00-00',NULL),
  (15,NULL,7,NULL,'24350000026','S/R','2017-05-19 20:37:55','0000-00-00',NULL),
  (16,NULL,8,NULL,'24350000075','PSZ185119VL','2017-05-19 20:39:31','0000-00-00',NULL),
  (17,NULL,9,NULL,'24312000232','BLXWKH1','2017-05-19 20:42:59','0000-00-00',NULL),
  (18,NULL,10,NULL,'24312000119','ETLE10D0929260D8078602','2017-05-19 20:49:28','0000-00-00',NULL),
  (19,NULL,11,NULL,'24350000106','CISSF110-24-NA','2017-05-19 20:50:52','0000-00-00',NULL),
  (20,NULL,12,NULL,'24312000235','A0Y09700131WE','2017-05-22 13:07:29','0000-00-00',NULL),
  (21,NULL,13,NULL,'24312000236','S/R','2017-05-22 13:24:49','0000-00-00',NULL),
  (22,NULL,14,NULL,'24350000002','107RMWV0X929','2017-05-22 14:50:06','0000-00-00',NULL),
  (23,NULL,15,NULL,'24312000137','3CQ9343G2T','2017-05-22 15:06:24','0000-00-00',NULL),
  (24,NULL,16,NULL,'24370000101','S/R','2017-05-22 15:08:56','0000-00-00',NULL),
  (25,NULL,16,NULL,'24370000102','S/R','2017-05-22 15:09:28','0000-00-00',NULL),
  (26,NULL,17,NULL,'24312000305','8SFQ772','2017-05-22 15:41:34','0000-00-00',NULL),
  (27,NULL,18,NULL,'24312000038','MXJ81604R1','2017-05-22 15:46:16','0000-00-00',NULL),
  (28,NULL,19,NULL,'24312000312','MXDF726046','2017-05-22 15:57:01','0000-00-00',NULL),
  (29,NULL,20,NULL,'24350000101','PSZ19071B57','2017-05-22 16:01:07','0000-00-00',NULL),
  (30,NULL,21,NULL,'','THF11F020550900484','2017-05-22 16:24:08','0000-00-00',NULL),
  (31,NULL,22,NULL,'24312000017','PS00819669936000310100','2017-05-24 15:01:22','0000-00-00',NULL),
  (32,NULL,17,NULL,'24312000303','J9FQ772','2017-05-24 16:03:44','0000-00-00',NULL),
  (33,NULL,23,NULL,'','696005196','2017-06-04 23:18:28','0000-00-00',NULL),
  (34,NULL,24,NULL,'','636473875','2017-06-04 23:22:28','0000-00-00',NULL),
  (36,NULL,20,NULL,'24350000100','','2017-06-04 23:34:24','0000-00-00',NULL),
  (37,NULL,27,NULL,'4312000229','','2017-06-04 23:36:18','0000-00-00',NULL),
  (38,NULL,21,NULL,'24312000293','','2017-06-04 23:55:25','0000-00-00',NULL),
  (39,NULL,21,NULL,'24312000289','34344fff','2017-06-04 23:56:33','2017-11-09',NULL),
  (41,NULL,28,NULL,'04312000698','','2017-11-07 21:15:31','0000-00-00',NULL),
  (42,NULL,29,NULL,'2431200025','','2017-11-07 21:19:19','0000-00-00',NULL),
  (43,NULL,30,NULL,'24312000298','','2017-11-08 09:07:15','0000-00-00',NULL),
  (44,NULL,28,NULL,'24312000290','','2017-11-08 09:40:12','0000-00-00',NULL),
  (45,NULL,31,NULL,'24312000028','','2017-11-08 10:34:09','0000-00-00',NULL),
  (46,NULL,22,NULL,'24312000018','PS008158668410008D0100 ','2017-11-08 10:46:16','0000-00-00',NULL),
  (47,NULL,32,NULL,'24312000021','','2017-11-08 11:06:07','0000-00-00',NULL),
  (48,NULL,30,NULL,'24312000296','','2017-11-08 12:05:18','0000-00-00',NULL),
  (49,NULL,25,NULL,'','22MAR16003823','2017-11-10 10:21:24','0000-00-00',NULL),
  (50,NULL,23,NULL,'','696005222','2017-11-10 11:25:05','0000-00-00',NULL),
  (51,NULL,24,NULL,'','636473871','2017-11-10 11:31:37','0000-00-00',NULL),
  (72,NULL,38,NULL,'','','2017-11-10 15:40:43','0000-00-00',NULL),
  (73,NULL,39,NULL,'','','2017-11-10 15:42:22','0000-00-00',NULL),
  (74,NULL,40,NULL,'','','2017-11-10 16:08:58','0000-00-00',NULL),
  (75,NULL,41,NULL,'','','2017-11-10 16:26:21','0000-00-00',NULL),
  (76,NULL,21,NULL,'','','2017-11-10 16:27:11','0000-00-00',NULL),
  (77,NULL,42,NULL,'','','2017-11-10 16:27:38','0000-00-00',NULL),
  (78,NULL,43,NULL,'','','2017-11-10 16:28:46','0000-00-00',NULL),
  (79,NULL,44,NULL,'','','2017-11-10 16:35:56','0000-00-00',NULL),
  (80,NULL,42,NULL,'','','2017-11-10 16:36:33','0000-00-00',NULL),
  (81,NULL,43,NULL,'','','2017-11-10 16:39:23','0000-00-00',NULL),
  (82,NULL,45,NULL,'','','2017-11-10 16:41:11','0000-00-00',NULL),
  (83,NULL,39,NULL,'','','2017-11-10 16:52:39','0000-00-00',NULL),
  (84,NULL,41,NULL,'','','2017-11-10 16:53:37','0000-00-00',NULL),
  (85,NULL,41,NULL,'','','2017-11-10 16:59:39','0000-00-00',NULL),
  (86,NULL,41,NULL,'','','2017-11-10 17:02:35','0000-00-00',NULL),
  (87,NULL,46,NULL,'','','2017-11-10 17:03:43','0000-00-00',NULL),
  (88,NULL,47,NULL,'','','2017-11-10 17:08:20','0000-00-00',NULL),
  (89,NULL,48,NULL,'','','2017-11-10 17:10:47','0000-00-00',NULL),
  (91,NULL,50,NULL,'24312000326','10D3D77020B1716025AM','2017-11-10 18:40:38','2017-09-17',NULL),
  (92,NULL,41,NULL,'24312000278','','2017-11-10 18:42:15','0000-00-00',NULL),
  (93,NULL,51,NULL,'04312000037','','2017-11-10 18:44:35','0000-00-00',NULL),
  (94,NULL,43,NULL,'','MXDF417599','2017-11-10 19:05:57','0000-00-00',NULL),
  (95,NULL,45,NULL,'VIAS-1-LCB-0005','30752124','2017-11-10 19:10:55','0000-00-00',NULL),
  (96,NULL,39,NULL,'24370000158','','2017-11-13 08:21:26','0000-00-00',NULL),
  (97,NULL,39,NULL,'24370000125','PI130410DVJ014','2017-11-13 08:25:13','0000-00-00',NULL),
  (98,NULL,52,NULL,'04312000521','63131130161','2017-11-13 08:29:29','0000-00-00',NULL),
  (99,NULL,43,NULL,'24312000244','MXDF606897','2017-11-13 08:31:06','0000-00-00',NULL),
  (100,NULL,45,NULL,'24312000261','50367181','2017-11-13 08:34:49','0000-00-00',NULL),
  (101,NULL,50,NULL,'24312000329','10D3D77020B17160205M','2017-11-13 14:57:33','2017-11-15',NULL),
  (103,NULL,53,NULL,'44312000133','V264599','2017-11-13 15:08:03','0000-00-00',NULL),
  (104,NULL,24,NULL,'','636473888','2017-11-13 15:47:22','2017-07-26',NULL),
  (105,NULL,54,NULL,'','','2017-11-13 15:48:11','0000-00-00',NULL),
  (107,NULL,23,NULL,'','696005221','2017-11-13 16:34:52','2017-07-25',NULL),
  (108,NULL,55,NULL,'','','2017-11-13 16:39:58','0000-00-00',NULL),
  (109,NULL,40,NULL,'24312000302','3QBHQD2','2017-11-13 17:59:17','2017-05-10',NULL),
  (110,NULL,56,NULL,'','','2017-11-13 18:00:41','0000-00-00',NULL),
  (111,NULL,47,NULL,'','','2017-11-13 18:02:37','0000-00-00',NULL),
  (112,NULL,48,NULL,'24312000252','BRBSH517D1','2017-11-13 18:03:21','2016-04-01',NULL),
  (113,NULL,41,NULL,'','','2017-11-13 18:04:11','2017-01-01',NULL),
  (114,NULL,41,NULL,'24312000277','431605301006','2017-11-13 18:08:01','2017-01-01',NULL),
  (115,NULL,50,NULL,'24312000324','10D3D77020B1716026FM','2017-11-14 19:53:25','2017-10-30',NULL),
  (116,NULL,57,NULL,'24312000103','3CQ9331H2N','2017-11-14 19:55:47','2017-01-01',NULL),
  (117,NULL,45,NULL,'24312000258','50367180','2017-11-14 19:59:03','2017-01-01',NULL),
  (118,NULL,58,NULL,'24370000043','01CX321A8120157','2017-11-14 20:01:44','2014-08-05',NULL),
  (119,NULL,59,NULL,'24370000129','PI130410DVJ029','2017-11-14 20:05:33','2014-08-05',NULL),
  (120,NULL,43,NULL,'04312000762','MXDF534564','2017-11-14 20:09:34','2015-12-22',NULL),
  (121,NULL,60,NULL,'','','2017-11-15 17:09:19','2017-09-01',NULL),
  (122,NULL,50,1,'24312000393','','2017-11-15 18:20:13','2017-09-22','<strong>CAMBIAR CODIGO PORQUE PERTENE A UN small factor pc</strong>\r\n'),
  (123,NULL,61,0,'24312000182','TS17028769','2017-11-15 18:54:20','2014-08-05',''),
  (124,NULL,41,0,'24312000283','431603301471','2017-11-15 18:58:39','2017-11-11',''),
  (125,NULL,43,0,'04312000761','MXDF534586','2017-11-15 19:00:27','2015-12-08',''),
  (126,NULL,18,0,'24312000038','MXJ81604R1','2017-11-15 19:05:46','2014-08-05',''),
  (127,NULL,57,0,'24312000099','3CQ9331FXT','2017-11-15 19:07:11','2014-08-05',''),
  (128,NULL,45,7,'24312000318','60853443','2017-11-15 19:10:29','2017-09-22','<p>VERIFICAR FECHA DE COMPRA</p>\r\n'),
  (129,NULL,39,0,'24370000040','','2017-11-17 08:30:12','2014-05-08',''),
  (130,NULL,62,0,'24312000010','JPCFS00105','2017-11-24 12:17:44','2017-10-15',''),
  (131,0,28,0,'04312000470','THF11F050543500467','2017-12-12 17:37:43','2017-01-01',''),
  (132,0,28,0,'24312000292','THF121050554500040','2017-12-12 17:56:21','2017-06-01',''),
  (133,0,43,0,'24312000314','MXDF726036','2017-12-12 20:09:02','2017-08-14','<p><span class=\"marker\">NO ASIGNADO</span></p>\r\n'),
  (134,79,63,0,'','ZZE4H4LGB03910P','2017-12-19 16:31:49','2017-12-19','<p>NO ESTABA CODIFICADO</p>\r\n'),
  (135,0,64,0,'24350000108','PSZ19041HPF','2017-12-28 12:09:51','2017-01-01','<p>DAR DE BAJA porque despues de un cierto tiempo se conflictua, y se cuelga</p>\r\n'),
  (136,0,50,0,'24312000415','10D3D7020B17330203M','2017-12-28 12:13:50','2017-12-26',''),
  (137,0,50,0,'24312000422','\t10D3D7020B17330222M','2017-12-28 12:16:52','2017-12-19','<p>Se reemplazo al anterior equipo porque se quemo, a causa de tormentas electricas en la zona</p>\r\n'),
  (138,0,65,0,'04312000676','ZZ8GH4LG301100A','2017-12-28 14:02:11','2017-01-01',''),
  (139,0,66,0,'24370000080','NK300N-2011-10','2017-12-28 14:07:30','2017-01-01','<p>MODELO ANTIGUO</p>\r\n'),
  (140,0,67,0,'','1F023B7PALK983M','2017-12-28 14:29:09','2017-01-01',''),
  (141,0,68,0,'24370000202','1E002E4PAR00441','2017-12-28 16:38:39','2017-11-16',''),
  (142,0,69,0,'24350000138','700018379','2017-12-28 17:02:15','2017-11-16',''),
  (143,0,20,0,'24350000105','PSZ201719U8','2017-12-28 17:03:58','2017-11-16',''),
  (144,0,23,0,'24350000135','764433596','2017-12-28 17:11:03','2017-11-16',''),
  (145,0,41,0,'24312000429','170743500144','2017-12-28 17:15:00','2017-11-16',''),
  (146,144,70,0,'24312000370','ZZE4H4LGA10044K','2017-12-28 17:16:47','2017-11-16',''),
  (147,0,50,0,'24312000418','10D3D7020B1733023FM','2017-12-30 13:30:03','2017-12-29','<p>Reemplazo al equipo MINI PC por problemas en el cooler y en el sistema operativo</p>\r\n'),
  (148,144,68,0,'24370000209','1E002E4PAR00758','2017-12-30 13:39:42','2017-12-29','<p>Fue enviado para reemplazo de la camara interna que tuvo problemas de enfoque y color blanco/negro</p>\r\n'),
  (149,0,43,0,'04312000619','MXFF341431','2018-01-05 20:46:51','2017-01-01',''),
  (150,0,43,0,'24312000406','MXDF 732322','2018-01-05 20:49:06','2018-01-05','');

COMMIT;

#
# Data for the `kardexes_status` table  (LIMIT 0,500)
#

INSERT INTO `kardexes_status` (`id_kardex_status`, `kardex_id`, `location_id`, `maintenance_id`, `kardex_status_value`, `kardex_status_timestamp`, `kardex_status_register_date`, `kardex_status_description`) VALUES 
  (25,14,2,NULL,'en funcionamiento - regular','2017-05-19 20:23:51','2017-05-19',''),
  (26,15,2,NULL,'en funcionamiento - regular','2017-05-19 20:37:55','2017-05-19',''),
  (27,16,2,NULL,'en funcionamiento - regular','2017-05-19 20:39:31','2017-05-19',''),
  (28,17,2,NULL,'en funcionamiento - regular','2017-05-19 20:42:59','2017-05-19',''),
  (29,17,2,29,'inactivo/respaldo - regular','2017-05-19 20:45:57','2017-05-19',''),
  (30,14,2,29,'inactivo/respaldo - regular','2017-05-19 20:45:57','2017-05-19',''),
  (31,18,1,NULL,'en funcionamiento - regular','2017-05-19 20:49:28','2017-05-19',''),
  (32,19,1,NULL,'en funcionamiento - nuevo','2017-05-19 20:50:52','2017-05-19',''),
  (33,19,1,30,'en funcionamiento - bueno','2017-05-19 20:51:33','2017-05-19',''),
  (34,19,1,31,'en funcionamiento - bueno','2017-05-19 20:56:17','2017-05-19',''),
  (35,18,1,31,'en funcionamiento - regular','2017-05-19 20:56:17','2017-05-19',''),
  (36,16,2,32,'en funcionamiento - regular','2017-05-19 20:58:09','2017-05-19',''),
  (37,18,1,33,'en funcionamiento - regular','2017-05-19 21:19:42','2017-05-19',''),
  (38,20,2,NULL,'en funcionamiento - regular','2017-05-22 13:07:29','2017-05-22',''),
  (39,21,2,NULL,'en funcionamiento - regular','2017-05-22 13:24:49','2017-05-22',''),
  (40,22,2,NULL,'en funcionamiento - regular','2017-05-22 14:50:06','2017-05-22',''),
  (41,23,2,NULL,'en funcionamiento - regular','2017-05-22 15:06:24','2017-05-22',''),
  (42,24,2,NULL,'en funcionamiento - regular','2017-05-22 15:08:56','2017-05-22',''),
  (43,25,2,NULL,'en funcionamiento - regular','2017-05-22 15:09:28','2017-05-22',''),
  (44,26,3,NULL,'en funcionamiento - regular','2017-05-22 15:41:34','2017-05-22',''),
  (45,27,25,NULL,'en funcionamiento - regular','2017-05-22 15:46:16','2017-05-22',''),
  (46,28,25,NULL,'en funcionamiento - regular','2017-05-22 15:57:01','2017-09-22',''),
  (47,29,3,NULL,'en funcionamiento - regular','2017-05-22 16:01:07','2017-05-22',''),
  (48,29,3,34,'en funcionamiento - regular','2017-05-22 16:04:27','2017-04-06',''),
  (49,26,3,34,'en funcionamiento - regular','2017-05-22 16:04:27','2017-04-06',''),
  (50,30,13,NULL,'en funcionamiento - regular','2017-05-22 16:24:08','2017-05-20',''),
  (51,30,13,35,'en funcionamiento - regular','2017-05-22 16:25:47','2017-05-20',''),
  (52,31,2,NULL,'en funcionamiento - regular','2017-05-23 15:01:22','2017-05-23',''),
  (53,31,58,36,'en funcionamiento - regular','2017-05-23 15:23:38','2017-05-23',''),
  (54,32,2,NULL,'en funcionamiento - nuevo','2017-05-24 16:03:44','2017-05-16',''),
  (55,32,2,29,'en funcionamiento - bueno','2017-05-19 02:00:00','2017-05-19',''),
  (57,33,53,NULL,'en funcionamiento - nuevo','2017-06-01 23:18:28','2017-06-01',''),
  (58,34,50,NULL,'en funcionamiento - nuevo','2017-06-01 23:22:28','2017-06-01',''),
  (59,35,50,NULL,'en funcionamiento - nuevo','2017-06-01 23:26:15','2017-06-01',''),
  (60,36,53,NULL,'en funcionamiento - nuevo','2017-06-04 23:34:24','2017-06-01',''),
  (61,37,53,NULL,'en funcionamiento - nuevo','2017-06-04 23:36:18','2017-06-01',''),
  (63,34,50,39,'en funcionamiento - nuevo','2017-06-01 23:45:40','2017-06-01',''),
  (64,37,53,40,'en funcionamiento - nuevo','2017-06-01 23:49:04','2017-06-01',''),
  (65,36,53,40,'en funcionamiento - nuevo','2017-06-01 23:49:04','2017-06-01',''),
  (66,33,53,40,'en funcionamiento - nuevo','2017-06-01 23:49:04','2017-06-01',''),
  (67,38,12,NULL,'en funcionamiento - nuevo','2017-06-04 23:55:25','2017-05-29',''),
  (68,39,61,NULL,'en funcionamiento - nuevo','2017-06-04 23:56:33','2017-01-09',''),
  (69,38,12,41,'en funcionamiento - nuevo','2017-05-28 23:58:03','2017-05-28',''),
  (70,39,23,42,'en funcionamiento - nuevo','2017-05-29 00:00:19','2017-05-28',''),
  (71,41,16,NULL,'en funcionamiento - regular','2017-11-07 21:15:31','2017-01-12',''),
  (72,42,66,NULL,'en funcionamiento - regular','2017-11-07 21:19:19','2017-01-18',''),
  (73,43,64,NULL,'en funcionamiento - bueno','2017-11-08 09:07:15','2017-11-08',''),
  (74,44,61,NULL,'en funcionamiento - regular','2017-11-08 09:40:13','2017-01-10',''),
  (75,45,62,NULL,'en funcionamiento - tiende a malo','2017-11-08 10:34:09','2017-11-08',''),
  (76,46,15,NULL,'en funcionamiento - regular','2017-11-08 10:46:16','2017-01-12',''),
  (77,47,63,NULL,'en funcionamiento - regular','2017-11-08 11:06:07','2017-01-06',''),
  (78,48,65,NULL,'en funcionamiento - nuevo','2017-11-08 12:05:18','2017-01-09',''),
  (79,49,6,NULL,'en funcionamiento - nuevo','2017-11-10 10:21:24','2017-06-01',''),
  (80,50,55,NULL,'en funcionamiento - nuevo','2017-11-10 11:25:05','2017-07-04',''),
  (81,51,69,NULL,'en funcionamiento - nuevo','2017-11-10 11:31:37','2017-07-04',''),
  (102,72,55,NULL,'en funcionamiento - regular','2017-11-10 15:40:44','2017-01-01',''),
  (103,73,69,NULL,'en funcionamiento - regular','2017-11-10 15:42:22','2017-01-01',''),
  (104,74,55,NULL,'en funcionamiento - nuevo','2017-07-04 16:08:59','2017-07-04',''),
  (105,75,69,NULL,'en funcionamiento - bueno','2017-11-10 16:26:21','2017-01-01',''),
  (106,76,69,NULL,'en funcionamiento - regular','2017-11-10 16:27:11','2017-01-01',''),
  (107,77,69,NULL,'en funcionamiento - regular','2017-11-10 16:27:38','2017-01-01',''),
  (108,78,69,NULL,'en funcionamiento - regular','2017-11-10 16:28:46','2017-01-01',''),
  (109,79,28,NULL,'en funcionamiento - regular','2017-11-10 16:35:56','2017-01-01',''),
  (110,80,28,NULL,'en funcionamiento - regular','2017-11-10 16:36:33','2017-01-01',''),
  (111,81,28,NULL,'en funcionamiento - regular','2017-11-10 16:39:23','2017-01-01',''),
  (112,82,28,NULL,'','2017-11-10 16:41:11','2017-01-01',''),
  (113,83,28,NULL,'en funcionamiento - regular','2017-11-10 16:52:39','2017-01-01',''),
  (114,84,28,NULL,'en funcionamiento - regular','2017-11-10 16:53:37','2017-01-01',''),
  (115,85,55,NULL,'en funcionamiento - bueno','2017-11-10 16:59:39','2017-01-01',''),
  (116,86,55,NULL,'inactivo/respaldo - regular','2017-11-10 17:02:35','2017-01-04',''),
  (117,87,55,NULL,'en funcionamiento - regular','2017-11-10 17:03:43','2017-01-03',''),
  (118,88,55,NULL,'en funcionamiento - regular','2017-11-10 17:08:20','2017-01-03',''),
  (119,89,55,NULL,'en funcionamiento - nuevo','2017-11-10 17:10:47','2017-07-04',''),
  (121,91,36,NULL,'en funcionamiento - nuevo','2017-11-10 18:40:38','2017-09-17',''),
  (122,92,36,NULL,'en funcionamiento - bueno','2017-11-10 18:42:15','2017-01-04',''),
  (123,93,36,NULL,'en funcionamiento - regular','2017-11-10 18:44:35','2017-01-04',''),
  (124,94,36,NULL,'en funcionamiento - bueno','2017-11-10 19:05:57','2017-10-01',''),
  (125,95,36,NULL,'en funcionamiento - regular','2017-11-10 19:10:55','2017-01-01',''),
  (126,96,36,NULL,'en funcionamiento - regular','2017-11-13 08:21:26','2017-01-01',''),
  (127,97,39,NULL,'en funcionamiento - regular','2017-11-13 08:25:13','2017-01-01',''),
  (128,98,39,NULL,'en funcionamiento - regular','2017-11-13 08:29:29','2017-01-01',''),
  (129,99,39,NULL,'en funcionamiento - regular','2017-11-13 08:31:06','2017-11-13',''),
  (130,100,39,NULL,'en funcionamiento - regular','2017-11-13 08:34:49','2017-01-01',''),
  (131,101,39,NULL,'en funcionamiento - nuevo','2017-11-13 14:57:33','2017-11-15',''),
  (133,103,39,NULL,'en funcionamiento - regular','2017-11-13 15:08:03','2017-01-01',''),
  (134,104,39,NULL,'en funcionamiento - nuevo','2017-11-13 15:47:22','2017-07-26',''),
  (135,105,39,NULL,'en funcionamiento - tiende a malo','2017-11-13 15:48:11','2017-01-01',''),
  (137,107,54,NULL,'en funcionamiento - nuevo','2017-11-13 16:34:52','2017-07-25',''),
  (138,108,54,NULL,'en funcionamiento - regular','2017-11-13 16:39:58','2017-01-01',''),
  (139,109,54,NULL,'en funcionamiento - nuevo','2017-11-13 17:59:17','2017-05-10',''),
  (140,110,54,NULL,'en funcionamiento - nuevo','2017-11-13 18:00:41','2017-05-10',''),
  (141,111,54,NULL,'en funcionamiento - nuevo','2017-11-13 18:02:38','2017-01-01',''),
  (142,112,54,NULL,'en funcionamiento - regular','2017-11-13 18:03:21','2016-04-01',''),
  (143,113,54,NULL,'en funcionamiento - nuevo','2017-11-13 18:04:11','2017-01-01',''),
  (144,114,25,NULL,'en funcionamiento - regular','2017-11-13 18:08:01','2017-01-01',''),
  (145,115,25,NULL,'en funcionamiento - nuevo','2017-11-14 19:53:26','2017-10-30',''),
  (146,116,25,NULL,'en funcionamiento - regular','2017-11-14 19:55:47','2017-01-01',''),
  (147,117,25,NULL,'en funcionamiento - regular','2017-11-14 19:59:03','2017-01-01',''),
  (148,118,25,NULL,'en funcionamiento - regular','2017-11-14 20:01:44','2014-08-05',''),
  (149,119,13,NULL,'en funcionamiento - regular','2017-11-14 20:05:33','2014-08-05',''),
  (150,120,13,NULL,'en funcionamiento - regular','2017-11-14 20:09:34','2015-12-22',''),
  (151,121,72,NULL,'en funcionamiento - nuevo','2017-11-15 17:09:19','2017-09-01',''),
  (152,122,13,NULL,'en funcionamiento - nuevo','2017-11-15 18:20:13','2017-09-22',''),
  (153,123,13,NULL,'en funcionamiento - regular','2017-11-15 18:54:20','2014-08-05',''),
  (154,124,24,NULL,'en funcionamiento - bueno','2017-11-15 18:58:39','2017-11-11',''),
  (155,125,24,NULL,'en funcionamiento - regular','2017-11-15 19:00:27','2015-12-08',''),
  (156,126,24,NULL,'en funcionamiento - regular','2017-11-15 19:05:46','2014-08-05',''),
  (157,127,24,NULL,'en funcionamiento - regular','2017-11-15 19:07:11','2014-08-05',''),
  (158,128,24,NULL,'en funcionamiento - nuevo','2017-11-15 19:10:29','2017-09-22',''),
  (159,129,24,NULL,'en funcionamiento - tiende a malo','2017-11-17 08:30:12','2014-05-08',''),
  (160,130,15,NULL,'en funcionamiento - tiende a malo','2017-11-24 12:17:44','2017-10-15',NULL),
  (161,130,74,44,' en almacen/para reparacion','2017-11-24 12:32:50','0000-00-00',NULL),
  (162,131,24,NULL,'en funcionamiento - regular','2017-12-12 17:37:43','2017-01-01',NULL),
  (163,132,25,NULL,'en funcionamiento - regular','2017-12-12 17:56:21','2017-06-01',NULL),
  (164,133,39,NULL,'en funcionamiento - nuevo','2017-12-12 20:09:02','2017-08-14',NULL),
  (165,134,28,NULL,'','2017-12-19 16:31:49','2017-12-19',NULL),
  (166,135,75,NULL,'inactivo/respaldo - tiende a malo','2017-12-28 12:09:51','2017-01-01',NULL),
  (167,136,23,NULL,'en funcionamiento - nuevo','2017-12-28 12:13:50','2017-12-26',NULL),
  (168,137,28,NULL,'en funcionamiento - nuevo','2017-12-28 12:16:52','2017-12-19',NULL),
  (169,138,56,NULL,'en funcionamiento - regular','2017-12-28 14:02:11','2017-01-01',NULL),
  (170,139,74,NULL,'en funcionamiento - regular','2017-12-28 14:07:30','2017-01-01',NULL),
  (171,140,56,NULL,'en funcionamiento - regular','2017-12-28 14:29:09','2017-01-01',NULL),
  (172,140,76,NULL,'en funcionamiento - regular','2017-12-28 15:53:03','2017-11-28','<p>reasignacion, luego q fue devuelto por estacion de peaje Laja</p>\r\n'),
  (173,138,76,NULL,'en funcionamiento - regular','2017-12-28 16:17:00','2017-11-28','<p>Reasignacion</p>\r\n'),
  (174,139,76,NULL,'en funcionamiento - regular','2017-12-28 16:18:05','2017-11-28','<p>Reasignacion</p>\r\n'),
  (175,141,78,NULL,'en funcionamiento - nuevo','2017-12-28 16:38:39','2017-11-16',NULL),
  (176,142,78,NULL,'en funcionamiento - nuevo','2017-12-28 17:02:15','2017-11-16',NULL),
  (177,143,78,NULL,'en funcionamiento - nuevo','2017-12-28 17:03:58','2017-11-16',NULL),
  (178,144,78,NULL,'en funcionamiento - nuevo','2017-12-28 17:11:03','2017-11-16',NULL),
  (179,145,78,NULL,'en funcionamiento - nuevo','2017-12-28 17:15:00','2017-11-16',NULL),
  (180,146,78,NULL,'en funcionamiento - nuevo','2017-12-28 17:16:47','2017-11-16',NULL),
  (181,147,44,NULL,'en funcionamiento - nuevo','2017-12-30 13:30:03','2017-12-29',NULL),
  (182,148,78,NULL,'en funcionamiento - nuevo','2017-12-30 13:39:42','2017-12-29',NULL),
  (183,149,30,NULL,'en funcionamiento - regular','2018-01-05 20:46:51','2017-01-01',NULL),
  (184,149,75,NULL,'en reparacion - tiende a malo','2018-01-05 20:47:24','2018-01-05',''),
  (185,150,30,NULL,'en funcionamiento - nuevo','2018-01-05 20:49:06','2018-01-05',NULL);

COMMIT;

#
# Data for the `locations` table  (LIMIT 0,500)
#

INSERT INTO `locations` (`id_location`, `parent_id`, `office_id`, `location_name`, `location_type`, `location_system_type`, `location_description`) VALUES 
  (1,NULL,1,'ORLP','',NULL,''),
  (2,1,1,'Autopista','estacion de peaje',NULL,''),
  (3,1,1,'Achica Arriba',NULL,NULL,''),
  (4,1,1,'Patacamaya A','estacion de peaje',NULL,''),
  (5,1,1,'Patacamaya B','estacion de peaje',NULL,''),
  (6,1,1,'Sica Sica','estacion de peaje',NULL,''),
  (7,1,1,'Urujara','estacion de peaje',NULL,''),
  (8,1,1,'Corapata','estacion de peaje',NULL,''),
  (9,1,1,'Laja','estacion de peaje',NULL,''),
  (10,2,1,'Autopista, carril1','carril',NULL,NULL),
  (11,2,1,'Autopista, carril2','carril',NULL,NULL),
  (12,2,1,'Autopista, carril3','carril',NULL,NULL),
  (13,3,1,'Achica Arriba, carril1','carril',NULL,NULL),
  (14,2,1,'Autopista, Dormitorio',' oficina-estacion',NULL,NULL),
  (15,70,1,'Oficina Regional, Profesional en RRHH','oficina - regional',NULL,NULL),
  (16,70,1,'Oficina Regional, Profesional en Servicios General',NULL,NULL,NULL),
  (17,2,1,'Autopista, carril4',NULL,NULL,NULL),
  (18,2,1,'Autopista, carril5',NULL,NULL,NULL),
  (19,2,1,'Autopista, carril4',NULL,NULL,NULL),
  (20,2,1,'Autopista, carril5',NULL,NULL,NULL),
  (21,2,1,'Autopista, carril6',NULL,NULL,NULL),
  (22,2,1,'Autopista, carril7',NULL,NULL,NULL),
  (23,2,1,'Autopista, carril8',NULL,NULL,NULL),
  (24,3,1,'Achica Arriba, carril2',NULL,NULL,NULL),
  (25,3,1,'Achica Arriba, carril3',NULL,NULL,NULL),
  (28,4,1,'Patacamaya A, Carril2',NULL,NULL,NULL),
  (30,7,1,'Urujara, Carril1',NULL,NULL,NULL),
  (33,7,1,'Urujara, Carril2',NULL,NULL,NULL),
  (34,8,1,'Corapata, Carril1',NULL,NULL,NULL),
  (36,5,1,'Patacamaya B, Carril1',NULL,NULL,NULL),
  (39,5,1,'Patacamaya B, Carril2',NULL,NULL,NULL),
  (40,5,1,'Patacamaya B, Carril3',NULL,NULL,NULL),
  (42,8,1,'Corapata, carril2',NULL,NULL,NULL),
  (44,9,1,'Laja, Carril1',NULL,NULL,NULL),
  (47,9,1,'Laja, Carril2',NULL,NULL,NULL),
  (48,9,1,'Laja, Carril3',NULL,NULL,NULL),
  (50,6,1,'Sica Sica, carril1',NULL,NULL,NULL),
  (51,6,1,'Sica Sica, carril2',NULL,NULL,NULL),
  (52,7,1,'Urujara, Oficina',NULL,NULL,NULL),
  (53,6,1,'Sica Sica, Oficina',NULL,NULL,NULL),
  (54,5,1,'Patacamaya B, Oficina',NULL,NULL,NULL),
  (55,4,1,'Patacamaya A, oficina',NULL,NULL,NULL),
  (56,9,1,'Laja, oficina',NULL,NULL,NULL),
  (57,8,1,'Corapata, oficina',NULL,NULL,NULL),
  (58,2,1,'Autopista, oficina',NULL,NULL,NULL),
  (59,3,1,'Achica Arriba, oficina',NULL,NULL,NULL),
  (60,70,1,'Oficina Regional, Profesional en presupuestos',NULL,NULL,NULL),
  (61,70,1,'Oficina Regional, Asistente tecnico',NULL,NULL,NULL),
  (62,70,1,'Oficina Regional, Asistente de RRHH',NULL,NULL,NULL),
  (63,70,1,'Oficina Regional, Asistente de Almacenes y servicios generales',NULL,NULL,NULL),
  (64,70,1,'Oficina Regional, Responsable administrativo financiero',NULL,NULL,NULL),
  (65,70,1,'Oficina Regional, Jefe Regional',NULL,NULL,NULL),
  (66,70,1,'Oficina Regional, Gestores',NULL,NULL,NULL),
  (67,70,1,'Oficina Regional, Cajeros',NULL,NULL,NULL),
  (69,4,1,'Patacamaya A, carril 1',NULL,NULL,NULL),
  (70,1,1,'Oficina Regional',NULL,NULL,NULL),
  (71,1,1,'Viacha',NULL,NULL,NULL),
  (72,71,1,'Viacha, oficina',NULL,NULL,NULL),
  (73,71,1,'Viacha, carril 1',NULL,NULL,NULL),
  (74,2,1,'Autopista, Almacen',NULL,NULL,NULL),
  (75,70,1,'Oficina Regional, Profesional en Sistemas',NULL,NULL,NULL),
  (76,1,1,'Guanay KM6',NULL,NULL,NULL),
  (77,1,1,'Huarina I',NULL,NULL,NULL),
  (78,77,1,'Huarina I, Carril 1',NULL,NULL,NULL),
  (80,NULL,2,'ORCB',NULL,NULL,'<p>Cochabamba</p>\r\n'),
  (81,80,2,'Colcapirhua',NULL,NULL,''),
  (82,81,2,'Colcapirhua, carril 1',NULL,NULL,'');

COMMIT;

#
# Data for the `maintenances` table  (LIMIT 0,500)
#

INSERT INTO `maintenances` (`id_maintenance`, `location_id`, `maintenance_register_date`, `maintenance_description`) VALUES 
  (29,2,'2017-05-19 20:45:57','Reemplazo por equipo Nuevo'),
  (30,1,'2017-05-19 20:51:33','Se instalo en reemplado de equipo antiguo'),
  (31,1,'2017-05-19 20:56:17','Limpieza de equipos'),
  (32,2,'2017-05-19 20:58:09','Cambio de Patch Cores'),
  (33,1,'2017-05-19 21:19:42','Limpieza general'),
  (34,3,'2017-04-06 16:04:27','Instalacion y/o recambio de equipo SERVIDOR y SWITCH CISCO'),
  (35,13,'2017-05-20 16:25:47','correccion de falla de rosetas por version atigua de WIN_SISCAP en carril 1, reten de Achica Arriba'),
  (36,58,'2017-05-23 16:00:00','En equipo SUPERVISOR Se reinstalo sistema operativo Ubuntu con windows7 virtualizado y paquetes ofimanticos'),
  (38,6,'2017-06-01','Cambio de cableado de red de Oficina y los 2 Carriles'),
  (39,50,'2017-06-02','Instalacion de 2 camaras Externas\r\n'),
  (40,53,'2017-06-02','Cambio/Instalacion de SERVIDOR, SWITCH\r\n DVR de equipos Viejos por equipos NUEVOS'),
  (41,12,'2017-05-29','Instalacion de NANO PC en Carril'),
  (42,23,'2017-05-29','Instalacion de NANO PC en Carril'),
  (43,59,'2017-05-29','En equipo SUPERVISOR Se reinstalo sistema operativo Ubuntu con windows7 virtualizado y paquetes ofimanticos'),
  (44,15,'2017-11-24','Se ha determinado que requiere de una reparacion, por tecnicos especialistas, imprimi con varias manchas incluso con tonner nuevo y varias ocasiones se atasca papel'),
  (45,10,'2018-03-06','mantenimiento camaras');

COMMIT;

#
# Data for the `offices` table  (LIMIT 0,500)
#

INSERT INTO `offices` (`id_office`, `office_name`, `office_shortname`, `office_description`, `office_status`) VALUES 
  (1,'Oficina Regional La Paz','ORLP',NULL,NULL),
  (2,'Oficina Regional Cochabamba','ORCB',NULL,NULL),
  (3,'Oficina Regional Beni','ORBN','',NULL),
  (4,'Oficina Regional Chuqisaca','ORCH','',NULL),
  (5,'Oficina Regional Potosi','ORPT','',NULL),
  (6,'Oficina Regional Oruro','OROR','',NULL),
  (7,'Oficina Regional Santa Cruz','ORSC','',NULL),
  (8,'Oficina Regional Tarija','ORTJ','',NULL);

COMMIT;

#
# Data for the `posts` table  (LIMIT 0,500)
#

INSERT INTO `posts` (`id_post`, `parent_id`, `post_type`, `post_title`, `post_content`, `post_register_date`) VALUES 
  (1,0,'project','SOPORTE Y MANTENIMIENTO PREVENTIVO/CORRECTIVO','','2018-01-05 09:52:07'),
  (2,1,'discussion','Soporte y mantenimiento en estaciones de peaje','','2018-01-05 09:54:53'),
  (3,2,'task','Registro de estado de kardex','','2018-01-05 09:59:04');

COMMIT;

#
# Data for the `purchases` table  (LIMIT 0,500)
#

INSERT INTO `purchases` (`id_purchase`, `purchase_start_process_date`, `purchase_store_dateentry`, `purchase_name`, `purchase_description`) VALUES 
  (1,'2017-04-17',NULL,'ADQUISICION DE EQUIPOS DE COMPUTACION PARA LOS RETENES DE LA REGIONAL LA PAZ, modalidad ANPE ','Solicitud de compra de EQUIPOS DE COMPUTACION, modalidad ANPE'),
  (2,'2017-04-26',NULL,'CAMARAS EXTERNAS y GRABADORES, modalidad COMPRA MENOR','ADQUISICION DE CAMARAS EXTERNAS y GRABADORES, PARA LA REGIONAL LA PAZ'),
  (3,'2017-09-21',NULL,'Solicitud de compra de EQUIPOS DE COMPUTACION, modalidad ANPE','ADQUISICION DE EQUIPOS DE COMPUTACION PARA LOS RETENES DE LA REGIONAL'),
  (4,'2017-10-16',NULL,'Solicitud de compra de EQUIPOS DE COMUNICACION, modalidad COMPRA MENOR ','ADQUISICION DE EQUIPOS DE COMUNICACIÓN PARA LOS RETENES DE LA REGIONAL LA PAZ'),
  (5,'2017-09-07',NULL,'Solicitud de compra de SERVIDORES, modalidad COMPRA MENOR ','ADQUISICION DE EQUIPOS DE SERVIDORES PARA RETENES DE LA REGIONAL LA PAZ '),
  (6,'2017-02-06','2017-03-29','COMPRA DE IMPRESORAS TERMICAS, LECTORES DE CODIGO DE BARRAS, HERRAMIENTAS Y ACCESORIOS','COMPRA DE IMPRESORAS TERMICAS, LECTORES DE CODIGO DE BARRAS, HERRAMIENTAS Y ACCESORIOS'),
  (7,'2016-12-31','2016-12-31','Compra anterior a 2017',NULL);

COMMIT;

#
# Data for the `purchases_items` table  (LIMIT 0,500)
#

INSERT INTO `purchases_items` (`id_purchase_item`, `purchase_id`, `inventory_category_id`, `purchase_item_quantity`, `purchase_item_description`) VALUES 
  (1,1,23,11,'N° \tCodigo Activo \tDescripcion \tCosto\r\n1 \t24312000320 \tMINI-PC EBOX THIN CLIENT, PROCEDADOR: INTEL CELERON N2807 2.16 GH2, ALAMCENAMIENTO: 16GB EL MMC; MEMORIA RAM: 2GB TIPO DDR3L; TARJETA DE RED LOCAL:10/100/1000 GBIT LAN; CANTIDAD DE PUERTOS USB:4 FUENTE DE ALIMENTACION 12V/2A \t1.450,00\r\n2 \t24312000321 \tMINI-PC EBOX THIN CLEINT, PROCESADOR; INTEL CELERON NO 2807 2.16 GH2 ALMACENAMIENTO; 16 GB EL MMC; MEMORIA RAM; 2 GB TIPO DDR3L; TARJETA DE RED LOCAL; 10/100/1000 GBIT LAN; CANTIDAD DE PUERTOS USB;4 \t1.450,00\r\n3 \t24312000322 \tMINI-PC EBOX THIN CLEINT, PROCESADOR; INTEL CELERON NO 2807 2.16 GH2 ALMACENAMIENTO; 16 GB EL MMC; MEMORIA RAM; 2 GB TIPO DDR3L; TARJETA DE RED LOCAL; 10/100/1000 GBIT LAN; CANTIDAD DE PUERTOS USB;4 \t1.450,00\r\n4 \t24312000323 \tMINI-PC EBOX THIN CLEINT, PROCESADOR; INTEL CELERON NO 2807 2.16 GH2 ALMACENAMIENTO; 16 GB EL MMC; MEMORIA RAM; 2 GB TIPO DDR3L; TARJETA DE RED LOCAL; 10/100/1000 GBIT LAN; CANTIDAD DE PUERTOS USB;4 \t1.450,00\r\n5 \t24312000324 \tMINI-PC EBOX THIN CLEINT, PROCESADOR; INTEL CELERON NO 2807 2.16 GH2 ALMACENAMIENTO; 16 GB EL MMC; MEMORIA RAM; 2 GB TIPO DDR3L; TARJETA DE RED LOCAL; 10/100/1000 GBIT LAN; CANTIDAD DE PUERTOS USB;4 \t1.450,00\r\n6 \t24312000325 \tMINI-PC EBOX THIN CLEINT, PROCESADOR; INTEL CELERON NO 2807 2.16 GH2 ALMACENAMIENTO; 16 GB EL MMC; MEMORIA RAM; 2 GB TIPO DDR3L; TARJETA DE RED LOCAL; 10/100/1000 GBIT LAN; CANTIDAD DE PUERTOS USB;4 \t1.450,00\r\n7 \t24312000326 \tMINI-PC EBOX THIN CLEINT, PROCESADOR; INTEL CELERON NO 2807 2.16 GH2 ALMACENAMIENTO; 16 GB EL MMC; MEMORIA RAM; 2 GB TIPO DDR3L; TARJETA DE RED LOCAL; 10/100/1000 GBIT LAN; CANTIDAD DE PUERTOS USB;4 \t1.450,00\r\n8 \t24312000327 \tMINI-PC EBOX THIN CLEINT, PROCESADOR; INTEL CELERON NO 2807 2.16 GH2 ALMACENAMIENTO; 16 GB EL MMC; MEMORIA RAM; 2 GB TIPO DDR3L; TARJETA DE RED LOCAL; 10/100/1000 GBIT LAN; CANTIDAD DE PUERTOS USB;4 \t1.450,00\r\n9 \t24312000328 \tMINI-PC EBOX THIN CLEINT, PROCESADOR; INTEL CELERON NO 2807 2.16 GH2 ALMACENAMIENTO; 16 GB EL MMC; MEMORIA RAM; 2 GB TIPO DDR3L; TARJETA DE RED LOCAL; 10/100/1000 GBIT LAN; CANTIDAD DE PUERTOS USB;4 \t1.450,00\r\n10 \t24312000329 \tMINI-PC EBOX THIN CLEINT, PROCESADOR; INTEL CELERON NO 2807 2.16 GH2 ALMACENAMIENTO; 16 GB EL MMC; MEMORIA RAM; 2 GB TIPO DDR3L; TARJETA DE RED LOCAL; 10/100/1000 GBIT LAN; CANTIDAD DE PUERTOS USB;4 \t1.450,00\r\n11 \t24312000330 \tMINI-PC EBOX THIN CLEINT, PROCESADOR; INTEL CELERON NO 2807 2.16 GH2 ALMACENAMIENTO; 16 GB EL MMC; MEMORIA RAM; 2 GB TIPO DDR3L; TARJETA DE RED LOCAL; 10/100/1000 GBIT LAN; CANTIDAD DE PUERTOS USB;4 \t1.450,00'),
  (2,1,26,6,'N° \tCodigo Activo \tDescripcion \tCosto\r\n1 \t24312000388 \tSMALL FACTOR PC \t5.470,00\r\n2 \t24312000389 \tSMALL FACTOR PC \t5.470,00\r\n3 \t24312000390 \tSMALL FACTOR PC \t5.470,00\r\n4 \t24312000391 \tSMALL FACTOR PC \t5.470,00\r\n5 \t24312000392 \tSMALL FACTOR PC \t5.470,00\r\n6 \t24312000393 \tSMALL FACTOR PC \t5.470,00'),
  (3,1,25,9,'N° \tCodigo Activo \tDescripcion \tCosto\r\n1 \t24312000331 \tIMPRESORA LASER HEWLETT PACKARD LASERJET P1102W-MONOCROMO SALIDA EFECTIVA 1200 DPI; VELOCIDAD DEL PROCESADOR 266 MH2, BANDEJA DE ENTRADA 150 HOJAS \t1.050,00\r\n2 \t24312000332 \tIMPRESORA LASER HEWLETT PACKARD LASERJET P1102W-MONOCROMO SALIDA EFECTIVA 1200 DPI; VELOCIDAD DEL PROCESADOR 266 MH2, BANDEJA DE ENTRADA 150 HOJAS \t1.050,00\r\n3 \t24312000333 \tIMPRESORA LASER HEWLETT PACKARD LASERJET P1102W-MONOCROMO SALIDA EFECTIVA 1200 DPI; VELOCIDAD DEL PROCESADOR 266 MH2, BANDEJA DE ENTRADA 150 HOJAS \t1.050,00\r\n4 \t24312000334 \tIMPRESORA LASER HEWLETT PACKARD LASERJET P1102W-MONOCROMO SALIDA EFECTIVA 1200 DPI; VELOCIDAD DEL PROCESADOR 266 MH2, BANDEJA DE ENTRADA 150 HOJAS \t1.050,00\r\n5 \t24312000335 \tIMPRESORA LASER HEWLETT PACKARD LASERJET P1102W-MONOCROMO SALIDA EFECTIVA 1200 DPI; VELOCIDAD DEL PROCESADOR 266 MH2, BANDEJA DE ENTRADA 150 HOJAS \t1.050,00\r\n6 \t24312000336 \tIMPRESORA LASER HEWLETT PACKARD LASERJET P1102W-MONOCROMO SALIDA EFECTIVA 1200 DPI; VELOCIDAD DEL PROCESADOR 266 MH2, BANDEJA DE ENTRADA 150 HOJAS \t1.050,00\r\n7 \t24312000337 \tIMPRESORA LASER HEWLETT PACKARD LASERJET P1102W-MONOCROMO SALIDA EFECTIVA 1200 DPI; VELOCIDAD DEL PROCESADOR 266 MH2, BANDEJA DE ENTRADA 150 HOJAS \t1.050,00\r\n8 \t24312000338 \tIMPRESORA LASER HEWLETT PACKARD LASERJET P1102W-MONOCROMO SALIDA EFECTIVA 1200 DPI; VELOCIDAD DEL PROCESADOR 266 MH2, BANDEJA DE ENTRADA 150 HOJAS \t1.050,00\r\n9 \t24312000339 \tIMPRESORA LASER HEWLETT PACKARD LASERJET P1102W-MONOCROMO SALIDA EFECTIVA 1200 DPI; VELOCIDAD DEL PROCESADOR 266 MH2, BANDEJA DE ENTRADA 150 HOJAS \t1.050,00'),
  (4,1,22,15,'N° \tCodigo Activo \tDescripcion \tCosto\r\n1 \t24312000340 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n2 \t24312000341 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n3 \t24312000342 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n4 \t24312000343 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n5 \t24312000344 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n6 \t24312000346 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n7 \t24312000347 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n8 \t24312000348 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n9 \t24312000349 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n10 \t24312000350 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n11 \t24312000351 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n12 \t24312000352 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n13 \t24312000353 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00\r\n14 \t24312000345 \tUPS CAPACIDAD VIA: 1000;WATTS 600, ENTRADA VOLTAJE NOMINAL; 110/220V, NUMERO DE TOMAS 8(NEMA) \t900,00'),
  (5,1,27,11,'N° \tCodigo Activo \tDescripcion \tCosto\r\n1 \t24312000360 \tMONITOR LED 19 PULGADAS \t810,00\r\n2 \t24312000361 \tMONITOR LED 19 PULGADAS \t810,00\r\n3 \t24312000362 \tMONITOR LED 19 PULGADAS \t810,00\r\n4 \t24312000364 \tMONITOR LED 19 PULGADAS \t810,00\r\n5 \t24312000365 \tMONITOR LED 19 PULGADAS \t810,00\r\n6 \t24312000366 \tMONITOR LED 19 PULGADAS \t810,00\r\n7 \t24312000367 \tMONITOR LED 19 PULGADAS \t810,00\r\n8 \t24312000368 \tMONITOR LED 19 PULGADAS \t810,00\r\n9 \t24312000369 \tMONITOR LED 19 PULGADAS \t810,00\r\n10 \t24312000370 \tMONITOR LED 19 PULGADAS \t810,00\r\n11 \t24312000363 \tMONITOR LED 19 PULGADAS \t810,00'),
  (6,1,28,6,'N° \tCodigo Activo \tDescripcion \tCosto\r\n1 \t24312000354 \tMONITOR TOUCH 15 PULGADAS PANTALLA TFT LCD DE 15.1 CON RESOLUCION XGA DE 1024X 768 PANEL TACTIL DE ALTA RESISTENCIA Y SENCIBILIDAD, CON 2 MM DE VIDRIO 1 PUERTO. \t3.600,00\r\n2 \t24312000355 \tMONITOR TOUCH 15 PULGADAS PANTALLA TFT LCD DE 15.1 CON RESOLUCION XGA DE 1024X 768 PANEL TACTIL DE ALTA RESISTENCIA Y SENCIBILIDAD, CON 2 MM DE VIDRIO 1 PUERTO. \t3.600,00\r\n3 \t24312000356 \tMONITOR TOUCH 15 PULGADAS PANTALLA TFT LCD DE 15.1 CON RESOLUCION XGA DE 1024X 768 PANEL TACTIL DE ALTA RESISTENCIA Y SENCIBILIDAD, CON 2 MM DE VIDRIO 1 PUERTO. \t3.600,00\r\n4 \t24312000357 \tMONITOR TOUCH 15 PULGADAS PANTALLA TFT LCD DE 15.1 CON RESOLUCION XGA DE 1024X 768 PANEL TACTIL DE ALTA RESISTENCIA Y SENCIBILIDAD, CON 2 MM DE VIDRIO 1 PUERTO. \t3.600,00\r\n5 \t24312000358 \tMONITOR TOUCH 15 PULGADAS PANTALLA TFT LCD DE 15.1 CON RESOLUCION XGA DE 1024X 768 PANEL TACTIL DE ALTA RESISTENCIA Y SENCIBILIDAD, CON 2 MM DE VIDRIO 1 PUERTO. \t3.600,00\r\n6 \t24312000359 \tMONITOR TOUCH 15 PULGADAS PANTALLA TFT LCD DE 15.1 CON RESOLUCION XGA DE 1024X 768 PANEL TACTIL DE ALTA RESISTENCIA Y SENCIBILIDAD, CON 2 MM DE VIDRIO 1 PUERTO. \t3.600,00'),
  (7,1,24,9,'N° \tCodigo Activo \tDescripcion \tCosto\r\n1 \t24312000380 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.749,00\r\n2 \t24312000381 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.749,00\r\n3 \t24312000382 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.749,00\r\n4 \t24312000383 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.749,00\r\n5 \t24312000384 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.749,00\r\n6 \t24312000385 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.749,00\r\n7 \t24312000386 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.749,00\r\n8 \t24312000387 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.749,00'),
  (8,2,29,9,'13 \t24350000122 \tGRABADORES 9 CH \t2.140,00\r\n14 \t24350000123 \tGRABADORES 9 CH \t2.140,00\r\n15 \t24350000124 \tGRABADORES 9 CH \t2.140,00\r\n16 \t24350000125 \tGRABADORES 9 CH \t2.140,00\r\n17 \t24350000126 \tGRABADORES 9 CH \t2.140,00\r\n18 \t24350000127 \tGRABADORES 9 CH \t2.140,00\r\n19 \t24350000128 \tGRABADORES 9 CH \t2.140,00\r\n20 \t24350000129 \tGRABADORES 9 CH \t2.140,00\r\n21 \t24350000130 \tGRABADORES 9 CH \t2.140,00'),
  (9,2,30,3,'1 \t24350000109 \tCAMARAS TIPO TUBO POLICARBONATO FULL HD \t466,00\r\n2 \t24350000110 \tCAMARAS TIPO TUBO POLICARBONATO FULL HD \t466,00\r\n3 \t24350000111 \tCAMARAS TIPO TUBO POLICARBONATO FULL HD \t466,00'),
  (10,2,19,10,'4 \t24350000112 \tCAMARA TIPO TUBO POLICARBONATO HD \t346,00\r\n5 \t24350000113 \tCAMARA TIPO TUBO POLICARBONATO HD \t346,00\r\n6 \t24350000115 \tCAMARA TIPO TUBO POLICARBONATO HD \t346,00\r\n7 \t24350000116 \tCAMARA TIPO TUBO POLICARBONATO HD \t346,00\r\n8 \t24350000117 \tCAMARA TIPO TUBO POLICARBONATO HD \t346,00\r\n9 \t24350000118 \tCAMARA TIPO TUBO POLICARBONATO HD \t346,00\r\n10 \t24350000119 \tCAMARA TIPO TUBO POLICARBONATO HD \t346,00\r\n11 \t24350000120 \tCAMARA TIPO TUBO POLICARBONATO HD \t346,00\r\n12 \t24350000121 \tCAMARA TIPO TUBO POLICARBONATO HD \t346,00'),
  (11,5,6,5,'1 \t24312000394 \tSERVIDORES MARCA DELL \t7.650,00\r\n2 \t24312000395 \tSERVIDORES MARCA DELL \t7.650,00\r\n3 \t24312000396 \tSERVIDORES MARCA DELL \t7.650,00\r\n4 \t24312000397 \tSERVIDORES MARCA DELL \t7.650,00\r\n5 \t24312000398 \tSERVIDORES MARCA DELL \t7.650,00'),
  (12,3,23,9,'1 \t24312000414 \tMINI PC EBOX/C800 \t2.450,00\r\n2 \t24312000415 \tMINI PC EBOX/C800 \t2.450,00\r\n3 \t24312000416 \tMINI PC EBOX/C800 \t2.450,00\r\n4 \t24312000417 \tMINI PC EBOX/C800 \t2.450,00\r\n5 \t24312000418 \tMINI PC EBOX/C800 \t2.450,00\r\n6 \t24312000419 \tMINI PC EBOX/C800 \t2.450,00\r\n7 \t24312000420 \tMINI PC EBOX/C800 \t2.450,00\r\n8 \t24312000421 \tMINI PC EBOX/C800 \t2.450,00\r\n9 \t24312000422 \tMINI PC EBOX/C800 \t2.450,00'),
  (14,3,24,5,'10 \t24312000423 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.770,00\r\n11 \t24312000424 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.770,00\r\n12 \t24312000425 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.770,00\r\n13 \t24312000426 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.770,00\r\n14 \t24312000427 \tLECTOR DE CODIGO DE BARRAS INALAMBRICAS \t2.770,00'),
  (15,3,22,10,'15 \t24312000437 \tUPS FORZA SL1012LCD-U \t840,00\r\n16 \t24312000436 \tUPS FORZA SL1012LCD-U \t840,00\r\n17 \t24312000435 \tUPS FORZA SL1012LCD-U \t840,00\r\n18 \t24312000434 \tUPS FORZA SL1012LCD-U \t840,00\r\n19 \t24312000433 \tUPS FORZA SL1012LCD-U \t840,00\r\n20 \t24312000432 \tUPS FORZA SL1012LCD-U \t840,00\r\n21 \t24312000431 \tUPS FORZA SL1012LCD-U \t840,00\r\n22 \t24312000430 \tUPS FORZA SL1012LCD-U \t840,00\r\n23 \t24312000429 \tUPS FORZA SL1012LCD-U \t840,00\r\n24 \t24312000428 \tUPS FORZA SL1012LCD-U \t840,00'),
  (16,3,27,5,'1 \t24312000408 \tMONITITOR LED 19 PULGADAS \t850,00\r\n2 \t24312000409 \tMONITOR LED 19 PULGADAS \t850,00\r\n3 \t24312000410 \tMONITOR LED 19 PULGADAS \t850,00\r\n4 \t24312000411 \tMONITITOR 19 PULGADAS \t850,00\r\n5 \t24312000412 \tMONITITOR 19 PULGADAS \t850,00'),
  (17,3,31,1,'25 \t24350000149 \tTV LG PLANO \t3.090,00'),
  (18,3,32,1,'24312000407 \tSCANER EPSON DS 530 \t4.220,00'),
  (19,3,33,1,'6 \t24312000413 \tIMPRESORA DE ETIQUETAS AUTOAHESIVAS \t3.150,00'),
  (20,4,29,5,'N° \tCodigo Activo \tDescripcion \tCosto\r\n1 \t24350000132 \tGRABADORES DIGITAL HIBRIDO \t2.195,00\r\n2 \t24350000131 \tGRABADORES DIGITAL HIBRIDO \t2.195,00\r\n3 \t24350000133 \tGRABADORES DIGITAL HIBRIDO \t2.195,00\r\n4 \t24350000134 \tGRABADORES DIGITAL HIBRIDO \t2.195,00\r\n5 \t24350000135 \tGRABADORES DIGITAL HIBRIDO \t2.195,00'),
  (21,4,19,13,'6 \t24350000136 \tCAMARA DE BALA EXTERIOR HD \t365,00\r\n7 \t24350000137 \tCAMARA DE BALA EXTERIOR HD \t365,00\r\n8 \t24350000138 \tCAMARA DE BALA EXTERIOR HD \t365,00\r\n9 \t24350000139 \tCAMARA DE BALA EXTERIOR HD \t365,00\r\n10 \t24350000140 \tCAMARAS TIPO TUBO POLICARBONATO FULL HD \t365,00\r\n11 \t24350000141 \tCAMARA DE BALA EXTERIOR HD \t365,00\r\n12 \t24350000142 \tCAMARA DE BALA EXTERIOR HD \t365,00\r\n13 \t24350000143 \tCAMARA DE BALA EXTERIOR HD \t365,00\r\n14 \t24350000144 \tCAMARA DE BALA EXTERIOR HD \t365,00\r\n15 \t24350000145 \tCAMARA DE BALA EXTERIOR HD \t365,00\r\n16 \t24350000146 \tCAMARA TIPO TUBO POLICARBONARTO HD \t365,00\r\n17 \t24350000147 \tCAMARA DE BALA EXTERIOR HD \t365,00\r\n18 \t24350000148 \tCAMARA DE BALA EXTERIOR HD \t365,00'),
  (22,6,15,7,'N° \tCodigo Activo \tDescripcion \tCosto\r\n1 \t24312000308 \tIMPRESORA TÉRMICA TM-T88V \t2.990,00\r\n2 \t24312000309 \tIMPRESORA TÉRMICA \t2.990,00\r\n3 \t24312000310 \tIMPRESORA TÉRMICA \t2.990,00\r\n4 \t24312000311 \tIMPRESORA TÉRMICA \t2.990,00\r\n5 \t24312000312 \tIMPRESORA TÉRMICA \t2.990,00\r\n6 \t24312000313 \tIMPRESORA TÉRMICA \t2.990,00\r\n7 \t24312000314 \tIMPRESORA TÉRMICA \t2.990,00'),
  (23,6,24,5,'N° \tCodigo Activo \tDescripcion \tCosto\r\n1 \t24312000315 \tLECTOR DE CODIGO DE BARRAS \t2.672,00\r\n2 \t24312000316 \tLECTOR DE CODIGO DE BARRA \t2.672,00\r\n3 \t24312000317 \tLECTOR DE CODIGO DE BARRA \t2.672,00\r\n4 \t24312000318 \tLECTOR DE CODIGO DE BARRA \t2.672,00\r\n5 \t24312000319 \tLECTOR DE CODIGO DE BARRA \t2.672,00'),
  (24,NULL,NULL,NULL,'1 \t24312000408 \tMONITITOR LED 19 PULGADAS \t850,00\r\n2 \t24312000409 \tMONITOR LED 19 PULGADAS \t850,00\r\n3 \t24312000410 \tMONITOR LED 19 PULGADAS \t850,00\r\n4 \t24312000411 \tMONITITOR 19 PULGADAS \t850,00\r\n5 \t24312000412 \tMONITITOR 19 PULGADAS \t850,00');

COMMIT;

