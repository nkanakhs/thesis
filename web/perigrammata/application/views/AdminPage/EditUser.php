<!-- add admin form -->

<div class="container px-5 py-4">   
    <form style="padding-bottom:20px;" class="text-center border border-light " method="post" action="<?php echo URL; ?>AdminController/updateUser">
        <h5 class="card-header myblue1 white-text text-center py-4">
            <strong><?php echo t_update_admin; ?></strong>
        </h5>

        <br>

        <?php if ($profileId == 2) { ?>
        Ο χρήστης <b><?php echo $firstName . ' ' . $lastName; ?></b> είναι καθηγητής/τρια. 
        <?php } else if($profileId == 1) { 
            $managed_department_type = "";
            if ($adminUser) { 
                foreach($adminUser as $row){  
                    $adminId = $row['AdminId'];  
                    $ManagedDepartmentId = $row['ManagedDepartmentId'];  
                    if($adminId==1) {
                        foreach ($institutions as $Id => $institution_row) { 
                            if($ManagedDepartmentId==$institution_row["Id"]) {
                                $managed_department_name = $institution_row['InstitutionName']; 
                                $managed_department_type = "στο ίδρυμα";
                            }  
                        } 
                    } else if($adminId==2) {
                        foreach ($schools as $Id => $school_row) { 
                            if($ManagedDepartmentId==$school_row["Id"]) {
                                $managed_department_name = $school_row['SchoolName']; 
                                $managed_department_type = "στη σχολή";
                            }  
                        }
                    } else if($adminId==3) {  
                        foreach ($departments as $Id => $department_row) { 
                            if($ManagedDepartmentId==$department_row["Id"]) {
                                $managed_department_name = $department_row['DepartmentName']; 
                                $managed_department_type = "στο πρόγραμμα σπουδών"; 
                            }    
                        }
                    }
                }
            }
            
            if($adminId==4) {
        ?> 

        Ο χρήστης <b><?php echo $firstName . ' ' . $lastName; ?></b> είναι super διαχειριστής/τρια (super administrator).
        <?php
        } else {?>
        Ο χρήστης <b><?php echo $firstName . ' ' . $lastName; ?></b> είναι διαχειριστής/τρια <?php echo $managed_department_type; ?> "<?php echo $managed_department_name; ?>". 
        <?php }
        
        } else if($profileId == 3) { 
            $managed_department_name = ""; 
            $managed_department_type = "";
            if ($adminUser) { 
                foreach($adminUser as $row){  
                    $adminId = $row['AdminId'];  
                    $ManagedDepartmentId = $row['ManagedDepartmentId'];  
                    if($adminId==1) {
                        foreach ($institutions as $Id => $institution_row) { 
                            if($ManagedDepartmentId==$institution_row["Id"]) {
                                $managed_department_name = $institution_row['InstitutionName']; 
                                $managed_department_type = "στο ίδρυμα";
                            }  
                        } 
                    } else if($adminId==2) {
                        foreach ($schools as $Id => $school_row) { 
                            if($ManagedDepartmentId==$school_row["Id"]) {
                                $managed_department_name = $school_row['SchoolName']; 
                                $managed_department_type = "στη σχολή";
                            }  
                        }
                    } else if($adminId==3) {  
                        foreach ($departments as $Id => $department_row) { 
                            if($ManagedDepartmentId==$department_row["Id"]) {
                                $managed_department_name = $department_row['DepartmentName']; 
                                $managed_department_type = "στο πρόγραμμα σπουδών"; 
                            }    
                        }
                    }  
                }
            }

            if ($managed_department_name) {
        ?> 
        Ο χρήστης <b><?php echo $firstName . ' ' . $lastName; ?></b> είναι καθηγητής/τρια - διαχειριστής/τρια <?php echo $managed_department_type; ?> "<?php echo $managed_department_name; ?>".
        <?php } else { ?>
        Ο χρήστης <b><?php echo $firstName . ' ' . $lastName; ?></b> είναι καθηγητής/τρια - διαχειριστής/τρια.
        <?php }

        } else if($profileId == 4) { ?>
        Ο χρήστης <b><?php echo $firstName . ' ' . $lastName; ?></b> είναι φοιτητής/τρια. 
        <?php }  ?> 

        <input class="form-control mb-4 w-100 border" type="text" name="FirstName" placeholder="Όνομα" value="<?php echo $firstName; ?>" required />
        <input class="form-control mb-4 w-100 border" type="text" name="LastName" placeholder="Επίθετο" value="<?php echo $lastName; ?>" required />  
        <input class="form-control mb-4 w-100 border" type="text" name="UserName" placeholder="Όνομα Χρήστη" value="<?php echo $userName; ?>" required />

        <input style="display:none;" class="form-control mb-4 w-100 border" type="text" name="UserId" value="<?php echo $UserId; ?>" required />

        <select id="roleSelection" class="browser-default custom-select mb-4" name = "ProfileId" onchange="roleSelected()">
            <option value = "" disabled> <?php echo t_select_profile; ?></option>
            <option value = "1" <?php if($profileId==1) { echo "selected"; } ?>> <?php echo t_admin_1; ?></option>
            <option value = "2" <?php if($profileId==2) { echo "selected"; } ?>> <?php echo t_professor_1; ?></option>
            <option value = "3" <?php if($profileId==3) { echo "selected"; } ?>> <?php echo t_professor_admin; ?></option>
        </select>       
        
        <select <?php if ($profileId == 2) { ?> style="display:none;" <?php } ?> id="adminRoleSelection" class="browser-default custom-select mb-4" name = "AdminProfileId" onchange="adminSelected()">
            <option value = "" disabled> <?php echo t_select_profile; ?></option>
            <option value = "1" <?php if($adminId && $adminId==1) { echo "selected"; } ?>> <?php echo t_admin_institution; ?></option>
            <option value = "2" <?php if($adminId &&  $adminId==2) { echo "selected"; } ?>> <?php echo t_admin_school; ?></option>
            <option value = "3" <?php if($adminId &&  $adminId==3) { echo "selected"; } ?>> <?php echo t_admin_syllabus; ?></option>
            <option value = "4" <?php if(($adminId &&  $adminId==4) || empty($adminId) || $adminId=="") { echo "selected"; } ?>> <?php echo t_super_admin; ?></option>
        </select> 

        
        
        <!--- admin type options --->  
        <select <?php if(($adminId && $adminId!=1) || $profileId == 2) { ?> style="display:none;" <?php } ?> id="ChooseInstitution" class="browser-default custom-select mb-4" name = "Institution">
            <option value = "" disabled> <?php echo t_select_institution; ?></option>
            <?php
            foreach ($institutions as $Id => $row ) {
                $selected= '';
                echo "<option value='" . $row['Id'] . "' " . $selected . ">" . $row['InstitutionName'] . "</option>";
            } ?>   
        </select>

        <select style="display:none;" id="ChooseSchool" class="browser-default custom-select mb-4" name = "School">
            <option value = "" disabled> <?php echo t_select_school; ?></option>
            <?php
            foreach ($schools as $Id => $row ) {
                $selected= '';
                echo "<option value='" . $row['Id'] . "' " . $selected . ">" . $row['SchoolName'] . "</option>";
            } ?>
        </select>  

        <select style="display:none;" id="ChooseSyllabus" class="browser-default custom-select mb-4" name = "Department">
            <option value = "" disabled> <?php echo t_select_syllabus; ?></option>
            <?php
            foreach ($departments as $Id => $row ) {
                $selected= '';
                echo "<option value='" . $row['Id'] . "' " . $selected . ">" . $row['DepartmentName'] . "</option>";
            } ?>
        </select>  

        <script>
        function roleSelected() {    
            var roleSelected = document.getElementById("roleSelection").value;
            if(roleSelected == "1" || roleSelected == "3") {
                document.getElementById("adminRoleSelection").style.display = "block";
            }  
            else {   
                document.getElementById("adminRoleSelection").style.display = "none";
                document.getElementById("ChooseSchool").style.display = "none";
                document.getElementById("ChooseInstitution").style.display = "none";
                document.getElementById("ChooseSyllabus").style.display = "none";  
            }
            //document.getElementById("demo").innerHTML = "You selected: " + x;
        }

        function adminSelected() {  
            var roleSelected = document.getElementById("adminRoleSelection").value;
            if(roleSelected == "1") {
                document.getElementById("ChooseInstitution").style.display = "block";
                document.getElementById("ChooseSchool").style.display = "none";
                document.getElementById("ChooseSyllabus").style.display = "none";
            } else if(roleSelected == "2") {
                document.getElementById("ChooseSchool").style.display = "block";
                document.getElementById("ChooseInstitution").style.display = "none";
                document.getElementById("ChooseSyllabus").style.display = "none";
            } else if(roleSelected == "3") {
                document.getElementById("ChooseSyllabus").style.display = "block";
                document.getElementById("ChooseInstitution").style.display = "none";
                document.getElementById("ChooseSchool").style.display = "none";
            } 
            else {
                document.getElementById("ChooseInstitution").style.display = "none";
                document.getElementById("ChooseSchool").style.display = "none";
                document.getElementById("ChooseSyllabus").style.display = "none";
            }
            //document.getElementById("demo").innerHTML = "You selected: " + x;
        }  
        </script>  
    
        <button style="margin-bottom:10px;" class="btn m-0" type="submit" name="UpdateUser" value="UpdateUser"> <?php echo t_update; ?> </button> 
              
    </form>
</div>