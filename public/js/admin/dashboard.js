
function disableIt(i) {
    if($(`#check${i}`).val() == 1) {
        $(`#check${i}`).val('0');
        let check1 = true;
        var xhr = new XMLHttpRequest();
        var url = "/loginDisable";

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send(`id=${i}`);
    }
    else {
        $(`#check${i}`).val('1');
        let check2 = true;
        var xhr = new XMLHttpRequest();
        var url = "/loginEnable";

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send(`id=${i}`);
    }

}

// allow it

function AllowIt(i) {
    $(`#checkAllow${i}`).val('1');
    $(`#trid${i}`).fadeOut(2000, function() {
        $(`#trid${i}`).remove();
        // $(".pend_doc_table").load(location.href + " .pend_doc_table");
    });

    let allowit = true;
    var xhr = new XMLHttpRequest();
    var url = "/approveDoctor";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            $('#warn').text(xhr.responseText);
        }
    };
    xhr.send(`id=${i}`);
}


function del(i) {

    let delt = true;
    var xhr = new XMLHttpRequest();
    var url = "https://test.feelyprivacy.com/s/admin/controller/php/dashboard.php";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send(`del=${delt}&id=${i}`);
}


$(document).on('click', '#btn_side', function() {

})

$(document).ready(function(){
    $('#app_table').DataTable();
    $('#doc_table').DataTable();
    $('#pat_table').DataTable();
});

