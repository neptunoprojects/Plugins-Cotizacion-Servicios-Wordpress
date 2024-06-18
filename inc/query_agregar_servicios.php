<?php

if (isset($_POST["titulo"], $_POST["descripcion"], $_POST["precio"])) :
    global $wpdb;
    $db_table_name = $wpdb->prefix . 'servicios';
    $data = array('titulo' => $_POST["titulo"], 'descripcion' => $_POST["descripcion"], 'precio' => $_POST["precio"]);
    $format = array('%s', '%s', '%d');
    $wpdb->insert($db_table_name, $data, $format);
    $results = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}servicios where id = $wpdb->insert_id", OBJECT);
    if ($results) :
        echo "<div id='message' class='notice is-dismissible updated'>";
        echo "<p>Servicio" . " " . $results->titulo . " " . "agregado</p>";
        echo "</div>";
    endif;
endif;

?>