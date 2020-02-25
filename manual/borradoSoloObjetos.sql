
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
