

$('#docreg, #docforgot').hide();
$('#patreg, #patforgot').hide();


$(document).on('click', '#d_log', function() {
    $('#docreg, #docforgot').hide();
    $('#doclog').show() 
})
$(document).on('click', '#d_ca', function() {
    $('#doclog, #docforgot').hide();
    $('#docreg').show()
})
$(document).on('click', '#d_for', function() {
    $('#docreg, #doclog').hide();
    $('#docforgot').show()
})
 

$(document).on('click', '#p_log', function() {
    $('#patreg, #patforgot').hide();
    $('#patlog').show()
})
$(document).on('click', '#p_ca', function() {
    $('#patlog, #patforgot').hide();
    $('#patreg').show()
})
$(document).on('click', '#p_for', function() {
    $('#patreg, #patlog').hide();
    $('#patforgot').show()
})





var s = [];
$(document).on('keyup', '#search_doc', function() {
    let sq = $(this).val();
    let search = true;
    var xhr = new XMLHttpRequest();
    var url = "https://test.feelyprivacy.com/s/controller/php/index.php";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
          s.push(xhr.responseText);
      }
    };
    xhr.send(`search=${search}&sq=${sq}`);
})



// doc
$(document).on('click', '#doc_forgot', function() {
    $('#doc_forgot').html(`
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    `)
    var email = $('#d_for_email').val();
    let doc_forgot = true;
    var xhr = new XMLHttpRequest();
    var url = "https://test.feelyprivacy.com/s/controller/php/forgot_password.php";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if(xhr.responseText == 'Account not found') {
            $('#for_warn').html('<p class="text-danger">Account not found</p>');
            $('#doc_forgot').text('Send Email');
        }
        else if(xhr.responseText == 'true') {
            $('#for_warn').html('<p class="text-success">Please check your email</p>');
            $('#doc_forgot').text('Send Email');
            // $('#doc_forgot').attr();
        }
        else if(xhr.responseText == 'notSent') {
            $('#for_warn').html('<p class="text-danger">For some reason emailnot sent (email error)</p>');
            $('#doc_forgot').text('Send Email');
            $('#doc_forgot').attr('disabled', true);
        }
        else {
            $('#for_warn').text(xhr.responseText);
            $('#doc_forgot').text('Send Email');
        }

      }
    };
    xhr.send(`doc_forgot=${doc_forgot}&email=${email}`);
})



// pat
$(document).on('click', '#pat_forgot', function() {
    $('#pat_forgot').html(`
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    `)
    var email = $('#p_for_email').val();
    let pat_forgot = true;
    var xhr = new XMLHttpRequest();
    var url = "https://test.feelyprivacy.com/s/controller/php/forgot_password.php";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if(xhr.responseText == 'Account not found') {
                $('#for_warn_pat').html('<p class="text-danger">Account not found</p>');
                $('#pat_forgot').text('Send Email');
            }
            else if(xhr.responseText == 'true') {
                $('#for_warn_pat').html('<p class="text-success">Please check your email</p>');
                $('#pat_forgot').text('Send Email');
                // $('#pat_forgot').attr();
            }
            else if(xhr.responseText == 'notSent') {
                $('#for_warn_pat').html('<p class="text-danger">For some reason emailnot sent (email error)</p>');
                $('#pat_forgot').text('Send Email');
                $('#pat_forgot').attr('disabled', true);
            }
            else {
                $('#for_warn_pat').text(xhr.responseText);
                $('#pat_forgot').text('Send Email');
            }
    
          }
    };
    xhr.send(`pat_forgot=${pat_forgot}&email=${email}`);
});



// check password

var new_pass, conf_pass, token;
$(document).on('click', '#change_pass_pat', function() { 
    token = $('#pat_token').val();
    new_pass = $('#newpass').val();
    conf_pass = $('#confpass').val();
    if(new_pass != '' && conf_pass != '') {
        if(new_pass == conf_pass) {
            $('.reset_form').hide();
            $('#load_pat').html(`
                <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
            `)
            $('#for_warn_pat').html('<h5 class="text-success">Password Changed Successfully <br> You will be redirect to login page.</h3>');
            let change_pass_pat = true;
            var xhr = new XMLHttpRequest();
            var url = "https://test.feelyprivacy.com/s/controller/php/forgot_password.php";
            
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if(xhr.responseText == 'true') {
                        window.location.href = 'https://test.feelyprivacy.com/s/p';
                    }
                    else if(xhr.responseText == 'notSent') {
                        $('#for_warn_pat').html('<p class="text-danger">For some reason emailnot sent (email error)</p>');
                        $('.reset_form').show();
                    }
                    else {
                        $('#for_warn_pat').text(xhr.responseText);
                        $('.reset_form').show();
                    }
            
                }
            };
            xhr.send(`change_pass_pat=${change_pass_pat}&new_pass=${new_pass}&token=${token}`);
        }
        else {
            $('#for_warn_pat').html('<p class="text-danger">Passwords not same</p>');
        }
    }
    else {
        $('#for_warn_pat').html('<p class="text-danger">Password is blank</p>');
    }


});
$(document).on('click', '#change_pass_doc', function() { 
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    token = urlParams.get('token');
    new_pass = $('#doc_newpass').val();
    conf_pass = $('#doc_confpass').val();
    if(new_pass != '' && conf_pass != '') {
        if(new_pass == conf_pass) {
            $('.reset_form').hide();
            $('#load_pat').html(`
                <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
            `)
            $('#for_warn_pat').html('<h4 class="text-success">Password Changed Successfully <br> You will be redirect to login page.</h4>');
            let change_pass_doc = true;
            var xhr = new XMLHttpRequest();
            var url = "https://test.feelyprivacy.com/s/controller/php/forgot_password.php";
            
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if(xhr.responseText == 'true') {
                        window.location.href = 'https://test.feelyprivacy.com/s/';
                    }
                    else if(xhr.responseText == 'notSent') {
                        console.log(xhr.responseText);
                        $('#for_warn_pat').html('<p class="text-danger">For some reason email not sent (email error)</p>');
                        $('#pat_forgot').text('Change Password');
                        $('#for_warn_pat').hide();
                    }
                    else {
                        $('#for_warn_pat').text(xhr.responseText);
                        $('#pat_forgot').text('Change Password');
                        $('#for_warn_pat').hide();
                    }
            
                }
            };
            xhr.send(`change_pass_doc=${change_pass_doc}&new_pass=${new_pass}&token=${token}`);
        }
    }


});