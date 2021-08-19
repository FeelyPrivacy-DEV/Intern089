
$('#doclog').hide();
$('#patlog').hide();

$(document).on('click', '.al-r', function() {
    $('#docreg, #doclog').toggle(200);

});

$(document).on('click', '.al-p', function() {
    $('#patreg, #patlog').toggle(200);

});








// $(document).on('click', '#al-l', function() {
//     $('#docreg').css({'display': 'none !important'});
//     $('#doclog').css({'display': 'block !important'});
// });