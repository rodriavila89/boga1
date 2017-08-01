-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.21 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para reaynal
-- CREATE DATABASE IF NOT EXISTS `reaynal` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `foodproa_exp`;

-- Volcando estructura para tabla reaynal.agenda
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) DEFAULT NULL,
  `id_caso` int(11) DEFAULT NULL,
  `hora_inicio` datetime DEFAULT NULL,
  `hora_fin` datetime DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `realizada` int(11) DEFAULT NULL,
  `dia_completo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_persona` (`id_persona`),
  KEY `id_caso` (`id_caso`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.agenda: 59 rows
/*!40000 ALTER TABLE `agenda` DISABLE KEYS */;
INSERT INTO `agenda` (`id`, `id_persona`, `id_caso`, `hora_inicio`, `hora_fin`, `titulo`, `descripcion`, `realizada`, `dia_completo`) VALUES
	(1, NULL, 1, '2017-03-06 07:00:00', '2017-03-06 07:30:00', 'Audiencia', '', NULL, NULL),
	(2, NULL, 2, '2017-03-07 07:00:00', '2017-03-07 07:30:00', 'Reconocimiento', '', NULL, NULL),
	(3, NULL, 2, '2017-03-08 08:00:00', '2017-03-08 08:30:00', 'Allanamiento', '', NULL, NULL),
	(4, NULL, NULL, '2017-03-26 00:00:00', '2017-03-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(5, NULL, NULL, '2017-04-26 00:00:00', '2017-04-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(6, NULL, NULL, '2017-05-26 00:00:00', '2017-05-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(7, NULL, NULL, '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(8, NULL, NULL, '2017-07-26 00:00:00', '2017-07-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(9, NULL, NULL, '2017-08-26 00:00:00', '2017-08-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(10, NULL, NULL, '2017-09-26 00:00:00', '2017-09-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(11, NULL, NULL, '2017-10-26 00:00:00', '2017-10-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(12, NULL, NULL, '2017-11-26 00:00:00', '2017-11-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(13, NULL, NULL, '2017-12-26 00:00:00', '2017-12-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(14, NULL, NULL, '2018-01-26 00:00:00', '2018-01-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(15, NULL, NULL, '2018-02-26 00:00:00', '2018-02-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(16, NULL, NULL, '2018-03-26 00:00:00', '2018-03-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(17, NULL, NULL, '2018-04-26 00:00:00', '2018-04-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(18, NULL, NULL, '2018-05-26 00:00:00', '2018-05-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(19, NULL, NULL, '2018-06-26 00:00:00', '2018-06-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(20, NULL, NULL, '2018-07-26 00:00:00', '2018-07-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(21, NULL, NULL, '2018-08-26 00:00:00', '2018-08-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(22, NULL, NULL, '2018-09-26 00:00:00', '2018-09-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(23, NULL, NULL, '2018-10-26 00:00:00', '2018-10-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(24, NULL, NULL, '2018-11-26 00:00:00', '2018-11-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(25, NULL, NULL, '2018-12-26 00:00:00', '2018-12-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(26, NULL, NULL, '2019-01-26 00:00:00', '2019-01-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(27, NULL, NULL, '2019-02-26 00:00:00', '2019-02-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(28, NULL, NULL, '2019-03-26 00:00:00', '2019-03-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(29, NULL, NULL, '2019-04-26 00:00:00', '2019-04-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(30, NULL, NULL, '2019-05-26 00:00:00', '2019-05-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(31, NULL, NULL, '2019-06-26 00:00:00', '2019-06-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(32, NULL, NULL, '2019-07-26 00:00:00', '2019-07-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(33, NULL, NULL, '2019-08-26 00:00:00', '2019-08-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(34, NULL, NULL, '2019-09-26 00:00:00', '2019-09-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(35, NULL, NULL, '2019-10-26 00:00:00', '2019-10-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(36, NULL, NULL, '2019-11-26 00:00:00', '2019-11-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(37, NULL, NULL, '2019-12-26 00:00:00', '2019-12-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(38, NULL, NULL, '2020-01-26 00:00:00', '2020-01-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(39, NULL, NULL, '2020-02-26 00:00:00', '2020-02-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(40, NULL, NULL, '2020-03-26 00:00:00', '2020-03-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(41, NULL, NULL, '2020-04-26 00:00:00', '2020-04-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(42, NULL, NULL, '2020-05-26 00:00:00', '2020-05-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(43, NULL, NULL, '2020-06-26 00:00:00', '2020-06-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(44, NULL, NULL, '2020-07-26 00:00:00', '2020-07-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(45, NULL, NULL, '2020-08-26 00:00:00', '2020-08-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(46, NULL, NULL, '2020-09-26 00:00:00', '2020-09-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(47, NULL, NULL, '2020-10-26 00:00:00', '2020-10-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(48, NULL, NULL, '2020-11-26 00:00:00', '2020-11-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(49, NULL, NULL, '2020-12-26 00:00:00', '2020-12-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(50, NULL, NULL, '2021-01-26 00:00:00', '2021-01-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(51, NULL, NULL, '2021-02-26 00:00:00', '2021-02-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(52, NULL, NULL, '2021-03-26 00:00:00', '2021-03-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(53, NULL, NULL, '2021-04-26 00:00:00', '2021-04-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(54, NULL, NULL, '2021-05-26 00:00:00', '2021-05-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(55, NULL, NULL, '2021-06-26 00:00:00', '2021-06-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(56, NULL, NULL, '2021-07-26 00:00:00', '2021-07-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(57, NULL, NULL, '2021-08-26 00:00:00', '2021-08-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(58, NULL, NULL, '2021-09-26 00:00:00', '2021-09-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL),
	(59, NULL, NULL, '2021-10-26 00:00:00', '2021-10-26 00:00:00', 'Cuota convenio', 'Convenio Primero', NULL, NULL);
/*!40000 ALTER TABLE `agenda` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.casos
CREATE TABLE IF NOT EXISTS `casos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caso` varchar(255) NOT NULL DEFAULT '0',
  `id_tipo` int(11) NOT NULL DEFAULT '0',
  `usuario_alta` int(11) DEFAULT NULL,
  `estado_actual` varchar(2) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `radicacion_actual` int(11) DEFAULT NULL,
  `nro_expediente` varchar(30) DEFAULT NULL,
  `nro_carpeta` varchar(25) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `finalizacion` date DEFAULT NULL,
  `nro_archivo` varchar(15) NOT NULL DEFAULT '0',
  `arch_exp` tinyint(4) NOT NULL DEFAULT '0',
  `archivado` tinyint(4) NOT NULL DEFAULT '0',
  `observaciones` text,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `privado` tinyint(4) DEFAULT '0',
  `fecha_ingreso` date NOT NULL,
  `fecha_baja` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `completo` tinyint(4) NOT NULL DEFAULT '0',
  `requerimientos_cliente` text NOT NULL,
  `opinion_profesional` text NOT NULL,
  `id_naturaleza` int(11) DEFAULT NULL,
  `id_estudio` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'iniciado',
  PRIMARY KEY (`id`),
  KEY `id_naturaleza` (`id_naturaleza`),
  KEY `id_estudio` (`id_estudio`),
  KEY `caso` (`caso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.casos: 0 rows
/*!40000 ALTER TABLE `casos` DISABLE KEYS */;
/*!40000 ALTER TABLE `casos` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.conceptos
CREATE TABLE IF NOT EXISTS `conceptos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_padre` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL,
  `sistema` int(11) NOT NULL,
  `accion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.conceptos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `conceptos` DISABLE KEYS */;
INSERT INTO `conceptos` (`id`, `id_padre`, `nombre`, `sistema`, `accion`) VALUES
	(1, 0, 'Ingreso', 1, 1),
	(2, 0, 'Egreso', 1, -1),
	(3, 1, 'Cobro cuota convenio', 1, 1);
/*!40000 ALTER TABLE `conceptos` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.config
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL,
  `name_site` varchar(50) NOT NULL DEFAULT 'Books',
  `show_login` int(11) NOT NULL DEFAULT '1',
  `texto_home` text,
  `show_no_disponibles` int(11) unsigned DEFAULT '1' COMMENT 'si es 1 muestra todos los libros. Si es cero solo los availables = 1 ',
  `lenguaje_automatic` int(11) NOT NULL DEFAULT '1',
  `lenguaje` varchar(20) DEFAULT 'en',
  `show_search_in_home` int(11) NOT NULL,
  `order_list_directorio` varchar(50) NOT NULL DEFAULT 'id',
  `order_list_caso` varchar(50) NOT NULL DEFAULT 'id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.config: 1 rows
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `name_site`, `show_login`, `texto_home`, `show_no_disponibles`, `lenguaje_automatic`, `lenguaje`, `show_search_in_home`, `order_list_directorio`, `order_list_caso`) VALUES
	(1, 'LitigarOnline', 1, 'Home', 0, 0, 'es', 0, 'apellido', 'id desc ');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.contables
CREATE TABLE IF NOT EXISTS `contables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_concepto` int(11) DEFAULT NULL,
  `id_caso` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orden` int(11) DEFAULT NULL,
  `id_convenio` int(11) DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `id_cuota_convenio` int(11) NOT NULL,
  `observaciones` text,
  PRIMARY KEY (`id`),
  KEY `id_concepto` (`id_concepto`),
  KEY `id_caso` (`id_caso`),
  KEY `id_convenio` (`id_convenio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.contables: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contables` DISABLE KEYS */;
/*!40000 ALTER TABLE `contables` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.convenios
CREATE TABLE IF NOT EXISTS `convenios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `dia_primera_cuota` date NOT NULL,
  `porcentaje_mensual` decimal(10,2) NOT NULL,
  `cantidad_cuotas` int(11) NOT NULL,
  `id_caso` int(11) NOT NULL,
  `observaciones` text,
  `cerrado` int(11) NOT NULL DEFAULT '0',
  `porcentaje_anual` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_caso` (`id_caso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.convenios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `convenios` DISABLE KEYS */;
/*!40000 ALTER TABLE `convenios` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.cuotas_convenios
CREATE TABLE IF NOT EXISTS `cuotas_convenios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_convenio` int(11) NOT NULL,
  `monto_cuota` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `pagado` int(1) NOT NULL DEFAULT '0',
  `orden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.cuotas_convenios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cuotas_convenios` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuotas_convenios` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.directorio
CREATE TABLE IF NOT EXISTS `directorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `dni` varchar(50) DEFAULT NULL,
  `personeria` varchar(50) DEFAULT NULL,
  `cuit` varchar(40) DEFAULT NULL,
  `cuil` varchar(40) DEFAULT NULL,
  `observaciones` text,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `apellido` (`apellido`),
  KEY `nombres` (`nombres`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.directorio: 0 rows
/*!40000 ALTER TABLE `directorio` DISABLE KEYS */;
/*!40000 ALTER TABLE `directorio` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.estado_casos
CREATE TABLE IF NOT EXISTS `estado_casos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.estado_casos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estado_casos` DISABLE KEYS */;
INSERT INTO `estado_casos` (`id`, `estado`) VALUES
	(1, 'iniciado');
/*!40000 ALTER TABLE `estado_casos` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.items_liquidaciones
CREATE TABLE IF NOT EXISTS `items_liquidaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_liquidacion` int(11) NOT NULL,
  `rubro` varchar(255) NOT NULL,
  `fecha_exibicion_items` date NOT NULL,
  `fecha_act_items` date NOT NULL,
  `capital` decimal(10,2) NOT NULL,
  `dias` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.items_liquidaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `items_liquidaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `items_liquidaciones` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.juzgados
CREATE TABLE IF NOT EXISTS `juzgados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nominacion` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.juzgados: 0 rows
/*!40000 ALTER TABLE `juzgados` DISABLE KEYS */;
/*!40000 ALTER TABLE `juzgados` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.liquidaciones
CREATE TABLE IF NOT EXISTS `liquidaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_caso` int(11) NOT NULL DEFAULT '0',
  `expediente` varchar(50) NOT NULL,
  `caso` varchar(255) NOT NULL,
  `juzgado` varchar(255) NOT NULL,
  `titulo_cabecera` varchar(255) NOT NULL,
  `rubro_cabecera` varchar(255) NOT NULL,
  `capital_inicial` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fecha_exibicion` date NOT NULL,
  `fecha_act` date NOT NULL,
  `interes_anual` decimal(10,0) NOT NULL DEFAULT '0',
  `interes_punitorio_anual` decimal(10,0) NOT NULL DEFAULT '0',
  `iva` decimal(10,0) NOT NULL DEFAULT '0',
  `dias` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.liquidaciones: 0 rows
/*!40000 ALTER TABLE `liquidaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `liquidaciones` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.movimientos
CREATE TABLE IF NOT EXISTS `movimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_caso` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo_estado` varchar(20) DEFAULT NULL,
  `descripcion` text,
  `acto_procesal` varchar(100) DEFAULT NULL,
  `publico` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_caso` (`id_caso`),
  KEY `fecha` (`fecha`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.movimientos: 0 rows
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.naturalezas_casos
CREATE TABLE IF NOT EXISTS `naturalezas_casos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.naturalezas_casos: 3 rows
/*!40000 ALTER TABLE `naturalezas_casos` DISABLE KEYS */;
INSERT INTO `naturalezas_casos` (`id`, `nombre`) VALUES
	(1, 'Judicial'),
	(2, 'Penal'),
	(3, 'Extrajudicial');
/*!40000 ALTER TABLE `naturalezas_casos` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.partes
CREATE TABLE IF NOT EXISTS `partes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL DEFAULT '0',
  `id_caso` int(11) NOT NULL DEFAULT '0',
  `id_rol` int(11) NOT NULL DEFAULT '0',
  `abogado` int(11) NOT NULL DEFAULT '0',
  `tiene_representacion` int(11) NOT NULL DEFAULT '0',
  `telefono_abog` varchar(255) NOT NULL DEFAULT '0',
  `fax_abog` varchar(255) NOT NULL DEFAULT '0',
  `email_abog` varchar(255) NOT NULL DEFAULT '0',
  `anotaciones` varchar(255) NOT NULL DEFAULT '0',
  `anotaciones_abog` varchar(255) NOT NULL DEFAULT '0',
  `tipo` varchar(20) NOT NULL DEFAULT '0',
  `id_estudio` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_estudio` (`id_estudio`),
  KEY `id_persona` (`id_persona`),
  KEY `id_caso` (`id_caso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.partes: 0 rows
/*!40000 ALTER TABLE `partes` DISABLE KEYS */;
/*!40000 ALTER TABLE `partes` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.radicacion_anterior
CREATE TABLE IF NOT EXISTS `radicacion_anterior` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_juzgado` int(11) DEFAULT '0',
  `nro_expediente` int(11) DEFAULT '0',
  `id_caso` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_caso` (`id_caso`),
  KEY `id_juzgado` (`id_juzgado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.radicacion_anterior: 0 rows
/*!40000 ALTER TABLE `radicacion_anterior` DISABLE KEYS */;
/*!40000 ALTER TABLE `radicacion_anterior` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.recorrida
CREATE TABLE IF NOT EXISTS `recorrida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_caso` int(11) NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.recorrida: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `recorrida` DISABLE KEYS */;
/*!40000 ALTER TABLE `recorrida` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.roles: 2 rows
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `nombre`) VALUES
	(1, 'Actor'),
	(2, 'Demandado');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.ultimos_vistos
CREATE TABLE IF NOT EXISTS `ultimos_vistos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_caso` int(11) NOT NULL DEFAULT '0',
  `id_directorio` int(11) NOT NULL DEFAULT '0',
  `fecha_hora` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_caso` (`id_caso`),
  KEY `id_directorio` (`id_directorio`),
  KEY `fecha_hora` (`fecha_hora`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.ultimos_vistos: 0 rows
/*!40000 ALTER TABLE `ultimos_vistos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ultimos_vistos` ENABLE KEYS */;

-- Volcando estructura para tabla reaynal.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(12) NOT NULL DEFAULT '0',
  `password` varchar(32) NOT NULL DEFAULT '0',
  `tipo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla reaynal.users: 1 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `password`, `tipo`) VALUES
	(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
