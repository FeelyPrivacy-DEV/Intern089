$('#custom_price_input').css({'display': 'none'});

$(document).on('change', '.form-check-input', function() {
    if($(this).val() == 2) {
        $('#custom_price_input').css({'display': 'block'});
    }
    else {
        $('#custom_price_input').css({'display': 'none'});
    }
});
 
 
var flag1 = 1;
// add education
$(document).on('click', '#add-more-edu-btn', function() {
    $('#add-more-edu').append(`
        <div class="row border" id="edu-more${flag1}">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="my-2">Degree</label>
                    <input type="text" name="degree[]" class="form-control p-2 ">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="my-2">College / Institute</label>
                    <input type="text" name="college[]" class="form-control p-2 ">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="my-2">Year of Completion</label>
                    <input type="number" name="year[]" class="form-control p-2 ">
                </div>
            </div>
            <div class="col-md-3 my-auto ">
                <button type="button" class="btn btn-danger my-auto" onclick="deleteSlot(${flag1})" id="del${flag1}"><i class="bi bi-trash-fill"></i>  </button>
            </div>
        </div>
    `);
    flag1++;
});

function deleteSlot(i) {
    $(`#edu-more${i}`).remove();
}


let flag2 = 1;
//hospital experience 
$(document).on('click', '#add-more-exp-btn', function() {
    $('#add-more-exp').append(`
        <div class="row" id="exp-more${flag2}">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="my-2">Hospital Name</label>
                    <input type="text" name="hospital_name[]" class="form-control p-2 ">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="my-2">From</label>
                    <input type="date" name="hos_from[]" class="form-control p-2">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="my-2">To</label>
                    <input type="date" name="hos_to[]" class="form-control p-2">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="my-2">Designation</label>
                    <input type="text" name="designation[]" class="form-control p-2">
                </div>
            </div>
            <div class="col-md-3 my-auto ">
                <button type="button" class="btn btn-danger my-auto" onclick="deleteExp(${flag2})" id="exp-moredel${flag2}"><i class="bi bi-trash-fill"></i>  </button>
            </div>
        </div>
    `);
    flag2++;
});

// add education
function deleteExp(i) {
    $(`#exp-more${i}`).remove();
}



let flag3 = 1;
//hospital experience 
$(document).on('click', '#add-more-award-btn', function() {
    $('#add-more-award').append(`
        <div class="row border" id="awd${flag3}">
            <div class="col-md-5">
                <div class="form-group">
                    <label class="my-2">Award</label>
                    <input type="text" name="aw_name[]" class="form-control p-2 ">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label class="my-2">From</label>
                    <input type="date" name="aw_year[]" class="form-control p-2 ">
                </div>
            </div>
            <div class="col-md-2 my-auto ">
                <button type="button" class="btn btn-danger my-auto" onclick="deleteAwd(${flag3})"><i class="bi bi-trash-fill"></i>  </button>
            </div>
        </div>
    `);
    flag3++;
});

// add education
function deleteAwd(i) {
    $(`#awd${i}`).remove();
}



let flag4 = 1;
//hospital experience 
$(document).on('click', '#add-more-memb-btn', function() {
    $('#add-more-memb').append(`
        <div class="row border" id="memb${flag4}">
            <div class="col-md-6">
                <div class="form-group">
                <label class="my-2">Memberships</label>
                <input type="text" name="memb_name[]" class="form-control p-2 ">
                </div>
            </div>
            <div class="col-md-6 my-auto ">
                <button type="button" class="btn btn-danger my-auto" onclick="deleteMemb(${flag4})"><i class="bi bi-trash-fill"></i>  </button>
            </div>
        </div>
    `);
    flag4++;
});

// add education
function deleteMemb(i) {
    $(`#memb${i}`).remove();
}


let flag5 = 1;
//hospital experience 
$(document).on('click', '#add-more-reg-btn', function() {
    $('#add-more-reg').append(`
        <div class="row border" id="reg${flag5}">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="my-2">Registrations</label>
                    <input type="text" name="reg_name[]" class="form-control p-2 ">
                </div>
            </div>
            <div class="col-md-6 my-auto ">
                <button type="button" class="btn btn-danger my-auto" onclick="deleteReg(${flag5})"><i class="bi bi-trash-fill"></i>  </button>
            </div>
        </div>
    `);
    flag5++;
});

// add education
function deleteReg(i) {
    $(`#reg${i}`).remove();
}


// * update profile * //