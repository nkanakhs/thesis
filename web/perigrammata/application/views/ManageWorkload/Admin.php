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
              <h1>Διαχείριση Προσωπικού</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index"><?php echo $title[0]['CourseTitle']; ?></a></li>
                <li class="breadcrumb-item active">Διαχείριση Προσωπικού</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Εγγεγραμμένο Προσωπικό</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>


          <!-- card-body -->
          <div class="card-body p-0">

            <div class="col-12 table-responsive">
              <!-- professors table -->
              <table class="table table-striped projects">
                <thead>
                  <tr>
                    <th style="width: 10%">
                      #
                    </th>
                    <th style="width: 20%">
                      Όνομα
                    </th>
                    <th style="width: 30%">
                      Επίθετο
                    </th>
                    <th style="width: 20%">
                      Αρμοδιότητες
                    </th>
                    <?php if ($role[0]['RoleId'] == 0) { ?>
                      <th style="width: 20%">
                        Διαγραφή
                      </th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($professorsId as $row => $professor) {
                  ?>
                    <tr>
                      <td>
                        <?php echo $row + 1; ?>
                      </td>
                      <td>
                        <?php echo $professor['firstname']; ?>
                      </td>
                      <td>
                        <?php echo $professor['lastname']; ?>
                      </td>
                      <td>
                        <?php if ($professor['roleId'] == 0) {
                          echo "Καθηγητής";
                        } else {
                          echo "Συνεργάτης";
                        }
                        ?>
                      </td>
                      <?php if ($role[0]['RoleId'] == 0) { ?>
                        <td class="project-actions ">
                          <?
                          if ($_SESSION['user_id'] != $professor['ProfessorId']) { // we cannot delete ourselfes 
                          ?>
                            <a class="btn btn-outline-danger btn-sm" style="text-transform: none;" onclick="RemovePartnerFromCourse(<?php echo $professor['ProfessorId']; ?>);">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                            </a>
                          <?php } ?>
                        </td>

                      <?php } ?>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <br>
            <?php if ($role[0]['RoleId'] == 0) { ?>
              <div class="text-center">
                <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal-lg" style="text-transform: none;">Προσθήκη</button>
              </div>
            <?php } ?>
            <br>
            <!-- ./professors table -->
          </div>

          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->


    </div>
    <!-- /.content-wrapper -->
    <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title">Προσθήκη Προσωπικού</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4>Αναζήτηση Συνεργάτη :</h4>
            <br>
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-8">
                    <form action="simple-results.html">
                      <div class="input-group">
                        <input type="search" class="form-control " placeholder="Εισάγετε Όνομα η Επίθετο" onkeyup="loadProfessors(this , 0);">
                      </div>
                      <span id="search_result"></span>
                      <span id="partner_result"></span>
                    </form>
                  </div>
                </div>
              </div>
            </section>
            <br>
            <h4>Επιλέξτε Αρμοδιότητα :</h4>
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" value="0" id="professor-radio">
                        <label class="form-check-label">Καθηγητής</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" value="1" id="professor-radio">
                        <label class="form-check-label">Συνεργάτης</label>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-outline-secondary" onclick="SubmitPartner();">Save changes</button>
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


</body>

</html>