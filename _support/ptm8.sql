# SQL Manager 2005 Lite for MySQL 3.7.7.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : ptm


SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the `inventories` table : 
#

<<<<<<< HEAD
DROP TABLE IF EXISTS `inventories`;

=======
>>>>>>> master
CREATE TABLE `inventories` (
  `id_inventory` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_category_id` int(11) NOT NULL,
  `inventory_mark` text NOT NULL,
  `inventory_model` text NOT NULL,
  `inventory_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inventory_quantity` int(11) NOT NULL,
  `inventory_buy_price` float NOT NULL,
  `inventory_description` text,
  PRIMARY KEY (`id_inventory`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `inventories_categories` table : 
#

<<<<<<< HEAD
DROP TABLE IF EXISTS `inventories_categories`;

=======
>>>>>>> master
CREATE TABLE `inventories_categories` (
  `id_inventory_category` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_category_name` text NOT NULL,
  PRIMARY KEY (`id_inventory_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `kardexes` table : 
#

<<<<<<< HEAD
DROP TABLE IF EXISTS `kardexes`;

=======
>>>>>>> master
CREATE TABLE `kardexes` (
  `id_kardex` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) NOT NULL,
  `kardex_code` text NOT NULL,
  `kardex_serial` text NOT NULL,
  `kardex_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kardex`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `kardexes_status` table : 
#

<<<<<<< HEAD
DROP TABLE IF EXISTS `kardexes_status`;

=======
>>>>>>> master
CREATE TABLE `kardexes_status` (
  `id_kardex_status` int(11) NOT NULL AUTO_INCREMENT,
  `kardex_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `kardex_status_value` enum('alta','baja','reparacion') NOT NULL,
  `kardex_status_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kardex_status_register_date` date DEFAULT NULL,
  `kardex_status_description` text,
  PRIMARY KEY (`id_kardex_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `locations` table : 
#

<<<<<<< HEAD
DROP TABLE IF EXISTS `locations`;

=======
>>>>>>> master
CREATE TABLE `locations` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `location_name` text NOT NULL,
  `location_description` text,
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

#
# Structure for the `posts` table : 
#

<<<<<<< HEAD
DROP TABLE IF EXISTS `posts`;

=======
>>>>>>> master
CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `post_type` enum('project','discussion','task','comment') NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for the `locations` table  (LIMIT 0,500)
#

INSERT INTO `locations` (`id_location`, `parent_id`, `location_name`, `location_description`) VALUES 
  (1,NULL,'Oficina Regional La Paz',NULL),
  (2,NULL,'Autopista oficina',NULL),
  (3,NULL,'Autopista carril 1',NULL),
  (4,NULL,'Autopista carril 2',NULL),
  (5,NULL,'Autopista carril 3',NULL),
  (6,NULL,'Autopista carril 4',NULL),
  (7,NULL,'Autopista carril 5',NULL),
  (8,NULL,'Autopista carril 6',NULL),
  (9,NULL,'Autopista carril 7',NULL),
  (10,NULL,'Autopista carril 8',NULL),
  (13,NULL,'Achica Arriba oficina',NULL),
  (14,NULL,'Achica Arriba carril 1',NULL),
  (15,NULL,'Achica Arriba carril 2',NULL),
  (16,NULL,'Achica Arriba carril 3',NULL),
  (17,NULL,'Patacamaya B oficina',NULL),
  (18,NULL,'Patacamaya B carril 1',NULL),
  (19,NULL,'Patacamaya B carril 2',NULL),
  (20,NULL,'Patacamaya B carril 3',NULL),
  (22,NULL,'Patacamaya A oficina',NULL),
  (23,NULL,'Patacamaya A carril 2',NULL),
  (24,NULL,'Sica Sica Oficina',NULL),
  (25,NULL,'Sica Sica carril 1',NULL),
  (26,NULL,'Sica Sica carril 2',NULL),
  (27,NULL,'Konani',NULL),
  (28,NULL,'Urujara Oficina',NULL),
  (29,NULL,'Urujara carril 1',NULL),
  (30,NULL,'Urujara carril 2',NULL),
  (31,NULL,'Laja Oficina',NULL),
  (32,NULL,'Laja Carril 1',NULL),
  (33,NULL,'Laja Carril 2',NULL),
  (34,NULL,'Laja Carril Pesaje',NULL),
  (35,NULL,'Corapata Oficina',NULL),
  (36,NULL,'Corapata Carril 1',NULL),
  (37,NULL,'Corapata Carril 2',NULL),
  (38,NULL,'Viacha 1',NULL),
  (39,NULL,'Guanay',NULL),
  (40,NULL,'Sapecho',NULL),
  (41,NULL,'Caranavi',NULL),
  (42,NULL,'Coaine km6',NULL);

COMMIT;

