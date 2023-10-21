

<div id="outer" class="text-center">

    <?php if ($superAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/CreateInstitution1" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_create_institution; ?>    
        </a> 
    </div>  
    <?php } ?>  
    
    <?php if ($superAdminFlag == 1 || $institutionAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/CreateSchool1" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_create_school; ?> 
        </a>
    </div>     
    <?php } ?>      

    <?php if ($superAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/CreateDepartment1" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_create_department; ?> 
        </a>  
    </div>   
    <?php } 
    
    if ($_SESSION['admin_id'] != 0) { ?>

    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/CreateCourse1" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_create_course; ?> 
        </a>
    </div>

    <br><br>

    <?php } ?>
    
    <?php if ($superAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/AddAdmin" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_add_admin; ?> 
        </a>
    </div>
    <?php } ?>      
    
    <?php if ($superAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/AddVerb" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_add_verb; ?> 
        </a>
    </div>    
    <?php } ?>  

    <br><br>     
    
    <?php if ($superAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/MyInstitutions" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_institutions_list; ?>    
        </a>   
    </div>
    <?php } ?>  
    
    <?php if ($institutionAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/MySchools" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_schools_list; ?> 
        </a>   
    </div>
    <?php } ?>

    <?php if ($superAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/AllSchools" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_schools_list; ?> 
        </a>   
    </div>
    <?php } ?>
    
    <?php if ($superAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/MySyllabus" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_syllabus_list; ?> 
        </a>   
    </div>        
    <?php } ?>   
    
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/AllCourses" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_courses_list; ?> 
        </a>
    </div>
    
    <br>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>NewAdminController/Workload" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo "Προβολή και Εξαγωγή Φόρτου"; ?> 
        </a>
    </div>

    <?php if ($superAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/UserRequests" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_users_list; ?> 
        </a>
    </div>  
    <?php } ?>   

    <br><br>   
    
    <?php if ($superAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/OutcomeList" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_outcomes_list; ?> 
        </a>
    </div>
    <?php } ?>
    
    <?php if ($superAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/LearningOutcomes" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_learning_outcomes0; ?> 
        </a>   
    </div>
    <?php } ?>
    
    <?php if ($superAdminFlag == 1) { ?>
    <div style="display: inline-block;">
        <a href="<?php echo URL; ?>AdminController/DocumentLearningOutcomes" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
            <?php echo t_learning_outcomes_; ?> 
        </a>
    </div>  
    <?php } ?>

    <a href="<?php echo URL; ?>AdminController/SchoolHtmlExporter" class="btn myblue1 font-weight-bold text-white" style="width: 240px;border-radius:25px;">
        <?php echo t_school_html .' ' ;?>  <span class="badge bg-success animated pulse infinite"> New <i class="far fa-lightbulb"></i></span>
    </a>
    <br>
        
    <br>

</div>
