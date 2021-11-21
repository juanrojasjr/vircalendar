import { fullcalendar } from './fullcalendar.js';
import { eventInit } from './events.js';

const calendarEl = document.getElementById("calendar");

document.addEventListener("DOMContentLoaded", () => {
  eventInit();
  if (calendarEl != null) {
    fullcalendar(calendarEl);
  }
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
