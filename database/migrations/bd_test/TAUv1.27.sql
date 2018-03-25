use inventario_test

-- Ampliamos los campos
ALTER TABLE `localizacion`
	CHANGE `Ubicacion` `Ubicacion` VARCHAR( 80 )
		CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL ,
	CHANGE `Descripcion` `Descripcion` VARCHAR( 255 )
		CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL ;
