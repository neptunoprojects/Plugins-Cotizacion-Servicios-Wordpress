<?php

// QUERY SELECT 

include(plugin_dir_path(__FILE__) . 'querys_paginacion.php');
global $results;
query("servicios_cotizacion", 10);


if (isset($_REQUEST['id'])) :

    if ((wp_verify_nonce($_REQUEST['nonce'], 'borrar-nonce'))) :

        
        borrar_registro("servicios_cotizacion",$_REQUEST['id']);
  
        header("location: " . $_SERVER['REQUEST_URI']);
    endif;

endif;
?>


<div class="container wrap">

    <h2>Servicios</h2>


    <table class="wp-list-table widefat fixed striped table-view-list pages" role="presentation">

        <thead>
            <th>
                Cliente
            </th>

            <th>
                Email
            </th>

            <th>
                Teléfono
            </th>

            <th>
                Servicios
            </th>

            <th>
                Acciones
            </th>
        </thead>
        <tbody>

            <?php foreach ($results as $row) : ?>

                <tr class='form-field form-required'>
                    <td>

                        <?php echo $row->cliente; ?>
                    </td>


                    <td>

                        <?php echo $row->cliente_email; ?>

                    </td>

                    <td>

                        <?php echo $row->cliente_telefono; ?>

                    </td>

                    <td>
                        <?php


                        $results2 = $wpdb->get_results("SELECT * FROM  {$wpdb->prefix}servicios WHERE id IN ($row->cotizacion)");

                        $array_precio = array();

                        foreach ($results2 as $row2 => $value) :
                            echo $value->titulo .  " <b>USD" . number_format($value->precio, 2, '.', ',') . "</b>" . "<br/>";

                            array_push($array_precio, $value->precio);
                        endforeach;

                        echo "<b>Total:</b> " . array_sum($array_precio);
                        ?>
                    </td>

                    <td>
                        <div class="row">
                            <div class="col">

                                <form method="post">
                                    <?php wp_nonce_field('borrar-nonce', 'nonce'); ?>
                                    <input type="hidden" value="<?php echo $row->id; ?>" name="id" />
                                    <input type="submit" value="Borrar" class="button button-primary" />
                                </form>
                            </div>
                        </div>
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

    <?php
    paginacion("servicios_cotizacion", 10);
    ?>


    <script>
        function borrar_registro(id) {

            data = {
                'action': 'borrar_registro',
                id: id
            };

            jQuery.ajax({
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                data: data,
                method: "POST",

                success: function(data) {
                    if (data) {

                        alert("Borrado con éxito")

                    }

                }
            });
        }
    </script>



    <style>
        a.page-numbers,
        span.page-numbers.current {
            padding: 0 10px;
            font-size: 18px;
        }
    </style>
</div>