$(function () {
    $(".chosen-select").chosen({
        max_selected_options: 5,
        width: '100%'
    });



    const input = document.querySelector(".telefono");

    window.intlTelInput(input, {
        initialCountry: "auto",
        geoIpLookup: callback => {
            fetch("https://ipapi.co/json")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("us"));
        },
        strictMode: true,
        utilsScript: "./utils.js"
    });
})



document.getElementById('close-btn').addEventListener('click', function () {
    document.getElementById('overlay').classList.remove('is-visible');
    document.getElementById('modal').classList.remove('is-visible');
    document.querySelector('.total_servicios').innerHTML = "";
    document.querySelector('.error_servicios').innerHTML = "";
    document.querySelector('.error').innerHTML = "";

});

document.getElementById('overlay').addEventListener('click', function () {
    document.getElementById('overlay').classList.remove('is-visible');
    document.getElementById('modal').classList.remove('is-visible');
    document.querySelector('.total_servicios').innerHTML = "";
    document.querySelector('.error_servicios').innerHTML = "";
    document.querySelector('.error').innerHTML = "";
});