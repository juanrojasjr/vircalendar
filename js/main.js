import { fullcalendar } from './fullcalendar.js';
import { eventInit } from './events.js';
import { loginInit } from './login.js';

const calendarEl = document.getElementById("calendar");

document.addEventListener("DOMContentLoaded", () => {
  eventInit();
  loginInit();
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
// $('#forgot-password button[type="submit"]').click(function (e) {
//   e.preventDefault();
//   let username = $("#username").val();
//   const alertD = $(".alert.alert-danger"),
//     alertS = $(".alert.alert-success");
//     alertD.addClass("d-none");
//     alertS.addClass("d-none");
//   $.ajax({
//     method: "POST",
//     url: "inc/forgot_password.php",
//     data: { username: username },
//   }).done(function (msg) {
//     console.log(msg);
//     if (msg == 0) {
//       alertD.removeClass("d-none");
//     } else {
//       alertS.removeClass("d-none");
//     }
//   });
// });