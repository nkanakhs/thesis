<input type="hidden" id="courseId" value="<?php echo $courseID; ?>" />
<input type="hidden" id="language" value="<?php echo $_SESSION['lang']; ?>" />
<input type="hidden" id='CourseId' name='CourseId' value="<?php echo $courseID; ?>" />

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
                            <a href="<?php echo URL; ?>ProfessorNewController/EditLearningOutcomes?CourseId=<?php echo $courseID; ?>" class="nav-link  active ">
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
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Αξιολόγηση</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/index"><?php echo $title[0]['CourseTitle']; ?></a></li>
                                <li class="breadcrumb-item active">Διαχείριση Μεθόδων Αξιολόγησης</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <form id="learningOutcomes" method="POST" action="<?php echo URL . "ProfessorNewController/updateLearningOutcomes?CourseId=" . $courseID; ?>">

                    <!-- card-body -->
                    <?php
                    for ($p = 1; $p <= $methods[0]['num']; $p++) { ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo $p ?>ή Μέθοδος Αξιολόγησης</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <?php if ($p > 1) { ?>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove" onclick="deleteMethod('<?php echo $p; ?>')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                <div class="col-12 table-responsive">
                                    <div class="table-wrapper table-responsive ">
                                        <table class="table table-bordered table-hover mt-0" id="MethodsInfo_<?php echo $p; ?>">
                                            <?php
                                            $total_percentage_value = 0;
                                            foreach ($Assessments as $categoryId => $Assessment) {
                                                echo '<tr>';
                                                echo "<th>" . $Assessment['CategoryName'] . '</th>';
                                                $percentage_value = isset($CourseAssessment2[$p][$categoryId]['Percentage']) ? $CourseAssessment2[$p][$categoryId]['Percentage'] : '';

                                                echo '<td><input title="" class=" form-control percent" id="percent1"  type="number" name="percentage[' . $p . '][' . $categoryId . ']" value="' . $percentage_value . '" placeholder="0%"  >  </input></td>';
                                                echo '<td>';
                                                echo "<select class='browser-default custom-select' name='bonus[" . $p . "][" . $categoryId . "]'>";
                                                //echo '<option></option>';
                                                if ($Course['LangId'] == 1) {
                                                    echo "<option value='3'> </option>";
                                                } else {
                                                    echo "<option value='1'> </option>";
                                                }
                                                foreach ($bonus as $bonusId => $row) {
                                                    $bonusId_value = isset($CourseAssessment2[$p][$categoryId]['BonusId']) ? $CourseAssessment2[$p][$categoryId]['BonusId'] : '';
                                                    $selected = $bonusId == $bonusId_value ? 'selected' : '';
                                                    echo '<option value="' . $bonusId . '" ' . $selected . '>' . $row['Choices'] . '</option>';
                                                }

                                                echo '</select>';
                                                echo '</td>';
                                                echo '</tr>';

                                                if (is_numeric($percentage_value)) {
                                                    $total_percentage_value = $total_percentage_value + $percentage_value;
                                                }
                                                $i = 1;
                                                foreach ($Assessment['subcategories'] as $SubId => $SubcategoryName) {
                                                    echo '<tr styles="float: left">';
                                                    echo '<td></td>';

                                                    $sub_value = isset($CourseAssessment2[$p][$categoryId]['SubcategoryId' . $i]) ? $CourseAssessment2[$p][$categoryId]['SubcategoryId' . $i] : '';
                                                    $checked = $SubId == $sub_value ? 'checked' : '';

                                                    echo '<td  colspan="2"><input class="box" type="checkbox" name="subcategories_' . $i++ . '[' . $p . '][' . $categoryId . ']" value="' . $SubId . '" ' . $checked . '/>' . $SubcategoryName . '</td>';
                                                    echo '</tr>';
                                                }
                                            }
                                            ?>
                                        </table>
                                        <span class="text-center badge badge-primary p-1 " style="background-color:#c51162 !important;">
                                            <?php echo t_total_score; ?>
                                            <input type="text" id="totalScore_" name="totalScore_[<?php echo $p; ?>]" value="<?php echo $total_percentage_value; ?>" style="background-color:#fff;" disabled>

                                            <i class="fas fa-percent mb-3 mr-2"></i>
                                        </span>

                                    </div>
                                    </tr>
                                    <?php

                                    ?>
                                    </table>
                                </div>
                                <input type="hidden" id="numOfmethods" name="numOfmethods" value="<?php echo $p; ?>">

                                <br>
                                <!-- ./professors table -->
                            </div>

                            <!-- /.card-body -->
                        </div>
                    <?php
                    }
                    ?>
                    <input type="hidden" id="numOfmethods" name="numOfmethods" value="<?php echo $p; ?>">
                    <div class="text-center">
                        <button type="button" id="newMethodButton" class="btn btn-default btn-rounded" style=" text-transform: none;" data-toggle="modal" data-target="#evaluationModal<?php echo $p; ?>"><?php echo t_addExtra ?></button>
                        <button type="submit" name="finish_creation" id="finish_creation" class=" btn btn-default btn-rounded"><i class="far fa-save"></i> <?php echo t_save; ?></button>
                    </div>
                    <br>
                </form>
            </section>
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
    <!-- Modal for extra evaluation (added here for fixed redirection)-->
    <div id="newMethodDiv">
        <form id="newMethod" method="POST" action="<?php echo URL . "ProfessorNewController/addNewEvaluationMethod?CourseId=" . $Course['Id'] . "&EvalMethod= " . ($p); ?>">
            <div class="modal fade bd-example-modal-lg" id="evaluationModal<?php echo $p; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="evaluationModal"><?php echo t_evaluation_modal_title ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <div class="text-center">
                                            <?php
                                            echo   $p . "ή Μέθοδος αξιολόγησης";
                                            ?>
                                        </div>
                                        <br>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_percentage_value = 0;
                                    foreach ($Assessments as $categoryId => $Assessment) {
                                        echo '<tr>';
                                        echo "<th>" . $Assessment['CategoryName'] . '</th>';
                                        $percentage_value = '';

                                        echo '<td><input title="" class="form-control percent" id="percent1"  type="number" name="percentage[' . $categoryId . ']" value="' . $percentage_value . '" placeholder="0%" >  </input></td>';
                                        echo '<td>';
                                        echo "<select  class='browser-default custom-select' name='bonus[" . $categoryId . ']">';
                                        if ($Course['LangId'] == 1) {
                                            echo "<option value='3'> </option>";
                                        } else {
                                            echo "<option value='1'> </option>";
                                        }
                                        foreach ($bonus as $bonusId => $row) {
                                            echo '<option value="' . $bonusId . '" "">' . $row['Choices'] . '</option>';
                                        }

                                        echo '</select>';
                                        echo '</td>';
                                        echo '</tr>';

                                        if (is_numeric($percentage_value)) {
                                            $total_percentage_value = $total_percentage_value + $percentage_value;
                                        }
                                        $i = 1;
                                        foreach ($Assessment['subcategories'] as $SubId => $SubcategoryName) {
                                            echo '<tr>';
                                            echo '<td></td>';
                                            echo '<td  colspan="2"><input class="box" type="checkbox" name="subcategories_' . $i++ . '[' . $categoryId . ']" value="' . $SubId . '" ""/>' . $SubcategoryName . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo t_close ?></button>
                            <button type="submit" name="finish_creation1" id="finish_creation1" class="btn btn-primary"><?php echo t_save ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>