<input type="hidden" id="languageId" value="<?php echo $_SESSION['lang'];?>" />

<div class="py-5">
        <div class="card card-cascade narrower container px-0 ">
                    <div class="view view-cascade gradient-card-header myblue1 z-depth-2 text-center  narrower py-4 px-1  mb-3  rounded ">
                        <h3 class="mycourses text-white font-italic "><?php echo $title[0]["CourseTitle"] . "\t" . $title[0]["LessonCode"]?> </h3>
                    </div>

                    <div class="text-center py-4">
                        <h3><?php echo t_methods; ?></h3>
                        <br>
                        <?php 
                            foreach($method_number as $Id=>$category)
                            {
                                ?>
                                <a href="<?php echo URL . 'ProfessorController/ManageCategories?CourseId=' . $courseID .'&method_number='. $category['method_number']; ?>" >
                                <button type="button" class="btn btn-rounded_ btn-light rounded-pill" style=" text-transform: none;">
                                    <?php 
                                        if ($_SESSION['lang']=='gr'){
                                            echo  $category['method_number'] ; 
                                            echo t_methodnumber;
                                        }else
                                        {
                                            echo t_methodnumber;
                                            echo  $category['method_number'] ; 
                                        }
                                    ?>
                                </button>
                                </a>
                                <?php
                            }
                        ?>
                    </div>
                    <br>
        </div>
</div>
