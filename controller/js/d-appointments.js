$(document).on('click', '.sidebtn', function() {
    $('.side-nav').toggle(200);
});
 

// accept 
function accept(pid, date, date_ind, i) {
    $(`#can${i}`).removeAttr('disabled')
    $(`#can${i}`).html('<i class="bi bi-x"></i> Cancel');
    $(`#acc${i}`).attr('disabled', true)
    $(`#acc${i}`).html('Accepted');
    let accept = true;
    var xhr = new XMLHttpRequest();
    var url = "https://test.feelyprivacy.com/s/controller/php/add_m.php";
  
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        
      }
    };
    xhr.send(`accept=${accept}&pid=${pid}&date=${date}&date_ind=${date_ind}`);
  }
  
  
  // cancel
  function cancel(pid, date, date_ind, i) {
    $(`#acc${i}`).removeAttr('disabled', false)
    $(`#acc${i}`).html('<i class="bi bi-check2"></i> Accept');
    $(`#can${i}`).attr('disabled', true)
    $(`#can${i}`).html('Cancelled');
    let cancelled = true;
    var xhr = new XMLHttpRequest();
    var url = "https://test.feelyprivacy.com/s/controller/php/add_m.php";
  
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        
      }
    };
    xhr.send(`cancelled=${cancelled}&pid=${pid}&date=${date}&date_ind=${date_ind}`);
  }