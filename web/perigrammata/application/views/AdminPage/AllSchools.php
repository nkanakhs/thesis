

<div class="p-5">
<div class="table-responsive">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" >
            <thead class="myblue1 text-white"> 
                <tr>
                    <th class="font-weight-bold th-sm">#</th>
                    <th class="th-sm font-weight-bold"><?php echo t_School;?></th>   
                    <th class="th-sm font-weight-bold"><?php echo t_Institution;?></th> 
                    <!--<th class="th-sm font-weight-bold"><?php //echo t_professor;?></th> -->
                    <th class="th-sm font-weight-bold"><?php echo t_delete;?></th>
                    <th class="th-sm font-weight-bold"><?php echo t_edit;?></th>
                    <th class="th-sm font-weight-bold"><?php echo t_coursespersemester;?></th>
                </tr>  
            </thead>               
                <?php $i = 1;

                    foreach($schools as $Id => $row) {

                        $SchoolId = $row['Id'];
                        $InstitutionId = $row['InstitutionId'];
                        $SchoolName = $row['SchoolName'];

                        $stmt2 = $conn->prepare("SELECT *
                        FROM perigrammata_db.institution
                        WHERE Id = ?");
                        $stmt2->execute([$InstitutionId]); 
                        $institution = $stmt2->fetchAll(); // get the mysqli result

                        foreach($institution as $Id => $row2) {
                            $InstitutionName = $row2['InstitutionName'];
                            $InstitutionId = $row2['Id']; 
                        }
                    
                        ?>
                        <tr class="p-0">  
                            <td><?php echo $i;?>
                            <td><?php echo "<option value='" . $SchoolId . "'>" . $SchoolName . "</option>" ?> </td> 
                            <td><?php echo "<option value='" . $InstitutionId . "'>" . $InstitutionName . "</option>" ?> </td>
                            <!--
                            <td>
                            <?php  /*
                            foreach ($CourseProfessorName as $ProfessorName) {
                                echo "<a href='#'><option value='" . $row['Id'] . "'>"; 
                                echo $ProfessorName;
                                echo "</option></a>";  
                            }  */
                            ?> 
                            </td>-->                        

                            <td>
                                <a class="btn btn-outline-danger btn-rounded btn-sm my-0 rounded-pill font-weight-bold" href="<?php echo URL . 'AdminController/deleteSchool?SchoolId=' . $SchoolId ?>">
                                <i class="far fa-trash-alt mt-0"></i>
                                    <?php echo t_delete;?>   
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-outline-info btn-rounded btn-sm my-0 rounded-pill font-weight-bold" href="<?php echo URL . 'AdminController/editSchool?SchoolId=' . $SchoolId ?>">
                                <i class="fas fa-pencil-alt mt-0"></i>
                                    <?php echo t_edit;?>
                                </a>
                            </td>
                            <td style="color:#17e64e!important;">
                                <a style="color:#17e64e!important; background-color:transparent!important; border:2px solid #17e64e!important" class="btn btn-rounded btn-sm my-0 rounded-pill font-weight-bold" href="<?php echo URL . 'AdminController/CoursesPerSemester?SemesterId=1&SchoolId=' . $SchoolId ?>">
                                <i style="color:#17e64e!important;" class="fas fa-eye mt-0 fa-green-color"></i>
                                    <?php echo t_view;?>
                                </a>
                            </td>
                        </tr>
                <?php $i++;
                    }
                ?>
            </tbody>
            
        </table>
    </div>
</div>