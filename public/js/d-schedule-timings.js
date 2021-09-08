
$(document).on('click', '.sidebtn', function() {
  $('.side-nav').toggle(200);
});



var day,
  next_date,
  time_dur_select,
  day_date,
  flag1 = 1;
// adding new slots field
$(document).on("click", "#addMoreSlots", function () {
  $("#editing").append(`
      <div class="d-flex justify-content-start" id="addno${flag1}">
          <div class='my-3 mx-2'>
              <label for='' class='form-label'>Start Time</label>
              <input type='time' name='s_time[]' class='form-control' id='meet_date'>
          </div>
          <div class='my-3 mx-2'>
              <label for='' class='form-label'>End Time</label>
              <input type='time' name='e_time[]' class='form-control' id='meet_time'>
          </div>
          <div class="my-3 mx-2 d-flex align-items-end">
              <button class="btn btn-danger" onclick="deleteSlot(${flag1})" id="del${flag1}"><i class="bi bi-trash-fill"></i>  </button>
          </div>
      </div>
  `);
  flag1++;
});

// deleting solts field
function deleteSlot(i) {
  $(`#addno${i}`).remove();
}

function display(ind) {

  if(ind >= $('#edit_modal_btn_val').val()) {
    $('#edit_modal_btn').attr('hidden', false);
  }
  else {
    $('#edit_modal_btn').attr('hidden', true);
  }

  day_date = $("#dt").val(ind);
  day = ind;
  let next_date = true;
  var xhr = new XMLHttpRequest();
  var url = "/show-slots";

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (xhr.responseText == "") {
        $("#slots-div").html(
          '<h5 class="text-danger text-center">No slots found</h5>'
        );
      } else {
        $("#slots-div").html(xhr.responseText);
      }
    }
  };
  xhr.send(`next_date=${next_date}&day=${day}`);
}

// delete slot
function slotdelete(d, i) {
  let del_date = d;
  let index = i;
  let slotdelete = true;
  var xhr = new XMLHttpRequest();
  var url = "http://127.0.0.1/s/s/controller/php/add_m.php";

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      $("#slots-div").html(xhr.responseText);
    }
  };
  xhr.send(`slotdelete=${slotdelete}&del_date=${del_date}&index=${index}`);
}

// time-dur-select
function get_time_dur() {
  let dur_time = true;
  dur_time = toString(dur_time);
  var xhr = new XMLHttpRequest();
  var url = "http://127.0.0.1/s/s/controller/php/add_m.php";

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.responseText == "") {
      $("#slots-div").html(
        '<h5 class="text-danger text-center">No slots found</h5>'
      );
    } else {
      $("#slots-div").html(xhr.responseText);
    }
  };
  xhr.send(
    `dur_time=${dur_time}&day_date=${day_date}&time_dur_select=${time_dur_select}`
  );
}

function time_dur() {
  if (time_dur_select != 0 || time_dur_select != undefined) {
    get_time_dur();
  }
}

$(document).on("change", "#time-dur-select", function () {
  time_dur_select = $(this).val();
  // time_dur_select = toString(time_dur_select);
  console.log(time_dur_select);
  console.log(day_date);
  time_dur();
});

$(document).ready(function () {
  day_date = $("#dt").val();

  let today = new Date().toISOString().slice(0, 10);
  $(`#${today}`).addClass('b-active');

  $(document).on('click', '#days-row button', function() {
    $(this).addClass('b-active').siblings().removeClass('b-active');
  })
});
