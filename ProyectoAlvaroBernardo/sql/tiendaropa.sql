-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2022 a las 19:34:12
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendaropa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'inspirada'),
(2, 'originales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `idCompra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombreUsuario` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`idCompra`, `id_producto`, `nombreUsuario`, `fecha`) VALUES
(1, 1, 'alvarobs', '11-12-2022'),
(2, 2, 'alvarobs', '11-12-2022'),
(3, 3, 'alvarobs', '11-12-2022'),
(4, 1, 'alvarobs', '11-12-2022'),
(5, 2, 'alvarobs', '11-12-2022'),
(6, 3, 'alvarobs', '11-12-2022'),
(7, 2, 'Jorge', '11-12-2022'),
(8, 3, 'Jorge', '11-12-2022'),
(9, 4, 'Jorge', '11-12-2022'),
(10, 4, 'Jorge', '11-12-2022'),
(11, 4, 'Jorge', '11-12-2022'),
(12, 1, 'javierbs', '11-12-2022'),
(13, 1, 'javierbs', '11-12-2022'),
(14, 1, 'javierbs', '11-12-2022'),
(15, 1, 'javierbs', '11-12-2022'),
(16, 1, 'javierbs', '11-12-2022'),
(17, 1, 'javierbs', '11-12-2022'),
(18, 1, 'javierbs', '11-12-2022'),
(19, 1, 'alvarobs', '11-12-2022'),
(20, 2, 'alvarobs', '11-12-2022'),
(21, 3, 'alvarobs', '11-12-2022');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `cantidad`, `imagen`, `id_categoria`) VALUES
(1, 'Sudadera another day ', 'Sudadera de nuestra marca another day', '70.00', 10, 'anotherday.jpg', 2),
(2, 'Sudadera california', 'Sudadera de nuestra marca, California', '50.00', 5, 'california.jpg', 2),
(3, 'Sudadera champion', 'Sudadera inspirada en Champion vintage', '30.00', 2, 'championVintage.jpg', 1),
(4, 'Sudadera chicago', 'Sudadera de nuestra marca, chicago', '50.00', 20, 'chicago.jpg', 2),
(5, 'Sudadera gap', 'Sudadera inspirada en Gap Vintage', '30.00', 1, 'gapVintage.jpg', 1),
(6, 'Sudadera nike', 'Sudadera inspirada en Nike Vintage', '30.00', 10, 'nikeVintage.jpg', 1),
(7, 'Sudadera colorado', 'Sudadera de nuestra marca, colorado', '50.00', 67, 'vintageStyle.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(255) NOT NULL,
  `nombreUsuario` varchar(255) NOT NULL,
  `contra` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `telefono` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `nombreUsuario`, `contra`, `direccion`, `gmail`, `telefono`, `tipo`) VALUES
('Alvaro Bernardo', 'alvarobs', '123', '', '', 0, 'administrador'),
('Javier Bernardo', 'javierbs', '123', 'calle aviles', 'javier@gmail.com', 684640871, 'usuario'),
('Manuel Garcia', 'Manuel02', 'manuel', 'calle manuel', 'manuel@gmail.com', 111111, ''),
('Jorge Jorge', 'Jorge', 'jorge', 'calle jorge', 'jorge@gmail.com', 3333333, 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idCompra`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
