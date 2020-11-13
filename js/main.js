$(document).ready(function(){
    //Iniciador del calendario
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
    
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            height: 'parent',
            header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            defaultView: 'dayGridMonth',
            //defaultDate: '2020-02-12',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: []
        });
    
        calendar.render();
    });
});

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

