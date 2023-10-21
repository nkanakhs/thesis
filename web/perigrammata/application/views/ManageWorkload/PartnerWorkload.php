<input type="hidden" id="courseId" value="<?php echo $courseID; ?>" />
<input type="hidden" id="language" value="<?php echo $_SESSION['lang']; ?>" />


<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo URL; ?>home/index" class="nav-link">Home</a>
        </li>
      </ul>

    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="<?php echo URL; ?>/public/img/education-graduation.png" class="brand-image img-circle elevation-3" alt="User Image">
        <span class="brand-text font-weight-light" style="display: inline-block; max-width: 150px; overflow: hidden; text-overflow: ellipsis;white-space: nowrap;"><?php echo $title[0]['CourseTitle']; ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo URL; ?>/public/img/teacher.png" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['user_username']; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
              <a href="<?php echo URL; ?>ProfessorNewController/EditLearningOutcomes?CourseId=<?php echo $courseID; ?>" class="nav-link  ">
                <i class="fa fa-check"></i>
                <p>
                  Μέθοδος Αξιολόγησης
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo URL; ?>ProfessorNewController/Admin?CourseId=<?php echo $courseID; ?>" class="nav-link">
                <i class="fa fa-users"></i>
                <p>
                  Εισαγωγή Προσωπικού
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo URL; ?>ProfessorNewController/ManageActivities?CourseId=<?php echo $courseID; ?>" class="nav-link ">
                <i class="fa fa-tasks"></i>
                <p>
                  Εισαγωγή Διδακτικών Δραστηριοτήτων
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo URL; ?>ProfessorNewController/Calendar?CourseId=<?php echo $courseID; ?>" class="nav-link  ">
                <i class="far fa-calendar-alt"></i>
                <p>
                  Εισαγωγή Φόρτου
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo URL; ?>ProfessorNewController/ShowStatisticWorkload1?CourseId=<?php echo $courseID; ?>" class="nav-link ">
                <i class="fa fa-chart-line"></i>
                <p>
                  Διαγράμματα Φόρτου ανά Τμήμα
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo URL; ?>ProfessorNewController/AnalyticWorkload?CourseId=<?php echo $courseID; ?>" class="nav-link ">
                <i class="fa fa-table"></i>
                <p>
                  Αναλυτικό Φόρτο ανά Τμήμα
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo URL; ?>ProfessorNewController/PartnerWorkload?CourseId=<?php echo $courseID; ?>" class="nav-link active">
                <i class="fa fa-search-plus"></i>
                <p>
                  Πρόγραμμα Συνεργατών
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-graduation-cap"></i>
                <p>
                  Φοιτητές
                  <i class="fas fa-angle-down right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo URL; ?>ProfessorNewController/InsertStudents?CourseId=<?php echo $courseID; ?>" class="nav-link">
                    <i class="fa fa-paperclip"></i>
                    <p>Εισαγωγή Φοιτητών</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo URL; ?>ProfessorNewController/StudentGrades?CourseId=<?php echo $courseID; ?>" class="nav-link">
                    <i class="fa fa-pen"></i>
                    <p>Βαθμολόγηση</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo URL; ?>ProfessorNewController/OlderGrades?CourseId=<?php echo $courseID; ?>" class="nav-link">
                    <i class="far fa-folder-open"></i>
                    <p>Παλαιότερες Βαθμολογίες</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Αναζήτηση</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index"><?php echo $title[0]['CourseTitle']; ?></a></li>
                <li class="breadcrumb-item active">Πρόγραμμα Συνεργατών</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <br>
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <div class="input-group">
                <input type="search" class="form-control form-control-lg" onkeyup="loadProfessors(this , 1);" placeholder="Πληκτρολογήστε Όνομα ή Επίθετο Συνεργάτη">

              </div>
              <span id="search_result"></span>
              <span id="partner_result"></span>
              <br>
              <div class="text-center">
                <button type="submit" class="btn btn-outline-secondary" id="btnShowResults" style="text-transform: none;">
                  Εμφάνιση <i class="far fa-calendar-alt"></i>
                </button>
              </div>
              <br>
            </div>
          </div>
        </div>
      </section>

      <div id="partnerWorloadCalendar"></div>


      <!-- /.content -->
    </div>

    <!-- THE CALENDAR -->
    <!-- /.card-body -->
    <!-- /.card -->

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

  <script>
    $(document).ready(function() {
      $('#btnShowResults').click(function() {
        NewCalendarRender();
      });
    });

    function NewCalendarRender() {
      $('#partnerWorloadCalendar').html('');
      var Calendar = FullCalendar.Calendar;
      var calendarEl = document.getElementById('partnerWorloadCalendar');

      var partner = $('#partner_result div').text();

      var cardHeader = $('<div>').addClass('card-header');
      var cardTitle = $('<h3>').addClass('card-title').text('Πρόγραμμα: ' + partner);
      cardHeader.append(cardTitle);

      var cardBody = $('<div>').addClass('card-body');

      var card = $('<div>').addClass('card');

      card.append(cardHeader).append(cardBody);

      var col12 = $('<div>').addClass('col-12');

      col12.append(card);

      var row = $('<div>').addClass('row');

      row.append(col12);

      var containerFluid = $('<div>').addClass('container-fluid');

      containerFluid.append(row);

      var section = $('<section>').addClass('content');

      section.append(containerFluid);

      $('#partnerWorloadCalendar').append(section);
      // Append the calendar element to the card body
      calendarEl = cardBody[0]; // Get the DOM element from jQuery object
      cardBody.append(calendarEl);

      var partnersId = document.getElementById('partnersId').value;
      //console.log(partnersId);
      var calendar = new Calendar(calendarEl, {

        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap5'
      });

      var courseId = $('#courseId').val();
      $.ajax({
        url: 'CalendarGetTotalWorkload',
        type: 'GET',
        data: {
          courseId: courseId,
          partnersId: partnersId
        },
        success: function(response) {
          // handle the server response if needed
          var data = JSON.parse(response)

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
                title: data[index].firstname + " " + data[index].lastname + "," + data[index].LessonCode,
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

    }
  </script>

</body>

</html>