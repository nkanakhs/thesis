<?php

?>

<div id="Course-<?php echo $CourseId; ?>" class="container py-5">
  <header><h2 class="text-center" ><?php echo $Course['CourseTitle'] ?></h2></header>

  <!-- 1) -->
  <div class="animated zoomIn py-5">
    <div>
      <p >
        <u class="font-weight-bold"><strong><?php echo  t_general ?></strong></u>
      </p>
      <table border="2" class="table table-hover">
        <tbody>
          <tr>
            <td
              class="text-right"
              style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 45%;
              "
            >
              <strong class="font-weight-bold"><?php echo t_school ?></strong>
            </td>
            <td colspan="3" style="border-color: #000000">
            <?php echo $Course['SchoolName'] ?>
            </td>
          </tr>
          <tr>
            <td
              class="text-right"
              style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 45%;
              "
            >
              <strong class="font-weight-bold"><?php echo t_level?></strong>
            </td>
            <td colspan="3" style="border-color: #000000">
            <?php
            
                if ($Course['EducationId']== 4 || $Course['EducationId']== 1 ){ //undergraduate
                    echo  t_level1 .' ';
                }
                else if ($Course['EducationId']== 2 || $Course['EducationId']== 5 ){ //postgraduate
                    echo  t_level2 .' ';
                }else if ($Course['EducationId']== 3 || $Course['EducationId']== 6 ){ //phd
                    echo  t_level3 .' ';
                }
                
                
            ?>
        
        
            </td>
          </tr>
          <tr>
            <td
              class="text-right"
              style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 45%;
              "
            >
              <strong class="font-weight-bold"><?php echo t_lesson_code ?></strong>
            </td>
            <td style="border-color: #000000"><?php echo $Course['LessonCode']?></td>
            <td
              class="text-right"
              style="background-color: #e8e8e8; border-color: #000000"
            >
              <strong class="font-weight-bold"><?php echo t_semester ?></strong>
            </td>
            <td style="border-color: #000000"><?php echo $Course['Semester']?><sup>ο</sup></td>
          </tr>
          <tr>
            <td
              class="text-right"
              style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 45%;
              "
            >
              <strong class="font-weight-bold"><?php echo t_teaching_activities?></strong>
            </td>
            <td
              class="text-center"
              colspan="2"
              style="background-color: #e8e8e8; border-color: #000000; border-bottom: 1px solid #000;"
            >
              <strong class="font-weight-bold"><?php echo t_teaching_hours?></strong>
            </td>
            <td
              class="text-center"
              style="background-color: #e8e8e8; border-color: #000000;border-bottom: 1px solid #000;"
            >
              <strong class="font-weight-bold"><?php echo t_credit_units?></strong>
            </td>
          </tr>
          <?php if ($Course['LectureHours']!=0)  { ?>
          <tr>
            <td
              class="text-right"
              style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 45%;
              "
            >
            <?php echo t_teaching_activities_name1 ?>

            </td>
            <td
              class="text-center"
              colspan="2"
              
            >
            <?php echo $Course['LectureHours'] ?>
            </td>
            <td
              class="text-center"
              
            >
             
            </td>
          </tr>
          <?php } if ($Course['LaboratoryHours']!=0)  { ?>
          <tr>
            <td
              class="text-right"
              style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 45%;
              "
            >
            <?php echo t_teaching_activities_name2 ?>

            </td>
            <td
              class="text-center"
              colspan="2"
              
            >
            <?php echo $Course['LaboratoryHours'] ?>
            </td>
            <td
              class="text-center"
              
            >
             
            </td>
          </tr>
          <?php } if ($Course['TutorialHours']!=0)  { ?>
          <tr>
            <td
              class="text-right"
              style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 45%;
              "
            >
            <?php echo t_teaching_activities_name3 ?>

            </td>
            <td
              class="text-center"
              colspan="2"
              
            >
            <?php echo $Course['TutorialHours'] ?>
            </td>
            <td
              class="text-center"
              
            >
             
            </td>
          </tr>
          <?php } if ($Course['LabTutorialHours']!=0)  { ?>
          <tr>
            <td
              class="text-right"
              style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 45%;
              "
            >
            <?php echo t_teaching_activities_name4 ?>

            </td>
            <td
              class="text-center"
              colspan="2"
              
            >
            <?php echo $Course['LabTutorialHours'] ?>
            </td>
            <td
              class="text-center"
              
            >
             
            </td>
          </tr>
          <?php } ?>
          <tr>
            <td
              class="text-right"
              style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 45%;
              "
            >
            <?php echo t_total ?>

            </td>
            <td
              class="text-center"
              colspan="2"
              
            >
            <?php echo $Course['TotalHours'] ?>
            </td>
            <td
              class="text-center"
              
            >
            <?php echo $Course['CreditUnits'] ?>
            </td>
          </tr>

    

         

       
          <tr>
            <td
              class="text-right"
              style="background-color: #e8e8e8; border-color: #000000"
            >
              <strong class="font-weight-bold"><?php echo t_course_type?></strong>
            </td>
            <td colspan="3" rowspan="1" style="border-color: #000000">
            <?php echo $course_Type;?>
            </td>
          </tr>
          <tr>
            <td
              class="text-right"
              style="background-color: #e8e8e8; border-color: #000000"
            >
              <strong class="font-weight-bold"><?php echo t_prerequisite_courses?></strong>
            </td>
            <td colspan="3" rowspan="1" style="border-color: #000000">
            <?php if (count($RequiredCourses)!=0){ ?>
                <div >
                    <?php
                        
                        foreach ($RequiredCourses as $PrerequisiteId => $title ) {
                            echo $title. '<br>';
                        }
                    ?>
                </div>
                <br>
                <?php } ?>
            </td>
          </tr>
          <tr>
            <td
              class="text-right"
              style="background-color: #e8e8e8; border-color: #000000"
            >
              <strong class="font-weight-bold"><?php echo t_language?></strong>
            </td>
            <td colspan="3" rowspan="1" style="border-color: #000000">
                <?php echo ($Course['LangId']==1) ? t_language1 : t_language2;?>
    
            </td>
          </tr>
          <tr>
            <td
              class="text-right"
              style="background-color: #e8e8e8; border-color: #000000"
            >
              <strong class="font-weight-bold"><?php echo t_erasmus?></strong>
            </td>
            <td colspan="3" rowspan="1" style="border-color: #000000"><?php echo ($Course['ErasmusFl']) ? t_yes : t_no;?></td>
          </tr>
          <tr>
            <td
              class="text-right"
              style="background-color: #e8e8e8; border-color: #000000"
            >
              <strong class="font-weight-bold"><?php echo t_url?></strong>
            </td>
            <td colspan="3" rowspan="1" style="border-color: #000000">
              <a
                href="<?php if ($Course['CourseUrl']!='') echo $Course['CourseUrl'] ?>"
                target="_blank"
                ><?php if ($Course['CourseUrl']!='') echo $Course['CourseUrl'] ?></a
              >
            </td>
          </tr>
        </tbody>
      </table>
      <p>&nbsp;</p>
    </div>
  </div>

  <!-- 2) Learning outcomes -->
  <div class="animated zoomIn delay-1s">
      <p>
        <u><strong class="font-weight-bold"><?php echo t_2learning_outcomes ?></strong></u>
      </p>
      <table border="2" class="table table-hover">
        <tbody>
          <tr>
            <td
              style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 40%;
              "
            >
              <strong class="font-weight-bold"><?php echo t_learning_outcomes ?></strong>
            </td>
          </tr>
          <tr>
            <td style="border-color: #000000">

              <p><?php echo t_learning_outcomes_begin ?></p>
              <?php
                  if(count($CourseOutcome)==0){
                      echo '<br>';
                  }
                  if (count($CourseOutcome)!=0){
                      echo '<ul style="list-style-type:disc">';
                  }
                  foreach ($CourseOutcome as $feature) {
                      echo  '<li>&nbsp;<i>' . $feature['Verbs'].'</i> '. $feature['Sentence'] . '</li>';
                  }
                  if(count($CourseOutcome)!=0){
                      echo '</ul>';
                  }
              ?>
              &nbsp;
            </td>
          </tr>
          <tr>
            <td
              style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 40%;
              "
            >
              <strong class="font-weight-bold"><?php echo t_general_capabilities;?></strong>
            </td>
          </tr>
          <tr>
            <td style="border-color: #000000">
              &nbsp;

              <?php
                  if (count($CourseOutcome)!=0){
                      echo '<ul style="list-style-type:disc">';
                  }
                  foreach ($CourseSkills as $feature) {           
                      echo  '<li>&nbsp;' . $feature . '</li>';
                  }
                  if(count($CourseOutcome)!=0){
                      echo '</ul>';
                  }
              ?>



              &nbsp;
            </td>
          </tr>
        </tbody>
      </table>
        

  </div>

  <!-- 3) Course content -->
  <div class="py-5 animated zoomIn delay-2s">
    <p class="text-justify">
      <u><strong class="font-weight-bold"><?php echo t_3course_content?></strong></u>
    </p>
    <table border="2" class="table table-hover">
      <tbody>
        <tr>
          <td style="word-break: break-word;">
          
            <?php 
                echo str_replace(array("\r\n","\r","\n"),'<br>',trim($Course['Content']));
            ?>
          
          </td>
        </tr>
      </tbody>
    </table>
    
  </div>
  
  <!-- 4) Use of technology -->
 <div class="animated zoomIn delay-3s">
   
  <p class="text-justify">
    <u><strong class="font-weight-bold"><?php echo t_4teaching_methods ?></strong></u>
  </p>
  
  <table border="2" class="table table-hover">
    <td
        style="
          background-color: #e8e8e8;
          border-color: #000000;
          width: 40%;
        "
        colspan="5"
      >
        <strong class="font-weight-bold"><?php echo t_lecture_method ?></strong>
      </td>
  
      <td><?php echo $Course['LectureMethod'] ?></td>
  </table>

  <table border="2" class="table table-hover">
    <td
        style="
          background-color: #e8e8e8;
          border-color: #000000;
          width: 40%;
        "
        colspan="5"
      >
        <strong class="font-weight-bold"><?php echo t_use_of_technlogy ?></strong>
      </td>
  
    <?php 
    $string='';
    foreach($CourseMethod as $Id=>$row){
        echo '<tr>';
        if ($string!=$row['UseOfTechnologies']){
            echo '<td>' . $row['UseOfTechnologies'].':</td>';
        }
        
      
        echo '<ul><td>';

        if($row['TextA']) echo '-&nbsp;&nbsp;&nbsp;&nbsp;' . $row['TextA'].'<br>';
        if($row['TextB']) echo '-&nbsp;&nbsp;&nbsp;&nbsp;' . $row['TextB'].'<br>';
        if($row['TextC'])  echo '-&nbsp;&nbsp;&nbsp;&nbsp;' . $row['TextC'].'<br>';
        echo '</ul></td>';
        

        echo '</tr>';
        $string=$row['UseOfTechnologies'];

    }
    ?>
  </table>

  <table border="2" class="table table-hover">
    <tr>
      <td  style="
                background-color: #e8e8e8;
                border-color: #000000;
                width: 40%;
              " colspan="5">
        <strong class="font-weight-bold"><?php echo t_teaching_organisation ?></strong>
      </td>
    </tr>
  
    <?php 
      $sumOfHours = 0;
        foreach($CourseActivities as $Id=>$row){
        if ($row['Hours'] !=0){
            if($_SESSION['lang']== 'gr'){
                $mo = str_replace('.',',',number_format($row['Hours']/13,1));
            }else{
                $mo = number_format($row['Hours']/13,1);
            }
            echo '<tr>';
            if ($row['Activities']){
                echo '<td >' . $row['Activities'].' </td>';
            }
            if ($row['Hours']){
              echo '<td >' .$row['Hours'].' ' .t_hours.'</td>';
              $sumOfHours+=$row['Hours'];
            } 
            echo '</tr>';
        }
      }

    ?>

    <tr>
      <td><?php echo t_total ?></td> 
      <td><?php echo $sumOfHours .' ' .t_hours?></td> 
    </tr>
    
  </table>

    <!-- organization comment -->
    <?php 
      if($Course['OrganizationComment']!=''){?>
          <br>
          <?php
              $prefix0 = "OrganizationComment0:";
              $prefix1 = "OrganizationComment1:";

              //if OrganizationComment contains $prefix0 && $prefix1
              if (strpos($Course['OrganizationComment'], $prefix0) !== false && strpos($Course['OrganizationComment'], $prefix1) !== false) {
                  $result0 = get_string_between($Course['OrganizationComment'], $prefix0,  $prefix1);
                  $index1 = strpos($Course['OrganizationComment'], $prefix1) + strlen($prefix1);
                  $result1 = substr($Course['OrganizationComment'], $index1);                                  
              }else{
                  $result0 = '';
                  $result1 = $Course['OrganizationComment'];
              }
              
          ?>

        <?php if (str_replace(array("\r\n","\r","\n"),'<br>',trim($result0))){ ?> 
          <i><?php echo t_organisation_comment0 .' : ';?>  </i>
          <br>
          <p style="word-break: break-word;">
            <?php   echo  str_replace(array("\r\n","\r","\n"),'<br>',trim($result0));
                echo '<br>';
            ?>
          </p>
          <?php }
          if (str_replace(array("\r\n","\r","\n"),'<br>',trim($result1))){ ?> 
            <i><?php echo t_organisation_comment .' : ';?>  </i>
            <br>
            <p style="word-break: break-word;">
            <?php   echo  str_replace(array("\r\n","\r","\n"),'<br>',trim($result1));
                echo '<br></p>';
          }
          
      }
    ?>
 </div>

  <!-- 5) Assessment -->
  <div class="py-5 animated zoomIn delay-4s">
    <div class="ce-bodytext">
      <p class="text-justify">
        <u><strong class="font-weight-bold"><?php echo '(5) ' .t_assessment?></strong></u>
      </p>
      <table border="2" class="table table-hover">
        <?php
         $athroistikh = 0;
         foreach($CourseAssessment as $Id=>$row){
          if($row['Percentage']!=0){
            echo '<tr><td colspan="5">'.t_assessment1.'</td></tr>';
            $athroistikh =1;
            break;
          }
         }
         if($athroistikh!=1){
          echo '<tr><td colspan="5"> Επιμορφωτική/Διαμορφωτική </td></tr>';
         }
        ?>
        <?php 
            if(count($CourseAssessment)!=0){
                $preCategory = '';
  
                foreach($CourseAssessment as $Id=>$row){
                  
                    if($row['Percentage']!=0){
                        echo '<tr>';
                       
                        echo '<td>' . (($preCategory!=$row['CategoryName'])?$row['CategoryName']:'').' </td>';
                        echo '<td>' .  (($preCategory!=$row['CategoryName'])?$row['Percentage'] .'%':'').'</td>';
                        if ($row['SubcategoryName']!=''){
                            echo '<td>' .'('. $row['SubcategoryName'] .')'.'</td>';
                        }
                        // echo '<td>' .'('. $row['Choices'] .')'.'</td>';
                        echo '</tr>';
                        $preCategory = $row['CategoryName'];
                        
                    }
                }
              
                $preCategory = '';
                foreach($CourseAssessment1 as $Id=>$row){
                    if($row['Percentage']!=0 && $row['SubcategoryId1']==0  && $row['SubcategoryId2']==0  && $row['SubcategoryId3']==0  && $row['SubcategoryId4']==0){
                        echo '<tr>';
                        echo '<td>' . (($preCategory!=$row['CategoryName'])?$row['CategoryName']:'').' </td>';
                        echo '<td>' .  (($preCategory!=$row['CategoryName'])?$row['Percentage'] .'%':'').'</td>';
                        echo '<td> </td>';
                        // echo '<td>' .'('. $row['Choices'] .')'.'</td>';
                        echo '</tr>';
                        $preCategory = $row['CategoryName'];
                    }
                }                
            }else{ 
                $preCategory = '';
                foreach($CourseAssessment1 as $Id=>$row){
                    if($row['Percentage']!=0){
                        echo '<tr>';
                        echo '<td>' . (($preCategory!=$row['CategoryName'])?$row['CategoryName']:'').' </td>';
                        echo '<td>' .  (($preCategory!=$row['CategoryName'])?$row['Percentage'] .'%':'').'</td>';
                        if ($row['SubcategoryName']!=''){
                            echo '<td>' .'('. $row['SubcategoryName'] .')'.'</td>';
                        }
                        echo '</tr>';
                        $preCategory = $row['CategoryName'];
                    }
                }

            }
            
        ?>

      </table>
      <?php 
        if($Course['AssessmentComment']!=''){?>
            <br>
            <i><?php echo t_assessment_comment .' : ';?>  </i>
            <br>
            <p style="word-break: break-word;">

              <?php
                
                echo str_replace(array("\r\n","\r","\n"),'<br>',trim($Course['AssessmentComment']));         
                echo '<br>';    
              }
            ?>
            </p>
    </div>
  </div>

  <!-- 6) Bibliography -->
  <div class="py-5 animated zoomIn delay-5s">
      
        <p class="text-justify">
          <u><strong class="font-weight-bold"><?php echo '(6) '. t_recommended_bibliography?></strong></u>
        </p>
        <table border="2" class="table table-hover">
          <tbody>
            <tr>
              <td style="word-break: break-word;">
                <?php echo str_replace(array("\r\n","\r","\n"),'<br>',trim($Course['Bibliography']));?>
              </td>
            </tr>
          </tbody>
        </table>
      
    </div>
      <!-- end container -->
</div>
