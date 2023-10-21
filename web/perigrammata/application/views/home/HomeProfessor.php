
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<div class="row">
  <div class="col-sm-1"></div>
  <div class="col-sm-10">
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Αρχική Σελίδα</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Σημείωση:</h5>
              Η παρούσα εφαρμογή δημιουργήθηκε στα πλαίσια διπλωματικής εργασίας σαν επέκταση του ήδη υπάρχοντος συστήματος των περιγραμμάτων και προσφέρει τις παρακάτω δυνατότητες. 
              <ul>
                <li> Εύχρηστο περιβάλλον για τη διαχείριση του φόρτου εργασίας των μαθημάτων και των συνεργατών με σκοπό τη καλύτερη οργάνωση τους.
                <li> Eισαγωγή εγγεγραμμένων φοιτητών μέσω του φοιτητολογίου και δυνατότητα βαθμολόγησης.
                <li> Εισαγωγή πολλαπλών μεθόδων αξιολόγησης κάθε μαθήματος.
                <li> Δυνατότητα των καθηγητών επίβλεψης και εξαγωγής του προσωπικού τους προγράμματος.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-list"></i> Τα Μαθήματα μου
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <br>
  
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Μάθημα</th>
                      <th>Κωδικός</th>
                      <th>Σχολή</th>
                      <th>Διαχείριση</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($professorCourses as $Id => $row ){ 
                      echo '<tr>';
                      echo '<td>' . ($Id +1). '</td>';
                      echo '<td>' . $row['CourseTitle'] . '</td>';
                      echo '<td>' . $row['LessonCode'] . '</td>';
                      echo '<td>' . $row['SchoolName'] . '</td>';
                      ?>
                      <td>
                      <div class="text-center">
                      <a href="<?php echo URL . 'ProfessorNewController/EditLearningOutcomes?CourseId=' . $row['CourseId'] ?>" >
                            <button type="button" class="btn btn-danger btn-rounded btn-sm my-0 px-3 rounded-pill">
                                <i class="fas fa fa-graduation-cap mt-0"></i>
                            </button>
                      </a>
                      </div>
                      </td>
                      <?
                      echo '</tr>';
                      }?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              
            </div>

            <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="far fa-calendar-alt"></i> Ημερολόγιο
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                

                <!-- Table row -->
                <div class="row invoice-info">
                  <div class="col-8 invoice-col">
                    <br>
                    Μπορείτε να δείτε και να κάνετε εξαγωγή του διαμορφωμένου σας προγράμματος.
                    <a href="<?php echo URL; ?>ProfessorNewController/MyCalendar">
                    <button type="button" class="btn btn-light btn-rounded btn-sm my-0 px-3 rounded-pill">
                        <i class="far fa-calendar-alt" aria-hidden="true"></i> 
                    </button>
                    </a>
                  </div>
                </div>
              </div>

            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  
  <footer class="main-footer no-print">
  </footer>
  <div class="col-sm-1"></div>
</div>
  <!-- /.content-wrapper -->
</div>
<!-- jQuery -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

</body>
</html>
