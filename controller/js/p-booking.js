
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
    let prodtopay_check = true;
    console.log(doc_id);
    $('#proccedtopay').html(`
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    `);
    $('#proccedtopay').attr('disabled', true);
    
    var xhr = new XMLHttpRequest();
    var url = 'http://143.244.139.242/s/controller/php/add_e.php';
    
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            // $('#warn').text(xhr.responseText);
            // console.log(xhr.responseText);
            window.location.href = `http://143.244.139.242/s/view/p/checkout?id=${doc_id}&t=${s_time}&d=${date}`;
        }
    };  
    xhr.send(`prodtopay_check=${prodtopay_check}&date=${date}&doc_id=${doc_id}&s_time=${s_time}&e_time=${e_time}`);
}


// $(document).on('change', '#doc-select', function() {
//     doc_id = $(this).val();
    
//     let d_sel = 'd_sel';
//     var xhr = new XMLHttpRequest();
//     var url = 'http://143.244.139.242/s/controller/php/add_e.php';

//     xhr.open("POST", url, true);
//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhr.onreadystatechange = function() {
//         if(this.readyState == 4 && this.status == 200) {
//             $('#select_active').html(xhr.responseText);
//             // console.log(xhr.responseText);
//         }
//     };
//     xhr.send(`d_sel=${d_sel}&doc_id=${doc_id}`);
// });






$(document).on('click', '.select_active .time-slots .time-btn .btn-a', function() {
    $(this).css({'color':' rgb(0, 85, 255)', 'background': 'rgba(0, 132, 255, 0.233)'}).siblings().css({'color': 'black', 'background': 'rgba(228, 228, 228, 0.699)'});
    // $(this+'.select_active .time-slots button').addClass('bs-active').siblings().removeClass('bs-active');
  })
$(document).ready(function() {
})