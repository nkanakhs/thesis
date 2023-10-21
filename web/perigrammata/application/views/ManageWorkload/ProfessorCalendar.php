<input type="hidden" id="userId" value="<?php echo $_SESSION['user_id']; ?>" />


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-2"></div>
      <div class="col-sm-4">
        <h1>Το Πρόγραμμα Μου</h1>
      </div>
      <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index">Αρχική</a></li>
          <li class="breadcrumb-item active">Το πρόγραμμα μου</li>
        </ol>
      </div>

      <div class="col-sm-4"></div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<br>
<div class="row">
  <div class="col-md-8 offset-md-2">

    <div id="partnerWorloadCalendar"></div>
    <i>*Downloads the Schedule in .ics format</i>
  </div>
</div>
<br>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ./wrapper -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/fullcalendar/main.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<!-- our JavaScript -->
<script src="<?php echo URL; ?>public/js/manageProfs.js"></script>
<script src="<?php echo URL; ?>public/FileSaver.js-master/src/FileSaver.js"></script>

<script>
  $(function() {

    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('partnerWorloadCalendar');

    //console.log(partnersId);
    $('#partnerWorloadCalendar').addClass("card card-primary");
    $('#partnerWorloadCalendar').addClass("card-body");

    var calendar = new Calendar(calendarEl, {

      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap5'
    });

    var userId = $('#userId').val();
    $.ajax({
      url: 'CalendarMyWorkload',
      type: 'GET',
      data: {
        userId: userId
      },
      success: function(response) {
        // handle the server response if needed
        var data = JSON.parse(response)
        //console.log(data);
        $.each(data, function(index, value) {
          var eventcustom;
          if (data[index].activityId == 1) {
            eventcustom = 'event-custom1';
          } else if (data[index].activityId == 2) {
            eventcustom = 'event-custom2';
          } else if (data[index].activityId == 3) {
            eventcustom = 'event-custom3';
          } else if (data[index].activityId == 4) {
            eventcustom = 'event-custom4';
          } else if (data[index].activityId == 12) {
            eventcustom = 'event-custom5';
          }
          //if an event is set for all day
          if (data[index].StartTime == '00:00:00') {
            var event = {
              title: data[index].firstname + " " + data[index].lastname + "," + data[index].LessonCode,
              start: new Date(data[index].Day), //, 00 , 00 , 00)
              extendedProps: {
                id: data[index].ProfessorId,
                value: data[index].activityId,
              },
              //color: color,
              className: eventcustom,
              allDay: true
            };
          } else {
            //to format the time
            var startTime = data[index].StartTime.split(":");
            var startHours = parseInt(startTime[0]);
            var startMinutes = parseInt(startTime[1]);
            var startSeconds = parseInt(startTime[2]);
            var endTime = data[index].EndTime.split(":");
            var endHours = parseInt(endTime[0]);
            var endMinutes = parseInt(endTime[1]);
            var endSeconds = parseInt(endTime[2]);
            var event = {
              title: data[index].LessonCode + "," + data[index].Activities,
              start: new Date(data[index].Day),
              end: new Date(data[index].Day),
              extendedProps: {
                id: data[index].ProfessorId,
                value: data[index].activityId
              },
              className: eventcustom
            };
            event.start.setHours(startHours);
            event.start.setMinutes(startMinutes);
            event.start.setSeconds(startSeconds);
            event.end.setHours(endHours);
            event.end.setMinutes(endMinutes);
            event.end.setSeconds(endSeconds);
          }

          calendar.addEvent(event);
        });

      },
      error: function(xhr, status, error) {
        // handle the error if needed
      }

    });

    calendar.render();

    var $button = $('<button/>', {
      type: 'button',
      text: 'Λήψη ',
      class: 'btn btn-secondary',
      click: downloadEvents
    });

    var $icon = $('<i/>', {
      class: 'fas fa-save'
    });

    $button.append($icon);

    function downloadEvents() {
      // Get the currently rendered events
      var events = calendar.getEvents();

      // Convert the events to the appropriate format (i.e., iCalendar format)
      const icalData = convertEventsToICal(events);

      // Create a downloadable file
      const file = new Blob([icalData], {
        type: 'text/calendar;charset=utf-8'
      });
      saveAs(file, 'calendar_events.ics');
    }

    $('#partnerWorloadCalendar').after($button);


    function convertEventsToICal(events) {
      let lines = [
        'BEGIN:VCALENDAR',
        'VERSION:2.0',
        'PRODID:-//Tuc//MyWorkload',
        'CALSCALE:GREGORIAN'
      ];

      for (const event of events) {

        var start = moment(event.start).utc().format('YYYYMMDDTHHmmss[Z]');
        var end = moment(event.end).utc().format('YYYYMMDDTHHmmss[Z]');
        lines.push('BEGIN:VEVENT');
        lines.push(`DTSTART:${start}`);
        lines.push(`DTEND:${end}`);
        lines.push(`SUMMARY:${event.title}`);
        lines.push('END:VEVENT');
      }

      lines.push('END:VCALENDAR');

      return lines.join('\n');
    }

  });
</script>

</body>

</html>