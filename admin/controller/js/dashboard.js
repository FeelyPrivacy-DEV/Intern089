
function disableIt(i) {
    if($(`#check${i}`).val() == 1) {
        $(`#check${i}`).val('0');
        let pre_p_details = true;
        var xhr = new XMLHttpRequest();
        var url = "http://localhost/s/s/controller/php/add_m.php";

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
            if (xhr.responseText == "") {
                $("#p_details").html(
                '<h5 class="text-danger text-center">No slots found</h5>'
                );
            } else {
                $("#p_details").html(xhr.responseText);
            }
            }
        };
        xhr.send(`pre_p_details=${pre_p_details}`);
    }
    else {
        $(`#check${i}`).val('1');
        let pre_p_details = true;
        var xhr = new XMLHttpRequest();
        var url = "http://localhost/s/s/controller/php/add_m.php";

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
            if (xhr.responseText == "") {
                $("#p_details").html(
                '<h5 class="text-danger text-center">No slots found</h5>'
                );
            } else {
                $("#p_details").html(xhr.responseText);
            }
            }
        };
        xhr.send(`pre_p_details=${pre_p_details}`);
    }   

} 


$(document).on('click', '#btn_side', function() {
    
})

$(document).ready(function(){ 
    $('#app_table').DataTable();
    $('#doc_table').DataTable();
    $('#pat_table').DataTable();
});

        