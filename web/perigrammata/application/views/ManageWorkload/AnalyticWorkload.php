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
    <aside class="main-sidebar  sidebar-dark-primary elevation-4">
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
              <a href="<?php echo URL; ?>ProfessorNewController/AnalyticWorkload?CourseId=<?php echo $courseID; ?>" class="nav-link active ">
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
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Φίλτρα Αναζήτησης</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index"><?php echo $title[0]['CourseTitle']; ?></a></li>
                  <li class="breadcrumb-item active">Αναλυτικό Φόρτο Εξαμήνου</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <div class="container-fluid">
          <form>
            <div class="row">
              <div class="col-md-10 offset-md-1">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Προσωπικό:</label>
                      <select class="select2" id="profSelected" multiple="multiple" data-placeholder="Σύνολο Συνεργατών" style="width: 100%;">
                        <?php
                        foreach ($stuff as $Id => $prof) {
                          echo '<option value=' . $prof['ProfessorId'] . '>' . $prof['firstname'] . " " . $prof['lastname'] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Δραστηριότητα:</label>
                      <select class="select2" id="activitySelected" multiple="multiple" data-placeholder="Όλες" style="width: 100%;">
                        <?php
                        foreach ($activities as $Id => $activity) {
                          echo '<option value=' . $activity['ActivityId'] . '>' . $activity['Activities'] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Εξάμηνο:</label>
                      <select class="select2" id="semesterSelected" multiple="multiple" data-placeholder="Τρέχον εξάμηνο" style="width: 100%;">
                        <?php
                        foreach ($semesters as $Id => $semester) {
                          echo '<option value=' . $semester['Id'] . '>' . $semester['Start_year'] . "-" . $semester['End_year'] . "," . $semester['Title'] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="text-center">
              <button type="button" class="btn btn-outline-secondary" id="resultsBtn" style="text-transform: none;">Αναζήτηση</button>
            </div>
          </form>
        </div>
      </section>

      <br>
      <div id="resultsDiv">

      </div>
      <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>

  </div>

  <!-- jQuery -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
  <!-- ./wrapper -->
  <script>
    $(function() {
      $('.select2').select2()

      $('#profSelected').on('change', function() {
        var selectedOptionValue = $(this).val();
        $(this).attr('value', selectedOptionValue);
      });

      $('#activitySelected').on('change', function() {
        var selectedOptionValue = $(this).val();
        $(this).attr('value', selectedOptionValue);
      });

      $('#resultsBtn').on('click', function() {


        //first empty results, if new query is inserted
        $('#resultsDiv').html('');
        //then create the table
        var table = $('<table>').attr('id', 'example2').addClass('table table-bordered table-hover');
        var thead = $('<thead>');
        var tbody = $('<tbody>');
        var trHead = $('<tr>');
        var trBody = $('<tr>');

        var thName = $('<th>').text('Όνομα');
        var thLastName = $('<th>').text('Επίθετο');
        var thActivity = $('<th>').text('Δραστηριότητα');
        var thSection = $('<th>').text('Τμήμα');
        var thSemester = $('<th>').text('Εξάμηνο');
        var thSum = $('<th>').text('Σύνολο Ωρών');


        var courseId = $('#courseId').val();

        if ($('#profSelected').val().length != 0) {
          var profId = $('#profSelected').val();
        } else {
          profId = 0;
        }
        if ($('#activitySelected').val().length != 0) {
          var activityId = $('#activitySelected').val();
        } else {
          activityId = 0;
        }
        if ($('#semesterSelected').val().length != 0) {
          var semesterId = $('#semesterSelected').val();
        } else {
          semesterId = 0;
        }


        $.ajax({
          url: 'TableWorkloadResults',
          type: 'GET',
          data: {
            courseId: courseId,
            profId: profId,
            activityId: activityId,
            semesterId: semesterId
          },
          success: function(response) {

            var data = JSON.parse(response)

            $.each(data, function(index, row) {

              var newRow = $("<tr>").appendTo(table);
              $("<td>").text(row.firstname).appendTo(newRow);
              $("<td>").text(row.lastname).appendTo(newRow);
              $("<td>").text(row.activities).appendTo(newRow);
              $("<td>").text(row.SectionNumber).appendTo(newRow);
              $("<td>").text(row.Start_year + "-" + row.End_year + "," + row.title).appendTo(newRow);
              $("<td>").text(row.total).appendTo(newRow);
              tbody.append(newRow);

            });
          },
          error: function(xhr, status, error) {
            // handle the error if needed
          }
        });


        trHead.append(thName).append(thLastName).append(thActivity).append(thSection).append(thSemester).append(thSum);

        thead.append(trHead);

        table.append(thead).append(tbody);

        var cardHeader = $('<div>').addClass('card-header');
        var cardTitle = $('<h3>').addClass('card-title').text('Αποτελέσματα Συνολικών Ωρών');

        cardHeader.append(cardTitle);

        var cardBody = $('<div>').addClass('card-body');

        cardBody.append(table);

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

        $('#resultsDiv').append(section);

      });

    });
  </script>
</body>

</html>