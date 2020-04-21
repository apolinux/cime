-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-11-2009 a las 13:48:44
-- Versión del servidor: 5.1.33
-- Versión de PHP: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cime`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE IF NOT EXISTS `citas` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `citas`
--

INSERT INTO `citas` (`codigo`, `fecha`, `hora_in`, `hora_fin`, `cod_med`, `cod_pac`, `estado`) VALUES
(15, '2007-12-19', '09:00:00', NULL, 27, 16, 'solicitada'),
(14, '2007-12-21', '20:00:00', NULL, 27, 16, 'solicitada'),
(16, '2009-11-10', '08:00:00', NULL, 27, 16, 'solicitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios_medicos`
--

DROP TABLE IF EXISTS `horarios_medicos`;
CREATE TABLE IF NOT EXISTS `horarios_medicos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_med` int(11) NOT NULL DEFAULT '0',
  `hora_in` time NOT NULL DEFAULT '00:00:00',
  `dias_selec` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `cod_med` (`cod_med`,`hora_in`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=151 ;

--
-- Volcar la base de datos para la tabla `horarios_medicos`
--

INSERT INTO `horarios_medicos` (`codigo`, `cod_med`, `hora_in`, `dias_selec`) VALUES
(150, 27, '21:00:00', 0),
(149, 27, '20:00:00', 0),
(148, 27, '19:00:00', 0),
(147, 27, '18:00:00', 31),
(146, 27, '17:00:00', 31),
(145, 27, '16:00:00', 31),
(144, 27, '15:00:00', 31),
(143, 27, '14:00:00', 31),
(142, 27, '13:00:00', 0),
(141, 27, '12:00:00', 0),
(140, 27, '11:00:00', 0),
(139, 27, '10:00:00', 31),
(138, 27, '09:00:00', 31),
(137, 27, '08:00:00', 31),
(136, 27, '07:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_nodisp`
--

DROP TABLE IF EXISTS `horario_nodisp`;
CREATE TABLE IF NOT EXISTS `horario_nodisp` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_med` int(11) NOT NULL DEFAULT '0',
  `fecha_in` date NOT NULL DEFAULT '0000-00-00',
  `fecha_fin` date DEFAULT NULL,
  `hora_in` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `cod_med` (`cod_med`,`fecha_in`,`hora_in`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

--
-- Volcar la base de datos para la tabla `horario_nodisp`
--

INSERT INTO `horario_nodisp` (`codigo`, `cod_med`, `fecha_in`, `fecha_fin`, `hora_in`, `hora_fin`) VALUES
(12, 27, '2007-12-24', '2007-12-31', NULL, NULL),
(13, 27, '2007-12-19', NULL, '10:00:00', '11:00:00'),
(14, 27, '2007-12-22', NULL, '07:00:00', '10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

DROP TABLE IF EXISTS `medicos`;
CREATE TABLE IF NOT EXISTS `medicos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `doc_ident` int(11) NOT NULL DEFAULT '0',
  `tipo_doc` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `oficina` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `cod_tipo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `doc_ident` (`doc_ident`,`tipo_doc`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=28 ;

--
-- Volcar la base de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`codigo`, `doc_ident`, `tipo_doc`, `nombre`, `oficina`, `cod_tipo`) VALUES
(27, 45678901, 1, 'Diego Ospina', '111', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `apellidos` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `doc_ident` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `tipo_doc` int(11) NOT NULL DEFAULT '0',
  `cod_seguro` varchar(15) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `entidad_med` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `documento` (`doc_ident`,`tipo_doc`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`codigo`, `nombres`, `apellidos`, `doc_ident`, `tipo_doc`, `cod_seguro`, `entidad_med`) VALUES
(16, 'Carlos', 'Arce', '12345678', 1, '12345', 'coomeva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

DROP TABLE IF EXISTS `paginas`;
CREATE TABLE IF NOT EXISTS `paginas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_tarea` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=44 ;

--
-- Volcar la base de datos para la tabla `paginas`
--

INSERT INTO `paginas` (`codigo`, `cod_tarea`, `nombre`) VALUES
(43, 1, 'solcita'),
(42, 16, 'admhormed'),
(41, 16, 'admmed'),
(40, 15, 'confirmcita'),
(39, 14, 'admpac'),
(38, 4, 'asignacita'),
(36, 1, 'citasmedindex'),
(37, 15, 'admcitas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

DROP TABLE IF EXISTS `tareas`;
CREATE TABLE IF NOT EXISTS `tareas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`codigo`, `nombre`) VALUES
(1, 'solicitar_citas'),
(2, 'consultar_citas'),
(3, 'cancelar_citas'),
(4, 'asignar_citas'),
(5, 'modificar_citas'),
(6, 'crear_horario'),
(7, 'modificar_horario'),
(8, 'consultar_horario'),
(9, 'cancelar_horario'),
(10, 'crear_usuario'),
(11, 'modificar_usuario'),
(12, 'consultar_usuario'),
(13, 'cancelar_usuario'),
(14, 'adm_pacientes'),
(15, 'adm_citas'),
(16, 'adm_med');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_doc`
--

DROP TABLE IF EXISTS `tipo_doc`;
CREATE TABLE IF NOT EXISTS `tipo_doc` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `tipo_doc`
--

INSERT INTO `tipo_doc` (`codigo`, `nombre`) VALUES
(1, 'c&eacute;dula de ciudadan&iacute;a'),
(2, 'tarjeta de identidad'),
(3, 'c&eacute;dula de extranjer&iacute;a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_med`
--

DROP TABLE IF EXISTS `tipo_med`;
CREATE TABLE IF NOT EXISTS `tipo_med` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `tipo_med`
--

INSERT INTO `tipo_med` (`codigo`, `nombre`) VALUES
(1, 'general'),
(2, 'especialista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usr`
--

DROP TABLE IF EXISTS `tipo_usr`;
CREATE TABLE IF NOT EXISTS `tipo_usr` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `tipo_usr`
--

INSERT INTO `tipo_usr` (`codigo`, `nombre`) VALUES
(3, 'paciente'),
(4, 'asistente'),
(5, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr_tarea`
--

DROP TABLE IF EXISTS `usr_tarea`;
CREATE TABLE IF NOT EXISTS `usr_tarea` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_tp_usr` int(11) NOT NULL DEFAULT '0',
  `cod_tarea` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `cod_tp_usr` (`cod_tp_usr`,`cod_tarea`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

--
-- Volcar la base de datos para la tabla `usr_tarea`
--

INSERT INTO `usr_tarea` (`codigo`, `cod_tp_usr`, `cod_tarea`) VALUES
(1, 3, 1),
(2, 4, 1),
(3, 4, 2),
(4, 4, 3),
(5, 4, 4),
(6, 4, 5),
(7, 4, 6),
(8, 4, 7),
(9, 4, 8),
(10, 4, 9),
(11, 5, 1),
(12, 5, 2),
(13, 5, 3),
(14, 5, 4),
(15, 5, 5),
(16, 5, 6),
(17, 5, 7),
(18, 5, 8),
(19, 5, 9),
(20, 5, 10),
(21, 5, 11),
(22, 5, 12),
(23, 5, 13),
(24, 4, 14),
(25, 4, 15),
(26, 4, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `password` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `cod_tp_usr` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `login` (`login`),
  KEY `cod_tp_usr` (`cod_tp_usr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=19 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `login`, `password`, `cod_tp_usr`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 5),
(14, 'paciente', 'd243800a7d0ba0f87081bcdd832bb05f', 3),
(15, 'asistente1', '15028d82f1f887339fe4d4c9c2b58b5f', 4),
(18, 'test1', '098f6bcd4621d373cade4e832627b4f6', 3);


-- crear usuario y  permisos a la bd

grant all on cime.* to cime_user@localhost identified by '12345' 
-- grant all on cime.* to cime_user@'%' identified by '12345' ;                                                             