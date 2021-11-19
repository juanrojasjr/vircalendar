$(document).ready(function(){
    fullCalendar();
});

/** FullCalendar  **/
function fullCalendar() {
    let calendarEl = document.getElementById('calendar'),
        calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        plugins: ['dayGrid', 'interaction'],
        defaultView: 'dayGridMonth',
        header: {
            left: 'today, prev, next',
            center: 'title',
            right: 'btnAddEvent'
        },
        customButtons: {
            btnAddEvent: {
                text: 'Agregar evento',
                click: function() {
                    var hex = Math.random().toString(16).substr(2,6);
                    $('#addEvent').modal('show');
                    $('#cl').val('#'+hex);
                }
            }
        },
        events:{
            method: "POST",
            dataType: 'json',
            url: "inc/generate-json.php",
        },
        eventClick: function(info, jsEvent, view) {
            console.log(info.event.description );
            const
                tt = info.event.title,
                ds = moment(info.event.start).format('DD-MM-YYYY'),
                de = moment(info.event.end).format('DD-MM-YYYY'),
                dp = info.event.description,
                hs = info.event.hourstar,
                he = info.event.hourend;
            Swal.fire({
                title: tt,
                icon: 'info',
                html:
                    '<p><span class="font-weight-bold">Fecha inicio:</span> ' + ds + '</p>'+
                    '<p><span class="font-weight-bold">Fecha fin:</span> ' + de + '</p>' +
                    '<p><span class="font-weight-bold">Hora inicio:</span> ' + hs + '</p>'+
                    '<p><span class="font-weight-bold">Hora fin:</span> ' + he + '</p>' +
                    '<p><span class="font-weight-bold">Descripción:</span> ' + dp + '</p>',
                showCloseButton: true
            });
        },
    });
    calendar.render();
}

/* Reestablecer contraseña olvidada */
$('#forgot-password button[type="submit"]').click(function (e) { 
    e.preventDefault();
    const 
        username = $('#username').val(),
        alertD = $('.alert.alert-danger'),
        alertS = $('.alert.alert-success');
    alertD.addClass('d-none')
    alertS.addClass('d-none')
    $.ajax({
        method: "POST",
        url: "inc/forgot_password.php",
        data: { username: username }
      }).done(function( msg ) {
            console.log(msg);
            if (msg==0) {
                alertD.removeClass('d-none')
            }else{
                alertS.removeClass('d-none')
            }
        });
});

/* Agregar un nuevo evento */
$('#addEvent button[type="submit"]').click(function (e) { 
    e.preventDefault();
    const 
        tt = $('#tt').val(),
        ds = $('#ds').val(),
        de = $('#endDate').is(':checked') ? $('#de').val() : null,
        hs = $('#hs').val(),
        he = $('#endHour').is(':checked') ? $('#he').val() : null,
        dc = $('#dc').val(),
        cl = $('#cl').val();
    if ($('#tt').val() != "" && $('#ds').val() != "" && $('#hs').val() != "" && $('#dc').val() != "") {
        $.ajax({
            method: "POST",
            url: "inc/addEvent.php",
            data: { tt: tt, ds: ds, de: de, hs: hs, he: he, dc: dc, cl: cl }
            }).done(function( msg ) {
                console.log(msg);
                if (msg == 1) {
                    Swal.fire({
                        icon: 'success',
                        text: 'Evento creado',
                        showConfirmButton: false,
                        timer: 1500
                      });
                      $('#addEvent').modal('hide');
                      $('#calendar').empty();
                      fullCalendar();      
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: 'Contacte con el administrador del sitio',
                        showConfirmButton: false,
                        timer: 1500
                      });
                }
            });
    }else{
        Swal.fire({
            icon: 'error',
            text: 'Debe llenar mínimo el campo título, fecha de inicio, hora de inicio y descripción.',
          });
    }
});

/* Validar checkbox Fecha */
$('#endDate').click(function (e) { 
    if ($(this).is(':checked')) {
        $('#de').prop("disabled", false);
    }else{
        $('#de').prop("disabled", true);
    }
});

/* Validar checkbox Hora */
$('#endHour').click(function (e) { 
    if ($(this).is(':checked')) {
        $('#he').prop("disabled", false);
    }else{
        $('#he').prop("disabled", true);
    }
});

/* Inicio de sesión */
$('#login button[type="submit"]').click(function (e) { 
    e.preventDefault();
    const 
        mail = $('#email').val(),
        pass = $('#password').val();
    $.ajax({
        method: "POST",
        url: "inc/login.php",
        data: { mail: mail, pass: pass }
      }).done(function( msg ) {
            console.log(msg);
            if (msg==1) {
                $(location).attr('href','home');
            }
        });
});

/* Registro de nuevo usuario */
$('#register button[type="submit"]').click(function (e) { 
    e.preventDefault();
    const 
        firstname = $('#firstname').val(),
        lastname = $('#lastname').val(),
        email = $('#email').val(),
        pass = $('#password').val(),
        pass2 = $('#password2').val(),
        phone = $('#phone').val();
    if (pass == pass2) {
        $.ajax({
            method: "POST",
            url: "inc/register.php",
            data: { firstname: firstname, lastname: lastname, email: email, pass: pass, phone: phone }
          }).done(function( msg ) {
                console.log(msg);
                if (msg==1) {
                    alert('Su cuenta ha sido creada.')
                    setTimeout(() => {
                        $(location).attr('href','index')
                    }, 1000);
                }
            });
    }else{ alert('Las contraseñas no son iguales.') }
});

/* Reestablecer contraseña olvidada */
$('#modal-forgotpassword button[type="submit"]').click(function (e) { 
    e.preventDefault();
    const 
        email = $('#email-forgot').val();
    $.ajax({
        method: "POST",
        url: "inc/forgot_password.php",
        data: { email: email }
      }).done(function( msg ) {
            console.log(msg);
            // if (msg==0) {
            //     alertD.removeClass('d-none')
            // }else{
            //     alertS.removeClass('d-none')
            // }
        });
});