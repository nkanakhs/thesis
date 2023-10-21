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
              <a href="<?php echo URL; ?>ProfessorNewController/PartnerWorkload?CourseId=<?php echo $courseID; ?>" class="nav-link ">
                <i class="fa fa-search-plus"></i>
                <p>
                  Πρόγραμμα Συνεργατών
                </p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
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
                  <a href="<?php echo URL; ?>ProfessorNewController/OlderGrades?CourseId=<?php echo $courseID; ?>" class="nav-link active">
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
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Αρχείο Βαθμολογιών</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index"><?php echo $title[0]['CourseTitle']; ?></a></li>
                <li class="breadcrumb-item active">Παλαιότερες Βαθμολογίες</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <section class="content">

        <?php
        if (empty($Semesters)) {
        ?>
          <div class="row">
            <div class="col-12">
              <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Σημείωση:</h5>
                &nbsp;Δεν υπάρχουν παλαιότερες εισαγωγές για το μάθημα.
              </div>
            </div>
          </div>
        <?php
        } else {
        ?>
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Επιλογή Εξαμήνου</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <br>
            <div class="card-body">
              <div class="row">
              <?php
              foreach ($Semesters as $Semester) {
                echo '<button type="button" id="Semester-' . $Semester['Id'] . '" name="' . $Semester['Id'] . '" class="btn btn-block btn-default">' . $Semester['Start_year'] . '-' . $Semester['End_year'] . ',' . $Semester['Title'] . '</button>';
              }
            }
              ?>
              </div>
              <div class="col-sm-2"></div>
            </div>
            <br>
          </div>


          <div id="results">
            <section id="sectionHide" class="content" style="display: none">

              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Επιλογή Εξαμήνου</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <br>
                <div class="card-body">
                  <table id="results-table" class="table table-bordered table-striped" style="display: none;">
                    <thead>
                      <tr>
                        <th>AEM</th>
                        <th>Όνομα</th>
                        <th>Επίθετο</th>
                        <th>Βαθμός</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </section>
          </div>
    </div>
    </section>
  </div>

  <!-- jQuery -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <!-- jsGrid -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jsgrid/jsgrid.min.js"></script>
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/dist/js/adminlte.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


  <!-- our JavaScript -->
  <script>
    $(function() {

      $('[id^="Semester-"]').click(function() {

        semester = ($(this).attr('name')); //get the id of the semester depending on the button

        var courseId = $('#courseId').val();

        $.ajax({
          url: 'GetOlderGradesForSelectedSemester',
          type: 'GET',
          data: {
            semester: semester,
            courseId: courseId
          },
          success: function(response) {
            data = JSON.parse(response)

            var table = $('#results-table').show().DataTable({
              "responsive": true,
              "lengthChange": false,
              "autoWidth": false,
              "destroy": true
            });
            if (data.length > 0) {
              //first empty results, if new query is inserted
              table.clear();

              for (var i = 0; i < data.length; i++) {
                table.row.add([
                  data[i].student_am,
                  data[i].first_name,
                  data[i].lastname,
                  data[i].grade
                ])
              }

              table.draw();

              $('#sectionHide').show()

            } else {

            }
          }

        })
      });

    })
  </script>
</body>

</html>