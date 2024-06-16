<?php 

include(plugin_dir_path(__FILE__) . 'query_solicitudes.php');


?>

 
<div class="container">





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