
<link href="<?=BASE_URL_SITO?>plugin/fullcalendar/lib/main.css" rel="stylesheet" />
<script src="<?=BASE_URL_SITO?>plugin/fullcalendar/lib/main.js"></script>
<script src="<?=BASE_URL_SITO?>plugin/fullcalendar/lib/locales-all.js"></script>

<script>

  document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendarG');

    var calendar = new FullCalendar.Calendar(calendarEl, {

      timeZone: 'UTC',
      locale: 'it',
        headerToolbar: {
          /* left: 'prev,next today addEventButton', */
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,listWeek'
        },
      disableDragging: true,
      editable: false,
      selectable: false,
      selectMirror: false,
      googleCalendarApiKey: 'AIzaSyAXIgZleYRDFPhH26qsJ9ug1Et18B7eAlI',
      eventSources: [
          {
          googleCalendarId: '<?=EMAILUTENTE?>',
            color: 'orange',   // an option!
            textColor: 'black'
        },  
       {
          googleCalendarId: 'network.service.rimini@gmail.com',
            color: 'light-blue',   // an option!
            textColor: 'white'
        },
      ],

        eventClick: function(arg) {
            // opens events in a popup window
            window.open(arg.event.url, 'google-calendar-event', 'width=900,height=700');

            arg.jsEvent.preventDefault() // don't navigate in main tab
        },

        loading: function(bool) {
            document.getElementById('loading').style.display =
                bool ? 'block' : 'none';
        },

    });

    calendar.render();

  });
</script>
<style>       
    #loading {
        display: none;
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>