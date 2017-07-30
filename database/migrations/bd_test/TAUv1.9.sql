use inventario_test;
CREATE TABLE `notifica` (
 `id_notifica` int(11) NOT NULL auto_increment,
 `mensaje` varchar(300) collate utf8_spanish_ci NOT NULL default '',
 `n_itera` tinyint(3) NOT NULL default '0',
 `fecha_cad` datetime NOT NULL ,
 `id_usuario` int(11) NOT NULL default '0',
 `id_recurso` int(11) default NULL,
 `fecha_ini` datetime NOT NULL ,
 PRIMARY KEY  (`id_notifica`),
 KEY `FK_notifica_1` (`id_usuario`),
 KEY `FK_notifica_2` (`id_recurso`),
 CONSTRAINT `FK_notifica_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `FK_notifica_2` FOREIGN KEY (`id_recurso`) REFERENCES `recurso` (`id_Recurso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla sobre notificaciones a usuarios';
