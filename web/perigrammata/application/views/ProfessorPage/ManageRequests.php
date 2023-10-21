
<div class="py-5">
        <div class="card card-cascade narrower container px-0 ">
                    <div class="view view-cascade gradient-card-header myblue1 z-depth-2 text-center  narrower py-3 px-1  rounded ">
                        <h3 class="mycourses text-white font-italic "><?php echo $title[0]["CourseTitle"] . "\t" . $title[0]["LessonCode"]?> </h3>
                    </div>
        </div>

<div class="p-5">
<div class="table-responsive py-5 ">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" >
            <thead class="myblue1 text-white"> 
                <tr>  
                    <th class="font-weight-bold th-sm">#</th>   
                    <th class="th-sm font-weight-bold text-center"><?php echo "Όνομα φοιτητή"?></th>
                    <th class="th-sm font-weight-bold text-center"><?php echo "Επίθετο φοιτητή"?></th>
                    <th class="th-sm font-weight-bold text-center"><?php echo "Ημερομηνία Αίτησης"?></th>
                    <th class="th-sm font-weight-bold text-center"><?php echo "Έγκριση / Απόρριψη"?></th>
                </tr>  
            </thead>  
            <tbody>  
                <?php 
                foreach ($students as $Id => $student) { 
                    ?>   
                <tr class="p-0">
                    <td> <?php echo $Id; ?></td>
                    <td class="text-center"><?php echo $student['firstname'] ?> </td>
                    <td class="text-center"><?php echo $student['lastname'] ?></td>
                    <td class="text-center"><?php echo $student['YearOfEnrollement'] ?></td>
                <td class="text-center">
                            <a class="btn btn-outline-danger btn-rounded btn-sm my-0 rounded-pill font-weight-bold " href="<?php echo URL . 'ProfessorController/DeclineRequest?CourseId=' . $courseID.'&StudentId=' .$student['StudentId']; ?>">
                            <i class="far fa-trash-alt mt-0"></i>
                                <?php echo 'Απόρριψη';?>
                            </a>
                            <a class="btn btn-outline-info btn-rounded btn-sm my-0 rounded-pill font-weight-bold" href="<?php echo URL . 'ProfessorController/AcceptRequest?CourseId=' . $courseID.'&StudentId=' .$student['StudentId'];  ?>">
                            <i class="fas fa-pencil-alt mt-0"></i>
                                <?php echo 'Αποδοχή';?>
                            </a>
                        </td>
                </tr>
                <?php
                }
                ?>
            </tbody>  
        </table>
</div>
</div>