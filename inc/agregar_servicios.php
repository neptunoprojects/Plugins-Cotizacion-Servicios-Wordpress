<?php 

include(plugin_dir_path(__FILE__) . 'query_agregar_servicios.php');


?>

<div class="container">
    

    Para usar el plugins, copie y pegue el shortcode donde necesite que aparezca [servicios]

    <h2>Agregar Servicio</h2>

    <form method="post" enctype="multipart/form-data">

        <table class="form-table wp-list-table widefat fixed striped pages" role="presentation">
            <tbody>
                <tr class="form-field form-required">
                    <td>
                        <div class="row  mb-3">
                            <div class="col">
                                <label>Servicio</label>
                            </div>
                        </div>

                        <div class="row  mb-3">
                            <div class="col">
                                <input type="text" class="form-control" name="titulo" required/>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="form-field form-required">
                    <td>
                        <div class="row  mb-3">
                            <div class="col">
                                <label>Descripción</label>

                            </div>
                        </div>

                        <div class="row  mb-3">
                            <div class="col">
                                <textarea name="descripcion" required></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="form-field form-required">
                    <td>
                        <div class="row  mb-3">
                            <div class="col">
                                <label>Precio</label>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col">
                                <input type="text" class="form-control" name="precio" required/>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col">
                                <input type="submit" name="submit_image" value="Guardar" class="button button-primary" />
                            </div>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>

    </form>



</div>