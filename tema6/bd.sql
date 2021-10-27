CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
  `nombre` varchar(50) NOT NULL COMMENT 'nombre cliente',
  `apellidos` varchar(100) COMMENT 'Apellidos cliente',
  `telefono` int(9) DEFAULT NULL COMMENT 'móvil',
  `codigo_postal` int(5) DEFAULT NULL,
  `edad` int(3) DEFAULT NULL,
  `sexo` char(1) DEFAULT 'V',
  `ciudad` varchar(50) DEFAULT NULL,
  `contacto`  int(9) DEFAULT NULL COMMENT 'Teléfono contacto',
  PRIMARY KEY (`id`),
  UNIQUE KEY `telefono` (`telefono`),
  KEY `nombre` (`nombre`),
  FULLTEXT KEY `apellidos` (`apellidos`)
) ENGINE=InnoDB COMMENT='tabla de clientes';

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `telefono`, 
`codigo_postal`, `edad`, `sexo`, `ciudad`, `contacto`)
VALUES (NULL, 'Juan', 'Lopez', '666666666', '21005', '25', 'V', 'Huelva', NULL);

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `telefono`, `codigo_postal`, `edad`, `sexo`, `ciudad`, `contacto`) VALUES (NULL, 'Ana', 'Ruiz', '66665454', '21001', '30', 'H', 'Huelva', "ella");