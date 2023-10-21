
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 


    <meta
      name="description"
      content="Perigrammata is a web-based information system for the documentation and exploitation of the learning outcomes of university schools."
    />



   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous"> -->
   
   <link rel="stylesheet" href="<?php echo URL; ?>public/css/newstyles.css">
    <!-- jsGrid -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jsgrid/jsgrid.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jsgrid/jsgrid-theme.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <!-- ADMINλτε -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/toastr/toastr.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/fullcalendar/main.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/dropzone/min/dropzone.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!--gp-->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css' rel='stylesheet' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <!-- ADMIN -->
    <!-- MDBootstrap Datatables  -->
    <!-- MDBootstrap flags -->
   <!-- <link href="< ?php echo URL; ?>public/css/flag.min.css" rel="stylesheet"> -->
    
    

    <link rel="icon" href="<?php echo URL; ?>/public/img/logo.png">
    <title> Perigrammata |  Information System for the Documentation of the Learning Outcomes  </title>  
 
</head>
  
    <?php if (isset($_SESSION['logged'])) : ?>
       
        <form action="<?php echo URL; ?>AccountController/doLogout" method="POST">
        <!--Navbar -->
            <nav class="mb-1 navbar navbar-expand-lg navbar-dark myblue py-3"  id="topSection">

            <a class="navbar-brand" href="<?php echo URL; ?>home"><img src="<?php echo URL; ?>/public/img/logo2.png" height="40" width="65" alt="TUC" >  <?php echo t_home; ?></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <ul class="navbar-nav ml-auto">
                  
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                        <!-- <i class="far fa-user-circle"></i> -->
                        <?php if ($_SESSION['user_profile']==2){?>
                        <img  src="<?php echo URL; ?>/public/img/prof.png" alt="Logo" height="50" width="20">

                        <?php }else if ($_SESSION['user_profile']==1){?>
                            <img  src="<?php echo URL; ?>/public/img/admin.png" alt="Logo" height="50" width="20">
                        <?php }else{?>
                            <img  src="<?php echo URL; ?>/public/img/stud.png" alt="Logo" height="50" width="20">
                        <?php }
                        
                        echo $_SESSION['user_username'] ?>
                        <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item my-auto">
                        <a class="nav-link" href="<?php echo URL; ?>home/ChangeLanguage?lang=gr">
                        <i class="fas fa-globe"></i> ΕΛ
                        <!-- <span class="sr-only">(current)</span> -->
                        </a>
                    </li>
                    <li class="nav-item my-auto">
                        <a class="nav-link" href="<?php echo URL; ?>home/ChangeLanguage?lang=en">
                        <i class="fas fa-globe"></i> EN
                        </a>
                    </li>
                    <li class="nav-item my-auto">                   
                        <button style="color:#fff;" class="btn btn-outline-white btn-md my-2 my-sm-0 " type="submit" name="submit" value="Logout"><i class="fas fa-sign-out-alt"></i><?php echo t_logout; ?></button>
                    </li>
                 
                </ul>
            </div>
            </nav>
       
        </form>  
        
    <?php endif ; ?>
    

