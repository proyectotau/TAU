-- en TAUv1.23, TAUv1.24 y siguientes va todo lo nuevo de DESA 

USE inventario_test;

--
-- Estructura de tabla para la tabla `tecnologia` (#3359)
--

CREATE TABLE IF NOT EXISTS `tecnologia` (
  `id_Tecnologia` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(50) character set utf8 collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_Tecnologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Datos para la tabla `tecnologia`
--
INSERT INTO `tecnologia` (
`Descripcion` 
)
VALUES
('ANALOGICO'), -- 1
('DIGITAL'), -- 2
('VOZ IP'), -- 3
('MOVIL') -- 4
;

--
-- Migracion de datos para la tabla `extension`
--
UPDATE `extension` SET `AD`=1 WHERE AD='A'; 
UPDATE `extension` SET `AD`=2 WHERE AD='D'; 
UPDATE `extension` SET `AD`=3 WHERE AD='V'; 
UPDATE `extension` SET `AD`=4 WHERE AD='M';
-- 'Sin Especificar' si Null


ALTER TABLE `extension` CHANGE `AD` `id_tecnologia` INT( 10 ) NULL DEFAULT NULL ;
ALTER TABLE `extension` ADD INDEX ( `id_tecnologia` ) ;
ALTER TABLE `extension`
	ADD CONSTRAINT `FK_tecnologia`
	FOREIGN KEY ( `id_tecnologia` ) REFERENCES `tecnologia` (`id_Tecnologia`)
	ON DELETE SET NULL ON UPDATE CASCADE ;

--
-- Estructura de tabla para la tabla `tiporoseta` (#3778)
--

CREATE TABLE IF NOT EXISTS `tiporoseta` (
  `id_Tiporoseta` int(10) NOT NULL auto_increment,
  `Descripcion` varchar(50) character set utf8 collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_Tiporoseta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Migracion de datos del campo Tipo de la tabla `roseta` a su propia tabla normalizada tiporoseta
--
-- INSERT INTO tiporoseta (Descripcion) -- Da valor inicial a los tipos encontrados
--	SELECT trim((`Tipo`) FROM `roseta`
--	WHERE NOT isNull(`Tipo`) -- 'Sin Determinar' si Null
--	GROUP BY trim(`Tipo`)
--	ORDER BY `Tipo` ASC;


-- http://www.mysqltutorial.org/mysql-cursor/
-- http://www.hermosaprogramacion.com/2014/06/mysql-cursores/
-- http://stackoverflow.com/questions/11770074/illegal-mix-of-collations-utf8-unicode-ci-implicit-and-utf8-general-ci-implic
-- https://bugs.mysql.com/bug.php?id=2676
-- NOTA: La indentacion hasta el segundo DELIMITER es importante!!
-- NOTA: ERROR 1193 (HY000): Unknown system variable 'hecho': se antepone @
DELIMITER //

 CREATE PROCEDURE migrar_tiporoseta()
 BEGIN

  DECLARE id INT(10);
  DECLARE des VARCHAR(50);

  DECLARE tabla_aux_tiporoseta CURSOR FOR
   select id_Tiporoseta, Descripcion
   from tiporoseta;

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET @hecho = TRUE;

  OPEN tabla_aux_tiporoseta;

procesaTipo: LOOP

  FETCH tabla_aux_tiporoseta INTO id, des;

  IF @hecho THEN
   LEAVE procesaTipo;
  END IF;

  UPDATE roseta SET
   Tipo = id
  WHERE trim(Tipo) = des COLLATE UTF8_SPANISH_CI;

END LOOP procesaTipo;

CLOSE tabla_aux_tiporoseta;

END;
//

 DELIMITER ;

CALL migrar_tiporoseta();

DROP PROCEDURE IF EXISTS migrar_tiporoseta;

ALTER TABLE `roseta` ADD INDEX ( `Tipo` ) ;
ALTER TABLE `roseta` CHANGE `Tipo` `Tipo` INT( 10 ) NULL DEFAULT NULL ;
ALTER TABLE `roseta`
	ADD CONSTRAINT `FK_tiporoseta`
	FOREIGN KEY ( `Tipo` ) REFERENCES `tiporoseta` (`id_Tiporoseta`)
	ON DELETE SET NULL ON UPDATE CASCADE ;
	
-- *** HASTA AQUI EJECUTADO SOLO EN (DESA) PRE
