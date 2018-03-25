-- Modificación para la gestión de recursos
use tau_test
ALTER TABLE `inventario_test`.`usuario_perfil_tempo` ADD COLUMN `solicita` VARCHAR(150) DEFAULT '' AFTER `hecho_por`;
ALTER TABLE `inventario_test`.`usuario_perfil_tempo` ADD COLUMN `valida` VARCHAR(150) DEFAULT '' AFTER `solicita`;

