-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2025 a las 01:56:33
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
(11, 'Pablo', 'Juan', 'Torres', 'Diaz', '34', '13675532', '7634233445', 'pablo@gmail.com');

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
(3, '$2y$10$jUURJLPDztUQaIca7a.kmuL.zR1NmF/u.3NTq7a/ca0dqwT7YX/WC', 3);

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
(1, 'admin', 'fio', 25, 9887532, 123456789, '0'),
(3, 'prueba', 'solo', 29, 9876, 987654321, 'prueba@gmail.com');

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
(1, 'Habitación Estándar', 10, 60000),
(2, 'Suit Junior', 10, 200000),
(3, 'Suit Presidencial', 10, 550000);

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
(1, '2025-03-25', '2025-03-28', 1, 1, 1, 3),
(2, '2025-03-25', '2025-03-26', 2, 3, 2, 3),
(3, '2025-03-25', '2025-03-26', 1, 3, 3, 3),
(5, '2025-04-03', '2025-04-05', 3, 3, 1, 3),
(10, '2025-04-03', '2025-04-05', 2, 1, 1, 3),
(11, '2025-06-05', '2025-06-10', 2, 1, 1, 1);

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
(2, 3, 2, 2),
(3, 3, 3, 3),
(5, 3, 1, 5),
(10, 1, 1, 10),
(11, 1, 1, 11);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `idhospedaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `medio_pag`
--
ALTER TABLE `medio_pag`
  MODIFY `idmedio_pag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
