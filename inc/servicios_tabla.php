<?php include(plugin_dir_path(__FILE__) . 'querys_paginacion.php');
global $results;
query("servicios", 10);



if(isset($_POST["id"])){
if (
    !isset($_POST['nonce_campo'])
    || !wp_verify_nonce($_POST['nonce_campo'], 'borrar')
) {
    print 'No se ha verificado el nonce.';
    exit;
} else {
    borrar_registro("servicios", $_POST['id']);

    header("location: " . $_SERVER['REQUEST_URI']);
}
}



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

                        <?php echo esc_html($row->titulo); ?>
                    </td>


                    <td>

                        <?php echo esc_html($row->descripcion); ?>

                    </td>

                    <td>

                        <?php echo esc_html($row->precio); ?>

                    </td>

                    <td>
                        <div class="row">
                            <div class="col">

                                <form method="post">


                                    <input type="hidden" value="<?php echo esc_html($row->id); ?>" name="id" />
                                    <input type="submit" value="Borrar" class="button button-primary" />

                                    <?php wp_nonce_field('borrar', 'nonce_campo'); ?>
                                </form>
                                </form>
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


    <style>
        a.page-numbers,
        span.page-numbers.current {
            padding: 0 10px;
            font-size: 18px;
        }
    </style>
</div>