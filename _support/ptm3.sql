# SQL Manager 2005 Lite for MySQL 3.7.7.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : ptm


SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `ptm`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `ptm`;

#
# Structure for the `inventories` table : 
#

CREATE TABLE `inventories` (
  `id_inventory` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_category_id` int(11) NOT NULL,
  `inventory_name` text NOT NULL,
  `inventory_mark` text NOT NULL,
  `inventory_model` text NOT NULL,
  `inventory_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inventory_quantity` int(11) NOT NULL,
  `inventory_buy_price` float NOT NULL,
  `inventory_description` text NOT NULL,
  PRIMARY KEY (`id_inventory`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Structure for the `inventories_categories` table : 
#

CREATE TABLE `inventories_categories` (
  `id_inventory_category` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_category_name` text NOT NULL,
  `inventory_category_description` text,
  PRIMARY KEY (`id_inventory_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Structure for the `kardexes` table : 
#

CREATE TABLE `kardexes` (
  `id_kardex` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) NOT NULL,
  `kardex_code` text NOT NULL,
  `kardex_serial` text NOT NULL,
  `kardex_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kardex`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `kardexes_status` table : 
#

CREATE TABLE `kardexes_status` (
  `id_kadex_status` int(11) NOT NULL AUTO_INCREMENT,
  `kardex_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `kardex_status_value` enum('alta','baja','reparacion') NOT NULL,
  `kardex_status_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kardex_status_description` int(11) NOT NULL,
  PRIMARY KEY (`id_kadex_status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Structure for the `locations` table : 
#

CREATE TABLE `locations` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` text NOT NULL,
  `location_description` text NOT NULL,
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

#
# Data for the `inventories` table  (LIMIT 0,500)
#

INSERT INTO `inventories` (`id_inventory`, `inventory_category_id`, `inventory_name`, `inventory_mark`, `inventory_model`, `inventory_register_date`, `inventory_quantity`, `inventory_buy_price`, `inventory_description`) VALUES 
  (1,1,'DELL VOSTRO','DELL','VOSTRO 19','2017-05-01 12:56:01',0,0,''),
  (2,2,'HP LASER JET ','ASDFSD','HP LASERJET P1102W','2017-05-01 12:56:56',0,0,''),
  (3,3,'EPSON','3223','EPSON TM-88V','2017-05-01 12:56:45',0,0,'');

COMMIT;

#
# Data for the `inventories_categories` table  (LIMIT 0,500)
#

INSERT INTO `inventories_categories` (`id_inventory_category`, `inventory_category_name`, `inventory_category_description`) VALUES 
  (1,'computadora',NULL),
  (2,'impresora laser',NULL),
  (3,'impresora termica',NULL);

COMMIT;

#
# Data for the `kardexes` table  (LIMIT 0,500)
#

INSERT INTO `kardexes` (`id_kardex`, `inventory_id`, `kardex_code`, `kardex_serial`, `kardex_register_date`) VALUES 
  (1,1,'2323ff','xxxxx','2017-04-15 21:50:59'),
  (2,2,'552','yyy','2017-04-16 18:10:13');

COMMIT;

#
# Data for the `kardexes_status` table  (LIMIT 0,500)
#

INSERT INTO `kardexes_status` (`id_kadex_status`, `kardex_id`, `location_id`, `kardex_status_value`, `kardex_status_register_date`, `kardex_status_description`) VALUES 
  (2,2,5,'baja','2017-04-16 18:10:13',0),
  (3,1,2,'alta','2017-04-17 01:03:13',0),
  (4,1,3,'alta','2017-04-17 01:05:22',0),
  (5,1,5,'reparacion','2017-04-17 01:06:03',0);

COMMIT;

#
# Data for the `locations` table  (LIMIT 0,500)
#

INSERT INTO `locations` (`id_location`, `location_name`, `location_description`) VALUES 
  (1,'Oficinal Regional La Paz',''),
  (2,'Autopista',''),
  (3,'Achica Arriba',''),
  (4,'Patacamaya A',''),
  (5,'Patacamaya B',''),
  (6,'Sica Sica',''),
  (7,'Urujara',''),
  (8,'Corapata',''),
  (9,'Laja','');

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

