import { updtFullCalendar } from './fullcalendar.js';

function createEvent() {
    updtFullCalendar();
}

function deleteEvent(eid) {
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
                        text: 'Tu evento a quedado en el olvido',
                        icon: 'success',
                        confirmButtonText: 'Vale'
                    });
                    $('#eventModal').modal('hide');
                    updtFullCalendar();
                } else {
                    console.error(msg);
                    Swal.fire({
                        icon: "error",
                        text: "Debe llenar mínimo el campo título, fecha de inicio, hora de inicio y descripción.",
                    });
                }
            });
        }
    });
}

function updateEvent(eid, data) {
    $('#eventModal').modal('hide');
    $('#btnSaveUpdt').hide();
    updtFullCalendar();
}

function updateInputsData() {
    /* Toma los string y coloca estos en inputs según dato */
    $.each( $('.dataUpdt'), (idx, val) => {
        let data = $(val).text();
        // Formatea la fecha
        let dataConv = idx == 1 || idx == 2  ? moment(data, 'DD-MM-YYYY').format('YYYY-MM-DD') : data;

        if (idx == 0) {
            $(val).html(`<input type="text" class="form-control dataUpdt" value="${ dataConv }">`);
        }else if (idx <= 2) {
            dataConv == 'Sin fecha' ? $(val).html(`<input type="date" class="form-control dataUpdt">`) : $(val).html(`<input type="date" class="form-control dataUpdt" value="${ dataConv }">`);
        } else if (idx <= 4) {
            dataConv == 'Sin hora' ? $(val).html(`<input type="time" class="form-control dataUpdt">`) : $(val).html(`<input type="time" class="form-control dataUpdt" value="${ dataConv }">`);
        }else{
            $(val).html(`<textarea class="form-control dataUpdt" rows="3"></textarea>`);
            $('textarea.dataUpdt').val(dataConv);
        }
    });
    $('#btnSaveUpdt').show()
}


export { createEvent, updateEvent, deleteEvent, updateInputsData }