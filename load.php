<?php

/** Valida si existe el archivo de configuración */
if (file_exists( 'core/config.php' )){

    /** Define ABSPATH as this file's directory */
    $_SERVER['CONFIG'] = true;
    if ( !defined( 'CONFIG' ) ) {
        define( 'CONFIG', true );
    }

    //Envía al inicio de la aplicacion
    header( 'Location: app' );
	exit;
} else {
    //Envía a la configuración e instalación de la aplicación
    header( 'Location: core/setup' );
	exit;
};