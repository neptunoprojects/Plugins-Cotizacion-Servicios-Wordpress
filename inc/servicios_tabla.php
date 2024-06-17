<?php include(plugin_dir_path(__FILE__) . 'querys_paginacion.php');
global $results;
query("servicios", 10);
?>

<div class="container wrap">

    <h4>Para usar el plugins, copie y pegue el shortcode donde necesite que aparezca [servicios]</h4>


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

            <?php
            endforeach;
            ?>

        </tbody>
    </table>


    <?php
    paginacion("servicios", 10);
    ?>


</div>