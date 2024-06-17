<?php


// SHORTCODE

function crear_shortcode_servicios()
{
    include(plugin_dir_path(__FILE__) . 'query_servicios.php');
    include(plugin_dir_path(__FILE__) . 'form_front_servicios.php');
}

add_shortcode('servicios', 'crear_shortcode_servicios');

?>



<?php


// LISTADO DE SERVICIOS BACKEND 

function servicios_lista()
{
    include(plugin_dir_path(__FILE__) . 'servicios_tabla.php');
}






function procesar_data()
{


    global $wpdb;

    $servicios = $_POST["servicios"];


    $servicios_array = implode(",", $servicios);



    $servicios_ids = array();

    $results = $wpdb->get_results("SELECT * FROM  {$wpdb->prefix}servicios WHERE id IN ($servicios_array)");

    foreach ($results as $row => $value) :
        array_push($servicios_ids, $value);
    endforeach;

    $return = array(
        $servicios_ids
    );

    wp_send_json($return);
}

add_action('wp_ajax_nopriv_procesar_data', 'procesar_data');
add_action('wp_ajax_procesar_data', 'procesar_data');




function enviar_data()
{

    global $wpdb;


    $servicios = $_POST["servicios"];

    $json = implode(",", $servicios);


    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];




    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        wp_send_json("error_email");
        die();
    }  


    $db_table_name = $wpdb->prefix . 'servicios_cotizacion';




    $data = array('cliente' => $nombre, 'cliente_email' =>  $email, 'cliente_telefono' => $telefono, 'cotizacion' => $json);

    $format = array('%s', '%s', '%s', '%s', '%d');
    $wpdb->insert($db_table_name, $data, $format);

    wp_send_json("OK");
}

add_action('wp_ajax_nopriv_enviar_data', 'enviar_data');

add_action('wp_ajax_enviar_data', 'enviar_data');



?>