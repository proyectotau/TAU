USE tau_test

-- ES I M P O R T A N T E
DROP VIEW IF EXISTS `localizacion_modulo` ;
-- ES I M P O R T A N T E

-- house cleaning ;-)
UPDATE `usuario` SET `APELLIDOS` = 'TAU' WHERE `ID_USUARIO` = 0 LIMIT 1 ;
UPDATE `grupo` SET `DESCRIPCION` = 'Grupo de Administradores de TAU' WHERE `grupo`.`ID_GRUPO` = 0 LIMIT 1 ;
ALTER TABLE `perfil` CHANGE `descripcion` `DESCRIPCION` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL ;
ALTER TABLE `usuario_grupo` DROP INDEX `NDX_USUARIO_GRUPO` ;

-- !NO,NO, NO crear CONSTRAIN en los campos de relacion!
-- Se eliminan los CASCADEs. Para ello se DROP la relacion y se ADD la nueva !CON EL MISMO NOMBRE!!!!!!!!
ALTER TABLE `usuario_grupo` DROP FOREIGN KEY `usuario_grupo_ibfk_1` ;
ALTER TABLE `usuario_grupo` ADD FOREIGN KEY `usuario_grupo_ibfk_1` ( `ID_USUARIO` ) REFERENCES `usuario` (`ID_USUARIO`) ;
ALTER TABLE `usuario_grupo` DROP FOREIGN KEY `usuario_grupo_ibfk_2` ;
ALTER TABLE `usuario_grupo` ADD FOREIGN KEY `usuario_grupo_ibfk_2` ( `ID_GRUPO` ) REFERENCES `grupo` (`ID_GRUPO`) ;

TRUNCATE TABLE `perfil_metodos` ;

ALTER TABLE `perfil_metodos` DROP FOREIGN KEY `perfil_metodos_ibfk_1` ;
ALTER TABLE `perfil_metodos` DROP FOREIGN KEY `perfil_metodos_ibfk_2` ;
ALTER TABLE `perfil_metodos` DROP INDEX `NDX_NOMBRE_METODOS` ;
ALTER TABLE `perfil_metodos` DROP INDEX `NDX_METODOS` ;
ALTER TABLE `perfil_metodos` DROP PRIMARY KEY ;
DROP TABLE IF EXISTS `metodos` ;
DROP TABLE IF EXISTS `inventario2_metodos` ;
-- El Modulo Panel se ha movido a KERNEL y se inserta en el menu hard-coded en Autorizacion::arrayListaModulos()
DELETE FROM `modulo` WHERE `ID_MODULO` = 24 LIMIT 1 ; -- ADMINISTRADOR DE PANELES

-- a�adido soporte de perfiles de acceso
ALTER TABLE `perfil_metodos`
	ADD `SUBCLASS` VARCHAR( 45 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
	ADD `SUBMETODO` VARCHAR( 45 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
	ADD `VISTA` VARCHAR( 45 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ;

INSERT INTO `usuario_grupo` (`ID_USUARIO` , `ID_GRUPO`) VALUES
('0', '0') ;
-- ERROR 1062 (23000): Duplicate entry '0-0' for key 1
-- Desde TAUv1.sql
-- INSERT INTO `grupo_perfil` (`ID_GRUPO`, `ID_PERFIL`) VALUES ('0', '0');


INSERT INTO `grupo` (`ID_GRUPO` ,`NOMBRE` ,`DESCRIPCION`) VALUES
('1', 'Base', 'Grupo Base');

INSERT INTO `perfil` (`ID_PERFIL` ,`NOMBRE` ,`DESCRIPCION`) VALUES
-- ('0', 'Administracion', 'El grupo con este perfil puede acceder a todos los metodos de todas las clases'),
('1', 'Perfil Base', 'Acceso basico a los modulos iniciales usados en el Tema Guay') ; -- ,
-- ('3', 'MENSAJERIA-L', 'Acceso de Consulta'),
-- ('4', 'MENSAJERIA-E', 'Acceso de Escritura')
-- ;

INSERT INTO `perfil_metodos` (`ID_PERFIL` ,`ID_MODULO` ,`NOMBRE_METODO` ,`SUBCLASS` ,`SUBMETODO` ,`VISTA`) VALUES
-- MisPreferencias
('1', '4', 'body', NULL , NULL , NULL),
('1', '4', 'inicio', NULL , NULL , NULL),
('1', '4', 'cambiarTema', NULL , NULL , NULL),
('1', '4', 'cambiarPaginaInicio', NULL , NULL , NULL),
-- Email
('1', '21', 'body', NULL , NULL , NULL),
('1', '21', 'preview', NULL , NULL , NULL),
('1', '21', 'Configurar_email', NULL , NULL , NULL),
('1', '21', 'toolbarActualizacion', NULL , NULL , NULL),
-- Mensajeria
('1', '32', 'toolbarActualizacion', NULL , NULL , NULL);

INSERT INTO `grupo_perfil` (`ID_GRUPO`, `ID_PERFIL`) VALUES
('1', '1');

-- Entrar como Administrador y agregar a todos los usuarios al Grupo Base
-- Dejar el Perfil Base sin tocar como Configuracion Base
-- Agregar nuevos perfiles y grupos para su entorno local



USE inventario_test

--
-- Renombrado de tablas a minusculas para MySQL en Linux
--

-- EDU RENAME TABLE `ConexionImpresora`  TO `conexionimpresora` IF EXISTS `ConexionImpresora`;
-- EDU RENAME TABLE `FormatoImpresora`  TO `formatoimpresora` IF EXISTS `FormatoImpresora`;
-- EDU RENAME TABLE `ImpresionImpresora`  TO `impresionimpresora` IF EXISTS `ImpresionImpresora`;
-- EDU RENAME TABLE `InventarioLog`  TO `inventariolog` IF EXISTS `InventarioLog`;
-- EDU RENAME TABLE `Pedido`  TO `pedido` IF EXISTS `Pedido` ;
-- EDU RENAME TABLE `SistemaOperativo`  TO `sistemaoperativo` IF EXISTS `SistemaOperativo`;
-- EDU RENAME TABLE `SubtipoImpresora`  TO `subtipoimpresora` IF EXISTS `SubtipoImpresora`;

-- ES I M P O R T A N T E
ALTER TABLE `impresora` ADD INDEX ( `Subtipo` ) ;
ALTER TABLE `impresora` ADD
 	FOREIGN KEY ( `Subtipo` )
 	REFERENCES `SubtipoImpresora` (`id_SubtipoImpresora`) ON DELETE SET NULL ON UPDATE CASCADE ;
ALTER TABLE `InventarioLog`  COMMENT = 'Bitacora del Inventario' ;
-- ES I M P O R T A N T E

-- Aprovecha la migracion de CEM para ligar los Modelos a las Marcas
ALTER TABLE `modelo` ADD `id_marca` INT( 11 ) NULL COMMENT 'Referencia a la Marca de este modelo';
ALTER TABLE `modelo`
		DROP INDEX `Descripcion` ,
		ADD UNIQUE `Descripcion` ( `Descripcion` , `id_marca` ) ; -- puede haber modelos iguales en otras marcas
ALTER TABLE `modelo` ADD INDEX ( `id_marca` ) ;
ALTER TABLE `modelo` 
	ADD FOREIGN KEY ( `id_marca` ) REFERENCES `marca` (`id_Marca`)
	ON DELETE SET NULL ON UPDATE CASCADE ;

-- La migracion de CEM implica la creacion de tablas nuevas y la actualizacion del Modelo de Datos

DROP TABLE IF EXISTS `situacionreal`;
CREATE TABLE `situacionreal` (
`id_SituacionReal` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`Descripcion` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL , UNIQUE (`Descripcion`)
) ENGINE = InnoDB COMMENT = 'Ciclo de vida de un Equipo' ; 

INSERT INTO `situacionreal` (`id_SituacionReal`, `Descripcion`) VALUES
(1, 'EN USO'),
(2, 'DISPONIBLE'),
(3, 'EN DESUSO'),
(4, 'DONADO/CEDIDO'),
(5, 'DESTRUIDO'),
(6, 'DESUBICADO');

DROP TABLE IF EXISTS `situacioncrija`;
CREATE TABLE `situacioncrija` (
`id_SituacionCRIJA` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`Descripcion` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL , UNIQUE (`Descripcion`)
) ENGINE = InnoDB COMMENT = 'Estados de un Equipo respecto a CRIJA' ; -- https://bugs.mysql.com/bug.php?id=38597

INSERT INTO `situacioncrija` (`id_SituacionCRIJA`, `Descripcion`) VALUES
(1, 'ALTA'),
(2, 'BAJA'),
(3, 'PENDIENTE');

ALTER TABLE `equipo`
	ADD `id_expediente` INT( 11 ) NULL DEFAULT NULL ,
	ADD `id_situacionreal` INT( 11 ) NULL DEFAULT NULL ,
	ADD `id_situacioncrija` INT( 11 ) NULL DEFAULT NULL ;
-- QUEDA PENDIENTE ELIMINAR EL CAMPO Expediente DESPUES DE LA MIGRACION AL NUEVO MODELO DE DATOS
ALTER TABLE `equipo` ADD INDEX ( `id_situacionreal` ) ;
ALTER TABLE `equipo` ADD INDEX ( `id_situacioncrija` ) ;

ALTER TABLE `equipo`
	ADD FOREIGN KEY ( `id_situacionreal` )
	REFERENCES `situacionreal` (`id_SituacionReal`)
	ON DELETE SET NULL ON UPDATE CASCADE ;

ALTER TABLE `equipo`
	ADD FOREIGN KEY ( `id_situacioncrija` )
	REFERENCES `situacioncrija` (`id_SituacionCRIJA`)
	ON DELETE SET NULL ON UPDATE CASCADE ;

DROP TABLE IF EXISTS `expediente`;
CREATE TABLE `expediente` (
`id_Expediente` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`noexpediente` VARCHAR( 80 ) NULL , -- igual que Equipo.Expediente
`tipo` VARCHAR( 10 ) NULL ,
`id_unidad` INT NULL ,
`titulo` VARCHAR( 100 ) NULL ,
`importe` DOUBLE NULL ,
`id_empresa` INT NULL ,
`dgoi` DATE NULL ,
`informe` DATE NULL ,
`pago` VARCHAR( 25 ) NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_spanish_ci COMMENT = 'Expedientes de compra' ;

-- ALTER TABLE `equipo` CHANGE `Expediente` `id_expediente` INT( 11 ) NULL DEFAULT NULL ;
ALTER TABLE `equipo` ADD INDEX ( `id_expediente` ) ;
ALTER TABLE `equipo`
	ADD FOREIGN KEY ( `id_expediente` )
	REFERENCES `expediente` (`id_Expediente`)
	ON DELETE SET NULL ON UPDATE CASCADE ;

-- faltan relaciones con id_empresa e id_unidad

DROP TABLE IF EXISTS `tr_expediente`;
 CREATE TABLE `tr_expediente` (
`new_id` int( 11 ) NOT NULL ,
`old_id` varchar( 50 ) COLLATE utf8_spanish_ci NOT NULL
) ENGINE = MYISAM DEFAULT CHARSET = utf8 COLLATE = utf8_spanish_ci ;

ALTER TABLE `tr_puesto` CHANGE `old_id` `old_id` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ;

-- Tabla de Detalles relacionada con Averias (Maestro)

DROP TABLE IF EXISTS `averia_comentarios`;
CREATE TABLE `averia_comentarios` (
`id_averia` INT( 11 ) NOT NULL ,
`fecha` DATETIME NOT NULL ,
`comentario` VARCHAR( 512 ) NULL ,
`id_usr_tau` INT( 11 ) NOT NULL
) ENGINE = InnoDB
CHARACTER SET utf8 COLLATE utf8_spanish_ci
COMMENT = 'Lista de comentarios de una Averia' ;

ALTER TABLE `averia_comentarios` ADD INDEX ( `id_averia` ) ;

ALTER TABLE `averia_comentarios` ADD FOREIGN KEY ( `id_averia` ) REFERENCES `averias` (`id_Averia`)
ON DELETE CASCADE ON UPDATE CASCADE ;

--
-- Proceso de migracion del Campo Equipo.Expediente a su propia tabla
--

DROP PROCEDURE IF EXISTS CEMMigrarCampoExpediente;
DELIMITER //

CREATE PROCEDURE CEMMigrarCampoExpediente()
BEGIN
	DECLARE cursor_tabla_expediente CURSOR FOR SELECT id_Expediente, noexpediente FROM expediente;
	
	DELETE FROM expediente;
	ALTER TABLE expediente AUTO_INCREMENT = 1;
	
	-- Si no ten�a Expediente conocido lo agrupamos en uno generico ('[NoEXP]')
	UPDATE equipo SET Expediente='[NoEXP]' WHERE (Expediente is null OR length(trim(Expediente)) = 0);
	
	-- Seleccionamos todos los equipos con el mismo Expediente e iteramos sobre la tabla equipo,
	-- para ir migrando registro a registro, partiendo del valor almacenado en el campo/columna 'antiguo' llamado 'Expediente',
	-- y vamos insertando el nuevo registro migrado a la tabla expediente
	INSERT INTO expediente (noexpediente)
		SELECT expediente
		FROM equipo
		WHERE NOT (Expediente is null OR length(trim(Expediente)) = 0)
		GROUP BY Expediente;

	-- A contiuaci�n, recorremos la tabla Expediente (mediante el cursor cursor_tabla_expediente),
	-- y por cada par (id_Expediente, noexpediente) asignamos en la tabla inventario.equipo el id_Expediente actual
	-- a todos los que tengan el mismo noExpediente
	
	-- Abrimos el cursor cursor_tabla_expediente
	OPEN cursor_tabla_expediente;
	BEGIN
		DECLARE hecho INT DEFAULT 0;
		DECLARE NoExpediente VARCHAR(80);
		DECLARE Id_Expediente INT(11);
		DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET hecho = 1;
			
		REPEAT
			FETCH cursor_tabla_expediente INTO Id_Expediente, NoExpediente;
			IF NOT hecho THEN
				-- Finalmente, actualizamos tambi�n el campo id_expediente con el valor del campo Id_Expediente
				UPDATE equipo SET id_expediente = Id_Expediente WHERE Expediente = NoExpediente COLLATE utf8_general_ci;
			END IF;
		UNTIL hecho END REPEAT;
	END;
	-- Cerramos el cursor cursor_tabla_expediente	 
	CLOSE cursor_tabla_expediente;
	
END;
//

DELIMITER ';'

CALL CEMMigrarCampoExpediente();

DROP PROCEDURE IF EXISTS CEMMigrarCampoExpediente;
