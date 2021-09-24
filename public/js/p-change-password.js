
$(document).on('keyup', '#newPassword', function() {
    let newPass = document.getElementById('newPassword').value;

    let regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    if(newPass.length > 8) {
        if(!regex.test(newPass)) {
            $('#newPassWarn').html(`password should contain atleast one number and one special character`);
            $('#changepassbtn').attr('disabled', true);
        }
        else {
            $('#newPassWarn').html(``);
            $('#changepassbtn').attr('disabled', false);

        }
    }
    else {
        $('#newPassWarn').html(`Password should greater then 8 characters`);
        $('#changepassbtn').attr('disabled', true);
    }

})

$(document).on('keyup', '#conformNewPassword', function() {
    let newPass = document.getElementById('newPassword').value;
    let confNew = $('#conformNewPassword').val();
    if(newPass != confNew) {
        $('#changepassbtn').attr('disabled', true);
        $('#passWarn').html(`<p class="text-danger"><b>Passwords not match</b></p>`)
    }else {
        $('#passWarn').html(``)
        $('#changepassbtn').attr('disabled', false);
    }
})
$(document).on('click', '#changepassbtn', function() {
    let old = $('#oldPassword').val();
    let newPass = $('#newPassword').val();
    let confNew = $('#conformNewPassword').val();

    if(old == '' || newPass == '' || confNew == '') {
        $('.warn').html(`<h5 class="text-warning">Everything should filled</h5>`);
    }
    else {
        $('#changepassbtn').html(`<span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Changing...`);
        $('#changepassbtn').attr('disabled', true);

        var xhr = new XMLHttpRequest();
        var url = '/chPasswordPat';

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                if(xhr.responseText == 'true') {
                    $('#oldPassword').val('');
                    $('#newPassword').val('');
                    $('#conformNewPassword').val('');
                    $('#changepassbtn').html('Password Changed !');
                    $('#changepassbtn').attr('disabled', false);
                    $('.warn').html(`<p class="text-center text-success">Password changed !, from next time you will be login with your new password</p>`);
                    // window.location.href = xhr.responseText;
                }
                else if(xhr.responseText == 'false') {
                    $('#changepassbtn').html('Change Password');
                    $('#changepassbtn').attr('disabled', false);
                    $('.warn').html(`<p class="text-center text-danger">Old Password is inncorrect</p>`);
                }
                else {
                    $('#changepassbtn').html('Change Password');
                    $('#changepassbtn').attr('disabled', false);
                    $('.warn').html(`<p class="text-center text-danger">${xhr.responseText}</p>`);
                }
            }
        };
        xhr.send(`old=${old}&newPass=${newPass}`);

    }
})






