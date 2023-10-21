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
              <a href="<?php echo URL; ?>ProfessorNewController/ManageActivities?CourseId=<?php echo $courseID; ?>" class="nav-link active">
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
              <h1>Διδακτικές Δραστηριότητες</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index"><?php echo $title[0]['CourseTitle']; ?></a></li>
                <li class="breadcrumb-item active">Διδακτικές Δραστηριότητες</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Οργάνωση Διδασκαλίας</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>


          <!-- card-body -->
          <div class="card-body">
            <!-- professors table -->

            <div class="col-12 table-responsive">
              <table class="table table-striped projects">
                <thead>
                  <tr>
                    <th style="width: 5%">
                      <b>#</b>
                    </th>
                    <th style="width: 20%">
                      <b>Τύπος</b>
                    </th>
                    <th style="width: 30%">
                      <b>Διδακτικές Ώρες την Εβδομάδα</b>
                    </th>
                    <th style="width: 25%">
                      <b>Συνολικές Ώρες ανά εξάμηνο</b>
                    </th>
                    <th style="width: 20%">
                      <b>Αριθμός τμήματος</b>
                    </th>
                    <?php if ($role[0]['RoleId'] == 0) { ?>
                      <th style="width: 10%">
                        <b>Επεξεργασία</b>
                      </th>
                    <?php } ?>
                    <?php if ($role[0]['RoleId'] == 0) { ?>
                      <th style="width: 10%">
                        <b>Διαγραφή</b>
                      </th>
                    <?php } ?>
                  </tr>
                </thead>
                <?php
                foreach ($activitiesnew as $row => $activity) {
                ?>
                  <tr id="activity_<?php echo $row; ?>" class="jsgrid-filter-row">
                    <td class="jsgrid-cell">
                      <?php echo $row + 1; ?>
                    </td>
                    <td class="jsgrid-cell">
                      <?php echo $activity['Activities']; ?>
                    </td>
                    <td class="jsgrid-cell">
                      <?php 
                      $formattedNumber = number_format($activity['SemesterHours'] /13, 2);
                      echo $formattedNumber; ?>
                    </td>
                    <td class="jsgrid-cell">
                      <?php echo $activity['SemesterHours'];
                      ?>
                    </td>
                    <td class="jsgrid-cell">
                      <?php echo $activity['SectionNumber'];
                      ?>
                    </td>
                    <?php if ($role[0]['RoleId'] == 0) { ?>
                      <td class="jsgrid-cell ">
                        <div class="text-center">
                          <button class="btn btn-secondary" data-toggle="modal" data-target="#modal-lg-1" onclick="openModal('<?php echo $activity['Activities']; ?> ', '<?php echo $activity['Id']; ?>', '<?php echo $activity['SectionNumber']; ?>')" style="text-transform: none;" href="#">
                            <i class="fas fa-edit">
                            </i>
                          </button>
                        </div>
                      </td>
                    <?php } ?>
                    <?php if ($role[0]['RoleId'] == 0) { ?>
                      <td class="jsgrid-cell ">
                        <div class="text-center">
                          <button id="delete-activity_" class="btn btn-danger" data-arg1="<?php echo $activity['Id']; ?>" data-arg2='<?php echo $activity['SectionNumber']; ?>' data-arg3="<?php echo $row; ?>">
                            <i class="fas fa-trash">
                            </i>
                          </button>
                        </div>
                      </td>
                    <?php } ?>
                  </tr>
                <?php
                }
                ?>
              </table>
            </div>
            <br>
            <?php if ($role[0]['RoleId'] == 0) { ?>
              <div class="text-center">
                <button type="submit" data-toggle="modal" data-target="#modal-lg" style="text-transform: none;" class="btn btn-outline-secondary">Προσθήκη</button>
              </div>
            <?php } ?>
            <!-- ./professors table -->
          </div>

          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->

      <section class="content">


        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- modal for adding activity -->
    <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title">Προσθήκη Μεθόδου Διδασκαλίας</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Τύπος Διδασκαλίας</label>
              <select id="activity" name="activity" class="form-control select2bs4" style="width: 100%;">
                <option value="" disabled selected hidden><?php echo "Επιλέξτε Τύπο Διδασκαλίας"; ?></option>
                <?php foreach ($activitiesavailable as $row => $activity) {
                ?>
                  <option value="<?php echo $activity['Id']; ?>"><?php echo $activity['Activities']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Αριθμός Τμημάτων</label>
              <input type="number" class="form-control" id="SectionNumber" name="SectionNumber" min = "1">
            </div>
            <div class="form-group">
              <label for="customRange2">Ρύθμιση Φόρτου Ανά Εξάμηνο (ισχύει για όλα τα τμήματα)</label>
              <input type="range" class="custom-range " min="0" max="91"  value="0" oninput="totalHours1.value = this.value" id="customRange2">
              <output id="totalHours1">0</output>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-outline-secondary" onclick="AddActivity()">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- modal for edit activity -->
    <div class="modal fade" id="modal-lg-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title">Επεξεργασία</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <input type="hidden" id="editActivity" name="my-input" value="">
              <input type="hidden" id="editActivitySection" name="my-input1" value="">
              <div id="selectedAct"></div>
              <div id="selectedSection"></div>
              <label for="customRange2">Ρύθμιση Φόρτου Ανά Εξάμηνο</label>
              <input type="range" class="custom-range " min="0" max="91" value="0" oninput="totalHours2.value = this.value" id="customRange2">
              <output id="totalHours2">0</output>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-outline-secondary" onclick="EditActivity()">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>

  <script>
    $(function() {
      //for the alerts
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      $("[id^='delete-activity_']").on('click', function() {

        var id = $(this).data('arg1');
        var section = $(this).data('arg2');
        var row = $(this).data('arg3');
        var courseId = $('#courseId').val();
        $.ajax({
          url: 'deleteSpecificActivity',
          type: 'POST',
          data: {
            courseId: courseId,
            section: section,
            id: id
          },
          success: (function(response) {
            response = JSON.parse(response);
            if (response.status === "Success") {
              Toast.fire({
                icon: 'success',
                title: 'Επιτυχής ενημέρωση'
              });
              setTimeout(function() {
                window.location.href = "/perigrammata/ProfessorNewController/ManageActivities?CourseId=" + courseId;
              }, 2000);
              $("#activity_" + row).remove(); //delete row from table 
            } else {
              Toast.fire({
                icon: 'error',
                title: response.status
              })
            }


          })

        })
      })

    })
  </script>

</body>

</html>