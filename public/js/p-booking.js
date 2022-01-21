
$(document).on('click', '.sidebtn', function() {
    $('.side-nav').toggle(200);
});



// var date, next_date
var date, date_id, doc_id, s_time, e_time, timeslot;
var globalVariable = {
     date, date_id, doc_id, s_time, e_time, timeslot
}
$('#proccedtopay').attr('disabled', true);

function select_check() {
    if(s_time == '' && e_time == '' && doc_id == '' && date == '') {
        $('#proccedtopay').attr('disabled', true);
        return false;
    }
    else {
        $('#proccedtopay').attr('disabled', false);
        return true;
    }
}
function prodtopay(i, j, s_t, e_t, did) {
    select_check();
    s_time = s_t
    e_time = e_t
    doc_id = did
    timeslot = s_t + ' - ' + e_t;
    // $(`#btn${j}${j}`).addClass('bs-active');
    // $(`.select_active #btn${j}${i}`).removeClass('bs-active');
    date = i;
    timeslot = $(`#btn${j}${j}`).text();
}
    
function proccedtopay() {
    $('#proccedtopay').html(`
        <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Loading...
    `);
    $('#proccedtopay').attr('disabled', true);


    var xhr = new XMLHttpRequest();
    var url = '/proccedToPay';

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            // if(xhr.responseText == true) {
                window.location.href = xhr.responseText;
            // }
            // else {
                // $('#proccedtopay').text('Procces to Pay');
                // $('#proccedtopay').attr('disabled', false);
                // $('#warn').html(`<p class="text-center text-danger">${xhr.responseText}</p>`);
            // }
        }
    };
    xhr.send(`date=${date}&doc_id=${doc_id}&s_time=${s_time}&e_time=${e_time}`);
}





$(document).on('click', '.select_active .time-slots .time-btn .btn-a', function() {
    $('.select_active .time-slots .time-btn .btn-a').css({'color': 'black', 'background': 'rgba(228, 228, 228, 0.699)'});
    $(this).css({'color':' rgb(0, 85, 255)', 'background': 'rgba(0, 132, 255, 0.233)'})
    // $(this+'.select_active .time-slots button').addClass('bs-active').siblings().removeClass('bs-active');
})

