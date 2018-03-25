use inventario_test
DROP TABLE IF EXISTS `mensajes`;
DROP TABLE IF EXISTS `notifica`;

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL auto_increment,
  `mensaje` longtext character set utf8 collate utf8_spanish_ci NOT NULL,
  `tipo` varchar(3) character set utf8 collate utf8_spanish_ci NOT NULL default '',
  `fecha_cad` datetime NOT NULL ,
  `fecha_ini` datetime NOT NULL ,
  `recurso` varchar(100) character set utf8 collate utf8_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`id_mensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

CREATE TABLE `notifica` (
  `id_notifica` int(11) NOT NULL auto_increment,
  `n_itera` tinyint(3) NOT NULL default '0',
  `id_usuario` int(11) NOT NULL default '0',
  `id_mensaje` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_notifica`),
  KEY `FK_notifica_1` (`id_usuario`),
  KEY `FK_notifica_2` (`id_mensaje`),
  CONSTRAINT `FK_notifica_2` FOREIGN KEY (`id_mensaje`) REFERENCES `mensajes` (`id_mensaje`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_notifica_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla sobre notificaciones a usuarios';



