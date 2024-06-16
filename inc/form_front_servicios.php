<div class="overlay" id="overlay"></div>
<div class="modal" id="modal">
    <button class="modal-close-btn" id="close-btn">X</button>
    <div class="total_servicios">
        <p></p>
    </div>

    <form action='' method=''>
        <input type='text' name='nombre' />
        <input type='email' name='email' />
        <input type='hidden' name='json_servicios' class='json_servicios' />
        <button type=' submit'>Pedir cotización</button>
    </form>
</div>



<div class="servicios_shortcode">


    <select class="servicios_campo chosen-select" data-placeholder="Select Categories" multiple tabindex="8" name="servicios[]">
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


                    $(".json_servicios").val(d);

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
</script>