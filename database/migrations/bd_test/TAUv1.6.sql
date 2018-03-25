--
-- Modificaciones a Inventario
--

use inventario_test

SET AUTOCOMMIT = 0;
BEGIN;

--
-- Tabla Fungible
--

ALTER TABLE `fungible`
CHANGE `Nombre` `Nombre` VARCHAR( 150 )
CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
COMMENT 'Marca modelo referencia y color';

COMMIT;
