<?php include(plugin_dir_path(__FILE__) . 'querys_paginacion.php');
global $results;
query("servicios_cotizacion", 10);
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

                        foreach ($results2 as $row => $value) :
                            echo $value->titulo .  " <b>USD" . number_format($value->precio, 2, '.', ',') . "</b>" . "<br/>";
                        endforeach;

                        ?>
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

    <?php
    paginacion("servicios_cotizacion", 10);
    ?>
</div>