-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 23-11-2025 a las 18:41:40
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
-- Base de datos: `cliente01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `rol` int(1) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `rol`, `imagen`, `eliminado`) VALUES
(1, 'El Pepe', 'De la Cruz', 'elpepedelacruz@email.com', '123', 1, '', 0),
(2, 'El Pablo', 'De Santo Tomas', 'elpablodesantotomas@email.com', '321', 2, '', 0),
(3, 'El Pepe', 'Garcia', 'elpepe@udg.mx', '202cb962ac59075b964b07152d234b70', 2, '', 0),
(4, 'Jefe', 'Maestro', 'halo@gmail.com', 'eb160de1de89d9058fcb0b968dbbbd68', 2, '76dd7606f8fe75aa35a7d5f2fcb95bd3.png', 0),
(12, 'El pepe', 'Similar', 'elpepe@udg.mx', 'eb160de1de89d9058fcb0b968dbbbd68', 1, '34ec273a8ee6f6ea8d46ed6050cd3f4e.jpg', 0),
(16, 'Mama', 'Lucha', 'mamalucha@email.com', '202cb962ac59075b964b07152d234b70', 1, '853e9834ca6f2226169f2f84e28be60b.jpeg', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
