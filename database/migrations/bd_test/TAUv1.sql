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

-- Laravel migrations never recreate databases
-- in order to preserve migrations table
-- drop database IF EXISTS `test`;
-- drop database IF EXISTS `tau_test`;
-- drop database IF EXISTS `inventario_test`;
-- create database tau_test;
-- create database inventario_test;

use tau_test;

DROP TABLE IF EXISTS `alerta`;
CREATE TABLE `alerta` (
  `ID_ALERTA` int(10) unsigned NOT NULL auto_increment,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL default '00:00:00',
  `EQUIPO` varchar(50) collate utf8_spanish_ci NOT NULL,
  `ORIGEN` varchar(50) collate utf8_spanish_ci NOT NULL,
  `TIPO` varchar(50) collate utf8_spanish_ci NOT NULL,
  `NIVEL` int(11) NOT NULL,
  `ASUNTO` varchar(500) collate utf8_spanish_ci NOT NULL default '',
  `MENSAJE` varchar(20000) collate utf8_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`ID_ALERTA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `rsync`;
CREATE TABLE `rsync` (
  `ID_EVENTO` int(10) unsigned NOT NULL auto_increment,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL default '00:00:00',
  `ORIGEN` varchar(100) collate utf8_spanish_ci NOT NULL,
  `TOTALFICHEROS` int(11),
  `TOTALTAMANO` int(11),
  `VELOCIDAD` int(11),
  `FICHEROSTRANSFERIDOS` int(11),
  `TIEMPOTOTAL` int(11),
  `RESULTADO`varchar(10),
  `CODERROR` varchar(400),
  PRIMARY KEY  (`ID_EVENTO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `calendario_citas`
--

DROP TABLE IF EXISTS `calendario_citas`;
CREATE TABLE `calendario_citas` (
  `ID_CITA` int(11) NOT NULL auto_increment,
  `ID_USUARIO` int(11) default NULL,
  `ID_GRUPO` int(11) default NULL,
  `DIA` int(11) NOT NULL,
  `MES` int(11) NOT NULL,
  `ANIO` int(11) NOT NULL,
  `HORA` int(11) NOT NULL,
  `MIN` int(11) NOT NULL,
  `TEXTO` varchar(255) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`ID_CITA`),
  KEY `ID_USUARIO` (`ID_USUARIO`),
  KEY `ID_GRUPO` (`ID_GRUPO`),
  CONSTRAINT `calendario_citas_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `calendario_citas_ibfk_2` FOREIGN KEY (`ID_GRUPO`) REFERENCES `grupo` (`ID_GRUPO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Citas programadas';

--
-- Table structure for table `calendario_citas2`
--

DROP TABLE IF EXISTS `calendario_citas2`;
CREATE TABLE `calendario_citas2` (
  `ID_CITA` int(11) NOT NULL auto_increment,
  `ID_USUARIO` int(11) default NULL,
  `ID_GRUPO` int(11) default NULL,
  `FECHA` date default NULL,
  `HORA` time default NULL,
  `TEXTO` varchar(255) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`ID_CITA`),
  KEY `ID_USUARIO` (`ID_USUARIO`),
  KEY `ID_GRUPO` (`ID_GRUPO`),
  CONSTRAINT `calendario_citas2_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `calendario_citas2_ibfk_2` FOREIGN KEY (`ID_GRUPO`) REFERENCES `grupo` (`ID_GRUPO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Citas programadas';

--
-- Table structure for table `calendario_festivos`
--

DROP TABLE IF EXISTS `calendario_festivos`;
CREATE TABLE `calendario_festivos` (
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) default NULL,
  `motivo` varchar(50) collate utf8_spanish_ci default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Dias Festivos para el Modulo de Calendario';


--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `ID_MODULO` int(11) NOT NULL,
  `VARIABLE` varchar(255) collate utf8_spanish_ci NOT NULL default '',
  `VALOR` varchar(855) collate utf8_spanish_ci default NULL,
  `ID_USUARIO` int(11) NOT NULL,
  KEY `NDX_MODULO` (`ID_MODULO`),
  KEY `NDX_USUARIO` (`ID_USUARIO`),
  CONSTRAINT `config_ibfk_1` FOREIGN KEY (`ID_MODULO`) REFERENCES `modulo` (`ID_MODULO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `config_ibfk_2` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Repositotio de Variables de Configuracion para los Modulos';

--
-- Dumping data for table `config`
--

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE `grupo` (
  `ID_GRUPO` int(11) NOT NULL,
  `NOMBRE` varchar(50) collate utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(50) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`ID_GRUPO`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Agrupa los perfiles de los usuarios';

--
-- Dumping data for table `grupo`
--


/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
LOCK TABLES `grupo` WRITE;
INSERT INTO `grupo` VALUES (0,'Administradores','Administradores');
UNLOCK TABLES;
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;

--
-- Table structure for table `grupo_perfil`
--

DROP TABLE IF EXISTS `grupo_perfil`;
CREATE TABLE `grupo_perfil` (
  `ID_GRUPO` int(11) NOT NULL,
  `ID_PERFIL` int(11) NOT NULL,
  PRIMARY KEY  (`ID_GRUPO`,`ID_PERFIL`),
  KEY `ID_PERFIL` (`ID_PERFIL`),
  CONSTRAINT `grupo_perfil_ibfk_1` FOREIGN KEY (`ID_GRUPO`) REFERENCES `grupo` (`ID_GRUPO`),
  CONSTRAINT `grupo_perfil_ibfk_2` FOREIGN KEY (`ID_PERFIL`) REFERENCES `perfil` (`ID_PERFIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Grupo Perfil';

--
-- Dumping data for table `grupo_perfil`
--


/*!40000 ALTER TABLE `grupo_perfil` DISABLE KEYS */;
LOCK TABLES `grupo_perfil` WRITE;
INSERT INTO `grupo_perfil` VALUES (0,0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `grupo_perfil` ENABLE KEYS */;

--
-- Table structure for table `localizacion`
--

DROP TABLE IF EXISTS `localizacion`;
CREATE TABLE `localizacion` (
  `X` int(11) default NULL,
  `Y` int(11) default NULL,
  `ID_PANEL` int(11) NOT NULL default '0',
  `ID_MODULO` int(11) NOT NULL,
  PRIMARY KEY  (`ID_PANEL`,`ID_MODULO`),
  KEY `NDX_LOCALIZACION` (`ID_PANEL`,`ID_MODULO`),
  KEY `ID_MODULO` (`ID_MODULO`),
  CONSTRAINT `localizacion_ibfk_1` FOREIGN KEY (`ID_PANEL`) REFERENCES `panel` (`ID_PANEL`),
  CONSTRAINT `localizacion_ibfk_2` FOREIGN KEY (`ID_MODULO`) REFERENCES `modulo` (`ID_MODULO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Coordenadas personalizas';

--
-- Table structure for table `localizacion_modulo`
--

--
-- Table structure for table `mensajeria_noticia`
--

DROP TABLE IF EXISTS `mensajeria_noticia`;
CREATE TABLE `mensajeria_noticia` (
  `ID_MENSAJE` int(10) unsigned NOT NULL default '0',
  `TITULO` varchar(255) collate utf8_spanish_ci NOT NULL default '',
  `CUERPO` varchar(5000) collate utf8_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`ID_MENSAJE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `mensajeria_principal`
--

DROP TABLE IF EXISTS `mensajeria_principal`;
CREATE TABLE `mensajeria_principal` (
  `ID_MENSAJE` int(10) unsigned NOT NULL auto_increment,
  `ID_USUARIO` int(10) unsigned NOT NULL default '0',
  `TIPO` int(10) unsigned NOT NULL default '0',
  `FECHA` date NOT NULL default '0000-00-00',
  `HORA` time NOT NULL default '00:00:00',
  `ID_RUSUARIO` int(10) unsigned NOT NULL default '0',
  `LEIDO` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`ID_MENSAJE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `mensajeria_telefono`
--

DROP TABLE IF EXISTS `mensajeria_telefono`;
CREATE TABLE `mensajeria_telefono` (
  `ID_MENSAJE` int(10) unsigned NOT NULL default '0',
  `LLAMANTE` varchar(255) collate utf8_spanish_ci NOT NULL default '',
  `ASUNTO` varchar(2000) collate utf8_spanish_ci NOT NULL default '',
  `ACCION` varchar(350) collate utf8_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`ID_MENSAJE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `mensajeria_visita`
--

DROP TABLE IF EXISTS `mensajeria_visita`;
CREATE TABLE `mensajeria_visita` (
  `ID_MENSAJE` int(10) unsigned NOT NULL default '0',
  `VISITANTE` varchar(300) collate utf8_spanish_ci NOT NULL default '',
  `ASUNTO` varchar(4000) collate utf8_spanish_ci NOT NULL default '',
  `ACCION` varchar(255) collate utf8_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`ID_MENSAJE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `metodos`
--

DROP TABLE IF EXISTS `metodos`;
CREATE TABLE `metodos` (
  `ID_MODULO` int(11) NOT NULL,
  `NOMBRE_METODO` varchar(50) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`ID_MODULO`,`NOMBRE_METODO`),
  KEY `NDX_NOMBRE_METODOS` (`NOMBRE_METODO`),
  CONSTRAINT `metodos_ibfk_1` FOREIGN KEY (`ID_MODULO`) REFERENCES `modulo` (`ID_MODULO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Lista de Metodos sobre los que aplicar restricciones de acce';


--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
CREATE TABLE `modulo` (
  `ID_MODULO` int(11) NOT NULL,
  `NOMBRE` varchar(50) collate utf8_spanish_ci NOT NULL,
  `CLASS_MODULO` varchar(50) collate utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(50) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`ID_MODULO`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`),
  UNIQUE KEY `CLASS_MODULO` (`CLASS_MODULO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Modulos disponibles';

--
-- Dumping data for table `modulo`
--


/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
LOCK TABLES `modulo` WRITE;
INSERT INTO `modulo` VALUES (0,'TAU','TAU','Modulo fake para configuraciones globales'),(1,'HELP-DESK','HelpDesk','Acceso a la aplicaci\F3n de Help-Desk'),(2,'ANTIVIRUS OFFICESCAN','OfficeScan','Antivirus OfficeScan'),(4,'MIS PREFERENCIAS','MisPreferencias','Preferencias personales del usuario'),(11,'RELOJ','Reloj',NULL),(17,'INVENTARIO','Inventario2','Gesti\F3n de Inventario de Activos TIC del Dpto. de Inform\E1tica'),(18,'ALERTA','Alerta',NULL),(20,'NOTAS','Notas',NULL),(21,'CORREO CORPORATIVO','Email','Notificador de correo electronico'),(22,'CALENDARIO','Calendario2',NULL),(23,'TIRA COMICA ECOL','TiraEcol','Tira Comica de ECOL'),(24,'ADMINISTRADOR DE PANELES','Panel','Administrador de Paneles'),(25,'RSYNC','Rsync','Estadisticas de Sincronizacion Rsync'),(26,'AGENDA CORPORATIVA','OpenGroupware','Agenda Corporativa'),(27,'CONTROL REMOTO','ControlRemoto','Control Remoto por VNC'),(28,'SINCEP','Sincep','Inventario Centros Perifericos'),(30,'AMO - ON-LINE','RealWMI','Inventario en tiempo real'),(31,'W2000 INTEGRACION','W2000LDAP','Integracion con LDAP W2000'),(32,'MENSAJERIA','Mensajeria','Mensajeria interdepartamental'),(33,'GOOGLE','GoogleBar','Acceso a Google');
UNLOCK TABLES;
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;

--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE `notas` (
  `ID_NOTA` int(11) NOT NULL auto_increment,
  `ID_USUARIO` int(11) default NULL,
  `FECHA` date default NULL,
  `HORA` time default NULL,
  `TEXTO` varchar(256) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`ID_NOTA`),
  KEY `ID_USUARIO` (`ID_USUARIO`),
  CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Notas propias o cosas por hacer';


--
-- Table structure for table `panel`
--

DROP TABLE IF EXISTS `panel`;
CREATE TABLE `panel` (
  `ID_PANEL` int(11) NOT NULL auto_increment,
  `NOMBRE` varchar(50) collate utf8_spanish_ci NOT NULL,
  `ORDEN` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) collate utf8_spanish_ci default NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `AVATAR` varchar(95) collate utf8_spanish_ci NOT NULL default 'panel.png',
  PRIMARY KEY  (`ID_PANEL`),
  KEY `NDX_USUARIO` (`ID_USUARIO`),
  CONSTRAINT `panel_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Agrupa los modulos';


--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `ID_PERFIL` int(11) NOT NULL,
  `NOMBRE` varchar(50) collate utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`ID_PERFIL`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Da nombre a un perfil de acceso a los metodos de las modulos';

--
-- Dumping data for table `perfil`
--


/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
LOCK TABLES `perfil` WRITE;
INSERT INTO `perfil` VALUES (0,'Administracion','El grupo con este perfil puede acceder a todos los metodos de todas las clases');
UNLOCK TABLES;
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

--
-- Table structure for table `perfil_metodos`
--

DROP TABLE IF EXISTS `perfil_metodos`;
CREATE TABLE `perfil_metodos` (
  `ID_PERFIL` int(11) NOT NULL,
  `ID_MODULO` int(11) NOT NULL,
  `NOMBRE_METODO` varchar(50) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`ID_PERFIL`,`ID_MODULO`,`NOMBRE_METODO`),
  KEY `NDX_METODOS` (`ID_MODULO`,`NOMBRE_METODO`),
  KEY `NDX_NOMBRE_METODOS` (`NOMBRE_METODO`),
  CONSTRAINT `perfil_metodos_ibfk_1` FOREIGN KEY (`ID_PERFIL`) REFERENCES `perfil` (`ID_PERFIL`),
  CONSTRAINT `perfil_metodos_ibfk_2` FOREIGN KEY (`ID_MODULO`, `NOMBRE_METODO`) REFERENCES `metodos` (`ID_MODULO`, `NOMBRE_METODO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Perfil Metodos';

--
-- Dumping data for table `perfil_metodos`
--


/*!40000 ALTER TABLE `perfil_metodos` DISABLE KEYS */;
LOCK TABLES `perfil_metodos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `perfil_metodos` ENABLE KEYS */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `USUARIO_RED` varchar(14) collate utf8_spanish_ci NOT NULL,
  `NOMBRE` varchar(50) collate utf8_spanish_ci NOT NULL,
  `APELLIDOS` varchar(50) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`ID_USUARIO`),
  UNIQUE KEY `USUARIO_RED` (`USUARIO_RED`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Usuario con acceso al portal';



/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
LOCK TABLES `usuario` WRITE;
INSERT INTO `usuario` VALUES (0,'Administrador','Administrador','HU');
UNLOCK TABLES;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

--
-- Table structure for table `usuario_grupo`
--

DROP TABLE IF EXISTS `usuario_grupo`;
CREATE TABLE `usuario_grupo` (
  `ID_USUARIO` int(11) NOT NULL,
  `ID_GRUPO` int(11) NOT NULL,
  PRIMARY KEY  (`ID_USUARIO`,`ID_GRUPO`),
  KEY `NDX_USUARIO_GRUPO` (`ID_USUARIO`,`ID_GRUPO`),
  KEY `ID_GRUPO` (`ID_GRUPO`),
  CONSTRAINT `usuario_grupo_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`),
  CONSTRAINT `usuario_grupo_ibfk_2` FOREIGN KEY (`ID_GRUPO`) REFERENCES `grupo` (`ID_GRUPO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Usuario Grupo';



/*!40000 ALTER TABLE `usuario_grupo` ENABLE KEYS */;
create view `tau_test`.`localizacion_modulo`  as select `localizacion`.`ID_PANEL` AS `ID_PANEL`,`modulo`.`ID_MODULO` AS `ID_MODULO`,`modulo`.`NOMBRE` AS `NOMBRE`,`modulo`.`CLASS_MODULO` AS `CLASS_MODULO`,`modulo`.`DESCRIPCION` AS `DESCRIPCION`,`localizacion`.`X` AS `x`,`localizacion`.`Y` AS `y` from (`localizacion` join `modulo`) where (`localizacion`.`ID_MODULO` = `modulo`.`ID_MODULO`);

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;



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


use inventario_test;

--
-- Table structure for table `aplicacion`
--
DROP TABLE IF EXISTS `aplicacion`;
CREATE TABLE `aplicacion` (
  `id_Aplicacion` int(11) NOT NULL,
  `SDO` tinyint(1) default NULL,
  `Corporativa` tinyint(1) default NULL,
  `Autorizacion` tinyint(1) default NULL,
  `Subtipo` varchar(50) collate utf8_spanish_ci default NULL,
  `Ruta_Manuales` varchar(255) collate utf8_spanish_ci default NULL,
  `Fecha_Explotacion` date default NULL,
  `Licencias` int(11) default NULL,
  PRIMARY KEY  (`id_Aplicacion`),
  CONSTRAINT `FK_aplicacion_1` FOREIGN KEY (`id_Aplicacion`) REFERENCES `recurso` (`id_Recurso`) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad Aplicacion';


CREATE TABLE `tipoequipo` (
  `id_Tipoequipo` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(50) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_Tipoequipo`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
--
-- Table structure for table `aplicacion_ip`
--

DROP TABLE IF EXISTS `aplicacion_ip`;
CREATE TABLE `aplicacion_ip` (
  `id_IP` int(11) NOT NULL,
  `id_Aplicacion` int(11) NOT NULL,
  PRIMARY KEY(`id_IP`,`id_Aplicacion`),
  KEY `NDX_IP` (`id_IP`),
  KEY `NDX_APLICACION` (`id_Aplicacion`),
  CONSTRAINT `aplicacion_ip_ibfk_1` FOREIGN KEY (`id_IP`) REFERENCES `ip` (`id_IP`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aplicacion_ip_ibfk_2` FOREIGN KEY (`id_Aplicacion`) REFERENCES `aplicacion` (`id_Aplicacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Aplicacion e IP asociada';

--
-- Table structure for table `averias`
--

DROP TABLE IF EXISTS `averias`;
CREATE TABLE `averias` (
  `id_Averia` int(11) NOT NULL auto_increment,
  `id_equipo` int(11)  NOT NULL,
  `id_empresa` int(11)  NOT NULL,
  `Tramitador` varchar(50) collate utf8_spanish_ci default NULL,
  `NAveria` varchar(50) collate utf8_spanish_ci default NULL,
  `Fecha_Aviso` date  NOT NULL,
  `Fecha_Arreglo` date default NULL,
  `Diagnostico` varchar(1024) collate utf8_spanish_ci default NULL,
  `Resolucion` varchar(1024) collate utf8_spanish_ci default NULL,
  `Coste` varchar(50) collate utf8_spanish_ci default NULL,
  `Observaciones` varchar(1024) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id_Averia`),
  KEY `id_Equipo` (`id_equipo`),
  KEY `id_Empresa` (`id_empresa`),
  CONSTRAINT `averias_ibfk_1` FOREIGN KEY (`id_Equipo`) REFERENCES `equipo` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `averias_ibfk_2` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`id_Empresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Lista de Averias del Equipo';

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo` (
  `id_Cargo` int(11) NOT NULL auto_increment,
  `Nombre` varchar(50) collate utf8_spanish_ci NOT NULL,
  `Orden` int(11) default NULL,
  PRIMARY KEY  (`id_Cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad Cargos';

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `id_Empresa` int(11) NOT NULL auto_increment,
  `Nombre` varchar(50) collate utf8_spanish_ci default NULL,
  `Direccion` varchar(80) collate utf8_spanish_ci default NULL,
  `EMail` varchar(50) collate utf8_spanish_ci default NULL,
  `PersonaContacto` varchar(50) collate utf8_spanish_ci default NULL,
  `Telefono` varchar(50) collate utf8_spanish_ci default NULL,
  `Fax` varchar(50) collate utf8_spanish_ci default NULL,
  `NumeroCliente` varchar(50) collate utf8_spanish_ci default NULL,
  `Es_Crija` tinyint(1) default NULL,
  `Observaciones` varchar(1000) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id_Empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad Empresa';

--
-- Table structure for table `equipo`
--

DROP TABLE IF EXISTS `equipo`;
CREATE TABLE `equipo` (
 `id_Equipo` int(11) NOT NULL auto_increment,
  `N_Serie` varchar(50) collate utf8_spanish_ci NOT NULL,
  `Marca` int(11) default NULL,
  `Modelo` int(11) default NULL,
  `Nombre` varchar(50) collate utf8_spanish_ci default NULL,
  `id_tipoequipo` int(11) default NULL,
  `Puerto` varchar(50) collate utf8_spanish_ci default NULL,
  `Fecha_Alta` date default NULL,
  `Fecha_Baja` date default NULL,
  `Fecha_Fin_Garantia` date default NULL,
  `Propietario` int(11) default NULL,
  `id_roseta` int(11) default NULL,
  `id_empresa_suministradora` int(11) default NULL,
  `id_empresa_arregla` int(11) default NULL,
  `id_equipo_conectado` int(11) default NULL,
  `Observaciones` varchar(2000) collate utf8_spanish_ci default NULL,
  `Inventario` varchar(80) collate utf8_spanish_ci default NULL,
  `Expediente` varchar(80) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id_Equipo`),
  KEY `FK_equipo_1` (`id_roseta`),
  KEY `FK_equipo_2` (`Marca`),
  KEY `Index_4` (`Modelo`),
  KEY `Index_5` (`id_tipoequipo`),
  KEY `FK_equipo_5` (`Propietario`),
  KEY `FK_equipo_6` (`id_empresa_suministradora`),
  KEY `FK_equipo_7` (`id_empresa_arregla`),
  KEY `FK_equipo_8` (`id_equipo_conectado`),
  CONSTRAINT `FK_equipo_8` FOREIGN KEY (`id_equipo_conectado`) REFERENCES `equipo` (`id_Equipo`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo_1` FOREIGN KEY (`id_roseta`) REFERENCES `roseta` (`id_Roseta`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo_2` FOREIGN KEY (`Marca`) REFERENCES `marca` (`id_Marca`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo_3` FOREIGN KEY (`Modelo`) REFERENCES `modelo` (`id_Modelo`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo_4` FOREIGN KEY (`id_tipoequipo`) REFERENCES `tipoequipo` (`id_Tipoequipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo_5` FOREIGN KEY (`Propietario`) REFERENCES `propietario` (`id_Propietario`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo_6` FOREIGN KEY (`id_empresa_suministradora`) REFERENCES `empresa` (`id_Empresa`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo_7` FOREIGN KEY (`id_empresa_arregla`) REFERENCES `empresa` (`id_Empresa`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad Equipo';

--
-- Table structure for table `extension`
--

DROP TABLE IF EXISTS `extension`;
CREATE TABLE `extension` (
  `id_Extension` int(11) NOT NULL auto_increment,
  `Numero` varchar(9) collate utf8_spanish_ci NOT NULL,
  `Armario` varchar(20) collate utf8_spanish_ci default NULL,
  `AD` varchar(10) collate utf8_spanish_ci default NULL,
  `Grupo_Captura` smallint(6) default NULL,
  `Categoria` int(11) default NULL,
  PRIMARY KEY  (`id_Extension`),
  UNIQUE KEY `Numero` (`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad Extension';

--
-- Table structure for table `impresora`
--

DROP TABLE IF EXISTS `impresora`;
CREATE TABLE `impresora` (
 `id_impresora` int(11) NOT NULL,
  `Conexion` int(11) default NULL,
  `Subtipo` int(11) default NULL,
  `Formatos` int(11) default NULL,
  `Impresion` int(11) default NULL,
  PRIMARY KEY  (`id_impresora`),
  KEY `FK_impresora_2` (`Conexion`),
  KEY `FK_impresora_3` (`Formatos`),
  KEY `FK_impresora_4` (`Impresion`),
  CONSTRAINT `FK_impresora_4` FOREIGN KEY (`Impresion`) REFERENCES `impresionimpresora` (`id_ImpresionImpresora`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_impresora_2` FOREIGN KEY (`Conexion`) REFERENCES `conexionimpresora` (`id_ConexionImpresora`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_impresora_3` FOREIGN KEY (`Formatos`) REFERENCES `formatoimpresora` (`id_FormatoImpresora`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `impresora_ibfk_1` FOREIGN KEY (`id_impresora`) REFERENCES `equipo` (`id_Equipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Equipo Impresora';

--
-- Table structure for table `ip`
--

DROP TABLE IF EXISTS `ip`;
CREATE TABLE `ip` (
`id_IP` int(11) NOT NULL auto_increment,
  `ip_A` smallint(6) NOT NULL,
  `ip_B` smallint(6) NOT NULL,
  `ip_C` smallint(6) NOT NULL,
  `ip_D` smallint(6) NOT NULL,
  `id_Equipo` int(11) default NULL,
  `id_Subred` int(11) default NULL,
  PRIMARY KEY  (`id_IP`),
  UNIQUE KEY `ip_A` (`ip_A`,`ip_B`,`ip_C`,`ip_D`),
  KEY `FK_ip_1` (`id_Equipo`),
  KEY `FK_ip_2` (`id_Subred`),
  CONSTRAINT `FK_ip_2` FOREIGN KEY (`id_Subred`) REFERENCES `subred` (`id_Subred`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_ip_1` FOREIGN KEY (`id_Equipo`) REFERENCES `equipo` (`id_Equipo`) ON DELETE SET NULL ON UPDATE CASCADE
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad IP';

--
-- Table structure for table `ip_subred`
--

DROP TABLE IF EXISTS `ip_subred`;

--
-- Table structure for table `jetdirect`
--

DROP TABLE IF EXISTS `jetdirect`;
CREATE TABLE `jetdirect` (
  `id_jetdirect` int(11) NOT NULL,
  `gestionable` tinyint(1) default NULL,
  `npuertos` int(11) default NULL,
  `velocidad` int(11) default NULL,
  PRIMARY KEY  (`id_jetdirect`),
  CONSTRAINT `FK_jetdirect_1` FOREIGN KEY (`id_jetdirect`) REFERENCES `equipo` (`id_Equipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Equipo Switch';

--
-- Table structure for table `monitor`
--

DROP TABLE IF EXISTS `monitor`;
CREATE TABLE `monitor` (
  `id_monitor` int(11) NOT NULL,
  `Pulgadas` varchar(50) collate utf8_spanish_ci default NULL,
  `TFT` tinyint(1) default NULL,
  PRIMARY KEY  (`id_monitor`),
  CONSTRAINT `monitor_ibfk_1` FOREIGN KEY (`id_monitor`) REFERENCES `equipo` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Equipo Monitor';


--
-- Table structure for table `inalambrica`
--

DROP TABLE IF EXISTS `inalambrica`;
CREATE TABLE `inalambrica` (
  `id_inalambrica` int(11) NOT NULL,
  `SubTipo` varchar(50) collate utf8_spanish_ci default NULL,
  `MAC` varchar(50) collate utf8_spanish_ci default NULL,
  `SSID` varchar(50) collate utf8_spanish_ci default NULL,
  `Velocidad` varchar(50) collate utf8_spanish_ci default NULL,
  `WEP` tinyint(1) default NULL,
  PRIMARY KEY  (`id_inalambrica`),
  CONSTRAINT `inalambrica_ibfk_1` FOREIGN KEY (`id_inalambrica`) REFERENCES `equipo` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Equipo Inalambrica';

--
-- Table structure for table `pc`
--

DROP TABLE IF EXISTS `pc`;
CREATE TABLE `pc` (
 `id_pc` int(11) NOT NULL,
  `Procesador` int(11) default NULL,
  `Hz` int(11) default NULL,
  `RAM` int(11) default NULL,
  `HD` varchar(10) collate utf8_spanish_ci default NULL,
  `SO` int(11) default NULL,
  PRIMARY KEY  (`id_pc`),
  KEY `FK_pc_2` (`Procesador`),
  KEY `FK_pc_3` (`SO`),
  CONSTRAINT `FK_pc_3` FOREIGN KEY (`SO`) REFERENCES `sistemaoperativo` (`id_Sistemaoperativo`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_pc_2` FOREIGN KEY (`Procesador`) REFERENCES `procesador` (`id_Procesador`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pc_ibfk_1` FOREIGN KEY (`id_pc`) REFERENCES `equipo` (`id_Equipo`) ON DELETE CASCADE ON UPDATE CASCADE
 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Equipo PC';


--
-- Table structure for table `portatil`
--

DROP TABLE IF EXISTS `portatil`;
CREATE TABLE `portatil` (
  `id_portatil` int(11) NOT NULL,
  `Procesador` int(11) default NULL,
  `Hz` int(11) default NULL,
  `RAM` int(11) default NULL,
  `HD` varchar(10) collate utf8_spanish_ci default NULL,
  `SO` int(11) default NULL,
  PRIMARY KEY  (`id_portatil`),
  CONSTRAINT `portatil_ibfk_1` FOREIGN KEY (`id_portatil`) REFERENCES `equipo` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Equipo PORTATIL';

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id_Perfil` int(11) NOT NULL auto_increment,
   `Modo` varchar(100) collate utf8_spanish_ci default NULL,
  `Descripcion` varchar(2000) collate utf8_spanish_ci default NULL,
  `Grupo_Red` varchar(100) collate utf8_spanish_ci default NULL,
  `id_Recurso` int(11) default NULL,
  `numero_licencias` int(11) default NULL,
  PRIMARY KEY  (`id_Perfil`),
  KEY `NDX_RECURSO` (`id_Recurso`),
  CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`id_Recurso`) REFERENCES `recurso` (`id_Recurso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad Perfil';

--
-- Table structure for table `portapapeles`
--

DROP TABLE IF EXISTS `portapapeles`;
CREATE TABLE `portapapeles` (
  `id` int(11) NOT NULL,
  `Tipo` varchar(50) collate utf8_spanish_ci NOT NULL,
  `id_dst` int(11) default NULL,
  `Tipo_dst` varchar(50) collate utf8_spanish_ci default NULL,
  `id_usr_tau` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla temporal para intercambio de objetos';

--
-- Table structure for table `puesto`
--

DROP TABLE IF EXISTS `puesto`;
CREATE TABLE `puesto` (
  `id_Puesto` int(11) NOT NULL auto_increment,
  `Nombre` varchar(50) collate utf8_spanish_ci default NULL,
  `Descripcion` varchar(1000) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id_Puesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Puestos logicos y fisicos';

--
-- Table structure for table `puesto_equipo`
--

DROP TABLE IF EXISTS `puesto_equipo`;
CREATE TABLE `puesto_equipo` (
  `id_puesto` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `Fecha` datetime default NULL,
  PRIMARY KEY  (`id_puesto`,`id_equipo`),
  KEY `id_equipo` (`id_equipo`),
  CONSTRAINT `puesto_equipo_ibfk_1` FOREIGN KEY (`id_puesto`) REFERENCES `puesto` (`id_puesto`),
  CONSTRAINT `puesto_equipo_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Puesto y Equipos que contiene';

--
-- Table structure for table `puesto_puesto`
--

DROP TABLE IF EXISTS `puesto_puesto`;
CREATE TABLE `puesto_puesto` (
  `ID_PUESTO_1` int(11) NOT NULL,
  `ID_PUESTO_CONTIENE` int(11) NOT NULL,
  PRIMARY KEY  (`ID_PUESTO_1`,`ID_PUESTO_CONTIENE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Puesto y Puestos que contiene';

--
-- Table structure for table `puesto_roseta`
--

DROP TABLE IF EXISTS `puesto_roseta`;
CREATE TABLE `puesto_roseta` (
  `id_puesto` int(11) NOT NULL,
  `id_roseta` int(11) NOT NULL,
  PRIMARY KEY  (`id_puesto`,`id_roseta`),
  KEY `id_roseta` (`id_roseta`),
  CONSTRAINT `puesto_roseta_ibfk_1` FOREIGN KEY (`id_puesto`) REFERENCES `puesto` (`id_puesto`),
  CONSTRAINT `puesto_roseta_ibfk_2` FOREIGN KEY (`id_roseta`) REFERENCES `roseta` (`id_roseta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Puesto y Rosetas que contiene';

--
-- Table structure for table `puesto_usuario`
--

DROP TABLE IF EXISTS `puesto_usuario`;
CREATE TABLE `puesto_usuario` (
  `id_puesto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY  (`id_puesto`,`id_usuario`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `puesto_usuario_ibfk_1` FOREIGN KEY (`id_puesto`) REFERENCES `puesto` (`id_puesto`),
  CONSTRAINT `puesto_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Puesto y Usuarios que contiene';

--
-- Table structure for table `recurso`
--

DROP TABLE IF EXISTS `recurso`;
CREATE TABLE `recurso` (
  `id_Recurso` int(11) NOT NULL auto_increment,
  `Nombre` varchar(50) collate utf8_spanish_ci NOT NULL,
  `Descripcion` varchar(2000) collate utf8_spanish_ci default NULL,
  `Ruta` varchar(255) collate utf8_spanish_ci default NULL,
  `Tipo` varchar(50) collate utf8_spanish_ci default NULL,
  `Ambito` varchar(50) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id_Recurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad Recurso';

-- PENDIENTE: Tabla TipoRecurso

--
-- Table structure for table `roseta`
--

DROP TABLE IF EXISTS `roseta`;
CREATE TABLE `roseta` (
  `id_Roseta` int(11) NOT NULL auto_increment,
  `Nombre` varchar(50) collate utf8_spanish_ci NOT NULL,
  `id_Extension` int(11) default NULL,
  `Despacho` varchar(50) collate utf8_spanish_ci default NULL,
  `Tipo` varchar(7) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id_Roseta`),
  UNIQUE KEY `Nombre` (`Nombre`),
  KEY `NDX_EXTENSION` (`id_Extension`),
  CONSTRAINT `roseta_ibfk_1` FOREIGN KEY (`id_extension`) REFERENCES `extension` (`Id_Extension`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad Roseta';

--
-- Table structure for table `subred`
--

DROP TABLE IF EXISTS `subred`;
CREATE TABLE `subred` (
  `id_Subred` int(11) NOT NULL auto_increment,
  `Nombre` varchar(50) collate utf8_spanish_ci default NULL,
  `Mascara` varchar(15) collate utf8_spanish_ci default NULL,
  `Puerta_Enlace` varchar(15) collate utf8_spanish_ci default NULL,
  `DNS` varchar(35) collate utf8_spanish_ci default NULL,
  `Observaciones` varchar(255) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id_Subred`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad Debil de IP';

--
-- Table structure for table `switch`
--

DROP TABLE IF EXISTS `switch`;
CREATE TABLE `switch` (
`id_switch` int(11) NOT NULL,
  `gestionable` tinyint(1) default NULL,
  `npuertos` int(11) default NULL,
  `velocidad` int(11) default NULL,
  PRIMARY KEY  (`id_switch`),
  CONSTRAINT `FK_switch_1` FOREIGN KEY (`id_switch`) REFERENCES `equipo` (`id_Equipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Equipo Switch';

--
-- Table structure for table `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE `tipousuario` (
  `id_Tipousuario` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(50) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_Tipousuario`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca` (
  `id_Marca` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(80) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_Marca`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_marca`
--

DROP TABLE IF EXISTS `tr_marca`;
CREATE TABLE `tr_marca` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `propietario`
--

DROP TABLE IF EXISTS `propietario`;
CREATE TABLE `propietario` (
  `id_Propietario` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(80) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_Propietario`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_propietario`
--

DROP TABLE IF EXISTS `tr_propietario`;
CREATE TABLE `tr_propietario` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `modelo`
--

DROP TABLE IF EXISTS `modelo`;
CREATE TABLE `modelo` (
  `id_Modelo` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(80) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_Modelo`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_modelo`
--

DROP TABLE IF EXISTS `tr_modelo`;
CREATE TABLE `tr_modelo` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `procesador`
--

DROP TABLE IF EXISTS `procesador`;
CREATE TABLE `procesador` (
  `id_Procesador` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(80) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_Procesador`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_procesador`
--

DROP TABLE IF EXISTS `tr_procesador`;
CREATE TABLE `tr_procesador` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `sistemaoperativo`
--

DROP TABLE IF EXISTS `SistemaOperativo`;
CREATE TABLE `SistemaOperativo` (
  `id_Sistemaoperativo` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(80) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_Sistemaoperativo`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_sistemaoperativo`
--

DROP TABLE IF EXISTS `tr_SistemaOperativo`;
CREATE TABLE `tr_SistemaOperativo` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



--
-- Table structure for table `ConexionImpresora`
--

DROP TABLE IF EXISTS `ConexionImpresora`;
CREATE TABLE `ConexionImpresora` (
  `id_ConexionImpresora` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(80) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_ConexionImpresora`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_ConexionImpresora`
--

DROP TABLE IF EXISTS `tr_ConexionImpresora`;
CREATE TABLE `tr_ConexionImpresora` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `SubtipoImpresora`
--

DROP TABLE IF EXISTS `SubtipoImpresora`;
CREATE TABLE `SubtipoImpresora` (
  `id_SubtipoImpresora` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(80) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_SubtipoImpresora`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_SubtipoImpresora`
--

DROP TABLE IF EXISTS `tr_SubtipoImpresora`;
CREATE TABLE `tr_SubtipoImpresora` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `FormatoImpresora`
--

DROP TABLE IF EXISTS `FormatoImpresora`;
CREATE TABLE `FormatoImpresora` (
  `id_FormatoImpresora` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(80) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_FormatoImpresora`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_FormatoImpresora`
--

DROP TABLE IF EXISTS `tr_FormatoImpresora`;
CREATE TABLE `tr_FormatoImpresora` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `FormatoImpresora`
--

DROP TABLE IF EXISTS `ImpresionImpresora`;
CREATE TABLE `ImpresionImpresora` (
  `id_ImpresionImpresora` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(80) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_ImpresionImpresora`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_ImpresionImpresora`
--

DROP TABLE IF EXISTS `tr_ImpresionImpresora`;
CREATE TABLE `tr_ImpresionImpresora` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_cargo`
--

DROP TABLE IF EXISTS `tr_cargo`;
CREATE TABLE `tr_cargo` (
  `new_id` int(11) NOT NULL,
  `old_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `tr_tipousuario`
--

DROP TABLE IF EXISTS `tr_tipousuario`;
CREATE TABLE `tr_tipousuario` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_equipo`
--

DROP TABLE IF EXISTS `tr_equipo`;
CREATE TABLE `tr_equipo` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(50) collate utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `tr_extension`
--

DROP TABLE IF EXISTS `tr_extension`;
CREATE TABLE `tr_extension` (
  `new_id` int(11) NOT NULL,
  `old_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_subred`
--

DROP TABLE IF EXISTS `tr_subred`;
CREATE TABLE `tr_subred` (
  `new_id` int(11) NOT NULL,
  `old_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `tr_ip`
--

DROP TABLE IF EXISTS `tr_ip`;
CREATE TABLE `tr_ip` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(50) collate utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `tr_perfil`
--

DROP TABLE IF EXISTS `tr_perfil`;
CREATE TABLE `tr_perfil` (
  `new_id` int(11) NOT NULL,
  `old_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `tr_puesto`
--

DROP TABLE IF EXISTS `tr_puesto`;
CREATE TABLE `tr_puesto` (
  `new_id` int(11) NOT NULL,
  `old_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `tr_recurso`
--

DROP TABLE IF EXISTS `tr_recurso`;
CREATE TABLE `tr_recurso` (
  `new_id` int(11) NOT NULL,
  `old_id` int(50) collate utf8_spanish_ci NOT NULL,
  `tipo` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `tr_roseta`
--

DROP TABLE IF EXISTS `tr_roseta`;
CREATE TABLE `tr_roseta` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(50) collate utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `tr_unidad`
--

DROP TABLE IF EXISTS `tr_unidad`;
CREATE TABLE `tr_unidad` (
  `new_id` int(11) NOT NULL,
  `old_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `tr_usuario`
--

DROP TABLE IF EXISTS `tr_usuario`;
CREATE TABLE `tr_usuario` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Table structure for table `tr_tipoequipo`
--

DROP TABLE IF EXISTS `tr_tipoequipo`;
CREATE TABLE `tr_tipoequipo` (
  `new_id` int(11) NOT NULL,
  `old_id` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `tr_empresa`
--

DROP TABLE IF EXISTS `tr_empresa`;
CREATE TABLE `tr_empresa` (
  `new_id` int(11) NOT NULL,
  `old_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Table structure for table `unidad`
--

DROP TABLE IF EXISTS `unidad`;
CREATE TABLE `unidad` (
  `id_Unidad` int(11) NOT NULL auto_increment,
  `Nombre` varchar(255) collate utf8_spanish_ci NOT NULL,
  `id_Unidad_Padre` int(11) default NULL,
  `Orden` int(11) default NULL,
  PRIMARY KEY  (`id_Unidad`),
  KEY `NDX_UNIDAD` (`id_Unidad_Padre`),
  CONSTRAINT `unidad_ibfk_1` FOREIGN KEY (`id_Unidad_Padre`) REFERENCES `unidad` (`id_Unidad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Tabla de Unidades en la Organizacion';

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE  `usuario` (
  `id_Usuario` int(11) NOT NULL auto_increment,
  `DNI` varchar(9) collate utf8_spanish_ci NOT NULL,
  `Nombre` varchar(45) collate utf8_spanish_ci default NULL,
  `Apellidos` varchar(95) collate utf8_spanish_ci default NULL,
  `Usuario_Red` varchar(45) collate utf8_spanish_ci default NULL,
  `Email` varchar(95) collate utf8_spanish_ci default NULL,
  `Templeado` int(10) default NULL,
  `id_foto` int(11) default NULL,
  `Observaciones` varchar(5000) collate utf8_spanish_ci default NULL,
  `Unidad` int(10) default NULL,
  `id_Cargo` int(11) default NULL,
  `Infcontacto` varchar(5000) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id_Usuario`),
  KEY `Index_2` (`Templeado`),
  KEY `FK_usuario_2` (`id_Cargo`),
  KEY `Index_4` (`Unidad`),
  CONSTRAINT `FK_usuario_3` FOREIGN KEY (`Unidad`) REFERENCES `unidad` (`id_Unidad`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_usuario_1` FOREIGN KEY (`Templeado`) REFERENCES `tipousuario` (`id_Tipousuario`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_usuario_2` FOREIGN KEY (`id_Cargo`) REFERENCES `cargo` (`id_Cargo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla de Usuarios';

--
-- Table structure for table `imagen`
--
DROP TABLE IF EXISTS `imagen`;
CREATE TABLE `imagen` (
  `id_Imagen` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` LONGBLOB NULL ,
  `mime` VARCHAR(100) NULL ,
  `descripcion` VARCHAR(500) NULL,
  `tipo` VARCHAR(50) NULL,
  PRIMARY KEY(`id_Imagen`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla de Imagenes: Fotos, Planos y de Equipos';

--
-- Table structure for table `usuario_perfil`
--
DROP TABLE IF EXISTS `usuario_perfil`;
CREATE TABLE `usuario_perfil` (
  `id_Perfil` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `fecha` date default NULL,
  `id_help_desk` int(11) default NULL,
  PRIMARY KEY  (`id_Perfil`,`id_Usuario`),
  KEY `NDX_USUARIO` (`id_Usuario`),
  CONSTRAINT `usuario_perfil_ibfk_1` FOREIGN KEY (`id_Perfil`) REFERENCES `perfil` (`id_Perfil`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuario_perfil_ibfk_2` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Perfil de Usuario';

-- 
-- Estructura de tabla para la tabla `portapapeles`
-- 

DROP TABLE IF EXISTS `portapapeles`;
CREATE TABLE IF NOT EXISTS `portapapeles` (
  `id_PP` int(11) NOT NULL auto_increment,
  `id_obj` int(11) NOT NULL,
  `Tipo_obj` varchar(50) collate utf8_spanish_ci NOT NULL,
  `id_org` int(11) default NULL,
  `Tipo_org` varchar(50) collate utf8_spanish_ci default NULL,
  `id_usr_tau` int(11) default NULL,
  PRIMARY KEY  (`id_PP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla temporal para intercambio de objetos' AUTO_INCREMENT=1 ;

-- 
-- Estructura de tabla para la tabla `Localizacion`
-- NOTA: Las coord x,y estan en la relacion objeto_localizacion
-- 

CREATE TABLE `localizacion` (
  `id_Localizacion` int(11) NOT NULL AUTO_INCREMENT,
  `Ubicacion` VARCHAR(45) DEFAULT NULL,
  `Descripcion` VARCHAR(45) DEFAULT NULL,
  `z_id_plano` int(11) DEFAULT NULL COMMENT 'Coord Z',
  PRIMARY KEY(`id_Localizacion`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT = 'Localizacion en Planos';

-- 
-- Estructura de la relacion entre Puesto y Roseta con la tabla `Localizacion`
-- NOTA: Las coord z estan en Localizacion
-- 

CREATE TABLE `objeto_localizacion` (
`id_localizacion` int(10) unsigned NOT NULL,
`id_obj` int(10) unsigned NOT NULL,
`Tipo_obj` varchar(45) NOT NULL ,
`x` int(10) unsigned NOT NULL default '0',
`y` int(10) unsigned NOT NULL default '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Objetos Localizados';

-- 
-- Tabla de Registro de Operaciones sobre el Inventario
-- NOTA: Normalmente anotamos las sentencias DML de SQL
-- 

CREATE TABLE `InventarioLog` (
  `id_log` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usr_tau` INTEGER NOT NULL DEFAULT 0,
  `fecha` TIMESTAMP ,
  `accion` LONGTEXT ,
  PRIMARY KEY(`id_log`)
)
ENGINE = InnoDB CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT = 'Vitacora del Inventario';



-- INSERCION DE ALGUNOS DATOS INICIALES

INSERT INTO `tipoequipo` ( Descripcion ) VALUES ( 'PC' );
INSERT INTO `tipoequipo` ( Descripcion ) VALUES ( 'IMPRESORA' );
INSERT INTO `tipoequipo` ( Descripcion ) VALUES ( 'MONITOR' );
INSERT INTO `tipoequipo` ( Descripcion ) VALUES ( 'SWITCH' );
INSERT INTO `tipoequipo` ( Descripcion ) VALUES ( 'JETDIRECT' );
INSERT INTO `tipoequipo` ( Descripcion ) VALUES ( 'INALAMBRICA' );
INSERT INTO `tipoequipo` ( Descripcion ) VALUES ( 'PUNTO ACCESO' );
INSERT INTO `tipoequipo` ( Descripcion ) VALUES ( 'PORTATIL' );
INSERT INTO `tipoequipo` ( Descripcion ) VALUES ( 'SCANER' );
INSERT INTO `tipoequipo` ( Descripcion ) VALUES ( 'SAI' );
INSERT INTO `tipoequipo` ( Descripcion ) VALUES ( 'PDA' );

-- Propuesta de valores: USAR SOLO SI EMPIEZAS DESDE CERO Y NO VAS A HACER UN RESTORE DEL INVENTARIO
-- INSERT INTO `ConexionImpresora` (`id_ConexionImpresora`, `Descripcion`) VALUES
-- (1, 'RED'),
-- (2, 'PARALELO'),
-- (3, 'USB'),
-- (4, 'JETDIRECT/AXIS')
-- ;
-- 
-- INSERT INTO `FormatoImpresora` (`id_FormatoImpresora`, `Descripcion`) VALUES
-- (1, 'A4'),
-- (2, 'A3'),
-- (3, 'A2'),
-- (4, 'A1')
-- ;
-- 
-- INSERT INTO `ImpresionImpresora` (`id_ImpresionImpresora`, `Descripcion`) VALUES
-- (1, 'B/N'),
-- (2, 'COLOR')
-- ;
-- 
-- INSERT INTO `SubtipoImpresora` (`id_SubtipoImpresora`, `Descripcion`) VALUES
-- (1, 'LASER'),
-- (2, 'INYECCION'),
-- (3, 'MATRICIAL')
-- ;
-- 
-- INSERT INTO `tipousuario` (`id_Tipousuario`, `Descripcion`) VALUES
-- (1, 'FUNCIONARIO'),
-- (2, 'LABORAL'),
-- (3, 'INTERINO'),
-- (4, 'EXTERNO')
-- ;
-- 
-- INSERT INTO `cargo` VALUES
-- (1,'PROGRAMADOR',NULL),
-- (2,'JEFE DE DEPARTAMENTO',NULL),
-- (3,'ASESOR DE MICROINFORMATICA',NULL),
-- (4,'UNIDAD DE PRODUCCI\D3N',NULL),
-- (5,'DELEGADO PROVINCIAL',NULL),
-- (6,'ASESOR/A DELEGADO',NULL),
-- (7,'SECRETARIA DELEGADO',NULL),
-- (8,'JEFE DE SECCION',NULL),
-- (9,'SEGUIMIENTO SALUD LABORAL',NULL),
-- (10,'DIRECTOR',NULL),
-- (11,'AUXILIAR ADMINISTRATIVO',NULL),(
-- 12,'SECRETARIO/A DIRECCION',NULL),
-- (13,'JEFE DE NEGOCIADO',NULL),
-- (14,'SECRETARIO GENERAL DP',NULL),
-- (15,'ORDENANZA',NULL),
-- (16,'AUXILIAR RECEPCION REGISTRO',NULL),
-- (17,'NEGOCIADO DE INFORMACION Y REGISTRO',NULL),
-- (18,'TITULADO SUPERIOR',NULL),
-- (19,'ASESOR TECNICO',NULL),
-- (20,'JEFE/A DE SERVICIO',NULL),
-- (21,'COORDINADOR SERCLA',NULL),
-- (22,'SECRETARIO/A PROVINCIAL SAE',NULL),
-- (23,'TECNICO PREVENCION',NULL),
-- (24,'JEFE DE AREA',NULL),
-- (25,'TECNICO COORDINADOR',NULL),
-- (26,'MEDICO',NULL),
-- (27,'UNIDAD DE FORMACION',NULL),
-- (28,'TECNICO EMPLEO',NULL),
-- (29,'ADMINISTRATIVO',NULL),
-- (30,'DOCENTE',NULL),
-- (31,'AUXILIAR DE CLINICA',NULL),
-- (32,'ANALISTA DE LABORATORIO',NULL),
-- (33,'TITULADO DE GRADO MEDIO',NULL),
-- (34,'ALUMNO EN PRACTICAS',NULL),
-- (35,'COORDINADOR FORMACI\D3N',NULL),
-- (36,'UNIDAD DE GESTION',NULL),
-- (37,'DUE',NULL),
-- (38,'UNIDAD DE TRAMITACION',NULL),
-- (39,'DELEGADA PROVINCIAL',NULL),
-- (40,'PERSONAL EN PRACTICAS',NULL),
-- (41,'EX-DELEGADA PROVINCIAL',NULL),
-- (42,'COORDINADOR',NULL),
-- (43,'VIGILANTE',NULL),
-- (44,'TELEFONISTA',NULL),
-- (45,'NEGOCIADO DE TRAMITACION',NULL),
-- (46,'JEFA DE NEGOCIADO',NULL)
-- ;


-- ,
--  KEY `NDX_LOCALIZACION` (`z_id_plano`),
--  CONSTRAINT `FK_Localizacion_1` FOREIGN KEY `FK_Localizacion_1` (`z_id_plano`) REFERENCES `imagen` (`id_Imagen`) ON DELETE CASCADE ON UPDATE CASCADE

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


