

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



// doctor login
$(document).on('click', '#doctor_login_btn', function() {
    doc_email = $('#login_doctor_email').val();
    doc_pass = $('#login_doctor_pass').val();
    if(doc_email == '' || doc_pass == '') {
        $('#doctor_login_warn').html('<h6 class="text-center text-warning">Email or Password cannot be be blank</h6>')
    }
    else {
        $('#doctor_login_btn').html(`
            <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Logging In...
        `);
        $('#doctor_login_btn').attr('disabled', true);

        var xhr = new XMLHttpRequest();
        var url = "/";

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            if(xhr.responseText == 'true') {
                window.location.href = '/d';
            }
            else if(xhr.responseText == 'pfalse') {
                $('#doctor_login_warn').html('<h6 class="text-center text-danger">Wrong credentials !</h6>')
                $('#doctor_login_btn').text(`Log in`);
                $('#doctor_login_btn').attr('disabled', false);
            }
            else if(xhr.responseText == 'efalse') {
                $('#doctor_login_warn').html('<h6 class="text-center text-danger">Account not found !</h6>')
                $('#doctor_login_btn').text(`Log in`);
                $('#doctor_login_btn').attr('disabled', false);
            }
            else if(xhr.responseText == 'notApproved') {
                $('#doctor_login_warn').html('<h6 class="text-center text-primary">You\'r not approved yet !</h6>')
                $('#doctor_login_btn').text(`Log in`);
                $('#doctor_login_btn').attr('disabled', false);
            }
            else if(xhr.responseText == 'disable') {
                $('#doctor_login_warn').html('<h6 class="text-center text-danger">You\'r disabled by admin !</h6>')
                $('#doctor_login_btn').text(`Log in`);
                $('#doctor_login_btn').attr('disabled', false);
            }
            else {
                $('#doctor_login_warn').html(`<h6 class="text-center text-primary">${xhr.responseText}</h6>`)
                $('#doctor_login_btn').text(`Log in`);
                $('#doctor_login_btn').attr('disabled', false);
            }
          }
        };
        xhr.send(`doc_email=${doc_email}&doc_pass=${doc_pass}`);
    }
});


// doctor registration
//password checking
$(document).on('keyup', '#doctor_register_pass', function() {
    let p = document.getElementById('doctor_register_pass').value;
    let regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    if(p.length > 8) {
        if(!regex.test(p)) {
            $('#pass_warn').html(`password should contain atleast one number and one special character`);
            $('#doctor_register_btn').attr('disabled', true);
        }
        else {
            $('#pass_warn').html(``);
            $('#doctor_register_btn').attr('disabled', false);
        }
    }
    else {
        $('#pass_warn').html(`Password should greater then 8 characters`);
        $('#doctor_register_btn').attr('disabled', true);
    }
});
$(document).on('click', '#doctor_register_btn', function() {
    doctor_register_fname = $('#doctor_register_fname').val();
    doctor_register_sname = $('#doctor_register_sname').val();
    doctor_register_email = $('#doctor_register_email').val();
    doctor_register_mn = $('#doctor_register_mn').val();
    doctor_register_ml = $('#doctor_register_ml').val();
    doctor_register_addr = $('#doctor_register_addr').val();
    doctor_register_pass = $('#doctor_register_pass').val();
    doc_captcha = $('[name=h-captcha-response]').val();
    if(doctor_register_ml == '' || doctor_register_mn == '' || doctor_register_fname == '' || doctor_register_sname == '' || doctor_register_email == '' || doctor_register_pass == '') {
        $('#doctor_register_warn').html('<h6 class="text-center text-warning">Everything should be filled</h6>')
    }
    else {
        $('#doctor_register_btn').html(`
            <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Signing Up...
        `);
        $('#doctor_register_btn').attr('disabled', true);

        var xhr = new XMLHttpRequest();
        var url = "/dNew";

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            if(xhr.responseText == 'true') {
                $('#doctor_register_warn').html('<h6 class="text-center text-success">Your account is created, please check email !</h6>')
                $('#doctor_register_btn').attr('disabled', false);
                $('#doctor_register_btn').text(`Create Account`);
            }
            else if(xhr.responseText == 'emailError') {
                $('#doctor_register_warn').html('<h6 class="text-center text-danger">This email is not working !</h6>')
                $('#doctor_register_btn').attr('disabled', false);
                $('#doctor_register_btn').text(`Create Account`);
            }
            else if(xhr.responseText == 'emailExist') {
                $('#doctor_register_warn').html('<h6 class="text-center text-danger">This email is is already in use !</h6>')
                $('#doctor_register_btn').attr('disabled', false);
                $('#doctor_register_btn').text(`Create Account`);
            }
            else if(xhr.responseText == 'captchaError') {
                $('#doctor_register_warn').html('<h6 class="text-center text-danger">Please verify captcha !</h6>')
                $('#doctor_register_btn').attr('disabled', false);
                $('#doctor_register_btn').text(`Create Account`);
            }
            else {
                console.log(xhr.responseText);
                $('#doctor_register_warn').html(`<h6 class="text-center text-primary">${xhr.responseText}</h6>`)
                $('#doctor_register_btn').text(`Create Account`);
                $('#doctor_register_btn').attr('disabled', false);
            }
          }
        };
        xhr.send(`fname=${doctor_register_fname}&sname=${doctor_register_sname}&email=${doctor_register_email}&mn=${doctor_register_mn}&addr=${doctor_register_addr}&ml=${doctor_register_ml}&pass=${doctor_register_pass}&doc_captcha=${doc_captcha}`);
    }

});



// doctor forgot password
$(document).on('click', '#doc_forgot', function() {
    $('#doc_forgot').html(`
        <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Sending Email...
    `)
    $('#doc_forgot').attr('disabled', true)
    var email = $('#d_for_email').val();
    let doc_forgot = true;
    var xhr = new XMLHttpRequest();
    var url = "/doctor-forgot-password";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if(xhr.responseText == 'Account not found') {
            $('#for_warn').html('<p class="text-danger">Account not found</p>');
            $('#doc_forgot').text('Send Email');
            $('#doc_forgot').attr('disabled', false);
        }
        else if(xhr.responseText == 'true') {
            $('#for_warn').html('<p class="text-success">Please check your email</p>');
            $('#doc_forgot').text('Send Email');
            $('#doc_forgot').attr('disabled', false);
            // $('#doc_forgot').attr();
        }
        else if(xhr.responseText == 'notSent') {
            $('#for_warn').html('<p class="text-danger">For some reason email not sent (email error)</p>');
            $('#doc_forgot').text('Send Email');
            $('#doc_forgot').attr('disabled', true);
        }
        else {
            $('#for_warn').text(xhr.responseText);
            $('#doc_forgot').text('Send Email');
        }

      }
    };
    xhr.send(`email=${email}`);
})



//* patient *//

// patient registration
//password checking
$(document).on('keyup', '#patient_registration_pass', function() {
    let p = document.getElementById('patient_registration_pass').value;
    let regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    if(p.length > 8) {
        if(!regex.test(p)) {
            $('#pass_warn').html(`password should contain atleast one number and one special character`);
            $('#doctor_register_btn').attr('disabled', true);
        }
        else {
            $('#pass_warn').html(``);
            $('#doctor_register_btn').attr('disabled', false);
        }
    }
    else {
        $('#pass_warn').html(`Password should greater then 8 characters`);
        $('#doctor_register_btn').attr('disabled', true);
    }
});
$(document).on('click', '#patient_registration_btn', function(e) {
    patient_registration_fname = $('#patient_registration_fname').val();
    patient_registration_sname = $('#patient_registration_sname').val();
    patient_registration_email = $('#patient_registration_email').val();
    patient_registration_pass = $('#patient_registration_pass').val();
    pat_captcha = $('[name=h-captcha-response]').val();
    if(patient_registration_fname == '' || patient_registration_sname == '' || patient_registration_email == '' || patient_registration_pass == '') {
        $('#patient_register_warn').html('<h6 class="text-center text-warning">Everything should be filled</h6>');
    }
    else {
        $('#patient_registration_btn').html(`
            <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Signing Up...
        `)
        $('#patient_registration_btn').attr('disabled', true);

        var xhr = new XMLHttpRequest();
        var url = "/pNew";

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            if(xhr.responseText == 'true') {
                $('#patient_register_warn').html('<h6 class="text-center text-success">Your account is created, please log in now !</h6>')
                $('#patient_registration_btn').attr('disabled', false);
                $('#patient_registration_btn').text(`Create Account`);
            }
            else if(xhr.responseText == 'emailError') {
                $('#patient_register_warn').html('<h6 class="text-center text-danger">This email is not working !</h6>')
                $('#patient_registration_btn').attr('disabled', false);
                $('#patient_registration_btn').text(`Create Account`);
            }
            else if(xhr.responseText == 'emailExist') {
                $('#patient_register_warn').html('<h6 class="text-center text-danger">This email is already exists !</h6>')
                $('#patient_registration_btn').attr('disabled', false);
                $('#patient_registration_btn').text(`Create Account`);
            }
            else if(xhr.responseText == 'captchaError') {
                $('#patient_register_warn').html('<h6 class="text-center text-danger">Please verify captcha !</h6>')
                $('#patient_registration_btn').attr('disabled', false);
                $('#patient_registration_btn').text(`Create Account`);
            }
            else {
                $('#patient_register_warn').html(`<h6 class="text-center text-primary">${xhr.responseText}</h6>`)
                $('#patient_registration_btn').text(`Create Account`);
                $('#patient_registration_btn').attr('disabled', false);
            }
          }
        };
        xhr.send(`patient_registration_fname=${patient_registration_fname}&patient_registration_sname=${patient_registration_sname}&patient_registration_email=${patient_registration_email}&patient_registration_pass=${patient_registration_pass}&pat_captcha=${pat_captcha}`);
    }

});


// patient login
$(document).on('click', '#patient_login_btn', function() {
    patient_login_email = $('#patient_login_email').val()
    patient_login_pass = $('#patient_login_pass').val()
    if(patient_login_email == '' || patient_login_pass == '') {
        $('#patient_login_warn').html('<h6 class="text-center text-warning">Everything should be filled</h6>');
    }
    else {
        $('#patient_login_btn').html(`
            <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Logging In...
        `)
        $('#patient_login_btn').attr('disabled', true);

        var xhr = new XMLHttpRequest();
        var url = "/pLogin";

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            if(xhr.responseText == 'true') {
                window.location.href = '/p';
            }
            else if(xhr.responseText == 'pfalse') {
                $('#patient_login_warn').html('<h6 class="text-center text-danger">Wrong credentials !</h6>')
                $('#patient_login_btn').text(`Log in`);
                $('#patient_login_btn').attr('disabled', false);
            }
            else if(xhr.responseText == 'efalse') {
                $('#patient_login_warn').html('<h6 class="text-center text-danger">Account not found !</h6>')
                $('#patient_login_btn').text(`Log in`);
                $('#patient_login_btn').attr('disabled', false);
            }
            else {
                $('#patient_login_warn').html(`<h6 class="text-center text-primary">${xhr.responseText}</h6>`)
                $('#patient_login_btn').text(`Log in`);
                $('#patient_login_btn').attr('disabled', false);
            }
          }
        };
        xhr.send(`patient_login_email=${patient_login_email}&patient_login_pass=${patient_login_pass}`);
    }

})



// patient forgot
$(document).on('click', '#pat_forgot', function() {
    $('#pat_forgot').html(`
        <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Sending Email...
    `)
    $('#pat_forgot').attr('disabled', true)
    var email = $('#p_for_email').val();
    let pat_forgot = true;
    var xhr = new XMLHttpRequest();
    var url = "/patient-forgot-password";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if(xhr.responseText == 'Account not found') {
                $('#for_warn_pat').html('<p class="text-danger">Account not found</p>');
                $('#pat_forgot').text('Send Email');
                $('#pat_forgot').attr('disabled', false)
            }
            else if(xhr.responseText == 'true') {
                $('#for_warn_pat').html('<p class="text-success">Please check your email</p>');
                $('#pat_forgot').text('Send Email');
            }
            else if(xhr.responseText == 'notSent') {
                $('#for_warn_pat').html('<p class="text-danger">For some reason emailnot sent (email error)</p>');
                $('#pat_forgot').text('Send Email');
                $('#pat_forgot').attr('disabled', true);
            }
            else {
                $('#for_warn_pat').text(xhr.responseText);
                $('#pat_forgot').text('Send Email');
                $('#pat_forgot').attr('disabled', false);
            }

          }
    };
    xhr.send(`email=${email}`);
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
                <span class="visually-hidden">Changing Password...</span>
                </div>
            `)
            $('#for_warn_pat').html('<h5 class="text-success">Password Changed Successfully <br> You will be redirect to login page.</h3>');
            let change_pass_pat = true;
            var xhr = new XMLHttpRequest();
            var url = "/patient-change-password-route";

            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if(xhr.responseText == 'true') {
                        window.location.href = 'http://127.0.0.1/s/s/p';
                    }
                    else if(xhr.responseText == 'notSent') {
                        $('#for_warn_pat').html('<p class="text-danger">For some reason email not sent (email error)</p>');
                        $('.reset_form').show();
                    }
                    else {
                        $('#for_warn_pat').text(xhr.responseText);
                        $('.reset_form').show();
                    }
                }
            };
            xhr.send(`new_pass=${new_pass}&token=${token}`);
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
            var url = "/doctor-change-password-route";

            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if(xhr.responseText == 'true') {
                        window.location.href = 'http://127.0.0.1/';
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
            xhr.send(`new_pass=${new_pass}&token=${token}`);
        }
    }


});





//******************************************    ADMIN   ******************************************//

// admin login
$(document).on('click', '#admin_login_btn', function() {
    admin_login_email = $('#admin_login_email').val();
    admin_login_pass = $('#admin_login_pass').val();
    if(admin_login_email == '' || admin_login_pass == '') {
        $('#admin_login_warn').html('<h6 class="text-center text-warning">Everything should be filled</h6>')
    }
    else {
        $('#admin_login_btn').html(`
            <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Logging In...
        `);
        $('#admin_login_btn').attr('disabled', true);

        var xhr = new XMLHttpRequest();
        var url = "/admin_login";

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            if(xhr.responseText == 'true') {
                window.location.href = '/a/dashboard';
            }
            else if(xhr.responseText == 'pfalse') {
                $('#admin_login_warn').html('<h6 class="text-center text-danger">Wrong credentials !</h6>')
                $('#admin_login_btn').text(`Log as admin`);
                $('#admin_login_btn').attr('disabled', false);
            }
            else if(xhr.responseText == 'efalse') {
                $('#admin_login_warn').html('<h6 class="text-center text-danger">Account not found !</h6>')
                $('#admin_login_btn').text(`Log as admin`);
                $('#admin_login_btn').attr('disabled', false);
            }
            else {
                $('#admin_login_warn').html(`<h6 class="text-center text-primary">${xhr.responseText}</h6>`)
                $('#admin_login_btn').text(`Log as admin`);
                $('#admin_login_btn').attr('disabled', false);
            }
          }
        };
        xhr.send(`admin_login_email=${admin_login_email}&admin_login_pass=${admin_login_pass}`);
    }
})



// admin registration
$(document).on('click', '#admin_register_btn', function() {
    admin_register_fname = $('#admin_register_fname').val();
    admin_register_email = $('#admin_register_email').val();
    admin_register_pass = $('#admin_register_pass').val();
    if(admin_register_fname == '' || admin_register_email == '' || admin_register_pass == '') {
        $('#admin_register_warn').html('<h6 class="text-center text-warning">Everything should be filled</h6>')
    }
    else {
        $('#admin_register_btn').html(`
            <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Signing Up...
        `);
        $('#admin_register_btn').attr('disabled', true);
        var xhr = new XMLHttpRequest();
        var url = "/admin_registration";

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            if(xhr.responseText == 'true') {
                // window.location.href = '/a-login';
            } 
            else if(xhr.responseText == 'emailExist') {
                $('#admin_register_warn').html('<h6 class="text-center text-danger">Eamil already exist !</h6>')
                $('#admin_register_btn').text(`Register for Admin`);
                $('#admin_register_btn').attr('disabled', false);
            }
            else {
                $('#admin_register_warn').html(`<h6 class="text-center text-primary">${xhr.responseText}</h6>`)
                $('#admin_register_btn').text(`Register for Admin`);
                $('#admin_register_btn').attr('disabled', false);
            }
          }
        };
        xhr.send(`admin_register_fname=${admin_register_fname}&admin_register_email=${admin_register_email}&admin_register_pass=${admin_register_pass}`);
    }
});
