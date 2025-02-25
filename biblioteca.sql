-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 25-02-2025 a las 19:21:50
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
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplar`
--

CREATE TABLE `ejemplar` (
  `idejemplar` int(11) NOT NULL,
  `localizacion` varchar(50) NOT NULL,
  `prestado` tinyint(1) NOT NULL,
  `iddocumento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `idlibro` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `listaautores` varchar(100) NOT NULL,
  `fechapublicacion` date NOT NULL,
  `materia` varchar(25) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `editorial` varchar(50) NOT NULL,
  `numeroejemplares` tinyint(4) NOT NULL,
  `numeropaginas` int(11) NOT NULL,
  `isbn` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idlibro`, `titulo`, `listaautores`, `fechapublicacion`, `materia`, `descripcion`, `editorial`, `numeroejemplares`, `numeropaginas`, `isbn`) VALUES
(1, 'El Quijote', 'Miguel de Cervantes', '1605-01-16', 'Literatura', 'Una obra clásica de la literatura española.', 'Editorial ABC', 5, 1023, '123456789'),
(2, 'Cien Años de Soledad', 'Gabriel García Márquez', '1967-06-05', 'Literatura', 'Una novela que define el realismo mágico en la literatura.', 'Editorial XYZ', 3, 417, '234567890'),
(3, '1984', 'George Orwell', '1949-06-08', 'Filosofía', 'Una crítica a los regímenes totalitarios y la vigilancia estatal.', 'Editorial 123', 8, 328, '345678901'),
(4, 'Fundación', 'Isaac Asimov', '1951-06-01', 'Ciencia Ficción', 'Una saga que aborda el futuro de la humanidad en el espacio.', 'Editorial SciFi', 10, 255, '456789012'),
(5, 'La Sombra del Viento', 'Carlos Ruiz Zafón', '2001-03-04', 'Misterio', 'Una novela que explora secretos y pasiones ocultas en la Barcelona de la posguerra.', 'Editorial Literaria', 4, 510, '567890123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `idmultimedia` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `listaautores` varchar(100) NOT NULL,
  `fechapublicacion` date NOT NULL,
  `materia` varchar(25) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `editorial` varchar(50) NOT NULL,
  `numeroejemplares` tinyint(4) NOT NULL,
  `soporte` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `multimedia`
--

INSERT INTO `multimedia` (`idmultimedia`, `titulo`, `listaautores`, `fechapublicacion`, `materia`, `descripcion`, `editorial`, `numeroejemplares`, `soporte`) VALUES
(1, 'El Viaje al Espacio', 'José Martínez, Claudia Pérez', '2025-01-05', 'Ciencia', 'Documental sobre los avances en la exploración espacial.', 'Editorial Espacial', 3, 'DVD'),
(2, 'La Historia del Arte', 'Laura Gómez, Andrés Ruiz', '2024-12-10', 'Arte', 'Video que explora la evolución del arte desde la antigüedad.', 'Editorial Cultura', 5, 'Blu-Ray'),
(3, 'Innovaciones Tecnológicas', 'Luis Torres, Pablo Sánchez', '2025-02-02', 'Tecnología', 'Serie sobre las últimas innovaciones tecnológicas en el mercado.', 'Editorial Tech', 8, 'USB'),
(4, 'Misterios de la Naturaleza', 'Ana Martín, Carlos López', '2025-01-25', 'Naturaleza', 'Un recorrido visual por los mayores misterios naturales del planeta.', 'Editorial Naturaleza', 6, 'DVD'),
(5, 'El Futuro de la Medicina', 'David García, Roberto Fernández', '2024-11-20', 'Salud', 'Película educativa sobre los avances médicos y tecnológicos en la medicina.', 'Editorial Salud', 4, 'Blu-Ray');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `idprestamo` int(11) NOT NULL,
  `fechaprestamo` date NOT NULL,
  `fechadevolucion` date NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `prestado` tinyint(1) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idejemplar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revistas`
--

CREATE TABLE `revistas` (
  `idrevista` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `listaautores` varchar(100) NOT NULL,
  `fechapublicacion` date NOT NULL,
  `materia` varchar(25) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `editorial` varchar(50) NOT NULL,
  `numeroejemplares` tinyint(4) NOT NULL,
  `isbn` varchar(9) NOT NULL,
  `frecuencia` enum('diario','semanal','mensual','anual') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `revistas`
--

INSERT INTO `revistas` (`idrevista`, `titulo`, `listaautores`, `fechapublicacion`, `materia`, `descripcion`, `editorial`, `numeroejemplares`, `isbn`, `frecuencia`) VALUES
(1, 'Revista Científica', 'Juan Pérez, María López', '2025-01-10', 'Ciencia', 'Publicación mensual sobre avances científicos.', 'Editorial Ciencia', 10, '123456789', 'mensual'),
(2, 'Revista de Historia', 'Carlos García, Ana Sánchez', '2024-11-15', 'Historia', 'Revista sobre eventos históricos y análisis de fuentes.', 'Editorial Historia', 5, '234567890', 'mensual'),
(3, 'Revista de Economía', 'Luis Martínez, Elena Torres', '2025-02-01', 'Economía', 'Estudios sobre economía global y tendencias del mercado.', 'Editorial Económica', 8, '345678901', 'semanal'),
(4, 'Revista de Arte y Cultura', 'Roberto Díaz, Isabel Gómez', '2025-01-20', 'Arte', 'Publicación sobre arte contemporáneo y exposiciones.', 'Editorial Arte', 6, '456789012', 'mensual'),
(5, 'Revista de Tecnología', 'David Fernández, Laura Ramírez', '2025-02-10', 'Tecnología', 'Analiza las últimas innovaciones tecnológicas y gadgets.', 'Editorial Tech', 12, '567890123', 'semanal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `curso` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `clave` varchar(8) NOT NULL,
  `telefono` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `curso`, `email`, `direccion`, `clave`, `telefono`) VALUES
(1, 'Juan Pérez', 1, 'juan.perez@email.com', 'Calle Ficticia 123', 'abc12345', '612345678'),
(2, 'Ana García', 2, 'ana.garcia@email.com', 'Avenida Principal 456', 'def67890', '623456789'),
(3, 'Carlos López', 3, 'carlos.lopez@email.com', 'Calle Secundaria 789', 'ghi23456', '634567890'),
(4, 'María Sánchez', 1, 'maria.sanchez@email.com', 'Calle Larga 101', 'jkl98765', '645678901'),
(5, 'Luis Martínez', 2, 'luis.martinez@email.com', 'Plaza Central 202', 'mno54321', '656789012');

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
  MODIFY `idejemplar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `idlibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `idmultimedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `idprestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `revistas`
--
ALTER TABLE `revistas`
  MODIFY `idrevista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
