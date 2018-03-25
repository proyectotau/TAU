--
-- Modificaciones a Inventario
--

use inventario_test

SET AUTOCOMMIT = 0;
BEGIN;

--
-- Tabla Pedido
--

DROP TABLE IF EXISTS `inventario_test`.`pedido`;
CREATE TABLE `inventario_test`.`pedido` (
  `id_Pedido` INT(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` INT(11),
  `Fecha` DATE NOT NULL,
  `Observaciones` VARCHAR(512) DEFAULT NULL,
  PRIMARY KEY (`id_Pedido`),
  INDEX NDX_empresa(`id_empresa`),
  CONSTRAINT `FK_Pedido_empresa` FOREIGN KEY `FK_Pedido_empresa` (`id_empresa`)
    REFERENCES `inventario_test`.`empresa` (`id_Empresa`)
    ON DELETE SET NULL
    ON UPDATE SET NULL
)
ENGINE = InnoDB
COMMENT = 'Cabeceras de Pedido de Fungibles';

--
-- Tabla PedidoDetalle
--

DROP TABLE IF EXISTS `inventario_test`.`PedidoDetalle`;
CREATE TABLE `inventario_test`.`PedidoDetalle` (
  `id_PedidoDetalle` INT(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` INT(11) NOT NULL,
  `id_fungible` INT(11) NOT NULL,
  `Cantidad` INTEGER UNSIGNED NOT NULL,
  `Entrada` INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY (`id_PedidoDetalle`),
  INDEX NDX_pedido(`id_pedido`),
  INDEX NDX_fungible(`id_fungible`),
  UNIQUE INDEX NDX_PedidoDetalle_Unico(`id_pedido`, `id_fungible`),
  CONSTRAINT `FK_pedido` FOREIGN KEY `FK_pedido` (`id_pedido`)
    REFERENCES `inventario_test`.`pedido` (`id_Pedido`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_fungible_PedidoDetalle` FOREIGN KEY `FK_fungible_PedidoDetalle` (`id_fungible`)
    REFERENCES `inventario_test`.`fungible` (`id_Fungible`)
    ON DELETE CASCADE 
    ON UPDATE CASCADE
)
ENGINE = InnoDB
COMMENT = 'Lineas de Fungibles de cada Pedido';

 ALTER TABLE `inventario_test`.`fungible` CHANGE `Pedido` `Reposicion` INT( 10 ) UNSIGNED NOT NULL  ;
 
 ALTER TABLE `inventario_test`.`fungible_equipo`
	COMMENT = 'Relacion Fungible y Marca-Modelo del equipo que lo consume' ;
 
 ALTER TABLE `inventario_test`.`fungible_movimientos` CHANGE `Fecha` `Fecha` DATETIME NULL DEFAULT NULL  ;
 ALTER TABLE `inventario_test`.`fungible_movimientos` ADD `id_pedido` INT( 11 ) NULL AFTER `id_equipo` ;
 ALTER TABLE `inventario_test`.`fungible_movimientos` ADD INDEX `NDX_pedido_movimientos` ( `id_pedido` )  ;
 ALTER TABLE `inventario_test`.`fungible_movimientos` ADD FOREIGN KEY ( `id_pedido` )
	REFERENCES `inventario_test`.`pedido` (`id_Pedido`) ON DELETE SET NULL ON UPDATE SET NULL ;
ALTER TABLE `fungible_movimientos`
 	COMMENT = 'Relacion entre Fungible y sus Movimientos' ;

COMMIT;
