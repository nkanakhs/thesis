<input type="hidden" id="courseId" value="<?php echo $courseID;?>" />
<input type="hidden" id="language" value="<?php echo $_SESSION['lang'];?>" />

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo URL; ?>public/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light"><?php echo $title[0]['CourseTitle'];?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo URL; ?>public/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo URL; ?>ProfessorNewController/Admin?CourseId=<?php echo $courseID;?>" class="nav-link active">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Διαχείριση Προσωπικού
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo URL; ?>ProfessorNewController/ManageActivities?CourseId=<?php echo $courseID;?>" class="nav-link ">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Διδακτικές Δραστηριότητες
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo URL; ?>ProfessorNewController/ShowWorkload?CourseId=<?php echo $courseID;?>" class="nav-link ">
              <i class="nav-icon far fa-chart-pie"></i>
              <p>
                Φόρτο Εξαμήνου Μαθήματος
              </p>
            </a>
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Detail</li>
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

                <!-- professors table -->
                <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
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
                        <th style="width: 20%">
                            Διαγραφή
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($professorsId as $row=>$professor){
                    ?>
                    <tr>
                        <td>
                            <?php echo $row + 1;?>
                        </td>
                        <td>
                            <?php echo $professor['firstname'];?>
                        </td>
                        <td>
                            <?php echo $professor['lastname'];?>
                        </td>
                        <td>
                            <?php if($professor['roleId']==0){
                                echo "Καθηγητής";
                            }else{
                                echo "Συνεργάτης";
                            }
                            ?>
                        </td>
                        <td class="project-actions ">
                            <a class="btn btn-danger btn-sm"  style="text-transform: none;"href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
                </table>
                <br>
                <div class="text-center">
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal-lg" style="text-transform: none;">Προσθήκη</button>
                </div>
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
                                        <input type="search" class="form-control " placeholder="Εισάγετε Όνομα η Επίθετο" onkeyup="loadProfessors(this);">
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
