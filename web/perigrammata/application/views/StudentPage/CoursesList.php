
<div class="py-5">
<div class="card card-cascade narrower container px-0 ">
<div class="card card-cascade narrower container px-0 ">
            <div class="view view-cascade gradient-card-header myblue1 z-depth-2 text-center  narrower py-2 px-1  mb-3  rounded ">
                <h4 class="mycourses text-white font-italic ">
                    <?php echo t_mycourses; ?>
                </h4>
                <h4 class="text-light"><i class="fas fa-graduation-cap"></i><?php  echo $department_['DepartmentName'];  ?></h4>
            </div>

    

<div class="table-wrapper table-responsive">
      <!--Table-->
      <div class="py-4">
      <table class="table table-hover mb-0 your-custom-styles " id="tableProf">
      <thead >
          <tr >
           
            <th class="font-weight-bold" >
                <?php echo t_course;?>
                <!-- <i class="fas fa-sort ml-1"></i> -->
             
            </th>
            <th class="font-weight-bold" >
            <?php echo "Κωδικός μαθήματος";?>
                <!-- <i class="fas fa-sort ml-1"></i> -->
              
            </th>
            <th class="font-weight-bold" >
            <?php echo "Κατάστασης Εγγραφής";?>
              <!-- <i class="fas fa-sort ml-1"></i> -->
              
            </th>
            
            <th class="font-weight-bold" >
            <?php echo "Σελίδα Μαθήματος";?>
              <!-- <i class="fas fa-sort ml-1"></i> -->
              
            </th>
           
          </tr>
        </thead>
        <!--Table head-->

        <!--Table body-->
        <tbody > <?php foreach ($courses as $Id => $row ){;?>
                <tr >
                    <td ><?php echo  $row['coursetitle'] ?></td>
                    <td ><?php echo  $row['LessonCode'] ?></td>
                    <td>
                      <?php if ($row["enrollementAccepted"]== 0){
                            echo "Αναμένεται έγκριση";
                      } else if ($row["enrollementAccepted"]== 1){
                            echo "Εγγεγραμμένος";
                      }else{
                            echo "Έχει απορριφθεί";
                      }
                      ?>
                    </td>
                    <td class="py-0">
                        <a href="<?php echo URL . 'StudentController/CoursePage?courseId= ' . $row['courseid']?>"> 
                            <div class="px-5">
                                <!--<img src="<?php echo URL; ?>/public/img/study.png" alt="Logo" height="30" width="30"></a>-->
                                <i class="fa fa-graduation-cap py-2"></i>
                            </div>
                    </td>
                        
                 
                </tr>
                
            <?php } ?>
          

        </tbody>
                    </div>
</div>
</div>
        </div>