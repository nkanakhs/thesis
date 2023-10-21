<?php

class AdminController extends Controller{

    public function AddAdmin()   
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $stmt = $this->conn->prepare("SELECT *  
        FROM perigrammata_db.institution");
        $stmt->execute(); 
        $institutions = $stmt->fetchAll(); // get the mysqli result

        $stmt = $this->conn->prepare("SELECT *
        FROM perigrammata_db.school");
        $stmt->execute(); 
        $schools = $stmt->fetchAll(); // get the mysqli result

        $stmt = $this->conn->prepare("SELECT *
        FROM perigrammata_db.department");
        $stmt->execute(); 
        $departments = $stmt->fetchAll(); // get the mysqli result
  
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/AddAdmin.php';
        require APP . 'views/templates/footer.php';
    }  

    public function MakeVerbMatching()  
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $_SESSION['g_message'] = '';
        if (isset($_POST["MakeMatching"]) && $_POST["MakeMatching"] == "MakeMatching") {
            
            if (!empty($_POST['verb_el']) 
            && !empty($_POST['verb_en'])){
            
  
                // echo 'en: '.$_POST['verb_en'] .'<br>';
                // echo 'el: '.$_POST['verb_el'] .'<br>';
                $this->CourseModel->add_greek_to_english_verbs($_POST["verb_en"], $_POST["verb_el"]);
            
            }else{
                $_SESSION['g_message'] = "Both Fields are required";
            }
        }
        $VerbClassification = $this->CourseModel->getVerbClassification();
        $allEnglishVerbs = $this->CourseModel->getallEnglishVerbs();
        $allGreekVerbs = $this->CourseModel->getallGreekVerbs();
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/AddVerb.php';
        require APP . 'views/templates/footer.php';

    }



    public function AddVerb()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $_SESSION['g_message'] = '';

        if( isset($_GET['flag']) && $_GET['flag']==1){
            $_SESSION['g_message'] = "Successfully deleted";
        }
        if( isset($_GET['flag']) && $_GET['flag']==2){
            $_SESSION['g_message'] = "Successfully updated";
        }

        $VerbClassification = $this->CourseModel->getVerbClassification();
      
        if (isset($_POST["AddVerb"]) && $_POST["AddVerb"] == "AddVerb") {
            //preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['Verb'])
            if (!empty($_POST['Verb']) 
                && !empty($_POST['verb_classification'])){
                
                $this->CourseModel->AddVerb($_POST["Verb"], $_POST["verb_classification"]);
                
            }else{
                $_SESSION['g_message'] = "Both Fields are required";
            }
            
            //header('location: ' . URL . 'AdminController/AddVerb');
        }

        $allEnglishVerbs = $this->CourseModel->getallEnglishVerbs();
        $allGreekVerbs = $this->CourseModel->getallGreekVerbs();

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/AddVerb.php';
        require APP . 'views/templates/footer.php';
        
    }
    
    public function deleteVerb()
    {   
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $VerbId_selected = $_GET['VerbId'];
        // if we have an id of a verb that should be deleted
        if (isset($VerbId_selected)) {
            // do deleteVerb() in models/CourseModel.php
            $this->CourseModel->deleteVerb($VerbId_selected);
          
        }
        // where to go after verb has been deleted
        header('location: ' . URL . 'AdminController/AddVerb?flag=1');      
    }

    public function updateVerb()
    {   
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $_SESSION['g_message'] = '';

        if(isset($_POST['UpdateVerb']))
        {
            $this->CourseModel->updateVerb($_POST['newVerb'], $_POST['newVerbId'], $_POST['verb_classification']);
        }
        $_SESSION['g_message'] = "Verb updated";
        header('location: ' . URL . 'AdminController/AddVerb?flag=2');      
    }

    // public function updateUser()
    // {   
    //     $_SESSION['g_message'] = '';

    //     if(isset($_POST['updateUser']))
    //     {
    //         $this->CourseModel->updateVerb($_POST['newVerb'], $_POST['newVerbId'], $_POST['verb_classification']);
    //     }
    //     $_SESSION['g_message'] = "User updated";
    //     header('location: ' . URL . 'AdminController/UserRequests');      
    // }

    public function deleteCourse()
    {   
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $CourseId_selected = $_GET['CourseId'];
        // if we have an id of a verb that should be deleted
        if (isset($CourseId_selected)) {
            // do deleteVerb() in models/CourseModel.php
            $this->CourseModel->deleteCourse($CourseId_selected);
        }

        if ($_SESSION['admin_id'] == 1) {  // if institution admin   

            // get specific institution courses
            $InstitutionId = $_SESSION['managedInstitutionId'];
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName 
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            WHERE courses.InstitutionId = ?
            ORDER BY SchoolName ASC, CourseTitle ASC");
            //SELECT *
            //FROM perigrammata_db.courses
            //WHERE InstitutionId = ?");      
            $stmt->execute([$InstitutionId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 2){ // if school admin 

            // get specific school courses
            $SchoolId = $_SESSION['managedSchoolId'];   
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName, department.DepartmentName 
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            INNER JOIN department ON department.Id = courses.DepartmentId
            WHERE courses.SchoolId = ?
            ORDER BY SchoolName ASC, CourseTitle ASC");  
            $stmt->execute([$SchoolId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 3){ // if syllabus admin 

            // get specific syllabus courses
            $DepartmentId = $_SESSION['managedSyllabusId'];
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName, department.DepartmentName
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            INNER JOIN department ON department.Id = courses.DepartmentId
            WHERE courses.DepartmentId = ?  
            ORDER BY SchoolName ASC, CourseTitle ASC");    
            $stmt->execute([$DepartmentId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 4){ // if super admin    

            // get all courses 
            $courses = $this->CourseModel->getCourses();

        }  

        $_SESSION['g_message'] = "Success ";

        // where to go after verb has been deleted
        header('location: ' . URL . 'AdminController/AllCourses');      
    }

    public function deleteUser()    
    {   
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }



        $UserId_selected = $_GET['UserId'];  
       
        if (isset($UserId_selected)) {   

            // check if the user is also an admin
            $stmt = $this->conn->prepare("SELECT Id FROM admin WHERE UserId = ?");
            $stmt->execute([$UserId_selected]); 
            $checkIfAdmin = $stmt->fetchAll(); // get the mysqli result

            // if admin, delete user from admin table   
            if( $stmt->rowCount() ) { 

                foreach ($checkIfAdmin as $Id => $row ) {
                    $IsAdmin = $row['Id']; 
                }
    
                if($IsAdmin) {   
                    $stmt = $this->conn->prepare( "DELETE FROM admin WHERE UserId =:UserId_selected" );
                    $stmt->bindParam(':UserId_selected', $UserId_selected);
                    $stmt->execute();
                    //if( ! $stmt->rowCount() ) echo "Deletion failed";
                }
                
            }
            
            // delete user from user table
            $this->CourseModel->deleteUser($UserId_selected);
            $_SESSION['g_message'] = "Success ";
        }
        // where to go after user has been deleted
        header('location: ' . URL . 'AdminController/UserRequests');      
    }


    public function editVerb()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }
        
        $Verb = $this->CourseModel->getVerb($_GET['VerbId']);
        $VerbClassification = $this->CourseModel->getVerbClassification();
                
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/EditVerb.php';
        require APP . 'views/templates/footer.php';
    
    }


    public function UserRequests()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['admin_id'] != 4 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        // if (isset($_POST['UserRequests'])) {
        //     $this->CourseModel->updateUserStatus($_POST['id'], $_POST['StatusId']);
        // }
        $alluser = $this->CourseModel->UserRequests();

        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/UserRequests.php';
        require APP . 'views/templates/footer.php';
    }

    
    public function AllCourses()     
    {   
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $conn = $this->conn;
        if ($_SESSION['admin_id'] == 1) {  // if institution admin   

            // get specific institution courses
            $InstitutionId = $_SESSION['managedInstitutionId'];
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            WHERE courses.InstitutionId = ?
            ORDER BY SchoolName ASC, CourseTitle ASC");
            //SELECT *
            //FROM perigrammata_db.courses
            //WHERE InstitutionId = ?");      
            $stmt->execute([$InstitutionId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 2){ // if school admin 

            // get specific school courses
            $SchoolId = $_SESSION['managedSchoolId'];   
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName, department.DepartmentName 
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            INNER JOIN department ON department.Id = courses.DepartmentId
            WHERE courses.SchoolId = ?
            ORDER BY SchoolName ASC, CourseTitle ASC");  
            $stmt->execute([$SchoolId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 3){ // if syllabus admin 

            // get specific syllabus courses
            $DepartmentId = $_SESSION['managedSyllabusId'];
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName, department.DepartmentName
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            INNER JOIN department ON department.Id = courses.DepartmentId
            WHERE courses.DepartmentId = ?  
            ORDER BY SchoolName ASC, CourseTitle ASC");    
            $stmt->execute([$DepartmentId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 4){ // if super admin    

            // get all courses 
            $courses = $this->CourseModel->getCourses();

        } else if ($_SESSION['admin_id'] == 0){ // if super admin    

            // get all courses 
            $courses = $this->CourseModel->getCourses();

        } 

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/AllCourses.php';  
        require APP . 'views/templates/footer.php';
    }

     
    public function CoursesPerSemester()     
    {   
        /*
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }*/

        if( isset($_GET['SchoolId']) && isset($_GET['SemesterId']) )
        {
            
            $conn = $this->conn;
            $SchoolId = $_GET['SchoolId'];   
            $SemesterId = $_GET['SemesterId'];    
            $school = $this->CourseModel->getSchoolById($SchoolId);    
            $SemesterCourses = $this->CourseModel->getSemesterCourses($SchoolId,$SemesterId);    

            foreach ($school as $Id => $row2 ){
                $schoolName = $row2['SchoolName'];   
            }
        }  

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/courses_per_semester.php';  
        require APP . 'views/templates/footer.php';
    }

    public function CourseHtml()     
    {   
        if( isset($_GET["CourseId"]) ) {
            $CourseId = $_GET["CourseId"]; 
        } else {
            header('location: ' . URL . 'home');
        }

        $Course = $this->CourseModel->getCourse($CourseId);
        
        $CourseType = $this->CourseModel->getCourseType($Course['LangId']);
        $RequiredCourses= $this->CourseModel->getRequiredCourses($_GET['CourseId']);
        $CourseOutcome = $this->CourseModel->getCourseOutcomes($_GET['CourseId']);
        $verbs = $this->CourseModel->getVerbs($Course['LangId']);
        $CourseVerbs = $this->CourseModel->getCourseVerbs($_GET['CourseId']);
        $skills = $this->CourseModel->getSkills($Course['LangId']);
        $CourseSkills = $this->CourseModel->getCourseSkills($_GET['CourseId']);
        
        $method = $this->CourseModel->getLectureMethod($Course['LangId']);
        
        $UseOfTechnologies = $this->CourseModel->getUseOfTechnologies($Course['LangId']);
        $CourseMethod = $this->CourseModel->getCourseMethod($_GET['CourseId']);
        $activities = $this->CourseModel->getActivities($Course['LangId']);
        $CourseActivities = $this->CourseModel->getCourseActivities($_GET['CourseId']);

        $Assessments = $this->CourseModel->getCategoriesAssessment($Course['LangId']);
        $bonus = $this->CourseModel->getBonus($Course['LangId']);
        $CourseAssessment = $this->CourseModel->getCourseAssessment($_GET['CourseId']);

        if( isset($_GET['SchoolId']) && isset($_GET['SemesterId']) )
        {
            $SchoolId = $_GET['SchoolId'];   
            $SemesterId = $_GET['SemesterId'];    
            $school = $this->CourseModel->getSchoolById($SchoolId);    
            $SemesterCourses = $this->CourseModel->getSemesterCourses($SchoolId,$SemesterId);    

            foreach ($school as $Id => $row2 ){
                $schoolName = $row2['SchoolName'];   
            }
        }  

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/courses_per_semester_fhtml.php';  
        require APP . 'views/templates/footer.php';
    }

    public function Semester()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $school = $this->CourseModel->getSchoolById($_GET['SchoolId']);    
        $SemesterCourses = $this->CourseModel->getSemesterCourses($_GET['SemesterId'],$_GET['SchoolId']);

        $Course = $this->CourseModel->getCourse($_GET['CourseId']);
        $Language = $this->CourseModel->getTeachingLanguage();
        
        //$school = $this->CourseModel->getSchool($Course['LangId']);
        $department = $this->CourseModel->getDepartment($Course['LangId']);
        $LevelOfEducation = $this->CourseModel->getLevelOfEducation($Course['LangId']);
        $Professor = $this->CourseModel->getProfessor();
        $CourseProfessors= $this->CourseModel->getCourseProfessors($_GET['CourseId']);
        $courses = $this->CourseModel->getCourses();
        $RequiredCourses= $this->CourseModel->getRequiredCourses($_GET['CourseId']);
        
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/Semester.php';
        require APP . 'views/templates/footer.php';
    
    }

    public function AllSchools()     
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 || $_SESSION['admin_id'] != 4 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        /*
        $stmt = $this->conn->prepare("SELECT *
        FROM perigrammata_db.institution");
        $stmt->execute(); 
        $institutions = $stmt->fetchAll(); // get the mysqli result */
        //foreach ($institutions as $Id => $row){ 

        //$InstitutionId = $row['Id'];
        //$InstitutionName = $row['InstitutionName'];
        $conn = $this->conn;
        $stmt1 = $this->conn->prepare("SELECT *
        FROM perigrammata_db.school");
        $stmt1->execute(); 
        $schools = $stmt1->fetchAll(); // get the mysqli result

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/AllSchools.php';
        require APP . 'views/templates/footer.php';
    }

    public function MyInstitutions()     
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }   



        $institution = $this->CourseModel->getInstitutions();

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/MyInstitutions.php';   
        require APP . 'views/templates/footer.php';  
    }

    public function MySchools()     
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 || $_SESSION['admin_id'] != 1 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $InstitutionId = $_SESSION['managedInstitutionId'];

        $stmt = $this->conn->prepare("SELECT *
        FROM perigrammata_db.school
        WHERE InstitutionId = ?");
        $stmt->execute([$InstitutionId]); 
        $schools = $stmt->fetchAll(); // get the mysqli result

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/MySchools.php';
        require APP . 'views/templates/footer.php';
    }

    public function MySyllabus()     
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $stmt = $this->conn->prepare("SELECT * FROM department");
        $stmt->execute(); 
        $departments = $stmt->fetchAll(); // get the mysqli result

        // load views    
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/MySyllabus.php';
        require APP . 'views/templates/footer.php';
    }

    public function ProfessorCourses()
    {   /*
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }*/

        //$courses = $this->CourseModel->getProfessorCourses($profId);

        if(isset($_GET['professorId'])){       
            $professorId = $_GET['professorId'];
            if ($professorId==0){
                $_SESSION['g_message'] = "Error, you must choose at least one professor";
            }  
        }

        $stmt = $this->conn->prepare("SELECT DISTINCT(course_has_professor.CourseId),course_has_professor.ProfessorId , courses.CourseTitle, courses.Semester, courses.LessonCode, 
        school.SchoolName, courses.locked, department.DepartmentName, institution.InstitutionName 
        FROM course_has_professor 
        LEFT JOIN courses ON course_has_professor.CourseId = courses.Id
        LEFT JOIN school ON courses.SchoolId = school.Id
        LEFT JOIN department ON courses.DepartmentId = department.Id
        LEFT JOIN institution ON courses.InstitutionId = institution.Id
        WHERE ProfessorId = ? 
        ORDER BY SchoolName ASC;");  
        $stmt->execute([$professorId]); 
        $professorCourses = $stmt->fetchAll(); // get the mysqli result

        $stmt2 = $this->conn->prepare("SELECT FirstName, LastName FROM user WHERE Id = ?");
        $stmt2->execute([$professorId]); 
        $professorName = $stmt2->fetchAll(); // get the mysqli result

        foreach ($professorName as $Id => $row ) {
            $professorName = $row['FirstName'] . ' ' . $row['LastName']; 
        }
        
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/ProfessorCourses.php';
        require APP . 'views/templates/footer.php';
    }


    public function OutcomeList()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $courses = $this->CourseModel->getCourses();
        $activeCoursesList=$this->CourseModel->getActiveCoursesList();
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/OutcomesList.php';
        require APP . 'views/templates/footer.php';
    }


    public function editLearningOutcomes()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $Course = $this->CourseModel->getCourse($_GET['CourseId']);
        $verbs = $this->CourseModel->getVerbs($Course['LangId']);
        $CourseVerbs = $this->CourseModel->getCourseVerbs($_GET['CourseId']);

        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/EditLearningOutcomesAdmin.php';
        require APP . 'views/templates/footer.php';
    }


    public function updateLearningOutcomesAdmin()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }
    
        $_SESSION['g_message'] = '';

        $courses = $this->CourseModel->getCourses();
        $activeCoursesList=$this->CourseModel->getActiveCoursesList();

        if(isset($_POST['update_lo_admin'])){

            $this->CourseModel->deleteCourseHasVerbs($_POST['CourseId']);

            for($i=0;$i<count($_POST['Verbs']);$i++){
                // echo ($_POST['CourseId']).'<br>';
                //  echo $this->CourseModel->getVerb($_POST['Verbs'][$i])['Verbs'] .' '.$_POST['Sentences'][$i].'<br>';
                 $this->CourseModel->insertCourseHasVerbs($_POST['CourseId'],$_POST['Verbs'][$i],$_POST['Sentences'][$i],$i);
            }
            // $_SESSION['g_message'] = 'Success';
        }
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/OutcomesList.php';
        require APP . 'views/templates/footer.php';
    }


    public function Learningoutcomes(){

        // $department = $this->CourseModel->getDepartment($Course['LangId']);
        $courses_ = $this->CourseModel->getCourses();
        $activeCoursesPercent=$this->CourseModel->getActiveCoursesPercent();
        $activeCoursesList=$this->CourseModel->getActiveCoursesList();
        // $CourseOutcome = $this->CourseModel->getCourseOutcomes($_GET['CourseId']);


        $CourseElOutcomes = $this->CourseModel->getAllOutcomes();
        $CourseEnOutcomes = $this->CourseModel->getEnOutcomes2();

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/LearningOutcomes.php';
        require APP . 'views/templates/footer.php';

    }


    public function SchoolHtmlExporter()
    {
        if(isset($_GET['MsgId'])){
            $MsgId = $_GET['MsgId'];
            if ($MsgId==0){
                $_SESSION['g_message'] = "Error, you must choose at least one of the general abilities";
            }
        }
        $documentedCoursesPercent=$this->CourseModel->getDocumentedCoursesPercent();
        $documentedCoursesList=$this->CourseModel->getDocumentedCoursesList();
        $submitedCourses=$this->CourseModel->submitedCourses();
        $department = $this->CourseModel->getDepartment(1);
        $activeCoursesList=$this->CourseModel->getActiveCoursesList();
        // $documentedCourse=$this->CourseModel->getDocumentedCourse($_GET['CourseId']);
        // $CourseOutcome = $this->CourseModel->getCourseOutcomes($_GET['CourseId']);

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/SchoolHtmlExporter.php';
        require APP . 'views/templates/footer.php';

    }


    public function DocumentLearningoutcomes()
    {
        if(isset($_GET['MsgId'])){
            $MsgId = $_GET['MsgId'];
            if ($MsgId==0){
                $_SESSION['g_message'] = "Error, you must choose at least one of the general abilities";
            }
        }
        $documentedCoursesPercent=$this->CourseModel->getDocumentedCoursesPercent();
        $documentedCoursesList=$this->CourseModel->getDocumentedCoursesList();
        $submitedCourses=$this->CourseModel->submitedCourses();
        $department = $this->CourseModel->getDepartment(1);
        // $documentedCourse=$this->CourseModel->getDocumentedCourse($_GET['CourseId']);
        // $CourseOutcome = $this->CourseModel->getCourseOutcomes($_GET['CourseId']);

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/DocumentLearningOutcomes.php';
        require APP . 'views/templates/footer.php';

    }
    
    public function AbetTable()
    {

        $CourseAbetOutcomes=$this->CourseModel->getCourseAbetOutcomes($_GET['CourseId']);
        $CourseId_selected = $this->CourseModel->getCourse($_GET['CourseId']);

        $TranslatedOutcomes = $this->CourseModel->getCourseAbetOutcomes($_GET["CourseId"]);
        $AbetScoreByCourse = $this->CourseModel->getAbetScoreByCourse($_GET["CourseId"]);
        $AbetScoreByCourse1 = $this->CourseModel->getAbetScoreByCourse1($_GET["CourseId"]);


        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/CourseAbetOutcomes.php';
        require APP . 'views/templates/footer.php';

    }

    public function ScoreBySchool(){

        if (!isset($_POST['department_'])||$_POST['department_']==''){
            header('location: ' . URL . 'AdminController/DocumentLearningoutcomes?MsgId=0');
        }

        $department_selected = $_POST['department_'] ; 
        $AbetScoreBySchool = $this->CourseModel->getAbetScoreBySchool($department_selected);
        $AbetScoreBySchool1 = $this->CourseModel->getAbetScoreBySchool1($department_selected);
        $department_ = $this->CourseModel->getDepartment_($department_selected);

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/ScoreBySchool.php';
        require APP . 'views/templates/footer.php';

    }

    public function HTMLBySchool(){

        if (!isset($_POST['department_'])||$_POST['department_']==''){
            header('location: ' . URL . 'AdminController/DocumentLearningoutcomes?MsgId=0');
        }

        $department_selected = $_POST['department_']; 
        $undergrad_selected = $_POST['education_level'];
        //$department_ = $this->CourseModel->getDepartment_($department_selected);

        $conn1 = $this->conn; 

        $stmt=$this->conn->prepare("SELECT DepartmentName FROM department WHERE Id = ?");
        $stmt->execute([$department_selected]); 
        $department = $stmt->fetchAll(); // get the mysqli result

        foreach ($department as $row2) {
            $department_ = $row2['DepartmentName']; 
        }

        // get outlined courses for the selected school
        /*
        $q = $this->conn->prepare("SELECT DISTINCT (courses.CourseTitle),courses.LessonCode,courses.Semester,courses.Id ,school.SchoolName,courses.EducationId,courses.locked

        FROM course_has_verbs,verbs,courses,school,abet_outcomes
        
        where verbs.Id = course_has_verbs.VerbId && course_has_verbs.CourseId=courses.Id && courses.SchoolId=school.Id  

        ORDER BY school.SchoolName ASC,courses.Semester"); 

        $allActiveCourses = array();
        while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            if($row['SchoolName'] == $department_) {
                if($undergrad_selected == 1 && ($row['EducationId'] == 1 || $row['EducationId'] == 4))
                    $allActiveCourses[$row['Id']] = $row;
                if($undergrad_selected == 0 && ($row['EducationId'] == 2 || $row['EducationId'] == 5))
                    $allActiveCourses[$row['Id']] = $row;
            }  
        }    
*/
        //return $allActiveCourses;  


        function getActiveCoursesListBySchoolAndEducationLevel($SchoolName,$undergrad,$conn1)
        {
            //$q=$this->conn->query("call perigrammata_db.getActiveCoursesList()");
            $stmt3 = $conn1->prepare("SELECT DISTINCT (courses.CourseTitle),courses.LessonCode,courses.Semester,courses.Id ,school.SchoolName,courses.EducationId,courses.locked
            FROM course_has_verbs,verbs,courses,school,abet_outcomes
            where verbs.Id = course_has_verbs.VerbId && course_has_verbs.CourseId=courses.Id && courses.SchoolId=school.Id  
            ORDER BY school.SchoolName ASC,courses.Semester"); 
            $stmt3->execute(); 
            $allCourses = $stmt3->fetchAll(); // get the mysqli result
            $allActiveCourses = array();
            //while ($row = $q->fetch(PDO::FETCH_BOTH)) {
            foreach ($allCourses as $row) {   
                if($row['SchoolName'] == $SchoolName) {
                    if($undergrad == 1 && ($row['EducationId'] == 1 || $row['EducationId'] == 4))
                        $allActiveCourses[$row['Id']] = $row;
                    if($undergrad == 0 && ($row['EducationId'] == 2 || $row['EducationId'] == 5))
                        $allActiveCourses[$row['Id']] = $row;
                }
            }
            return $allActiveCourses;
        }
        
        $activeCoursesList=getActiveCoursesListBySchoolAndEducationLevel($department_,$undergrad_selected,$conn1);
        $totalSkills = 0;
        
        function get_string_between($string, $start, $end){
            $string = ' ' . $string;
            $ini = strpos($string, $start);
            if ($ini == 0) return '';
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;
            return substr($string, $ini, $len);
        }


        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/HtmlBySchool.php';
        require APP . 'views/templates/footer.php';

    }

    public function UniversityResults(){
        

        $AbetScoreHmmy = $this->CourseModel->getAbetScoreBySchool(8);
        $AbetScoreHmmy1 = $this->CourseModel->getAbetScoreBySchool1(8);
        $AbetScoreMpd = $this->CourseModel->getAbetScoreBySchool(6);
        $AbetScoreMpd1 = $this->CourseModel->getAbetScoreBySchool1(6);
        $AbetScoreMhxop = $this->CourseModel->getAbetScoreBySchool(7);
        $AbetScoreMhxop1 = $this->CourseModel->getAbetScoreBySchool1(7);
        $AbetScoreArmhx = $this->CourseModel->getAbetScoreBySchool(10);
        $AbetScoreArmhx1 = $this->CourseModel->getAbetScoreBySchool1(10);
        $AbetScoreMhper = $this->CourseModel->getAbetScoreBySchool(9);
        $AbetScoreMhper1 = $this->CourseModel->getAbetScoreBySchool1(9);


        $Hmmy = $this->CourseModel->getDepartment_(8);
        $Mpd = $this->CourseModel->getDepartment_(6);
        $Mhxop = $this->CourseModel->getDepartment_(7);
        $Armhx = $this->CourseModel->getDepartment_(10);
        $Mhper = $this->CourseModel->getDepartment_(9);

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/UniversityResults.php';
        require APP . 'views/templates/footer.php';
    }


    
    public function LearningOutcomesAbet2(){
        $Course = $this->CourseModel->getCourse($_GET['CourseId']);
        $CourseOutcome = $this->CourseModel->getCourseOutcomes($_GET['CourseId']);
        $TranslatedOutcomes = $this->CourseModel->getCourseAbetOutcomesWithoutSkills($_GET['CourseId']);
        $CoursePercent = $this->CourseModel->getDocumentedCoursePer($_GET['CourseId']);

        $skills = $this->CourseModel->getSkills($Course['LangId']);
        $CourseSkills = $this->CourseModel->getCourseSkills($_GET['CourseId']);
        $CourseSkills_1 = $this->CourseModel->getCourseSkills1($_GET['CourseId']);
        $CourseElOutcomes = $this->CourseModel->getAllOutcomes();
        $checkSkill= $this->CourseModel->checkSkill($_GET['CourseId']);
        $LangId = $Course['LangId'];
        $Version = $_GET['Version'];
       
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/AbetCriterion1.php';
        require APP . 'views/templates/footer.php';
    }
     

    public function SaveAbetOutcomes(){

        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }
        
        $CourseId = $_POST['CourseId'];

        // $_SESSION['g_message'] = 'Success'; 
        $Course = $this->CourseModel->getCourse($CourseId);
        $CourseOutcome = $this->CourseModel->getCourseOutcomes($CourseId);
        $TranslatedOutcomes = $this->CourseModel->getCourseAbetOutcomesWithoutSkills($CourseId);
        $CoursePercent = $this->CourseModel->getDocumentedCoursePer($CourseId);
    
        $skills = $this->CourseModel->getSkills($Course['LangId']);
        $CourseSkills = $this->CourseModel->getCourseSkills($CourseId);
        $activeCoursesPercent=$this->CourseModel->getActiveCoursesPercent();
        $activeCoursesList=$this->CourseModel->getActiveCoursesList();
        // $CourseOutcome = $this->CourseModel->getCourseOutcomes($_GET['CourseId']);

        
        $CourseAllOutcomes = $this->CourseModel->getAllOutcomes();
        $CourseEnOutcomes = $this->CourseModel->getEnOutcomes2();
        $CourseElOutcomes = $this->CourseModel->getAllOutcomes();

        $Version = $_GET['Version'];
        // $NumOfSkills =$_GET['NumOfSkills'];
        if (isset($_GET['NumOfSkills'])){
            $NumOfSkills = $_GET['NumOfSkills'];
        }


        if (isset($_POST['abet']) && isset($_POST['total'])){
            $abetId=$_POST['abet'];
            $abetTotal=$_POST['total'];

            $skills=array();
            if (isset($_POST['skills'])){
                $skills=$_POST['skills'];
            }
           
            // echo count($abetId);
            // $OutcomeId=$_POST['OutcomeId'];
        
            $outc = -1;
            $str='';
            $l=0;
            $p=0;
            $flag=0;
            $m=0;
            $y=0;
            $numOfZeros=0;
            $abet_arrayy=array();
            $outcome_array=array();
            
            //We send from AbetCriterion1.php abetId_outcomeId (4_6,..)
            for($i=0;$i<count($abetId);$i++){
                
                //Copy everything before _ , we take abetId
                $AbetId = strstr($abetId[$i], '_', true); 
            
                //Copy everything after _ , we take outcomeId
                $outcomeId = substr($abetId[$i], strpos($abetId[$i], "_") + 1);             
                
                if (strpos($AbetId, '!') !== false) {
                    $abet_arrayy[$l]= 0;
                    $numOfZeros++;
                } else{
                    $abet_arrayy[$l]= $AbetId;
                }
                
                $outcome_array[$l]=$outcomeId;
                $l++;
                
            }

            // check if a learning outcome has score 0 for all criteria
            // echo count($abet_arrayy)/7;
            
            // for($i=0;$i<count($abet_arrayy)/7;$i++){
            //     if($abet_arrayy[$y+0]==0 && $abet_arrayy[1+$y]==0 && $abet_arrayy[$y+2]==0 && 
            //     $abet_arrayy[$y+3]==0 && $abet_arrayy[$y+4]==0 && $abet_arrayy[$y+5]==0 && $abet_arrayy[$y+6]==0){
            //         $flag=1;
            //         break;
            //     }
            //     $y=$y+7;
            // }

            for($i=0;$i<count($abetTotal);$i++){
                if (+$abetTotal[$i]>1){  
                    $flag = 1;
                }
            }
            // echo $abetTotal[0].' '. $abetTotal[1].' '.$abetTotal[2].' '.$abetTotal[3].' '.$abetTotal[4].' '.$abetTotal[5].' '.$abetTotal[6];
        
            if( $numOfZeros==count($abetId) || ($flag == 1) || (+$abetTotal[0]==0 && +$abetTotal[1]==0 && +$abetTotal[2]==0 && +$abetTotal[3]==0 && +$abetTotal[4]==0 && +$abetTotal[5]==0 && +$abetTotal[6]==0) ){
                $_SESSION['g_message'] = 'Something get wrong!! ';
            }else{
                // Delete Previous Learning outcomes from skills
                $k=0;
                $this->CourseModel->deleteAbetOutcomeSkillsByCourse($CourseId);

                for($i=0;$i<count($abet_arrayy);$i=$i+7){
                    for($j=0;$j<count($outcome_array);$j++){
                    
                        if($i==$j){


                            // General skills insert
                            if($i>=count($TranslatedOutcomes)*7){
                                $str= $this->CourseModel->getSkill_($skills[$p])['Description'] ;
                                
                                $p++;
                                $this->CourseModel->AddAbetOutcomeFromSkill($CourseId,$outcome_array[count($outcome_array)-1]+$p,'_'.$str,$abet_arrayy[$i], $abet_arrayy[$i+1],$abet_arrayy[$i+2],$abet_arrayy[$i+3],$abet_arrayy[$i+4],$abet_arrayy[$i+5],$abet_arrayy[$i+6]);

                                // echo 'CourseId = '.$CourseId .' ,'.$str .' Outcome Id = '.$outcome_array[$i].' Score = '.$abet_arrayy[$i].' '. $abet_arrayy[$i+1].' '.$abet_arrayy[$i+2].' '.$abet_arrayy[$i+3].' '.$abet_arrayy[$i+4].' '.$abet_arrayy[$i+5].' '.$abet_arrayy[$i+6] .'<br>';
                                
                            }else{
                                if ($Version==2){
                                $this->CourseModel->UpdateAbetOutcome($CourseId,$outcome_array[$j],$abet_arrayy[$i],$abet_arrayy[$i+1],$abet_arrayy[$i+2],$abet_arrayy[$i+3],$abet_arrayy[$i+4],$abet_arrayy[$i+5],$abet_arrayy[$i+6]); 
                          
                                }
                            }

                            
                                    
                        }
                    }
                }
                $this->CourseModel->AddAbetOutcomeFromSkill($CourseId,99,'Total',+$abetTotal[0],+$abetTotal[1],+$abetTotal[2],+$abetTotal[3],+$abetTotal[4],+$abetTotal[5],+$abetTotal[6]);
                $this->CourseModel->AddAbetOutcomeFromSkill($CourseId,100,'Total1',+$abetTotal[7],+$abetTotal[8],+$abetTotal[9],+$abetTotal[10],+$abetTotal[11],+$abetTotal[12],+$abetTotal[13]);

            }
    
        }

        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/LearningOutcomes.php';
        require APP . 'views/templates/footer.php';
    }

    public function LockCourse(){

        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $CourseId = $_GET['CourseId'];
        $Locked = $_GET['Locked'];

        $Course = $this->CourseModel->getCourse($CourseId);
        $CourseOutcome = $this->CourseModel->getCourseOutcomes($CourseId);
        $TranslatedOutcomes = $this->CourseModel->getCourseAbetOutcomesWithoutSkills($CourseId);
        $CoursePercent = $this->CourseModel->getDocumentedCoursePer($CourseId);
      
        $skills = $this->CourseModel->getSkills($Course['LangId']);
        $CourseSkills = $this->CourseModel->getCourseSkills($CourseId);
        $activeCoursesPercent=$this->CourseModel->getActiveCoursesPercent();
        $activeCoursesList=$this->CourseModel->getActiveCoursesList();
        // $CourseOutcome = $this->CourseModel->getCourseOutcomes($_GET['CourseId']);

        
        $CourseAllOutcomes = $this->CourseModel->getAllOutcomes();
        $CourseEnOutcomes = $this->CourseModel->getEnOutcomes2();
        $CourseElOutcomes = $this->CourseModel->getAllOutcomes();
        // Locked 1
        // Unlocked 0
        if ($Locked){ //if it is locked , unlock course
            $this->CourseModel->UpdateLock($CourseId,0);
        }else{ //if it is unlocked , lock course
            $this->CourseModel->UpdateLock($CourseId,1);
        }
        header('location: ' . URL . 'AdminController/Learningoutcomes');
        // require APP . 'views/templates/header.php';
        // require APP . 'views/AdminPage/LearningOutcomes.php';
        // require APP . 'views/templates/footer.php';
    }

    public function  WriteENOutcomes()
    {
    
        $courses_ = $this->CourseModel->getCourses();
        $activeCoursesPercent=$this->CourseModel->getActiveCoursesPercent();
        $activeCoursesList=$this->CourseModel->getActiveCoursesList();
        // $CourseOutcome = $this->CourseModel->getCourseOutcomes($_GET['CourseId']);


        $CourseAllOutcomes = $this->CourseModel->getAllOutcomes();
        $CourseEnOutcomes = $this->CourseModel->getEnOutcomes2();
        $CourseElOutcomes = $this->CourseModel->getAllOutcomes();

        $myarr=array();
        $flag=-1;
        if (isset($_POST['submit'])){
            // El Courses
            if(isset($_POST['abetEN']) && isset($_POST['OutcomeId']) && isset($_POST['CourseId'])){
                $abetEN = $_POST['abetEN'];
                $outcomeId = $_POST['OutcomeId']; 
                $courseId = $_POST['CourseId'];
            
                for($j=0;$j<count($abetEN);$j++){
                //   echo 'CourseId = '.$courseId[$j].', OutcomeId = ' .$outcomeId[$j] . ', '.$abetEN[$j] . '<br>';
                    $myarr[$j] = $this->CourseModel->AddAbetOutcome($courseId[$j],$outcomeId[$j],$abetEN[$j]);
                    // $this->CourseModel->AddAbetOutcome($courseId[$j],99,'Total');
                }
            }
            // En Courses
            if(isset($_POST['abetEN2']) && isset($_POST['OutcomeId2']) && isset($_POST['CourseId2'])){
                $abetEN2 = $_POST['abetEN2'];
                $outcomeId2 = $_POST['OutcomeId2']; 
                $courseId2 = $_POST['CourseId2'];
            
                for($l=0;$l<count($abetEN2);$l++){
                    //    echo 'CourseId = '.$courseId2[$l].', OutcomeId = ' .$outcomeId2[$l] . ', '.$abetEN2[$l] . '<br>';
                   
                    $myarr[$l] = $this->CourseModel->AddAbetOutcome($courseId2[$l],$outcomeId2[$l],$abetEN2[$l]);
                    // $this->CourseModel->AddAbetOutcome($courseId2[$l],99,'Total');
                }
               
            }
        }

        $_SESSION['g_message'] = 'Success ';
        

        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/LearningOutcomes.php';
        require APP . 'views/templates/footer.php';    
    }

    public function editCourse()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $Course = $this->CourseModel->getCourse($_GET['CourseId']);
        $Language = $this->CourseModel->getTeachingLanguage();
        
        $school = $this->CourseModel->getSchool($Course['LangId']);
        $CourseInstitutions = $this->CourseModel->getCourseInstitutions($_GET['CourseId']);
        $CourseSchools = $this->CourseModel->getCourseSchools($_GET['CourseId']);
        $CourseDepartments = $this->CourseModel->getCourseDepartments($_GET['CourseId']);

        foreach ($CourseInstitutions as $Id => $row0 ) {
            $InstitutionId = $row0["InstitutionId"];
            $SecondInstitutionId = $row0["SecondInstitutionId"];
        }

        foreach ($CourseSchools as $Id => $row5 ) {
            $SchoolId = $row5["SchoolId"];
            $SecondSchoolId = $row5["SecondSchoolId"];
        }

        foreach ($CourseDepartments as $Id => $row6 ) {
            $DepartmentId = $row6["DepartmentId"];
            $SecondDepartmentId = $row6["SecondDepartmentId"];
        }

        $stmt9 = $this->conn->prepare("SELECT * FROM department");
        $stmt9->execute(); 
        $department = $stmt9->fetchAll(); // get the mysqli result */
        //$department = $this->CourseModel->getDepartment($Course['LangId']);

        $LevelOfEducation = $this->CourseModel->getLevelOfEducation($Course['LangId']);
        $Professor = $this->CourseModel->getProfessor();
        $CourseProfessors= $this->CourseModel->getCourseProfessors($_GET['CourseId']);
        $courses = $this->CourseModel->getCourses();
        $RequiredCourses= $this->CourseModel->getRequiredCourses($_GET['CourseId']);

        $CourseId = $_GET['CourseId']; 

        if ($_SESSION['admin_id'] == 3) {
            $stmt3 = $this->conn->prepare("SELECT * FROM department 
            WHERE Id = ?");
            $stmt3->execute([$_SESSION['managedSyllabusId']]); 
            $my_department = $stmt3->fetchAll(); // get the mysqli result */
        }

        $stmt4 = $this->conn->prepare("SELECT * FROM institution");  
        $stmt4->execute(); 
        $institution = $stmt4->fetchAll(); // get the mysqli result
                
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/EditCourse.php';
        require APP . 'views/templates/footer.php';
    
    }

    public function editInstitution()     
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $InstitutionId = $_GET['InstitutionId']; 
        $stmt = $this->conn->prepare("SELECT * FROM institution WHERE Id = ?");
        $stmt->execute([$InstitutionId]); 
        $institution = $stmt->fetchAll(); // get the mysqli result

        foreach ($institution as $Id => $row ) {

            $school_lang_id = $row['langId'];
            if($school_lang_id == 1) {   
                $LanguageOfTeaching = 'Ελληνικά'; 
            } else if($school_lang_id == 2) {       
                $LanguageOfTeaching = 'Αγγλικά'; 
            }
            $InstitutionName = $row['InstitutionName'];  

        }
             
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/EditInstitution.php';
        require APP . 'views/templates/footer.php';
    
    }    

    public function editSchool()     
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $SchoolId = $_GET['SchoolId']; 
        $stmt = $this->conn->prepare("SELECT * FROM school WHERE Id = ?");
        $stmt->execute([$SchoolId]); 
        $school = $stmt->fetchAll(); // get the mysqli result
        //$stmt->close();

        foreach($school as $row){
            $school_lang_id = $row['langId'];
            if($school_lang_id == 1) {   
                $LanguageOfTeaching = 'Ελληνικά'; 
            } else if($school_lang_id == 2) {       
                $LanguageOfTeaching = 'Αγγλικά'; 
            }
            $department = $this->CourseModel->getDepartment($school_lang_id);
            $school_name = $row['SchoolName'];  
            $InstitutionId = $row['InstitutionId'];
        }

        $stmt = $this->conn->prepare("SELECT * FROM institution");
        $stmt->execute(); 
        $institution = $stmt->fetchAll(); // get the mysqli result

        $stmt2 = $this->conn->prepare("SELECT * FROM department");
        $stmt2->execute(); 
        $department = $stmt2->fetchAll(); // get the mysqli result

        $stmt3 = $this->conn->prepare("SELECT distinct(DepartmentId) FROM school_to_department WHERE SchoolId = ?");
        $stmt3->execute([$SchoolId]); 
        $school_to_department = $stmt3->fetchAll(); // get the mysqli result
             
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/EditSchool.php';
        require APP . 'views/templates/footer.php';
    
    }

    public function editSyllabus()     
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }
          
        $SyllabusId = $_GET['SyllabusId']; 
        $stmt = $this->conn->prepare("SELECT * FROM department WHERE Id = ?");
        $stmt->execute([$SyllabusId]); 
        $department = $stmt->fetchAll(); // get the mysqli result
        //$stmt->close();

        foreach($department as $row){
            $school_lang_id = $row['langId'];
            if($school_lang_id == 1) {   
                $LanguageOfTeaching = 'Ελληνικά'; 
            } else if($school_lang_id == 2) {
                $LanguageOfTeaching = 'Αγγλικά'; 
            }
            //$department = $this->CourseModel->getDepartment($school_lang_id);
            $department_name = $row['DepartmentName'];  
            $InstitutionId = $row['InstitutionId'];
            $SecondInstitutionId = 1;
            if ( !empty($row['SecondInstitutionId']) ) {
                $SecondInstitutionId = $row['SecondInstitutionId'];
            }
        }

        $stmt = $this->conn->prepare("SELECT * FROM institution");
        $stmt->execute(); 
        $institution = $stmt->fetchAll(); // get the mysqli result
             
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/EditSyllabus.php';
        require APP . 'views/templates/footer.php';
    
    }

    public function editUser()     
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['admin_id'] != 4 ){ // if not logged in or not a SUPER admin
            header('location: ' . URL . 'home');
        }   

        $UserId = $_GET['UserId'];   
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE Id = ?");
        $stmt->execute([$UserId]); 
        $user = $stmt->fetchAll(); // get the mysqli result
        //$stmt->close();
    
        foreach($user as $row){        
            $firstName = $row['FirstName'];  
            $lastName = $row['LastName'];
            $userName = $row['UserName'];
            $profileId = $row['ProfileId']; 
        }   

        $adminId = 0;
              
        if($profileId==1 || $profileId==3) {
            $stmt4 = $this->conn->prepare("SELECT * FROM admin WHERE UserId = ?");
            $stmt4->execute([$UserId]); 
            $adminUser = $stmt4->fetchAll(); // get the mysqli result
            
            foreach($adminUser as $row){      
                $adminId = $row['AdminId'];  
                $ManagedDepartmentId = $row['ManagedDepartmentId'];
            }     

        } 
        
        $stmt1 = $this->conn->prepare("SELECT *       
        FROM perigrammata_db.institution");
        $stmt1->execute(); 
        $institutions = $stmt1->fetchAll(); // get the mysqli result

        $stmt2 = $this->conn->prepare("SELECT *
        FROM perigrammata_db.school");
        $stmt2->execute(); 
        $schools = $stmt2->fetchAll(); // get the mysqli result

        $stmt3 = $this->conn->prepare("SELECT *
        FROM perigrammata_db.department");
        $stmt3->execute(); 
        $departments = $stmt3->fetchAll(); // get the mysqli result
             
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/EditUser.php';
        require APP . 'views/templates/footer.php';
    
    }

    public function addOptionalCourse(){

        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $Course = $this->CourseModel->getCourse($_GET['CourseId']);
        $courses = $this->CourseModel->getCourses();

        $DepartmentId = $_GET['DepartmentId'];
        $this->CourseModel->addOptionalCourse($_GET['CourseId'],$_GET['DepartmentId']);

        if ($_SESSION['admin_id'] == 1) {  // if institution admin   

            // get specific institution courses
            $InstitutionId = $_SESSION['managedInstitutionId'];
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            WHERE courses.InstitutionId = ?
            ORDER BY SchoolName ASC, CourseTitle ASC");
            //SELECT *
            //FROM perigrammata_db.courses
            //WHERE InstitutionId = ?");      
            $stmt->execute([$InstitutionId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 2){ // if school admin 

            // get specific school courses
            $SchoolId = $_SESSION['managedSchoolId'];   
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName, department.DepartmentName 
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            INNER JOIN department ON department.Id = courses.DepartmentId
            WHERE courses.SchoolId = ?
            ORDER BY SchoolName ASC, CourseTitle ASC");  
            $stmt->execute([$SchoolId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 3){ // if syllabus admin 

            // get specific syllabus courses
            $DepartmentId = $_SESSION['managedSyllabusId'];
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName, department.DepartmentName
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            INNER JOIN department ON department.Id = courses.DepartmentId
            WHERE courses.DepartmentId = ?  
            ORDER BY SchoolName ASC, CourseTitle ASC");    
            $stmt->execute([$DepartmentId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 4){ // if super admin    

            // get all courses 
            $courses = $this->CourseModel->getCourses();

        } 

        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/AllCourses.php';
        require APP . 'views/templates/footer.php';
    }

    public function deleteOptionalCourse(){

        $Course = $this->CourseModel->getCourse($_GET['CourseId']);
        $courses = $this->CourseModel->getCourses();

        $DepartmentId = $_GET['DepartmentId'];
        $this->CourseModel->deleteOptionalCourse($_GET['CourseId'],$_GET['DepartmentId']);

        if ($_SESSION['admin_id'] == 1) {  // if institution admin   

            // get specific institution courses
            $InstitutionId = $_SESSION['managedInstitutionId'];
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            WHERE courses.InstitutionId = ?
            ORDER BY SchoolName ASC, CourseTitle ASC");
            //SELECT *
            //FROM perigrammata_db.courses
            //WHERE InstitutionId = ?");      
            $stmt->execute([$InstitutionId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 2){ // if school admin 

            // get specific school courses
            $SchoolId = $_SESSION['managedSchoolId'];   
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName, department.DepartmentName 
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            INNER JOIN department ON department.Id = courses.DepartmentId
            WHERE courses.SchoolId = ?
            ORDER BY SchoolName ASC, CourseTitle ASC");  
            $stmt->execute([$SchoolId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 3){ // if syllabus admin 

            // get specific syllabus courses
            $DepartmentId = $_SESSION['managedSyllabusId'];
            $stmt = $this->conn->prepare("SELECT courses.*, school.SchoolName, department.DepartmentName
            FROM perigrammata_db.courses 
            INNER JOIN school ON school.Id = courses.SchoolId
            INNER JOIN department ON department.Id = courses.DepartmentId
            WHERE courses.DepartmentId = ?  
            ORDER BY SchoolName ASC, CourseTitle ASC");    
            $stmt->execute([$DepartmentId]); 
            $courses = $stmt->fetchAll(); // get the mysqli result

        } else if ($_SESSION['admin_id'] == 4){ // if super admin    

            // get all courses 
            $courses = $this->CourseModel->getCourses();

        } 

        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/AllCourses.php';
        require APP . 'views/templates/footer.php';
    }  

    public function deleteInstitution(){

        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        if( isset( $_GET['InstitutionId'] ) && is_numeric( $_GET['InstitutionId'] ) && $_GET['InstitutionId'] > 0 )
        {
            $InstitutionId = $_GET['InstitutionId'];
            $stmt = $this->conn->prepare( "DELETE FROM institution WHERE Id =:InstitutionId" );
            $stmt->bindParam(':InstitutionId', $InstitutionId);
            $stmt->execute();
            //if( ! $stmt->rowCount() ) echo "Deletion failed";
            $_SESSION['g_message'] = "Success ";
        }
        else
        {
            echo "ID must be a positive integer";
        }

        $institution = $this->CourseModel->getInstitutions();

        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/MyInstitutions.php';
        require APP . 'views/templates/footer.php';

    }

    public function deleteSchool(){

        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        if ($_SESSION['admin_id'] != 4) { // if not super admin
            $InstitutionId = $_SESSION['managedInstitutionId'];
        } else {
            $stmt = $this->conn->prepare("SELECT *
            FROM perigrammata_db.institution");
            $stmt->execute(); 
            $institutions = $stmt->fetchAll(); // get the mysqli result
        }

        if( isset( $_GET['SchoolId'] ) && is_numeric( $_GET['SchoolId'] ) && $_GET['SchoolId'] > 0 )
        {
            try {
                $SchoolId = $_GET['SchoolId'];
                $stmt1 = $this->conn->prepare( "DELETE FROM school WHERE Id =:SchoolId" );
                $stmt1->bindParam(':SchoolId', $SchoolId);
                $stmt1->execute(); 

                $stmt2 = $this->conn->prepare("SELECT * FROM school WHERE Id =:SchoolId");
                $stmt2->bindParam(':SchoolId', $SchoolId);
                $stmt2->execute(); 
                $deleted_schools = $stmt2->fetchAll(); // get the mysqli result
                
                if( $stmt2->rowCount() ) {
                    //echo "Deletion failed";
                    $_SESSION['g_message'] = 'Η σχολή δεν μπορεί να διαγραφεί, καθώς υπάρχουν καταχωρημένα μαθήματα σε αυτήν.';
                } else {
                    $_SESSION['g_message'] = "Success ";
                }
                
            }
            catch(PDOException $e) {
                $_SESSION['g_message'] = 'There is an error. Please try again  '; 
            }
        }
        else
        {
            echo "ID must be a positive integer";
        }  

        if ($_SESSION['admin_id'] != 4) { // if not super admin

            $stmt = $this->conn->prepare("SELECT *
            FROM perigrammata_db.school
            WHERE InstitutionId = ?");  
            $stmt->execute([$InstitutionId]);     
            $schools = $stmt->fetchAll(); // get the mysqli result

        } else { // if super admin

            $stmt = $this->conn->prepare("SELECT *
            FROM perigrammata_db.school");  
            $stmt->execute([]);   
            $schools = $stmt->fetchAll(); // get the mysqli result
        
        }

        if ($_SESSION['admin_id'] != 4) { // if not super admin
            require APP . 'views/templates/header.php';
            require APP . 'views/AdminPage/MySchools.php';
            require APP . 'views/templates/footer.php';
        } else {
            require APP . 'views/templates/header.php';
            require APP . 'views/AdminPage/AllSchools.php';
            require APP . 'views/templates/footer.php';
        }


    }

    public function deleteSyllabus(){

        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        if( isset( $_GET['SyllabusId'] ) && is_numeric( $_GET['SyllabusId'] ) && $_GET['SyllabusId'] > 0 )
        {
            $SyllabusId = $_GET['SyllabusId'];
            $stmt = $this->conn->prepare( "DELETE FROM department WHERE Id =:SyllabusId" );
            $stmt->bindParam(':SyllabusId', $SyllabusId);
            $stmt->execute();
            //if( ! $stmt->rowCount() ) echo "Deletion failed";
            $_SESSION['g_message'] = "Success ";
        }
        else   
        {
            echo "ID must be a positive integer";
        }

        $stmt = $this->conn->prepare("SELECT * FROM department");
        $stmt->execute(); 
        $departments = $stmt->fetchAll(); // get the mysqli result

        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/MySyllabus.php';
        require APP . 'views/templates/footer.php';
        
    }


    // Create/save school functions 

    public function CreateSchool1()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 || ($_SESSION['admin_id'] != 1 && $_SESSION['admin_id'] != 4) ){ // if not logged in or not proper role
            header('location: ' . URL . 'home');
        }

        $teaching_lang = $this->CourseModel->getTeachingLanguage();
        
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/CreateSchool1.php';
        require APP . 'views/templates/footer.php';
    }

    public function CreateSchool2()  
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 || ($_SESSION['admin_id'] != 1 && $_SESSION['admin_id'] != 4) ){ // if not logged in or not proper role
            header('location: ' . URL . 'home');   
        }

        if (!isset($_POST['LanguageOfTeaching'])){
            header('location: ' . URL . 'AdminController/CreateSchool1');
        }

        $teaching_lang = $this->CourseModel->getTeachingLanguage();
        $teaching_lang_selected = $teaching_lang[$_POST['LanguageOfTeaching']]['LanguageOfTeaching'];
        $langId_selected = $_POST['LanguageOfTeaching'];     
       
        //$school = $this->CourseModel->getSchool($langId_selected);
        //$department = $this->CourseModel->getDepartment($langId_selected);
        $LevelOfEducation = $this->CourseModel->getLevelOfEducation($langId_selected);
        //$Professor = $this->CourseModel->getProfessor();

        if ($_SESSION['admin_id'] == 4) { // if super admin
            // get all institutions
            $institution = $this->CourseModel->getInstitutions();
        } else {                
            // get specific institution of admin
            $institution = $this->CourseModel->getInstitution($_SESSION['managedInstitutionId']); 
        }  
          
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/CreateSchool2.php';
        require APP . 'views/templates/footer.php';
    }

    public function saveSchool()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not proper role
            header('location: ' . URL . 'home');
        }

        $_SESSION['g_message'] = '';   
  
        if(isset($_POST['finish_creation']))            
        {  
            if (preg_match('/(\p{Greek}|[a-z]|[A-Z]|\s|\d|\&|\*)+/u', $_POST['SchoolTitle'])     
                && !empty($_POST['SchoolTitle']) && !empty($_POST['institution'])
                && !empty($_POST['langId'])
                ){

                $this->CourseModel->CreateSchool($_POST["institution"], $_POST["SchoolTitle"], $_POST["langId"]);
                $_SESSION['g_message'] = "Success ";
                    
            }else{
                $_SESSION['g_message'] = 'Something went wrong!! Please try again.'; 

            }

            header('location: ' . URL . 'home');
        } 
    }


    // Create/save institution functions    

    public function CreateInstitution1()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $teaching_lang = $this->CourseModel->getTeachingLanguage();
        
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/CreateInstitution1.php';
        require APP . 'views/templates/footer.php';
    }

    public function CreateInstitution2()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        if (!isset($_POST['LanguageOfTeaching'])){
            header('location: ' . URL . 'AdminController/CreateSchool1');
        }

        $teaching_lang = $this->CourseModel->getTeachingLanguage();
        $teaching_lang_selected = $teaching_lang[$_POST['LanguageOfTeaching']]['LanguageOfTeaching'];
        $langId_selected = $_POST['LanguageOfTeaching'];     
        
        $LevelOfEducation = $this->CourseModel->getLevelOfEducation($langId_selected);  
            
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/CreateInstitution2.php';
        require APP . 'views/templates/footer.php';
    }

    public function saveInstitution()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $_SESSION['g_message'] = '';

        if(isset($_POST['finish_creation']))
        {  
            if (preg_match('/(\p{Greek}|[a-z]|[A-Z]|\s|\d|\&|\*)+/u', $_POST['InstitutionTitle'])
                && !empty($_POST['InstitutionTitle']) && !empty($_POST['langId'])  
                ){
                
                $this->CourseModel->CreateInstitution($_POST["InstitutionTitle"], $_POST["langId"]);
                $_SESSION['g_message'] = "Success ";
                    
            }else{
                $_SESSION['g_message'] = 'Something went wrong!! Please try again.'; 

            }

            header('location: ' . URL . 'home');
        } 
    }


    // Create/save department functions 

    public function CreateDepartment1()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $teaching_lang = $this->CourseModel->getTeachingLanguage();
        
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/CreateDepartment1.php';
        require APP . 'views/templates/footer.php';
    }

    public function CreateDepartment2()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        if (!isset($_POST['LanguageOfTeaching'])){
            header('location: ' . URL . 'AdminController/CreateDepartment1');
        }

        $teaching_lang = $this->CourseModel->getTeachingLanguage();
        $teaching_lang_selected = $teaching_lang[$_POST['LanguageOfTeaching']]['LanguageOfTeaching'];
        $langId_selected = $_POST['LanguageOfTeaching'];     
        
        $LevelOfEducation = $this->CourseModel->getLevelOfEducation($langId_selected);  

        // get all institutions
        $institution = $this->CourseModel->getInstitutions();
            
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/CreateDepartment2.php';
        require APP . 'views/templates/footer.php';
    }

    public function saveDepartment()     
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }
    
        $_SESSION['g_message'] = '';               

        if(isset($_POST['finish_creation']))      
        {  
            if (preg_match('/(\p{Greek}|[a-z]|[A-Z]|\s|\d|\&|\*)+/u', $_POST['DepartmentTitle'])
                && !empty($_POST['DepartmentTitle']) && !empty($_POST['institution1']) && !empty($_POST['institution2']) && !empty($_POST['langId'])  
                ){      
                             
                $this->CourseModel->CreateDepartment($_POST["DepartmentTitle"], $_POST["langId"], $_POST['institution1'], $_POST['institution2']);
                $_SESSION['g_message'] = "Success ";
                    
            }else{    
                $_SESSION['g_message'] = 'Κάτι πήγε στραβά! Παρακαλούμε δοκιμάστε ξανά.'; 

            }
            /*
            if ($_POST['institution2'] != 0) {

                if (preg_match('/(\p{Greek}|[a-z]|[A-Z]|\s|\d|\&|\*)+/u', $_POST['DepartmentTitle'])
                && !empty($_POST['DepartmentTitle']) && !empty($_POST['institution2']) && !empty($_POST['langId'])  
                ){   
                             
                $this->CourseModel->CreateDepartment($_POST["DepartmentTitle"], $_POST['institution2'], $_POST["langId"]);
                    
                }else{    
                    $_SESSION['g_message'] = 'Something went wrong!! Please try again.'; 

                }

            }*/

            header('location: ' . URL . 'home');
        } 
    }
    

    // Create/save course functions 

    public function CreateCourse1()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $teaching_lang = $this->CourseModel->getTeachingLanguage();
        
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/CreateCourse1.php';
        require APP . 'views/templates/footer.php';
    }

    public function CreateCourse2()   
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        if (!isset($_POST['LanguageOfTeaching'])){
            header('location: ' . URL . 'AdminController/CreateCourse1');
        }



        $teaching_lang = $this->CourseModel->getTeachingLanguage();
        $teaching_lang_selected = $teaching_lang[$_POST['LanguageOfTeaching']]['LanguageOfTeaching'];
        $langId_selected = $_POST['LanguageOfTeaching'];
       
        //$school = $this->CourseModel->getSchool($langId_selected);
        $department = $this->CourseModel->getDepartment($langId_selected);
        $LevelOfEducation = $this->CourseModel->getLevelOfEducation($langId_selected);
        $Professor = $this->CourseModel->getProfessor();  
        $courses = $this->CourseModel->getCourses();

        if ($_SESSION['admin_id'] == 1) { // if institution admin

            // get all institutions
            $second_institution = $this->CourseModel->getInstitutions(); 

            $stmt = $this->conn->prepare("SELECT * FROM school 
            WHERE InstitutionId = ?");
            $stmt->execute([$_SESSION['managedInstitutionId']]);    
            $school = $stmt->fetchAll(); // get the mysqli result

            $stmt = $this->conn->prepare("SELECT * FROM institution 
            WHERE Id = ?");
            $stmt->execute([$_SESSION['managedInstitutionId']]);    
            $institution = $stmt->fetchAll(); // get the mysqli result

            // get all schools (for 2nd school)
            $second_school = $this->CourseModel->getSchools(); 

            $stmt2 = $this->conn->prepare("SELECT * FROM department");
            $stmt2->execute();
            $department = $stmt2->fetchAll(); // get the mysqli result */

        } else if ($_SESSION['admin_id'] == 2) { // if school admin   

            // get specific school of admin
            //$school = $this->CourseModel->getSchool($_SESSION['managedSchoolId']); 

            $stmt = $this->conn->prepare("SELECT * FROM school   
            WHERE Id = ?");
            $stmt->execute([$_SESSION['managedSchoolId']]); 
            $school = $stmt->fetchAll(); // get the mysqli result

            // get all schools (for 2nd school)
            $second_school = $this->CourseModel->getSchools(); 

            foreach ($school as $Id => $row ) { 
                $InstitutionId = $row['InstitutionId'];
            } 

            $stmt1 = $this->conn->prepare("SELECT * FROM institution   
            WHERE Id = ?");       
            $stmt1->execute([$InstitutionId]); 
            $institution = $stmt1->fetchAll(); // get the mysqli result  

            $stmt2 = $this->conn->prepare("SELECT * FROM department");
            $stmt2->execute();
            $department = $stmt2->fetchAll(); // get the mysqli result */

            // get all institutions
            $second_institution = $this->CourseModel->getInstitutions(); 

        } else if ($_SESSION['admin_id'] == 3) { // if syllabus admin             

            // get all schools (for 1st school)
            $school = $this->CourseModel->getSchools(); 

            // get all schools (for 2nd school)
            $second_school = $this->CourseModel->getSchools(); 

            $stmt1 = $this->conn->prepare("SELECT * FROM department 
            WHERE Id = ?");
            $stmt1->execute([$_SESSION['managedSyllabusId']]); 
            $my_department = $stmt1->fetchAll(); // get the mysqli result */

            foreach ($my_department as $Id => $row1) {
                $InstitutionId = $row1['InstitutionId'];
            }     
            
            $stmt2 = $this->conn->prepare("SELECT * FROM institution");
            $stmt2->execute();      
            $institution = $stmt2->fetchAll(); // get the mysqli result

            // get all institutions
            $second_institution = $this->CourseModel->getInstitutions(); 

            $stmt3 = $this->conn->prepare("SELECT * FROM department");
            $stmt3->execute(); 
            $department = $stmt3->fetchAll(); // get the mysqli result */

        } else if ($_SESSION['admin_id'] == 4) { // if super admin

            // get all institutions
            $institution = $this->CourseModel->getInstitutions();

            // get all institutions (for 2nd institution)
            $second_institution = $this->CourseModel->getInstitutions(); 

            // get all schools (for 1st school)
            $school = $this->CourseModel->getSchools(); 

            // get all schools (for 2nd school)
            $second_school = $this->CourseModel->getSchools(); 

            $stmt2 = $this->conn->prepare("SELECT * FROM department");
            $stmt2->execute();      
            $department = $stmt2->fetchAll(); // get the mysqli result

        } 

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/CreateCourse2.php';
        require APP . 'views/templates/footer.php';
    }

    public function changeAdmin()
    {
        $AdminId = $_GET['AdminId'];  
        $ManagedDepartmentId = $_GET['ManagedDepartmentId'];
        $UserId = $_GET['UserId'];   
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/AdminPage/change_admin.php';
        require APP . 'views/templates/footer.php';
    }

    public function saveCourse()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        $_SESSION['g_message'] = '';

        if(isset($_POST['finish_creation']))
        {
            if (preg_match('/(\p{Greek}|[a-z]|[A-Z]|\s|\d|\&|\*)+/u', $_POST['LessonCode'])
                && preg_match('/(\p{Greek}|[a-z]|[A-Z]|\s|\d|\&|\*)+/u', $_POST['CourseTitle'])
                && !empty($_POST['school'])
                && !empty($_POST['school2'])
                && !empty($_POST['department'])  
                && !empty($_POST['department2'])  
                && !empty($_POST['LevelOfEducation'])
                && !empty($_POST['LessonCode'])   
                && !empty($_POST['Semester'])   
                && !empty($_POST['CourseTitle'])   
                && !empty($_POST['langId'])
                && !empty($_POST['InstitutionId']) 
                && !empty($_POST['InstitutionId2'])     
                ){
                    $_POST["ProfessorId"] = isset( $_POST["ProfessorId"] ) ? $_POST["ProfessorId"] : array();
                    $_POST["PrerequisiteId"] = isset( $_POST["PrerequisiteId"] ) ? $_POST["PrerequisiteId"] : array();

                $this->CourseModel->CreateCourse($_POST["school"],  $_POST["department"], $_POST["LevelOfEducation"], 
                    $_POST["LessonCode"],  $_POST["Semester"],  $_POST["CourseTitle"],
                    $_POST["Lectures"],$_POST["Laboratories"],$_POST["Tutorials"],$_POST["LabTutorials"],$_POST["Total"],$_POST["CreditUnits"],  
                    $_POST["langId"],  $_POST["Erasmus"],  $_POST["Content"], $_POST["ProfessorId"], $_POST["PrerequisiteId"], 
                    $_POST['InstitutionId'], $_POST['school2'], $_POST['InstitutionId2'], $_POST["department2"]);     
                    
            }else{    
                $_SESSION['g_message'] = 'Something went wrong!! Please try again.'; 

            }

            header('location: ' . URL . 'home');
        } 
    }      


    public function updateCourse()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }

        if(isset($_POST['finish_creation']))
        {
            if (preg_match('/(\p{Greek}|[a-z]|[A-Z]|\s|\d|\&|\*)+/u', $_POST['LessonCode'])
                && preg_match('/(\p{Greek}|[a-z]|[A-Z]|\s|\d|\&|\*)+/u', $_POST['CourseTitle'])
                && !empty($_POST['school'])
                && !empty($_POST['department'])
                && !empty($_POST['department2'])
                && !empty($_POST['LevelOfEducation'])
                && !empty($_POST['LessonCode'])
                && !empty($_POST['Semester'])
                && !empty($_POST['CourseTitle'])
                //&& !empty($_POST['Lectures'])
                //&& !empty($_POST['Content'])
                ){
                    $_POST["ProfessorId"] = isset( $_POST["ProfessorId"] ) ? $_POST["ProfessorId"] : array();
                    $_POST["PrerequisiteId"] = isset( $_POST["PrerequisiteId"] ) ? $_POST["PrerequisiteId"] : array();
                    $professor = ' ';
                    if ( !empty($_POST["Professor"]) )
                    {
                        $professor = $_POST["Professor"];
                    }

                $this->CourseModel->UpdateCourse($_POST["school"],  $_POST["department"], $_POST["department2"],  $_POST["LevelOfEducation"], 
                    $_POST["LessonCode"],  $_POST["Semester"],  $_POST["CourseTitle"],  $professor,
                    $_POST["Lectures"],$_POST["Laboratories"],$_POST["Tutorials"], $_POST["LabTutorials"],$_POST["Total"],
                    $_POST["CreditUnits"], $_POST["Erasmus"],  $_POST["Content"], $_POST["ProfessorId"],
                    $_POST["PrerequisiteId"], $_POST["CourseId"]);
            }else{
                $_SESSION['g_message'] = 'Something went wrong!! Please try again.'; 

            }
            header('location: ' . URL . 'home');
            
        } 

    }


    public function updateInstitution()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }



        if(isset($_POST['finish_creation']))
        {
            if ( preg_match('/(\p{Greek}|[a-z]|[A-Z]|\s|\d|\&|\*)+/u', $_POST['InstitutionName']) && !empty($_POST['InstitutionName']) && !empty($_POST['InstitutionId']) )
            {
                $UpdateInstitutionId = $_POST['InstitutionId'];   
                $InstitutionName = $_POST['InstitutionName']; 
                //$_POST["AdminId"] = isset( $_POST["AdminId"] ) ? $_POST["AdminId"] : array();
                //$_POST["PrerequisiteId"] = isset( $_POST["PrerequisiteId"] ) ? $_POST["PrerequisiteId"] : array();
                $sql = "UPDATE institution SET InstitutionName=? WHERE Id=?";
                $stmt= $this->conn->prepare($sql);
                $stmt->execute([$InstitutionName,$UpdateInstitutionId]);
                $_SESSION['g_message'] = "Success ";
            }else{
                $_SESSION['g_message'] = 'Something went wrong!! Please try again.'; 
            }
            header('location: ' . URL . 'home');
            
        } 

    }


    public function updateSchool()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }



        if(isset($_POST['finish_creation']))
        {
            if (preg_match('/(\p{Greek}|[a-z]|[A-Z]|\s|\d|\&|\*)+/u', $_POST['SchoolName']) && !empty($_POST['SchoolId']) && !empty($_POST['institution']) )
            {
                $UpdateInstitutionId = $_POST['institution']; 
                $SchoolId = $_POST['SchoolId'];   
                $SchoolName = $_POST['SchoolName']; 
                //$_POST["AdminId"] = isset( $_POST["AdminId"] ) ? $_POST["AdminId"] : array();
                //$_POST["PrerequisiteId"] = isset( $_POST["PrerequisiteId"] ) ? $_POST["PrerequisiteId"] : array();
                $sql = "UPDATE school SET InstitutionId=?, SchoolName=? WHERE Id=?";
                $stmt= $this->conn->prepare($sql);
                $stmt->execute([$UpdateInstitutionId,$SchoolName,$SchoolId]); 

                $_SESSION['g_message'] = "Success ";
            }else{
                $_SESSION['g_message'] = 'Something went wrong!! Please try again.'; 
            }
            header('location: ' . URL . 'home');
            
        } 

    }


    public function updateSyllabus()
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }



        if(isset($_POST['finish_creation']))
        {
            if (preg_match('/(\p{Greek}|[a-z]|[A-Z]|\s|\d|\&|\*)+/u', $_POST['SyllabusName']) && !empty($_POST['SyllabusId']) && !empty($_POST['institution']) )
            {
                $UpdateInstitutionId = $_POST['institution']; 
                $UpdateSecondInstitutionId = $_POST['institution2']; 
                $SyllabusId = $_POST['SyllabusId'];   
                $SyllabusName = $_POST['SyllabusName']; 
                //$_POST["AdminId"] = isset( $_POST["AdminId"] ) ? $_POST["AdminId"] : array();
                //$_POST["PrerequisiteId"] = isset( $_POST["PrerequisiteId"] ) ? $_POST["PrerequisiteId"] : array();
                $sql = "UPDATE department SET InstitutionId=?, SecondInstitutionId=?, DepartmentName=? WHERE Id=?";
                $stmt= $this->conn->prepare($sql);
                $stmt->execute([$UpdateInstitutionId,$UpdateSecondInstitutionId,$SyllabusName,$SyllabusId]);
                $_SESSION['g_message'] = "Success ";
            }else{
                $_SESSION['g_message'] = 'Something went wrong!! Please try again.'; 
            }
            header('location: ' . URL . 'home');
            
        } 
    } 
    
    /*

    JUST FOR TESTING QUERIES

    public function updateTest()   
    {



        $userName = 'ktzabara1';
        $firstName = 'katerina';
        $lastName = 'tzavara';
        $profileId = 1; 
        $UserId = 277;
        
        $sql = "UPDATE user SET UserName=?, FirstName=?, LastName=?, ProfileId=? WHERE Id=?";
        $stmt = $this->conn->prepare($sql);  
        $stmt->execute([$userName,$firstName,$lastName,$profileId,$UserId]);  
        $_SESSION['g_message'] = "Success ";
        header('location: ' . URL . 'home');   

    }*/

    public function updateUser()   
    {
        if( !isset( $_SESSION['logged'] ) || $_SESSION['user_profile'] != 3 ){ // if not logged in or not an admin
            header('location: ' . URL . 'home');
        }


        
        if (isset($_POST["UpdateUser"]) AND $_POST["UpdateUser"] == "UpdateUser") {

            if (isset($_POST["AdminProfileId"]) AND $_POST["AdminProfileId"] == "1" && ($_POST['ProfileId'] == 1 || $_POST['ProfileId'] == 3) ) {

                //Error handlers  
                //Check if input characters are valid
                if (preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['UserName'])
                    && preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['FirstName'])
                    && preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['LastName'])
                    && !empty($_POST['ProfileId']) && !empty($_POST['AdminProfileId']) && !empty($_POST['Institution'])
                    && !empty($_POST['UserId'])){

                    $UserId = $_POST['UserId']; 
                    
                    $sql = "UPDATE user SET UserName=?, FirstName=?, LastName=?, ProfileId=? WHERE Id=?";
                    $stmt = $this->conn->prepare($sql);  
                    $stmt->execute([$_POST['UserName'],$_POST['FirstName'],$_POST['LastName'],$_POST['ProfileId'],$UserId]);  

                    // check if the user is already an admin
                    $stmt1 = $this->conn->prepare("SELECT Id FROM admin WHERE UserId = ?");
                    $stmt1->execute([$UserId]); 
                    $checkIfAdmin = $stmt1->fetchAll(); // get the mysqli result

                    // if admin, update user data in admin table   
                    if( $stmt1->rowCount() ) { 

                        foreach ($checkIfAdmin as $Id => $row) {  
                            $IsAdmin = $row['Id']; 
                        }
            
                        if($IsAdmin) {   
                            $sql2 = "UPDATE admin SET AdminId=?, ManagedDepartmentId=? WHERE UserId=?";
                            $stmt2 = $this->conn->prepare($sql2);
                            $stmt2->execute([$_POST['AdminProfileId'],$_POST['Institution'],$_POST['UserId']]); 
                            $_SESSION['g_message'] = "Success ";
                        }
                           
                    } else { // insert user in admin table 

                        try {      
                            // prepare sql and bind parameters
                            $stmt2 = $this->conn->prepare("INSERT INTO `admin` (UserId, AdminId, ManagedDepartmentId) 
                            VALUES (:UserId, :AdminId, :ManagedDepartmentId)");    
                                  
                            $stmt2->bindParam(':UserId', $UserId);   
                            $stmt2->bindParam(':AdminId', $_POST['AdminProfileId']);  
                            $stmt2->bindParam(':ManagedDepartmentId', $_POST['Institution']);      
                         
                            // insert a row   
                            $stmt2->execute();
                            $_SESSION['g_message'] = "Success ";
                        } catch(PDOException $e) {
                            $_SESSION['g_message'] = 'There is an error. Please try again  '; 
                        } 

                    }  

                } else {
                    $_SESSION['g_message'] = 'There is an error. Please try again  '; 
                }
                header('location: ' . URL . 'home');      
            
            } else if (isset($_POST["AdminProfileId"]) AND $_POST["AdminProfileId"] == "2" && ($_POST['ProfileId'] == 1 || $_POST['ProfileId'] == 3)) {

                //Error handlers  
                //Check if input characters are valid
                if (preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['UserName'])
                    && preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['FirstName'])
                    && preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['LastName'])
                    && !empty($_POST['ProfileId']) && !empty($_POST['AdminProfileId']) && !empty($_POST['School'])
                    && !empty($_POST['UserId'])){

                    $UserId = $_POST['UserId'];    
                    
                    $sql = "UPDATE user SET UserName=?, FirstName=?, LastName=?, ProfileId=? WHERE Id=?";
                    $stmt = $this->conn->prepare($sql);  
                    $stmt->execute([$_POST['UserName'],$_POST['FirstName'],$_POST['LastName'],$_POST['ProfileId'],$UserId]);  

                    // check if the user is already an admin
                    $stmt1 = $this->conn->prepare("SELECT Id FROM admin WHERE UserId = ?");
                    $stmt1->execute([$UserId]); 
                    $checkIfAdmin = $stmt1->fetchAll(); // get the mysqli result

                    // if admin, update user data in admin table   
                    if( $stmt1->rowCount() ) { 

                        foreach ($checkIfAdmin as $Id => $row) {  
                            $IsAdmin = $row['Id']; 
                        }
            
                        if($IsAdmin) {   
                            $sql2 = "UPDATE admin SET AdminId=?, ManagedDepartmentId=? WHERE Id=?";
                            $stmt2 = $this->conn->prepare($sql2);
                            $stmt2->execute([$_POST['AdminProfileId'],$_POST['School'],$_POST['UserId']]); 
                            $_SESSION['g_message'] = "Success ";
                        }
                        
                    } else { // insert user in admin table 

                        try {      
                            // prepare sql and bind parameters
                            $stmt2 = $this->conn->prepare("INSERT INTO `admin` (UserId, AdminId, ManagedDepartmentId) 
                            VALUES (:UserId, :AdminId, :ManagedDepartmentId)");    
                                  
                            $stmt2->bindParam(':UserId', $UserId);   
                            $stmt2->bindParam(':AdminId', $_POST['AdminProfileId']);  
                            $stmt2->bindParam(':ManagedDepartmentId', $_POST['School']);      
                         
                            // insert a row   
                            $stmt2->execute();  
                            $_SESSION['g_message'] = "Success ";
                        } catch(PDOException $e) {
                            $_SESSION['g_message'] = 'There is an error. Please try again  '; 
                        } 

                    }   

                } else {
                    $_SESSION['g_message'] = 'There is an error. Please try again  '; 
                }
                header('location: ' . URL . 'home');
            
            } else if (isset($_POST["AdminProfileId"]) AND $_POST["AdminProfileId"] == "3" && ($_POST['ProfileId'] == 1 || $_POST['ProfileId'] == 3)) {

                //Error handlers  
                //Check if input characters are valid
                if (preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['UserName'])
                    && preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['FirstName'])
                    && preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['LastName'])
                    && !empty($_POST['ProfileId']) && !empty($_POST['AdminProfileId']) && !empty($_POST['Department'])
                    && !empty($_POST['UserId'])){

                    $UserId = $_POST['UserId'];    
                    
                    $sql = "UPDATE user SET UserName=?, FirstName=?, LastName=?, ProfileId=? WHERE Id=?";
                    $stmt = $this->conn->prepare($sql);  
                    $stmt->execute([$_POST['UserName'],$_POST['FirstName'],$_POST['LastName'],$_POST['ProfileId'],$UserId]);  

                    // check if the user is already an admin
                    $stmt1 = $this->conn->prepare("SELECT Id FROM admin WHERE UserId = ?");
                    $stmt1->execute([$UserId]); 
                    $checkIfAdmin = $stmt1->fetchAll(); // get the mysqli result

                    // if admin, update user data in admin table   
                    if( $stmt1->rowCount() ) {      

                        foreach ($checkIfAdmin as $Id => $row) {  
                            $IsAdmin = $row['Id']; 
                        }
            
                        if($IsAdmin) {   
                            $sql2 = "UPDATE admin SET AdminId=?, ManagedDepartmentId=? WHERE Id=?";
                            $stmt2 = $this->conn->prepare($sql2);
                            $stmt2->execute([$_POST['AdminProfileId'],$_POST['Department'],$_POST['UserId']]); 
                            $_SESSION['g_message'] = "Success ";
                        }
                        
                    } else { // insert user in admin table 

                        try {      
                            // prepare sql and bind parameters
                            $stmt2 = $this->conn->prepare("INSERT INTO `admin` (UserId, AdminId, ManagedDepartmentId) 
                            VALUES (:UserId, :AdminId, :ManagedDepartmentId)");    
                                  
                            $stmt2->bindParam(':UserId', $UserId);   
                            $stmt2->bindParam(':AdminId', $_POST['AdminProfileId']);  
                            $stmt2->bindParam(':ManagedDepartmentId', $_POST['Department']);      
                         
                            // insert a row   
                            $stmt2->execute();  
                            $_SESSION['g_message'] = "Success ";
                        } catch(PDOException $e) {
                            $_SESSION['g_message'] = 'There is an error. Please try again  '; 
                        } 

                    }   

                } else {
                    $_SESSION['g_message'] = 'There is an error. Please try again  '; 
                }
                header('location: ' . URL . 'home');
            
            } else if (isset($_POST["AdminProfileId"]) AND $_POST["AdminProfileId"] == "4" && ($_POST['ProfileId'] == 1 || $_POST['ProfileId'] == 3)) {   

                //Error handlers  
                //Check if input characters are valid
                if (preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['UserName'])
                    && preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['FirstName'])
                    && preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['LastName'])   
                    && !empty($_POST['ProfileId']) && !empty($_POST['AdminProfileId'])){     

                    $UserId = $_POST['UserId'];    
                
                    $sql = "UPDATE user SET UserName=?, FirstName=?, LastName=?, Id=? WHERE Id=?";
                    $stmt = $this->conn->prepare($sql);  
                    $stmt->execute([$_POST['UserName'],$_POST['FirstName'],$_POST['LastName'],$_POST['ProfileId'],$UserId]);  

                    // check if the user is already an admin
                    $stmt1 = $this->conn->prepare("SELECT Id FROM admin WHERE UserId = ?");
                    $stmt1->execute([$UserId]);   
                    $checkIfAdmin = $stmt1->fetchAll(); // get the mysqli result

                    // if admin, update user data in admin table       
                    if( $stmt1->rowCount() ) {      

                        foreach ($checkIfAdmin as $Id => $row) {  
                            $IsAdmin = $row['Id'];   
                        }  
            
                        if($IsAdmin) {   
                            $sql2 = "UPDATE admin SET AdminId=?, ManagedDepartmentId=? WHERE UserId=?";
                            $stmt2 = $this->conn->prepare($sql2);
                            $stmt2->execute([4,0,$_POST['UserId']]); 
                            $_SESSION['g_message'] = "Success ";   
                        }
                        
                    } else { // insert user in admin table 

                        try {          
                            // prepare sql and bind parameters
                            $stmt2 = $this->conn->prepare("INSERT INTO `admin` (UserId, AdminId, ManagedDepartmentId) 
                            VALUES (:UserId, :AdminId, :ManagedDepartmentId)");   
                            
                            $AdminProfileId = $_POST['AdminProfileId']; 
                            $ManagedDepartmentId = 0;  
                                    
                            $stmt2->bindParam(':UserId', $UserId);   
                            $stmt2->bindParam(':AdminId', $AdminProfileId);  
                            $stmt2->bindParam(':ManagedDepartmentId', $ManagedDepartmentId);       
                            
                            // insert a row   
                            $stmt2->execute();  
                            $_SESSION['g_message'] = "Success ";
                        } catch(PDOException $e) {
                            $_SESSION['g_message'] = 'There is an error. Please try again  '; 
                        } 

                    }       
                
                } else {
                    $_SESSION['g_message'] = 'There is an error. Please try again  '; 
                }
                header('location: ' . URL . 'home');            
               
            } else if (isset($_POST["ProfileId"]) && $_POST["ProfileId"] == "2") {  // update to professor    

                //Error handlers   
                //Check if input characters are valid
                if (preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['UserName'])
                    && preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['FirstName'])
                    && preg_match('/^[\p{Greek}\s\d a-zA-Z]+$/u', $_POST['LastName'])
                    && !empty($_POST['ProfileId'])){    

                    $UserId = $_POST['UserId'];           
              
                    $sql = "UPDATE user SET UserName=?, FirstName=?, LastName=?, ProfileId=? WHERE Id=?";   
                    $stmt = $this->conn->prepare($sql);  
                    $stmt->execute([$_POST['UserName'],$_POST['FirstName'],$_POST['LastName'],$_POST["ProfileId"],$UserId]);  

                    // check if the user is already an admin
                    $stmt1 = $this->conn->prepare("SELECT Id, AdminId FROM admin WHERE UserId = ?");
                    $stmt1->execute([$UserId]);      
                    $checkIfAdmin = $stmt1->fetchAll(); // get the mysqli result

                    // if admin, delete user data from admin table       
                    if( $stmt1->rowCount() ) {         

                        foreach ($checkIfAdmin as $Id => $row) {  
                            $IsAdmin = $row['Id'];   
                            $AdminId = $row['AdminId'];
                        }    
                
                        if($IsAdmin) {         
                            $sql2 = "DELETE FROM admin WHERE UserId=? AND AdminId=?";
                            $stmt2 = $this->conn->prepare($sql2);
                            $stmt2->execute([$_POST['UserId'],$AdminId]); 
                            $_SESSION['g_message'] = "Success ";   
                        }  
                        
                    }  
                    $_SESSION['g_message'] = "Success ";   
                    
                } else {
                    $_SESSION['g_message'] = 'There is an error. Please try again  '; 
                }  
                header('location: ' . URL . 'home');

            } else{   
                $_SESSION['g_message'] = 'There is an error. Please try again  '; 
                header('location: ' . URL . 'error1');

            }    

        } else {
            //$_SESSION['g_message'] = 'There is an error. Please try again  '; 
            header('location: ' . URL . 'error1');
        }
            
         

    }


    
}
