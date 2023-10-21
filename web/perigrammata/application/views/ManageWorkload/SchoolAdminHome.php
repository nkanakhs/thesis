<div class="content">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Αναζήτηση-Εξαγωγή Φόρτου </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URL; ?>Home/index">Επιστροφή</a></li>
            <li class="breadcrumb-item active">Επιλογές Αναζήτησης</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <br>
  <!-- Main content -->
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h5>Αναζήτηση Μαθήματος</h5>
            </div>
            <div class="card-body">
              <p class="card-text">
                Μπορείτε να δείτε και να κάνετε εξαγωγή του φόρτου εργασίας συγκεκριμένου μαθήματος με κριτήρια τη Σχολή, το εξάμηνο και το Μάθημα.
              </p>

              <a href="<?php echo URL; ?>NewAdminController/SearchCourse" class="card-link">Επιλογή</a>
            </div>
          </div>


        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h5>Αναζήτηση Καθηγητή</h5>
            </div>
            <div class="card-body">
              <p class="card-text">
                Μπορείτε να δείτε και να κάνετε εξαγωγή του φόρτου εργασίας συγκεκριμένου Καθηγητή σε όλα του τα μαθήματα.
              </p>

              <a href="<?php echo URL; ?>NewAdminController/SearchProfessor" class="card-link">Επιλογή</a>
            </div>
          </div>


        </div>
        <!-- /.col-md-6 -->
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h5>Ενημέρωση τρέχοντος εξαμήνου</h5>
            </div>
            <div class="card-body">
              <p class="card-text">
                Εισάγεται το τρέχον Εξάμηνο στο οποίο θα γίνουν οι εγγραφές φοιτητών, η εισαγωγή φόρτου καθηγητών και μαθημάτων και οι βαθμολόγηση.
              </p>

              <a href="<?php echo URL; ?>NewAdminController/InsertCurrentSemester" class="card-link">Επιλογή</a>
            </div>
          </div>


        </div>
        <!-- /.col-md-6 -->
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
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