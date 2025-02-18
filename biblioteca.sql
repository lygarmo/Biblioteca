-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-02-2025 a las 11:34:46
-- Versión del servidor: 8.0.41-0ubuntu0.24.04.1
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplar`
--

CREATE TABLE `ejemplar` (
  `idejemplar` int NOT NULL,
  `localizacion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prestado` tinyint(1) NOT NULL,
  `iddocumento` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `idlibro` int NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `listaautores` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fechapublicacion` date NOT NULL,
  `materia` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `editorial` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `numeroejemplares` tinyint NOT NULL,
  `numeropaginas` int NOT NULL,
  `isbn` varchar(9) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `idmultimedia` int NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `listaautores` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fechapublicacion` date NOT NULL,
  `materia` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `editorial` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `numeroejemplares` tinyint NOT NULL,
  `soporte` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `idprestamo` int NOT NULL,
  `fechaprestamo` date NOT NULL,
  `fechadevolucion` date NOT NULL,
  `observaciones` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `prestado` tinyint(1) NOT NULL,
  `idusuario` int NOT NULL,
  `idejemplar` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revistas`
--

CREATE TABLE `revistas` (
  `idrevista` int NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `listaautores` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fechapublicacion` date NOT NULL,
  `materia` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `editorial` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `numeroejemplares` tinyint NOT NULL,
  `isbn` varchar(9) COLLATE utf8mb4_general_ci NOT NULL,
  `frecuencia` enum('diario','semanal','mensual','anual') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `curso` int NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `clave` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  ADD PRIMARY KEY (`idejemplar`),
  ADD KEY `fk_ejemplar_multimedia` (`iddocumento`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`idlibro`);

--
-- Indices de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`idmultimedia`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`idprestamo`),
  ADD KEY `fk_prestamo_usuario` (`idusuario`),
  ADD KEY `fk_prestamo_ejemplar` (`idejemplar`);

--
-- Indices de la tabla `revistas`
--
ALTER TABLE `revistas`
  ADD PRIMARY KEY (`idrevista`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  MODIFY `idejemplar` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `idlibro` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `idmultimedia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `idprestamo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `revistas`
--
ALTER TABLE `revistas`
  MODIFY `idrevista` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  ADD CONSTRAINT `fk_ejemplar_libro` FOREIGN KEY (`iddocumento`) REFERENCES `libro` (`idlibro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ejemplar_multimedia` FOREIGN KEY (`iddocumento`) REFERENCES `multimedia` (`idmultimedia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ejemplar_revista` FOREIGN KEY (`iddocumento`) REFERENCES `revistas` (`idrevista`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `fk_prestamo_ejemplar` FOREIGN KEY (`idejemplar`) REFERENCES `ejemplar` (`idejemplar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prestamo_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
