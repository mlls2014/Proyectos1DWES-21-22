-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2021 a las 14:44:02
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `crear_persona` ()  BEGIN
INSERT INTO clientes(Nombre, Apellidos, Edad) VALUES('Pepe','Gotera',24);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `num_personas` (OUT `totalPersonas` INT)  BEGIN
SELECT COUNT(Nombre) INTO totalPersonas FROM usuarios;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_persona` (IN `idSel` INT, OUT `nombreSel` VARCHAR(100))  BEGIN
SELECT Nombre into nombreSel FROM clientes WHERE Id=idSel;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `seleccionar_persona` (IN `idsel` INT)  BEGIN
SELECT *FROM clientes WHERE Id=idsel;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL COMMENT 'Clave primaria',
  `nombre` varchar(50) NOT NULL COMMENT 'nombre cliente',
  `apellidos` varchar(100) DEFAULT NULL COMMENT 'Apellidos cliente',
  `telefono` int(9) DEFAULT NULL COMMENT 'móvil',
  `codigo_postal` int(5) DEFAULT NULL,
  `edad` int(3) DEFAULT NULL,
  `sexo` char(1) DEFAULT 'V',
  `ciudad` varchar(50) DEFAULT NULL,
  `contacto` int(9) DEFAULT NULL COMMENT 'Teléfono contacto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabla de clientes';

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `telefono`, `codigo_postal`, `edad`, `sexo`, `ciudad`, `contacto`) VALUES
(12, 'Pepe', 'Gotera', NULL, NULL, 24, 'V', NULL, NULL),
(13, 'Pepe', 'Gotera', NULL, NULL, 24, 'V', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL COMMENT 'Clave primaria',
  `nombre` varchar(50) NOT NULL COMMENT 'nombre cliente',
  `email` varchar(100) DEFAULT NULL COMMENT 'Apellidos cliente',
  `password` varchar(50) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabla de usuarios';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `imagen`) VALUES
(2, 'Jose', 'jose@gmail.com', 'sdsd', '1.png'),
(3, 'Ana', 'ana@gmail.com', 'dserrf', '4.png'),
(16, 'Pepito', 'jose@sd.es', 'pP34', NULL),
(17, 'Juansd', 'juan@gmail.com', 'asD34', '1635497871-042.png'),
(18, 'Pepito', 'jose@sd.es', 'sdD34', NULL),
(19, 'Juans', 'jose@sd.es', 'sW34', NULL),
(20, 'Pepito2', 'juan@gmail.com', 'as2SD', '1635498906-4.png'),
(21, 'Pepito3', 'juan@gmail.com', '33dDD', NULL),
(22, 'Pepito4', 'juan@gmail.com', 'e3Er4', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD KEY `nombre` (`nombre`);
ALTER TABLE `clientes` ADD FULLTEXT KEY `apellidos` (`apellidos`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria', AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
