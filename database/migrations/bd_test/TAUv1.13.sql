-- Se a�ade la capacidad de Historico al Inventario respecto del movimiento de objetos a los Puestos

USE inventario_test

ALTER TABLE `puesto_equipo`
					DROP PRIMARY KEY ,
					ADD UNIQUE (`id_puesto` ,`id_equipo` ,`Fecha_alta`) ,
					CHANGE `id_equipo` `id_equipo` INT( 11 ) NULL ,
					CHANGE `Fecha` `Fecha_alta` DATETIME NOT NULL COMMENT 'Fecha de asignacion del Equipo al Puesto' ,
					ADD `Fecha_baja` DATETIME NULL COMMENT 'Fecha de desasignacion del Equipo al Puesto';

ALTER TABLE `puesto_roseta`
					DROP PRIMARY KEY ,
					ADD UNIQUE (`id_puesto` ,`id_roseta` ,`Fecha_alta`) ,
					CHANGE `id_roseta` `id_roseta` INT( 11 ) NULL ,
					ADD `Fecha_alta` DATETIME NOT NULL COMMENT 'Fecha de asignacion de la Roseta al Puesto',
					ADD `Fecha_baja` DATETIME NULL DEFAULT NULL COMMENT 'Fecha de desasignacion de la Roseta al Puesto';
	  
ALTER TABLE `puesto_usuario`
					DROP PRIMARY KEY ,
					ADD UNIQUE (`id_puesto` ,`id_usuario` ,`Fecha_alta`) ,
					CHANGE `id_usuario` `id_usuario` INT( 11 ) NULL ,
					ADD `Fecha_alta` DATETIME NOT NULL COMMENT 'Fecha de asignacion del Usuario al Puesto',
					ADD `Fecha_baja` DATETIME NULL DEFAULT NULL COMMENT 'Fecha de desasignacion del Usuario al Puesto';
