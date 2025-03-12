-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-03-2025 a las 17:16:57
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
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `iddocumento` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `listaautores` varchar(255) NOT NULL,
  `fechapublicacion` date NOT NULL,
  `materia` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `numeroejemplares` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`iddocumento`, `titulo`, `listaautores`, `fechapublicacion`, `materia`, `descripcion`, `numeroejemplares`) VALUES
(1, 'El Principito', 'Antoine de Saint-Exupéry', '1943-04-06', 'Literatura', 'Una novela corta que presenta una alegoría sobre la vida y la muerte.', 0),
(2, 'Fahrenheit 451', 'Ray Bradbury', '1953-10-19', 'Ficción distópica', 'Una obra que critica la censura y la opresión social.', 1),
(3, 'El Mundo de Sofía', 'Jostein Gaarder', '1991-09-01', 'Filosofía', 'Un relato que introduce a los jóvenes en la historia de la filosofía.', 4),
(4, 'El Retrato de Dorian Gray', 'Oscar Wilde', '1890-07-01', 'Literatura', 'Una reflexión sobre la moralidad y el hedonismo en la sociedad victoriana.', 4),
(5, 'Revista de Ciencias Naturales', 'Grupo Editorial Natural', '2025-01-15', 'Ciencias', 'Publicación mensual que cubre investigaciones y descubrimientos en biología, química y física.', 4),
(6, 'Revista de Historia Universal', 'Carlos Pérez, Ana Rodríguez', '2025-02-10', 'Historia', 'Revista que explora eventos y personajes históricos de todo el mundo.', 4),
(7, 'Revista de Cultura Pop', 'Javier Pérez, Laura Martínez', '2025-03-01', 'Cultura', 'Revista mensual sobre las últimas tendencias en cine, música y entretenimiento.', 4),
(8, 'Revista de Innovaciones Tecnológicas', 'Sofía García, Andrés Sánchez', '2025-03-15', 'Tecnología', 'Publicación que explora los avances más recientes en tecnología y gadgets.', 4),
(9, 'Documental sobre la Antártida', 'Pedro López, Marta Fernández', '2025-02-01', 'Naturaleza', 'Un documental sobre la vida en el continente más frío del planeta.', 4),
(10, 'El Universo: Una Mirada Profunda', 'Carlos Torres, Roberto Sánchez', '2025-03-10', 'Astronomía', 'Serie documental que analiza el origen y la expansión del universo.', 4),
(11, 'Innovaciones en la Medicina', 'Ana Martínez, Javier Rodríguez', '2025-02-20', 'Ciencias Médicas', 'Un documental sobre los avances más recientes en el campo de la medicina.', 4),
(12, 'Los Misterios de la Historia', 'Luis Gómez, Claudia Ramírez', '2025-03-05', 'Historia', 'Documental que explora los misterios no resueltos de la historia humana.', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplar`
--

CREATE TABLE `ejemplar` (
  `idejemplar` int NOT NULL,
  `iddocumento` int NOT NULL,
  `localizacion` varchar(100) NOT NULL,
  `prestado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `ejemplar`
--

INSERT INTO `ejemplar` (`idejemplar`, `iddocumento`, `localizacion`, `prestado`) VALUES
(1, 1, 'pasillo 1 estanteria 1', 0),
(2, 2, 'pasillo 1 estanteria 2', 0),
(3, 3, 'pasillo 1 estanteria 3', 0),
(4, 4, 'pasillo 1 estanteria 4', 0),
(5, 5, 'pasillo 2 estanteria 1', 0),
(6, 8, 'pasillo 2 estanteria 2', 0),
(7, 7, 'pasillo 2 estanteria 3', 0),
(8, 8, 'pasillo 2 estanteria 4', 0),
(9, 9, 'pasillo 3 estanteria 1', 0),
(10, 10, 'pasillo 3 estanteria 2', 0),
(11, 11, 'pasillo 3 estanteria 3', 0),
(12, 12, 'pasillo 3 estanteria 4', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id` int NOT NULL,
  `iddocumento` int NOT NULL,
  `editorial` varchar(50) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `numeropaginas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `iddocumento`, `editorial`, `isbn`, `numeropaginas`) VALUES
(1, 1, 'Editorial Ficticia', '123456789', 100),
(2, 2, 'Editorial Distópica', '234567890', 250),
(3, 3, 'Editorial Filosofía', '345678901', 300),
(4, 4, 'Editorial Wilde', '456789012', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `id` int NOT NULL,
  `iddocumento` int NOT NULL,
  `formato` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `multimedia`
--

INSERT INTO `multimedia` (`id`, `iddocumento`, `formato`) VALUES
(1, 9, 'DVD'),
(2, 10, 'Blu-Ray'),
(3, 11, 'USB'),
(4, 12, 'DVD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `idprestamo` int NOT NULL,
  `fechaprestamo` date NOT NULL,
  `fechadevolucion` date NOT NULL,
  `observaciones` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prestado` tinyint(1) NOT NULL,
  `idusuario` int NOT NULL,
  `idejemplar` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`idprestamo`, `fechaprestamo`, `fechadevolucion`, `observaciones`, `prestado`, `idusuario`, `idejemplar`) VALUES
(8, '2025-03-06', '2025-03-27', 'Ninguna', 1, 1, 2),
(9, '2025-03-06', '2025-03-27', 'Ninguna', 1, 1, 3),
(10, '2025-03-06', '2025-03-27', 'Ninguna', 1, 1, 3),
(11, '2025-03-06', '2025-03-27', 'Ninguna', 1, 1, 3),
(12, '2025-03-06', '2025-03-27', 'Ninguna', 1, 1, 3),
(15, '2025-03-06', '2025-03-27', 'Ninguna', 0, 1, 4),
(16, '2025-03-06', '2025-03-27', 'Ninguna', 1, 1, 4),
(19, '2025-03-12', '2025-03-12', 'Devuelto en fecha', 0, 9, 5),
(20, '2025-03-12', '2025-03-12', 'NO devuelto en fecha', 0, 9, 11),
(21, '2025-03-12', '2025-03-12', 'Devuelto en fecha', 0, 9, 5),
(22, '2025-03-12', '2025-03-12', 'Devuelto en fecha', 0, 9, 12),
(23, '2025-03-12', '2025-04-02', 'Ninguna', 1, 9, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revista`
--

CREATE TABLE `revista` (
  `id` int NOT NULL,
  `iddocumento` int NOT NULL,
  `frecuencia` enum('diario','semanal','mensual','anual') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `revista`
--

INSERT INTO `revista` (`id`, `iddocumento`, `frecuencia`) VALUES
(1, 5, 'mensual'),
(2, 6, 'mensual'),
(3, 7, 'mensual'),
(4, 8, 'mensual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `curso` int NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `clave` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `curso`, `email`, `direccion`, `clave`, `telefono`) VALUES
(1, 'Juan Pérez', 1, 'juan.perez@email.com', 'Calle Ficticia 123', 'abc12345', '612345678'),
(2, 'Ana García', 2, 'ana.garcia@email.com', 'Avenida Principal 456', 'def67890', '623456789'),
(3, 'Carlos López', 3, 'carlos.lopez@email.com', 'Calle Secundaria 789', 'ghi23456', '634567890'),
(4, 'María Sánchez', 1, 'maria.sanchez@email.com', 'Calle Larga 101', 'jkl98765', '645678901'),
(5, 'Luis Martínez', 2, 'luis.martinez@email.com', 'Plaza Central 202', 'mno54321', '656789012'),
(9, 'lydia', 2, 'lydia@domenico.es', 'WSDEWFW', '1234', '666666666');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`iddocumento`);

--
-- Indices de la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  ADD PRIMARY KEY (`idejemplar`),
  ADD KEY `fk_ejemplar_documento` (`iddocumento`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libro_ibfk_1` (`iddocumento`);

--
-- Indices de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `multimedia_ibfk_1` (`iddocumento`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`idprestamo`),
  ADD KEY `fk_prestamo_usuario` (`idusuario`),
  ADD KEY `fk_prestamo_ejemplar` (`idejemplar`);

--
-- Indices de la tabla `revista`
--
ALTER TABLE `revista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revista_ibfk_1` (`iddocumento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `iddocumento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  MODIFY `idejemplar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `idprestamo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `revista`
--
ALTER TABLE `revista`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  ADD CONSTRAINT `fk_ejemplar_documento` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`iddocumento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`iddocumento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `multimedia_ibfk_1` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`iddocumento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `fk_prestamo_ejemplar` FOREIGN KEY (`idejemplar`) REFERENCES `ejemplar` (`idejemplar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prestamo_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `revista`
--
ALTER TABLE `revista`
  ADD CONSTRAINT `revista_ibfk_1` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`iddocumento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
