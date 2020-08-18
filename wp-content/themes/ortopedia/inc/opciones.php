<?php 
function ortopedia_ajustes(){

    add_menu_page( 'Ortopedia', 'Ortopedia Ajustes', 'administrator', 'ortopedia_ajustes', 'ortopedia_opciones', '',20);
    add_submenu_page( 'ortopedia_ajustes', 'Reservaciones', 'Reservaciones', 'administrator', 'ortopedia_reservaciones', 'ortopedia_reservaciones');

    //llamar a registro de las opciones de nuestro tema
    add_action('admin_init', 'ortopedia_registrar_opciones');
}

add_action('admin_menu', 'ortopedia_ajustes');

function ortopedia_registrar_opciones(){
    //registrar opciones, uno por campo
    register_setting('ortopedia_opciones_grupo', 'ortopedia_direccion');
    register_setting('ortopedia_opciones_grupo', 'ortopedia_telefono');

    register_setting('ortopedia_opciones_gmaps', 'ortopedia_gmap_latitud');
    register_setting('ortopedia_opciones_gmaps', 'ortopedia_gmap_longitud');
    register_setting('ortopedia_opciones_gmaps', 'ortopedia_gmap_zoom');
    register_setting('ortopedia_opciones_gmaps', 'ortopedia_gmap_apikey');
    
}

function ortopedia_opciones(){
?>
    <div class="wrap">
        <h1>Ajustes Ortopedia</h1>

        <?php 
            if (isset($_GET['tab'])) {
                $active_tab = $_GET['tab'];
            }else{
                $active_tab = '';
            }
 
         ?>

        <h2 class="nav-tab-wrapper">
            <a href="?page=ortopedia_ajustes&tab=tema" class="nav-tab <?php echo $active_tab == 'tema' ? 'nav-tab-active' : '' ?>">Ajustes</a>
            <a href="?page=ortopedia_ajustes&tab=gmaps" class="nav-tab <?php echo $active_tab == 'gmaps' ? 'nav-tab-active' : '' ?>">Google Maps</a>
        </h2>


        <form action="options.php" method="post">
            <?php if($active_tab == 'tema'): ?>
                <?php settings_fields('ortopedia_opciones_grupo'); ?>
                <?php do_settings_sections( 'ortopedia_opciones_grupo' ); ?>

                    <table class="form-table">

                        <tr valign ="top">
                            <th scope="row">Dirección</th>
                            <td><input type="text" name="ortopedia_direccion" value="<?php echo esc_attr(get_option('ortopedia_direccion'));?>" ></td>
                        </tr>

                        <tr valign ="top">
                            <th scope="row">Teléfono</th>  
                            <td><input type="text" name="ortopedia_telefono" value="<?php echo esc_attr(get_option('ortopedia_telefono'));?>" ></td>
                        </tr>

                    </table>
            <!-- SECCION DE CAMBIOS PARA MAPA --------------------------->
            <?php  else: ?>

                    <?php settings_fields('ortopedia_opciones_gmaps'); ?>
                    <?php do_settings_sections('ortopedia_opciones_gmaps'); ?>
                    <table class="form-table">

                        <tr valign ="top">
                            <th scope="row">Latitud</th>
                            <td><input type="text" name="ortopedia_gmap_latitud" value="<?php echo esc_attr(get_option('ortopedia_gmap_latitud'));?>" ></td>
                        </tr>

                        <tr valign ="top">
                            <th scope="row">Longitud</th>  
                            <td><input type="text" name="ortopedia_gmap_longitud" value="<?php echo esc_attr(get_option('ortopedia_gmap_longitud'));?>" ></td>
                        </tr>

                        <tr valign ="top">
                            <th scope="row">Zoom</th>  
                            <td><input type="text" name="ortopedia_gmap_zoom" value="<?php echo esc_attr(get_option('ortopedia_gmap_zoom'));?>" ></td>
                        </tr>

                        <tr valign ="top">
                            <th scope="row">API KEY</th>  
                            <td><input type="text" name="ortopedia_gmap_apikey" value="<?php echo esc_attr(get_option('ortopedia_gmap_apikey'));?>" ></td>
                        </tr>
                        

                    </table>
        <?php endif; ?>
        <?php submit_button(); ?>
        </form>
    </div>

<?php
}

function ortopedia_reservaciones(){

?>

    <div class="wrap">
        <h1>Reservaciones consultas:</h1>
        <table class="wp-list-table widefat striped">
                <thead>
                    <tr>
                        <th class="manage-column">ID</th>
                        <th class="manage-column">Nombre</th>
                        <th class="manage-column">Fecha de reserva</th>
                        <th class="manage-column">Correo</th>
                        <th class="manage-column">Teléfono</th>
                        <th class="manage-column">Mensaje</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                        global $wpdb;
                        $reservaciones = $wpdb->prefix . 'reservaciones';
                        $registros = $wpdb->get_results("SELECT * FROM $reservaciones", ARRAY_A);

                        foreach ($registros as $registro) {
                        
                    ?>
                        <tr>
                            <td><?php echo $registro['id']; ?></td>
                            <td><?php echo $registro['nombre']; ?></td>
                            <td><?php echo $registro['fecha']; ?></td>
                            <td><?php echo $registro['correo']; ?></td>
                            <td><?php echo $registro['telefono']; ?></td>
                            <td><?php echo $registro['mensaje']; ?></td>
                        </tr>

                    <?php } ?>
                </tbody>
        </table>
    </div>




<?php 
}
?>