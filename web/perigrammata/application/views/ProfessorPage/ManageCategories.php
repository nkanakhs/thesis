
<input type="hidden" id="languageId" value="<?php echo $_SESSION['lang'];?>" />

<div class="py-5">
        <div class="card card-cascade narrower container px-0 ">
                    <div class="view view-cascade gradient-card-header myblue1 z-depth-2 text-center  narrower py-4 px-1  mb-3  rounded ">
                        <h3 class="mycourses text-white font-italic "><?php echo $title[0]["CourseTitle"] . "\t" . $title[0]["LessonCode"]?> </h3>
                    </div>

<div class="text-center py-4">
    <h3> 
        <?php 
        if ($_SESSION['lang']=='gr'){
            echo   $method_number ; 
            echo t_methodnumber;
        }else
        {
            echo t_methodnumber;
            echo  $method_number ; 
        }
        ?>
    </h3>
    <br>
    <?php
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        if($role[0]['RoleId']==0){
            if ($_SESSION['lang']=='gr'){
            $stmt=$conn->prepare(" SELECT d.Id,d.CategoryName
                                FROM course_has_category
                                inner join assessment_categories as d on CategoryId=d.Id
                                where CourseId =? and method_number = ?");
            $stmt->execute([$courseID, $method_number]);
            $categories=$stmt->fetchAll();
            }else{
                $stmt=$conn->prepare("  SELECT Id,CategoryName
                                FROM assessment_categories
                                inner join course_has_category as d on d.CategoryId +8=Id
                                where d.CourseId =? and d.method_number = ?");
                $stmt->execute([$courseID, $method_number]);
                $categories=$stmt->fetchAll();
            }
            foreach ($categories as $Id=>$category)
            {
                ?>

                <div style="display: inline-block;">
                <?php
                if($_SESSION['choice']==1){ // for evaluation
                    if($_SESSION['lang']=='gr')
                    { 
                        ?>
                        <a href="<?php echo URL . 'ProfessorController/ManageAssessment?CourseId=' .$courseID .'&method_number=' . $method_number .'&category=' . $category['Id']; ?>"  class="btn btn-rounded_ btn-light" style="text-transform: none;">
                            <?php echo $category['CategoryName']; ?> 
                        </a>   
                    </div>
                    <?php
                    }else{
                        ?>
                        <a href="<?php echo URL . 'ProfessorController/ManageAssessment?CourseId=' .$courseID .'&method_number=' . $method_number .'&category=' . ($category['Id'] -8) ; ?>"  class="btn btn-rounded_ btn-light" style="text-transform: none;">
                            <?php echo $category['CategoryName']; ?> 
                        </a>   
                    </div>
                    <?php 
                    }
                }else{         //for adding extra exercises
                    if($_SESSION['lang']=='gr')
                    { 
                        ?>
                        <a href="<?php echo URL . 'ProfessorController/ManageAssessmentNumber?CourseId=' .$courseID .'&method_number=' . $method_number .'&category=' . $category['Id']; ?>"  class="btn btn-rounded_ btn-light" style="text-transform: none;">
                            <?php echo $category['CategoryName']; ?> 
                        </a>   
                    </div>
                    <?php
                    }else{
                        ?>
                        <a href="<?php echo URL . 'ProfessorController/ManageAssessmentNumber?CourseId=' .$courseID .'&method_number=' . $method_number .'&category=' . ($category['Id'] -8) ; ?>"  class="btn btn-rounded_ btn-light" style="text-transform: none;">
                            <?php echo $category['CategoryName']; ?> 
                        </a>   
                    </div>
                    <?php 
                    }
                    
                }
            }
        }else{
            if($_SESSION['lang']=='gr')
            {
            $stmt=$conn->prepare(" SELECT distinct d.Id,d.CategoryName
                                FROM course_has_category as p
                                inner join assessment_categories as d on CategoryId=d.Id
                                inner join partner_jurisdiction as q on q.assessmentId = d.Id and q.partnerId = ? and q.method_number = ?
                                where p.CourseId =? and p.method_number = ?");
            $stmt->execute([$_SESSION['user_id'],$method_number,$courseID, $method_number]);
            $categories=$stmt->fetchAll();
            }
            else{
                $stmt=$conn->prepare("   SELECT distinct p.Id,p.CategoryName
                                                FROM  assessment_categories as p
                                                inner join course_has_category as d on d.CategoryId +8 = p.Id 
                                                inner join partner_jurisdiction as q on q.assessmentId = p.Id -8 and q.partnerId = ? and q.method_number = ?
                                                where d.CourseId =? and d.method_number = ?");
                $stmt->execute([$_SESSION['user_id'],$method_number,$courseID, $method_number]);
                $categories=$stmt->fetchAll();
                
            }
            foreach ($categories as $Id=>$category)
            {
                ?>
                <div style="display: inline-block;">
                <?php
                
                    if($_SESSION['lang']=='gr')
                    { 
                        ?>
                        <a href="<?php echo URL . 'ProfessorController/ManageAssessment?CourseId=' .$courseID .'&method_number=' . $method_number .'&category=' . $category['Id'] ; ?>"  class="btn btn-rounded_ btn-light" style="text-transform: none;">
                            <?php echo $category['CategoryName']; ?> 
                        </a>   
                    </div>
                    <?php
                    }else{
                        ?>
                        <a href="<?php echo URL . 'ProfessorController/ManageAssessmentr?CourseId=' .$courseID .'&method_number=' . $method_number .'&category=' . ($category['Id'] -8) ; ?>"  class="btn btn-rounded_ btn-light" style="text-transform: none;">
                            <?php echo $category['CategoryName']; ?> 
                        </a>   
                    </div>
                    <?php 
                    }                  
                
            }
        }
    ?>
    <br></br>
</div>
        
</div>
</div>