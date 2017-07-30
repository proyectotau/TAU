USE tau_test;

DROP TABLE IF EXISTS informes;

CREATE TABLE `informes` (

	`id` int(11) NOT NULL auto_increment,
	`titulo` varchar(100) NOT NULL,
	`descripcion` varchar(200) NOT NULL,
	`_select` varchar(2000) NOT NULL,
	`campos` varchar(2000) NOT NULL,
	`anchos` varchar(2000) NOT NULL,
	`nombre_campos` varchar(2000) NOT NULL,
	`_from` varchar(2000) NOT NULL,
	`_where` varchar(2000),
	`order_by` varchar(2000),
	`group_by` varchar(2000),

  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

ALTER TABLE inventario_test.`fungible_equipo`
    ADD CONSTRAINT `FK_fungible_equipo_3`
    FOREIGN KEY (`id_fungible`)
    REFERENCES `fungible` (`id_fungible`)
        ON DELETE CASCADE
        ON UPDATE CASCADE;
