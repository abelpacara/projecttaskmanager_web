# SQL Manager 2005 Lite for MySQL 3.7.7.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : ptm


SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the `inventories` table : 
#

DROP TABLE IF EXISTS `inventories`;

CREATE TABLE `inventories` (
  `id_inventory` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_category_id` int(11) NOT NULL,
  `inventory_mark` text NOT NULL,
  `inventory_model` text NOT NULL,
  `inventory_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inventory_quantity` int(11) DEFAULT NULL,
  `inventory_buy_price` float DEFAULT NULL,
  `inventory_description` text,
  PRIMARY KEY (`id_inventory`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

#
# Structure for the `inventories_categories` table : 
#

DROP TABLE IF EXISTS `inventories_categories`;

CREATE TABLE `inventories_categories` (
  `id_inventory_category` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_category_name` text NOT NULL,
  PRIMARY KEY (`id_inventory_category`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

#
# Structure for the `kardexes` table : 
#

DROP TABLE IF EXISTS `kardexes`;

CREATE TABLE `kardexes` (
  `id_kardex` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) NOT NULL,
  `kardex_code` text NOT NULL,
  `kardex_serial` text NOT NULL,
  `kardex_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kardex_start_date` date NOT NULL,
  PRIMARY KEY (`id_kardex`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

#
# Structure for the `kardexes_status` table : 
#

DROP TABLE IF EXISTS `kardexes_status`;

CREATE TABLE `kardexes_status` (
  `id_kardex_status` int(11) NOT NULL AUTO_INCREMENT,
  `kardex_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `maintenance_id` int(11) DEFAULT NULL,
  `kardex_status_value` enum('en funcionamiento - nuevo','en funcionamiento - bueno','en funcionamiento - regular','en funcionamiento - tiende a malo','inactivo/respaldo - bueno','inactivo/respaldo - regular','inactivo/respaldo - tiende a malo','nuevo en almacen','en reparacion - regular','en reparacion - tiende a malo','baja') NOT NULL,
  `kardex_status_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kardex_status_register_date` date DEFAULT NULL,
  `kardex_status_description` text,
  PRIMARY KEY (`id_kardex_status`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

#
# Structure for the `maintenances` table : 
#

DROP TABLE IF EXISTS `maintenances`;

CREATE TABLE `maintenances` (
  `id_maintenance` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `maintenance_register_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `maintenance_description` text NOT NULL,
  PRIMARY KEY (`id_maintenance`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

#
# Structure for the `posts` table : 
#

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `post_type` enum('project','discussion','task','comment') NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

#
# Data for the `inventories` table  (LIMIT 0,500)
#

INSERT INTO `inventories` (`id_inventory`, `inventory_category_id`, `inventory_mark`, `inventory_model`, `inventory_register_date`, `inventory_quantity`, `inventory_buy_price`, `inventory_description`) VALUES 
  (6,6,'HEWLETT PACKARD','PROLIANT ML 350 G6','2017-05-19 19:23:51',NULL,NULL,NULL),
  (7,7,'DAHUA','S/R','2017-05-19 19:37:55',NULL,NULL,NULL),
  (8,8,'CISCO','SF100-24V2','2017-05-19 19:39:31',NULL,NULL,NULL),
  (9,6,'DELL','POWER EDGE 2900','2017-05-19 19:42:59',NULL,NULL,NULL),
  (10,9,'ACER','  V173','2017-05-19 19:49:28',NULL,NULL,NULL),
  (11,8,'SISCO','PSZ20171A93','2017-05-19 19:50:52',NULL,NULL,NULL),
  (12,10,'DELTA','GES1-13R202035','2017-05-22 12:07:29',NULL,NULL,NULL),
  (13,10,'DELTA','S/R','2017-05-22 12:24:49',NULL,NULL,NULL),
  (14,11,'LG','32LK330','2017-05-22 13:50:06',NULL,NULL,NULL),
  (15,12,'HEWLETT PACKARD','L1710','2017-05-22 14:06:24',NULL,NULL,NULL),
  (16,13,'NUMBER PLATE','S/R','2017-05-22 14:08:56',NULL,NULL,NULL),
  (17,6,'DELL','QUAD CORE 3.2 GHZ. T20','2017-05-22 14:41:34',NULL,NULL,NULL),
  (18,14,'HEWLETT PACKARD','COMPAQ DC5700','2017-05-22 14:46:16',NULL,NULL,NULL),
  (19,15,'EPSON','TM-T88V M244A','2017-05-22 14:57:01',NULL,NULL,NULL),
  (20,8,'CISCO','CISSF110-24-NA','2017-05-22 15:01:07',NULL,NULL,NULL),
  (21,16,'FOXCONN','','2017-05-22 15:24:08',NULL,NULL,NULL),
  (22,14,'ACER','VERITON','2017-05-24 14:01:22',NULL,NULL,NULL);

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
  (16,'NANO PC');

COMMIT;

#
# Data for the `kardexes` table  (LIMIT 0,500)
#

INSERT INTO `kardexes` (`id_kardex`, `inventory_id`, `kardex_code`, `kardex_serial`, `kardex_register_date`, `kardex_start_date`) VALUES 
  (14,6,'24312000233','MXQ9370678','2017-05-19 19:23:51','0000-00-00'),
  (15,7,'24350000026','S/R','2017-05-19 19:37:55','0000-00-00'),
  (16,8,'24350000075','PSZ185119VL','2017-05-19 19:39:31','0000-00-00'),
  (17,9,'24312000232','BLXWKH1','2017-05-19 19:42:59','0000-00-00'),
  (18,10,'24312000119','ETLE10D0929260D8078602','2017-05-19 19:49:28','0000-00-00'),
  (19,11,'24350000106','CISSF110-24-NA','2017-05-19 19:50:52','0000-00-00'),
  (20,12,'24312000235','A0Y09700131WE','2017-05-22 12:07:29','0000-00-00'),
  (21,13,'24312000236','S/R','2017-05-22 12:24:49','0000-00-00'),
  (22,14,'24350000002','107RMWV0X929','2017-05-22 13:50:06','0000-00-00'),
  (23,15,'24312000137','3CQ9343G2T','2017-05-22 14:06:24','0000-00-00'),
  (24,16,'24370000101','S/R','2017-05-22 14:08:56','0000-00-00'),
  (25,16,'24370000102','S/R','2017-05-22 14:09:28','0000-00-00'),
  (26,17,'24312000305','8SFQ772','2017-05-22 14:41:34','0000-00-00'),
  (27,18,'24312000038','MXJ81604R1','2017-05-22 14:46:16','0000-00-00'),
  (28,19,'4312000619','MXFF341431','2017-05-22 14:57:01','0000-00-00'),
  (29,20,'24350000101','PSZ19071B57','2017-05-22 15:01:07','0000-00-00'),
  (30,21,'','THF11F020550900484','2017-05-22 15:24:08','0000-00-00'),
  (31,22,'24312000017','PS00819669936000310100','2017-05-24 14:01:22','0000-00-00'),
  (32,17,'24312000303','J9FQ772','2017-05-24 15:03:44','0000-00-00');

COMMIT;

#
# Data for the `kardexes_status` table  (LIMIT 0,500)
#

INSERT INTO `kardexes_status` (`id_kardex_status`, `kardex_id`, `location_id`, `maintenance_id`, `kardex_status_value`, `kardex_status_timestamp`, `kardex_status_register_date`, `kardex_status_description`) VALUES 
  (25,14,2,NULL,'en funcionamiento - regular','2017-05-19 19:23:51','2017-05-19',''),
  (26,15,2,NULL,'en funcionamiento - regular','2017-05-19 19:37:55','2017-05-19',''),
  (27,16,2,NULL,'en funcionamiento - regular','2017-05-19 19:39:31','2017-05-19',''),
  (28,17,2,NULL,'en funcionamiento - regular','2017-05-19 19:42:59','2017-05-19',''),
  (29,17,2,29,'inactivo/respaldo - regular','2017-05-19 19:45:57','2017-05-19',NULL),
  (30,14,2,29,'inactivo/respaldo - regular','2017-05-19 19:45:57','2017-05-19',NULL),
  (31,18,1,NULL,'en funcionamiento - regular','2017-05-19 19:49:28','2017-05-19',''),
  (32,19,1,NULL,'en funcionamiento - nuevo','2017-05-19 19:50:52','2017-05-19',''),
  (33,19,1,30,'en funcionamiento - bueno','2017-05-19 19:51:33','2017-05-19',NULL),
  (34,19,1,31,'en funcionamiento - bueno','2017-05-19 19:56:17','2017-05-19',NULL),
  (35,18,1,31,'en funcionamiento - regular','2017-05-19 19:56:17','2017-05-19',NULL),
  (36,16,2,32,'en funcionamiento - regular','2017-05-19 19:58:09','2017-05-19',NULL),
  (37,18,1,33,'en funcionamiento - regular','2017-05-19 20:19:42','2017-05-19',NULL),
  (38,20,2,NULL,'en funcionamiento - regular','2017-05-22 12:07:29','2017-05-22',''),
  (39,21,2,NULL,'en funcionamiento - regular','2017-05-22 12:24:49','2017-05-22',''),
  (40,22,2,NULL,'en funcionamiento - regular','2017-05-22 13:50:06','2017-05-22',''),
  (41,23,2,NULL,'en funcionamiento - regular','2017-05-22 14:06:24','2017-05-22',''),
  (42,24,2,NULL,'en funcionamiento - regular','2017-05-22 14:08:56','2017-05-22',''),
  (43,25,2,NULL,'en funcionamiento - regular','2017-05-22 14:09:28','2017-05-22',''),
  (44,26,3,NULL,'en funcionamiento - regular','2017-05-22 14:41:34','2017-05-22',''),
  (45,27,25,NULL,'en funcionamiento - regular','2017-05-22 14:46:16','2017-05-22',''),
  (46,28,25,NULL,'en funcionamiento - regular','2017-05-22 14:57:01','2017-05-22',''),
  (47,29,3,NULL,'en funcionamiento - regular','2017-05-22 15:01:07','2017-05-22',''),
  (48,29,3,34,'en funcionamiento - regular','2017-05-22 15:04:27','2017-04-06',NULL),
  (49,26,3,34,'en funcionamiento - regular','2017-05-22 15:04:27','2017-04-06',NULL),
  (50,30,13,NULL,'en funcionamiento - regular','2017-05-22 15:24:08','2017-05-20',''),
  (51,30,13,35,'en funcionamiento - regular','2017-05-22 15:25:47','2017-05-20',NULL),
  (52,31,2,NULL,'en funcionamiento - regular','2017-05-23 14:01:22','2017-05-23',''),
  (53,31,58,36,'en funcionamiento - regular','2017-05-23 14:23:38','2017-05-23',NULL),
  (54,32,2,NULL,'en funcionamiento - nuevo','2017-05-24 15:03:44','2017-05-16',''),
  (55,32,2,29,'en funcionamiento - bueno','2017-05-19 01:00:00','2017-05-19',NULL);

COMMIT;

#
# Data for the `locations` table  (LIMIT 0,500)
#

INSERT INTO `locations` (`id_location`, `parent_id`, `location_name`, `location_description`) VALUES 
  (1,NULL,'Oficinal Regional La Paz',''),
  (2,NULL,'Autopista',''),
  (3,NULL,'Achica Arriba',''),
  (4,NULL,'Patacamaya A',''),
  (5,NULL,'Patacamaya B',''),
  (6,NULL,'Sica Sica',''),
  (7,NULL,'Urujara',''),
  (8,NULL,'Corapata',''),
  (9,NULL,'Laja',''),
  (10,2,'Autopista, carril1',NULL),
  (11,2,'Autopista, carril2',NULL),
  (12,2,'Autopista, carril3',NULL),
  (13,3,'Achica Arriba, carril1',NULL),
  (14,7,'Autopista, Dormitorio',NULL),
  (15,1,'Oficinal Regional La Paz, RHH',NULL),
  (16,15,'Oficina Regional La Paz, Servicios General',NULL),
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
  (59,3,'Achica Arriba, oficina',NULL);

COMMIT;

#
# Data for the `maintenances` table  (LIMIT 0,500)
#

INSERT INTO `maintenances` (`id_maintenance`, `location_id`, `maintenance_register_date`, `maintenance_description`) VALUES 
  (29,2,'2017-05-19 19:45:57','Reemplazo por equipo Nuevo'),
  (30,1,'2017-05-19 19:51:33','Se instalo en reemplado de equipo antiguo'),
  (31,1,'2017-05-19 19:56:17','Limpieza de equipos'),
  (32,2,'2017-05-19 19:58:09','Cambio de Patch Cores'),
  (33,1,'2017-05-19 20:19:42','Limpieza general'),
  (34,3,'2017-04-06 15:04:27','Instalacion y/o recambio de equipo SERVIDOR y SWITCH CISCO'),
  (35,13,'2017-05-20 15:25:47','correccion de falla de rosetas por version atigua de WIN_SISCAP en carril 1, reten de Achica Arriba'),
  (36,58,'2017-05-23 15:00:00','En equipo SUPERVISOR Se reinstalo sistema operativo Ubuntu con windows7 virtualizado y paquetes ofimanticos');

COMMIT;

#
# Data for the `posts` table  (LIMIT 0,500)
#

INSERT INTO `posts` (`id_post`, `parent_id`, `post_type`, `post_title`, `post_content`, `post_register_date`) VALUES 
  (1,0,'project','project1','lorem ipsum','2016-10-24 10:26:44'),
  (2,0,'comment','HELLO 207','','2017-04-13 20:46:55'),
  (3,1,'discussion','FORO 2','ADFADS','2017-04-13 20:58:52'),
  (4,1,'discussion','FORO 2','ADFADS','2017-04-13 21:12:15'),
  (5,1,'discussion','FORO 2','ADFADS','2017-04-13 21:13:43'),
  (6,1,'discussion','FORO 2','ADFADS','2017-04-13 21:14:00'),
  (7,1,'discussion','FORO 2','ADFADS','2017-04-13 21:16:00'),
  (8,1,'discussion','FORO 2','ADFADS','2017-04-13 21:17:18'),
  (9,1,'discussion','FORO 2','ADFADS','2017-04-13 21:18:42'),
  (10,1,'discussion','FORO 2','ADFADS','2017-04-13 21:21:09'),
  (11,1,'discussion','FORO 2','ADFADS','2017-04-13 21:21:32'),
  (12,5,'comment','COMMENT 2','ASDF','2017-04-13 21:41:22'),
  (13,5,'comment','COMMENT 2','ASDF','2017-04-13 21:43:06'),
  (14,5,'comment','COMMENT 2','ASDF','2017-04-13 21:44:15'),
  (15,10,'task','DSSD','SDDS','2017-04-13 21:44:52');

COMMIT;
