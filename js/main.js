import { fullcalendar } from './fullcalendar.js';
import { eventInit } from './events.js';
import { loginInit } from './login.js';

document.addEventListener("DOMContentLoaded", () => {
  const calendarEl = document.getElementById("calendar");

  eventInit();
  loginInit();

  if (calendarEl != null) {
    fullcalendar(calendarEl);
  }

  if (sessionStorage.getItem('firstname')) {
    document.querySelector('.firstname').innerHTML = 'Hola, ' + sessionStorage.getItem('firstname');
  }

  /* Elimina el calendario si no detecta un inicio de sesión */
  if (calendarEl && !sessionStorage.getItem('uid')) {
    $(calendarEl).remove();
    $('.noLogin').removeClass('d-none');
    $('#userMnu').addClass('d-none');
  }
});