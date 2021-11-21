import { updtFullCalendar } from './fullcalendar.js';

function eventInit() {
    $('#btnUpdateInputs').click((e) => {
        e.preventDefault();
        updateInputsData();
        $('#btnUpdateInputs').prop("disabled",true);
    });

    $('#btnSaveUpdt').click((e) => {
        e.preventDefault();
        updateEvent();
    });

    $('#btnDeleteEvent').click((e) => {
        e.preventDefault();
        deleteEvent();
    });

    /* Agregar un nuevo evento */
    $('#addEvent button[type="submit"]').click(function (e) {
        e.preventDefault();
        createEvent()
    });
}

function createEvent() {
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
    }).done((msg) => {
      if (msg == 1) {
        Swal.fire({
          icon: "success",
          text: "Evento creado",
          showConfirmButton: false,
          timer: 1500,
        });
        $("#addEvent").modal("hide");
        updtFullCalendar();
      } else {
        console.error(msg);
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
}

function deleteEvent() {
    let eid = $('#eid').text();
    Swal.fire({
        title: '¡Espera un segundo!',
        text: "¿En realidad quieres eliminar este evento?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: '¡Si, eliminar!',
        cancelButtonText: 'Mejor no'
    }).then((result) => {
        if (result.dismiss != 'cancel') {
            $.ajax({
                method: "POST",
                url: "core/events/delete.php",
                data: {eid: eid}
            }).done( (msg) => {
                if (msg == 1) {
                    Swal.fire({
                        title: '¡Eliminado!',
                        text: 'Tu evento a quedado en el olvido.',
                        icon: 'success',
                        confirmButtonText: 'Vale'
                    });
                    $('#eventModal').modal('hide');
                    updtFullCalendar();
                } else {
                    console.error(msg);
                    Swal.fire({
                        icon: "error",
                        title: "¡Oh no!",
                        text: "Algo ocurrió, revisa el log.",
                    });
                }
            });
        }
    });
}

function updateEvent() {
    let eid = $('#eid').text();
    const dataUpdt = [];
    $.each( $('.dataUpdtInput'), (idx, val) => {
        if (idx == 1) {
            let date = $(val).val();
            let dateFormate = moment(date).format("YYYY-MM-DD");
            dataUpdt.push(dateFormate);
        } else if(idx == 2) {
            let date = $(val).val();
            let dateFormate = moment(date).add(1, 'days').format("YYYY-MM-DD");
            dataUpdt.push(dateFormate);
        }else{
            dataUpdt.push($(val).val())
        }
    });
    $.ajax({
        method: "POST",
        url: "core/events/update.php",
        data: {eid: eid, data: JSON.stringify(dataUpdt)}
    }).done( (msg) => {
        if (msg == 1) {
            Swal.fire({
                title: 'actualizado!',
                text: 'Tu evento quedó actualizado.',
                icon: 'success',
                confirmButtonText: 'Gracias'
            });
            $('#btnSaveUpdt').hide();
            $('#eventModal').modal('hide');
            updtFullCalendar();
        } else {
            console.error(msg);
            Swal.fire({
                icon: "error",
                title: "¡Oh no!",
                text: "Algo ocurrió, revisa el log.",
            });
        }
    });
}

function updateInputsData() {
    /* Toma los string y coloca estos en inputs según dato */
    $.each( $('.dataUpdt'), (idx, val) => {
        let data = $(val).text();
        // Formatea la fecha
        let dataConv = idx == 1 || idx == 2  ? moment(data, 'DD-MM-YYYY').format('YYYY-MM-DD') : data;

        if (idx == 0) {
            $(val).html(`<input type="text" class="form-control dataUpdtInput" value="${ dataConv }">`);
        }else if (idx <= 2) {
            dataConv == 'Sin fecha' ? $(val).html(`<input type="date" class="form-control dataUpdtInput">`) : $(val).html(`<input type="date" class="form-control dataUpdtInput" value="${ dataConv }">`);
        } else if (idx <= 4) {
            dataConv == 'Sin hora' ? $(val).html(`<input type="time" class="form-control dataUpdtInput">`) : $(val).html(`<input type="time" class="form-control dataUpdtInput" value="${ dataConv }">`);
        }else if (idx == 5){
            $(val).html(`<textarea class="form-control dataUpdtInput" rows="3"></textarea>`);
            $('textarea.dataUpdtInput').val(dataConv);
        }else{
            $(val).show();
        }
    });
    $('#btnSaveUpdt').show()
}

export { eventInit, createEvent, updateEvent, deleteEvent, updateInputsData }