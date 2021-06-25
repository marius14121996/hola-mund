<?php

    if( !file_exists('config.php') ){
        die( 'ERROR: no existe el config.php' );
    }
    require('config.php');

    //Fechas a español o si quiero tener en cuenta todo a español
    setlocale( LC_TIME, SITE_LANG );
    date_default_timezone_set( SITE_TIMEZONE ); 

    $app_db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT );
    //si la conexión a la bbdd ha ido mal, devuelve un false, sino devuelve el recurso
    if(!$app_db){
        die('Error al conectar con la base de datos');
    }

    //El init no solo nos va a servir para configurar cosas, sino también para requerir cualquier archivo que sea común a toda la aplicación, como es en este caso el archivo /inc/posts.php
    require('inc/posts.php');
    require('inc/helpers.php');