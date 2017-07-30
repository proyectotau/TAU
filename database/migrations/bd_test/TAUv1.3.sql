--
-- Modificaciones a TAU
--

use tau_test;

ALTER TABLE `tau_test`.`usuario`
	MODIFY COLUMN `USUARIO_RED` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL;

--
-- Modificaciones a Inventario
--

use inventario_test;

--
-- Tabla Fungible
--
DROP TABLE IF EXISTS `inventario_test`.`fungible`;
CREATE TABLE `inventario_test`.`fungible` (
  `id_Fungible` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(50) NOT NULL,
  `Cantidad` int(11),
  `Minimo` int(11) UNSIGNED NOT NULL,
  `Pedido` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_Fungible`)
)
ENGINE = InnoDB
COMMENT = 'Fungibles y Consumibles';

--
-- Tabla de Relacion Fungible y Marca-Modelo
--

DROP TABLE IF EXISTS `inventario_test`.`fungible_equipo`;
CREATE TABLE `inventario_test`.`fungible_equipo` (
  `id_fungible` int(11) NOT NULL,
  `id_marca` int(10) NOT NULL,
  `id_modelo` int(10) NOT NULL,
  KEY `NDX_id_fungible_equipo` (`id_fungible`, `id_marca`,`id_modelo`),
  CONSTRAINT `FK_fungible_equipo_1` FOREIGN KEY `FK_fungible_equipo_1` (`id_marca`)
    REFERENCES `marca` (`id_Marca`),
  CONSTRAINT `FK_fungible_equipo_2` FOREIGN KEY `FK_fungible_equipo_2` (`id_modelo`)
    REFERENCES `modelo` (`id_Modelo`)
)
ENGINE = InnoDB
COMMENT = 'Relacion Fungible y Marca-Modelo';

--
-- Tabla de Relacion entre Fungible y sus Movimientos
--

DROP TABLE IF EXISTS `inventario_test`.`fungible_movimientos`;
CREATE TABLE `inventario_test`.`fungible_movimientos` (
  `id_fungible` int(11) NOT NULL,
  `id_equipo` int(11),
  `Fecha` DATE,
  `Cantidad` int(11),
  `Observaciones` VARCHAR(255),
  KEY `NDX_id_fungible` (`id_fungible`),
  KEY `NDX_id_equipo` (`id_equipo`),
  CONSTRAINT `FK_fungible` FOREIGN KEY `FK_fungible` (`id_fungible`)
    REFERENCES `fungible` (`id_Fungible`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo` FOREIGN KEY `FK_equipo` (`id_equipo`)
    REFERENCES `equipo` (`id_Equipo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
COMMENT = 'Relacion entre Fungible y Equipo';
