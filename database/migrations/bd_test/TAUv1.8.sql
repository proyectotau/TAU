--
-- Modificaciones a KERNEL
--

use tau_test;

ALTER TABLE `tau_test`.`localizacion`
 DROP FOREIGN KEY `localizacion_ibfk_1`;

ALTER TABLE `tau_test`.`localizacion`
 DROP FOREIGN KEY `localizacion_ibfk_2`;

ALTER TABLE `tau_test`.`localizacion` ADD CONSTRAINT `localizacion_ibfk_1` FOREIGN KEY `localizacion_ibfk_1` (`ID_PANEL`)
    REFERENCES `panel` (`ID_PANEL`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
 ADD CONSTRAINT `localizacion_ibfk_2` FOREIGN KEY `localizacion_ibfk_2` (`ID_MODULO`)
    REFERENCES `modulo` (`ID_MODULO`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;


ALTER TABLE `tau_test`.`panel`
 DROP FOREIGN KEY `panel_ibfk_1`;

ALTER TABLE `tau_test`.`panel` ADD CONSTRAINT `panel_ibfk_1` FOREIGN KEY `panel_ibfk_1` (`ID_USUARIO`)
    REFERENCES `usuario` (`ID_USUARIO`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `tau_test`.`usuario_grupo`
 DROP FOREIGN KEY `usuario_grupo_ibfk_1`;

ALTER TABLE `tau_test`.`usuario_grupo` ADD CONSTRAINT `usuario_grupo_ibfk_1` FOREIGN KEY `usuario_grupo_ibfk_1` (`ID_USUARIO`)
    REFERENCES `usuario` (`ID_USUARIO`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
