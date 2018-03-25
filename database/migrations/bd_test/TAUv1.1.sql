--
-- Modificaciones a TAU
--

use tau_test

--
-- Table structure for table `inventario2_metodos`
--

DROP TABLE IF EXISTS `tau_test`.`inventario2_metodos`;
CREATE TABLE `tau_test`.`inventario2_metodos` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `SUBCLASS` VARCHAR(45) NOT NULL DEFAULT '',
  `SUBMETODO` VARCHAR(45) NOT NULL DEFAULT '',
  `VISTA` VARCHAR(45) DEFAULT '',
  PRIMARY KEY(`id`)
)
ENGINE = InnoDB
COMMENT = 'Lista de Subclases y Metodos de acceso';


--
-- Modificaciones a Inventario2
--

use inventario_test

-- 
-- Tabla de Grupos de gestion de perfiles e recurso
-- 

--
-- Table structure for table `grupogestion`
--

DROP TABLE IF EXISTS `grupogestion`;
CREATE TABLE `grupogestion` (
  `id_grupogestion` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(2000) collate utf8_spanish_ci NOT NULL,
  `descripcion` varchar(5000) collate utf8_spanish_ci default '',
  PRIMARY KEY  (`id_grupogestion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Grupo de gestion de recursos';

DROP TABLE IF EXISTS `grupogestion_usuario`;
CREATE TABLE `grupogestion_usuario` (
  `id_usuario` int(11) NOT NULL default '0',
  `id_grupogestion` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id_usuario`,`id_grupogestion`),
  KEY `FK_grupogestion_usuario_2` (`id_grupogestion`),
  CONSTRAINT `FK_grupogestion_usuario_2` FOREIGN KEY (`id_grupogestion`) REFERENCES `grupogestion` (`id_grupogestion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_grupogestion_usuario_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Membresia de usuarios a grupos de gestion; InnoDB free: 9216';


DROP TABLE IF EXISTS `perfil_grupogestion`;
CREATE TABLE `perfil_grupogestion` (
  `id_perfil` int(11) NOT NULL default '0',
  `id_grupogestion` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id_perfil`,`id_grupogestion`),
  KEY `FK_perfil_grupogestion_2` (`id_grupogestion`),
  CONSTRAINT `FK_perfil_grupogestion_2` FOREIGN KEY (`id_grupogestion`) REFERENCES `grupogestion` (`id_grupogestion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_perfil_grupogestion_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_Perfil`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Perfiles gestionados por grupo; InnoDB free: 9216 kB';


DROP TABLE IF EXISTS `tau_test`.`contactos_contacto`;
CREATE TABLE  `tau_test`.`contactos_contacto` (
`id_contacto` int(10) unsigned NOT NULL auto_increment,
`Nombre` varchar(80) default NULL,
`Descripcion` varchar(2000) default NULL,
`Telefonos` varchar(2000) default NULL,
`Email` varchar(250) default NULL,
PRIMARY KEY  (`id_contacto`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `tau_test`.`bibliotecacd_categorias`;
CREATE TABLE  `tau_test`.`bibliotecacd_categorias` (
  `id_categoria` int(10) unsigned NOT NULL auto_increment,
  `Nombre` varchar(2000) collate utf8_spanish_ci default NULL,
  `Descripcion` varchar(2000) collate utf8_spanish_ci default NULL,
  `id_padre` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_categoria`),
  KEY `FK_bibliotecacd_categorias_1` (`id_padre`),
  CONSTRAINT `FK_bibliotecacd_categorias_1` FOREIGN KEY (`id_padre`) REFERENCES `bibliotecacd_categorias` (`id_categoria`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `tau_test`.`bibliotecacd_listacd`;
CREATE TABLE  `tau_test`.`bibliotecacd_listacd` (
  `id_cd` int(10) unsigned NOT NULL auto_increment,
  `Titulo` varchar(2000) collate utf8_spanish_ci default NULL,
  `Descripcion` varchar(2000) collate utf8_spanish_ci default NULL,
  `Slot` int(10) default NULL,
  `Categoria` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_cd`),
  KEY `FK_bibliotecacd_listacd_1` (`Categoria`),
  CONSTRAINT `FK_bibliotecacd_listacd_1` FOREIGN KEY (`Categoria`) REFERENCES `bibliotecacd_categorias` (`id_categoria`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

