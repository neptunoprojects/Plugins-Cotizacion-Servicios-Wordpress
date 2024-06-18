<?php

/*
Plugin Name: Servicios
Plugin Uri: https://tuapp.shop
Description: 1.0
Author: Jaicer
License: GPL2

*/


if (!defined('ABSPATH')) {
    exit;
}


// ACTIVACIÓN DEL PLUGINS Y CREACIÓN DE TABLA

function Activar()
{
    global $wpdb;

    $tabla_servicios = $wpdb->prefix . 'servicios';
    $tabla_cotizacion = $wpdb->prefix . 'servicios_cotizacion';


    if ($wpdb->get_var("show tables like '$tabla_servicios' ") != $tabla_servicios) {

        $sql = "CREATE TABLE IF NOT EXISTS `" . str_replace('`', '', $tabla_servicios) . "`(
        id int(11) NOT NULL auto_increment,
        titulo varchar(200) NOT NULL,
        precio float NOT NULL,
        descripcion varchar(1000) NOT NULL,
        PRIMARY KEY id (id)        
    );";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }



    if ($wpdb->get_var("show tables like '$tabla_cotizacion' ") != $tabla_cotizacion) {

        $sql = "CREATE TABLE IF NOT EXISTS `" . str_replace('`', '', $tabla_cotizacion) . "`(
        id int(11) NOT NULL auto_increment,
        cliente varchar(200) NOT NULL,
        cliente_email varchar(200) NOT NULL,
        cliente_telefono varchar(200) NOT NULL,
        cotizacion TEXT NOT NULL,
        PRIMARY KEY id (id)        
    );";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}


register_activation_hook(__FILE__, 'Activar');


//DESINSTALAR PLUGIN

function servicio_plugin_uninstall()
{
 
    global $wpdb;
    $tabla_servicios = $wpdb->prefix . 'servicios';
    $tabla_cotizacion = $wpdb->prefix . 'servicios_cotizacion';

    $wpdb->query("DROP TABLE IF EXISTS $tabla_servicios");
    $wpdb->query("DROP TABLE IF EXISTS $tabla_cotizacion");
}

register_uninstall_hook(__FILE__, 'servicio_plugin_uninstall');





// CREACIÓN DEL MENU EN EL ADMIN

add_action("admin_menu", "servicios_ajuste");



function servicios_ajuste()
{
    add_menu_page(
        "Servicios",
        "Servicios",
        "manage_options",
        "servicios",
        "servicios_lista",
        plugins_url('assets/img/performance.png', __FILE__),
    );


    add_submenu_page(
        "servicios",
        "Servicios",
        "Agregar servicios",
        "manage_options",
        plugin_dir_path(__file__) . "inc/agregar_servicios.php",
        null,
        1

    );


    add_submenu_page(
        "servicios",
        "Servicios",
        "Solicitudes",
        "manage_options",
        plugin_dir_path(__file__) . "inc/solicitudes_servicios.php",
        null,
        1

    );


}



// FUNCIONES

include(plugin_dir_path(__FILE__) . 'inc/funciones.php');


// CARGA CSS FRONTEND


function estilos_servicios($hook)
{
    wp_register_style('mi_css', plugins_url('assets/css/estilo.css',  __FILE__));
    wp_enqueue_style('mi_css');
    wp_register_style('chosen', plugins_url('assets/css/chosen.css', __FILE__));
    wp_enqueue_style('chosen');
    wp_register_style('tel', plugins_url('assets/css/intlTelInput.css', __FILE__));
    wp_enqueue_style('tel');
}


add_action('wp_enqueue_scripts', 'estilos_servicios');


// CARGA JS FRONTEND


function servicios_javascripts()
{
    wp_enqueue_script('jquery_js', plugins_url('assets/js/jquery-3.3.1.min.js', __FILE__));
    wp_enqueue_script('chosen_js', plugins_url('assets/js/chosen.jquery.min.js', __FILE__));
    wp_enqueue_script('main_js', plugins_url('assets/js/main.js', __FILE__));
    wp_enqueue_script('tel_js', plugins_url('assets/js/intlTelInput.min.js', __FILE__));
 
}

add_action('wp_footer', 'servicios_javascripts', 5);

?>