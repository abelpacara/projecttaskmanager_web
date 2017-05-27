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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Structure for the `inventories_categories` table : 
#

DROP TABLE IF EXISTS `inventories_categories`;

CREATE TABLE `inventories_categories` (
  `id_inventory_category` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_category_name` text NOT NULL,
  PRIMARY KEY (`id_inventory_category`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id_kardex`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

#
# Structure for the `kardexes_status` table : 
#

DROP TABLE IF EXISTS `kardexes_status`;

CREATE TABLE `kardexes_status` (
  `id_kardex_status` int(11) NOT NULL AUTO_INCREMENT,
  `kardex_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `maintenance_id` int(11) DEFAULT NULL,
  `kardex_status_value` enum('reparacion','limpieza','cambio de repuesto','instalacion de software','alta','baja') NOT NULL,
  `kardex_status_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kardex_status_register_date` date DEFAULT NULL,
  `kardex_status_description` text,
  PRIMARY KEY (`id_kardex_status`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

#
# Structure for the `maintenances_kardexes` table : 
#

DROP TABLE IF EXISTS `maintenances_kardexes`;

CREATE TABLE `maintenances_kardexes` (
  `id_maintenance_kardex` int(11) NOT NULL AUTO_INCREMENT,
  `maintenance_id` int(11) NOT NULL,
  `kardex_id` int(11) NOT NULL,
  `maintenance_kardex_type` enum('limpieza','cambio de repuesto','Instalacion de software','puesto en funcionamiento final') NOT NULL,
  `maintenance_kardex_description` text NOT NULL,
  PRIMARY KEY (`id_maintenance_kardex`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

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
  (11,2,'carril2',NULL),
  (12,2,'carril3',NULL),
  (13,3,'Achica Arriba, carril1',NULL),
  (14,7,'Dormitorio',NULL),
  (15,1,'Oficinal Regional La Paz, RHH',NULL),
  (16,15,'Escritorio Asistente Almacenes',NULL);

COMMIT;

#
# Data for the `posts` table  (LIMIT 0,500)
#

INSERT INTO `posts` (`id_post`, `parent_id`, `post_type`, `post_title`, `post_content`, `post_register_date`) VALUES 
  (1,0,'project','project1','lorem ipsum','2016-10-24 09:26:44'),
  (2,0,'comment','HELLO 207','','2017-04-13 19:46:55'),
  (3,1,'discussion','FORO 2','ADFADS','2017-04-13 19:58:52'),
  (4,1,'discussion','FORO 2','ADFADS','2017-04-13 20:12:15'),
  (5,1,'discussion','FORO 2','ADFADS','2017-04-13 20:13:43'),
  (6,1,'discussion','FORO 2','ADFADS','2017-04-13 20:14:00'),
  (7,1,'discussion','FORO 2','ADFADS','2017-04-13 20:16:00'),
  (8,1,'discussion','FORO 2','ADFADS','2017-04-13 20:17:18'),
  (9,1,'discussion','FORO 2','ADFADS','2017-04-13 20:18:42'),
  (10,1,'discussion','FORO 2','ADFADS','2017-04-13 20:21:09'),
  (11,1,'discussion','FORO 2','ADFADS','2017-04-13 20:21:32'),
  (12,5,'comment','COMMENT 2','ASDF','2017-04-13 20:41:22'),
  (13,5,'comment','COMMENT 2','ASDF','2017-04-13 20:43:06'),
  (14,5,'comment','COMMENT 2','ASDF','2017-04-13 20:44:15'),
  (15,10,'task','DSSD','SDDS','2017-04-13 20:44:52');

COMMIT;

