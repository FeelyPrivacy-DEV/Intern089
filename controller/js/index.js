

$('#doclog').hide();
$('#patlog').hide();

$(document).on('click', '.al-r', function() {
    $('#docreg, #doclog').toggle(200);
    
});

$(document).on('click', '.al-p', function() {
    $('#patreg, #patlog').toggle(200);
    
});


$(document).on('keyup', '#search_doc', function() {
    let sq = $(this).val();
    let search = true;
  var xhr = new XMLHttpRequest();
  var url = "http://test.com/s/s/controller/php/index.php";

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        $("#searches").html(xhr.responseText);
    }
  };
  xhr.send(`search=${search}&sq=${sq}`);
})



