-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: 
-- ------------------------------------------------------
-- Server version	5.5.24-0ubuntu0.12.04.1

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
-- Current Database: `cime`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `cime` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cime`;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `hora_in` time NOT NULL DEFAULT '00:00:00',
  `hora_fin` time DEFAULT NULL,
  `cod_med` int(11) NOT NULL DEFAULT '0',
  `cod_pac` int(11) NOT NULL DEFAULT '0',
  `estado` enum('cancelada','solicitada','cumplida','incumplida','debe','pagada') COLLATE latin1_general_ci NOT NULL DEFAULT 'solicitada',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `cod_medico_2` (`cod_med`,`fecha`,`hora_in`),
  UNIQUE KEY `cod_paciente_2` (`cod_pac`,`fecha`,`hora_in`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (15,'2007-12-19','09:00:00',NULL,27,16,'solicitada'),(14,'2007-12-21','20:00:00',NULL,27,16,'solicitada'),(16,'2009-11-10','08:00:00',NULL,27,16,'solicitada');
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario_nodisp`
--

DROP TABLE IF EXISTS `horario_nodisp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horario_nodisp` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_med` int(11) NOT NULL DEFAULT '0',
  `fecha_in` date NOT NULL DEFAULT '0000-00-00',
  `fecha_fin` date DEFAULT NULL,
  `hora_in` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `cod_med` (`cod_med`,`fecha_in`,`hora_in`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario_nodisp`
--

LOCK TABLES `horario_nodisp` WRITE;
/*!40000 ALTER TABLE `horario_nodisp` DISABLE KEYS */;
INSERT INTO `horario_nodisp` VALUES (12,27,'2007-12-24','2007-12-31',NULL,NULL),(13,27,'2007-12-19',NULL,'10:00:00','11:00:00'),(14,27,'2007-12-22',NULL,'07:00:00','10:00:00');
/*!40000 ALTER TABLE `horario_nodisp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios_medicos`
--

DROP TABLE IF EXISTS `horarios_medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horarios_medicos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_med` int(11) NOT NULL DEFAULT '0',
  `hora_in` time NOT NULL DEFAULT '00:00:00',
  `dias_selec` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `cod_med` (`cod_med`,`hora_in`)
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios_medicos`
--

LOCK TABLES `horarios_medicos` WRITE;
/*!40000 ALTER TABLE `horarios_medicos` DISABLE KEYS */;
INSERT INTO `horarios_medicos` VALUES (150,27,'21:00:00',0),(149,27,'20:00:00',0),(148,27,'19:00:00',0),(147,27,'18:00:00',31),(146,27,'17:00:00',31),(145,27,'16:00:00',31),(144,27,'15:00:00',31),(143,27,'14:00:00',31),(142,27,'13:00:00',0),(141,27,'12:00:00',0),(140,27,'11:00:00',0),(139,27,'10:00:00',31),(138,27,'09:00:00',31),(137,27,'08:00:00',31),(136,27,'07:00:00',0);
/*!40000 ALTER TABLE `horarios_medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `doc_ident` int(11) NOT NULL DEFAULT '0',
  `tipo_doc` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `oficina` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `cod_tipo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `doc_ident` (`doc_ident`,`tipo_doc`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicos`
--

LOCK TABLES `medicos` WRITE;
/*!40000 ALTER TABLE `medicos` DISABLE KEYS */;
INSERT INTO `medicos` VALUES (27,45678901,1,'Diego Ospina','111',1);
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `apellidos` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `doc_ident` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `tipo_doc` int(11) NOT NULL DEFAULT '0',
  `cod_seguro` varchar(15) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `entidad_med` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `documento` (`doc_ident`,`tipo_doc`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (16,'Carlos','Arce','12345678',1,'12345','coomeva');
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paginas`
--

DROP TABLE IF EXISTS `paginas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paginas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_tarea` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paginas`
--

LOCK TABLES `paginas` WRITE;
/*!40000 ALTER TABLE `paginas` DISABLE KEYS */;
INSERT INTO `paginas` VALUES (43,1,'solcita'),(42,16,'admhormed'),(41,16,'admmed'),(40,15,'confirmcita'),(39,14,'admpac'),(38,4,'asignacita'),(36,1,'citasmedindex'),(37,15,'admcitas');
/*!40000 ALTER TABLE `paginas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tareas`
--

DROP TABLE IF EXISTS `tareas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tareas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tareas`
--

LOCK TABLES `tareas` WRITE;
/*!40000 ALTER TABLE `tareas` DISABLE KEYS */;
INSERT INTO `tareas` VALUES (1,'solicitar_citas'),(2,'consultar_citas'),(3,'cancelar_citas'),(4,'asignar_citas'),(5,'modificar_citas'),(6,'crear_horario'),(7,'modificar_horario'),(8,'consultar_horario'),(9,'cancelar_horario'),(10,'crear_usuario'),(11,'modificar_usuario'),(12,'consultar_usuario'),(13,'cancelar_usuario'),(14,'adm_pacientes'),(15,'adm_citas'),(16,'adm_med');
/*!40000 ALTER TABLE `tareas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_doc`
--

DROP TABLE IF EXISTS `tipo_doc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_doc` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_doc`
--

LOCK TABLES `tipo_doc` WRITE;
/*!40000 ALTER TABLE `tipo_doc` DISABLE KEYS */;
INSERT INTO `tipo_doc` VALUES (1,'c&eacute;dula de ciudadan&iacute;a'),(2,'tarjeta de identidad'),(3,'c&eacute;dula de extranjer&iacute;a');
/*!40000 ALTER TABLE `tipo_doc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_med`
--

DROP TABLE IF EXISTS `tipo_med`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_med` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_med`
--

LOCK TABLES `tipo_med` WRITE;
/*!40000 ALTER TABLE `tipo_med` DISABLE KEYS */;
INSERT INTO `tipo_med` VALUES (1,'general'),(2,'especialista');
/*!40000 ALTER TABLE `tipo_med` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usr`
--

DROP TABLE IF EXISTS `tipo_usr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usr` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usr`
--

LOCK TABLES `tipo_usr` WRITE;
/*!40000 ALTER TABLE `tipo_usr` DISABLE KEYS */;
INSERT INTO `tipo_usr` VALUES (3,'paciente'),(4,'asistente'),(5,'administrador');
/*!40000 ALTER TABLE `tipo_usr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usr_tarea`
--

DROP TABLE IF EXISTS `usr_tarea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usr_tarea` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_tp_usr` int(11) NOT NULL DEFAULT '0',
  `cod_tarea` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `cod_tp_usr` (`cod_tp_usr`,`cod_tarea`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usr_tarea`
--

LOCK TABLES `usr_tarea` WRITE;
/*!40000 ALTER TABLE `usr_tarea` DISABLE KEYS */;
INSERT INTO `usr_tarea` VALUES (1,3,1),(2,4,1),(3,4,2),(4,4,3),(5,4,4),(6,4,5),(7,4,6),(8,4,7),(9,4,8),(10,4,9),(11,5,1),(12,5,2),(13,5,3),(14,5,4),(15,5,5),(16,5,6),(17,5,7),(18,5,8),(19,5,9),(20,5,10),(21,5,11),(22,5,12),(23,5,13),(24,4,14),(25,4,15),(26,4,16);
/*!40000 ALTER TABLE `usr_tarea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `password` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `cod_tp_usr` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `login` (`login`),
  KEY `cod_tp_usr` (`cod_tp_usr`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',5),(14,'paciente','d243800a7d0ba0f87081bcdd832bb05f',3),(15,'asistente1','15028d82f1f887339fe4d4c9c2b58b5f',4),(18,'test1','098f6bcd4621d373cade4e832627b4f6',3);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

