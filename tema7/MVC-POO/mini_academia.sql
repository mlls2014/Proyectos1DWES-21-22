-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2021 a las 18:43:01
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebadao`
--

DROP TABLE IF EXISTS `inscripciones`;
DROP TABLE IF EXISTS `cursos`;
DROP TABLE IF EXISTS `usuarios`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `profesor_id` bigint(20) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `fecha_sol` date DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `descripcion` varchar(2048) DEFAULT NULL,
  `coste` double DEFAULT NULL,
  `participantes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_PROFESOR` (`profesor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `profesor_id`, `fecha_inicio`, `fecha_fin`, `fecha_sol`, `duracion`, `descripcion`, `coste`, `participantes`) VALUES
(1, 'Curso de PHP', 1, '2021-09-19', '2022-03-23', NULL, NULL, '<h1>Curso de PHP</h1>\r\n', 0, NULL),
(2, 'NodeJS', 2, '2022-02-18', NULL, NULL, NULL, '<h1>Curso de NodeJS</h1>\n', NULL, NULL),
(3, 'SpringBoot', null, '2022-02-18', NULL, NULL, NULL, '<h1>Curso de SpringBoot</h1>\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE IF NOT EXISTS `inscripciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `curso_id` bigint(20) NOT NULL,
  `estudiante_id` bigint(20) NOT NULL,
  `fecha` date NOT NULL DEFAULT CURDATE(),
  `estado` smallint(6) NOT NULL DEFAULT 0,

  PRIMARY KEY (`id`),
  KEY `curso_id` (`curso_id`),
  KEY `estudiante_id` (`estudiante_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `curso_id`, `estudiante_id`, `estado`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 2, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `imagen`) VALUES
(1, 'admin', '', '1', NULL),
(2, 'Jose del pino', 'jose@gmail.com', 'rrrT56g', '1636048462-1635497871-042.png'),
(3, 'Juan', 'luis@gmail.com', 'd', 'mifoto');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `FK_PROFESOR` FOREIGN KEY (`profesor_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
