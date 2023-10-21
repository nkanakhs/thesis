<?php
class Course
{
    public $db = null;
    public $conn = null;
    /*
     *  $db A PDO database connection
     */
    function __construct($db,$conn)
    {
        try {
            $this->conn = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }

        try {
            $this->conn = $conn;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }




    public function AddVerb($Verb, $verb_classification)
    {
        $_SESSION['g_message'] = '';

        $Verb = trim($Verb);
               
        $q=$this->conn->query("call Verb_check ('".$Verb."', '".$verb_classification."')")->rowCount();
        if ($q > 0) {
            $_SESSION['g_message'] = "Sorry, this verb exists";

        } else {
            try{   
                $q=$this->conn->query("call addVerb ('".$Verb."', '".$verb_classification."')");
                $_SESSION['g_message'] = "Success ";
            }catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }
    
    public function AddAbetOutcome($CourseId,$OutcomeId,$Output){
        $_SESSION['g_message'] = '';

        $Output = trim($Output);
       
        $q=$this->conn->query("call Outcome_check ('".$OutcomeId."', '".$CourseId."')")->rowCount();

        // if ($q > 0) {
        //     $q=$this->conn->query("call deleteOutcome ('".$CourseId."', '".$OutcomeId."')");
        //     // $_SESSION['g_message'] = "Allready exists ";
        // }
        if ($q == 0){
            try{   
                $this->conn->query("call addAbetOutcomes ('".$OutcomeId."', '".$CourseId."', '".$Output."')");
            
        
                // echo $q2 . ' '.$q;
                // if($q1!=false){
                //  /   $_SESSION['g_message'] = 'Success ';
                    // return 1;
                // }else{
                    // $_SESSION['g_message'] = 'Εrror, please select translation language';
                    // return 0;
                // }
            
                // unset( $_SESSION['g_message'] );
            
                // $_SESSION['g_message'] = ' ';
            }catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }

    public function deleteAbetOutcomeSkillsByCourse($CourseId){

        $q=$this->conn->query("call deleteAbetOutcomeSkillsByCourse ('".$CourseId."')");
    }

    public function deleteCourseHasVerbs($CourseId){
        $q=$this->conn->query("call deleteCourseHasVerbs ('".$CourseId."')");
    }
    
    public function AddAbetOutcomeFromSkill($CourseId,$OutcomeId,$Outcome,$cr1,$cr2,$cr3,$cr4,$cr5,$cr6,$cr7){
        $_SESSION['g_message'] = '';
        try{   
            $q1=$this->conn->query("call addAbetOutcomeFromSkill ('".$OutcomeId."', '".$CourseId."', '".$Outcome."', '".$cr1."','".$cr2."','".$cr3."','".$cr4."','".$cr5."','".$cr6."','".$cr7."')");
        
            // echo $q2 . ' '.$q;
            if($q1!=false){
                $_SESSION['g_message'] = 'Success ';
            }else{
                $_SESSION['g_message'] = 'Εrror';
            }
           
            // unset( $_SESSION['g_message'] );
           
            // $_SESSION['g_message'] = ' ';
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }

    public function getActiveCoursesPercent(){
    	 $q=$this->conn->query("call perigrammata_db.getActiveCoursesPercent()");
         $activeCourses = array();
         while ($row = $q->fetch(PDO::FETCH_BOTH)) {
             $activeCourses = $row;
         }
         return $activeCourses;
    }
   
    public function getActiveCoursesList()
    {
        $q=$this->conn->query("call perigrammata_db.getActiveCoursesList()");

        $allActiveCourses = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $allActiveCourses[$row['Id']] = $row;
        }
        return $allActiveCourses;
    }

    public function getActiveCoursesListBySchool($SchoolName)
    {
        $q=$this->conn->query("call perigrammata_db.getActiveCoursesList()");

        $allActiveCourses = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            if($row['SchoolName'] == $SchoolName)
                $allActiveCourses[$row['Id']] = $row;
        }
        return $allActiveCourses;
    }

    public function getActiveCoursesListBySchoolAndEducationLevel($SchoolName,$undergrad)
    {
        //$q=$this->conn->query("call perigrammata_db.getActiveCoursesList()");
        $q = $this->conn->prepare("SELECT DISTINCT (courses.CourseTitle),courses.LessonCode,courses.Semester,courses.Id ,school.SchoolName,courses.EducationId,courses.locked

        FROM course_has_verbs,verbs,courses,school,abet_outcomes
        
        where verbs.Id = course_has_verbs.VerbId && course_has_verbs.CourseId=courses.Id && courses.SchoolId=school.Id  
        
        ORDER BY school.SchoolName ASC,courses.Semester"); 

        $allActiveCourses = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            if($row['SchoolName'] == $SchoolName) {
                if($undergrad == 1 && ($row['EducationId'] == 1 || $row['EducationId'] == 4))
                    $allActiveCourses[$row['Id']] = $row;
                if($undergrad == 0 && ($row['EducationId'] == 2 || $row['EducationId'] == 5))
                    $allActiveCourses[$row['Id']] = $row;
            }
        }
        return $allActiveCourses;
    }  

    public function getDocumentedCoursesPercent(){
        $q=$this->conn->query("call perigrammata_db.getDocumentedCoursesPercent()");
        $activeCourses = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $activeCourses = $row;
        }
        return $activeCourses;
    }

    public function submitedCourses(){
        $q=$this->conn->query("call perigrammata_db.submitedCourses()");
        $submitedCourses = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $submitedCourses[$row['CourseId']] = $row;
        }
        return $submitedCourses;
    }
    
    
    public function getDocumentedCoursesList()
    {
       $q=$this->conn->query("call perigrammata_db.getDocumentedCoursesList()");

       $allActiveCourses = array();
       while ($row = $q->fetch(PDO::FETCH_BOTH)) {
           $allActiveCourses[$row['Id']] = $row;
       }
       return $allActiveCourses;
    }

    public function getDocumentedCoursePer($CourseId)
    {
       $q=$this->conn->query("call perigrammata_db.getDocumentedCoursePercent('".$CourseId."')");
       $CoursePercent = array();
       while ($row = $q->fetch(PDO::FETCH_BOTH)) {
           $CoursePercent[$row['Id']] = $row;
       }
       return $CoursePercent;
    }
   
    public function getAllEnglishVerbs()
    {
        $q=$this->conn->query("call perigrammata_db.allEnglishVerbs()");
        
        $allEnglishVerbs = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $allEnglishVerbs[$row['Id']] = $row;
        }
        return $allEnglishVerbs;
    }


    public function insertCourseHasVerbs($CourseId,$VerbId,$Sentence,$OrderNumber){
        try{   
            $q=$this->conn->query("call perigrammata_db.insertCourseHasVerbs('".$CourseId."', '".$VerbId."','".$Sentence."','".$OrderNumber."')");                             
        
        }catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        } 
        $_SESSION['g_message'] = 'Success'; 
    }





    public function UpdateAbetOutcome($CourseId,$OutcomeId,$cr1,$cr2,$cr3,$cr4,$cr5,$cr6,$cr7)
    {
        if($cr1==0 && $cr2==0 && $cr3==0 && $cr4==0 && $cr5==0 && $cr6==0 && $cr7==0){
            $_SESSION['g_message'] = 'Error'; 
        }else{
            try{   
                $q=$this->conn->query("call perigrammata_db.UpdateAbetOutcomes('".$CourseId."', '".$OutcomeId."','".$cr1."','".$cr2."','".$cr3."','".$cr4."','".$cr5."','".$cr6."','".$cr7."')");
                            
            }catch (Exception $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
            } 
            $_SESSION['g_message'] = 'Success'; 
        }

    }
  
    public function UpdateLock($CourseId, $LockId){
        $_SESSION['g_message'] = '';
        try{   
            $this->conn->query("call UpdateLock ('".$LockId."', '".$CourseId."')");    
            $_SESSION['g_message'] = 'Success';                     
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        } 
       
       
    }
    public function checkSkill($CourseId){
        $q=$this->conn->query("call perigrammata_db.checkSkill('".$CourseId."')");
        
        $skill = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $skill[$i] = $row;
            $i++;
        }
        return $skill;
    }
    
    public function getallGreekVerbs()
    {
        $q=$this->conn->query("call perigrammata_db.allGreekVerbs()");
        
        $allGreekVerbs = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $allGreekVerbs[$row['Id']] = $row;
        }
        return $allGreekVerbs;
    }

    public function deleteVerb($VerbId_selected)
    {
        $q=$this->conn->query("call perigrammata_db.deleteVerb('".$VerbId_selected."')");
    }

    public function updateVerb($newVerb, $newVerbId, $verb_classification)
    {
        $q=$this->conn->query("call perigrammata_db.updateVerb('".$newVerbId."', '".$newVerb."', '".$verb_classification."')");
    }

    public function getVerb($VerbId)
    {
        $q=$this->conn->query("call perigrammata_db.getVerb('".$VerbId."')");
        
        $Verb = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $Verb = $row;
        }
        return $Verb;
    }
    
    public function getVerbClassification()
    {
        $q=$this->conn->query("call perigrammata_db.verb_classification()");
        
        $VerbClassification = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $VerbClassification[$row['Id']] = $row;
        }
        return $VerbClassification;
    }

    public function UserRequests()
    {
        $q=$this->conn->query("call perigrammata_db.userRequests()");
        
        $alluser = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $alluser[$row['Id']] = $row;
        }
        return $alluser;
        
    }

    

    public function deleteCourse($CourseId_selected)
    {
        $q=$this->conn->query("call perigrammata_db.deleteCourse('".$CourseId_selected."')");
    }

    public function deleteUser($UserId_selected)
    {
        $q=$this->conn->query("call perigrammata_db.deleteUser('".$UserId_selected."')");
    }


    public function getTeachingLanguage()
    {
        $q=$this->conn->query("call perigrammata_db.languageOfTeaching()");
        
        $teaching_lang = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $teaching_lang[$row['Id']] = $row;
        }
        return $teaching_lang;
    }

    public function getSchool($langId_selected)
    {
        $q=$this->conn->query("call perigrammata_db.school('".$langId_selected."')");
        
        $school = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $school[$row['Id']] = $row;
        }
        return $school;
    }

    public function getSchoolById($schoolId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM school
        WHERE id = ?");
        $stmt->execute([$schoolId]); 
        $schools = $stmt->fetchAll(); // get the mysqli result
        return $schools;
    }

    public function getSecondSchool($courseId)
    {
        $stmt = $this->conn->prepare("SELECT SecondSchoolId FROM courses
        WHERE id = ?");
        $stmt->execute([$courseId]); 
        $second_school = $stmt->fetchAll(); // get the mysqli result
        return $second_school;
    }

    public function getCourseInstitutions($courseId)
    {
        $stmt = $this->conn->prepare("SELECT InstitutionId, SecondInstitutionId FROM courses
        WHERE id = ?");
        $stmt->execute([$courseId]); 
        $course_institutions = $stmt->fetchAll(); // get the mysqli result
        return $course_institutions;
    }

    public function getCourseSchools($courseId)
    {
        $stmt = $this->conn->prepare("SELECT SchoolId, SecondSchoolId FROM courses
        WHERE id = ?");
        $stmt->execute([$courseId]); 
        $course_schools = $stmt->fetchAll(); // get the mysqli result
        return $course_schools;
    }

    public function getCourseDepartments($courseId)
    {
        $stmt = $this->conn->prepare("SELECT DepartmentId, SecondDepartmentId FROM courses
        WHERE id = ?");    
        $stmt->execute([$courseId]); 
        $course_departments = $stmt->fetchAll(); // get the mysqli result
        return $course_departments;
    }

    public function getSemesterCourses($semesterId,$schoolId)
    {  
        $stmt = $this->conn->prepare("SELECT *, courses.Id as CourseId FROM courses
        WHERE SchoolId = ? AND Semester = ?");
        $stmt->execute([$semesterId,$schoolId]);      
        $SemesterCourses = $stmt->fetchAll(); // get the mysqli result
        return $SemesterCourses;
    }

    public function getDepartment($langId_selected)
    {   
        $q=$this->conn->query("call perigrammata_db.department('".$langId_selected."')");
        
        $department = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $department[$row['Id']] = $row;
        }   
        return $department;
        /*
        $stmt = $this->conn->prepare("SELECT DepartmentName 
        FROM department WHERE langId = ?");
        $stmt->execute([$langId_selected]);      
        $department = $stmt->fetchAll(); // get the mysqli result  
        return $department;*/
    }        

    public function getDepartment_($department_selected)
    {   
        $stmt=$this->conn->prepare("SELECT DepartmentName FROM department WHERE Id = ".$department_selected."");
        $stmt->execute([$department_selected]); 
        $department = $stmt->fetchAll(); // get the mysqli result
        /*
        $department = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $department = $row;
        } */
        return $department; 
        /*
        $stmt = $this->conn->prepare("SELECT DepartmentName 
        FROM department WHERE Id = ?");
        $stmt->execute([$department_selected]);      
        $department = $stmt->fetchAll(); // get the mysqli result
        return $department;*/
    }  

    public function getSkill_($skill_selected)
    {
        $q=$this->conn->query("call perigrammata_db.getSkill('".$skill_selected."')");
        
        $department = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $department = $row;
        }
        return $department;
    }

    public function getOptionalCourses(){
        $q=$this->conn->query("SELECT * FROM optional_courses");
        $courses = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $courses[$row['CourseId']] = $row;
        }
        return $courses;
    }
   
    public function addOptionalCourse($CourseId,$department_selected){

        $q=$this->conn->query("call check_optional_courses ('".$CourseId."', '".$department_selected."')")->rowCount();
        if ($q > 0) {
            $_SESSION['g_message'] = "Αυτό το μάθημα είναι ήδη επιλεγόμενο.";

        } else {
            try{   
                $q=$this->conn->query("call perigrammata_db.addOptionalCourse ('".$CourseId."', '".$department_selected."')");
                    $_SESSION['g_message'] = "Success ";
            
            }catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }

    }

    public function add_greek_to_english_verbs($enId,$elId)
    {
        $q=$this->conn->query("call check_greek_to_english_verbs ('".$enId."', '".$elId."')")->rowCount();
        if ($q > 0) {
            $_SESSION['g_message'] = "Sorry, the connection of these verbs has already been made.";

        } else {
            try{   
                $q=$this->conn->query("call perigrammata_db.add_greek_to_english_verbs ('".$enId."', '".$elId."')");
                    $_SESSION['g_message'] = "Success ";
            
            }catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }



    public function deleteOptionalCourse($CourseId,$department_selected){

        $q=$this->conn->query("call deleteOptionalCourse ('".$CourseId."', '".$department_selected."')");
        $_SESSION['g_message'] = "Success ";
        // if ($q > 0) {
        //     $_SESSION['g_message'] = "Sorry, this course is already optional.";

        // } else {
        //     try{   
        //         $q=$this->conn->query("call perigrammata_db.addOptionalCourse ('".$CourseId."', '".$department_selected."')");
        //             $_SESSION['g_message'] = "Success ";
            
        //     }catch (Exception $e) {
        //         echo 'Caught exception: ',  $e->getMessage(), "\n";
        //     }
        // }

    }


    public function getSkillsByCourse($department_selected,$skills){
        
        $q=$this->conn->query("call perigrammata_db.getSkillsByCourseAndDeptmt ('".$department_selected."', '".$skills."')");
        $department = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $department[$row['Id']] = $row;
        }
        return $department;

    }

    public function getSkillsByOptionalCourse($department_selected,$skills){
        
        $q=$this->conn->query("call perigrammata_db.getSkillsByOptionalCourseAndDeptmt ('".$department_selected."', '".$skills."')");
        $department = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $department[$row['Id']] = $row;
        }
        return $department;

    }

    public function getLevelOfEducation($langId_selected)
    {
        $q=$this->conn->query("call perigrammata_db.levelOfEducation('".$langId_selected."')");
        
        $LevelOfEducation = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $LevelOfEducation[$row['Id']] = $row;
        }
        return $LevelOfEducation;
    }

    public function getProfessor()
    {
        $q=$this->conn->query("call perigrammata_db.professor()");
        
        $Professor = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $Professor[$row['Id']] = $row;
        }
        return $Professor;
    }

    public function getCourseProfessors($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.CourseProfessors('".$CourseId."')");
        
        $CourseProfessors = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseProfessors[$row['ProfessorId']] = $row['LastName'].' '.$row['FirstName'];
        }
        return $CourseProfessors;
    }

    public function getCourseProfessors2($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.CourseProfessors('".$CourseId."')");
        
        $count = 0;
        $CourseProfessors2 = '';
        $CourseProfessors3 = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $count = $count + 1;
            $CourseProfessors3[$count] = $row['LastName'].' '.$row['FirstName']; 
            $CourseProfessors2 = $row['LastName'].' '.$row['FirstName'];
        }
        return $CourseProfessors3;
    }

    public function getUser($UserId)
    {
        $q=$this->conn->query("call perigrammata_db.getUser('".$UserId."')");
        
        $count = 0;
        $user = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $count = $count + 1;
            $user[$count] = $row['LastName'].' '.$row['FirstName']; 
        }
        return $user;
    }
    

    public function getCoursesbyDept($department)
    {
        $q=$this->conn->query("call perigrammata_db.getCoursesbyDept('".$department."')");
        
        $courses = array();
        $i=1;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $courses[$i] = $row;
            $i++;
        }
        return $courses;
    }

    public function getSchools()
    {
        $stmt = $this->conn->prepare("SELECT * FROM school");
        $stmt->execute(); 
        $school = $stmt->fetchAll(); // get the mysqli result
        return $school;
    }

    public function getInstitutions()
    {
        $stmt = $this->conn->prepare("SELECT * FROM institution");
        $stmt->execute(); 
        $institutions = $stmt->fetchAll(); // get the mysqli result
        return $institutions;
    }

    public function getInstitution($institutionId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM institution
        WHERE id = ?");
        $stmt->execute([$institutionId]); 
        $institutions = $stmt->fetchAll(); // get the mysqli result
        return $institutions;
    }

    public function getInstitutionSchools($institutionId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM school
        WHERE InstitutionId = ?");
        $stmt->execute([$institutionId]); 
        $schools = $stmt->fetchAll(); // get the mysqli result  
        return $schools;
    }

    public function getCourses()
    {
        /*
        $q=$this->conn->query("call perigrammata_db.courses()");
        
        $courses = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $courses[$row['Id']] = $row;
        }*/
        $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName 
        FROM perigrammata_db.courses 
        INNER JOIN school ON school.Id = courses.SchoolId
        ORDER BY CourseTitle ASC;");
        $stmt->execute(); 
        $courses = $stmt->fetchAll(); // get the mysqli result
        return $courses;
    }                                      

    public function getProfessorCourses($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.CourseProfessors('".$CourseId."')");
        
        $i = 0;
        $count = 0;
        $CourseProfessors = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $count = $count + 1;
            $CourseProfessors[$count] = $row['LastName'].' '.$row['FirstName']; 
        }
        return $CourseProfessors;
    }

    public function getAllProfessorCourses($profId)
    {
        /*
        $q=$this->conn->query("call perigrammata_db.getProfessorCourses('".$profId."')");
        
        $courses = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {   
            $courses[$row['Id']] = $row;
        }
        return $courses;*/
        $stmt = $this->conn->prepare("SELECT DISTINCT(course_has_professor.CourseId),course_has_professor.ProfessorId, 
        courses.CourseTitle, courses.LessonCode, school.SchoolName, courses.locked
        FROM course_has_professor 
        LEFT JOIN courses ON course_has_professor.CourseId = courses.Id
        LEFT JOIN school ON courses.SchoolId = school.Id
        WHERE ProfessorId = ? 
        ORDER BY SchoolName ASC");  
        $stmt->execute([$profId]); 
        $courses = $stmt->fetchAll(); // get the mysqli result
        return $courses;
    }

    public function getAbetScore()
    {
        $q=$this->conn->query("call perigrammata_db.getAbetScore()");
        
        $courses = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $courses[$i] = $row;
            $i++;
        }
        return $courses;
    }


    public function CreateSchool($institutionId, $SchoolTitle, $langId)
    {   

        $_SESSION['g_message'] = '';
        $SchoolTitle = trim($SchoolTitle);    

        try {    

            // prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO `school` (SchoolName, langId, InstitutionId) 
            VALUES (:SchoolName, :langId, :InstitutionId)");  
                  
            $stmt->bindParam(':SchoolName', $SchoolTitle);
            $stmt->bindParam(':langId', $langId);  
            $stmt->bindParam(':InstitutionId', $institutionId);      
         
            // insert a row   
            $stmt->execute();
            //$pdo->lastInsertId();
            $_SESSION['g_message'] = "Success ";
        } catch(PDOException $e) {
            echo "Error: " . $stmt . "<br>" . $this->conn->error;
        }

    }
  

    public function CreateInstitution($InstitutionTitle, $langId)    
    {   

        $_SESSION['g_message'] = '';
        $InstitutionTitle = trim($InstitutionTitle);      

        try {    

            // prepare sql and bind parameters   
            $stmt = $this->conn->prepare("INSERT INTO `institution` (InstitutionName, langId) 
            VALUES (:InstitutionName, :langId)");      
                  
            $stmt->bindParam(':InstitutionName', $InstitutionTitle);
            $stmt->bindParam(':langId', $langId);   
         
            // insert a row   
            $stmt->execute();
            //$pdo->lastInsertId();
        } catch(PDOException $e) {
            echo "Error: " . $stmt . "<br>" . $this->conn->error;
        }

    }
         
    
    public function CreateDepartment($DepartmentTitle, $langId, $InstitutionId, $SecondInstitutionId)    
    {                 

        $_SESSION['g_message'] = '';
        $DepartmentTitle = trim($DepartmentTitle);      

        try {    

            // prepare sql and bind parameters   
            $stmt = $this->conn->prepare("INSERT INTO `department` (DepartmentName, langId, InstitutionId, SecondInstitutionId) 
            VALUES (:DepartmentName, :langId, :InstitutionId, :SecondInstitutionId)");              
                  
            $stmt->bindParam(':DepartmentName', $DepartmentTitle);
            $stmt->bindParam(':langId', $langId);   
            $stmt->bindParam(':InstitutionId', $InstitutionId);  
            $stmt->bindParam(':SecondInstitutionId', $SecondInstitutionId);        
         
            // insert a row       
            $stmt->execute();  
            //$pdo->lastInsertId();
        } catch(PDOException $e) {
            echo "Error: " . $stmt . "<br>" . $this->conn->error;
        }

    }

  
    public function getRequiredCourses($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.RequiredCourses('".$CourseId."')");
        
        $RequiredCourses = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $RequiredCourses[$row['RequiredCourseId']] = $row['CourseTitle'].' '.$row['LessonCode'];
        }
        return $RequiredCourses;
    }

    public function getCourse($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.getCourse('".$CourseId."')");
        
        $Course = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $Course = $row;
        }
        return $Course;
    }

    public function CreateCourse($school, $department, $LevelOfEducation, $LessonCode, $Semester, $CourseTitle, 
                                 $Lectures, $Laboratories, $Tutorials, $LabTutorials ,$Total, $CreditUnits,
                                 $langId, $Erasmus, $Content, $ProfessorId, $PrerequisiteId, $InstitutionId, $SecondSchoolId, $SecondInstitutionId, 
                                 $SecondDepartmentId)
    {

        $_SESSION['g_message'] = '';     

        $LessonCode = trim($LessonCode);
        $CourseTitle = trim($CourseTitle);
              
        $q=$this->conn->query("call Course_check ('".$LessonCode."', '".$CourseTitle."', '".$school."')")->rowCount();
        if ($q > 0) {
            $_SESSION['g_message'] = "Sorry, this course exists.";

        } else {  
            /*
            try{   
                $q=$this->conn->query("call addCourse ('".$school."','".$department."','".$LevelOfEducation."',
                                                     '".$LessonCode."','".$Semester."', '".$CourseTitle."',
                                                     '".$Lectures."', '".$Laboratories."', '".$Tutorials."',
                                                     '".$LabTutorials."', '".$Total."', '".$CreditUnits."',
                                                     '".$langId."','".$Erasmus."','".$Content."', @lastId)");
            */

                try {    
                    // prepare sql and bind parameters
                    $stmt2 = $this->conn->prepare("INSERT INTO courses(SchoolId, DepartmentId, EducationId, LessonCode, Semester, CourseTitle, 
                    LectureHours, LaboratoryHours, TutorialHours, LabTutorialHours, TotalHours, CreditUnits, LangId, ErasmusFl, Content)
                    VALUES (:school, :department, :LevelOfEducation, :l_code, :Sem, :title, 
                    :Lectures, :Laboratories, :Tutorials, :LabTutorials, :Total, :Credit, :lang, :Erasmus, :CourseContent)");     
                    
                    $stmt2->bindParam(':school', $school);
                    $stmt2->bindParam(':department', $department); 
                    $stmt2->bindParam(':LevelOfEducation', $LevelOfEducation);  
                    $stmt2->bindParam(':l_code', $LessonCode);  
                    $stmt2->bindParam(':Sem', $Semester);  
                    $stmt2->bindParam(':title', $CourseTitle);  
                    $stmt2->bindParam(':Lectures', $Lectures);  
                    $stmt2->bindParam(':Laboratories', $Laboratories);  
                    $stmt2->bindParam(':Tutorials', $Tutorials);  
                    $stmt2->bindParam(':LabTutorials', $LabTutorials);  
                    $stmt2->bindParam(':Total', $Total);  
                    $stmt2->bindParam(':Credit', $CreditUnits);  
                    $stmt2->bindParam(':lang', $langId); 
                    $stmt2->bindParam(':Erasmus', $Erasmus); 
                    $stmt2->bindParam(':CourseContent', $Content); 
                
                    // insert a row   
                    $stmt2->execute();  
                    $lastId = $this->conn->lastInsertId();
                    //$pdo->lastInsertId();
                } catch(PDOException $e) {
                    $_SESSION['g_message'] = 'Something went wrong!! Please try again.';
                    //echo "Error: " . $stmt2 . "<br>" . $this->conn->error;
                }

                //$stmt1 = $this->conn->prepare("SELECT LAST_INSERT_ID()");
                //$lastId = $stmt1->fetchColumn();

                //$res = $this->conn->query("SELECT @lastId as lastId");  
                //$row = $res->fetch(PDO::FETCH_ASSOC);   
            
                //$lastId = $row["lastId"];   
                $sql = "UPDATE courses SET InstitutionId=? WHERE Id=?";
                $stmt = $this->conn->prepare($sql);    
                $stmt->execute([$InstitutionId,$lastId]);      
                
                if ($SecondSchoolId != 0) {  
                    $sql2 = "UPDATE courses SET SecondSchoolId=? WHERE Id=?";
                    $stmt2 = $this->conn->prepare($sql2);  
                    $stmt2->execute([$SecondSchoolId,$lastId]);
                }       
                
                if ($SecondInstitutionId != 0) {  
                    $sql3 = "UPDATE courses SET SecondInstitutionId=? WHERE Id=?";
                    $stmt3 = $this->conn->prepare($sql3);    
                    $stmt3->execute([$SecondInstitutionId,$lastId]);
                }   

                if ($SecondDepartmentId != 0) {  
                    $sql4 = "UPDATE courses SET SecondDepartmentId=? WHERE Id=?";
                    $stmt4 = $this->conn->prepare($sql4);    
                    $stmt4->execute([$SecondDepartmentId,$lastId]);
                }  

                foreach ($ProfessorId as $Id ) {
                    $q=$this->conn->query("call addProfessor ('".$lastId."', '".$Id."')");
                }
                foreach ($PrerequisiteId as $Id ) {
                    $q=$this->conn->query("call addPrerequisites ('".$lastId."', '".$Id."')");
                }

                $_SESSION['g_message'] = "New Course added successfully.";
                
            /*                                                    
            }catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }*/
        }
    }


    public function UpdateCourse($school, $department, $department2, $LevelOfEducation, $LessonCode, $Semester, $CourseTitle, 
                                 $Professor, $Lectures, $Laboratories, $Tutorials, $LabTutorials, $Total, $CreditUnits,
                                 $Erasmus, $Content, $ProfessorId, $PrerequisiteId, $CourseId)
    {

        $_SESSION['g_message'] = '';     

        $LessonCode = trim($LessonCode);       
        $CourseTitle = trim($CourseTitle);     
              
        $q=$this->conn->query("call getCourse ('".$CourseId."')")->rowCount();
        if ($q > 0) {                 
            try{   
                /*    
                $q=$this->conn->query("call UpdateCourse ('".$school."','".$department."','".$LevelOfEducation."',
                                                        '".$LessonCode."','".$Semester."', '".$CourseTitle."',
                                                        '".$Lectures."', '".$Laboratories."', '".$Tutorials."',
                                                        '".$LabTutorials."', '".$Total."', '".$CreditUnits."','".$Erasmus."',
                                                        '".$Content."', '".$CourseId."')");   */   

                try {    
                    // prepare sql and bind parameters
                    $sql = "UPDATE courses
                    SET SchoolId = ?, DepartmentId = ?, SecondDepartmentId = ?,
                    EducationId = ?, LessonCode = ?, 
                    Semester = ?, CourseTitle = ?,
                    LectureHours = ?, LaboratoryHours = ?, 
                    TutorialHours = ?, LabTutorialHours = ?,
                    TotalHours = ?, CreditUnits = ?,   
                    ErasmusFl = ?, Content = ?
                    WHERE Id = ?";
                    $stmt= $this->conn->prepare($sql);
                    $stmt->execute([$school,$department,$department2,$LevelOfEducation,$LessonCode,$Semester,
                    $CourseTitle,$Lectures,$Laboratories,$Tutorials,$LabTutorials,
                    $Total,$CreditUnits,$Erasmus,$Content,$CourseId]);
                
                    // insert a row   
                    $stmt->execute();    
                    //$lastId = $this->conn->lastInsertId();
                    //$pdo->lastInsertId();
                } catch(PDOException $e) {
                    $_SESSION['g_message'] = 'Something went wrong!! Please try again.';
                    //echo "Error: " . $stmt2 . "<br>" . $this->conn->error;
                }

                $q=$this->conn->query("call deleteProfessor ('".$CourseId."')");
                $q=$this->conn->query("call deletePrerequisites ('".$CourseId."')");             
                            
                foreach ($ProfessorId as $Id ) {
                    $q=$this->conn->query("call addProfessor ('".$CourseId."', '".$Id."')");
                }
                if($PrerequisiteId != ''){
                    foreach ($PrerequisiteId as $Id ) {
                        $q=$this->conn->query("call addPrerequisites ('".$CourseId."', '".$Id."')");
                    }
                }
                                                     
            }catch (Exception $e) {
                 //   echo 'Caught exception: ',  $e->getMessage(), "\n";
            } 
            $_SESSION['g_message'] = "The Course updated successfully.";

        }else {
            $_SESSION['g_message'] = "Sorry, this course does not exist.";    

        }
    }


    public function getCourseType($LangId)
    {
        $q=$this->conn->query("call perigrammata_db.CourseType('".$LangId."')");
        
        $CourseType = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseType[$row['Id']] = $row;
        }
        return $CourseType;
    }

    public function getVerbs($LangId)
    {
        $q=$this->conn->query("call perigrammata_db.getVerbs('".$LangId."')");
        
        $verbs = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $verbs[$row['Id']] = $row;
        }
        return $verbs;
    }
    
    public function getSkills($LangId)
    {
        $q=$this->conn->query("call perigrammata_db.getSkills('".$LangId."')");
        
        $skills = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $skills[$row['Id']] = $row;
        }
        return $skills;
    }

    public function getLectureMethod($LangId)
    {
        $q=$this->conn->query("call perigrammata_db.getLectureMethod('".$LangId."')");
        
        $method = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $method[$row['Id']] = $row;
        }
        return $method;
    }
    
    public function getUseOfTechnologies($LangId)
    {
        $q=$this->conn->query("call perigrammata_db.getUseOfTechnologies('".$LangId."')");
        
        $UseOfTechnologies = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $UseOfTechnologies[$row['Id']] = $row;
        }
        return $UseOfTechnologies;
    }

    public function getActivities($LangId)
    {
        $q=$this->conn->query("call perigrammata_db.Activities('".$LangId."')");
        
        $activities = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $activities[$row['Id']] = $row;
        }
        return $activities;
    }

    public function getCourseVerbs($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.getCourseVerbs('".$CourseId."')");
        
        $CourseVerbs = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseVerbs[$row['VerbId']] = $row['Sentence'];
        }
        return $CourseVerbs;
    }


    public function getCourseAbetOutcomes($CourseId){
        $q=$this->conn->query("call perigrammata_db.getCourseOutcomes('".$CourseId."')");
	    $CourseOutcomes = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseOutcomes[$i]=$row;
            $i++;
        }
        return $CourseOutcomes;

    }

    public function getCourseAbetOutcomesWithoutSkills($CourseId){
        $q=$this->conn->query("call perigrammata_db.getCourseOutcomes('".$CourseId."')");
	    $CourseOutcomes = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
           
            if(strpos($row['Outcome'], '_') === false){
                $CourseOutcomes[$i]=$row;
                $i++;
            }
        }
        return $CourseOutcomes;

    }
    

    public function getAbetScoreBySchool($SchoolId){
        $q=$this->conn->query("call perigrammata_db.getAbetScoreBySchool('".$SchoolId."')");
	    $ScoreBySchool = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $ScoreBySchool[$i]=$row;
            $i++;
        }
        return $ScoreBySchool;

    }

    public function getAbetScoreBySchool1($SchoolId){
        $q=$this->conn->query("call perigrammata_db.getAbetScoreBySchool1('".$SchoolId."')");
	    $ScoreBySchool = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $ScoreBySchool[$i]=$row;
            $i++;
        }
        return $ScoreBySchool;

    }

    public function getAbetScoreByCourse($CourseId){
        $q=$this->conn->query("call perigrammata_db.getAbetScoreByCourse('".$CourseId."')");
	    $ScoreByCourse = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $ScoreByCourse[$i]=$row;
            $i++;
        }
        return $ScoreByCourse;

    }

    
    public function getAbetScoreByCourse1($CourseId){
        $q=$this->conn->query("call perigrammata_db.getAbetScoreByCourse1('".$CourseId."')");
	    $ScoreByCourse = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $ScoreByCourse[$i]=$row;
            $i++;
        }
        return $ScoreByCourse;

    }

    public function getCourseOutcomes($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.getCourseVerbs('".$CourseId."')");

        $CourseSentence = array();
	    $CourseVerb = array();
	    $CourseOutcome = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseOutcome[$row['VerbId']]=$row;
            // $CourseSentence[$row['VerbId']] = $row['Sentence'];
	        // $CourseVerb[$row['VerbId']] = $row['Verbs'];
            // $CourseOutcome[$row['VerbId']] = $CourseVerb[$row['VerbId']] . " " . $CourseSentence[$row['VerbId']];

        }
        return $CourseOutcome;
    }
    
    public function getCourseOutcomes1($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.getCourseVerbs('".$CourseId."')");

        $CourseSentence = array();
	    $CourseVerb = array();
	    $CourseOutcome = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseOutcome=$row;
            // $CourseSentence[$row['VerbId']] = $row['Sentence'];
	        // $CourseVerb[$row['VerbId']] = $row['Verbs'];
            // $CourseOutcome[$row['VerbId']] = $CourseVerb[$row['VerbId']] . " " . $CourseSentence[$row['VerbId']];

        }
        return $CourseOutcome;
    }
    

    public function getCourseSentence($CourseId){
        $q=$this->conn->query("call perigrammata_db.getCourseVerbs('".$CourseId."')");

        $CourseSentence = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseSentence[$row['VerbId']] = $row['Sentence'];
        }
        return $CourseSentence;
    }

    public function getEnglishVerb($CourseId){
        $q=$this->conn->query("call perigrammata_db.getEnglishVerb('".$CourseId."')");

        $CourseVerb = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseVerb[$row['Id']]= $row;
        } 
        return $CourseVerb;

    }    
   
    public function getAlloutcomes(){   
        $q=$this->conn->query("call perigrammata_db.getEnoutcomes()");

        $Alloutcomes = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $Alloutcomes[$i] = $row;
            $i++;
        }
        return $Alloutcomes;
    }

    public function getEnOutcomes2(){
        $q=$this->conn->query("call perigrammata_db.getEnOutcomes2()");

        $Enoutcomes = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $Enoutcomes[$i] = $row;
            $i++;
        }
        return $Enoutcomes;
    }

    public function getSkillHasAbet($SkillId){
        $q=$this->conn->query("call perigrammata_db.getSkillHasAbetByCourse('".$SkillId."')");
        
        $AbetBySkills = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $AbetBySkills[$row['SkillId']] = $row;
        }
        return $AbetBySkills;
    }

    public function getCourseSkills($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.getCourseSkills('".$CourseId."')");
        
        $CourseSkills = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseSkills[$row['SkillsId']] = $row['Description'];
        }
        return $CourseSkills;
    }

    public function getCourseSkills1($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.getCourseSkills('".$CourseId."')");
        
        $CourseSkills1 = array();
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseSkills1[$i]= $row;
            $i++;
        }
        return $CourseSkills1;
    }

    public function getCourseMethod($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.getCourseMethod('".$CourseId."')");
        
        $CourseMethod = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseMethod[$row['UseOfTechnologiesId']] = $row;
        }
        return $CourseMethod;
    }

    public function getActivitySkill($ActivityId)
    {
        $q=$this->conn->query("call perigrammata_db.getActivitySkill('".$ActivityId."')");
        
        $ActivitySkills = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $ActivitySkills[] = array( 'SkillId' => $row['SkillId'], 'Description' => $row['Description'] );
        }
        return $ActivitySkills;
    }
    
    public function getCourseActivities($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.getCourseActivities('".$CourseId."')");
        
        $CourseActivities = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            //$CourseActivities[$row['ActivityId']] = $row['Hours'];
            $CourseActivities[$row['ActivityId']] = $row;
        }
        return $CourseActivities;
    }

    public function getCategoriesAssessment($LangId)
    {
        $q=$this->conn->query("call perigrammata_db.getCategoriesAssessment('".$LangId."')");
        
        $Assessment = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            
            if( !isset($Assessment[$row['Id']]) )
            {
                $Assessment[$row['Id']] = array( 'CategoryName' => $row['CategoryName'], 'subcategories' => array() );
            }
            
            if( $row['SubId'] != NULL )
            {
                $Assessment[$row['Id']]['subcategories'][$row['SubId']] = $row['SubcategoryName'];
            }
        }
        
        return $Assessment;
    }

    public function getCourseAssessment($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.getCourseAssessment('".$CourseId."')");
        
        $CourseAssessment = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseAssessment[$row['CategoryId']] = $row;
        }
        return $CourseAssessment;
    }

    public function getCourseAssessmentNew($CourseId)
    {
        $q=$this->conn->query("call perigrammata_db.getCourseAssessment('".$CourseId."')");
        
        $CourseAssessment = array();
        $i= 0;
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $CourseAssessment[$row['method_number']][$row['CategoryId']] = $row;
            $i++;
        }
        return $CourseAssessment;
    }

    public function getBonus($LangId)
    {
        $q=$this->conn->query("call perigrammata_db.getBonus('".$LangId."')");
        
        $Bonus = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            $Bonus[$row['Id']] = $row;
        }
        return $Bonus;
    }


    public function updateLearningOutcomes($CourseId, $percentage, $bonus, $subcategories_1, 
                                 $subcategories_2, $subcategories_3, $subcategories_4)   
    { 

        $_SESSION['g_message'] = '';

           
        try{   
            //var_dump($percentage);
            $q=$this->conn->query("call deleteAssessment ('".$CourseId."')");

            foreach( $percentage as $catid => $percent )
            {
                
                $k=1;
                for($k=1; $k<=8; $k++){
                    if( $percent[$k] != "" && $percent[$k]!= 0)
                    {
                        $bonus[$catid][$k] = isset( $bonus[$catid][$k] ) && $bonus[$catid][$k] != '' ? $bonus[$catid][$k] : NULL;
                        $subcategories_1[$catid][$k] = isset( $subcategories_1[$catid][$k] ) ? $subcategories_1[$catid][$k]: '0';
                        $subcategories_2[$catid][$k] = isset( $subcategories_2[$catid][$k] ) ? $subcategories_2[$catid][$k]: '0';
                        $subcategories_3[$catid][$k] = isset( $subcategories_3[$catid][$k] ) ? $subcategories_3[$catid][$k]: '0';
                        $subcategories_4[$catid][$k] = isset( $subcategories_4[$catid][$k] ) ? $subcategories_4[$catid][$k]: '0';
                        
                        
                        $stmt=$this->conn->prepare("INSERT INTO course_has_category 
                                VALUES (?, ? ,?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->execute([$CourseId,$catid,$k,$bonus[$catid][$k],$percent[$k],$subcategories_1[$catid][$k],$subcategories_2[$catid][$k],$subcategories_3[$catid][$k],$subcategories_4[$catid][$k],null]);
                    }
                }
            }
            
            $_SESSION['g_message'] = 'Success';  

        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }  
        
        
    }
    
}

    

