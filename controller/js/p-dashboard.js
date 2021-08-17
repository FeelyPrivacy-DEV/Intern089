

    $(`.all-table  .Appointments`).css({'display': 'block'}).siblings().css({'display': 'none'});

  $(document).on('click', '.nav button', function() {
    $(this).addClass('active').siblings().removeClass('active');
    let id = $(this).text();
    $(`.all-table .${id}`).css({'display': 'block'}).siblings().css({'display': 'none'});
})