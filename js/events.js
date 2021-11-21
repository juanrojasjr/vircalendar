import { updtFullCalendar } from './fullcalendar.js';

function updateEvent() {
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


export { updateEvent, updateInputsData }