-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2016 at 12:09 AM
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
  `user_id` int(11) NOT NULL,
  `post_type` enum('project','forum','task','comment','file') DEFAULT NULL,
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

INSERT INTO `posts` (`id_post`, `user_id`, `post_type`, `parent_id`, `project_id`, `forum_id`, `post_date`, `post_title`, `post_content`, `post_register_date`, `post_update_date`) VALUES
(1, 1, 'project', NULL, NULL, NULL, NULL, '', 'SOPORTE TELEPEAJE', NULL, '2016-05-24 18:13:08'),
(2, 1, 'project', NULL, NULL, NULL, NULL, '', 'SOPORTE SISCAP', NULL, '2016-05-24 18:13:52'),
(3, 1, 'project', NULL, NULL, NULL, NULL, '', 'SOPORTE OFICINA', NULL, '2016-05-24 18:13:52'),
(4, 1, 'forum', 1, 1, NULL, NULL, '', 'Seguimiento equipos telepeaje', NULL, '2016-05-24 18:13:52'),
(5, 1, 'forum', 2, 2, NULL, NULL, '', 'seguimiento equipos SISCAP', NULL, '2016-05-24 18:13:52'),
(6, 1, 'forum', 3, 3, NULL, NULL, '', 'seguimiento equipos oficina', NULL, '2016-05-24 18:13:52'),
(10, 1, 'comment', 4, 1, 4, NULL, '\r\n', '29 de febrero 2016 alrededor 15:45\r\n\r\nCorte de energia electrica provoco problemas en KM10 / carril 1\r\n\r\nhizo que la barrera funcionara de forma anormal', '0000-00-00 00:00:00', '2016-05-24 18:13:52'),
(12, 1, 'comment', 4, 1, 4, NULL, '', 'En fecha: 1 de marzo 2016 alrededor de 11:15am se produjo, altas bajas tensiones de energia provoco que la alarma y barrera funcionaran de forma anormal. Por lo cual se detuvo la barrera y alarma.', '2016-03-02 04:12:24', '2016-05-24 18:13:52'),
(13, 1, 'comment', 4, 1, 4, NULL, '', 'Se puso nuevamente en funcionamiento la barrera y alarma\r\n\r\nen fecha 02 marzo 2016 alrededor de las 10am', '2016-03-02 11:36:27', '2016-05-24 18:13:52'),
(14, 1, 'comment', 4, 1, 4, NULL, '', 'en fecha 02/03/2016 aldrededor de 13:36 a 13:38 salio\r\nerror PLC fuera de servicio en KM10/carril1, provocando bloque en semaforo/verde y barrera/arriba, posterior a 2,3 pasos con simulacion de paso se puso en normal funcionamiento', '2016-03-02 19:54:47', '2016-05-24 18:13:52'),
(15, 1, 'comment', 4, 1, 4, NULL, '', 'fecha 02/03/2016 alrededor de 15:17 nuevamente la barrera se ha bloqueado en los 2 carriles al mismo tiempo.', '2016-03-02 19:56:33', '2016-05-24 18:13:52'),
(16, 1, 'comment', 4, 1, 4, NULL, '', 'fecha 02/03/2016 a 15:18\r\npara subsanar de alguna manera los problemas de la barrera se ha reiniciado VIA y tambien se ha reiniciado el EQUIPO', '2016-03-02 19:58:31', '2016-05-24 18:13:52'),
(18, 1, 'comment', 4, 1, 4, NULL, '', 'reemplazar/revisar interruptores barrera km10/carril1', '2016-03-05 00:55:53', '2016-05-24 18:13:52'),
(19, 1, 'comment', 4, 1, 4, NULL, '', 'generar formulario RECARGAS TELEPEAJE', '2016-03-05 00:56:23', '2016-05-24 18:13:52'),
(20, 1, 'comment', 6, 3, 6, NULL, '', 'revisar impresora VICENTA', '2016-03-05 00:56:41', '2016-05-24 18:13:52'),
(21, 1, 'comment', 5, 2, 5, NULL, '', 'preguntar por ACTUALIZACION SISCAP ROSETAS para CONFITAL', '2016-03-05 00:57:09', '2016-05-24 18:13:52'),
(22, 1, 'comment', 4, 1, 4, NULL, '', 'Preguntar por EMPADRONAMIENTO GOBERNACION', '2016-03-05 00:57:26', '2016-05-24 18:13:52'),
(23, 1, 'comment', 6, 3, NULL, NULL, '', 'responder DOCUMENTOS/REQUERIMIENTOS YAPURA', '2016-03-05 00:59:20', '2016-05-24 18:13:52'),
(24, 2, 'project', NULL, NULL, NULL, NULL, '', 'NEW PROJECT 1', '2016-03-19 03:36:11', '2016-05-25 01:50:32'),
(25, 2, 'project', NULL, NULL, NULL, NULL, '', 'NEW PROJECT 2', '2016-03-19 03:43:09', '2016-05-25 01:50:45'),
(26, 1, 'forum', 25, 25, NULL, NULL, '', 'LOREM IPSUM', '2016-03-19 03:43:25', '2016-05-24 18:13:52'),
(32, 2, 'project', NULL, NULL, NULL, NULL, '', 'ENVIOS', '2016-03-22 01:01:56', '2016-05-25 01:30:42'),
(40, 2, 'forum', 32, 32, NULL, NULL, '', 'COBROS Por envios', '2016-03-22 18:06:34', '2016-05-24 18:18:07'),
(41, 2, 'forum', 32, 32, NULL, NULL, '', 'guias de envios', '2016-03-22 18:10:07', '2016-05-24 18:18:30'),
(43, 1, 'forum', 32, 32, NULL, NULL, '', 'NEW FORUM', '2016-03-22 18:46:48', '2016-05-24 18:13:52'),
(47, 1, 'forum', 1, 1, NULL, NULL, '', 'fotocelulas', '2016-05-25 01:53:18', '2016-05-25 01:53:18'),
(48, 1, 'comment', 47, 1, 47, NULL, '', 'new comment', '2016-05-25 02:14:51', '2016-05-25 02:14:51');

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
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
