


<div class="container py-2 ">
    <div class="mycontainer1 text-center d-flex justify-content-center">
        <!--form -->
        <form class="customSelect" method="POST" action="<?php echo URL; ?>AdminController/HTMLBySchool">
            <!-- Grid row -->
            <div class="form-row align-items-center">
                <!-- Grid column -->
                <div class="col-auto">
                    <!-- Material input -->
                    <div class="md-form">
                        <div class="select" >
                            <?php
                                // echo "<select id='getDname' onchange='dSelectCheck(this);' class='browser-default custom-select' name='department_'>";
                                echo "<select class='browser-default custom-select ' name='education_level'>";
                                echo "<option value='1'>";
                                echo t_level1;
				echo "</option>";
                                echo "<option value='0'>";
                                echo t_level2;
                                echo "</option>";
                                echo "</select>";
                            ?>
                        </div>
                        <div class="select" >
                            <?php
                                // echo "<select id='getDname' onchange='dSelectCheck(this);' class='browser-default custom-select' name='department_'>";
                                echo "<select class='browser-default custom-select ' name='department_'>";
                                echo "<option value=''></option>";
                                $i='a';
                                foreach ($department as $Id => $row ) {
                                    $activeCoursesList=$this->CourseModel->getActiveCoursesListBySchool($row['DepartmentName']);
                                        echo "<option class='my_class' value='" . $row['Id'] . "'>" . $row['DepartmentName'] . '<span class="badge badge-warning"><i class="fas fa-info-circle"></i> ('. count($activeCoursesList) . ' '.t_active_courses.' ) </span>'. "</option>";
                                        $i=$i.'a';
                                                                        
                                }
                                // echo  '<span class="badge badge-warning"><i class="fas fa-info-circle"></i> test </span>';

                                echo "</select>";
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-auto">
                    <button type="submit" name="next5" class="btn btn-light next"><?php echo t_next;?></button>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </form>
        <!--form -->
    </div>
</div>
