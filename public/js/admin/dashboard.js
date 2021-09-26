

// disabling account of doctor (login disable)
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

// allow the doctor
function AllowIt(i) {
    $(`#checkAllow${i}`).val('1');
    $(`#removeUnderReview${i}`).removeAttr('checked');
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
            pend_doc()
        }
    };
    xhr.send(`id=${i}`);
}

// adding under review the doctor
function UnderReview(i) {
    $(`#removeReject${i}`).removeAttr('checked');
    var xhr = new XMLHttpRequest();
    var url = "/UnderReviewDoctor";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // pend_doc();
        }
    };
    xhr.send(`id=${i}`);
}

// removing doctor from under_review
function removeUnderReview(i) {
    var xhr = new XMLHttpRequest();
    var url = "/removeUnderReview";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // pend_doc();
        }
    };
    xhr.send(`id=${i}`);
}

// adding to the reject list
function Reject(i) {
    $(`#checkAllow${i}`).val('1');
    $(`#removeUnderReview${i}`).removeAttr('checked');
    $('.pend_warn').html(`<h6 class="text-center text-danger">Added to reject list</h6>`)
    setTimeout(() => {
        $(`.pend_warn`).hide(() => {
            $(this).animate(2000)
        });
    }, 4000);

    var xhr = new XMLHttpRequest();
    var url = "/RejectDoctor";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // pend_doc()
        }
    };
    xhr.send(`id=${i}`);
}


// doctor remove from reject list
function removeReject(i) {
    $(`#checkAllow${i}`).val('1');
    $(`#removeUnderReview${i}`).removeAttr('checked');
    $('.pend_warn').html(`<h6 class="text-center text-success">remove from reject list</h6>`)
    setTimeout(() => {
        $(`.pend_warn`).hide(() => {
            $(this).animate(2000)
        });
    }, 4000);

    var xhr = new XMLHttpRequest();
    var url = "/removeRejectDoctor";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // pend_doc()
        }
    };
    xhr.send(`id=${i}`);
}


// testing that  doctor record can be deletable or not
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


// applying dataTable library to every table
$(document).ready(function(){
    $('#app_table').DataTable();
    $('#doc_table').DataTable();
    $('#pat_table').DataTable();
});

