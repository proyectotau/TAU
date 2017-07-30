--
-- Gestion de Recursos
--

USE inventario_test;

DROP TABLE IF EXISTS `usuario_perfil_tempo`;
CREATE TABLE `usuario_perfil_tempo` (
  `id_Perfil` int(11) NOT NULL default '0',
  `id_Usuario` int(11) NOT NULL default '0',
  `fecha` date NOT NULL ,
  `AnadirEliminar` tinyint(1) NOT NULL default '0',
  `Pendiente` tinyint(2) unsigned NOT NULL default '0',
  `Unidad` int(10) unsigned NOT NULL default '0',
  `id_tarea` int(10) unsigned NOT NULL auto_increment,
  `observacion` blob NOT NULL,
  `hecho_por` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`id_tarea`),
  KEY `FK_usuario_perfil_tempo_1` (`id_Usuario`),
  KEY `FK_usuario_perfil_tempo_2` (`id_Perfil`),
  CONSTRAINT `FK_usuario_perfil_tempo_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`id_Usuario`),
  CONSTRAINT `FK_usuario_perfil_tempo_2` FOREIGN KEY (`id_Perfil`) REFERENCES `perfil` (`id_Perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla para mantener los cambios solicitados por los Jefe de Servicio';
