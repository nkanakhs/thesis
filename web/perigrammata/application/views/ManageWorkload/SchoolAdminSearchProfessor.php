
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2"></div>
          <div class="col-sm-4">
            <h1>Αναζήτηση Καθηγητών</h1>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo URL; ?>NewAdminController/Workload">Επιστροφή</a></li>
              <li class="breadcrumb-item active">Αναζήτηση Καθηγητών</li>
            </ol>
          </div>
          
          <div class="col-sm-2"></div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Φόρμα αναζήτησης</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step" data-target="#profChoose">
                            <button type="button" class="step-trigger" role="tab" aria-controls="profChoose" id="choose-school">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Επιλογή Καθηγητή</span>
                            </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#SemesterChoose">
                            <button type="button" class="step-trigger" role="tab" aria-controls="SemesterChoose" id="SemesterChoose-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Επιλογή Εξαμήνου</span>
                            </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <!-- your steps content here -->
                            <div id="profChoose" class="content" role="tabpanel" aria-labelledby="profChoose-trigger">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Καθηγητές:</label>
                                    <select class=" select2bs4" id="ProfSelected" data-placeholder="Επιλέξτε Καθηγητή" style="width: 100%;">
                                    <option value="" selected disabled>Επιλέξτε Καθηγητή</option>
                                    <?php 
                                        foreach ($users as $Id=> $user){
                                            echo '<option value=' .$user['Id'].'>'.$user['FirstName'] ." " . $user['LastName'] .'</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-secondary" onclick="stepper.next()">Next</button>
                            </div>
                            <div id="SemesterChoose" class="content" role="tabpanel" aria-labelledby="SemesterChoose-trigger">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Εξάμηνο:</label>
                                    <select class="select2bs4" id="SemesterForSelectedSchool" data-placeholder="Επιλέξτε Εξάμηνο" style="width: 100%;">
                                        <option value="" selected disabled>Επιλέξτε Καθηγητή</option>
                                        <?php 
                                            foreach ($semesters as $Id=> $semester){
                                                echo '<option value=' .$semester['Id'].'>'.$semester['Start_year']. "-" .$semester['End_year']. ",".$semester['Title'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button type="submit" id="resultsBtn" class="btn btn-secondary">Submit</button>
                            </div>
                            
                        </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                       
                    </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        <!-- /.row -->
        </div>
    </section>
    <div id="resultsDiv"> </div>

<!-- jQuery -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->

<!-- DataTables  & Plugins -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>

$(function () {

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#resultsBtn').on('click', function(){
           
           var profselected = $('#ProfSelected').val();
           var semesterselected = $('#SemesterForSelectedSchool').val();
          //first empty results, if new query is inserted
          $('#resultsDiv').html('');
            console.log(profselected);
           var table = $('<table>').attr('id', 'example2').addClass('table table-bordered table-hover');
           var thead = $('<thead>');
           var tbody = $('<tbody>');
           var trHead = $('<tr>');
           var trBody = $('<tr>');
           
           var thName = $('<th>').text('Όνομα');
           var thLastName = $('<th>').text('Επίθετο');
           var thCourse = $('<th>').text('Μάθημα');
           var thActivity = $('<th>').text('Δραστηριότητα');
           var thSection = $('<th>').text('Τμήμα');
           var thSemester = $('<th>').text('Εξάμηνο');
           var thSum = $('<th>').text('Σύνολο Ωρών');

           $.ajax({
           url: 'ProfWorkloadResults',
           type: 'GET',
           data: {profId: profselected, semester:semesterselected},
               success: function(response) {

                   var data = JSON.parse(response)

                   $.each(data,function(index,row){
                       
                       var newRow = $("<tr>").appendTo(table);
                       $("<td>").text(row.firstname).appendTo(newRow);
                       $("<td>").text(row.lastname).appendTo(newRow);
                       $("<td>").text(row.CourseTitle).appendTo(newRow);
                       $("<td>").text(row.activities).appendTo(newRow);
                       $("<td>").text(row.SectionNumber).appendTo(newRow);
                       $("<td>").text(row.Start_year +"-"+row.End_year+ "," + row.title).appendTo(newRow);
                       $("<td>").text(row.total).appendTo(newRow);
                       tbody.append(newRow);

                   });
               
                   trHead.append(thName).append(thLastName).append(thCourse).append(thActivity).append(thSection).append(thSemester).append(thSum);
                   
                   thead.append(trHead);
                   
                   table.append(thead).append(tbody);
                   
                   var cardHeader = $('<div>').addClass('card-header');
                   var cardTitle = $('<h3>').addClass('card-title').text('Αποτελέσματα Συνολικών Ωρών');
                   
                   cardHeader.append(cardTitle);
                   
                   var cardBody = $('<div>').addClass('card-body');
                   
                   cardBody.append(table);
                   
                   var card = $('<div>').addClass('card');
                   
                   card.append(cardHeader).append(cardBody);
                   
                   var col8 = $('<div>').addClass('col-8');
                   
                   col8.append(card);

                   var col2 = $('<div>').addClass('col-2');

                   var row = $('<div>').addClass('row');
                   
                   row.append(col2).append(col8);
                   
                   var containerFluid = $('<div>').addClass('container-fluid');
                   
                   containerFluid.append(row);
                   
                   var section = $('<section>').addClass('content');
                   
                   section.append(containerFluid);
                   
                   $('#resultsDiv').append(section);
                   
                   $("#example2").DataTable({
                       "responsive": true, "lengthChange": false, "autoWidth": false,
                       "buttons": ["pdf", "print"]
                   }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
               },
               error: function(xhr, status, error) {
               // handle the error if needed
               }
           });
       })
    
});

    // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })
  </script>
</body>
</html>
