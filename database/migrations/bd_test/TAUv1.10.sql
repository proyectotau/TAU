ALTER TABLE `inventario_test`.`notifica` DROP FOREIGN KEY `FK_notifica_2`;
ALTER TABLE `inventario_test`.`notifica` DROP INDEX `FK_notifica_2`;
ALTER TABLE `inventario_test`.`notifica` CHANGE COLUMN `id_recurso` `recurso` VARCHAR(100) DEFAULT NULL;
