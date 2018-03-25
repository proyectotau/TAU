USE tau_test

-- Se amplia el campo Nombre del Perfil
ALTER TABLE `perfil`
	CHANGE `Nombre` `Nombre` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ;


USE inventario_test

-- Se amplia el campo Nombre y Ambito del Recurso
ALTER TABLE `recurso`
	CHANGE `Nombre` `Nombre` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
	CHANGE `Ambito` `Ambito` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL ;

--
-- Se amplia los campos de Recurso (para Aplicacion)
--
ALTER TABLE `recurso`
	ADD `version` VARCHAR( 50 ) NULL DEFAULT NULL ,
	ADD `resumen` VARCHAR( 255 ) NULL DEFAULT NULL ,
	ADD `estado` INT( 11 ) NULL DEFAULT NULL ,
	ADD `informacion` VARCHAR( 2000 ) NULL DEFAULT NULL ,
	ADD `normativa` VARCHAR( 2000 ) NULL DEFAULT NULL,
	ADD `afectadoENS` TINYINT( 1 ) NULL COMMENT 'http://es.wikipedia.org/wiki/Esquema_Nacional_de_Seguridad'; -- Cambiar el valor en config.inc.php ("DEFAULT_AfectadoENS")

-- PENDIENTE #4174 (A�adir Ciclo de Vida a las Entidades):
-- PENDIENTE: Los pares estan en VistaAplicacion (hard coded): convertir en relacion y establecer integridad referencial
-- En el caso de Recurso, estado se ha anticipado mal el par (0,'DESARROLLO') cuando ningun campo clave puede ser cero.

-- Esto implica que cuando se normalice habr� que migrar este campo sumandole uno a los valores actuales

-- PD: Los otros pares son:
-- 1, PRUEBAS
-- 2, EXPLOTACION
-- 3, CERRADA

-- La tabla de Estados de la Aplicaciones debera ser:

-- 1, DESARROLLO
-- 2, PRUEBAS
-- 3, EXPLOTACION
-- 4, CERRADA

UPDATE `recurso` SET
	`resumen` = Descripcion, -- migra las actuales descripciones como resumen
	`Descripcion` = NULL;

--
-- Se amplia los campos de Aplicacion
--
ALTER TABLE `aplicacion` ADD `incentivo` TINYINT( 1 ) NULL DEFAULT NULL AFTER `Autorizacion` ;
ALTER TABLE `aplicacion` CHANGE `Ruta_Manuales` `Ruta_Manuales` VARCHAR( 2000 ) NULL DEFAULT NULL ; -- CHARACTER SET utf8 COLLATE utf8_spanish_ci
ALTER TABLE `aplicacion` ADD `Ruta_Repositorio` VARCHAR( 2000 ) NULL DEFAULT NULL AFTER `Ruta_Manuales` ; -- CHARACTER SET utf8 COLLATE utf8_spanish_ci

--
-- Se crean las relaciones de dependencias de Aplicacion requiere Aplicacion
-- que estaba descrita en el modelo de datos pero que nunca se llego a implementar
-- Ampliamos la relacion y la generalizamos de manera que una aplicacion no solo pueda
-- tener varios hijos sino tambien mas de un padre
--
DROP TABLE IF EXISTS `recurso_recurso`;
CREATE TABLE `recurso_recurso` (
	`id_recurso_padre` INT( 11 ) NOT NULL ,
	`id_recurso_hijo`  INT( 11 ) NOT NULL
) ENGINE = InnoDB COMMENT = 'Relacion de dependencias entre Recursos' ;
ALTER TABLE `recurso_recurso` ADD UNIQUE `NDX_recursos` (`id_recurso_padre` , `id_recurso_hijo` ) ;

-- Se a�ade un campo nuevo a Equipo y se elimina el que estaba pendiente desde TAUv1.20
ALTER TABLE `equipo`
	ADD `id_crihja` VARCHAR( 50 ) NULL DEFAULT NULL,
	DROP `Expediente` ;

-- Se a�aden campos a la tabla usuario_perfil
ALTER TABLE `usuario_perfil`
	ADD `fecha_fin_vigencia` DATE NULL ,
	ADD `justificacion` VARCHAR( 2000 ) NULL ,
	ADD `observaciones` VARCHAR( 255 ) NULL ;
	
-- Se a�aden los mismos campos para el modulo de Gestion de Recursos
ALTER TABLE `usuario_perfil_tempo`
	DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci, 
	ADD `fecha_fin_vigencia` DATE NULL ,
	ADD `justificacion` VARCHAR( 2000 ) NULL ,
	ADD `observaciones` VARCHAR( 255 ) NULL ;

-- Se a�aden dos campos a la tabla de Cargo
ALTER TABLE `cargo`
	ADD `Codigo` VARCHAR( 50 ) NULL AFTER `id_Cargo`,
	ADD `Nivel` VARCHAR( 50 ) NULL AFTER `Nombre` ;

-- Se a�ade un campos a la tabla de Extension
ALTER TABLE `extension`
	ADD `Publicable` TINYINT( 1 ) NOT NULL DEFAULT '1';
