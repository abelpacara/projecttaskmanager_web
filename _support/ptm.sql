-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2016 at 06:45 AM
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
  `post_date` timestamp NULL DEFAULT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_register_date` timestamp NULL DEFAULT NULL,
  `post_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
