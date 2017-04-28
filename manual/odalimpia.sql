-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-07-2013 a las 17:09:33
-- Versión del servidor: 5.1.44
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `odalimpia`
--
CREATE DATABASE `odalimpia` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `odalimpia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenidos_pagina`
--

CREATE TABLE IF NOT EXISTS `contenidos_pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpagina` int(11) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `contenido` text,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `contenidos_pagina`
--

INSERT INTO `contenidos_pagina` (`id`, `idpagina`, `tipo`, `imagen`, `contenido`, `orden`) VALUES
(1, 1, '2', NULL, '<h1 style="text-align: center; ">Presentaci&oacute;n del sitio web&nbsp;</h1>', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controlled_data`
--

CREATE TABLE IF NOT EXISTS `controlled_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idov` int(11) DEFAULT NULL,
  `idseccion` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `idrecurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idseccion` (`idseccion`),
  KEY `idov` (`idov`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30678 ;

--
-- Volcar la base de datos para la tabla `controlled_data`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `date_data`
--

CREATE TABLE IF NOT EXISTS `date_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idov` int(11) DEFAULT NULL,
  `idseccion` int(11) DEFAULT NULL,
  `value` int(8) DEFAULT NULL,
  `idrecurso` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `idov` (`idov`),
  KEY `idseccion` (`idseccion`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2390 ;

--
-- Volcar la base de datos para la tabla `date_data`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_modificaciones`
--

CREATE TABLE IF NOT EXISTS `log_modificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `fechaModificacion` varchar(14) DEFAULT NULL,
  `tipo` varchar(2) DEFAULT NULL,
  `idov` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2451 ;

--
-- Volcar la base de datos para la tabla `log_modificaciones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(255) DEFAULT NULL,
  `atributo` varchar(255) DEFAULT NULL,
  `valor` text,
  `grupo` varchar(255) DEFAULT NULL,
  `formato` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `etiqueta` varchar(255) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

--
-- Volcar la base de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `lang`, `atributo`, `valor`, `grupo`, `formato`, `tipo`, `etiqueta`, `orden`) VALUES
(121, 'es', 'datos_titulo', 'Objetos Digitales Arqueológicos', 'Datos del contenedor', 'largo', 'cabecera', 'Título del contenedor', 1),
(122, 'es', 'datos_descripcion', 'Contenedor de objetos digitales', 'Datos del sitio web', 'texto', 'cabecera', 'Descripción', 2),
(123, 'es', 'datos_palabras', ' museo virtual, contenedor de objetos virtuales de aprendizaje, repositorio de objetos de aprendizaje', 'Datos del sitio web', 'texto', 'cabecera', 'Palabras clave', 3),
(124, 'es', 'datos_imagen', '../../download/bancorecursos/cabecera_digitales.png', 'Datos del contenedor', 'imagen', 'cabecera', 'Imagen cabecera', 4),
(128, 'en', 'datos_imagen', NULL, 'Datos del contenedor', 'imagen', 'cabecera', 'Imagen Cabecera', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `navegacion`
--

CREATE TABLE IF NOT EXISTS `navegacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `tooltip` varchar(255) DEFAULT NULL,
  `idpadre` int(11) DEFAULT NULL,
  `visible` char(1) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `tipo_contenido` varchar(255) DEFAULT NULL,
  `idpagina` int(11) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `nombreseo` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `contenido` text,
  `url` varchar(255) DEFAULT NULL,
  `tiene_contenido` varchar(255) DEFAULT NULL,
  `protocolo` varchar(255) DEFAULT NULL,
  `ventanaexterna` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Volcar la base de datos para la tabla `navegacion`
--

INSERT INTO `navegacion` (`id`, `nombre`, `tooltip`, `idpadre`, `visible`, `orden`, `tipo_contenido`, `idpagina`, `tipo`, `nombreseo`, `imagen`, `contenido`, `url`, `tiene_contenido`, `protocolo`, `ventanaexterna`) VALUES
(27, 'MANTENIMIENTO', NULL, 0, 'N', 1000, 'M', NULL, 'I', 'mantenimiento', NULL, NULL, NULL, 'S', NULL, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeric_data`
--

CREATE TABLE IF NOT EXISTS `numeric_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idov` int(11) DEFAULT NULL,
  `idseccion` int(11) DEFAULT NULL,
  `value` decimal(30,15) DEFAULT NULL,
  `idrecurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idov` (`idov`),
  KEY `idseccion` (`idseccion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1044 ;

--
-- Volcar la base de datos para la tabla `numeric_data`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE IF NOT EXISTS `paginas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `contenido` text,
  `visible` char(1) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `paginas`
--

INSERT INTO `paginas` (`id`, `titulo`, `contenido`, `visible`, `documento`) VALUES
(1, 'Presentación del sitio web', NULL, 'N', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `idov` int(11) DEFAULT NULL,
  `tipoPermiso` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=199 ;

--
-- Volcar la base de datos para la tabla `permisos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias_presentacion`
--

CREATE TABLE IF NOT EXISTS `preferencias_presentacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atributo` varchar(255) DEFAULT NULL,
  `valor` text,
  `tipo` varchar(255) DEFAULT NULL,
  `etiqueta` varchar(255) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `formato` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `preferencias_presentacion`
--

INSERT INTO `preferencias_presentacion` (`id`, `atributo`, `valor`, `tipo`, `etiqueta`, `orden`, `formato`) VALUES
(1, 'portada_contenido', 'I', 'P', NULL, NULL, NULL),
(2, 'imagen_fondo_global', NULL, 'F', 'Imagen de fondo global', 1, 'imagen'),
(3, 'color_fondo', NULL, 'F', 'Color de fondo', 2, 'color'),
(4, 'seguridad_web', 'N', NULL, NULL, NULL, NULL),
(5, 'extension_archivos', 'png;jpg', NULL, NULL, NULL, NULL),
(6, 'numeric_decimal', '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idov` int(11) DEFAULT NULL,
  `ordinal` int(11) DEFAULT NULL,
  `visible` char(1) DEFAULT NULL,
  `iconoov` char(1) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `idov_refered` int(11) DEFAULT NULL,
  `idresource_refered` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=628 ;

--
-- Volcar la base de datos para la tabla `resources`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `section_data`
--

CREATE TABLE IF NOT EXISTS `section_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpadre` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `tooltip` varchar(255) DEFAULT NULL,
  `visible` char(1) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `browseable` char(1) DEFAULT NULL,
  `tipo_valores` varchar(255) DEFAULT NULL,
  `extensible` char(1) DEFAULT NULL,
  `vocabulario` int(11) DEFAULT NULL,
  `decimales` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=392 ;

--
-- Volcar la base de datos para la tabla `section_data`
--

INSERT INTO `section_data` (`id`, `idpadre`, `nombre`, `codigo`, `tooltip`, `visible`, `orden`, `browseable`, `tipo_valores`, `extensible`, `vocabulario`, `decimales`) VALUES
(1, 0, 'Modelo de Datos', 'datos', 'datos', 'S', 1, NULL, NULL, 'S', 0, NULL),
(2, 0, 'Modelo de MetaDatos', 'lom', 'metadatos', 'S', 2, NULL, NULL, 'S', 0, NULL),
(3, 0, 'Modelo de Datos de los Recursos', 'recursos', 'recursos', 'S', 3, NULL, NULL, 'S', 0, NULL),
(111, 1, 'DESCRIPCIÓN', NULL, 'fijo_texto', 'S', 119, NULL, 'T', NULL, NULL, NULL),
(112, 1, 'TIPO OBJETO', NULL, 'fijo_controlado', 'S', 120, NULL, 'C', NULL, NULL, NULL);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `text_data`
--

CREATE TABLE IF NOT EXISTS `text_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idov` int(11) DEFAULT NULL,
  `idseccion` int(11) DEFAULT NULL,
  `value` text,
  `idrecurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idov` (`idov`),
  KEY `idseccion` (`idseccion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1267 ;

--
-- Volcar la base de datos para la tabla `text_data`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` varchar(255) DEFAULT NULL,
  `ultimo_acceso` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=146 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `correo`, `login`, `password`, `rol`, `ultimo_acceso`) VALUES
(11, 'admin1', 'admin2', 'test@test.test', 'admin', 'admin', 'B', '20130528145220'),
(111, 'user1', 'user2', 'test@test.test', 'user', 'user', 'C', '20130528145128'),
(1, 'super1', 'super2', 'test@test.test', 'superadmin', 'superadmin', 'A', '20130706165555');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `virtual_object`
--

CREATE TABLE IF NOT EXISTS `virtual_object` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ispublic` char(1) DEFAULT NULL,
  `isprivate` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=310 ;

--
-- Volcar la base de datos para la tabla `virtual_object`
--

