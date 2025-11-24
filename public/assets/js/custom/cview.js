$(document).ready(function() {

    $('#modal_calendar_view').on('shown.bs.modal',function(){

        console.log('cal');
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
         // themeSystem: 'bootstrap',
        initialDate: CURRENT_DATE,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
        //   right: 'dayGridMonth'
        },
        longPressDelay:1,
        selectable: false,
        dayMaxEventRows: true,
        events: {
            url: WebURL + '/cview-app',
            type: 'GET',
            error: function() {
            alert('there was an error while fetching events!');
            },
            success: function(res){
            console.log('success!');
            }
        },
    });
    calendar.render();
    })
});
