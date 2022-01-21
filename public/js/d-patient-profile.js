var pat_id = $('#patient-id').val();
$('#save').attr('disabled', true);

$("#add-prescription-btn").hide();
$('#add-prescription').hide();

// datatables
$("#Appointments-table").DataTable();

// toggle subnavbar
$(`.all-table  .Appointments`).css({ display: "block" }).siblings().css({ display: "none" });

$(document).on("click", ".nav button", function () {
    $(this).addClass("active").siblings().removeClass("active");
    let id = $(this).text();
    id == 'Prescriptions' ? $("#add-prescription-btn").show() : $("#add-prescription-btn").hide();
    $(`.all-table .${id}`).css({ display: "block" }).siblings().css({ display: "none" });
});

// add-prescription-btn
$(document).on("click", "#add-prescription-btn", function () {
    $('#d-dash-content').hide();
    $("#add-prescription").show();
});

// back-btn
$(document).on("click", "#back-btn", function () {
    $("#add-prescription").hide();
    $('#d-dash-content').show();
});

// add-item event
var iCount = 2;
$(document).on("click", "#add-item-btn", function () {
    $('#Prescription-input tr:last').after(`
        <tr id="item-row-${iCount}">
            <td>
                <input class="form-control med-name" type="text" name="med-name[]">
            </td>
            <td>
                <input class="form-control med-qty" type="number" name="med-qty[]">
            </td>
            <td>
                <input class="form-control med-day" type="number" name="med-day[]">
            </td>
            <td>
                <div class="d-flex justify-content-around my-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Morning</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Noon</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Night</label>
                    </div>
                </div>
            </td>
            <td>
                <button class="btn delete btn-sm mx-1 text-nowrap" onclick="delete_item(${iCount})" id="item-row-delete-${iCount}"><i class="bi bi-trash-fill"></i></button>
            </td>
        </tr>
    `);
    iCount++;
});

// delete-item event
function delete_item(i) {
    $(`#item-row-${i}`).remove();
}



//** getting medical names by openFDA **//



//* prescription details
var reason;
$(document).on('keyup', '#prescription-reason', function() {
    reason = $('#prescription-reason').val();
    if(reason == '' || reason == undefined) {
        $('#reason_warn').html(`Please give title !`);
        $('#save').attr('disabled', true);
    }
    else {
        $('#save').attr('disabled', false);
    }
})
$(document).on('click', '#save', function() {
    // let reason = $('#prescription-reason').val();
    if(reason == '' || reason == undefined) {
        $('#reason_warn').html(`Please give title !`);
    }
    else {
        $('#save').html(`
            <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Loading...
        `)
        let med_name = []
        let med_qty = []
        let med_day = []
        $('#add-prescription .med-name').each(function() {
            med_name.push($(this).val());
        })
        $('#add-prescription .med-qty').each(function() {
            med_qty.push($(this).val());
        })
        $('#add-prescription .med-day').each(function() {
            med_day.push($(this).val());
        })

        $.ajax({
            url: '/prescription-save',
            type: 'POST',
            data: {
                pat_id: pat_id,
                med_name: med_name,
                med_qty: med_qty,
                med_day: med_day,
                reason: reason,
            },
            success: function(res) {
                if(res == 'true') {
                    $('#save').html(`Save`)
                    $('#d-dash-content').show();
                    $("#add-prescription").hide();
                    $('.Prescriptions').addClass("active").siblings().removeClass("active");
                    $('#overall_warn').html(`<h5 class="text-center text-success">Prescription has been added !</h5>`);
                    // all_prescription_display();
                    setTimeout(() => {
                        $('#overall_warn h5').fadeOut(1000);
                    }, 4500);
                }
                else if(res == 'false') {
                    $('#save').html(`Save`)
                    $('#pres_warn').html(`<h6 class="text-center text-primary">Something is wrong !</h6>`);
                }
                else {
                    $('#save').html(`Save`)
                    $('#pres_warn').html(`<h6 class="text-center text-primary">${res}</h6>`);
                }
            }
        });
    }
});


//* Edit prescription  *//
function edit_prescription(i, pre_id) {
    $(`#edit-save${i}`).html(`
            <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Loading...
    `)
    let med_name = []
    let med_qty = []
    let med_day = []
    $(`.edit-prescription #med-name${i}`).each(function() {
        med_name.push($(this).val());
    })
    $(`.edit-prescription #med-qty${i}`).each(function() {
        med_qty.push($(this).val());
    })
    $(`.edit-prescription #med-day${i}`).each(function() {
        med_day.push($(this).val());
    })

    $.ajax({
        url: '/edit-prescription-save',
        type: 'POST',
        data: {
            pat_id: pat_id,
            med_name: med_name,
            med_qty: med_qty,
            med_day: med_day,
            pre_id: pre_id,
        },
        success: function(res) {
            if(res == 'true') {
                $(`#edit-save${i}`).html(`Save`);
                $(`#edit_modal_warn${i}`).html(`<h5 class="text-center text-success">Prescription has been Edited !</h5>`);
                // all_prescription_display();
                setTimeout(() => {
                    $(`#edit_modal_warn${i} h5`).fadeOut(1000);
                }, 3000);
            }
            else if(res == 'false') {
                $(`#edit-save${i}`).html(`Save`)
                $(`#edit_modal_warn${i}`).html(`<h6 class="text-center text-danger">Something is happening wrong !</h6>`);
            }
            else {
                $(`#edit-save${i}`).html(`Save`)
                $(`#edit_modal_warn${i}`).html(`<h6 class="text-center text-primary">${res}</h6>`);
            }
        }
    });

}


//* Delete prescription *//

function delete_prescription(i, pre_id) {
    $(`#delete-prescription${i}`).html(`
            <span class="spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>Loading...
    `)

    $.ajax({
        url: '/delete-prescription',
        type: 'POST',
        data: {
            pat_id: pat_id,
            pre_id: pre_id,
        },
        success: function(res) {
            if(res == 'true') {
                $(`#delete-prescription${i}`).html(`<i class="bi bi-trash-fill mx-1"></i>Delete`);
                $(`#pres_warn`).html(`<h5 class="text-center text-danger">Prescription has been Deleted !</h5>`);
                // all_prescription_display();
                setTimeout(() => {
                    $(`#pres_warn h5`).fadeOut(1000);
                }, 3000);
            }
            else if(res == 'false') {
                $(`#delete-prescription${i}`).html(`<i class="bi bi-trash-fill mx-1"></i>Delete`)
                $(`#pres_warn`).html(`<h6 class="text-center text-danger">Something is really wrong happening !</h6>`);
            }
            else {
                $(`#delete-prescription${i}`).html(`<i class="bi bi-trash-fill mx-1"></i>Delete`)
                $(`#pres_warn`).html(`<h6 class="text-center text-primary">${res}</h6>`);
            }
        }
    });
}

// displaying all the prescriptiions
// function all_prescription_display() {

//     $.ajax({
//         url: '/display-prescription',
//         type: 'GET',
//         data: {
//             pat_id: pat_id
//         },
//         success: function(res) {
//             if(res == 'false') {
//                 $('#pres-msg').html('<h5 class="text-center text-primary">Nothing here !</h5>')
//             }
//             else {
//                 $('#overall_warn').html(res)
//                 $('#prescription-detail-body').html(res);
//             }
//         }
//     });
// }

$(document).ready(function() {
    // all_prescription_display();
})



