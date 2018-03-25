use inventario_test

UPDATE `equipo` SET
`Nombre` = NULL
WHERE `Nombre` = "";

UPDATE `equipo` SET
`Inventario` = NULL
WHERE `Inventario` = "";

ALTER TABLE `equipo`
	ADD UNIQUE (`Nombre`);

ALTER TABLE `equipo`
	ADD UNIQUE (`Inventario`);
