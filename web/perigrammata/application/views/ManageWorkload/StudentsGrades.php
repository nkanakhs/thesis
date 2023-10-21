<input type="hidden" id="courseId" value="<?php echo $courseID;?>" />
<input type="hidden" id="language" value="<?php echo $_SESSION['lang'];?>" />
<input type="hidden" id="coursecode" value="<?php echo $course_code[0]['codeId'];?>" />
<input type="hidden" id="profid" value="<?php echo $_SESSION['user_id'];?>" />

<input type="hidden" id="url" value="<?php echo URL;?>" />


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
      <span class="brand-text font-weight-light" style="display: inline-block; max-width: 150px; overflow: hidden; text-overflow: ellipsis;white-space: nowrap;" ><?php echo $title[0]['CourseTitle'];?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo URL; ?>/public/img/teacher.png" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['user_username'];?></a>
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
                  <a href="<?php echo URL; ?>ProfessorNewController/StudentGrades?CourseId=<?php echo $courseID; ?>" class="nav-link active">
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
            <h1>Φοιτητές</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index"><?php echo $title[0]['CourseTitle'];?></a></li>
              <li class="breadcrumb-item active">Βαθμολόγηση Φοιτητών</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Εγγεγραμμήνοι Φοιτητές</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>AEM</th>
                            <th>Όνομα</th>
                            <th>Επίθετο</th>
                            <th>Βαθμός</th>
                            <th>Βαθμολογήθηκε Από</th>
                          </thead>
                          <tbody>
                          <?php 
                          foreach($students as $Id=>$row){
                          echo '<tr>';
                          echo '<td>'.$row['student_am'] .'</td>';
                          echo '<td>'.$row['first_name']. '</td>';
                          echo '<td>'.$row['lastname'].'</td>';
                          echo '<td class="text-center"><input type="text" class="styled-input" 
                                 id="Grade-'. $row['student_am'].'" name="'.$row['student_am'].'" value="'.$row['grade'].'"></input></td>';
                          echo '<td>'.$row['FirstName'].' '. $row['LastName'].'</td>';
                          echo '</tr>';
                          } ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
            </div>
            <button class="btn btn-outline-secondary" id="downloadButton">Λήψη Βαθμολογίας</button><small>*Tο αρχείο είναι σε μορφή .xlsx με τα απαραίτητα πεδία για να ανέβει στο φοιτητολόγιο.</small>
                          
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div></br>  
      <!-- /.container-fluid -->
    </section>

    
<!-- jQuery -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
<!-- AdminLTE App -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    });
    $('#example1').on('change', '[id^="Grade-"]', function(){
      
      var courseId = $('#courseId').val();
      var coursecode = $('#coursecode').val();
      var profid = $('#profid').val();
      var am = $(this).attr('name');  
      console.log("prof: " + profid);
      var value = $(this).val();
      //console.log("vathmos: " + value);

      $.ajax({
        url: 'InsertGrades', 
        type: 'POST',
        data: {courseId: courseId, courseCode: coursecode , studentAm: am, grade:value ,profid:profid},
        success: function(response){

        }
      })
    })
  });

  document.getElementById("downloadButton").addEventListener("click", function() {
    // Make an AJAX request to the server to generate the Excel file
    var code= document.getElementById('coursecode').value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "generate_excel?courseCode="+code,true);
    xhr.responseType = "blob";
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Create a temporary link element to download the Excel file
            var link = document.createElement("a");
            link.href = window.URL.createObjectURL(xhr.response);
            link.download = "file.xlsx";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    };
    xhr.send();
});
</script>
</body>
</html>