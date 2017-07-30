--
-- Modificaciones a Inventario
--

use tau_test;

SET AUTOCOMMIT = 0;
BEGIN;

--
-- Tabla RDP_servidores
--
DROP TABLE IF EXISTS `tau_test`.`rdp_servidores`;
CREATE TABLE  `tau_test`.`rdp_servidores` 
 (`nombre` varchar(80) NOT NULL,
   `ip` varchar(45) NOT NULL,
   `usuario` int(10) unsigned NOT NULL,
   `id` int(10) unsigned NOT NULL auto_increment,
   `dominio` varchar(80) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


COMMIT;
