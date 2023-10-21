

<div class="p-5">
<div class="table-responsive">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" >
            <thead class="myblue1 text-white"> 
                <tr>
                    <th class="font-weight-bold th-sm">#</th>
                    <th class="th-sm font-weight-bold"><?php echo t_School;?></th>   
                    <th class="th-sm font-weight-bold"><?php echo t_curriculum0;?></th> 
                    <th class="th-sm font-weight-bold"><?php echo t_semester0;?></th>
                    <th class="th-sm font-weight-bold"><?php echo t_professor;?></th> 
                    <th class="th-sm font-weight-bold"><?php echo t_course;?></th> 
                    <th class="th-sm font-weight-bold"><?php echo t_delete;?></th>
                    <th class="th-sm font-weight-bold"><?php echo t_edit;?></th>
                    <th class="th-sm font-weight-bold"><?php echo t_optional;?></th>
                </tr>  
            </thead>  
            <tbody>            
                <?php $i = 1;   
                foreach ($courses as $Id => $row ){ 
                    //$CourseProfessorName = $this->CourseModel->getCourseProfessors($row['Id']);
                    //$arrlength = count($CourseProfessorName);  
                    $CourseId = $row['Id']; 
                    $stmt = $conn->prepare("SELECT course_has_professor.ProfessorId, user.FirstName, user.LastName
                    FROM perigrammata_db.course_has_professor
                    INNER JOIN user ON user.Id = course_has_professor.ProfessorId
                    WHERE CourseId = ?");
                    $stmt->execute([$CourseId]); 
                    $CourseProfessorName = $stmt->fetchAll(); // get the mysqli result
                    //$stmt->close();
            
                    ?>
                    <tr class="p-0">
                        <td><?php echo $i;?>
                        <td><?php echo "<option value='" . $row['Id'] . "'>" . $row['SchoolName'] . "</option>" ?> </td> 
                        <td><?php echo "<option value='" . $row['Id'] . "'>" . $row['SchoolName'] . "</option>" ?> </td>
                        <td><?php echo "<option value='" . $row['Id'] . "'>" . $row['Semester'] . "</option>" ?> </td>
                        <td>
                        <?php  
                        foreach ($CourseProfessorName as $row1) {
                            $ProfessorFullName = $row1['FirstName'] . ' ' . $row1['LastName']; 
                            //echo "<a href='AdminController/ProfessorCourses?professorId='" . $row1['ProfessorId'] . "'><option value='" . $row1['ProfessorId'] . "'>"; 
                            //echo $ProfessorFullName;
                            //echo "</option></a>"; 
                        ?>
                        <a href="<?php echo URL . 'AdminController/ProfessorCourses?professorId=' . $row1['ProfessorId'] ?>">
                        <option value="<?php echo  $row1['ProfessorId']; ?>">
                        <?php echo $ProfessorFullName; ?>
                        </option></a>
                        <?php 
                        }  
                        ?> 
                        </td>
                        <td><?php echo "<option value='" . $row['Id'] . "'>" . $row['CourseTitle'] ." (". $row['LessonCode'] . ")</option>" ?></td>
                        


                        <td>
                            <a class="btn btn-outline-danger btn-rounded btn-sm my-0 rounded-pill font-weight-bold" href="<?php echo URL . 'AdminController/deleteCourse?CourseId=' . $row['Id'] ?>">
                            <i class="far fa-trash-alt mt-0"></i>
                                <?php echo t_delete;?>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-outline-info btn-rounded btn-sm my-0 rounded-pill font-weight-bold" href="<?php echo URL . 'AdminController/editCourse?CourseId=' . $row['Id'] ?>">
                            <i class="fas fa-pencil-alt mt-0"></i>
                                <?php echo t_edit;?>
                            </a>
                        </td>
                        <td class="text-center">
                            <a class="my-0 rounded-pill font-weight-bold" href="<?php echo URL . 'AdminController/addOptionalCourse?CourseId=' . $row['Id'] .'&DepartmentId='.$row['DepartmentId']?>">
                                <span class="badge badge-default py-2">
                                    <i class="fas fa-book-open mt-0"></i>
                                
                                    <?php 
                                    if ($_SESSION['lang']=='en'){
                                        echo 'OPTIONAL';
                                    }else{
                                        echo 'ΕΠΙΛΟΓΗΣ';
                                    }
                                    ?>
                                </span>
                            </a>
                            
                            <a class="my-0 rounded-pill font-weight-bold" href="<?php echo URL . 'AdminController/deleteOptionalCourse?CourseId=' . $row['Id'] .'&DepartmentId='.$row['DepartmentId']?>">
                                <span class="badge badge-default py-2">
                                <i class="fas fa-book-open mt-0"></i>
                                
                                <?php 
                                if ($_SESSION['lang']=='en'){
                                    echo 'COMPULSORY';
                                }else{
                                    echo 'ΥΠΟΧΡΕΩΤΙΚΟ';
                                }
                                ?>
                                </span>
                            </a>
                        </td>
                    </tr>
                <?php $i++;
            } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="font-weight-bold th-sm">#</th>
                    <th class="th-sm font-weight-bold"><?php echo t_School;?></th>   
                    <th class="th-sm font-weight-bold"><?php echo t_curriculum0;?></th> 
                    <th class="th-sm font-weight-bold"><?php echo t_semester0;?></th>
                    <th class="th-sm font-weight-bold"><?php echo t_professor;?></th> 
                    <th class="th-sm font-weight-bold"><?php echo t_course;?></th> 
                </tr>
            </tfoot>
        </table>
    </div>
</div>