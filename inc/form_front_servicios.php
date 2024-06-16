<div class="overlay" id="overlay"></div>
<div class="modal" id="modal">
    <button class="modal-close-btn" id="close-btn">X</button>
    <div class="total_servicios">

        <p></p>
    </div>


    <input type='text' class='nombre' placeholder="Nombre y Apellido" />
    <input type='email' class='email' placeholder="Email" />
    <input type='text' class='telefono' placeholder="Teléfono" />
    <input type='hidden' class='cotizar' />
    <button class="btn_servicios" onclick="Enviar_info()">Enviar</button>

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


                    document.getElementById('overlay').classList.add('is-visible');
                    document.getElementById('modal').classList.add('is-visible');

                    const d = [];

                    for (const [key, value] of Object.entries(data)) {
                        d.push(JSON.stringify(value))
                    }



                    var obj = JSON.parse(d);

                    $(".cotizar").val(d);

                    $(".total_servicios").empty()
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
                if (data) {


                    $(".total_servicios").html('Enviado con exito');
   
                    setTimeout("location.href = '<?php global $wp; echo home_url( $wp->request );?>';",2000);


                } else {
                    $(".total_servicios").html('Ocurrio un problema');
                }


            }
        });
    }
</script>