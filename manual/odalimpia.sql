-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: oda2017
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contenidos_pagina`
--

DROP TABLE IF EXISTS `contenidos_pagina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contenidos_pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpagina` int(11) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `contenido` text,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contenidos_pagina`
--

LOCK TABLES `contenidos_pagina` WRITE;
/*!40000 ALTER TABLE `contenidos_pagina` DISABLE KEYS */;
INSERT INTO `contenidos_pagina` VALUES (1,1,'2',NULL,'<h1 style=\"text-align: center; \">Presentaci&oacute;n del sitio web&nbsp;</h1>',5);
/*!40000 ALTER TABLE `contenidos_pagina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controlled_data`
--

DROP TABLE IF EXISTS `controlled_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controlled_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idov` int(11) DEFAULT NULL,
  `idseccion` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `idrecurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idseccion` (`idseccion`),
  KEY `idov` (`idov`),
  KEY `idx_controlled_data_idseccion_value` (`idseccion`,`value`)
) ENGINE=MyISAM AUTO_INCREMENT=30678 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controlled_data`
--

LOCK TABLES `controlled_data` WRITE;
/*!40000 ALTER TABLE `controlled_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `controlled_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `date_data`
--

DROP TABLE IF EXISTS `date_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `date_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idov` int(11) DEFAULT NULL,
  `idseccion` int(11) DEFAULT NULL,
  `value` int(8) DEFAULT NULL,
  `idrecurso` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `idov` (`idov`),
  KEY `idseccion` (`idseccion`),
  KEY `idx_date_data_value_idseccion` (`value`,`idseccion`)
) ENGINE=MyISAM AUTO_INCREMENT=2390 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `date_data`
--

LOCK TABLES `date_data` WRITE;
/*!40000 ALTER TABLE `date_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `date_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_modificaciones`
--

DROP TABLE IF EXISTS `log_modificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_modificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `fechaModificacion` varchar(14) DEFAULT NULL,
  `tipo` varchar(2) DEFAULT NULL,
  `idov` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2451 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_modificaciones`
--

LOCK TABLES `log_modificaciones` WRITE;
/*!40000 ALTER TABLE `log_modificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_modificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensajes` (
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
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` VALUES (121,'es','datos_titulo','Objetos Digitales Arqueológicos','Datos del contenedor','largo','cabecera','Título del contenedor',1),(122,'es','datos_descripcion','Contenedor de objetos digitales','Datos del sitio web','texto','cabecera','Descripción',2),(123,'es','datos_palabras',' museo virtual, contenedor de objetos virtuales de aprendizaje, repositorio de objetos de aprendizaje','Datos del sitio web','texto','cabecera','Palabras clave',3),(124,'es','datos_imagen','../../download/bancorecursos/cabecera_digitales.png','Datos del contenedor','imagen','cabecera','Imagen cabecera',4),(128,'en','datos_imagen',NULL,'Datos del contenedor','imagen','cabecera','Imagen Cabecera',4);
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `navegacion`
--

DROP TABLE IF EXISTS `navegacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `navegacion` (
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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `navegacion`
--

LOCK TABLES `navegacion` WRITE;
/*!40000 ALTER TABLE `navegacion` DISABLE KEYS */;
INSERT INTO `navegacion` VALUES (27,'MANTENIMIENTO',NULL,0,'N',1000,'M',NULL,'I','mantenimiento',NULL,NULL,NULL,'S',NULL,'N');
/*!40000 ALTER TABLE `navegacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `numeric_data`
--

DROP TABLE IF EXISTS `numeric_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `numeric_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idov` int(11) DEFAULT NULL,
  `idseccion` int(11) DEFAULT NULL,
  `value` decimal(30,15) DEFAULT NULL,
  `idrecurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idov` (`idov`),
  KEY `idseccion` (`idseccion`),
  KEY `idx_numeric_data_value_idseccion` (`value`,`idseccion`)
) ENGINE=MyISAM AUTO_INCREMENT=1044 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `numeric_data`
--

LOCK TABLES `numeric_data` WRITE;
/*!40000 ALTER TABLE `numeric_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `numeric_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paginas`
--

DROP TABLE IF EXISTS `paginas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paginas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `contenido` text,
  `visible` char(1) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paginas`
--

LOCK TABLES `paginas` WRITE;
/*!40000 ALTER TABLE `paginas` DISABLE KEYS */;
INSERT INTO `paginas` VALUES (1,'Presentación del sitio web',NULL,'N',NULL);
/*!40000 ALTER TABLE `paginas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `idov` int(11) DEFAULT NULL,
  `tipoPermiso` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=199 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preferencias_presentacion`
--

DROP TABLE IF EXISTS `preferencias_presentacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preferencias_presentacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atributo` varchar(255) DEFAULT NULL,
  `valor` text,
  `tipo` varchar(255) DEFAULT NULL,
  `etiqueta` varchar(255) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `formato` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferencias_presentacion`
--

LOCK TABLES `preferencias_presentacion` WRITE;
/*!40000 ALTER TABLE `preferencias_presentacion` DISABLE KEYS */;
INSERT INTO `preferencias_presentacion` VALUES (1,'portada_contenido','I','P',NULL,NULL,NULL),(2,'imagen_fondo_global',NULL,'F','Imagen de fondo global',1,'imagen'),(3,'color_fondo',NULL,'F','Color de fondo',2,'color'),(4,'seguridad_web','N',NULL,NULL,NULL,NULL),(5,'extension_archivos','png;jpg',NULL,NULL,NULL,NULL),(6,'numeric_decimal','1',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `preferencias_presentacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resources` (
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
) ENGINE=MyISAM AUTO_INCREMENT=628 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section_data`
--

DROP TABLE IF EXISTS `section_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section_data` (
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
) ENGINE=MyISAM AUTO_INCREMENT=392 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section_data`
--

LOCK TABLES `section_data` WRITE;
/*!40000 ALTER TABLE `section_data` DISABLE KEYS */;
INSERT INTO `section_data` VALUES (1,0,'Modelo de Datos','datos','datos','S',1,NULL,NULL,'S',0,NULL),(2,0,'Modelo de MetaDatos','lom','metadatos','S',2,NULL,NULL,'S',0,NULL),(3,0,'Modelo de Datos de los Recursos','recursos','recursos','S',3,NULL,NULL,'S',0,NULL),(111,1,'DESCRIPCIÓN',NULL,'fijo_texto','S',119,NULL,'T',NULL,NULL,NULL),(112,1,'TIPO OBJETO',NULL,'fijo_controlado','S',120,NULL,'C',NULL,NULL,NULL);
/*!40000 ALTER TABLE `section_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `text_data`
--

DROP TABLE IF EXISTS `text_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `text_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idov` int(11) DEFAULT NULL,
  `idseccion` int(11) DEFAULT NULL,
  `value` text,
  `idrecurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idov` (`idov`),
  KEY `idseccion` (`idseccion`),
  KEY `idx_text_data_value_idseccion` (`value`(30),`idseccion`)
) ENGINE=MyISAM AUTO_INCREMENT=1267 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `text_data`
--

LOCK TABLES `text_data` WRITE;
/*!40000 ALTER TABLE `text_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `text_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` varchar(255) DEFAULT NULL,
  `ultimo_acceso` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (11,'admin1','admin2','test@test.test','admin','admin','B','20130528145220'),(111,'user1','user2','test@test.test','user','user','C','20130528145128'),(1,'super1','super2','test@test.test','superadmin','superadmin','A','20130706165555');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `virtual_object`
--

DROP TABLE IF EXISTS `virtual_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `virtual_object` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ispublic` char(1) DEFAULT NULL,
  `isprivate` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=310 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `virtual_object`
--

LOCK TABLES `virtual_object` WRITE;
/*!40000 ALTER TABLE `virtual_object` DISABLE KEYS */;
/*!40000 ALTER TABLE `virtual_object` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'oda2017'
--

--
-- Dumping routines for database 'oda2017'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-26 12:03:25
