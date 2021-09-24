

$(document).on('click', '.sidebtn', function() {
    $('.side-nav').toggle(200);
});



$(document).on('click', '#today', function() {
    $.ajax({
        url: "/todaysAppoinment",
        type: "GET",
        success: function(data) {
            if (data == "") {
                $("#p_details").html(
                    '<h5 class="text-danger text-center">No slots found</h5>'
                );
            } else {
                $("#p_details").html(data);
            }
        }
    });

});

$(document).on('click', '#upcoming', function() {
    $.ajax({
        url: "/upcomingAppoinment",
        type: "GET",
        success: function(data) {
            if (data == "") {
                $("#p_details").html(
                    '<h5 class="text-danger text-center">No slots found</h5>'
                );
            } else {
                $("#p_details").html(data);
            }
        }
    });
});



// accept appoinment
function accept(pid, date, date_ind, i) {
  $(`#can${i}`).removeAttr('disabled')
  $(`#can${i}`).html('<i class="bi bi-x"></i> Cancel');
  $(`#acc${i}`).attr('disabled', true)
  $(`#acc${i}`).html('Accepted');

    $.ajax({
        url: "/acceptAppoinment",
        type: "POST",
        data: {
            pid: pid,
            date: date,
            date_ind: date_ind
        },
        success: function(data) {
            // console.log(data);
        }
    });

}


// cancel appoinment
function cancel(pid, date, date_ind, i) {
  $(`#acc${i}`).removeAttr('disabled', false)
  $(`#acc${i}`).html('<i class="bi bi-check2"></i> Accept');
  $(`#can${i}`).attr('disabled', true)
  $(`#can${i}`).html('Cancelled');

    $.ajax({
        url: "/cancelAppoinment",
        type: "POST",
        data: {
            pid: pid,
            date: date,
            date_ind: date_ind
        },
        success: function(data) {
            // console.log(data);
        }
    });
}

// video call link sending
function link_send(pid, date, date_ind, i) {
    let link = $(`#video_call_link${i}`).val();

    $.ajax({
        url: "/videoCallLinkSend",
        type: "POST",
        data: {
            pid: pid,
            date: date,
            date_ind: date_ind,
            link: link
        },
        success: function(data) {
            // console.log(data);
            $('.modal_warn').html(`<h6 class="text-primary">Link has been sent !</p>`)
        }
    });
}


$(document).on('click', '.nav button', function() {
  $(this).addClass('active').siblings().removeClass('active');
});
