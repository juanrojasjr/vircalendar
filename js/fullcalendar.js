let calendar;

function fullcalendar(calendarEl) {
  calendar = new FullCalendar.Calendar(calendarEl, {
    locale: "es",
    initialView: "dayGridMonth",
    customButtons: {
      btnAddEvent: {
        text: "Agregar evento",
        click: function () {
          let hex = Math.random().toString(16).substr(2, 6);
          $("#addEvent").modal("show");
          $("#cl").val("#" + hex);
        },
      },
    },
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "btnAddEvent",
    },
    events: {
      method: "POST",
      dataType: "json",
      url: "core/generate-json.php",
      extraParams: {
        uid: localStorage.getItem("uid"),
      },
    },
    eventClick: function (info) {
      const tt = info.event.title,
        ds = moment(info.event.start).format("DD-MM-YYYY"),
        de = moment(info.event.end).subtract(1, "days").format("DD-MM-YYYY"),
        dp = info.event.extendedProps.desc,
        hs = info.event.extendedProps.hourstar,
        he = info.event.extendedProps.hourend;
      Swal.fire({
        html: `<h2 class="swal2-title" style="color: ${info.event.backgroundColor}">${tt}</h2>
                <table class="table">
                  <tr>
                      <th><p class="mb-0">📅 Fecha inicio</p></th>
                      <th><p class="mb-0">📅 Fecha fin</p></th>
                  </tr>
                  <tr>
                      <td>${ds}</td>
                      <td>${de}</td>
                  </tr>
                  <tr>
                      <th><p class="mb-0">⏰ Hora inicio</p></th>
                      <th><p class="mb-0">⏰ Hora fin</p></th>
                  </tr>
                  <tr>
                      <td>${hs}</td>
                      <td>${he}</td>
                  </tr>
                  <tr>
                      <td colspan="2">${dp}</td>
                  </tr>
                </table>`,
        showCloseButton: false,
        confirmButtonText: "Cerrar",
        confirmButtonColor: info.event.backgroundColor,
      });
    },
  });
  calendar.render();
}

function updtFullCalendar() {
    calendar.refetchEvents();
}

export{ fullcalendar, updtFullCalendar };