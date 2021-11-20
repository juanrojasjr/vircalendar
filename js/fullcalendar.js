document.addEventListener("DOMContentLoaded", function () {
  const calendarEl = document.getElementById("calendar");
  if (calendarEl != null) {
      let calendar = new FullCalendar.Calendar(calendarEl, {
        locale: "es",
        initialView: "dayGridMonth",
        customButtons: {
            btnAddEvent: {
                text: 'Agregar evento',
                click: function() {
                    let hex = Math.random().toString(16).substr(2, 6);
                    $("#addEvent").modal("show");
                    $("#cl").val("#" + hex);
                }
            }
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
        },
        eventClick: function(info) {
            //console.log(info);
            //console.log(info.event.backgroundColor);
            const tt = info.event.title,
                ds = moment(info.event.start).format("DD-MM-YYYY"),
                de = moment(info.event.end).subtract(1, 'days').format("DD-MM-YYYY"),
                dp = info.event.extendedProps.desc,
                hs = info.event.extendedProps.hourstar,
                he = info.event.extendedProps.hourend;
            //console.log(tt + ' == ' + ds + ' == ' + de + ' == ' + dp + ' == ' + hs + ' == ' + he);
            Swal.fire({
                title: tt,
                html:
                  `<table class="table">
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
                confirmButtonText: 'Cerrar',
                confirmButtonColor: info.event.backgroundColor
            });
        }
    });
    calendar.render();
  }
});

/** FullCalendar  **/
function fullCalendar() {
  let calendarEl = document.getElementById("calendar"),
    calendar = new FullCalendar.Calendar(calendarEl, {
      locale: "es",
      plugins: ["dayGrid", "interaction"],
      defaultView: "dayGridMonth",
      header: {
        left: "today, prev, next",
        center: "title",
        right: "btnAddEvent",
      },
      customButtons: {
        btnAddEvent: {
          text: "Agregar evento",
          click: function () {
            var hex = Math.random().toString(16).substr(2, 6);
            $("#addEvent").modal("show");
            $("#cl").val("#" + hex);
            Swal.fire({
                title: tt,
                icon: "info",
                html:
                  '<p><span class="font-weight-bold">Fecha inicio:</span> ' +
                  ds +
                  "</p>" +
                  '<p><span class="font-weight-bold">Fecha fin:</span> ' +
                  de +
                  "</p>" +
                  '<p><span class="font-weight-bold">Hora inicio:</span> ' +
                  hs +
                  "</p>" +
                  '<p><span class="font-weight-bold">Hora fin:</span> ' +
                  he +
                  "</p>" +
                  '<p><span class="font-weight-bold">Descripción:</span> ' +
                  dp +
                  "</p>",
                showCloseButton: true,
              });
          },
        },
      },
      events: {
        method: "POST",
        dataType: "json",
        url: "core/generate-json.php",
      },
      eventClick: function (info, jsEvent, view) {
        console.log(info.event.description);
        const tt = info.event.title,
          ds = moment(info.event.start).format("DD-MM-YYYY"),
          de = moment(info.event.end).format("DD-MM-YYYY"),
          dp = info.event.description,
          hs = info.event.hourstar,
          he = info.event.hourend;
        Swal.fire({
          title: tt,
          icon: "info",
          html:
            '<p><span class="font-weight-bold">Fecha inicio:</span> ' +
            ds +
            "</p>" +
            '<p><span class="font-weight-bold">Fecha fin:</span> ' +
            de +
            "</p>" +
            '<p><span class="font-weight-bold">Hora inicio:</span> ' +
            hs +
            "</p>" +
            '<p><span class="font-weight-bold">Hora fin:</span> ' +
            he +
            "</p>" +
            '<p><span class="font-weight-bold">Descripción:</span> ' +
            dp +
            "</p>",
          showCloseButton: true,
        });
      },
    });
  calendar.render();
}
