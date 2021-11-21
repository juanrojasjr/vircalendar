import { fullcalendar, updtFullCalendar } from './fullcalendar.js';
import { updateEvent, updateInputsData } from './events.js';

const calendarEl = document.getElementById("calendar");

document.addEventListener("DOMContentLoaded", () => {
  if (calendarEl != null) {
    fullcalendar(calendarEl);
  }
});

$('#btnUpdateInputs').click(function (e) { 
  e.preventDefault();
  updateInputsData();
});

$('#btnSaveUpdt').click(function (e) { 
  e.preventDefault();
  updateEvent();
});

/* Elimina el calendario si no detecta un inicio de sesión */
if (calendarEl && !sessionStorage.getItem('uid')) {
  $(calendarEl).remove();
  $('.noLogin').removeClass('d-none');
}

/* Reestablecer contraseña olvidada */
$('#forgot-password button[type="submit"]').click(function (e) {
  e.preventDefault();
  let username = $("#username").val();
  const alertD = $(".alert.alert-danger"),
    alertS = $(".alert.alert-success");
  alertD.addClass("d-none");
  alertS.addClass("d-none");
  $.ajax({
    method: "POST",
    url: "inc/forgot_password.php",
    data: { username: username },
  }).done(function (msg) {
    console.log(msg);
    if (msg == 0) {
      alertD.removeClass("d-none");
    } else {
      alertS.removeClass("d-none");
    }
  });
});

/* Agregar un nuevo evento */
$('#addEvent button[type="submit"]').click(function (e) {
  e.preventDefault();
  let uid = localStorage.getItem('uid'),
    tt = $("#tt").val(),
    ds = $("#ds").val(),
    de = $("#endDate").is(":checked") ? $("#de").val() : null,
    hs = $("#hs").val(),
    he = $("#endHour").is(":checked") ? $("#he").val() : null,
    dc = $("#dc").val(),
    cl = $("#cl").val();
  let deIncrement = de != null ? moment(de).add(1, 'days').format("YYYY-MM-DD") : null;
  if (
    $("#tt").val() != "" &&
    $("#ds").val() != "" &&
    $("#hs").val() != "" &&
    $("#dc").val() != ""
  ) {
    $.ajax({
      method: "POST",
      url: "core/events/create.php",
      data: {
        uid: uid,
        tt: tt,
        ds: ds,
        de: deIncrement,
        hs: hs,
        he: he,
        dc: dc,
        cl: cl,
      },
    }).done(function (msg) {
      if (msg == 1) {
        Swal.fire({
          icon: "success",
          text: "Evento creado",
          showConfirmButton: false,
          timer: 1500,
        });
        $("#addEvent").modal("hide");
        updtFullCalendar();
        //$("#calendar").empty();
        //calendarEl.refetchEvents();
      } else {
        Swal.fire({
          icon: "error",
          text: "Contacte con el administrador del sitio",
          showConfirmButton: false,
          timer: 1500,
        });
      }
    });
  } else {
    Swal.fire({
      icon: "error",
      text: "Debe llenar mínimo el campo título, fecha de inicio, hora de inicio y descripción.",
    });
  }
});

/* Validar checkbox Fecha */
$("#endDate").click(function (e) {
  if ($(this).is(":checked")) {
    $("#de").prop("disabled", false);
  } else {
    $("#de").prop("disabled", true);
  }
});

/* Validar checkbox Hora */
$("#endHour").click(function (e) {
  if ($(this).is(":checked")) {
    $("#he").prop("disabled", false);
  } else {
    $("#he").prop("disabled", true);
  }
});

/* Inicio de sesión */
$('#login button[type="submit"]').click(function (e) {
  e.preventDefault();
  let nickname = $("#nickname").val(),
    pass = $("#password").val();
  $.ajax({
    method: "POST",
    url: "core/login.php",
    data: { nickname: nickname, pass: pass },
  }).done(function (msg) {
    const errors = JSON.parse(msg);
    const errContainer = $(".errorContainer");

    if (errors["error"]) {
      let html = `<div class="alert alert-${
        errors["error"] ? "danger" : "success"
      }" role="alert">${errors["msg"]}</div>`;
      errContainer.show();
      $(html).appendTo(errContainer);
    } else {
      sessionStorage.setItem("uid", errors["uid"]);
      setTimeout(function () {
        window.location.href = "home";
      }, 1000);
    }
  });
});

function closeSession() {
  sessionStorage.clear();
  window.location.href = "/";
}

/* Reestablecer contraseña olvidada */
$('#modal-forgotpassword button[type="submit"]').click(function (e) {
  e.preventDefault();
  const email = $("#email-forgot").val();
  $.ajax({
    method: "POST",
    url: "core/forgot_password.php",
    data: { email: email },
  }).done(function (msg) {
    console.log(msg);
    // if (msg==0) {
    //     alertD.removeClass('d-none')
    // }else{
    //     alertS.removeClass('d-none')
    // }
  });
});
