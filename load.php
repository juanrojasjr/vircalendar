<?php

/** Valida si existe el archivo de configuración */
if (file_exists( 'core/config.php' )){
    //Envía al inicio de la aplicacion
    header( 'Location: app' );
	exit;
} else {
    //Envía a la configuración e instalación de la aplicación
    header( 'Location: core/setup' );
	exit;
};