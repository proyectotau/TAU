--
-- Soporte para multiples sedes (Provincializacion #3360)
--

USE tau_test;

CREATE TABLE `grupo_localizacion` (
`id_grupo` INT( 11 ) NOT NULL ,
`id_localizacion` INT( 11 ) NOT NULL
) ENGINE = InnoDB COMMENT = 'Relacion de Sedes accesibles al grupo' ;

ALTER TABLE `grupo_localizacion`
-- Hace unicas las localizaciones, a diferencia de la ubicacion en Puestos
	ADD UNIQUE `NDX_LOCALIZACIONESUNICAS` (`id_grupo`,`id_localizacion`) ,
-- Indica la localizacion por defecto para los usuarios de cada grupo como valor inicial antes de que el propio usuario lo cambie
	ADD `es_pordefecto` BOOLEAN NOT NULL DEFAULT '0' AFTER `id_localizacion` ;

-- MisPreferencias agrega el nuevo metodo al Perfil Base
INSERT INTO `perfil_metodos` (`ID_PERFIL` ,`ID_MODULO` ,`NOMBRE_METODO` ,`SUBCLASS` ,`SUBMETODO` ,`VISTA`)
VALUES ('1', '4', 'cambiarinventario_testLoc', NULL , NULL , NULL) ;


USE inventario_test;

-- Antes se permitia localizar un objeto en mas de un plano (igual que pueden estar en mas de un puesto)
-- Ahora solo puede estar en una localizacion (a pesar de que pueden seguir estando en mas de un puesto)
-- La ultima localizacion, sustituye a la anterior

-- Antes de aplicar el check hay que hacer un poco de house cleaning ;-)
-- El id_obj = 0 no se puede quitar desde la interface :-(
-- DELETE FROM `objeto_localizacion`
--	WHERE `id_obj` < 1;

-- check
-- SELECT `id_obj` , `Tipo_obj` , count( * )
-- FROM `objeto_localizacion`
-- GROUP BY `id_obj` , `Tipo_obj`
-- HAVING count( * ) >1

-- Muestra los casos que incumple el check de arriba
-- SELECT *
-- FROM `objeto_localizacion`
-- WHERE (`id_obj` , `Tipo_obj`)
-- IN (
-- SELECT `id_obj` , `Tipo_obj`
--   FROM `objeto_localizacion`
--   GROUP BY `id_obj` , `Tipo_obj`
--   HAVING count(*) > 1
-- )

ALTER TABLE `objeto_localizacion`
	DROP INDEX `NDX_objeto_localizacion` ,
	ADD UNIQUE `NDX_objeto_localizacion` ( `id_obj` , `Tipo_obj` ) ;
	
-- La tabla Empresa admite Nombres duplicados:
-- SELECT `Nombre` , count( * )
-- FROM `empresa`
-- GROUP BY `Nombre`
-- HAVING count( * ) >1
ALTER TABLE `empresa` ADD UNIQUE `Nombre` ( `Nombre` ) ;
