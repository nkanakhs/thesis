<div class="container py-5">
    <h3 class="text-center"><?php  echo $department_;  ?></h3>

    <?php 
    $prevSemester = -1;
    ?>
    <br><br>
    <header><h2 class="text-center" ><?php echo t_contents; ?></h2></header>
    <?php
    foreach ($activeCoursesList as $Id => $row1 ) {
         $CourseTitle = $row1['CourseTitle'];
         $CourseId = $row1['Id'];
         echo "<br><a href='#Course-".$CourseId."'>" . $CourseTitle . "</a><br>";
    }
    ?><br><br>
    <header><h1 class="text-center" ><?php echo t_outlines; ?></h1></header>  
    <?php


    foreach ($activeCoursesList as $Id => $row ) {
        $CourseId = '';
        $CourseId = $row['Id'];
         
        $Course = $this->CourseModel->getCourse($row['Id']);
        $CourseType = $this->CourseModel->getCourseType($Course['LangId']);
        $course_Type = '';
        foreach ($CourseType as $Id1 => $row1 ) {
            if($row1['Id'] == $Course['CourseTypeId'])
                $course_Type = $row1['CourseType'];
        }
        $RequiredCourses= $this->CourseModel->getRequiredCourses($row['Id']);
        $CourseOutcome = $this->CourseModel->getCourseOutcomes($row['Id']);
        $verbs = $this->CourseModel->getVerbs($Course['LangId']);
        $CourseVerbs = $this->CourseModel->getCourseVerbs($row['Id']);
        $skills = $this->CourseModel->getSkills($Course['LangId']);
        $CourseSkills = $this->CourseModel->getCourseSkills($row['Id']);
        
        $method = $this->CourseModel->getLectureMethod($Course['LangId']);
        
        $UseOfTechnologies = $this->CourseModel->getUseOfTechnologies($Course['LangId']);
        $CourseMethod = $this->CourseModel->getCourseMethod($row['Id']);
        $activities = $this->CourseModel->getActivities($Course['LangId']);
        $CourseActivities = $this->CourseModel->getCourseActivities($row['Id']);

        $Assessments = $this->CourseModel->getCategoriesAssessment($Course['LangId']);
        $bonus = $this->CourseModel->getBonus($Course['LangId']);
        $CourseAssessment = $this->CourseModel->getCourseAssessmentNew($row['Id']);
        $CourseAssessment1 = $this->CourseModel->getCourseAssessment($row['Id']);

        if($prevSemester!=$Course['Semester'])  {
            echo '<h2 class="py-5">' .$Course['Semester'] .'o '.t_semester1. '</h2>';
            $prevSemester = $Course['Semester'];
        }
        require APP .'views/ProfessorPage/fhtmlEthaae.php';
    }

    echo  '<br>' ;
   
   


    // var_dump($CourseSkills);
    // foreach ($CourseSkills as $Id => $row ) {
    //     echo $row['CourseId'] . ', '. $row['Description'] . '<br>';
    // }

    ?>

</div>
