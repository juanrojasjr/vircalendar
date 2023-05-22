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
      url: "core/events/read.php",
      extraParams: {
        uid: sessionStorage.getItem("uid"),
      },
    },
    eventClick: function (info) {
      const tt = info.event.title,
        invited = info.event.extendedProps.invited,
        ds = moment(info.event.start).format("DD-MM-YYYY"),
        de = moment(info.event.end).subtract(1, "days").format("DD-MM-YYYY"),
        dp = info.event.extendedProps.desc,
        hs = info.event.extendedProps.hourstar,
        he = info.event.extendedProps.hourend,
        color = info.event.backgroundColor,
        eid = info.event.extendedProps.eid;

        let html = `<div class="visually-hidden" id="eid">${eid}</div>
        <h2 class="swal2-title dataUpdt" style="color: ${color}">${tt}</h2>
        <table class="table">
        <tbody>
                ${invited !== '' ? `<tr style="color: ${color}">
                                        <th colspan="2"><p class="mb-0">🙍‍♀️🙍‍♂️ Invitados</p></th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><p class="mb-0">${invited}</p></th>
                                    </tr>`
                : ''}                
                <tr style="color: ${color}">
                    <th><p class="mb-0">📅 Fecha inicio</p></th>
                    <th><p class="mb-0">📅 Fecha fin</p></th>
                </tr>
                <tr>
                    <td class="dataUpdt">${ds}</td>
                    <td class="dataUpdt">${ de == null ? 'Sin fecha' : de }</td>
                </tr>
                <tr style="color: ${color}">
                    <th><p class="mb-0">⏰ Hora inicio</p></th>
                    <th><p class="mb-0">⏰ Hora fin</p></th>
                </tr>
                <tr>
                    <td class="dataUpdt">${hs}</td>
                    <td class="dataUpdt">${ he == null ? 'Sin hora' : he }</td>
                </tr>
                <tr>
                    <td colspan="2" class="dataUpdt">${dp}</td>
                </tr>
                <tr>
                  <td colspan="2" class="dataUpdt" style="display: none"><input type="color" class="form-control dataUpdtInput" value="${color}"></td>
                </tr>
            </tbody>
        </table>`;

        $('#btnUpdateInputs').prop("disabled",false);
        $('#btnSaveUpdt').hide();
        $('#eventModal .btnClose').css({"background-color": color, "border-color": color})
        $('#eventModal .modal-body').html(html);
        $('#eventModal').modal('show');
    },
  });
  calendar.render();
}

function updtFullCalendar() {
    calendar.refetchEvents();
}

export{ fullcalendar, updtFullCalendar };