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

    include(plugin_dir_path(__FILE__) . 'query_servicios.php');
?>

    <div class="container">

        Para usar el plugins, copie y pegue el shortcode donde necesite que aparezca [servicios]


        <h2>Servicios</h2>


        <table class="wp-list-table widefat fixed striped table-view-list pages" role="presentation">

            <thead>
                <th>
                    Servicio
                </th>

                <th>
                    Descripción
                </th>

                <th>
                    Precio
                </th>

                <th>
                    Acciones
                </th>
            </thead>
            <tbody>

                <?php foreach ($results as $row) : ?>

                    <tr class='form-field form-required'>
                        <td>

                            <?php echo $row->titulo; ?>
                        </td>


                        <td>

                            <?php echo $row->descripcion; ?>

                        </td>

                        <td>

                            <?php echo $row->precio; ?>

                        </td>

                        <td>
                            <div class="row">
                                <div class="col">
                                    <input type="submit" name="submit_image" value="Guardar" class="button button-primary" />
                                </div>
                            </div>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>

    </div>

<?php

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

    $json = $_POST["servicios"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];


    $db_table_name = $wpdb->prefix . 'servicios_cotizacion';

    $data = array('cliente' => $nombre, 'cliente_email' =>  $email, 'cliente_telefono' => $telefono, 'cotizacion' => $json);

    $format = array('%s', '%s', '%s', '%s', '%d');
    $wpdb->insert($db_table_name, $data, $format);

    wp_send_json("OK");
}

add_action('wp_ajax_nopriv_enviar_data', 'enviar_data');

add_action('wp_ajax_enviar_data', 'enviar_data');



?>