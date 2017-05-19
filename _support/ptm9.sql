

CREATE TABLE `maintenances` (
  `id_maintenance` int(11) NOT NULL,
  `maintenance_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maintenances_kardexes`
--

CREATE TABLE `maintenances_kardexes` (
  `id_maintenance_kardex` int(11) NOT NULL,
  `kardex_id` int(11) NOT NULL,
  `maintenance_kardex_type` enum('limpieza','cambio de repuesto','Instalacion de software','puesto en funcionamiento final') NOT NULL,
  `maintenance_kardex_description` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


