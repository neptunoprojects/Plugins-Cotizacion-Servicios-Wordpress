<?php



// SHORTCODE

function crear_shortcode_servicios()
{

    include(plugin_dir_path(__FILE__) . 'form_front_servicios.php');
}

add_shortcode('servicios', 'crear_shortcode_servicios');


// LISTADO DE SERVICIOS BACKEND 

function servicios_lista()
{
    include(plugin_dir_path(__FILE__) . 'servicios_tabla.php');
}


//ENVIO DE EMAIL

function envio_email($email, $titulo, $html)
{

    $email = $email;
    $title = $titulo;
    $html  = $html;

    $headers = array('Content-Type: text/html; charset=UTF-8');
    ob_start();

    include(plugin_dir_path(__FILE__) . '/template_email/email.php');

    $content = ob_get_clean();

    wp_mail($email, $title, $content, $headers);
}


function envio_email2($email, $titulo, $html, $json)
{

    $email = $email;
    $title = $titulo;
    $html  = $html;
    $json = $json;

    $headers = array('Content-Type: text/html; charset=UTF-8');
    ob_start();

    include(plugin_dir_path(__FILE__) . '/template_email/email2.php');

    $content = ob_get_clean();

    wp_mail($email, $title, $content, $headers);
}


// PROCESAR DATOS PARA LISTAR SERVICIOS A CLIENTE

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



// ENVIAR DATOS DE CLIENTE A BASE DE DATOS E EMAIL 

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

    // envio cliente
    envio_email($email, "Correo enviado desde: " . get_option("blogname"), "Hola " . $nombre . " Su mensaje ha sido recibido, pronto recibira una respuesta, muchas gracias." . get_option("sieurl"));

    // envio admin

    $linksolicitud = get_option("siteurl") . "/wp-admin/admin.php?page=servicios%2Finc%2Fsolicitudes_servicios.php";

    envio_email2(get_option('admin_email'), "Hola admin, hemos recibido una solicitud", " <h3>Datos de cliente: </h3> <b>Nombre:</b> $nombre <br/> <b>Email:</b> $email <br/> <b>Teléfono:</b> $telefono <br/> Para ver la solicitud entra <a href='$linksolicitud '>  aquí </a>",  $json);

    wp_send_json("OK");
}

add_action('wp_ajax_nopriv_enviar_data', 'enviar_data');

add_action('wp_ajax_enviar_data', 'enviar_data');


// BORRAR REGISTRO



function borrar_registro($tabla, $id)
{

    $tabla = $tabla;

    $id =  $id;

    global $wpdb;

    return  $wpdb->delete($wpdb->prefix . $tabla, array('id' => $id));
}


add_action('wp_ajax_nopriv_borrar_data', 'borrar_data');

add_action('wp_ajax_borrar_data', 'borrar_data');

add_action('init', 'do_output_buffer');
function do_output_buffer()
{
    ob_start();
}
