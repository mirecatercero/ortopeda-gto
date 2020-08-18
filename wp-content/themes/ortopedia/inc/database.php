<?php 
    //inicializa la creacion de las tablas nuevas
    function ortopedia_database(){
        //wpdb nos da los métodos para trabajar con tablas
        global $wpdb;
        //agregamos una version
        global $ortopedia_dbversion;
        $ortopedia_dbversion = '0.4';
        //obtenemos el prefijo
        $tabla = $wpdb->prefix . 'reservaciones';
        //obtenemos el collation de la instalacion
        $charset_collate = $wpdb->get_charset_collate();

        //agregamos la estructura de la base de datos
        $sql = "CREATE TABLE $tabla (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            nombre varchar(50) NOT NULL,
            fecha datetime NOT NULL,
            correo varchar(50) DEFAULT '' NOT NULL,
            telefono varchar(10) NOT NULL,
            mensaje longtext NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        //se necesita dbdelta para ejecutar el sql y está en la siguiente direccion
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        //agregamos la version de la BD para compararla con futuras actualizaciones
        add_option('ortopedia_dbversion', $ortopedia_dbversion);

    //ACTUALIZAR EN CASO DE SER NECESARIO
        
        $version_actual = get_option('ortopedia_dbversion');


            //comparamos las dos versiones
        if ($ortopedia_dbversion != $version_actual) {
            $tabla = $wpdb->prefix . 'reservaciones';

        $charset_collate = $wpdb->get_charset_collate();
            //aquí se realizan las actualizaciones  
        $sql = "CREATE TABLE $tabla (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            nombre varchar(50) NOT NULL,
            fecha datetime NOT NULL,
            correo varchar(50) DEFAULT '' NOT NULL,
            telefono varchar(10) NOT NULL,
            mensaje longtext NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        //actualizamos a la version actual en caso de que asi sea
        update_option('ortopedia_dbversion', $ortopedia_dbversion);

        }

    }

add_action('after_setup_theme', 'ortopedia_database');

    //funcion para comprobar que la version instalada es igual a la base de datos nueva
    function ortopediadb_revisar(){
        global $ortopedia_dbversion;
        if (get_site_option('ortopedia_dbversion') != $ortopedia_dbversion) {
            ortopedia_database();
        }
    }

add_action('pluggins_loaded', 'ortopediadb_revisar');

?>