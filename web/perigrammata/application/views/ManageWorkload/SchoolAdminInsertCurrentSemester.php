<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <h1>Εισαγωγή Νέου Εξαμήνου</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo URL; ?>NewAdminController/Workload">Επιστροφή</a></li>
                    <li class="breadcrumb-item active">Τρέχον εξάμηνο</li>
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
            <div class="col-sm-2"></div>
            <div class="col-md-8">
                <form method="POST" action="<?php echo URL; ?>NewAdminController/SubmitSemester">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Φόρμα εισαγωγής</h3>
                        </div>
                        <div class="card-body">
                            <!-- Date -->

                            <div class="row">
                                <div class="col-sm-2"></div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Αρχική ημερομηνία:</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="starting-date" id="starting-date" />
                                            <div class="input-group-append" data-target="#starting-date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2"></div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Τελική ημερομηνία:</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="ending-date" id="ending-date" />
                                            <div class="input-group-append" data-target="#ending-date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- Date range -->
                                <div class="col-sm-2"></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2"></div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Τύπος Εξαμήνου:</label>

                                        <div class="input-group">
                                            <select class="form-control float-right" id="SemesterType" name="SemesterType">
                                                <option value="" selected disabled>Επιλέξτε τύπο εξαμήνου...</option>
                                                <option value='1'>Χειμερινό</option>
                                                <option value='2'>Εαρινό</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-sm-2"></div>
                            <div class="row">
                                <div class="col-sm-5"></div>
                                <button class="btn btn-outline-secondary" type="submit">Υποβολή</button>
                            </div>
                            <!-- /.form group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                    <!-- /.card-body -->
            </div>

            </form>
            <!-- /.card -->
        </div>
    </div>
    </div>
    <!-- /.row -->
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">Τρέχον Εξάμηνο</h3>
                    </div>
                    <div class="card-body">
                        <!-- Date -->

                        <div class="row">
                            <div class="col-sm-2"></div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Αρχική ημερομηνία:</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" class="form-control" disabled value="<?php echo  $currentSemester[0]['Start_date']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2"></div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Τελική ημερομηνία:</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" class="form-control " disabled value="<?php echo  $currentSemester[0]['End_date']; ?>" />
                                    </div>
                                </div>

                            </div>
                            <!-- Date range -->
                            <div class="col-sm-2"></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2"></div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Τύπος Εξαμήνου:</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control" disabled value="<?php echo $currentSemester[0]['Title']; ?>" />
                                    </div>

                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="col-sm-2"></div>
                        <!-- /.form group -->
                    </div>
                    <!-- /.form group -->
                </div>
                <!-- /.card-body -->
            </div>

            <!-- /.card -->
        </div>
    </div>
    </div>
    <!-- /.row -->
    </div>
</section>

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

<!-- date-range-picker -->
<script src="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js"></script>
<!-- DataTables  & Plugins -->

<script>
    $(function() {
        //Date picker
        $('#starting-date').datetimepicker({
            format: 'L'
        });

        $('#ending-date').datetimepicker({
            format: 'L'
        });

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker


    })
</script>
</body>

</html>