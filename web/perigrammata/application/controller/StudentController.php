<?php

class StudentController extends Controller{
    
    public function StudentPage1()
    {
        $MsgId = $_GET['MsgId'];
        if ($MsgId==0){
            $_SESSION['g_message'] = "Error, you must choose at least one of the general abilities";
        }
        $teaching_lang = $this->CourseModel->getTeachingLanguage();
      

        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/StudentPage/StudentPage1.php';
        require APP . 'views/templates/footer.php';

    }
    public function StudentPage2()
    {
        if (!isset($_POST['languageOfTeaching'])){
            header('location: ' . URL . 'StudentController/StudentPage1?MsgId=1');
        }

        

        $teaching_lang = $this->CourseModel->getTeachingLanguage();
        $teaching_lang_selected = $teaching_lang[$_POST['languageOfTeaching']]['LanguageOfTeaching'];
        $langId_selected = $_POST['languageOfTeaching'];
       

        $department = $this->CourseModel->getDepartment($langId_selected);
        $skills = $this->CourseModel->getSkills($langId_selected);
        $courses = $this->CourseModel->getCourses();
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/StudentPage/StudentPage2.php';
        require APP . 'views/templates/footer.php';

    }

    public function StudentPage4()
    {
        
        $numberOfCourses=$_POST['numOfCourses'] ;
        $courses_selected=array();
        $courses_id_selected=array();
        $outcomes=array();
        $i=0;
        $flag=0;
        for ($x = 1; $x <= $numberOfCourses; $x++) {
            if(isset($_POST['courses_'.$x.''])){
                // is set
                $flag=1;
                // echo $_POST['courses_'.$x.''];
                $courses_id_selected[$i]=$_POST['courses_'.$x.''];
                $courses_selected[$i]=$this->CourseModel->getCourse($_POST['courses_'.$x.'']);
                // $outcomes[$i] = $this->CourseModel->getCourseOutcomes1($_POST['courses_'.$x.'']);
                $i++;
            }
        }
        
        if ($flag!=1){
            header('location: ' . URL . 'StudentController/StudentPage1?MsgId='.$flag);
        }
        $courses_selected__=array();
        $abet_selected__=array();
        $abet_selected1__=array();
        $j=0;
        $s=0;
        $k=0;

        // for ($x = 0; $x < count($courses_id_selected); $x++) {
        //     echo $courses_id_selected[$x].'<br>';
        // }
        
        for ($x = 0; $x < count($courses_id_selected); $x++) {
          
            $courses_sentence= $this->CourseModel->getCourseOutcomes($courses_id_selected[$x]);
            $AbetScoreByCourse = $this->CourseModel->getAbetScoreByCourse($courses_id_selected[$x]);
            $AbetScoreByCourse1 = $this->CourseModel->getAbetScoreByCourse1($courses_id_selected[$x]);
            
            foreach ($courses_sentence as  $Id_ => $row_){  
                $courses_selected__[$j] =$row_;
                $j++;
            }
            foreach ($AbetScoreByCourse as  $Id_ => $row_){  
                $abet_selected__[$s] =$row_;
                // echo $row_['c1'] .'<br>' ;
                $s++;
            }
            foreach ($AbetScoreByCourse1 as  $Id_ => $row_){  
                $abet_selected1__[$k] =$row_;
                // echo $row_['c1'] .'<br>' ;
                $k++;
            }
       
       
        }
        
        // echo count($abet_selected__).'<br>'.count($abet_selected1__).'<br>';
        // echo $j.' '.$s.' '.$k ;

        $AbetScore = $this->CourseModel->getAbetScore();
        // load views
        require APP . 'views/templates/header.php';
        require APP . 'views/StudentPage/StudentPage5.php';
        require APP . 'views/templates/footer.php';

    }


    public function StudentPage3()
    {

        if(isset($_POST['stud_choice']) && $_POST['stud_choice']==1){
            $flag=0;
            // skill_1 ,...,skill_22 and skill_46 for greek
            // skill_23 ,...,skill_45 and skill_46 for english
            // TOTAL : 46 GENERAL SKILLS 
            $skills_title=array();
            $skills_id=array();
            $i=0;
            for ($x = 1; $x <= 46; $x++) {
                if(isset($_POST['skill_'.$x.''])){
                    // is set
                    $flag=1;
                    $skills_title[$i]=$this->CourseModel->getSkill_($_POST['skill_'.$x.'']);
                    $skills_id[$i]=$_POST['skill_'.$x.''];
                    $i++;
                }
            }
            if ($flag!=1){
                header('location: ' . URL . 'StudentController/StudentPage1?MsgId='.$flag);
            }
            
            
            $num_of_general_abilities=$i;
            $teaching_lang = $this->CourseModel->getTeachingLanguage();
            $department_selected = $_POST['department_'] ;  
    
            $j=0;
            $l=0;
            $courses_with_skills=array();
            $optional_courses_with_skills=array();
            for ($x = 0; $x < $i; $x++) {

                $skills=$skills_id[$x];
                $course_details =$this->CourseModel->getSkillsByCourse($department_selected,$skills);
                // var_dump(count($course_details));

                foreach ($course_details as  $Id_ => $row_){  
                    $courses_with_skills[$j] =$row_;
                    $j++;
                }

                $optional_course_details =$this->CourseModel->getSkillsByOptionalCourse($department_selected,$skills);
                foreach ($optional_course_details as  $Id => $row ){  
                    $optional_courses_with_skills[$l] =$row;
                    $l++;
                }
            }

            $department_ = $this->CourseModel->getDepartment_($department_selected);
        
            // load views
            require APP . 'views/templates/header.php';
            require APP . 'views/StudentPage/StudentPage3.php';
            require APP . 'views/templates/footer.php';
        }//end else 1
        else if (isset($_POST['stud_choice']) && $_POST['stud_choice']==2){


            $department_selected = $_POST['department_'] ;
            $courses = $this->CourseModel->getCoursesbyDept($department_selected);
            $department_ = $this->CourseModel->getDepartment_($department_selected);
            // load views
            require APP . 'views/templates/header.php';
            require APP . 'views/StudentPage/StudentPage4.php';
            require APP . 'views/templates/footer.php';


        } //end else 2
        else if (isset($_POST['stud_choice']) && $_POST['stud_choice']==3){
            
            header('location: ' . URL . 'StudentController/ManageStudentsCourses?department_=' . $_POST['department_']);
        }
        else{
            header('location: ' . URL . 'StudentController/StudentPage1?MsgId=0');
        }



    }//end function

    public function ManageStudentsCourses()
    {
        
        $department_selected = $_GET['department_'] ;
        $department_ = $this->CourseModel->getDepartment_($department_selected);
        require APP . 'views/templates/header.php';
        require APP . 'views/StudentPage/ManageStudentsCourses.php';
        require APP . 'views/templates/footer.php';

    }

    public function CoursesEnrollement(){
        $department_selected = $_GET['department_'] ;
        $courses = $this->CourseModel->getCoursesbyDept($department_selected);
        $department_ = $this->CourseModel->getDepartment_($department_selected);
        
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
        
        //emfanizei mono ta mathimata pou den exei kanei eggrafh
        $studentId = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT Id,CourseTitle,LessonCode,Semester 
                FROM courses 
                WHERE DepartmentId=? and Id not in (select CourseId 
                                                    from Student_is_enrolled
                                                    where studentid=? )");
        $stmt->execute([$department_selected, $studentId]); 
        $courses = $stmt->fetchAll(); 
        
        require APP . 'views/templates/header.php';
        require APP . 'views/StudentPage/CoursesEnrollement.php';
        require APP . 'views/templates/footer.php';

    }

    public function SumbitStudentCourses(){
        
        $numberOfCourses=$_POST['numOfCourses'] ;
        $courses_selected=array();
        $courses_id_selected=array();
        $outcomes=array();
        $i=0;
        $flag=0;
        for ($x = 0; $x <= $numberOfCourses; $x++) {
            if(isset($_POST['courses_'.$x.''])){
                // is set
                $flag=1;
                // echo $_POST['courses_'.$x.''];
                $courses_id_selected[$i]=$_POST['courses_'.$x.''];
                $courses_selected[$i]=$this->CourseModel->getCourse($_POST['courses_'.$x.'']);
                // $outcomes[$i] = $this->CourseModel->getCourseOutcomes1($_POST['courses_'.$x.'']);
                $i++;
            }
        }
        
        $ptr = count($courses_id_selected);

        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        for($y=0; $y < $ptr; $y++){
            $date = date("Y/m/d h:i:s");
            $studentId = $_SESSION['user_id'];
            $stmt = $conn->prepare("INSERT INTO perigrammata_db.Student_is_enrolled 
                            VALUES (?, ?, ?, 0 ,null )");  
            //$stmt->execute();         
            $stmt->execute([$studentId,$courses_id_selected[$y],$date]);
        }

        
        header('location: ' . URL . 'StudentController/CoursesEnrollement?department_=' . $_GET['department_']);
    }

    public function CoursePage()
    {
        //echo $_GET['courseId'];
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        $courseId = $_GET['courseId'];
        $stmt = $conn->prepare("SELECT * 
                FROM courses
                where Id= ?");
        $stmt->execute([$courseId]);
        $course = $stmt->fetchAll();
    
        $stmt = $conn->prepare("SELECT departmentName 
                FROM department
                where Id= ?");
        $stmt->execute([$course[0]['DepartmentId']]);
        $department = $stmt->fetchAll();

        $stmt = $conn->prepare("SELECT * 
                FROM course_has_professor
                where CourseId= ?");
        $stmt->execute([$courseId]);
        $professors = $stmt->fetchAll();

        $studentId = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT * 
                FROM students_grades
                where courseId= ? and studentId= ?");
        $stmt->execute([$courseId, $studentId]);
        $grades = $stmt->fetchAll();
        
        $stmt= $conn->prepare("SELECT distinct(method_number)
                from course_has_category
                where CourseId=?");
        $stmt->execute([$courseId]);
        $methodNumber = $stmt->fetchAll();
        //var_dump($methodNumber);

        $stmt= $conn->prepare("SELECT method_number, Percentage ,CategoryId, SubcategoryId1, SubcategoryId2 , SubcategoryId3, SubcategoryId4
                from course_has_category
                where CourseId=?");
        $stmt->execute([$courseId]);
        $methods = array();
        while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
            $methods[] = $row;
        }


        $stmt = $conn->prepare("SELECT CategoryId , q.CategoryName 
        FROM course_has_category , assessment_categories as q
        where CourseId= ? and CategoryId=q.Id");
        $stmt->execute([$courseId]);
        $categories = array();
        while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
            //var_dump($row);
            $categories[$row['CategoryId']]= $row['CategoryName'];
        }
        //var_dump($categories);


        require APP . 'views/templates/header.php';
        require APP . 'views/StudentPage/CoursePage.php';
        require APP . 'views/templates/footer.php';
        
    }

    public function SubmitMethod()
    {//echo $_GET['courseId'];
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        $courseId = $_GET['courseId'];
        $method_number = $_POST['method_number'];

        //get all categories for the specific method
        $stmt = $conn->prepare(" SELECT categoryId
                    FROM course_has_category
                    where CourseId=? and method_number= ?");
        $stmt->execute([$courseId, $method_number]);
        $categoriesSel = $stmt->fetchAll(); 

        //get all assessment_number for each category for the specific method
        $stmt = $conn->prepare(" SELECT AssessmentId , AssessmentNumber
                            FROM number_of_assessment
                            where CourseId=? and AssessmentMethod= ? ");
        $stmt->execute([$courseId, $method_number]);
        $categoriesAndNumbersSel = $stmt->fetchAll(); 

        //setup students_grades table to null after the student has selected a method
        $studentId =  $_SESSION['user_id']; 
        foreach ($categoriesAndNumbersSel as $Id=>$category)
        {
            $studentId =  $_SESSION['user_id']; 
            $stmt = $conn->prepare(" INSERT INTO students_grades
                    VALUES (?,?,?,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,?,NULL,NULL,NULL,?) ");
            $stmt->execute([$studentId , $courseId, $category['AssessmentId'],$method_number,$category['AssessmentNumber']]);
        }

        $stmt = $conn->prepare("UPDATE Student_is_enrolled
                                SET course_method = ?
                                where CourseId = ? and StudentId =?");
        $stmt->execute([ $method_number , $courseId , $_SESSION['user_id']]);

        header ('location: ' . URL . 'StudentController/CoursePage?courseId=' . $courseId);
    }

    //api for ajax to get assessment for a student
    public function get_assessments()
    { 
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        $data = array();
        
        //get all assessments
        if($_GET['language']=='gr')
        {
            $query= $conn->prepare("SELECT distinct t.categoryName ,categoryId
                        FROM students_grades
                        inner join assessment_categories as t on categoryId=t.Id
                        WHERE courseId= ? and studentId = ?");
            $query->execute([$_GET["courseId"], $_GET["studentId"]]);
        }else
        {
            $query= $conn->prepare("SELECT distinct categoryName ,t.categoryId
                        FROM assessment_categories
                        inner join students_grades as t on t.categoryId + 8=Id 
                        WHERE courseId= ? and studentId = ?");
            $query->execute([$_GET["courseId"], $_GET["studentId"]]);
        }
        $result=$query->fetchAll();

        foreach($result as $row)
        {
            $data[] = array(
                'categoryName' => $row["categoryName"],
                'categoryId' => $row["categoryId"]
            );
        }

        echo json_encode($data);


    }

    public function CoursesList(){

        $department_selected = $_GET['department_'] ;
        $department_ = $this->CourseModel->getDepartment_($department_selected);
        
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        $studentId = $_SESSION['user_id'];

        $stmt = $conn->prepare (" SELECT courseid , d.coursetitle ,d.LessonCode ,enrollementAccepted
                        from Student_is_enrolled
                        inner join courses as d on courseid=d.id
                        where studentid=?");
        $stmt->execute([$studentId]); 
        $courses = $stmt->fetchAll();

        require APP . 'views/templates/header.php';
        require APP . 'views/StudentPage/CoursesList.php';
        require APP . 'views/templates/footer.php';


    }

    public function fhtml(){
           
        $Course = $this->CourseModel->getCourse($_GET['CourseId']);
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
        // $CourseAssessment1 = $this->CourseModel->getCourseAssessment1($_GET['CourseId']);

        require APP . 'views/templates/header.php';
        require APP . 'views/StudentPage/fhtml.php';
        require APP . 'views/templates/footer.php';

    }



}
