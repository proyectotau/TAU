--
-- Soporte de Multi-almacen (#4538)
--


USE inventario_test;


--
-- Separamos los campos de nivel de existencias en su propia tabla para asi
-- poder ubicarlo en cada Almacen donde tengamos unidades de ese Fungible
--
DROP TABLE IF EXISTS `Stock`;
CREATE TABLE `Stock` (
`id_Stock` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`id_fungible` INT( 11 ) DEFAULT NULL ,
`Cantidad` INT( 11 ) NOT NULL DEFAULT '0',
`Minimo` INT( 11 ) NOT NULL ,
`Reposicion` INT( 11 ) NOT NULL,
`Observaciones` VARCHAR( 255 ) NULL DEFAULT NULL ,
INDEX `NDX_FUNGIBLE` ( `id_fungible` ),
FOREIGN KEY ( `id_fungible` )
 REFERENCES `fungible` (`id_Fungible`)
 ON DELETE SET NULL ON UPDATE CASCADE
)
 ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci
 COMMENT = 'Nivel de Existencias de este Fungible en un Almacen' ;

-- Migramos los campos de nivel de existencias a la nueva tabla ...
INSERT INTO `Stock` (`id_fungible`, `Cantidad`, `Minimo`, `Reposicion`)
	SELECT id_Fungible, Cantidad, Minimo, Reposicion
	FROM fungible;

-- ... y los eliminamos de la tabla original		
ALTER TABLE `fungible`
  DROP `Cantidad`,
  DROP `Minimo`,
  DROP `Reposicion`;


--
-- Permite ubicar cada nivel de existencia en Almacenes distintos
--
DROP TABLE IF EXISTS `puesto_stock`;  
CREATE TABLE `puesto_stock` (
`id_puesto` INT( 11 ) NOT NULL ,
`id_stock` INT( 11 ) NOT NULL ,
PRIMARY KEY ( `id_puesto` , `id_stock` ),
INDEX `id_stock` ( `id_stock` ),
FOREIGN KEY ( `id_stock` )
 REFERENCES `Stock` (`id_Stock`)
) ENGINE = InnoDB COMMENT = 'Relacion Puesto y Stock que contiene' ;


-- Como en TAUv1.5.sql pero aplicado a id_puesto en lugar de id_pedido
ALTER TABLE `fungible_movimientos` ADD `id_puesto` INT( 11 ) NULL AFTER `id_pedido` ;
ALTER TABLE `fungible_movimientos` ADD INDEX `NDX_puesto_movimientos` ( `id_puesto` )  ;
ALTER TABLE `fungible_movimientos` ADD FOREIGN KEY ( `id_puesto` )
	REFERENCES `puesto` (`id_Puesto`) ON DELETE SET NULL ON UPDATE SET NULL ;

-- PENDIENTE: PedidoDetalle
-- Se bloquea el codigo de la Gestion de Pedidos hasta que se migre esa parte del modelo


-- proporcionamos unos valores base -- translation ;-)
INSERT INTO `tipofungible` (`Descripcion`) VALUES
('TONER'), -- TONER
('CARTUCHO'), -- CARTRIDGE
('CINTA'), -- LABEL
('FUSOR'), -- FUSER
('UNIDAD DE IMAGEN'), -- PHOTOCONDUCTOR
('TAMBOR'), -- DRUM
-- ('CABEZAL'), -- CARTRIDGE
('RODILLO TRANSFERENCIA'), -- ROLLER TRANSFER
('DUPLEX'), -- DUPLEX UNIT
('ALFOMBRILLA'), -- MOUSE PAD
('RATON'), -- MOUSE
('PENDRIVE'),
('CABLE'), -- WIRE
('CARGADOR'), -- CHARGER
('DVD'),
('CD'),
('BOTE RESIDUOS'), -- WASTE TONER BOX
('MALETIN'), -- BRIEFCASE COMPUTER
('TECLADO') -- KEYBOARD
-- ('KIT MANTENIMIENTO'),
-- ('FOTOCONDUCTOR') -- UNIDAD DE IMAGEN
; 
