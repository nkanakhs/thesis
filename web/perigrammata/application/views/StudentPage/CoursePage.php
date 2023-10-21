<input type="hidden" id="studentId" value="<?php echo $studentId;?>" />
<input type="hidden" id="courseId" value="<?php echo $courseId;?>" />
<input type="hidden" id="language" value="<?php echo $_SESSION['lang'];?>" />
<div class="py-3 px-4">
    <div class="card card-cascade py-3" style="background-color:#eee;">
        <div class="view view-cascade gradient-card-header px-4">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4 py-3">
                        <img src="<?php echo URL; ?>/public/img/study.png" class="img-fluid rounded-start" alt="..."  height="330" width="330">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <br></br>
                            <h3 class="card-title"><?php echo $course[0]['CourseTitle'] . "  (" . $course[0]['LessonCode'] . ")"; ?></h3>
                            <p class="card-text"><?php echo $department[0]['departmentName'] ;?></p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-3">
                        <div class="card ">
                            <div class="list-group list-group-flush" id="list-tab" role="tablist ">
                                <a class="list-group-item list-group-item-action active " href="#list-info" data-toggle="list" role="tab" aria-controls="home" onclick="closegrades()"><?php echo dropdown1;?></a>
                                <a class="list-group-item list-group-item-action" href="#list-professors" data-toggle="list" role="tab" aria-controls="Professors" onclick="closegrades()"><?php echo dropdown2;?></a>
                                <a class="list-group-item list-group-item-action dropdown-toggle" id="studentgrades" data-toggle="dropdown" href="#list-grades" onclick="studentdropdown()" ><?php echo dropdown3;?></a>
                                <a class="list-group-item list-group-item-action" href="#list-evaluation" data-toggle="list" role="tab" aria-controls="Evaluation" onclick="closegrades()"><?php echo dropdown4;?></li></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-info" role="tabpanel" aria-labelledby="list-info-list">
                                    <div class="card ">
                                        <div class="card-header gradient-card-header">
                                            <?php echo dropdown1;?>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text"><?php echo $course[0]['Content'] ;?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="list-professors" role="tabpanel" aria-labelledby="list-professors-list" >
                                    <div class="card ">
                                        <div class="card-header gradient-card-header">
                                            <?php echo dropdown2;?>
                                        </div>
                                        <div class="card-body">
                                            <?php 
                                                foreach ($professors as $Id=>$professor)
                                                {
                                                    $db_username = 'perigrammata_db';
                                                    $db_password = '@ad1p_c0urses_29_01_2020';
                                                    $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                                    $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

                                                    $stmt=$conn->prepare("SELECT FirstName, LastName
                                                                        from user
                                                                        where Id=?");
                                                    $stmt->execute([$professor['ProfessorId']]);
                                                    $profInfo=$stmt->fetchAll();
                                                    
                                                    if ($_SESSION['lang'] == 'gr')
                                                    {
                                                            $stmt=$conn->prepare("SELECT role_description
                                                                            from CrewRoles
                                                                            where Role_Id=? 
                                                                            order by Role_Id");
                                                            $stmt->execute([$professor['RoleId']]);
                                                            $profRole=$stmt->fetchAll();
                                                    }else
                                                    {
                                                        $stmt=$conn->prepare("SELECT role_description
                                                                        from CrewRoles
                                                                        where Role_Id=?");
                                                        $stmt->execute([$professor['RoleId'] + 2]);
                                                        $profRole=$stmt->fetchAll();

                                                    }
                                                    //var_dump ($profInfo);
                                                    //var_dump ($profRole);
                                                    ?>
                                                    <p><li><?php echo $profInfo[0]['FirstName'] . " " . $profInfo[0]['LastName']; ?></li></p>
                                                    <cite><?php echo $profRole[0]['role_description']; ?></cite><br></br>
                                                    <?php 
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- final exam -->
                                <div class="tab-pane fade " id="grade1" role="tabpanel" aria-labelledby="list-grades-list" >
                                    <div class="card ">
                                        <div class="card-header gradient-card-header">
                                        <?php
                                            $db_username = 'perigrammata_db';
                                            $db_password = '@ad1p_c0urses_29_01_2020';
                                            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

                                            $stmt = $conn->prepare("SELECT CategoryName 
                                                            FROM assessment_categories
                                                            where Id= 1");
                                            $stmt->execute();
                                            $course = $stmt->fetchAll();
                                            echo assessment1;
                                        ?>
                                        </div>  
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr >
                                                        <th>
                                                            <strong><?php echo s_subcategories;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong><?php echo s_grade;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong><?php echo s_date;?></strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        foreach ($grades as $Id => $grade)
                                                        {
                                                            if ($grade['categoryId'] == 1)
                                                            {
                                                                $db_username = 'perigrammata_db';
                                                                $db_password = '@ad1p_c0urses_29_01_2020';
                                                                $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                                                $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
                                                                
                                                                //var_dump($grade);
                                                                $stmt = $conn->prepare("SELECT  SubcategoryName ,Id
                                                                from course_has_category
                                                                inner join assessment_subcategories on SubCategoryId1 = Id OR SubCategoryId2 = Id OR  SubCategoryId3 = Id OR  SubCategoryId4 = Id
                                                                where CourseId = ? and categoryId=1 and method_number=?");
                                                                $stmt->execute([$courseId , $grade['method_number']]);
                                                                $subname = $stmt->fetchAll();

                                                                if(!empty($subname)){
                                                                    foreach($subname as $subname)
                                                                    {
                                                                        echo '<tr>';
                                                                        if($subname['Id']==1)
                                                                        {
                                                                            echo '<td>' .subcategory1. '</td>';
                                                                            if(isset($grade['subcategory1_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['subcategory1_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade1Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }elseif($subname['Id']==2)
                                                                        {
                                                                            echo '<td>' .subcategory2. '</td>';
                                                                            if(isset($grade['subcategory2_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['subcategory2_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade2Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }elseif($subname['Id']==3)
                                                                        {
                                                                            echo '<td>' .subcategory3. '</td>';
                                                                            if(isset($grade['subcategory3_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['subcategory3_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade3Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }elseif($subname['Id']==4)
                                                                        {
                                                                            echo '<td>' .subcategory4. '</td>';
                                                                            if(isset($grade['subcategory4_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['subcategory4_grade'].'</td>';
                                                                                $date_arr= explode(" ", $grade['grade4Date']);
                                                                                $date= $date_arr[0];
                                                                                echo '<td>' . $date.'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<td>' .s_general .'</td>';
                                                                            if(isset($grade['general_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['general_grade'].'</td>';
                                                                                echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }

                                                                        }
                                                                        echo '</tr>';
                                                                    }
                                                                }else{
                                                                    
                                                                    echo '<tr>';
                                                                    echo '<td>' .s_general .'</td>';
                                                                    if(isset($grade['general_grade']))
                                                                    {
                                                                        echo '<td>' .$grade['general_grade'].'</td>';
                                                                        echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                    }else{      //if grade is not set
                                                                        echo '<td>' .'-'.'</td>';
                                                                        echo '<td>' .'-'.'</td>';
                                                                    }
                                                                    echo '</tr>';

                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                                <!-- team project exam -->
                                <div class="tab-pane fade " id="grade2" role="tabpanel" aria-labelledby="list-grades-list" >
                                    <div class="card ">
                                        <div class="card-header gradient-card-header">
                                        <?php
                                            $db_username = 'perigrammata_db';
                                            $db_password = '@ad1p_c0urses_29_01_2020';
                                            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

                                            $stmt = $conn->prepare("SELECT CategoryName 
                                                            FROM assessment_categories
                                                            where Id= 2");
                                            $stmt->execute();
                                            $course = $stmt->fetchAll();
                                            echo $course[0]['CategoryName'];
                                        ?>
                                        </div>  
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr >
                                                        <th>
                                                            <strong><?php echo s_subcategories;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong>Αριθμός Εργασίας</strong>
                                                        </th>
                                                        <th>
                                                            <strong> <?php echo s_grade;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong><?php echo s_date;?></strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        foreach ($grades as $Id => $grade)
                                                        {
                                                            if ($grade['categoryId'] == 2)
                                                            {
                                                                $db_username = 'perigrammata_db';
                                                                $db_password = '@ad1p_c0urses_29_01_2020';
                                                                $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                                                $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
                                                                
                                                                //var_dump($grade);
                                                                $stmt = $conn->prepare("SELECT  SubcategoryName ,Id
                                                                from course_has_category
                                                                inner join assessment_subcategories on SubCategoryId1 = Id OR SubCategoryId2 = Id OR  SubCategoryId3 = Id OR  SubCategoryId4 = Id
                                                                where CourseId = ? and categoryId=2 and method_number=?");
                                                                $stmt->execute([$courseId , $grade['method_number']]);
                                                                $subname = $stmt->fetchAll();
                                                                if(!empty($subname)){
                                                                foreach($subname as $subname)
                                                                {
                                                                    echo '<tr>';
                                                                    if($subname['Id']==5)
                                                                    {
                                                                        echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                        if(isset($grade['subcategory1_grade']))
                                                                        {
                                                                            echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                            echo '<td>' .$grade['subcategory1_grade'].'</td>';
                                                                            echo '<td>' .$grade['grade1Date'].'</td>';
                                                                        }else{      //if grade is not set
                                                                            echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                            echo '<td>' .'-'.'</td>';
                                                                            echo '<td>' .'-'.'</td>';
                                                                        }
                                                                    }elseif($subname['Id']==6)
                                                                    {
                                                                        echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                        if(isset($grade['subcategory2_grade']))
                                                                        {
                                                                            echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                            echo '<td>' .$grade['subcategory2_grade'].'</td>';
                                                                            echo '<td>' .$grade['grade2Date'].'</td>';
                                                                        }else{      //if grade is not set
                                                                            echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                            echo '<td>' .'-'.'</td>';
                                                                            echo '<td>' .'-'.'</td>';
                                                                        }
                                                                    }elseif($subname['Id']==7)
                                                                    {
                                                                        echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                        if(isset($grade['subcategory3_grade']))
                                                                        {
                                                                            echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                            echo '<td>' .$grade['subcategory3_grade'].'</td>';
                                                                            echo '<td>' .$grade['grade3Date'].'</td>';
                                                                        }else{      //if grade is not set
                                                                            echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                            echo '<td>' .'-'.'</td>';
                                                                            echo '<td>' .'-'.'</td>';
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        echo '<td>' .'Γενικός Βαθμός' .'</td>';
                                                                        if(isset($grade['general_grade']))
                                                                        {
                                                                            echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                            echo '<td>' .$grade['general_grade'].'</td>';
                                                                            echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                        }else{      //if grade is not set
                                                                            echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                            echo '<td>' .'-'.'</td>';
                                                                            echo '<td>' .'-'.'</td>';
                                                                        }

                                                                    }
                                                                    echo '</tr>';
                                                                }
                                                                }else{
                                                                    
                                                                    echo '<tr>';
                                                                    echo '<td>' .'Γενικός Βαθμός' .'</td>';
                                                                    if(isset($grade['general_grade']))
                                                                    {
                                                                        echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                        echo '<td>' .$grade['general_grade'].'</td>';
                                                                        echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                    }else{      //if grade is not set
                                                                        echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                        echo '<td>' .'-'.'</td>';
                                                                        echo '<td>' .'-'.'</td>';
                                                                    }
                                                                    echo '</tr>';

                                                                }
                                                                echo '</tr>';
                                                                
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                                
                                <!-- personal project -->
                                <div class="tab-pane fade " id="grade3" role="tabpanel" aria-labelledby="list-grades-list" >
                                    <div class="card ">
                                        <div class="card-header gradient-card-header">
                                        <?php
                                            $db_username = 'perigrammata_db';
                                            $db_password = '@ad1p_c0urses_29_01_2020';
                                            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

                                            $stmt = $conn->prepare("SELECT CategoryName 
                                                            FROM assessment_categories
                                                            where Id= 3");
                                            $stmt->execute();
                                            $course = $stmt->fetchAll();
                                            echo $course[0]['CategoryName'];
                                        ?>
                                        </div>  
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr >
                                                        <th>
                                                            <strong><?php echo s_subcategories;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong>Αριθμός Εργασίας</strong>
                                                        </th>
                                                        <th>
                                                            <strong> <?php echo s_grade;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong><?php echo s_date;?></strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        foreach ($grades as $Id => $grade)
                                                        {
                                                            if ($grade['categoryId'] == 3)
                                                            {
                                                                $db_username = 'perigrammata_db';
                                                                $db_password = '@ad1p_c0urses_29_01_2020';
                                                                $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                                                $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
                                                                
                                                                //var_dump($grade);
                                                                $stmt = $conn->prepare("SELECT  SubcategoryName ,Id
                                                                from course_has_category
                                                                inner join assessment_subcategories on SubCategoryId1 = Id OR SubCategoryId2 = Id OR  SubCategoryId3 = Id OR  SubCategoryId4 = Id
                                                                where CourseId = ? and categoryId=3 and method_number=?");
                                                                $stmt->execute([$courseId , $grade['method_number']]);
                                                                $subname = $stmt->fetchAll();
                                                                //var_dump($subname);
                                                                if(!empty($subname))
                                                                {
                                                                    foreach($subname as $subname)
                                                                    {
                                                                        echo '<tr>';
                                                                        if($subname['Id']==8)
                                                                        {
                                                                            echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                            if(isset($grade['subcategory1_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['subcategory1_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade1Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }elseif($subname['Id']==9)
                                                                        {
                                                                            echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                            if(isset($grade['subcategory2_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['subcategory2_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade2Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }elseif($subname['Id']==10)
                                                                        {
                                                                            echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                            if(isset($grade['subcategory3_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['subcategory3_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade3Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<td>' .'Γενικός Βαθμός' .'</td>';
                                                                            if(isset($grade['general_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['general_grade'].'</td>';
                                                                                echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }

                                                                        }
                                                                        echo '</tr>';
                                                                    }
                                                                }else{
                                                                
                                                                    echo '<tr>';
                                                                    echo '<td>' .'Γενικός Βαθμός' .'</td>';
                                                                    if(isset($grade['general_grade']))
                                                                    {
                                                                        echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                        echo '<td>' .$grade['general_grade'].'</td>';
                                                                        echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                    }else{      //if grade is not set
                                                                        echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                        echo '<td>' .'-'.'</td>';
                                                                        echo '<td>' .'-'.'</td>';
                                                                    }
                                                                    echo '</tr>';

                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                                <!-- intermediate exam -->
                                <div class="tab-pane fade " id="grade4" role="tabpanel" aria-labelledby="list-grades-list" >
                                    <div class="card ">
                                        <div class="card-header gradient-card-header">
                                        <?php
                                            $db_username = 'perigrammata_db';
                                            $db_password = '@ad1p_c0urses_29_01_2020';
                                            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

                                            $stmt = $conn->prepare("SELECT CategoryName 
                                                            FROM assessment_categories
                                                            where Id= 4");
                                            $stmt->execute();
                                            $course = $stmt->fetchAll();
                                            echo $course[0]['CategoryName'];
                                        ?>
                                        </div>  
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr >
                                                        <th>
                                                            <strong><?php echo s_subcategories;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong> Αριθμός Προόδου</strong>
                                                        </th>
                                                        <th>
                                                            <strong> <?php echo s_grade;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong><?php echo s_date;?></strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        foreach ($grades as $Id => $grade)
                                                        {
                                                            if ($grade['categoryId'] == 4)
                                                            {
                                                                echo '<tr>';
                                                                echo '<td>' .'Γενικός βαθμός'.'</td>';
                                                                if(isset($grade['general_grade']))
                                                                {
                                                                    echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                    echo '<td>' .$grade['general_grade'].'</td>';
                                                                    echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                }else{      //if grade is not set
                                                                    echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                    echo '<td>' .'-'.'</td>';
                                                                    echo '<td>' .'-'.'</td>';
                                                                }

                                                            }
                                                                echo '</tr>';
                                                        }
                                                    ?>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>
                                </div>


                                <!-- exercises -->
                                <div class="tab-pane fade " id="grade5" role="tabpanel" aria-labelledby="list-grades-list" >
                                    <div class="card ">
                                        <div class="card-header gradient-card-header">
                                        <?php
                                            $db_username = 'perigrammata_db';
                                            $db_password = '@ad1p_c0urses_29_01_2020';
                                            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

                                            $stmt = $conn->prepare("SELECT CategoryName 
                                                            FROM assessment_categories
                                                            where Id= 5");
                                            $stmt->execute();
                                            $course = $stmt->fetchAll();
                                            echo $course[0]['CategoryName'];
                                        ?>
                                        </div>  
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr >
                                                        <th>
                                                            <strong><?php echo s_subcategories;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong> Αριθμός Άσκησης</strong>
                                                        </th>
                                                        <th>
                                                            <strong> <?php echo s_grade;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong><?php echo s_date;?></strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        foreach ($grades as $Id => $grade)
                                                        {
                                                            if ($grade['categoryId'] == 5)
                                                            {
                                                                echo '<tr>';
                                                                echo '<td>' .'Γενικός βαθμός'.'</td>';
                                                                if(isset($grade['general_grade']))
                                                                {
                                                                    echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                    echo '<td>' .$grade['general_grade'].'</td>';
                                                                    echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                }else{      //if grade is not set
                                                                    echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                    echo '<td>' .'-'.'</td>';
                                                                    echo '<td>' .'-'.'</td>';
                                                                }

                                                            }
                                                                echo '</tr>';
                                                        }
                                                    ?>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>
                                </div>

                                <!-- laboratory project -->
                                <div class="tab-pane fade " id="grade6" role="tabpanel" aria-labelledby="list-grades-list" >
                                    <div class="card ">
                                        <div class="card-header gradient-card-header">
                                        <?php
                                            $db_username = 'perigrammata_db';
                                            $db_password = '@ad1p_c0urses_29_01_2020';
                                            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

                                            $stmt = $conn->prepare("SELECT CategoryName 
                                                            FROM assessment_categories
                                                            where Id= 6");
                                            $stmt->execute();
                                            $course = $stmt->fetchAll();
                                            echo $course[0]['CategoryName'];
                                        ?>
                                        </div>  
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr >
                                                        <th>
                                                            <strong><?php echo s_subcategories;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong> Αριθμός Εργασίας</strong>
                                                        </th>
                                                        <th>
                                                            <strong> <?php echo s_grade;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong><?php echo s_date;?></strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        foreach ($grades as $Id => $grade)
                                                        {
                                                            if ($grade['categoryId'] == 6)
                                                            {
                                                                $db_username = 'perigrammata_db';
                                                                $db_password = '@ad1p_c0urses_29_01_2020';
                                                                $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                                                $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
                                                                
                                                                //var_dump($grade);
                                                                $stmt = $conn->prepare("SELECT  SubcategoryName ,Id
                                                                from course_has_category
                                                                inner join assessment_subcategories on SubCategoryId1 = Id OR SubCategoryId2 = Id OR  SubCategoryId3 = Id OR  SubCategoryId4 = Id
                                                                where CourseId = ? and categoryId=6 and method_number=?");
                                                                $stmt->execute([$courseId , $grade['method_number']]);
                                                                $subname = $stmt->fetchAll();
                                                                if(!empty($subname))
                                                                {
                                                                    foreach($subname as $subname)
                                                                    {
                                                                        echo '<tr>';
                                                                        if($subname['Id']==11)
                                                                        {
                                                                            echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                            if(isset($grade['subcategory1_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['subcategory1_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade1Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }elseif($subname['Id']==12)
                                                                        {
                                                                            echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                            if(isset($grade['subcategory2_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['subcategory2_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade2Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }elseif($subname['Id']==13)
                                                                        {
                                                                            echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                            if(isset($grade['subcategory3_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['subcategory3_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade3Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<td>' .'Γενικός Βαθμός' .'</td>';
                                                                            if(isset($grade['general_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['general_grade'].'</td>';
                                                                                echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }

                                                                        }
                                                                        echo '</tr>';
                                                                    }
                                                                }else{
                                                                    
                                                                    echo '<tr>';
                                                                    echo '<td>' .'Γενικός Βαθμός' .'</td>';
                                                                    if(isset($grade['general_grade']))
                                                                    {
                                                                        echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                        echo '<td>' .$grade['general_grade'].'</td>';
                                                                        echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                    }else{      //if grade is not set
                                                                        echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                        echo '<td>' .'-'.'</td>';
                                                                        echo '<td>' .'-'.'</td>';
                                                                    }
                                                                    echo '</tr>';

                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>
                                </div>

                                
                                <!-- laboratory exercises -->
                                <div class="tab-pane fade " id="grade7" role="tabpanel" aria-labelledby="list-grades-list" >
                                    <div class="card ">
                                        <div class="card-header gradient-card-header">
                                        <?php
                                            $db_username = 'perigrammata_db';
                                            $db_password = '@ad1p_c0urses_29_01_2020';
                                            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

                                            $stmt = $conn->prepare("SELECT CategoryName 
                                                            FROM assessment_categories
                                                            where Id= 7");
                                            $stmt->execute();
                                            $course = $stmt->fetchAll();
                                            echo $course[0]['CategoryName'];
                                        ?>
                                        </div>  
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr >
                                                        <th>
                                                            <strong><?php echo s_subcategories;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong> Αριθμός Άσκησης</strong>
                                                        </th>
                                                        <th>
                                                            <strong> <?php echo s_grade;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong><?php echo s_date;?></strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        foreach ($grades as $Id => $grade)
                                                        {
                                                            if ($grade['categoryId'] == 7)
                                                            {
                                                                $db_username = 'perigrammata_db';
                                                                $db_password = '@ad1p_c0urses_29_01_2020';
                                                                $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                                                $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
                                                                
                                                                //var_dump($grade);
                                                                $stmt = $conn->prepare("SELECT  SubcategoryName ,Id
                                                                from course_has_category
                                                                inner join assessment_subcategories on SubCategoryId1 = Id OR SubCategoryId2 = Id OR  SubCategoryId3 = Id OR  SubCategoryId4 = Id
                                                                where CourseId = ? and categoryId=7 and method_number=?");
                                                                $stmt->execute([$courseId , $grade['method_number']]);
                                                                $subname = $stmt->fetchAll();
                                                                //var_dump($subname);
                                                                if(!empty($subname))
                                                                {
                                                                    foreach($subname as $subname)
                                                                    {
                                                                        echo '<tr>';
                                                                        if($subname['Id']==14)
                                                                        {
                                                                            echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                            if(isset($grade['subcategory1_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['subcategory1_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade1Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }elseif($subname['Id']==15)
                                                                        {
                                                                            echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                            if(isset($grade['subcategory2_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['subcategory2_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade2Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }elseif($subname['Id']==16)
                                                                        {
                                                                            echo '<td>' .$subname['SubcategoryName']. '</td>';
                                                                            if(isset($grade['subcategory3_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['subcategory3_grade'].'</td>';
                                                                                echo '<td>' .$grade['grade3Date'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<td>' .'Γενικός Βαθμός' .'</td>';
                                                                            if(isset($grade['general_grade']))
                                                                            {
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .$grade['general_grade'].'</td>';
                                                                                echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                            }else{      //if grade is not set
                                                                                echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                                echo '<td>' .'-'.'</td>';
                                                                            }

                                                                        }
                                                                        echo '</tr>';
                                                                    }
                                                                }else{
                                                                    
                                                                    echo '<tr>';
                                                                    echo '<td>' .'Γενικός Βαθμός' .'</td>';
                                                                    if(isset($grade['general_grade']))
                                                                    {
                                                                        echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                        echo '<td>' .$grade['general_grade'].'</td>';
                                                                        echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                    }else{      //if grade is not set
                                                                        echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                        echo '<td>' .'-'.'</td>';
                                                                        echo '<td>' .'-'.'</td>';
                                                                    }
                                                                    echo '</tr>';

                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>
                                </div>

                                

                                <!-- intermediary laboratory exam -->
                                <div class="tab-pane fade " id="grade8" role="tabpanel" aria-labelledby="list-grades-list" >
                                    <div class="card ">
                                        <div class="card-header gradient-card-header">
                                        <?php
                                            $db_username = 'perigrammata_db';
                                            $db_password = '@ad1p_c0urses_29_01_2020';
                                            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                                            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

                                            $stmt = $conn->prepare("SELECT CategoryName 
                                                            FROM assessment_categories
                                                            where Id= 8");
                                            $stmt->execute();
                                            $course = $stmt->fetchAll();
                                            echo $course[0]['CategoryName'];
                                        ?>
                                        </div>  
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr >
                                                        <th>
                                                            <strong><?php echo s_subcategories;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong> Αριθμός Προόδου</strong>
                                                        </th>
                                                        <th>
                                                            <strong> <?php echo s_grade;?></strong>
                                                        </th>
                                                        <th>
                                                            <strong><?php echo s_date;?></strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        foreach ($grades as $Id => $grade)
                                                        {
                                                            if ($grade['categoryId'] == 8)
                                                            {
                                                                echo '<tr>';
                                                                echo '<td>' .'Γενικός βαθμός'.'</td>';
                                                                if(isset($grade['general_grade']))
                                                                {
                                                                    echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                    echo '<td>' .$grade['general_grade'].'</td>';
                                                                    echo '<td>' .$grade['general_gradeDate'].'</td>';
                                                                }else{      //if grade is not set
                                                                    echo '<td>' .$grade['assessmentNumber'].'</td>';
                                                                    echo '<td>' .'-'.'</td>';
                                                                    echo '<td>' .'-'.'</td>';
                                                                }

                                                            }
                                                                echo '</tr>';
                                                        }
                                                    ?>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>
                                </div>

                                <div class="tab-pane fade " id="list-evaluation" role="tabpanel" aria-labelledby="list-evaluation-list" >
                                    <div class="card ">
                                        <div class="card-header gradient-card-header">
                                            <?php echo dropdown4;?>
                                        </div>
                                        <div class="card-body">
                                            <div id="question">
                                            <?php 
                                            if (isset($grades[0]['method_number']))
                                            {
                                                echo '<strong>'."&nbsp;" .$grades[0]['method_number'].'η Μέθοδος αξιολόγησης</strong>';
                                                echo '<br>';
                                                echo '<br>';
                                                echo '<div class="table-responsive">';
                                                echo '<table class="table">';
                                                echo '<thead class="thead-light">';
                                                echo '<tr >';
                                                echo '<th>';
                                                echo '<strong>'.s_subcategories.'</strong>';
                                                echo '</th>';
                                                echo '<th>';
                                                echo '<strong>Ποσοστό</strong>';
                                                echo '</th>';
                                                echo '</tr>';
                                                echo '</thead>';
                                                echo '<tbody>';
                                                foreach ($methods as $Id2 => $method){
                                                    if($method['method_number']== $grades[0]['method_number']){
                                                        $stmt = $conn->prepare("SELECT CategoryName
                                                                            FROM assessment_categories  
                                                                            WHERE Id = ? ");    
                                                        $stmt->execute([$method['CategoryId']]); 
                                                        $categoryname = $stmt->fetchAll();
                                                        echo '<tr>';
                                                        echo '<td>';
                                                        echo $categoryname[0]['CategoryName'];    
                                                        echo '</td>';
                                                        echo '<td>';
                                                        echo $method['Percentage'] . '%';
                                                        echo '</td>';
                                                        echo '</tr>';
                                                    }    
                                                }
                                                echo '</tbody>';
                                                echo '</table>';

                                            }else
                                            {
                                                ?>
                                                <form method="POST" action="<?php echo URL . "StudentController/SubmitMethod?courseId=".$courseId ;?>">
                                                <?php
                                                echo '<div class="header">Επιλέξτε μέθοδο αξιολόγησης</div>';
                                                echo '<div class="choice-container">';
                                                foreach ($methodNumber as $Id => $methodNum)
                                                {
                                                    
                                                echo '<div class="choice-box" style="height:100%">';
                                                echo '<div class="choice-header">';
                                                    echo '<input type="radio" id="method_number" name="method_number" value="'.$methodNum['method_number'].'">'."&nbsp;" .$methodNum['method_number'].'η Μέθοδος αξιολόγησης';
                                                    echo '</div>';
                                                    echo '<i><strong>Περιλαμβάνει : </strong></i>';
                                                    echo '<div class="choice-info">';
                                                    foreach ($methods as $Id2 => $method){
                                                        if($method['method_number']== $methodNum['method_number']){
                                                            echo '<li>';
                                                            $stmt = $conn->prepare("SELECT CategoryName
                                                                                FROM assessment_categories  
                                                                                WHERE Id = ? ");    
                                                            $stmt->execute([$method['CategoryId']]); 
                                                            $categoryname = $stmt->fetchAll();
                                                            echo $categoryname[0]['CategoryName'] .' &nbsp;';    
                                                            echo '<br>';
                                                            echo 'Ποσοστό : ';
                                                            echo $method['Percentage'] . "%";
                                                            echo '</li>';
                                                        }    
                                                    }
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</input>';
                                                }
                                                echo '</div>';
                                                echo '<div class="text-center">';
                                                echo '<div id="subBtn">';
                                                echo '<button class="subBtn" type="submit" value="Submit">'.t_submit.'</button></div>';
                                                echo '</div>';
                                                echo '</form>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>