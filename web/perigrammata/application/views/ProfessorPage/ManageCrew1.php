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
            <a href="<?php echo URL; ?>ProfessorNewController/Admin?CourseId=<?php echo $courseID;?>" class="nav-link ">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Διαχείριση Προσωπικού
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo URL; ?>ProfessorNewController/ManageActivities?CourseId=<?php echo $courseID;?>" class="nav-link active">
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
            <h1>Διδακτικές Δραστηριότητες</h1>
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
            <div id="jsGrid1" class="jsgrid" style="position: relative; height: 100%; width: 100%;">
                <!-- professors table -->
                <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                <table class="jsgrid-table">
                
                    <tr class="jsgrid-header-row">
                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 10%">
                            <b>#</b>
                        </th>
                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 20%">
                            <b>Τύπος</b> 
                        </th>
                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 30%">
                            <b>Διδακτικές Ώρες την Εβδομάδα</b> 
                        </th>
                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 20%">
                            <b>Συνολικές Ώρες ανά εξάμηνο</b> 
                        </th>
                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 20%">
                            <b>Επεξεργασία</b> 
                        </th>
                    </tr>
                
                    <?php
                    foreach($activities as $row=>$activity){
                    ?>
                    <tr class="jsgrid-filter-row">
                        <td class="jsgrid-cell" >
                            <?php echo $row + 1;?>
                        </td>
                        <td class="jsgrid-cell" >
                            <?php echo $activity['Activities'];?>
                        </td>
                        <td class="jsgrid-cell" >
                            <?php echo $activity['Hours'] / 13;?>
                        </td>
                        <td class="jsgrid-cell" >
                            <?php echo $activity['Hours'];
                            ?>
                        </td>
                        <td class="jsgrid-cell ">
                          <div class="text-center">
                            <a class="btn btn-secondary btn-sm"  style="text-transform: none;"href="#">
                                <i class="fas fa-edit">
                                </i>
                                Edit
                            </a>
                          </div>
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>
                </table>
                  </div></div>
                <!-- ./professors table -->
                </div>
  
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
       
    </section>
    <!-- /.content -->
    <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Διαχείριση Φόρτου Μαθήματος</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      
      
      <!-- card-body -->
      <div class="card-body">
      <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Συνεργάτες</label>
                  <select id="partner" name="parnter" class="form-control select2bs4" style="width: 100%;">
                  <option value="" disabled selected hidden ><?php echo "Επιλέξτε Συνεργάτη";?></option>
                  <?php foreach($professorsId as $row =>$professor)
                  {
                  ?>
                    <option value="<?php echo $professor['ProfessorId'] ;?>"><?php echo $professor['firstname'] . $professor['lastname'] ;?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Μάθημα</label>
                  <select class="form-control select2bs4" disabled="disabled" style="width: 100%;">
                    <option selected="selected"><?php echo $title[0]['CourseTitle'];?></option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Τύπος</label>
                  <select name="activities" id="activities" class="form-control select2bs4" onchange="activityRange(this)" style="width: 100%;">
                  <option value="" disabled selected hidden ><?php echo "Επιλέξτε τύπο Διδασκαλίας";?></option>
                  <?php foreach($activities as $row =>$activity)
                  {
                  ?>
                    <option id="<?php echo $activity['Id'];?>" value="<?php echo $activity['Hours'];?>"><?php echo $activity['Activities'] ;?></option>
                  <?php
                  }
                  ?>
                  </select>
                  </select>
                </div>
                <!-- /.form-group -->
                <input type="hidden" id="selectedactivity" value="" />
                <div class="form-group">
                    <label for="customRange1">Ρύθμιση Φόρτου</label>
                    <input type="range" class="custom-range " disabled oninput="totalHours.value = this.value" id="customRange1">
                    <output id="totalHours">0</output>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
      <div class="card-footer">
        <div class="text-center">
              <button type="submit" onclick="addActivityAndHours()" class="btn btn-secondary">Αποθήκευση</button>
        </div>
      </div>
      <!-- /.card-body -->
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


</body>
</html>
