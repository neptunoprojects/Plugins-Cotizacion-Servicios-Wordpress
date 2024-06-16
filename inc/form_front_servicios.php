<div class="overlay" id="overlay"></div>
<div class="modal" id="modal">
    <button class="modal-close-btn" id="close-btn">X</button>
    <div class="total_servicios">
        <p></p>
    </div>


    <input type='text' class='nombre' />
    <input type='email' class='email' />
    <input type='text' class='telefono' />
    <input type='hidden' class='cotizar' />
    <button onclick="Enviar_info()">Pedir cotización</button>

</div>



<div class="servicios_shortcode">


    <select class="servicios_campo chosen-select" require data-placeholder="Select Categories" multiple tabindex="8" name="servicios[]">
        <?php foreach ($results as $row) :
            echo "<option value='$row->id'>" .  $row->titulo . "</option>";
        endforeach;
        ?>
    </select>
    <button onclick="Servicios()">Enviar</button>

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
                        $(".total_servicios").append("<li>" + "<b>" + obj[index].titulo + "</b>" + "<p>" + obj[index].descripcion + "</p>" + "<p>" + formatter.format(obj[index].precio) +
                            "</p>" + "</li>");
                    }


                } else {
                    $(".total_servicios").html('Ocurrio un problema');
                }


            }
        });
    }








    function Enviar_info() {

        var servicios = $(".cotizar").val();
        var nombre = $(".nombre").val();
        var email = $(".email").val();
        var telefono = $(".telefono").val();


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
                    document.getElementById('overlay').classList.remove('is-visible');
                    document.getElementById('modal').classList.remove('is-visible');

                } else {
                    $(".total_servicios").html('Ocurrio un problema');
                }


            }
        });
    }
</script>