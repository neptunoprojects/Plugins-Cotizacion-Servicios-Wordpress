$(function () {
    $(".chosen-select").chosen({
        max_selected_options: 5,
        width: '100%'
    });

})





document.getElementById('close-btn').addEventListener('click', function () {
    document.getElementById('overlay').classList.remove('is-visible');
    document.getElementById('modal').classList.remove('is-visible');
});
document.getElementById('overlay').addEventListener('click', function () {
    document.getElementById('overlay').classList.remove('is-visible');
    document.getElementById('modal').classList.remove('is-visible');
});