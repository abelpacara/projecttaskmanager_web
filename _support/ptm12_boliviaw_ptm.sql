-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2017 at 09:02 PM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `boliviaw_ptm`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE IF NOT EXISTS `inventories` (
  `id_inventory` int(11) NOT NULL,
  `inventory_category_id` int(11) NOT NULL,
  `inventory_mark` text NOT NULL,
  `inventory_model` text NOT NULL,
  `inventory_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inventory_quantity` int(11) DEFAULT NULL,
  `inventory_buy_price` float DEFAULT NULL,
  `inventory_description` text
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id_inventory`, `inventory_category_id`, `inventory_mark`, `inventory_model`, `inventory_register_date`, `inventory_quantity`, `inventory_buy_price`, `inventory_description`) VALUES
(6, 6, 'HEWLETT PACKARD', 'PROLIANT ML 350 G6', '2017-05-19 23:23:51', NULL, NULL, NULL),
(7, 7, 'DAHUA', 'S/R', '2017-05-19 23:37:55', NULL, NULL, NULL),
(8, 8, 'CISCO', 'SF100-24V2', '2017-05-19 23:39:31', NULL, NULL, NULL),
(9, 6, 'DELL', 'POWER EDGE 2900', '2017-05-19 23:42:59', NULL, NULL, NULL),
(10, 9, 'ACER', '  V173', '2017-05-19 23:49:28', NULL, NULL, NULL),
(11, 8, 'SISCO', 'PSZ20171A93', '2017-05-19 23:50:52', NULL, NULL, NULL),
(12, 10, 'DELTA', 'GES1-13R202035', '2017-05-22 16:07:29', NULL, NULL, NULL),
(13, 10, 'DELTA', 'S/R', '2017-05-22 16:24:49', NULL, NULL, NULL),
(14, 11, 'LG', '32LK330', '2017-05-22 17:50:06', NULL, NULL, NULL),
(15, 12, 'HEWLETT PACKARD', 'L1710', '2017-05-22 18:06:24', NULL, NULL, NULL),
(16, 13, 'NUMBER PLATE', 'S/R', '2017-05-22 18:08:56', NULL, NULL, NULL),
(17, 6, 'DELL', 'QUAD CORE 3.2 GHZ. T20', '2017-05-22 18:41:34', NULL, NULL, NULL),
(18, 14, 'HEWLETT PACKARD', 'COMPAQ DC5700', '2017-05-22 18:46:16', NULL, NULL, NULL),
(19, 15, 'EPSON', 'TM-T88V M244A', '2017-05-22 18:57:01', NULL, NULL, NULL),
(20, 8, 'CISCO', 'CISSF110-24-NA', '2017-05-22 19:01:07', NULL, NULL, NULL),
(21, 16, 'FOXCONN', '', '2017-05-22 19:24:08', NULL, NULL, NULL),
(22, 14, 'ACER', 'VERITON', '2017-05-24 18:01:22', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventories_categories`
--

CREATE TABLE IF NOT EXISTS `inventories_categories` (
  `id_inventory_category` int(11) NOT NULL,
  `inventory_category_name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventories_categories`
--

INSERT INTO `inventories_categories` (`id_inventory_category`, `inventory_category_name`) VALUES
(6, 'SERVIDOR'),
(7, 'DVR'),
(8, 'SWITCH'),
(9, 'MONITOR'),
(10, 'BANCO DE BATERIAS'),
(11, 'Monitor TV'),
(12, 'MONITOR LCD 17'''''),
(13, 'CAMARA DE RECONOCIMIENTO'),
(14, 'Equipo PC torre'),
(15, 'IMPRESORA TERMICA'),
(16, 'NANO PC');

-- --------------------------------------------------------

--
-- Table structure for table `kardexes`
--

CREATE TABLE IF NOT EXISTS `kardexes` (
  `id_kardex` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `kardex_code` text NOT NULL,
  `kardex_serial` text NOT NULL,
  `kardex_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kardex_start_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kardexes`
--

INSERT INTO `kardexes` (`id_kardex`, `inventory_id`, `kardex_code`, `kardex_serial`, `kardex_register_date`, `kardex_start_date`) VALUES
(14, 6, '24312000233', 'MXQ9370678', '2017-05-19 23:23:51', '0000-00-00'),
(15, 7, '24350000026', 'S/R', '2017-05-19 23:37:55', '0000-00-00'),
(16, 8, '24350000075', 'PSZ185119VL', '2017-05-19 23:39:31', '0000-00-00'),
(17, 9, '24312000232', 'BLXWKH1', '2017-05-19 23:42:59', '0000-00-00'),
(18, 10, '24312000119', 'ETLE10D0929260D8078602', '2017-05-19 23:49:28', '0000-00-00'),
(19, 11, '24350000106', 'CISSF110-24-NA', '2017-05-19 23:50:52', '0000-00-00'),
(20, 12, '24312000235', 'A0Y09700131WE', '2017-05-22 16:07:29', '0000-00-00'),
(21, 13, '24312000236', 'S/R', '2017-05-22 16:24:49', '0000-00-00'),
(22, 14, '24350000002', '107RMWV0X929', '2017-05-22 17:50:06', '0000-00-00'),
(23, 15, '24312000137', '3CQ9343G2T', '2017-05-22 18:06:24', '0000-00-00'),
(24, 16, '24370000101', 'S/R', '2017-05-22 18:08:56', '0000-00-00'),
(25, 16, '24370000102', 'S/R', '2017-05-22 18:09:28', '0000-00-00'),
(26, 17, '24312000305', '8SFQ772', '2017-05-22 18:41:34', '0000-00-00'),
(27, 18, '24312000038', 'MXJ81604R1', '2017-05-22 18:46:16', '0000-00-00'),
(28, 19, '4312000619', 'MXFF341431', '2017-05-22 18:57:01', '0000-00-00'),
(29, 20, '24350000101', 'PSZ19071B57', '2017-05-22 19:01:07', '0000-00-00'),
(30, 21, '', 'THF11F020550900484', '2017-05-22 19:24:08', '0000-00-00'),
(31, 22, '24312000017', 'PS00819669936000310100', '2017-05-24 18:01:22', '0000-00-00'),
(32, 17, '24312000303', 'J9FQ772', '2017-05-24 19:03:44', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `kardexes_status`
--

CREATE TABLE IF NOT EXISTS `kardexes_status` (
  `id_kardex_status` int(11) NOT NULL,
  `kardex_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `maintenance_id` int(11) DEFAULT NULL,
  `kardex_status_value` enum('en funcionamiento - bueno','en funcionamiento - regular','en funcionamiento - tiende a malo','inactivo/respaldo - bueno','inactivo/respaldo - regular','inactivo/respaldo - tiende a malo','nuevo en almacen','en reparacion - regular','en reparacion - tiende a malo','baja') NOT NULL,
  `kardex_status_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kardex_status_register_date` date DEFAULT NULL,
  `kardex_status_description` text
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kardexes_status`
--

INSERT INTO `kardexes_status` (`id_kardex_status`, `kardex_id`, `location_id`, `maintenance_id`, `kardex_status_value`, `kardex_status_timestamp`, `kardex_status_register_date`, `kardex_status_description`) VALUES
(25, 14, 2, NULL, 'en funcionamiento - regular', '2017-05-19 23:23:51', '2017-05-19', ''),
(26, 15, 2, NULL, 'en funcionamiento - regular', '2017-05-19 23:37:55', '2017-05-19', ''),
(27, 16, 2, NULL, 'en funcionamiento - regular', '2017-05-19 23:39:31', '2017-05-19', ''),
(28, 17, 2, NULL, 'en funcionamiento - regular', '2017-05-19 23:42:59', '2017-05-19', ''),
(29, 17, 2, 29, 'inactivo/respaldo - regular', '2017-05-19 23:45:57', '2017-05-19', NULL),
(30, 14, 2, 29, 'inactivo/respaldo - regular', '2017-05-19 23:45:57', '2017-05-19', NULL),
(31, 18, 1, NULL, 'en funcionamiento - regular', '2017-05-19 23:49:28', '2017-05-19', ''),
(32, 19, 1, NULL, 'en funcionamiento - regular', '2017-05-19 23:50:52', '2017-05-19', ''),
(33, 19, 1, 30, 'en funcionamiento - regular', '2017-05-19 23:51:33', '2017-05-19', NULL),
(34, 19, 1, 31, 'en funcionamiento - regular', '2017-05-19 23:56:17', '2017-05-19', NULL),
(35, 18, 1, 31, 'en funcionamiento - regular', '2017-05-19 23:56:17', '2017-05-19', NULL),
(36, 16, 2, 32, 'en funcionamiento - regular', '2017-05-19 23:58:09', '2017-05-19', NULL),
(37, 18, 1, 33, 'en funcionamiento - regular', '2017-05-20 00:19:42', '2017-05-19', NULL),
(38, 20, 2, NULL, 'en funcionamiento - regular', '2017-05-22 16:07:29', '2017-05-22', ''),
(39, 21, 2, NULL, 'en funcionamiento - regular', '2017-05-22 16:24:49', '2017-05-22', ''),
(40, 22, 2, NULL, 'en funcionamiento - regular', '2017-05-22 17:50:06', '2017-05-22', ''),
(41, 23, 2, NULL, 'en funcionamiento - regular', '2017-05-22 18:06:24', '2017-05-22', ''),
(42, 24, 2, NULL, 'en funcionamiento - regular', '2017-05-22 18:08:56', '2017-05-22', ''),
(43, 25, 2, NULL, 'en funcionamiento - regular', '2017-05-22 18:09:28', '2017-05-22', ''),
(44, 26, 3, NULL, 'en funcionamiento - regular', '2017-05-22 18:41:34', '2017-05-22', ''),
(45, 27, 25, NULL, 'en funcionamiento - regular', '2017-05-22 18:46:16', '2017-05-22', ''),
(46, 28, 25, NULL, 'en funcionamiento - regular', '2017-05-22 18:57:01', '2017-05-22', ''),
(47, 29, 3, NULL, 'en funcionamiento - regular', '2017-05-22 19:01:07', '2017-05-22', ''),
(48, 29, 3, 34, 'en funcionamiento - regular', '2017-05-22 19:04:27', '2017-04-06', NULL),
(49, 26, 3, 34, 'en funcionamiento - regular', '2017-05-22 19:04:27', '2017-04-06', NULL),
(50, 30, 13, NULL, 'en funcionamiento - regular', '2017-05-22 19:24:08', '2017-05-20', ''),
(51, 30, 13, 35, 'en funcionamiento - regular', '2017-05-22 19:25:47', '2017-05-20', NULL),
(52, 31, 2, NULL, 'en funcionamiento - regular', '2017-05-23 18:01:22', '2017-05-23', ''),
(53, 31, 2, 36, 'en funcionamiento - regular', '2017-05-23 18:23:38', '2017-05-23', NULL),
(54, 32, 2, NULL, 'en funcionamiento - bueno', '2017-05-24 19:03:44', '2017-05-16', ''),
(55, 32, 2, 34, 'en funcionamiento - regular', '2017-05-19 05:00:00', '2017-05-19', NULL),
(56, 32, 2, 34, 'en funcionamiento - regular', '2017-05-19 05:00:00', '2017-05-19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id_location` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `location_name` text NOT NULL,
  `location_description` text
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id_location`, `parent_id`, `location_name`, `location_description`) VALUES
(1, NULL, 'Oficinal Regional La Paz', ''),
(2, NULL, 'Autopista, Oficina', ''),
(3, NULL, 'Achica Arriba, Oficina', ''),
(4, NULL, 'Patacamaya A, Oficina', ''),
(5, NULL, 'Patacamaya B, Oficina', ''),
(6, NULL, 'Sica Sica, Oficina', ''),
(7, NULL, 'Urujara, Oficina', ''),
(8, NULL, 'Corapata, Oficina', ''),
(9, NULL, 'Laja, Oficina', ''),
(10, 2, 'Autopista, carril1', NULL),
(11, 2, 'Autopista, carril2', NULL),
(12, 2, 'Autopista, carril3', NULL),
(13, 3, 'Achica Arriba, carril1', NULL),
(14, 7, 'Autopista, Dormitorio', NULL),
(15, 1, 'Oficinal Regional La Paz, RHH', NULL),
(16, 15, 'Oficina Regional La Paz, Servicios General', NULL),
(17, NULL, 'Autopista, carril4', NULL),
(18, NULL, 'Autopista, carril5', NULL),
(19, NULL, 'Autopista, carril4', NULL),
(20, NULL, 'Autopista, carril5', NULL),
(21, NULL, 'Autopista, carril6', NULL),
(22, NULL, 'Autopista, carril7', NULL),
(23, NULL, 'Autopista, carril8', NULL),
(24, NULL, 'Achica Arriba, carril2', NULL),
(25, NULL, 'Achica Arriba, carril3', NULL),
(28, NULL, 'Patacamaya A, Carril2', NULL),
(30, NULL, 'Urujara, Carril1', NULL),
(33, NULL, 'Urujara, Carril2', NULL),
(34, NULL, 'Corapata, Carril1', NULL),
(36, NULL, 'Patacamaya B, Carril1', NULL),
(39, NULL, 'Patacamaya B, Carril2', NULL),
(40, NULL, 'Patacamaya B, Carril3', NULL),
(42, NULL, 'Corapata, carril2', NULL),
(44, NULL, 'Laja, Carril1', NULL),
(47, NULL, 'Laja, Carril2', NULL),
(48, NULL, 'Laja, Carril3', NULL),
(50, NULL, 'Sica Sica, carril1', NULL),
(51, NULL, 'Sica Sica, carril2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `maintenances`
--

CREATE TABLE IF NOT EXISTS `maintenances` (
  `id_maintenance` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `maintenance_register_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `maintenance_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenances`
--

INSERT INTO `maintenances` (`id_maintenance`, `location_id`, `maintenance_register_date`, `maintenance_description`) VALUES
(29, 2, '2017-05-19 23:45:57', 'Reemplazo por equipo Nuevo'),
(30, 1, '2017-05-19 23:51:33', 'Se instalo en reemplado de equipo antiguo'),
(31, 1, '2017-05-19 23:56:17', 'Limpieza de equipos'),
(32, 2, '2017-05-19 23:58:09', 'man'),
(33, 1, '2017-05-20 00:19:42', 'Limpieza general'),
(34, 3, '2017-04-06 19:04:27', 'Instalacion y/o recambio de Equipos Antiguos'),
(35, 13, '2017-05-20 19:25:47', 'correccion de falla de rosetas por version atigua de WIN_SISCAP en carril 1, reten de Achica Arriba'),
(36, 2, '2017-05-23 19:00:00', 'Se reinstalo sistema operativo Ubuntu con windows7 virtualizado y paquetes ofimanticos');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `post_type` enum('project','discussion','task','comment') NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id_post`, `parent_id`, `post_type`, `post_title`, `post_content`, `post_register_date`) VALUES
(1, 0, 'project', 'project1', 'lorem ipsum', '2016-10-24 14:26:44'),
(2, 0, 'comment', 'HELLO 207', '', '2017-04-14 00:46:55'),
(3, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 00:58:52'),
(4, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 01:12:15'),
(5, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 01:13:43'),
(6, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 01:14:00'),
(7, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 01:16:00'),
(8, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 01:17:18'),
(9, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 01:18:42'),
(10, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 01:21:09'),
(11, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 01:21:32'),
(12, 5, 'comment', 'COMMENT 2', 'ASDF', '2017-04-14 01:41:22'),
(13, 5, 'comment', 'COMMENT 2', 'ASDF', '2017-04-14 01:43:06'),
(14, 5, 'comment', 'COMMENT 2', 'ASDF', '2017-04-14 01:44:15'),
(15, 10, 'task', 'DSSD', 'SDDS', '2017-04-14 01:44:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id_inventory`);

--
-- Indexes for table `inventories_categories`
--
ALTER TABLE `inventories_categories`
  ADD PRIMARY KEY (`id_inventory_category`);

--
-- Indexes for table `kardexes`
--
ALTER TABLE `kardexes`
  ADD PRIMARY KEY (`id_kardex`);

--
-- Indexes for table `kardexes_status`
--
ALTER TABLE `kardexes_status`
  ADD PRIMARY KEY (`id_kardex_status`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id_location`);

--
-- Indexes for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`id_maintenance`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id_inventory` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `inventories_categories`
--
ALTER TABLE `inventories_categories`
  MODIFY `id_inventory_category` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `kardexes`
--
ALTER TABLE `kardexes`
  MODIFY `id_kardex` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `kardexes_status`
--
ALTER TABLE `kardexes_status`
  MODIFY `id_kardex_status` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `id_maintenance` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
