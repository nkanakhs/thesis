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
              <a href="<?php echo URL; ?>ProfessorNewController/Calendar?CourseId=<?php echo $courseID; ?>" class="nav-link  ">
                <i class="far fa-calendar-alt"></i>
                <p>
                  Εισαγωγή Φόρτου
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo URL; ?>ProfessorNewController/ShowStatisticWorkload1?CourseId=<?php echo $courseID; ?>" class="nav-link  active">
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
              <h1>Διαγράμματα Φόρτου Εξαμήνου</h1>
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
      if (!empty($maxcanvas1)) {
        foreach ($maxcanvas1 as $Id => $canvas) {
      ?>
          <!-- card-body -->
          <div class="card-body">
            <!-- CODE GOES HERE -->

            <div class="card card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  <?php echo $canvas['Activities']; ?>
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
                  <canvas id="barChart<?php echo $canvas['ActivityId']; ?>" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- ./CODE GOES HERE -->
          </div>

          <!-- /.card-body -->

        <?php
        }
      } else {
        ?>

        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Σημείωση:</h5>
              &nbsp;Δεν έχουν δηλωθεί δραστηριότητες για το μαθημα
            </div>
          </div>
        </div>
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
      var canvases = $('#canvases').val();
      $.ajax({
        url: 'dataForChart',
        type: 'GET',
        data: {
          CourseId: courseId
        },
        success: function(response) {

          for (var canvasCnt = 1; canvasCnt <= 12; canvasCnt++) {
            if ($('#barChart' + canvasCnt).length) {
              var colptr = 1;
              var inputs = JSON.parse(response);
              var output = [];
              //to fill the course hours
              var basicArray = Array().fill(0);
              var labelArray = Array().fill(0);
              var j = 0;
              for (var i = 0; i < inputs.data.length; i++) {
                if (inputs.data[i].activity == canvasCnt || (inputs.data[i].activity == 12 && canvasCnt == 12)) {
                  basicArray[j] = inputs.data[i].semester_hours;
                  labelArray[j] = "Τμήμα " + inputs.data[i].section_number;
                  j++;
                }
              }


              for (var i = 0; i < inputs.data1.length; i++) {
                if (inputs.data1[i].activity == canvasCnt || (inputs.data1[i].activity == 12 && canvasCnt == 12)) {
                  var basicArray1 = [];
                  var color = getColorForId(inputs.data1[i].profid);
                  var professorLabel = inputs.data1[i].firstname + " " + inputs.data1[i].lastname;
                  var sectionNumber = inputs.data1[i].section_number;

                  // Find the index of the professor in the output array
                  var professorIndex = output.findIndex((dataset) => dataset.label[0] === professorLabel);

                  // If professor already exists in output, update their data based on section number
                  if (professorIndex !== -1) {
                    output[professorIndex].data[sectionNumber - 1] = inputs.data1[i].semester_hours;
                  } else {
                    // Professor does not exist in output, create a new entry with data based on section number
                    var newData = Array(labelArray.length).fill('');
                    newData[sectionNumber - 1] = inputs.data1[i].semester_hours;

                    output.push({
                      backgroundColor: color,
                      borderColor: color,
                      pointRadius: false,
                      pointColor: '#3b8bba',
                      pointStrokeColor: 'rgba(60,141,188,1)',
                      pointHighlightFill: '#fff',
                      pointHighlightStroke: 'rgba(60,141,188,1)',
                      label: [professorLabel],
                      data: newData
                    });
                  }
                }
              }
              // Remove the existing dataset with the total
              output = output.filter(dataset => dataset.label !== 'Σύνολο Τμήματος');

              output.push({
                label: 'Σύνολο Τμήματος',
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
              if (output.length > 1) {
                [output[0], output[1]] = [output[1], output[0]];
              }

              var totalLabel = "Σύνολο Τμήματος";
              var remainingLabel = "Υπολοιπόμενες";
              var remainingHours = Array(basicArray.length).fill(0);
              var totalProf = Array(basicArray.length).fill(0);

              // Loop through the output datasets
              for (var i = 0; i < output.length; i++) {
                var dataset = output;
                // Skip if the dataset is for the remaining label

                //console.log(dataset);
                // Loop through the data array and add the professors hours for each section
                for (var j = 0; j < output.length; j++) {
                  if (dataset[j].label != totalLabel && dataset[j].label != remainingLabel) {
                    var professorHours = parseFloat(dataset[j].data[i]);
                    if (!isNaN(professorHours)) {
                      //console.log(professorHours);
                      totalProf[i] += professorHours;
                    }
                  }
                }
              }
              //console.log(totalProf);
              for (var k = 0; k < remainingHours.length; k++) {
                remainingHours[k] = parseFloat(basicArray[k]) - totalProf[k];
              }
              // Create the dataset for remaining hours
              output.push({
                label: 'Υπολοιπόμενες',
                backgroundColor: '#ddd',
                borderColor: '#ddd',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: remainingHours
              });

              /* I CAN USE THIS INSTEAD TO FIX THE WARNING, BUT I WILL HAVE TO FIX THE UNDEFINED AS WELL
              var barChartData = {
                datasets: [{
                  barPercentage: 0.4
                }]
              };

              var areaChartData = {
                labels: labelArray,
                datasets: output.concat(barChartData)
              };*/
              var areaChartData = {
                labels: labelArray,
                datasets: output
              }
              //console.log(areaChartData.datasets[0].data[0]);
              //console.log(areaChartData.datasets[1].data[0]);
              //console.log(areaChartData);
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

              if (basicArray.length == 1) { // if there is only one section make the bar width smaller
                var barChartOptions = {
                  responsive: true,
                  maintainAspectRatio: false,
                  scales: {
                    xAxes: [{
                      categoryPercentage: 0.6,
                      barPercentage: 0.6
                    }],
                    yAxes: [{
                      ticks: {
                        beginAtZero: true
                      }
                    }]
                  },
                  datasetFill: false,
                }
              } else {
                var barChartOptions = {
                  responsive: true,
                  maintainAspectRatio: false,
                  scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero: true
                      }
                    }]
                  },
                  datasetFill: false,
                }

              }

              //console.log(barChartData);
              //console.log(barChartData.datasets.length);

              new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
              })
            } //closes if
          }
        }
      });


      function getColorForId(id) {
        var hue = (id % 360) / 360; // Generate hue value between 0 and 1
        var saturation = 0.4;
        var lightness = 0.3;

        // Convert HSL color to RGB
        var h = hue;
        var s = saturation;
        var l = lightness;
        var r, g, b;

        if (s === 0) {
          r = g = b = l; // Achromatic (gray)
        } else {
          function hue2rgb(p, q, t) {
            if (t < 0) t += 1;
            if (t > 1) t -= 1;
            if (t < 1 / 6) return p + (q - p) * 6 * t;
            if (t < 1 / 2) return q;
            if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
            return p;
          }

          var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
          var p = 2 * l - q;
          r = hue2rgb(p, q, h + 1 / 3);
          g = hue2rgb(p, q, h);
          b = hue2rgb(p, q, h - 1 / 3);
        }

        // Convert RGB to hexadecimal representation
        var rgbToHex = function(rgb) {
          var hex = Math.round(rgb * 255).toString(16);
          return hex.length === 1 ? '0' + hex : hex;
        };

        return '#' + rgbToHex(r) + rgbToHex(g) + rgbToHex(b);
      }


    });
  </script>

</body>

</html>