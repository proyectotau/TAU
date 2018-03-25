USE inventario_test

--
-- Tabla de Prestamos de Equipos (#3359)
--

DROP TABLE IF EXISTS `prestamo`;
CREATE TABLE `prestamo` (
  `id_Prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `id_usr_tau_ent` int(11) NOT NULL COMMENT 'Usuario que inicia el prestamo',
  `id_usr_tau_dev` int(11) DEFAULT NULL COMMENT 'Usuario que finaliza el prestamo',
  `fecha_entrega` DATE NOT NULL,
  `fecha_devolucion_prevista` DATE NOT NULL,
  `fecha_devolucion_real` DATE DEFAULT NULL,
  `observaciones` varchar(512) DEFAULT NULL,
  `id_usr` int(11) DEFAULT NULL COMMENT 'Usuario prestatario',
  `id_equ` int(11) DEFAULT NULL COMMENT 'Equipo prestado',
  `id_pst` int(11) DEFAULT NULL COMMENT 'Puesto de Origen del Equipo',
  PRIMARY KEY (`id_Prestamo`)
) ENGINE=InnoDB DEFAULT
CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Tabla para los Tipos de Fungibles segun su Categoria o Familia (#3592)
--
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `tipofungible`;
CREATE TABLE `tipofungible` (
  `id_Tipofungible` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(50) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_Tipofungible`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET FOREIGN_KEY_CHECKS = 1;

--
-- Se amplian los campos de Fungible
--
ALTER TABLE `fungible`
      ADD `Referencia` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Referencia del fabricante' AFTER `id_Fungible` ,
      CHANGE `Nombre` `Descripcion` VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'Color' ; -- migra los nombre no normalizados a una mera descripcion
ALTER TABLE `fungible`      
      ADD `id_tipofungible` INT( 10 ) NULL DEFAULT NULL COMMENT 'Familia o Categor�a' AFTER `Descripcion` ;
ALTER TABLE `fungible`
      ADD INDEX ( `id_tipofungible` ) ;
ALTER TABLE `fungible`
      ADD FOREIGN KEY ( `id_tipofungible` ) REFERENCES `tipofungible` (`id_Tipofungible`)
      ON DELETE SET NULL ON UPDATE CASCADE ;

-- Evita que se pueda asociar un Fungible a la misma Marca/Modelo mas de una vez:
-- NOTA: Antes de aplicar verificar con:
-- SELECT `id_fungible` , `id_marca` , `id_modelo` , count( * )
-- FROM `fungible_equipo`
-- GROUP BY `id_fungible` , `id_marca` , `id_modelo`
-- HAVING count( * ) >1
ALTER TABLE `fungible_equipo`
	DROP INDEX `NDX_id_fungible_equipo` ,
	ADD UNIQUE `NDX_id_fungible_equipo` ( `id_fungible` , `id_marca` , `id_modelo` ) ;

-- TEMPORAL mientras se desarrolla. Despues el campo se trasladara a su propia tabla Stock (en v1.25)
-- Por seguridad, nos protegemos antes posibles errores en el codigo
ALTER TABLE `fungible`
	CHANGE `Cantidad` `Cantidad` INT NOT NULL DEFAULT '0' ;

-- *** HASTA AQUI EJECUTADO EN (DESA) PRE pero NO EN PROD
