<input type="hidden" id="courseId" value="<?php echo $courseID; ?>" />
<input type="hidden" id="language" value="<?php echo $_SESSION['lang']; ?>" />
<input type="hidden" id="canvases" value="<?php echo $maxcanvas[0]['max']; ?>" />

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
              <a href="<?php echo URL; ?>ProfessorNewController/Admin?CourseId=<?php echo $courseID; ?>" class="nav-link active">
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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Ποσοστιαίο Φόρτο Εξαμήνου</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index"><?php echo $title[0]['CourseTitle']; ?></a></li>
                <li class="breadcrumb-item active">Διαγράμματα Φόρτου</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Bar chart -->
      <?php
      for ($i = 1; $i <= $maxcanvas[0]['max']; $i++) {
      ?>
        <!-- card-body -->
        <div class="card-body">
          <!-- CODE GOES HERE -->

          <div class="card card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="far fa-chart-bar"></i>
                Τμήμα <?php echo $i; ?>
              </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="barChart<?php echo $i; ?>" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body-->
          </div>
          <!-- ./CODE GOES HERE -->
        </div>

        <!-- /.card-body -->

      <?php
      }
      ?>

      <!-- /.card -->

      <!-- /.content -->
      <section class="content">
    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
  <!-- jsGrid -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jsgrid/jsgrid.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
  <!-- Page specific script -->


  <!-- Bootstrap 4 -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  </script>
  <!-- dika moy 
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->

  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- ChartJS -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/sparklines/sparkline.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- FLOT CHARTS -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/flot/jquery.flot.js"></script>
  <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/flot/plugins/jquery.flot.resize.js"></script>
  <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/flot/plugins/jquery.flot.pie.js"></script>


  <!-- our JavaScript -->
  <script src="<?php echo URL; ?>public/js/manageProfs.js"></script>
  <script>
    $(function() {

      var courseId = $('#courseId').val();
      $.ajax({
        url: 'dataForChart',
        type: 'GET',
        data: {
          CourseId: courseId
        },
        success: function(response) {

          var canvases = $('#canvases').val();
          for (var canvasCnt = 1; canvasCnt <= canvases; canvasCnt++) {
            var colptr = 1;
            var inputs = JSON.parse(response);
            var output = [];
            // code below to fix an array with semester_hours for each of the 5 activities for every professor
            if (inputs.data1.length > 0) {
              //console.log(inputs.data1);
              //if no workload is inserted yet, skip this
              output = inputs.data1.reduce((acc, curr) => {
                const index = acc.findIndex(item => item.label === curr.lastname);
                if (index !== -1) {
                  if (curr.activity && curr.activity >= 1 && curr.activity <= 5 && curr.section_number == canvasCnt) {
                    acc[index].data[curr.activity - 1] = Number(curr.semester_hours);
                  } else if (curr.activity && curr.activity == 12 && curr.section_number == canvasCnt) {
                    //for seminars
                    acc[index].data[4] = Number(curr.semester_hours);
                  }
                  colptr++;
                } else {
                  const data = Array(5).fill(0); // fill with zeroes, and the fill each position depending on activityId with semester_hours value
                  const color = getColorForId(curr.profid, colptr);
                  if (curr.activity && curr.activity >= 1 && curr.activity <= 5 && curr.section_number == canvasCnt) {
                    data[curr.activity - 1] = Number(curr.semester_hours);
                  } else if (curr.activity && curr.activity == 12 && curr.section_number == canvasCnt) {
                    data[4] = Number(curr.semester_hours);
                  }
                  if (curr.section_number == canvasCnt) {
                    acc.push({
                      label: curr.lastname,
                      data: data,
                      backgroundColor: color,
                      borderColor: color
                    });
                  }

                }
                return acc;
              }, []);
            } else {
              output.push({
                label: "Καθηγητές",
                backgroundColor: '#654'
              })
            }
            //to fill the course hours
            var basicArray = Array(5).fill(0);
            for (var i = 0; i < inputs.data.length; i++) {
              if (inputs.data[i].section_number == canvasCnt) {
                if (inputs.data[i].activity == 1) {
                  basicArray[0] = inputs.data[i].semester_hours;
                } else if (inputs.data[i].activity == 2) {
                  basicArray[1] = inputs.data[i].semester_hours;
                } else if (inputs.data[i].activity == 3) {
                  basicArray[2] = inputs.data[i].semester_hours;
                } else if (inputs.data[i].activity == 4) {
                  basicArray[3] = inputs.data[i].semester_hours;
                } else if (inputs.data[i].activity == 12) {
                  basicArray[4] = inputs.data[i].semester_hours;
                }
              }
            }
            //console.log(basicArray);
            output.push({
              label: 'Σύνολο Μαθήματος',
              backgroundColor: 'rgba(60,141,188,0.9)',
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: basicArray,
            })
            //console.log(output);
            var areaChartData = {
              labels: ['Διαλέξεις', 'Εργαστήρια', 'Φροντιστήρια', 'Εργαστήρια/Φροντ Ασκήσεις', 'Σεμινάρια'],
              datasets: output
            }

            var barChartCanvas = $('#barChart' + canvasCnt).get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]

            if (typeof areaChartData.datasets[1] === 'undefined') { // in case the other sections are not yet filled with hours
              var temp1 = {
                label: "Καθηγητές",
                backgroundColor: '#654'
              }
            } else {
              var temp1 = areaChartData.datasets[1]
            }
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
              responsive: true,
              maintainAspectRatio: false,
              datasetFill: false
            }

            new Chart(barChartCanvas, {
              type: 'bar',
              data: barChartData,
              options: barChartOptions
            })
          }
        }
      });


      function getColorForId(id, curr) {
        color = parseInt(id) + (parseInt(curr) * 250);
        return '#' + color;
      }


    });
  </script>

</body>

</html>