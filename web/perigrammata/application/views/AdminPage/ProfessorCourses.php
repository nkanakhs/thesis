

<div class="p-5">
<div class="table-responsive">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" >
            <thead class="myblue1 text-white"> 
                <tr>   
                    <th class="font-weight-bold th-sm">#</th>
                    <th class="th-sm font-weight-bold"><?php echo t_Institution;?></th>
                    <th class="th-sm font-weight-bold"><?php echo t_curriculum0;?></th>
                    <th class="th-sm font-weight-bold"><?php echo t_School;?></th>   
                    <th class="th-sm font-weight-bold"><?php echo t_semester0;?></th>
                    <th class="th-sm font-weight-bold"><?php echo t_professor;?></th> 
                    <th class="th-sm font-weight-bold"><?php echo t_course;?></th> 
                    <!--
                    <th class="th-sm font-weight-bold"><?php //echo t_delete;?></th>
                    
                    <th class="th-sm font-weight-bold"><?php// echo t_edit;?></th>
                    <th class="th-sm font-weight-bold"><?php //echo t_optional;?></th> ---->
                </tr>  
            </thead>
            <tbody>  
                <?php $i = 1;
                // professor id!  
                //$professorCourses = $this->CourseModel->getAllProfessorCourses($professorId);
                foreach ($professorCourses as $Id => $row ){ 
                    //$CourseName = $this->CourseModel->getProfessorCourses($row['Id']);
                    //$arrlength = count($CourseName);   

                    // get specific institution courses
                    $CourseId = $row['CourseId'];
                    $stmt = $conn->prepare("SELECT *
                    FROM courses 
                    WHERE Id = ?");
                    $stmt->execute([$CourseId]); 
                    $courses = $stmt->fetchAll(); // get the mysqli result

                    foreach ($courses as $Id => $row1){ 

                        $CourseId = $row['CourseId']; 
                        $InstitutionId = $row1['InstitutionId'];
                        $SecondInstitutionId = $row1['SecondInstitutionId'];
                        $SecondSchoolId = $row1['SecondSchoolId'];
                        $DepartmentId = $row1['DepartmentId']; 
                        $SecondDepartmentId = $row1['SecondDepartmentId']; 
    
                        $stmt = $conn->prepare("SELECT *
                        FROM perigrammata_db.institution
                        WHERE Id = ?");  
                        $stmt->execute([$InstitutionId]); 
                        $institution = $stmt->fetchAll(); // get the mysqli result

                        foreach ($institution as $row1) {
                            $InstitutionName = $row1['InstitutionName'];
                        }

                        if( !empty($SecondInstitutionId) && $SecondInstitutionId != 1 && $SecondInstitutionId != $InstitutionId ) {
                            $stmt = $conn->prepare("SELECT *
                            FROM perigrammata_db.institution
                            WHERE Id = ?");  
                            $stmt->execute([$SecondInstitutionId]); 
                            $institution2 = $stmt->fetchAll(); // get the mysqli result

                            foreach ($institution2 as $row3) {
                                $InstitutionName2 = "- " . $row3['InstitutionName'];
                            }
                        } else {
                            $InstitutionName2 = '';
                        }

                        $SecondSchoolName = '';  

                        if( !empty($SecondSchoolId) && $SecondSchoolId != 1 ) {     
                            $stmt = $conn->prepare("SELECT *
                            FROM perigrammata_db.school
                            WHERE Id = ?");  
                            $stmt->execute([$SecondSchoolId]); 
                            $secondSchool = $stmt->fetchAll(); // get the mysqli result

                            foreach ($secondSchool as $row4) {
                                $SecondSchoolName = "- " . $row4['SchoolName'];
                            }
                        } else {
                            $SecondSchoolName = '';
                        } 

                        $stmt = $conn->prepare("SELECT *
                        FROM perigrammata_db.department
                        WHERE Id = ?");
                        $stmt->execute([$DepartmentId]); 
                        $DepartmentName = $stmt->fetchAll(); // get the mysqli result

                        foreach ($DepartmentName as $row2) {
                            $CourseDepartmentName = $row2['DepartmentName'];
                        }

                        if( !empty($SecondDepartmentId) && $SecondDepartmentId != 1 && $SecondDepartmentId != $DepartmentId ) {

                            $stmt5 = $conn->prepare("SELECT *
                            FROM perigrammata_db.department
                            WHERE Id = ?");
                            $stmt5->execute([$SecondDepartmentId]); 
                            $SecondDepartmentName = $stmt5->fetchAll(); // get the mysqli result
    
                            foreach ($SecondDepartmentName as $row5) {
                                $CourseSecondDepartmentName = "- " . $row5['DepartmentName'];
                            }  
    
                        } else {
                            $CourseSecondDepartmentName = '';
                        }
                
            
                    ?>   
                    <tr class="p-0">
                        <td><?php echo $i;?>
                        <td><?php echo "<option value='" . $professorId . "'>" . $row['InstitutionName'];
                        echo "<option>" . $InstitutionName2 . "</option>" ?> </td>
                        <td><?php echo "<option value='" . $professorId . "'>" . $CourseDepartmentName;
                        echo "<option>" . $CourseSecondDepartmentName . "</option>" ?> </td>
                        <td><?php echo "<option value='" . $professorId . "'>" . $row['SchoolName'] . "</option>";
                        echo "<option>" . $SecondSchoolName . "</option>" ?> </td>
                        <td><?php echo "<option value='" . $professorId . "'>" . $row['Semester'] . "</option>" ?></td>
                        <td><?php echo "<option value='" . $professorId . "'>" . $professorName . "</option>" ?></td>
                        <td><?php echo "<option value='" . $professorId . "'>" . $row['CourseTitle'] . " (". $row['LessonCode'] . ")</option>" ?></td>
                    </tr>
                <?php $i++;
                    }
            } ?>
            </tbody>
            
        </table>
    </div>
</div>