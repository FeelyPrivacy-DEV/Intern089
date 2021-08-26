

$('#doclog').hide();
$('#patlog').hide();

$(document).on('click', '.al-r', function() {
    $('#docreg, #doclog').toggle(200);
    
});

$(document).on('click', '.al-p', function() {
    $('#patreg, #patlog').toggle(200);
    
});

var s = [];

$(document).on('keyup', '#search_doc', function() {
    let sq = $(this).val();
    let search = true;
    var xhr = new XMLHttpRequest();
    var url = "http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/controller/php/index.php";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
          s.push(xhr.responseText);
      }
    };
    xhr.send(`search=${search}&sq=${sq}`);
})

// console.log(s);
    
// $(document).ready(function(){
//   $("#search_doc").autocomplete({
//       source: function(req, res) {
        
//       },
//       minLength:1,
//       selectFirst: true
//   });
// });