-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2025 a las 23:28:13
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `prim_nom_client` varchar(45) NOT NULL,
  `seg_nom_client` varchar(45) DEFAULT NULL,
  `prim_apelli_client` varchar(45) NOT NULL,
  `seg_apelli_client` varchar(45) NOT NULL,
  `edad_client` varchar(45) NOT NULL,
  `iden_client` varchar(45) NOT NULL,
  `tel_client` varchar(45) NOT NULL,
  `email_client` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `prim_nom_client`, `seg_nom_client`, `prim_apelli_client`, `seg_apelli_client`, `edad_client`, `iden_client`, `tel_client`, `email_client`) VALUES
(1, 'Andres', 'Felipe', 'Mosquera', 'Rincon', '23', '12356765', '321345546', 'andresfel@gmail.com'),
(2, 'lucas', 'fernado ', 'alvaro', 'perez', '25', '1231344', '8606443', 'lucas@gmail.com'),
(3, 'Juan', 'Ricardo ', 'diaz', 'torres', '29', '56675435', '234252454', 'juan@gmail.com'),
(4, 'juan ', 'perez', 'diaz', 'baron', '30', '1255443', '34235523', 'juan@gmail.com'),
(5, 'pedro', 'jose', 'gutierrez', 'alvaro', '23', '244325', '967384342', 'predro@gmail.com'),
(10, 'luis', 'ramiro', 'lopez', 'casca', '19', '7698543', '1266548808', 'luis@gmail.com'),
(11, 'Pablo', 'Juan', 'Torres', 'Diaz', '34', '13675532', '7634233445', 'pablo@gmail.com'),
(12, 'richard', '', 'rios', '', '34', '67453452', '2345678990', 'rios@gmail.com'),
(13, 'james', '', 'rodriguez', '', '23', '2378967', '3456789867', 'james@gmail.com'),
(14, 'angel', 'N/A', 'di maria', 'N/A', '0', '12456757', '9854535674', 'angel@gmail.com'),
(15, 'lionel', '', 'messi', '', '39', '234678977', '4567990231', 'messi@gmail.com'),
(26, 'cole', '', 'palmer', '', '34', '87654345', '2345987652', 'cole@gmail.com'),
(27, 'renato', '', 'sanchez', '', '23', '76567856', '3326789012', 'renato@gmail.com'),
(28, 'argen', '', 'robben', '', '23', '34567875', '2357989012', 'argen@gmail.com'),
(29, 'marco', '', 'perez', '', '24', '12346543', '2349876098', 'marco@gmail.com'),
(30, 'bernando', '', 'silva', '', '34', '2345945', '2356789742', 'silva@gmail.com'),
(31, 'erling', '', 'haaland', '', '21', '2456897655', '3450987601', 'erling@gmail.com'),
(32, 'alejandro', '', 'balde', '', '23', '59409543', '3489087651', 'balde@gmail.com'),
(33, 'robert', '', 'lewandoski', '', '35', '450324952', '3456789012', 'robert@gmail.com'),
(34, 'lamine', '', 'yamal', '', '18', '4567876564', '1123450987', 'lamine@gmail.com'),
(35, 'kyllian', '', 'mbappe', '', '26', '234567892', '1234509831', 'mbappe@gmail.com'),
(36, 'tibu', '', 'courtous', '', '32', '234567874', '2134897654', 'tibu@gmail.com'),
(37, 'ferran', '', 'torres', '', '23', '343012434', '2013954569', 'ferran@gmail.com'),
(38, 'fermin', '', 'lopez', '', '23', '34356343', '1287906789', 'femin@gmail.com'),
(39, 'jules', '', 'kounde', '', '29', '2304955634', '1076956753', 'jules@gmail.com'),
(40, 'marc', 'N/A', 'stegen', 'N/A', '30', '12456688', '2908678344', 'marc@gmail.com'),
(41, 'ousmane', '', 'dembele', '', '23', '467875646', '2976809543', 'ousmane@gmail.com'),
(42, 'luigi', 'N/A', 'Donnaruma', 'N/A', '32', '234568975', '1265789076', '0'),
(43, 'dani', '', 'carvajal', '', '35', '12446688', '6547890765', 'dani@gmail.com'),
(44, 'timo', 'N/A', 'werner', 'N/A', '29', '254689755', '1345678231', 'timo@gmail.com'),
(45, 'jaider', 'N/A', 'alvarez', 'N/A', '22', '54367896', '1275778906', 'jaider@gmail.com'),
(46, 'jaider', '', 'alvarez', '', '22', '54367896', '1275778906', 'jaider@gmail.com'),
(47, 'jaider', '', 'alvarez', '', '22', '54367896', '1275778906', 'jaider@gmail.com'),
(48, 'angel', '', 'di maria', '', '35', '56789534', '8765893454', 'angel@gmail.com'),
(49, 'jaider', '', 'alvarez', '', '22', '34567864', '1364376890', 'jaider@gmail.com'),
(50, 'jaider', '', 'alvarez', '', '22', '34567864', '1364376890', 'jaider@gmail.com'),
(51, 'jaider', '', 'alvarez', '', '22', '34567864', '1364376890', 'jaider@gmail.com'),
(52, 'jaider', '', 'alvarez', '', '22', '34567864', '1364376890', 'jaider@gmail.com'),
(53, 'jaider', '', 'alvarez', '', '22', '34567864', '1364376890', 'jaider@gmail.com'),
(54, 'jaider', '', 'alvarez', '', '22', '34567864', '1364376890', 'jaider@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_recep`
--

CREATE TABLE `cuenta_recep` (
  `idcuenta_recep` int(11) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `emple_recep_idemple_recep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuenta_recep`
--

INSERT INTO `cuenta_recep` (`idcuenta_recep`, `clave`, `emple_recep_idemple_recep`) VALUES
(1, '$2y$10$DA1VekcfJw.2AC5cqSIxbO5bkeArZ1qXxTxaFYwVHTypTVboTVOwS', 1),
(3, '$2y$10$aC3tyET7lfhFnx1Xj.bQ5uXPSyUAWdgs7k9/lxvJ3HEcbjX/Gn0Ii', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emple_recep`
--

CREATE TABLE `emple_recep` (
  `idemple_recep` int(11) NOT NULL,
  `nom_cecep` varchar(45) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `edad_recep` int(11) NOT NULL,
  `tel_recep` int(11) NOT NULL,
  `ident_recep` int(11) NOT NULL,
  `email_recep` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `emple_recep`
--

INSERT INTO `emple_recep` (`idemple_recep`, `nom_cecep`, `apellido`, `edad_recep`, `tel_recep`, `ident_recep`, `email_recep`) VALUES
(1, 'admin', 'heo', 19, 563458776, 123456789, 'admin@gmail.com'),
(3, 'prueba', 'solo', 19, 675464, 987654321, 'prueba@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_hab`
--

CREATE TABLE `estado_hab` (
  `idestado_hab` int(11) NOT NULL,
  `tipo_estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_hab`
--

INSERT INTO `estado_hab` (`idestado_hab`, `tipo_estado`) VALUES
(1, 'Reservado'),
(2, 'En uso'),
(3, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `idhabitacion` int(11) NOT NULL,
  `nom_hab` varchar(45) NOT NULL,
  `hab_dispo` int(11) DEFAULT NULL,
  `precio_hab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`idhabitacion`, `nom_hab`, `hab_dispo`, `precio_hab`) VALUES
(1, 'Habitación Estándar', 0, 60000),
(2, 'Suit Junior', 0, 200000),
(3, 'Suit Presidencial', 0, 550000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedaje`
--

CREATE TABLE `hospedaje` (
  `idhospedaje` int(11) NOT NULL,
  `fecha_entra` date NOT NULL,
  `fecha_sal` date NOT NULL,
  `cant_person` int(11) NOT NULL,
  `habitacion_idhabitacion` int(11) NOT NULL,
  `medio_pag_idmedio_pag` int(11) NOT NULL,
  `estado_hab_idestado_hab` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hospedaje`
--

INSERT INTO `hospedaje` (`idhospedaje`, `fecha_entra`, `fecha_sal`, `cant_person`, `habitacion_idhabitacion`, `medio_pag_idmedio_pag`, `estado_hab_idestado_hab`) VALUES
(1, '2025-03-25', '2025-03-28', 1, 1, 1, 2),
(2, '2025-03-25', '2025-03-26', 2, 1, 2, 2),
(3, '2025-03-25', '2025-03-26', 1, 1, 3, 2),
(5, '2025-04-03', '2025-04-05', 3, 1, 1, 2),
(10, '2025-04-03', '2025-04-05', 2, 1, 1, 2),
(11, '2025-06-05', '2025-06-10', 2, 1, 1, 2),
(12, '2025-06-16', '2025-06-18', 1, 1, 1, 2),
(13, '2025-06-17', '2025-06-17', 2, 1, 2, 2),
(15, '2025-06-17', '2025-06-19', 2, 1, 2, 2),
(26, '2025-06-30', '2025-07-02', 2, 2, 1, 2),
(27, '2025-07-04', '2025-08-02', 3, 2, 2, 2),
(28, '2025-07-09', '2025-07-10', 2, 2, 3, 2),
(29, '2025-07-05', '2025-07-06', 2, 2, 2, 2),
(30, '2025-07-01', '2025-07-03', 2, 2, 1, 2),
(31, '2025-07-06', '2025-07-08', 1, 2, 2, 2),
(32, '2025-07-07', '2025-07-08', 2, 2, 3, 2),
(33, '2025-07-07', '2025-07-08', 2, 2, 1, 2),
(34, '2025-07-06', '2025-07-10', 2, 2, 2, 2),
(35, '2025-07-08', '2025-07-10', 2, 2, 3, 2),
(36, '2025-07-08', '2025-07-10', 2, 3, 1, 2),
(37, '2025-07-09', '2025-07-11', 3, 3, 2, 2),
(38, '2025-07-08', '2025-07-10', 2, 3, 3, 2),
(39, '2025-07-09', '2025-07-10', 2, 3, 3, 2),
(40, '2025-07-14', '2025-07-14', 2, 3, 2, 2),
(41, '2025-07-10', '2025-07-10', 2, 3, 3, 2),
(42, '2025-07-10', '2025-07-11', 1, 3, 1, 2),
(43, '2025-07-11', '2025-07-13', 2, 3, 2, 2),
(44, '2025-07-11', '2025-07-13', 2, 3, 1, 2),
(48, '2025-07-12', '2025-07-14', 2, 2, 2, 1),
(54, '2025-07-13', '2025-07-15', 2, 3, 2, 1);

--
-- Disparadores `hospedaje`
--
DELIMITER $$
CREATE TRIGGER `insertar_estado_reservado` BEFORE INSERT ON `hospedaje` FOR EACH ROW BEGIN
  SET NEW.estado_hab_idestado_hab = 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedaje_has_cliente`
--

CREATE TABLE `hospedaje_has_cliente` (
  `hospedaje_idhospedaje` int(11) NOT NULL,
  `hospedaje_habitacion_idhabitacion` int(11) NOT NULL,
  `hospedaje_medio_pag_idmedio_pag` int(11) NOT NULL,
  `cliente_idcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hospedaje_has_cliente`
--

INSERT INTO `hospedaje_has_cliente` (`hospedaje_idhospedaje`, `hospedaje_habitacion_idhabitacion`, `hospedaje_medio_pag_idmedio_pag`, `cliente_idcliente`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 3, 3),
(5, 1, 1, 5),
(10, 1, 1, 10),
(11, 1, 1, 11),
(12, 1, 1, 12),
(13, 1, 2, 13),
(15, 1, 2, 15),
(26, 2, 1, 26),
(27, 2, 2, 27),
(28, 2, 3, 28),
(29, 2, 2, 29),
(30, 2, 1, 30),
(31, 2, 2, 31),
(32, 2, 3, 32),
(33, 2, 1, 33),
(34, 2, 2, 34),
(35, 2, 3, 35),
(36, 3, 1, 36),
(37, 3, 2, 37),
(38, 3, 3, 38),
(39, 3, 3, 39),
(40, 3, 2, 40),
(41, 3, 3, 41),
(42, 3, 1, 42),
(43, 3, 2, 43),
(44, 3, 1, 44),
(48, 2, 2, 48),
(54, 3, 2, 54);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medio_pag`
--

CREATE TABLE `medio_pag` (
  `idmedio_pag` int(11) NOT NULL,
  `tipo_pag` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medio_pag`
--

INSERT INTO `medio_pag` (`idmedio_pag`, `tipo_pag`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta de crédito '),
(3, 'Transferencia bancaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `leida` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `mensaje`, `fecha`, `leida`) VALUES
(1, 'Nueva reserva realizada por: bernando', '2025-07-01 02:11:37', 1),
(2, 'Nueva reserva realizada por: erling', '2025-07-06 22:39:54', 1),
(3, 'Nueva reserva realizada por: alejandro', '2025-07-06 22:51:11', 1),
(4, 'Nueva reserva realizada por: robert', '2025-07-06 23:07:15', 1),
(5, 'Nueva reserva realizada por: lamine', '2025-07-06 23:27:52', 1),
(8, 'Nueva reserva realizada por: kyllian', '2025-07-07 22:53:29', 1),
(9, 'Nueva reserva realizada por: tibu', '2025-07-07 23:05:18', 1),
(10, 'Nueva reserva realizada por: ferran', '2025-07-07 23:47:31', 1),
(11, 'Nueva reserva realizada por: fermin', '2025-07-08 00:01:05', 1),
(12, 'Nueva reserva realizada por: jules', '2025-07-08 23:14:58', 1),
(13, 'Nueva reserva realizada por: marc stegen', '2025-07-09 00:02:50', 1),
(14, 'Nueva reserva realizada por: ousmane dembele', '2025-07-09 22:11:31', 1),
(15, 'Nueva reserva realizada por: luigi Donnaruma', '2025-07-09 22:20:45', 1),
(16, 'Nueva reserva realizada por: dani carvajal', '2025-07-09 22:21:55', 1),
(17, 'Nueva reserva realizada por: timo werner', '2025-07-11 23:42:28', 1),
(18, 'Nueva reserva realizada por: jaider alvarez', '2025-07-11 23:43:44', 1),
(19, 'Nueva reserva realizada por: jaider alvarez', '2025-07-12 23:22:45', 1),
(20, 'Nueva reserva realizada por: jaider alvarez', '2025-07-12 23:23:26', 1),
(21, 'Nueva reserva realizada por: angel di maria', '2025-07-12 23:24:18', 1),
(22, 'Nueva reserva realizada por: jaider alvarez', '2025-07-12 23:59:07', 1),
(23, 'Nueva reserva realizada por: jaider alvarez', '2025-07-12 23:59:57', 1),
(24, 'Nueva reserva realizada por: jaider alvarez', '2025-07-13 00:05:42', 1),
(25, 'Nueva reserva realizada por: jaider alvarez', '2025-07-13 00:06:44', 1),
(26, 'Nueva reserva realizada por: jaider alvarez', '2025-07-13 01:53:27', 1),
(27, 'Nueva reserva realizada por: jaider alvarez', '2025-07-13 22:16:02', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `cuenta_recep`
--
ALTER TABLE `cuenta_recep`
  ADD PRIMARY KEY (`idcuenta_recep`,`emple_recep_idemple_recep`),
  ADD KEY `fk_cuenta_recep_emple_recep1_idx` (`emple_recep_idemple_recep`);

--
-- Indices de la tabla `emple_recep`
--
ALTER TABLE `emple_recep`
  ADD PRIMARY KEY (`idemple_recep`);

--
-- Indices de la tabla `estado_hab`
--
ALTER TABLE `estado_hab`
  ADD PRIMARY KEY (`idestado_hab`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`idhabitacion`);

--
-- Indices de la tabla `hospedaje`
--
ALTER TABLE `hospedaje`
  ADD PRIMARY KEY (`idhospedaje`,`habitacion_idhabitacion`,`medio_pag_idmedio_pag`),
  ADD KEY `fk_hospedaje_habitacion_idx` (`habitacion_idhabitacion`),
  ADD KEY `fk_hospedaje_medio_pag1_idx` (`medio_pag_idmedio_pag`),
  ADD KEY `fk_hospedaje_estado` (`estado_hab_idestado_hab`);

--
-- Indices de la tabla `hospedaje_has_cliente`
--
ALTER TABLE `hospedaje_has_cliente`
  ADD PRIMARY KEY (`hospedaje_idhospedaje`,`hospedaje_habitacion_idhabitacion`,`hospedaje_medio_pag_idmedio_pag`,`cliente_idcliente`),
  ADD KEY `fk_hospedaje_has_cliente_cliente1_idx` (`cliente_idcliente`),
  ADD KEY `fk_hospedaje_has_cliente_hospedaje1_idx` (`hospedaje_idhospedaje`,`hospedaje_habitacion_idhabitacion`,`hospedaje_medio_pag_idmedio_pag`);

--
-- Indices de la tabla `medio_pag`
--
ALTER TABLE `medio_pag`
  ADD PRIMARY KEY (`idmedio_pag`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `cuenta_recep`
--
ALTER TABLE `cuenta_recep`
  MODIFY `idcuenta_recep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `emple_recep`
--
ALTER TABLE `emple_recep`
  MODIFY `idemple_recep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_hab`
--
ALTER TABLE `estado_hab`
  MODIFY `idestado_hab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `idhabitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `hospedaje`
--
ALTER TABLE `hospedaje`
  MODIFY `idhospedaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `medio_pag`
--
ALTER TABLE `medio_pag`
  MODIFY `idmedio_pag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuenta_recep`
--
ALTER TABLE `cuenta_recep`
  ADD CONSTRAINT `fk_cuenta_recep_emple_recep1` FOREIGN KEY (`emple_recep_idemple_recep`) REFERENCES `emple_recep` (`idemple_recep`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hospedaje`
--
ALTER TABLE `hospedaje`
  ADD CONSTRAINT `fk_hospedaje_estado` FOREIGN KEY (`estado_hab_idestado_hab`) REFERENCES `estado_hab` (`idestado_hab`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hospedaje_habitacion` FOREIGN KEY (`habitacion_idhabitacion`) REFERENCES `habitacion` (`idhabitacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hospedaje_medio_pag1` FOREIGN KEY (`medio_pag_idmedio_pag`) REFERENCES `medio_pag` (`idmedio_pag`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hospedaje_has_cliente`
--
ALTER TABLE `hospedaje_has_cliente`
  ADD CONSTRAINT `fk_hospedaje_has_cliente_cliente1` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hospedaje_has_cliente_hospedaje1` FOREIGN KEY (`hospedaje_idhospedaje`,`hospedaje_habitacion_idhabitacion`,`hospedaje_medio_pag_idmedio_pag`) REFERENCES `hospedaje` (`idhospedaje`, `habitacion_idhabitacion`, `medio_pag_idmedio_pag`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
