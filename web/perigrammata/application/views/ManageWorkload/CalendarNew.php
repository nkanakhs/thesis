<input type="hidden" id="courseId" value="<?php echo $courseID; ?>" />
<input type="hidden" id="language" value="<?php echo $_SESSION['lang']; ?>" />

<body class="hold-transition sidebar-mini ">
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
              <a href="<?php echo URL; ?>ProfessorNewController/Calendar?CourseId=<?php echo $courseID; ?>" class="nav-link  active ">
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
              <a href="<?php echo URL; ?>ProfessorNewController/PartnerWorkload?CourseId=<?php echo $courseID; ?>" class="nav-link ">
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
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Πρόγραμμα</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index"><?php echo $title[0]['CourseTitle']; ?></a></li>
                <li class="breadcrumb-item active">Πρόγραμμα</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
              <div class="sticky-top mb-3">

                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Νέα εισαγωγή</h3>
                  </div>
                  <div class="card-body">
                    <!-- /btn-group -->
                    <div class="input-group">
                      <label>Συνεργάτες</label>
                      <select id="partner" name="partner" title="partner" class="form-control select2bs4" style="width: 100%;">
                        <option value="" disabled selected hidden><?php echo "Συνεργάτες"; ?></option>
                        <?php foreach ($professorsId as $row => $professor) {
                        ?>
                          <option value="<?php echo $professor['ProfessorId']; ?>"><?php echo $professor['firstname'] . " " . $professor['lastname']; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                      <label>Τύπος</label>
                      <select name="activities" id="activities" title="activities" class="form-control" style="width: 100%;">
                        <option value="" disabled selected hidden><?php echo "Τύποι Διδασκαλίας"; ?></option>
                        <?php foreach ($activities as $row => $activity) {
                        ?>
                          <option value="<?php echo $activity['ActivityId']; ?>"><?php echo $activity['Activities']; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                      <label>Τμήμα</label>
                      <select type="text" name="section" id="section" title="section" class="form-control" style="width: 100%;">

                        <option value="" disabled selected hidden><?php echo "Επιλέξτε Τμήμα"; ?></option>

                      </select>

                      <!-- /btn-group -->
                    </div>
                    <br>
                    <div class="text-center">
                      <button id="add-new-event" type="button" class="btn btn-outline-secondary">Προσθήκη</button>
                    </div>
                    <!-- /input-group -->
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Σύρετε για εισαγωγή</h4>
                  </div>
                  <div class="card-body">
                    <!-- the events -->
                    <div id="external-events">

                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Αυτόματη Συμπλήρωση Εξαμήνου</h4>
                  </div>
                  <div class="card-body">
                    <div class="text-center">
                      <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#autoformModal" style="text-transform: none;">Προσθήκη</button>
                    </div>

                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card card-primary">
                <div class="card-body p-0">
                  <!-- THE CALENDAR -->
                  <div id="calendar">

                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!--modal for auto insertion of the schedule-->
    <label id="autoform">
      <div class="modal fade" id="autoformModal">
        <form id="learningOutcomes" method="POST" action="<?php echo URL . "ProfessorNewController/CalendarAutoComplete?CourseId=" . $courseID; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title">Αυτόματη Υποβολή Προγράμματος</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- the events -->
              <div class="form-group">
                <div class="modal-body">
                  <h4>Πρότυπο Εβδομάδα</h4>
                  <section class="content">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-6">
                          <label>Αρχική ημερομηνία:</label>
                          <div class="input-group date" id="startingdate" data-target-input="nearest">
                            <input type="text" title="startingdate" placeholder="Επιλέξτε Αρχική Ημερομηνία" class="form-control datetimepicker-input" name="startingdate" data-target="#startingdate" />
                            <div class="input-group-append" data-target="#startingdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>Τελική ημερομηνία:</label>
                          <div class="input-group date" id="endingdate" data-target-input="nearest">
                            <input type="text" title="endingdate" placeholder="Επιλέξτε Τελική Ημερομηνία" class="form-control datetimepicker-input" name="endingdate" data-target="#endingdate" />
                            <div class="input-group-append" data-target="#endingdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-md-8">
                          <label>Υποβολή εώς:</label>
                          <div class="input-group date" id="finaldate" data-target-input="nearest">
                            <input type="text" title="finaldate" placeholder="Επιλέξτε Καταληκτική Ημερομηνία" class="form-control datetimepicker-input" name="finaldate" data-target="#finaldate" />
                            <div class="input-group-append" data-target="#finaldate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                  <br>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                  <button type="submit" name="finish_creation" id="finish_creation" class="btn btn-outline-secondary"><i class="far fa-save"></i> <?php echo t_save; ?></button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        </form>
      </div>
    </label>

    <!-- /.modal for auto insertion of the schedule-->

    <!--  modal for editing or delete an event-->
    <div class="modal fade" id="deleteEventModalOutside" tabindex="-1" role="dialog" aria-labelledby="deleteEventModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteEventModalLabel">Επεξεργασία ή διαγραφή</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-8">
                    <label>Τύπος</label>
                    <select name="ActivityEdit" id="ActivityEdit" title="ActivityEdit" class="form-control" style="width: 100%;">
                      <option value="" disabled selected hidden><?php echo "Τύποι Διδασκαλίας"; ?></option>
                      <?php foreach ($activities as $row => $activity) {
                      ?>
                        <option value="<?php echo $activity['ActivityId']; ?>"><?php echo $activity['Activities']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <label>Name:</label>
                    <select id="NameEdit" name="NameEdit" title="NameEdit" class="form-control select2bs4" style="width: 100%;">
                      <option value="" disabled selected hidden><?php echo "Συνεργάτες"; ?></option>
                      <?php foreach ($professorsId as $row => $professor) {
                      ?>
                        <option value="<?php echo $professor['ProfessorId']; ?>"><?php echo $professor['firstname'] . " " . $professor['lastname']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <label>Τμήμα:</label>
                    <select type="text" name="SectionEdit" id="SectionEdit" title="SectionEdit" class="form-control" style="width: 100%;">

                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="EditEventButton" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-danger" id="deleteEventButton">Delete</button>
              </div>
          </div>
        </div>
      </div>
      <!--  ./modal for editing or delete an event-->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>

    <!-- /.modal -->
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI -->
    <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
    <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/fullcalendar/main.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


    <script>
      //Date picker
      $(function() {
        $('#activities').on('change', function() {
          $('#section').empty();
          var activity = $(this).val();
          var courseId = $('#courseId').val();
          $.ajax({
            url: 'getSectionsForSelectedActivity',
            type: 'GET',
            data: {
              activity: activity,
              courseId: courseId
            },
            success: function(response) {
              response = JSON.parse(response)
              //console.log(response[0].sectionNumber)
              for (var i = 1; i <= response[0].sectionNumber; i++) {
                $('#section').append('<option value="' + i + '">' + i + '</option>')
              }
            },
          })
        })

        $('#ActivityEdit').on('change', function() {
          $('#SectionEdit').empty();
          var activity = $('#ActivityEdit').val();
          var courseId = $('#courseId').val();

          $.ajax({
            url: 'getSectionsForSelectedActivity',
            type: 'GET',
            data: {
              activity: activity,
              courseId: courseId
            },
            success: function(response) {
              response = JSON.parse(response)
              //console.log(response[0].sectionNumber)
              for (var i = 1; i <= response[0].sectionNumber; i++) {
                $('#SectionEdit').append('<option value="' + i + '">' + i + '</option>')
              }
            },
          })
        })
        //for the alerts
        var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });

        $('#startingdate').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
        });

        $('#endingdate').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
        });

        $('#finaldate').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
        });

        $('#startingdate, #endingdate, #finaldate').click(function(event) {
          event.preventDefault();
          event.stopPropagation();
        });
        $('#autoformModal .modal-body').click(function(event) {
          // Prevent modal from closing when clicked inside body
          event.preventDefault();
          event.stopPropagation();
        });

        $('#autoformModal .modal-footer button').click(function(event) {
          // Allow buttons inside modal to close it
          $('#autoformModal').modal('hide');
        });
        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
          ele.each(function() {

            // create an Event Object (https://fullcalendar.io/docs/event-object)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $(this).attr('title') // use the element's text as the event title
            }

            // store the Event Object in the DOM element so we can get to it later
            $(this).attr('data-eventObject', JSON.stringify(eventObject));

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true, // will cause the event to go back to its
              revertDuration: 0 //  original position after the drag
            })

          })
        }

        ini_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        // initialize the external events
        // -----------------------------------------------------------------


        new Draggable(containerEl, {
          itemSelector: '.external-event',
          eventData: function(eventEl) {
            return {

              title: eventEl.innerText,
              backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
              borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
              textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
              extendedProps: {
                id: eventEl.getAttribute('id'),
                value: eventEl.getAttribute('value'),
                section: eventEl.getAttribute('data-custom'),
              }
            };
          }
        });

        var calendar = new Calendar(calendarEl, {

          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          themeSystem: 'bootstrap5',
          //Random default events
          editable: true,
          droppable: true, // this allows things to be dropped onto the calendar !!!
          // event handler for drop

          //DELETE
          eventClick: function(info) {
            $('#deleteEventModalOutside').modal('show');
            var modal = document.getElementById('deleteEventModalOutside');
            // getting the ending time to check the conflincts in case the edit changes professor
            var dateEnd = moment(info.event.end).format();
            var date2 = new Date(dateEnd);
            var sqlEndTime =('0' + date2.getHours()).slice(-2) + ':' +
              ('0' + date2.getMinutes()).slice(-2) + ':' +
              ('0' + date2.getSeconds()).slice(-2);

            var datetime = moment(info.event.start).format();
            var date = new Date(datetime);
            var sqldate = date.getFullYear() + '-' +
              ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
              ('0' + date.getDate()).slice(-2);
            var sqlStarttime = ('0' + date.getHours()).slice(-2) + ':' +
              ('0' + date.getMinutes()).slice(-2) + ':' +
              ('0' + date.getSeconds()).slice(-2);
            //console.log(info.event._def.title);
            var activityid = info.event.extendedProps.value;
            var profid = info.event.extendedProps.id;
            var section = info.event.extendedProps.section;
            // Set the event ID as a data attribute on the delete button
            $('select[name="NameEdit"]').val(profid);
            $('select[name="ActivityEdit"]').val(activityid);
            $('select[name="SectionEdit"]').val(section);
            $('#ActivityEdit').trigger('change');
            //here we delete the event
            $('#deleteEventButton').on('click', function() {
              var courseId = $('#courseId').val();
                // Delete the event here

                $.ajax({
                  url: 'CalendarDelete',
                  type: 'POST',
                  data: {
                    profid: profid,
                    activityid: activityid,
                    date: sqldate,
                    courseId: courseId,
                    time: sqlStarttime,
                    section: section
                  },
                  success: function(response) {
                    // remove the event from calendar
                    info.event.remove();
                  },
                  error: function(xhr, status, error) {
                    // handle the error if needed
                  }
                });
                $('#deleteEventModalOutside').modal('hide');
            });
            //here we edit the activity or the partner
            $('#EditEventButton').on('click', function() {
              NameEdit = $('select[name="NameEdit"]').val();
              ActivityEdit = $('select[name="ActivityEdit"]').val();
              section = $('#SectionEdit').val();

              $.ajax({
                url: 'CalendarUpdateEdit',
                type: 'POST',
                data: {
                  profid: profid,
                  activityid: activityid,
                  date: sqldate,
                  courseId: courseId,
                  time: sqlStarttime,
                  endTime : sqlEndTime,
                  newProf: NameEdit,
                  newActivity: ActivityEdit,
                  section: section
                },
                success: function(response) {
                  // redirect so the calendar get rerendered
                  window.location.href = "/perigrammata/ProfessorNewController/Calendar?CourseId=" + courseId;
                },
                error: function(xhr, status, error) {
                  // handle the error if needed
                }
              });
              $('#deleteEventModalOutside').modal('hide');

            });
          },
          //when the event first drops into the calendar
          //CREATE
          drop: function(info) {

            var value = info.draggedEl.getAttribute('value');
            var id = info.draggedEl.getAttribute('id');
            var section = info.draggedEl.getAttribute('data-custom');
            //var eventObject = JSON.parse(info.draggedEl.getAttribute('data-eventObject'));
            var courseId = $('#courseId').val();

            var date = info.date;
            var newdate = new Date(date);

            //this to fix the date format
            var mysqlDatetime = newdate.getFullYear() + '-' +
              ('0' + (newdate.getMonth() + 1)).slice(-2) + '-' +
              ('0' + newdate.getDate()).slice(-2) + ' ' +
              ('0' + newdate.getHours()).slice(-2) + ':' +
              ('0' + newdate.getMinutes()).slice(-2) + ':' +
              ('0' + newdate.getSeconds()).slice(-2);

            var sql1date = newdate.getFullYear() + '-' +
              ('0' + (newdate.getMonth() + 1)).slice(-2) + '-' +
              ('0' + newdate.getDate()).slice(-2);

            var sql1start = ('0' + newdate.getHours()).slice(-2) + ':' +
              ('0' + newdate.getMinutes()).slice(-2) + ':' +
              ('0' + newdate.getSeconds()).slice(-2);

            // send an Ajax request to the server with the event data and date
            // need only the start time  here on drop, cause end will be start + 1, if he want longer call Resize
            $.ajax({
              url: 'CalendarPost',
              type: 'POST',
              data: {
                value: value,
                id: id,
                date: mysqlDatetime,
                courseId: courseId,
                day: sql1date,
                start: sql1start,
                section: section
              },
              success: function(response) {
                response = JSON.parse(response);
                if (response.status === "Success") {
                  Toast.fire({
                    icon: 'success',
                    title: 'Επιτυχής ενημέρωση'
                  })
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.status
                  })
                }
              },
              error: function(xhr, status, error) {
                // handle the error if needed
              }
            });
          },
          // UPDATE 1
          eventDrop: function(info) {
            var courseId = $('#courseId').val();
            var newId = info.event.extendedProps.id;
            var newValue = info.event.extendedProps.value;
            var newSection = info.event.extendedProps.section;
            var olddate = moment(info.oldEvent.start).format();
            var olddateEnd = moment(info.oldEvent.end).format();
            var newdate = moment(info.event.start).format();
            var newdateEnd = moment(info.event.end).format();


            var old = new Date(olddate);
            var oldEnd = new Date(olddateEnd);
            var oldsqldate = old.getFullYear() + '-' + ('0' + (old.getMonth() + 1)).slice(-2) + '-' + ('0' + old.getDate()).slice(-2);

            var newD = new Date(newdate);
            var newsqldate = newD.getFullYear() + '-' + ('0' + (newD.getMonth() + 1)).slice(-2) + '-' + ('0' + newD.getDate()).slice(-2);

            var oldsqlStarttime = ('0' + old.getHours()).slice(-2) + ':' + ('0' + old.getMinutes()).slice(-2) + ':' + ('0' + old.getSeconds()).slice(-2);

            if (info.oldEvent.end != null) { //if it is not all day event
              var oldsqlEndtime = ('0' + oldEnd.getHours()).slice(-2) + ':' + ('0' + oldEnd.getMinutes()).slice(-2) + ':' + ('0' + oldEnd.getSeconds()).slice(-2);
            } else { // if it an all day event or a newly droped event with undefined end time
              old.setHours(old.getHours() + 1);
              var oldsqlEndtime = ('0' + old.getHours()).slice(-2) + ':' +
                ('0' + old.getMinutes()).slice(-2) + ':' +
                ('0' + old.getSeconds()).slice(-2);

            }

            var newsqlStarttime = ('0' + newD.getHours()).slice(-2) + ':' + ('0' + newD.getMinutes()).slice(-2) + ':' + ('0' + newD.getSeconds()).slice(-2);

            if (oldsqlStarttime != "00:00:00") { //specific timed event
              if (info.oldEvent.end != null) {
                var newD1 = new Date(newdateEnd);
                var newsqlEndtime = ('0' + newD1.getHours()).slice(-2) + ':' +
                  ('0' + newD1.getMinutes()).slice(-2) + ':' +
                  ('0' + newD1.getSeconds()).slice(-2);

                var diff = moment.duration(moment(newsqlEndtime, 'HH:mm:ss').diff(moment(newsqlStarttime, 'HH:mm:ss'))).asHours();
              } else { //for the bug with null end time at new event posted without refreshing the page
                var newsqlEndtime = ('0' + newD.getHours()).slice(-2) + ':' +
                  ('0' + newD.getMinutes()).slice(-2) + ':' +
                  ('0' + newD.getSeconds()).slice(-2);

                var newsqlEndtime = moment(newsqlEndtime, "HH:mm:ss").add(1, 'hours').format("HH:mm:ss");
                var diff = moment.duration(moment(newsqlEndtime, 'HH:mm:ss').diff(moment(newsqlStarttime, 'HH:mm:ss'))).asHours();
              }
            } else { //all day event
              var newsqlEndtime = ('0' + newD.getHours()).slice(-2) + ':' +
                ('0' + newD.getMinutes()).slice(-2) + ':' +
                ('0' + newD.getSeconds()).slice(-2);

              var newsqlEndtime = moment(newsqlEndtime, "HH:mm:ss").add(1, 'hours').format("HH:mm:ss");
              var diff = moment.duration(moment(newsqlEndtime, 'HH:mm:ss').diff(moment(newsqlStarttime, 'HH:mm:ss'))).asHours();
            }

            //console.log("oldtimestart"+oldsqlStarttime +"oldtimeedn"+oldsqlEndtime +"newtimestart"+newsqlStarttime +"newtimeend"+newsqlEndtime )
            $.ajax({
              url: 'CalendarUpdate',
              type: 'POST',
              data: {
                value: newValue,
                id: newId,
                olddate: oldsqldate,
                oldtime: oldsqlStarttime,
                oldtimeEnd: oldsqlEndtime,
                newdate: newsqldate,
                newstarttime: newsqlStarttime,
                newendtime: newsqlEndtime,
                courseId: courseId,
                duration: diff,
                section: newSection
              },
              success: function(response) {
                response = JSON.parse(response);
                if (response.status === "Success") {
                  Toast.fire({
                    icon: 'success',
                    title: 'Επιτυχής ενημέρωση'
                  })
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.status
                  })
                }
              },
              error: function(xhr, status, error) {
                // handle the error if needed
              }
            });
          },

          // UPDATE 2
          eventResize: function(info) {

            var courseId = $('#courseId').val();
            var newId = info.event.extendedProps.id;
            var newValue = info.event.extendedProps.value;
            var newSection = info.event.extendedProps.section;
            var olddate = moment(info.oldEvent.start).format();
            var olddateEnd = moment(info.oldEvent.end).format();
            var newdate = moment(info.event.start).format();
            var newdateEnd = moment(info.event.end).format();

            var old = new Date(olddate);
            var oldEnd = new Date(olddateEnd);
            var oldsqldate = old.getFullYear() + '-' +
              ('0' + (old.getMonth() + 1)).slice(-2) + '-' +
              ('0' + old.getDate()).slice(-2);

            var newD = new Date(newdate);
            var newsqldate = newD.getFullYear() + '-' +
              ('0' + (newD.getMonth() + 1)).slice(-2) + '-' +
              ('0' + newD.getDate()).slice(-2);

            var oldsqlStarttime = ('0' + old.getHours()).slice(-2) + ':' +
              ('0' + old.getMinutes()).slice(-2) + ':' +
              ('0' + old.getSeconds()).slice(-2);

            if (info.oldEvent.end != null) { //if it is not all day event
              var oldsqlEndtime = ('0' + oldEnd.getHours()).slice(-2) + ':' +
                ('0' + oldEnd.getMinutes()).slice(-2) + ':' +
                ('0' + oldEnd.getSeconds()).slice(-2);
            } else {
              old.setHours(old.getHours() + 1);
              var oldsqlEndtime = ('0' + old.getHours()).slice(-2) + ':' +
                ('0' + old.getMinutes()).slice(-2) + ':' +
                ('0' + old.getSeconds()).slice(-2);
            }

            var newsqlStarttime = ('0' + newD.getHours()).slice(-2) + ':' +
              ('0' + newD.getMinutes()).slice(-2) + ':' +
              ('0' + newD.getSeconds()).slice(-2);

            var newD1 = new Date(newdateEnd);
            var newsqlEndtime = ('0' + newD1.getHours()).slice(-2) + ':' +
              ('0' + newD1.getMinutes()).slice(-2) + ':' +
              ('0' + newD1.getSeconds()).slice(-2);

            var diff = moment.duration(moment(newsqlEndtime, 'HH:mm:ss').diff(moment(newsqlStarttime, 'HH:mm:ss'))).asHours();

            $.ajax({
              url: 'CalendarUpdate',
              type: 'POST',
              data: {
                value: newValue,
                id: newId,
                olddate: oldsqldate,
                oldtime: oldsqlStarttime,
                oldtimeEnd: oldsqlEndtime,
                newdate: newsqldate,
                newstarttime: newsqlStarttime,
                newendtime: newsqlEndtime,
                courseId: courseId,
                duration: diff,
                section: newSection
              },
              success: function(response) {
                response = JSON.parse(response);
                if (response.status === "Success") {
                  Toast.fire({
                    icon: 'success',
                    title: 'Επιτυχής ενημέρωση'
                  })
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.status
                  })
                }
              },
              error: function(xhr, status, error) {
                // handle the error if needed
              }
            });
          },



        });
        // READ
        var courseId = $('#courseId').val();
        $.ajax({
          url: 'CalendarGet',
          type: 'GET',
          data: {
            courseId: courseId
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
                  title: data[index].firstname + " " + data[index].lastname + "," + data[index].Activities,
                  start: new Date(data[index].Day), //, 00 , 00 , 00)
                  extendedProps: {
                    id: data[index].ProfessorId,
                    value: data[index].activityId,
                    section: data[index].SectionNumber
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
                  title: data[index].firstname + " " + data[index].lastname + "," + data[index].Activities + ", Τμήμα:" + data[index].SectionNumber,
                  start: new Date(data[index].Day),
                  end: new Date(data[index].Day),
                  extendedProps: {
                    id: data[index].ProfessorId,
                    value: data[index].activityId,
                    section: data[index].SectionNumber
                  },
                  className: eventcustom,
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

        /* ADDING EVENTS */

        $('#add-new-event').click(function(e) {
          e.preventDefault()
          // Get value and make sure it is not null
          var partval = $('#partner option:selected').val()
          if (partval.length == 0) {
            partval = "";
          }

          var partText = $('#partner option:selected').text()
          if (partval.length == 0) {
            partText = "";
          }

          var activityval = $('#activities option:selected').val()
          if (activityval.length == 0) {
            return
          }

          var activityText = $('#activities option:selected').text()
          if (activityText.length == 0) {
            return
          }

          var sectionText = $('#section').val()
          if (sectionText.length == 0) {
            sectionText = "1";
          }
          // Create events
          var event = $('<div />')
          if (activityval == 1) {
            event.css({
              'background-color': '#dda0dd',
              'border-color': '#ccd',
              'color': '#fff'
            }).addClass('external-event ')
          } else if (activityval == 2) {
            event.css({
              'background-color': '#6a5acd',
              'border-color': '#ccd',
              'color': '#fff'
            }).addClass('external-event ')
          } else if (activityval == 3) {
            event.css({
              'background-color': '#646034',
              'border-color': '#ccd',
              'color': '#fff'
            }).addClass('external-event ')
          } else if (activityval == 4) {
            event.css({
              'background-color': '#9acd32',
              'border-color': '#ccd',
              'color': '#fff'
            }).addClass('external-event ')
          } else if (activityval == 12) {
            event.css({
              'background-color': '#cd853f',
              'border-color': '#ccd',
              'color': '#fff'
            }).addClass('external-event ')
          }
          event.text(partText + "," + activityText + ", Τμήμα:" + sectionText)
          event.attr("id", partval)
          event.attr("value", activityval)
          event.attr("data-custom", sectionText)
          $('#external-events').prepend(event)

          // Add draggable funtionality
          ini_events(event)

          // Remove event from text input
          $('#new-event').val('')
        })

      })
    </script>
</body>

</html>