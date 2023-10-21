<div class="p-5">

    <div class="container-fluid">
        <h2><?php echo $title[0]["CourseTitle"] ." "."(". $title[0]["LessonCode"]. ")"?></h2>
        <h4><?php 
                if($categories!=null){
                    $ptr = 'assessment'.$categories[0]["CategoryId"];
                    echo  constant($ptr);
                ?></h4> 
    </div>
</div>
<?php 
?>
<form method="POST" action="<?php echo URL . "ProfessorController/SubmitGrades?CourseId=" .$_GET['CourseId'] ."&categoryId=" .$category ."&method_number=" .$method_number ."&number=" .$number; ?>">
<div class="p-5">
<div class="table-responsive">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" >
            <thead class="myblue1 text-white"> 
                <tr> 
                    <?php
                    if ($_SESSION['lang']=='gr'){
                    ?>
                    <th class="th-sm font-weight-bold"><?php echo 'Όνομα';?> </th>
                    <th class="th-sm font-weight-bold"><?php echo 'Επίθετο';?> </th>
                    
                    <?php
                    foreach($categories as $Id => $row)
                    $subexist=0;
                        if ($row["SubcategoryId1"]!= 0)
                        {
                            $subexist++;
                            ?>
                            <th class="th-sm font-weight-bold"><?php 
                            $ptr = $categories[0]["SubcategoryId1"];
                            $stmt = $conn->prepare("SELECT SubcategoryName
                                                    FROM perigrammata_db.assessment_subcategories
                                                    WHERE Id = ?");
                            $stmt->execute([$ptr]); 
                            $categoryName = $stmt->fetchAll();
                            echo $categoryName[0]["SubcategoryName"]; ?></th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Βαθμολογήθηκε από"; ?> </th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Ημερομηνία" ?> </th>
                            <?php
                        } 
                        if ($row["SubcategoryId2"]!= 0)
                        {
                            $subexist++;
                            ?>
                            <th class="th-sm font-weight-bold"><?php 
                            $ptr = $categories[0]["SubcategoryId2"];
                            $stmt = $conn->prepare("SELECT SubcategoryName
                                                    FROM perigrammata_db.assessment_subcategories
                                                    WHERE Id = ?");
                            $stmt->execute([$ptr]); 
                            $categoryName = $stmt->fetchAll();
                            echo $categoryName[0]["SubcategoryName"]; ?></th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Βαθμολογήθηκε από"; ?> </th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Ημερομηνία" ?> </th>
                            <?php
                        } 
                        if ($row["SubcategoryId3"]!= 0)
                        {
                            $subexist++;
                            ?>
                            <th class="th-sm font-weight-bold"><?php 
                            $ptr = $categories[0]["SubcategoryId3"];
                            $stmt = $conn->prepare("SELECT SubcategoryName
                                                    FROM perigrammata_db.assessment_subcategories
                                                    WHERE Id = ?");
                            $stmt->execute([$ptr]); 
                            $categoryName = $stmt->fetchAll();
                            echo $categoryName[0]["SubcategoryName"]; ?></th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Βαθμολογήθηκε από"; ?> </th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Ημερομηνία" ?> </th>
                            <?php
                        } 
                        if ($row["SubcategoryId4"]!= 0)
                        {
                            $subexist++;
                            ?>
                            <th class="th-sm font-weight-bold"><?php 
                            $ptr = $categories[0]["SubcategoryId4"];
                            $stmt = $conn->prepare("SELECT SubcategoryName
                                                    FROM perigrammata_db.assessment_subcategories
                                                    WHERE Id = ?");
                            $stmt->execute([$ptr]); 
                            $categoryName = $stmt->fetchAll();
                            echo $categoryName[0]["SubcategoryName"]; ?>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Βαθμολογήθηκε από"; ?> </th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Ημερομηνία" ?> </th>
                            <?php
                        } 
                        if ($subexist==0)       //the case where an assessment has no subcategories
                        {
                            ?>
                            <th class="th-sm font-weight-bold"><?php 
                            echo "Βαθμολογία"; ?>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Βαθμολογήθηκε από"; ?> </th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Ημερομηνία" ?> </th>
                            <?php
                        } 
                    ?>
                    <th class="th-sm font-weight-bold"><?php echo 'Συνολικός Βαθμός';?> </th>
                    <?php
                    }else{
                    ?>
                    <th class="th-sm font-weight-bold"><?php echo 'Name';?> </th>
                    <th class="th-sm font-weight-bold"><?php echo 'Last Name';?> </th>
                    
                    <?php
                    foreach($categories as $Id => $row)
                    $subexist=0;
                        if ($row["SubcategoryId1"]!= 0)
                        {
                            $subexist++;
                            ?>
                            <th class="th-sm font-weight-bold"><?php 
                            $ptr = $categories[0]["SubcategoryId1"];
                            $stmt = $conn->prepare("SELECT SubcategoryName
                                                    FROM perigrammata_db.assessment_subcategories
                                                    WHERE Id = ?");
                            $stmt->execute([$ptr+16]); 
                            $categoryName = $stmt->fetchAll();
                            echo $categoryName[0]["SubcategoryName"]; ?></th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Evaluated By"; ?> </th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Date" ?> </th>
                            <?php
                        } 
                        if ($row["SubcategoryId2"]!= 0)
                        {
                            $subexist++;
                            ?>
                            <th class="th-sm font-weight-bold"><?php 
                            $ptr = $categories[0]["SubcategoryId2"];
                            $stmt = $conn->prepare("SELECT SubcategoryName
                                                    FROM perigrammata_db.assessment_subcategories
                                                    WHERE Id = ?");
                            $stmt->execute([$ptr+16]); 
                            $categoryName = $stmt->fetchAll();
                            echo $categoryName[0]["SubcategoryName"]; ?></th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Evaluated By"; ?> </th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Date" ?> </th>
                            <?php
                        } 
                        if ($row["SubcategoryId3"]!= 0)
                        {
                            $subexist++;
                            ?>
                            <th class="th-sm font-weight-bold"><?php 
                            $ptr = $categories[0]["SubcategoryId3"];
                            $stmt = $conn->prepare("SELECT SubcategoryName
                                                    FROM perigrammata_db.assessment_subcategories
                                                    WHERE Id = ?");
                            $stmt->execute([$ptr+16]); 
                            $categoryName = $stmt->fetchAll();
                            echo $categoryName[0]["SubcategoryName"]; ?></th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Evaluated By"; ?> </th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Date" ?> </th>
                            <?php
                        } 
                        if ($row["SubcategoryId4"]!= 0)
                        {
                            $subexist++;
                            ?>
                            <th class="th-sm font-weight-bold"><?php 
                            $ptr = $categories[0]["SubcategoryId4"];
                            $stmt = $conn->prepare("SELECT SubcategoryName
                                                    FROM perigrammata_db.assessment_subcategories
                                                    WHERE Id = ?");
                            $stmt->execute([$ptr+16]); 
                            $categoryName = $stmt->fetchAll();
                            echo $categoryName[0]["SubcategoryName"]; ?>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Evaluated By"; ?> </th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Date" ?> </th>
                            <?php
                        } 
                        if ($subexist==0)       //the case where an assessment has no subcategories
                        {
                            ?>
                            <th class="th-sm font-weight-bold"><?php 
                            echo "General Grade"; ?>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Evaluated By"; ?> </th>
                            <th class="th-sm font-weight-bold">
                            <?php echo "Date" ?> </th>
                            <?php
                        } 
                    ?>
                    <th class="th-sm font-weight-bold"><?php echo 'Final Grade';?> </th>
                    <?php
                    }?>
                </tr>  
            </thead>  
            <tbody>    
                <?php
                    foreach ($studentsGrades as $Id => $student){
                        
                        $db_username = 'perigrammata_db';
                        $db_password = '@ad1p_c0urses_29_01_2020';
                        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
                       
                        if($student['grade1By'] != null && $student['grade1By']!=0){
                            $stmt = $conn->prepare("SELECT FirstName , LastName
                            FROM user  
                            WHERE user.Id = ? ");    
                            $stmt->execute([$student['grade1By']]); 
                            $grade1By = $stmt->fetchAll();
                            $grade1ByFullName = $grade1By[0]['FirstName'] .' '. $grade1By[0]['LastName'];
                        }else{
                            $grade1ByFullName = '';
                        }
                        
                        if($student['grade2By'] != null && $student['grade2By']!=0){
                            $stmt = $conn->prepare("SELECT FirstName , LastName
                            FROM user  
                            WHERE user.Id = ? ");    
                            $stmt->execute([$student['grade2By']]); 
                            $grade2By = $stmt->fetchAll();
                            $grade2ByFullName = $grade2By[0]['FirstName'] .' '. $grade2By[0]['LastName'];
                        }else{
                            $grade2ByFullName = '';
                        }
                        
                        if($student['grade3By'] != null && $student['grade3By']!=0){
                            $stmt = $conn->prepare("SELECT FirstName , LastName
                            FROM user  
                            WHERE user.Id = ? ");    
                            $stmt->execute([$student['grade3By']]); 
                            $grade3By = $stmt->fetchAll();
                            $grade3ByFullName = $grade3By[0]['FirstName'] .' '. $grade3By[0]['LastName'];
                        }else{
                            $grade3ByFullName = '';
                        }
                    
                        if($student['grade4By'] != null && $student['grade4By']!=0){
                            $stmt = $conn->prepare("SELECT FirstName , LastName
                            FROM user  
                            WHERE user.Id = ? ");    
                            $stmt->execute([$student['grade4By']]); 
                            $grade4By = $stmt->fetchAll();
                            $grade4ByFullName = $grade4By[0]['FirstName'] .' '. $grade4By[0]['LastName'];
                        }else{
                            $grade4ByFullName = '';
                        }

                        if($student['general_gradeBy'] != null && $student['general_gradeBy']!=0){
                            $stmt = $conn->prepare("SELECT FirstName , LastName
                            FROM user  
                            WHERE user.Id = ? ");    
                            $stmt->execute([$student['general_gradeBy']]); 
                            $grade4By = $stmt->fetchAll();
                            $general_gradeByFullName = $grade4By[0]['FirstName'] .' '. $grade4By[0]['LastName'];
                        }else{
                            $general_gradeByFullName = '';
                        }
                        
                        echo '<tr>';
                        echo '<td>' . $student["FirstName"] .'</td>';
                        echo '<td>' . $student["LastName"] .'</td>';
                        if($role[0]['RoleId']==0){
                            // professor can evaluate all possible subcategories
                            if ($categories[0]["SubcategoryId1"]!= 0){
                                echo '<td class="Grades"><input class="form-control form-control-sm " name="Grade['.$student["Id"].'][subcategory1_grade]" value="'.  $student['subcategory1_grade'] .'" min="0" ></input></td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade1By]">' .$grade1ByFullName. '</td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade1Date]">' .$student["grade1Date"]. '</td>';
                            }
                            if ($categories[0]["SubcategoryId2"]!= 0){    
                                echo '<td class="Grades"><input class="form-control form-control-sm " name="Grade['.$student["Id"].'][subcategory2_grade]" value="'.  $student['subcategory2_grade'] .'" min="0" ></input></td>';;
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade2By]">' . $grade2ByFullName.'</td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade2Date]">'  .$student["grade2Date"]. '</td>';
                            }
                            if ($categories[0]["SubcategoryId3"]!= 0){
                                echo '<td class="Grades"><input class="form-control form-control-sm " name="Grade['.$student["Id"].'][subcategory3_grade]" value="'.  $student['subcategory3_grade'] .'" min="0"></input></td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade3By]">' .$grade3ByFullName. '</td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade3Date]">' .$student["grade3Date"]. '</td>';                      
                            }
                            if ($categories[0]["SubcategoryId4"]!= 0){
                                echo '<td class="Grades"><input class="form-control form-control-sm " name="Grade['.$student["Id"].'][subcategory4_grade]" value="'.  $student['subcategory4_grade'] .'" min="0" ></input></td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade4By]">' .$grade4ByFullName. '</td>';
                                echo' <td class="Grades"><name="Grade['.$student["Id"].'][grade4Date]">' .$student["grade4Date"]. '</td>';
                            }
                            if($subexist==0)
                            {
                                echo '<td class="Grades"><input class="form-control form-control-sm " name="Grade['.$student["Id"].'][general_grade]" value="'.  $student['general_grade'] .'" min="0" ></input></td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][general_gradeBy]">' .$general_gradeByFullName. '</td>';
                                echo' <td class="Grades"><name="Grade['.$student["Id"].'][general_gradeDate]">' .$student["general_gradeDate"]. '</td>';
                            }
                            echo '<td class="Total"><input class="form-control form-control-sm mt-0" id="js-total_sum"  name="Total" value="' . $student['finalGrade'] . '" readonly/></td>';
                        }else{ 
                            //disable the subcategories the partner has no jurisdiction
                            $i=1;
                            $stmt = $conn->prepare(" SELECT subcategoryId
                                    from partner_jurisdiction 
                                    where partnerId=? and courseId=? and method_number =?");
                            $stmt->execute([$_SESSION['user_id'] , $courseID , $method_number] );
                            $subcategories = array();
                            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                                $subcategories[$i]= $row['subcategoryId'];
                                $i++;
                            }
                            
                            $disabled='';
                            if ($categories[0]["SubcategoryId1"]!= 0){
                                if(!in_array($categories[0]["SubcategoryId1"] , $subcategories) ){
                                    $disabled = 'disabled';
                                }
                                echo '<td class="Grades"><input '.$disabled.' class="form-control form-control-sm " name="Grade['.$student["Id"].'][subcategory1_grade]" value="'.  $student['subcategory1_grade'] .'" min="0" ></input></td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade1By]">' .$grade1ByFullName. '</td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade1Date]">' .$student["grade1Date"]. '</td>';
                            }
                            $disabled='';
                            if ($categories[0]["SubcategoryId2"]!= 0){    
                                if(!in_array($categories[0]["SubcategoryId2"] , $subcategories) ){
                                    $disabled = 'disabled';
                                }
                                echo '<td class="Grades"><input '.$disabled.' class="form-control form-control-sm " name="Grade['.$student["Id"].'][subcategory2_grade]" value="'.  $student['subcategory2_grade'] .'" min="0" ></input></td>';;
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade2By]">' . $grade2ByFullName.'</td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade2Date]">'  .$student["grade2Date"]. '</td>';
                            }
                            $disabled='';
                            if ($categories[0]["SubcategoryId3"]!= 0){
                                if(!in_array($categories[0]["SubcategoryId3"] , $subcategories) ){
                                    $disabled = 'disabled';
                                }
                                echo '<td class="Grades"><input '.$disabled.' class="form-control form-control-sm " name="Grade['.$student["Id"].'][subcategory3_grade]" value="'.  $student['subcategory3_grade'] .'" min="0"></input></td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade3By]">' .$grade3ByFullName. '</td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade3Date]">' .$student["grade3Date"]. '</td>';                      
                            }
                            $disabled='';
                            if ($categories[0]["SubcategoryId4"]!= 0){
                                if(!in_array($categories[0]["SubcategoryId4"] , $subcategories) ){
                                    $disabled = 'disabled';
                                }
                                echo '<td class="Grades"><input '.$disabled.' class="form-control form-control-sm " name="Grade['.$student["Id"].'][subcategory4_grade]" value="'.  $student['subcategory4_grade'] .'" min="0" ></input></td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][grade4By]">' .$grade4ByFullName. '</td>';
                                echo' <td class="Grades"><name="Grade['.$student["Id"].'][grade4Date]">' .$student["grade4Date"]. '</td>';
                            }
                            if($subexist==0)
                            {
                                if(!in_array(33, $subcategories) ){
                                    $disabled = 'disabled';
                                }
                                echo '<td class="Grades"><input '.$disabled.' class="form-control form-control-sm " name="Grade['.$student["Id"].'][general_grade]" value="'.  $student['general_grade'] .'" min="0" ></input></td>';
                                echo '<td class="Grades"><name="Grade['.$student["Id"].'][general_gradeBy]">' .$general_gradeByFullName. '</td>';
                                echo' <td class="Grades"><name="Grade['.$student["Id"].'][general_gradeDate]">' .$student["general_gradeDate"]. '</td>';
                            }
                            echo '<td class="Total"><input class="form-control form-control-sm mt-0" id="js-total_sum"  name="Total" value="' . $student['finalGrade'] . '" readonly/></td>';
                        }
                        echo '</tr>';
                    }
                ?>        
            </tbody>
        </table>
</div>
</div>
    <div class= "text-center">
        <button type="submit" name="finish_creation" id="finish_creation" class=" btn btn-outline-blue btn-rounded btn-sm p-4"><i class="far fa-save"></i> <?php echo t_save;?></button>
    </div>
</form>
    <?php }else{
        echo '<h4>' . "Δεν έχει οριστεί η υποκατηγορία" . '</h4>';
    }
    ?>