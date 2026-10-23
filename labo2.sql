-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2025 a las 00:11:59
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
-- Base de datos: `labo2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `id_articulo` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `categoria` varchar(32) DEFAULT NULL,
  `precio` decimal(8,2) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='				';

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `nombre`, `categoria`, `precio`, `foto`) VALUES
(1, 'Motorola G24 128GB', 'Celulares', 369999.00, ''),
(2, 'Heladera Whirpool 340lts', 'Electrodomésticos', 899999.00, ''),
(3, 'Freidora de aire Peabody', 'Electrodomésticos', 179999.00, 'ele_freidora_peabody.webp'),
(4, 'TV Led Philips 4K 50', 'Televisores', 779759.00, 'tv_philips_50.webp'),
(5, 'Smart TV Google 4K UHD', 'Televisores', 894699.00, ''),
(6, 'Samsung Galaxy A05S', 'Celulares', 359999.00, 'cel_samsung_05.webp'),
(7, 'Monitor', 'Televisores', 450000.00, 'jpg21'),
(8, 'Monitor', 'Televisores', 450000.00, 'jpg56'),
(9, 'Monitor', 'Televisores', 450000.00, 'jpg22'),
(10, 'Monitor', 'Televisores', 450000.00, 'Monitorjpg10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `activado` char(1) NOT NULL DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `pass`, `tipo`, `foto`, `activado`) VALUES
(1, 'jpepe', '39d19e8bec728e2cd4d2a4199e9434ad7df5e459', 'Administrador', 'jpepe.jpg', 'S'),
(2, 'mruiz', '397747e2ea1fd4995810616087d0e6c4ab7014d4', 'Administrador', 'mruiz.jpg', 'S'),
(3, 'dsingh', 'abab1d2a5f608941022d1b43da6c92d574d55060', 'Común', 'dsingh.jpg', 'S'),
(4, 'cflores', 'd1662c4daf4585ab458111cff0b30c954603d0ea', 'Común', '', 'S'),
(5, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrador', '', 'S'),
(6, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Común', '', 'S');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id_articulo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
