-- phpMyAdmin SQL Dump
<<<<<<< HEAD
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2016 at 06:45 AM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
=======
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2017 at 12:24 AM
-- Server version: 5.7.17-0ubuntu0.16.04.2
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
>>>>>>> origin/feature/INVENTARIOS
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptm`
--

-- --------------------------------------------------------

--
<<<<<<< HEAD
=======
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id_inventory` int(11) NOT NULL,
  `inventory_category_id` int(11) NOT NULL,
  `inventory_mark` text NOT NULL,
  `inventory_model` text NOT NULL,
  `inventory_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inventory_quantity` int(11) NOT NULL,
  `inventory_buy_price` float NOT NULL,
  `inventory_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id_inventory`, `inventory_category_id`, `inventory_mark`, `inventory_model`, `inventory_register_date`, `inventory_quantity`, `inventory_buy_price`, `inventory_description`) VALUES
(1, 1, 'DELL', 'VOSTRO 19', '2017-04-18 02:47:03', 0, 0, ''),
(2, 2, 'ASDFSD', 'ADF', '2017-04-18 02:47:16', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `inventories_categories`
--

CREATE TABLE `inventories_categories` (
  `id_inventory_category` int(11) NOT NULL,
  `inventory_category_name` text NOT NULL,
  `inventory_category_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventories_categories`
--

INSERT INTO `inventories_categories` (`id_inventory_category`, `inventory_category_name`, `inventory_category_description`) VALUES
(1, 'COMPUTADORA', ''),
(2, 'IMPRESORA', '');

-- --------------------------------------------------------

--
-- Table structure for table `kardexes`
--

CREATE TABLE `kardexes` (
  `id_kardex` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `kardex_code` text NOT NULL,
  `kardex_serial` text NOT NULL,
  `kardex_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kardexes`
--

INSERT INTO `kardexes` (`id_kardex`, `inventory_id`, `kardex_code`, `kardex_serial`, `kardex_register_date`) VALUES
(1, 1, '2323ff', 'rqwerwer', '2017-04-16 01:50:59'),
(2, 2, '552', 'ADSFSADF', '2017-04-16 22:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `kardexes_status`
--

CREATE TABLE `kardexes_status` (
  `id_kadex_status` int(11) NOT NULL,
  `kardex_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `kardex_status_value` enum('alta','baja','reparacion') NOT NULL,
  `kardex_status_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kardex_status_description` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kardexes_status`
--

INSERT INTO `kardexes_status` (`id_kadex_status`, `kardex_id`, `location_id`, `kardex_status_value`, `kardex_status_register_date`, `kardex_status_description`) VALUES
(2, 2, 5, 'baja', '2017-04-16 22:10:13', 0),
(3, 1, 2, 'alta', '2017-04-17 05:03:13', 0),
(4, 1, 3, 'alta', '2017-04-17 05:05:22', 0),
(5, 1, 5, 'reparacion', '2017-04-17 05:06:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id_location` int(11) NOT NULL,
  `location_name` text NOT NULL,
  `location_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id_location`, `location_name`, `location_description`) VALUES
(1, 'Oficinal Regional La Paz', ''),
(2, 'Autopista', ''),
(3, 'Achica Arriba', ''),
(4, 'Patacamaya A', ''),
(5, 'Patacamaya B', ''),
(6, 'Sica Sica', ''),
(7, 'Urujara', ''),
(8, 'Corapata', ''),
(9, 'Laja', '');

-- --------------------------------------------------------

--
>>>>>>> origin/feature/INVENTARIOS
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
<<<<<<< HEAD
  `post_type` enum('project','forum','task','comment') DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `post_date` timestamp NULL DEFAULT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_register_date` timestamp NULL DEFAULT NULL,
  `post_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
=======
  `parent_id` int(11) NOT NULL,
  `post_type` enum('project','discussion','task','comment') NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
>>>>>>> origin/feature/INVENTARIOS
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

<<<<<<< HEAD
INSERT INTO `posts` (`id_post`, `post_type`, `parent_id`, `project_id`, `post_date`, `post_title`, `post_content`, `post_register_date`, `post_update_date`) VALUES
(1, 'project', NULL, NULL, NULL, 'SOPORTE TELEPEAJE', '', NULL, '2016-03-18 10:21:06'),
(2, 'project', NULL, NULL, NULL, 'SOPORTE SISCAP', '', NULL, '2016-03-18 10:22:24'),
(3, 'project', NULL, NULL, NULL, 'SOPORTE OFICINA', '', NULL, '2016-03-18 10:23:44'),
(4, 'forum', 1, 1, NULL, '', 'Seguimiento equipos telepeaje', NULL, '2016-03-18 10:34:17'),
(5, 'forum', 2, 2, NULL, '', 'seguimiento equipos SISCAP', NULL, '2016-03-18 10:34:28'),
(6, 'forum', 3, 3, NULL, '', 'seguimiento equipos oficina', NULL, '2016-03-18 10:34:38'),
(10, 'comment', 4, 1, NULL, '\r\n', '29 de febrero 2016 alrededor 15:45\r\n\r\nCorte de energia electrica provoco problemas en KM10 / carril 1\r\n\r\nhizo que la barrera funcionara de forma anormal', '0000-00-00 00:00:00', '2016-03-18 10:32:41'),
(12, 'comment', 4, 1, NULL, '', 'En fecha: 1 de marzo 2016 alrededor de 11:15am se produjo, altas bajas tensiones de energia provoco que la alarma y barrera funcionaran de forma anormal. Por lo cual se detuvo la barrera y alarma.', '2016-03-02 04:12:24', '2016-03-18 10:32:53'),
(13, 'comment', 4, 1, NULL, '', 'Se puso nuevamente en funcionamiento la barrera y alarma\r\n\r\nen fecha 02 marzo 2016 alrededor de las 10am', '2016-03-02 11:36:27', '2016-03-18 10:33:02'),
(14, 'comment', 4, 1, NULL, '', 'en fecha 02/03/2016 aldrededor de 13:36 a 13:38 salio\r\nerror PLC fuera de servicio en KM10/carril1, provocando bloque en semaforo/verde y barrera/arriba, posterior a 2,3 pasos con simulacion de paso se puso en normal funcionamiento', '2016-03-02 19:54:47', '2016-03-18 10:33:12'),
(15, 'comment', 4, 1, NULL, '', 'fecha 02/03/2016 alrededor de 15:17 nuevamente la barrera se ha bloqueado en los 2 carriles al mismo tiempo.', '2016-03-02 19:56:33', '2016-03-18 10:33:23'),
(16, 'comment', 4, 1, NULL, '', 'fecha 02/03/2016 a 15:18\r\npara subsanar de alguna manera los problemas de la barrera se ha reiniciado VIA y tambien se ha reiniciado el EQUIPO', '2016-03-02 19:58:31', '2016-03-18 10:33:46'),
(18, 'comment', 4, 1, NULL, '', 'reemplazar/revisar interruptores barrera km10/carril1', '2016-03-05 00:55:53', '2016-03-18 10:35:18'),
(19, 'comment', 4, 1, NULL, '', 'generar formulario RECARGAS TELEPEAJE', '2016-03-05 00:56:23', '2016-03-18 10:35:39'),
(20, 'comment', 6, 3, NULL, '', 'revisar impresora VICENTA', '2016-03-05 00:56:41', '2016-03-18 10:36:23'),
(21, 'comment', 5, 2, NULL, '', 'preguntar por ACTUALIZACION SISCAP ROSETAS para CONFITAL', '2016-03-05 00:57:09', '2016-03-18 10:37:04'),
(22, 'comment', 4, 1, NULL, '', 'Preguntar por EMPADRONAMIENTO GOBERNACION', '2016-03-05 00:57:26', '2016-03-18 10:37:29'),
(23, 'comment', 6, 3, NULL, '', 'responder DOCUMENTOS/REQUERIMIENTOS YAPURA', '2016-03-05 00:59:20', '2016-03-18 10:37:42');
=======
INSERT INTO `posts` (`id_post`, `parent_id`, `post_type`, `post_title`, `post_content`, `post_register_date`) VALUES
(1, 0, 'project', 'project1', 'lorem ipsum', '2016-10-24 13:26:44'),
(2, 0, 'comment', 'HELLO 207', '', '2017-04-13 23:46:55'),
(3, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-13 23:58:52'),
(4, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 00:12:15'),
(5, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 00:13:43'),
(6, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 00:14:00'),
(7, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 00:16:00'),
(8, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 00:17:18'),
(9, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 00:18:42'),
(10, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 00:21:09'),
(11, 1, 'discussion', 'FORO 2', 'ADFADS', '2017-04-14 00:21:32'),
(12, 5, 'comment', 'COMMENT 2', 'ASDF', '2017-04-14 00:41:22'),
(13, 5, 'comment', 'COMMENT 2', 'ASDF', '2017-04-14 00:43:06'),
(14, 5, 'comment', 'COMMENT 2', 'ASDF', '2017-04-14 00:44:15'),
(15, 10, 'task', 'DSSD', 'SDDS', '2017-04-14 00:44:52');
>>>>>>> origin/feature/INVENTARIOS

--
-- Indexes for dumped tables
--

--
<<<<<<< HEAD
=======
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
  ADD PRIMARY KEY (`id_kadex_status`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id_location`);

--
>>>>>>> origin/feature/INVENTARIOS
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

--
-- AUTO_INCREMENT for dumped tables
--

--
<<<<<<< HEAD
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
=======
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id_inventory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `inventories_categories`
--
ALTER TABLE `inventories_categories`
  MODIFY `id_inventory_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kardexes`
--
ALTER TABLE `kardexes`
  MODIFY `id_kardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kardexes_status`
--
ALTER TABLE `kardexes_status`
  MODIFY `id_kadex_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;COMMIT;

>>>>>>> origin/feature/INVENTARIOS
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
