
<input type="hidden" id="languageId" value="<?php echo $_SESSION['lang'];?>" />

<div class="py-5">
        <div class="card card-cascade narrower container px-0 ">
            <div class="view view-cascade gradient-card-header myblue1 z-depth-2 text-center  narrower py-2 px-1  mb-3  rounded ">
                <h4 class="mycourses text-white font-italic ">
                    <?php echo t_mycourses; ?>
                </h4>
                <h4 class="text-light"><i class="fas fa-graduation-cap"></i><?php  echo $department_['DepartmentName']; ?></h4>
            </div>

            <div class="text-center">
                <div style="display: inline-block;">
                    <a href="<?php echo URL . 'StudentController/CoursesEnrollement?department_=' . $department_selected ; ?>" class="btn btn-light" style=" text-transform: none;">
                        <?php echo 'Εγγραφή σε Μάθημα' ?> 
                    </a>   
                </div>
                    <a href="<?php echo URL . 'StudentController/CoursesList?department_=' . $department_selected ; ?>" class="btn btn-light" style="text-transform: none;">
                        <?php echo t_mycourses; ?> 
                    </a>   
                <br></br>
            </div>
        </div>
</div>