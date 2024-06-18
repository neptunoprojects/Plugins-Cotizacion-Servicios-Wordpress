<?php include(plugin_dir_path(__FILE__) . 'querys_paginacion.php');
global $results;
queryall("servicios");
?>


<div class="overlay" id="overlay"></div>
<div class="modal" id="modal">
    <button class="modal-close-btn" id="close-btn">X</button>

    <div class="error"></div>

    <div class="error_servicios"></div>
    <div class="total_servicios">

        <p></p>
    </div>

    <div class="campos">
        <input type='text' class='nombre' placeholder="Nombre y Apellido" />
        <input type='email' class='email' placeholder="Email" />
        <input type='tel' class='telefono' />
        <input type='hidden' class='cotizar' />
        <button class="btn_servicios" onclick="Enviar_info()">Enviar</button>
    </div>
</div>



<div class="servicios_shortcode">


    <select class="servicios_campo chosen-select" require data-placeholder="Seleccione un Servicio" multiple tabindex="8" name="servicios[]">
        <?php foreach ($results as $row) :
            echo "<option value='$row->id'>" .  $row->titulo . "</option>";
        endforeach;
        ?>
    </select>
    <button class="btn_servicios" onclick="Servicios()">Cotizar</button>

</div>


<script>
    function Servicios() {




        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });

        var servicios = $(".servicios_campo").val();

        if (servicios == "") {
            document.querySelector('.campos').classList.remove('is-visible');
            document.getElementById('overlay').classList.add('is-visible');
            document.getElementById('modal').classList.add('is-visible', 'bg');
            $(".error_servicios").html('<p>Debe seleccionar al menos un Servicio</p>');
            return;
        }

        data = {
            'action': 'procesar_data',
            servicios: servicios
        };

        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: data,
            method: "POST",

            success: function(data) {
                if (data) {

                    document.querySelector('.campos').classList.add('is-visible');
                    document.getElementById('overlay').classList.add('is-visible');
                    document.getElementById('modal').classList.add('is-visible');



                    const d = [];

                    for (const [key, value] of Object.entries(data)) {
                        d.push(JSON.stringify(value))
                    }



                    var obj = JSON.parse(d);

                    $(".cotizar").val(d);

                    for (var index = 0; index < obj.length; index++) {
                        $(".total_servicios").append("<li>" + "<b>" + obj[index].titulo + "</b>" + "<p><b>Precio: " + formatter.format(obj[index].precio) +
                            "</b></p>" + "</li>");
                    }


                } else {
                    $(".total_servicios").html('Ocurrio un problema');
                }


            }
        });
    }




    function Enviar_info() {

        var servicios_json = $(".cotizar").val();
        var nombre = $(".nombre").val();
        var email = $(".email").val();
        var telefono = $(".telefono").val();



        if (nombre == "" || email == "" || telefono == "") {
            $(".error").html('<p>Llene los campos requeridos</p>');
            return;
        }



        var obj = JSON.parse(servicios_json);
        const arrayservicios = [];

        for (var index = 0; index < obj.length; index++) {
            arrayservicios.push(obj[index].id);

        }

        var servicios = arrayservicios;


        data = {
            'action': 'enviar_data',
            servicios: servicios,
            nombre: nombre,
            email: email,
            telefono: telefono
        };
        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: data,
            method: "POST",

            success: function(data) {

                if (data == "error_email") {
                    $(".error").html('<p>Email incorrecto</p>');
                    return;
                }


                if (data) {

                    $(".total_servicios").html('<p class="exito">Enviado con exito</p>');
                    $(".error").html('');


                    function cerrar_modal() {
                        document.getElementById('overlay').classList.remove('is-visible');
                        document.getElementById('modal').classList.remove('is-visible');
                        $(".total_servicios").html('');
                    }

                    setTimeout(cerrar_modal, 2000);
                   


                } else {
                    $(".total_servicios").html('Ocurrio un problema');
                }


            }
        });
    }
</script>