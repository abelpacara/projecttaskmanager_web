-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2016 at 12:38 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `post_type` enum('project','forum','task','comment') DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `forum_id` int(11) DEFAULT NULL,
  `post_date` timestamp NULL DEFAULT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_register_date` timestamp NULL DEFAULT NULL,
  `post_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id_post`, `post_type`, `parent_id`, `project_id`, `forum_id`, `post_date`, `post_title`, `post_content`, `post_register_date`, `post_update_date`) VALUES
(1, 'project', NULL, NULL, NULL, NULL, '', 'SOPORTE TELEPEAJE', NULL, '2016-03-19 03:41:16'),
(2, 'project', NULL, NULL, NULL, NULL, '', 'SOPORTE SISCAP', NULL, '2016-03-19 03:41:31'),
(3, 'project', NULL, NULL, NULL, NULL, '', 'SOPORTE OFICINA', NULL, '2016-03-19 03:41:43'),
(4, 'forum', 1, 1, NULL, NULL, '', 'Seguimiento equipos telepeaje', NULL, '2016-03-18 10:34:17'),
(5, 'forum', 2, 2, NULL, NULL, '', 'seguimiento equipos SISCAP', NULL, '2016-03-18 10:34:28'),
(6, 'forum', 3, 3, NULL, NULL, '', 'seguimiento equipos oficina', NULL, '2016-03-18 10:34:38'),
(10, 'comment', 4, 1, 4, NULL, '\r\n', '29 de febrero 2016 alrededor 15:45\r\n\r\nCorte de energia electrica provoco problemas en KM10 / carril 1\r\n\r\nhizo que la barrera funcionara de forma anormal', '0000-00-00 00:00:00', '2016-03-19 04:09:02'),
(12, 'comment', 4, 1, 4, NULL, '', 'En fecha: 1 de marzo 2016 alrededor de 11:15am se produjo, altas bajas tensiones de energia provoco que la alarma y barrera funcionaran de forma anormal. Por lo cual se detuvo la barrera y alarma.', '2016-03-02 04:12:24', '2016-03-19 04:09:14'),
(13, 'comment', 4, 1, 4, NULL, '', 'Se puso nuevamente en funcionamiento la barrera y alarma\r\n\r\nen fecha 02 marzo 2016 alrededor de las 10am', '2016-03-02 11:36:27', '2016-03-19 04:09:30'),
(14, 'comment', 4, 1, 4, NULL, '', 'en fecha 02/03/2016 aldrededor de 13:36 a 13:38 salio\r\nerror PLC fuera de servicio en KM10/carril1, provocando bloque en semaforo/verde y barrera/arriba, posterior a 2,3 pasos con simulacion de paso se puso en normal funcionamiento', '2016-03-02 19:54:47', '2016-03-19 04:09:47'),
(15, 'comment', 4, 1, 4, NULL, '', 'fecha 02/03/2016 alrededor de 15:17 nuevamente la barrera se ha bloqueado en los 2 carriles al mismo tiempo.', '2016-03-02 19:56:33', '2016-03-19 04:09:59'),
(16, 'comment', 4, 1, 4, NULL, '', 'fecha 02/03/2016 a 15:18\r\npara subsanar de alguna manera los problemas de la barrera se ha reiniciado VIA y tambien se ha reiniciado el EQUIPO', '2016-03-02 19:58:31', '2016-03-19 04:10:12'),
(18, 'comment', 4, 1, 4, NULL, '', 'reemplazar/revisar interruptores barrera km10/carril1', '2016-03-05 00:55:53', '2016-03-19 04:10:25'),
(19, 'comment', 4, 1, 4, NULL, '', 'generar formulario RECARGAS TELEPEAJE', '2016-03-05 00:56:23', '2016-03-19 04:10:41'),
(20, 'comment', 6, 3, 6, NULL, '', 'revisar impresora VICENTA', '2016-03-05 00:56:41', '2016-03-19 04:11:00'),
(21, 'comment', 5, 2, 5, NULL, '', 'preguntar por ACTUALIZACION SISCAP ROSETAS para CONFITAL', '2016-03-05 00:57:09', '2016-03-19 04:11:13'),
(22, 'comment', 4, 1, 4, NULL, '', 'Preguntar por EMPADRONAMIENTO GOBERNACION', '2016-03-05 00:57:26', '2016-03-19 04:11:25'),
(23, 'comment', 6, 3, NULL, NULL, '', 'responder DOCUMENTOS/REQUERIMIENTOS YAPURA', '2016-03-05 00:59:20', '2016-03-18 10:37:42'),
(24, 'project', NULL, NULL, NULL, NULL, '', 'NEW PROJECT 1', '2016-03-19 03:36:11', '2016-03-19 03:36:11'),
(25, 'project', NULL, NULL, NULL, NULL, '', 'NEW PROJECT 2', '2016-03-19 03:43:09', '2016-03-19 03:43:09'),
(26, 'forum', 25, 25, NULL, NULL, '', 'LOREM IPSUM', '2016-03-19 03:43:25', '2016-03-19 03:43:25'),
(32, 'project', NULL, NULL, NULL, NULL, '', 'ENVIOS', '2016-03-22 01:01:56', '2016-03-22 01:01:56'),
(39, 'comment', 26, 25, 26, NULL, '', '26 25 null', '2016-03-22 01:31:34', '2016-03-22 01:31:34'),
(40, 'forum', 32, 32, NULL, NULL, '', 'COBROS Por envios', '2016-03-22 18:06:34', '2016-03-22 18:06:34'),
(41, 'forum', 32, 32, NULL, NULL, '', 'guias de envios', '2016-03-22 18:10:07', '2016-03-22 18:10:07'),
(42, 'forum', 32, 32, NULL, NULL, '', '', '2016-03-22 18:14:53', '2016-03-22 18:14:53'),
(43, 'forum', 32, 32, NULL, NULL, '', 'NEW FORUM', '2016-03-22 18:46:48', '2016-03-22 18:46:48'),
(44, 'forum', 32, 32, NULL, NULL, '', 'test 3', '2016-03-22 19:08:24', '2016-03-22 19:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `selectables`
--

CREATE TABLE `selectables` (
  `id_selectable` int(11) NOT NULL,
  `selectable_name` text,
  `selectable_value` text,
  `selectable_table` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selectables`
--

INSERT INTO `selectables` (`id_selectable`, `selectable_name`, `selectable_value`, `selectable_table`) VALUES
(1, 'post_type', 'project', 'posts'),
(2, 'post_type', 'forum', 'posts'),
(3, 'post_type', 'comment', 'posts');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `selectables`
--
ALTER TABLE `selectables`
  ADD PRIMARY KEY (`id_selectable`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `selectables`
--
ALTER TABLE `selectables`
  MODIFY `id_selectable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
