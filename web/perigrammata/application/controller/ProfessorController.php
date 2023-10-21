<?php

class ProfessorController extends Controller{
    
    
// start
   
    public function LearningOutcomesAbet2(){

        $Course = $this->CourseModel->getCourse($_GET['CourseId']);
        $CourseOutcome = $this->CourseModel->getCourseOutcomes($_GET['CourseId']);
        $TranslatedOutcomes = $this->CourseModel->getCourseAbetOutcomesWithoutSkills($_GET['CourseId']);
        $CoursePercent = $this->CourseModel->getDocumentedCoursePer($_GET['CourseId']);

        $skills = $this->CourseModel->getSkills($Course['LangId']);
        $CourseSkills = $this->CourseModel->getCourseSkills($_GET['CourseId']);
        $CourseSkills_1 = $this->CourseModel->getCourseSkills1($_GET['CourseId']);

        $checkSkill= $this->CourseModel->checkSkill($_GET['CourseId']);
        
        $CoursePercent = $this->CourseModel->getDocumentedCoursePer($_GET['CourseId']);
        $CourseEnOutcomes = $this->CourseModel->getEnOutcomes2();
        $CourseElOutcomes = $this->CourseModel->getAllOutcomes();
        
        $LangId = $Course['LangId'];
        $Version = 2;
    
        require APP . 'views/templates/header.php';
        require APP . 'views/ProfessorPage/AbetCriterion1.php';
        require APP . 'views/templates/footer.php';
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
        
        header('location: ' . URL . 'ProfessorController/LearningOutcomesAbet2?CourseId='.$_GET['CourseId']);
        // require APP . 'views/templates/header.php';
        // require APP . 'views/ProfessorPage/AbetCriterion1.php';
        // require APP . 'views/templates/footer.php';    
    }


    public function SaveAbetOutcomes(){
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
                $abetTotal[$i] = number_format((+$abetTotal[$i]/100),2);
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

        header('location: ' . URL . 'ProfessorController/LearningOutcomesAbet2?CourseId='.$CourseId);  
    }
// end

    public function ProfChoices()
    {
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        //echo $_GET['CourseId'];
        $courseID = $_GET['CourseId'];
        $stmt = $conn->prepare("SELECT ProfessorId 
        FROM perigrammata_db.course_has_professor 
        WHERE CourseId = ?");    
        $stmt->execute([$courseID]); 
        $professors = $stmt->fetchAll();
        $_SESSION['choice'] = 0;

        $courseID = $_GET['CourseId'];
        $stmt = $conn->prepare("SELECT CourseTitle, LessonCode
        FROM perigrammata_db.courses
        WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        //if he is a professor in the course, he can evaluate everything
        $stmt = $conn->prepare("SELECT RoleId
                                FROM course_has_professor
                                WHERE CourseId = ? AND ProfessorId =?");    
        $stmt->execute([$courseID , $_SESSION['user_id']]); 
        $role = $stmt->fetchAll(); 

        if($role[0]['RoleId']==0) //professor access all methods
        {
            require APP . 'views/templates/header.php';
            require APP . 'views/ProfessorPage/ProfChoices.php';
            //require APP . 'views/ProfessorPage/newUI.php';
            require APP . 'views/templates/footer.php';
        }
        else{ // if he is a partner, check their jurisdiction

            header('location: ' . URL . 'ProfessorController/ChooseMethod?CourseId=' . $_GET['CourseId']);
        }
    }

    public function Evaluation()
    {
        
        // Get the page content
        $page_content = file_get_contents('NotAllowed.php');
        // Return the content as JSON
        echo json_encode(array('content' => $page_content));
    }

    public function ADMIN()
    {
        require APP . 'views/templates/header1.php';
        require APP . 'views/ProfessorPage/Admin.php';
        require APP . 'views/templates/footer1.php';
    }

    public function ProfChoice()
    {
        if(isset($_POST['submit'])){
            $_SESSION['choice'] = $_POST['choice'];
            
            $db_username = 'perigrammata_db';
            $db_password = '@ad1p_c0urses_29_01_2020';
            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

         }
         $courseID= $_GET['CourseId'];
            if($_SESSION['choice'] == "1"){  //manage grades

                $stmt = $conn->prepare(" SELECT RoleId
                            FROM course_has_professor
                            where ProfessorId =? and CourseId = ?
                    ");
                $stmt -> execute([$_SESSION['user_id'] , $_GET['CourseId']]);
                $role = $stmt->fetchAll();

                header('location: ' . URL . 'ProfessorController/ChooseMethod?CourseId=' . $_GET['CourseId']);
                
            }
            elseif($_SESSION['choice'] == "2"){    //Manage professors
                $stmt = $conn->prepare(" SELECT RoleId
                            FROM course_has_professor
                            where ProfessorId =? and CourseId = ?
                    ");
                $stmt -> execute([$_SESSION['user_id'] , $_GET['CourseId']]);
                $role = $stmt->fetchAll();
                
                if($role[0]['RoleId'] == 0 )
                {
                    header('location: ' . URL . 'ProfessorController/ManageCrew?CourseId=' .  $_GET['CourseId']);
                }
                else
                {
                    require APP . 'views/templates/header.php';
                    require APP . 'views/ProfessorPage/NotAllowed.php';
                    require APP . 'views/templates/footer.php';
                }
            }
            elseif($_SESSION['choice'] == "3"){    //Manage requests
                $stmt = $conn->prepare(" SELECT RoleId
                            FROM course_has_professor
                            where ProfessorId =? and CourseId = ?
                    ");
                $stmt -> execute([$_SESSION['user_id'] , $_GET['CourseId']]);
                $role = $stmt->fetchAll();
                
                header('location: ' . URL . 'ProfessorController/ManageRequests?CourseId=' . $_GET['CourseId']);
                
            }elseif($_SESSION['choice'] == "4"){  //manage grades

                $stmt = $conn->prepare(" SELECT RoleId
                            FROM course_has_professor
                            where ProfessorId =? and CourseId = ?
                    ");
                $stmt -> execute([$_SESSION['user_id'] , $_GET['CourseId']]);
                $role = $stmt->fetchAll();

                header('location: ' . URL . 'ProfessorController/ChooseMethod?CourseId=' . $_GET['CourseId']);
                
            }
    }

    public function ManageCrew()
    { 
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        $courseID = $_GET['CourseId'];

        $stmt = $conn->prepare("SELECT RoleId
                FROM course_has_professor
                WHERE CourseId = ? AND ProfessorId =?");    
        $stmt->execute([$courseID , $_SESSION['user_id']]); 
        $role = $stmt->fetchAll(); 

        if(isset( $_SESSION['logged'] ) && $role[0]['RoleId']==0)  //only professor can manage crew members
        {
            $db_username = 'perigrammata_db';
            $db_password = '@ad1p_c0urses_29_01_2020';
            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
            
            //get enrolled professors
            $stmt= $conn->prepare("SELECT ProfessorId ,u.firstname , u.lastname ,roleId
                        FROM perigrammata_db.course_has_professor
                        inner join user as u on ProfessorId = u.id
                        where courseid=? and RoleId=0");
            $stmt->execute([$courseID]);
            $professorsId = array();
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                $professorsId[$row['ProfessorId']]= $row['firstname'] ." ". $row['lastname'] ;
            }

            //get all possible professors
            $stmt= $conn->prepare("SELECT Id, firstname , lastname
                        FROM user
                        where profileid=2 or profileid=3
                        order by lastname asc");
            $stmt->execute();
            $professor = array();
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                $professor[$row['Id']]= $row['firstname'] ." ". $row['lastname'] ;
            }

            //get enrolled partners
            $stmt= $conn->prepare("SELECT ProfessorId ,u.firstname , u.lastname ,roleId
                        FROM perigrammata_db.course_has_professor
                        inner join user as u on ProfessorId = u.id
                        where courseid=? and RoleId=1");
            $stmt->execute([$courseID]);
            $partners = array();
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                $partners[$row['ProfessorId']]= $row['firstname'] ." ". $row['lastname'] ;
            }
            //var_dump($partners);

            //get all possible partners
            $stmt= $conn->prepare("SELECT ProfessorId ,u.firstname , u.lastname ,roleId
                        FROM perigrammata_db.course_has_professor
                        inner join user as u on ProfessorId = u.id
                        where courseid=? and RoleId=1");
            $stmt->execute([$courseID]);
            $partnersID = array();
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                $partnersID[$row['ProfessorId']]= $row['firstname'] ." ". $row['lastname'] ;
            }

            //get course's methods

            $stmt= $conn->prepare("SELECT distinct(method_number)
                                    from course_has_category
                                    where CourseId=?");
            $stmt->execute([$courseID]);
            $methodNumber = $stmt->fetchAll();
            //var_dump($methodNumber);

            $stmt= $conn->prepare("SELECT method_number, CategoryId, SubcategoryId1, SubcategoryId2 , SubcategoryId3, SubcategoryId4
                                    from course_has_category
                                    where CourseId=?");
            $stmt->execute([$courseID]);
            $methods = array();
            
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                $methods[] = $row;
            }
        
            require APP . 'views/templates/header.php';
            require APP . 'views/ProfessorPage/ManageCrew.php';
            require APP . 'views/templates/footer.php';
        }
        else{
            
            require APP . 'views/templates/header.php';
            require APP . 'views/ProfessorPage/NotAllowed.php';
            require APP . 'views/templates/footer.php';
        }

    }

    //API for ajax request
    public function get_users()
    { 
        if (isset($_GET["query"]))
        {
            $db_username = 'perigrammata_db';
            $db_password = '@ad1p_c0urses_29_01_2020';
            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

            $data = array();
            
            $courseID= $_GET['courseId'];
            //get all possible partners
            $query= $conn->prepare("SELECT d.Id,d.firstname,d.LastName
                        FROM user as d
                        WHERE (d.LastName LIKE '%".$_GET["query"]."%' || d.firstname LIKE '%".$_GET["query"]."%' 
                        || CONCAT(d.firstname, ' ', d.lastname) LIKE '%".$_GET["query"]."%') 
                            AND (d.Id NOT IN (SELECT ProfessorId from course_has_professor
                                            WHERE CourseId = ? ))
                            ORDER BY d.lastname ASC");
            $query->execute([$courseID]);
            
            $result=$query->fetchAll();

            foreach($result as $row)
            {
                $data[] = array(
                    'id' => $row["Id"],
                    'firstname' => $row["firstname"],
                    'lastname'	=> $row["LastName"]
                );
            }

            echo json_encode($data);

        }
    }

    //API for ajax submit partners as a role
    public function SubmitPartners()
    { 
        if (isset($_GET["id"]) && isset($_GET["courseId"]))
        {
            $db_username = 'perigrammata_db';
            $db_password = '@ad1p_c0urses_29_01_2020';
            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
      
            //insert partner
            $query= $conn->prepare("INSERT INTO course_has_professor
                                values (?,?,1)");
            $query->execute([$_GET["courseId"] , $_GET["id"]]);
        
        }
    }
    
    //API for ajax remove partners
    public function RemovePartners()
    { 
        if (isset($_GET["id"]) && isset($_GET["courseId"]))
        {
            $db_username = 'perigrammata_db';
            $db_password = '@ad1p_c0urses_29_01_2020';
            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
      
            //delete partner
            $query= $conn->prepare("DELETE from course_has_professor
                        where CourseId=? and ProfessorId=? and RoleId=1");
            $query->execute([$_GET["courseId"] , $_GET["id"]]);

            //and delete all partners jurisdictions
            $query= $conn->prepare("DELETE from partner_jurisdiction
                    where partnerId = ? and courseId = ? ");
            $query->execute([$_GET["id"] , $_GET["courseId"] ]); 
        
        }
    }

    //API for ajax submit partners with specific jurisdictions
    public function SubmitPartnersSpecific()
    { 
        if (isset($_GET["partnerId"]) && isset($_GET["courseId"]) && isset($_GET["method"]) && isset($_GET["assessment"]) && isset($_GET["subcategoryId"]))
        {
            $db_username = 'perigrammata_db';
            $db_password = '@ad1p_c0urses_29_01_2020';
            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
      
            //insert partner
            $query= $conn->prepare("INSERT INTO partner_jurisdiction
                                values (?,?,?,?,?)");
            $query->execute([$_GET["partnerId"],$_GET["courseId"],$_GET["method"] +1 ,$_GET["assessment"],$_GET["subcategoryId"]]);  
        }
    }

    public function RemovePartnersSpecific()
    {
        if (isset($_GET["partnerId"]) && isset($_GET["courseId"]) && isset($_GET["methodnum"]) && isset($_GET["assessmentId"]) && isset($_GET["subcategoryId"]))
        {

            $db_username = 'perigrammata_db';
            $db_password = '@ad1p_c0urses_29_01_2020';
            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
      
            //delete partner
            $query= $conn->prepare("DELETE from partner_jurisdiction
                        where partnerId = ? and courseId = ? and method_number = ? and assessmentId = ? and subcategoryId = ? ");
            $query->execute([$_GET["partnerId"] , $_GET["courseId"] ,$_GET["methodnum"] + 1 , $_GET["assessmentId"] , $_GET["subcategoryId"]]); 
        }
    }

    
    public function RemovePartnersOnMethodDelete()
    {
        if (isset($_GET["courseId"]) && isset($_GET["methodnum"]))
        {

            $db_username = 'perigrammata_db';
            $db_password = '@ad1p_c0urses_29_01_2020';
            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
      
            //delete partner
            $query= $conn->prepare("DELETE from partner_jurisdiction
                        where courseId = ? and method_number = ? ");
            $query->execute( [$_GET["courseId"] ,$_GET["methodnum"] ]); 
        }
    }

    //ajax for select
    public function loadPartners()
    {
        if (isset($_GET["courseID"]))
        {
            $db_username = 'perigrammata_db';
            $db_password = '@ad1p_c0urses_29_01_2020';
            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
      
            $data = array();

            $query= $conn->prepare("SELECT ProfessorId , k.firstname, k.lastname 
                        from course_has_professor
                        inner join user as k on ProfessorId = k.Id
                        where CourseId=? and RoleId=1");
            $query->execute([$_GET["courseID"]]);


            $result=$query->fetchAll();

            foreach($result as $row)
            {
                $data[] = array(
                    'id' => $row["ProfessorId"],
                    'firstname' => $row["firstname"],
                    'lastname'	=> $row["lastname"]
                );
            }
            
            echo json_encode($data);
        
        }

    }

    public function SubmitCrewMembers()
    {
        //first delete previous professors and crew
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
        
        $courseID = $_GET['courseId'];
        $stmt= $conn->prepare("DELETE FROM perigrammata_db.course_has_professor
        where courseid=? and RoleId=0");
        $stmt->execute([$courseID]);

        //and add the new list
        $courseID = $_GET['courseId'];
        foreach($_POST['ProfessorId'] as $Id => $profId )
        {
            $stmt= $conn->prepare("INSERT INTO perigrammata_db.course_has_professor
            VALUES(?,?,?) ");
            $stmt->execute([$courseID ,$profId ,0]);
        }

        header('location: ' . URL . 'ProfessorController/ManageCrew?CourseId=' . $_GET['courseId']);

    }

    public function ManageRequests()
    {
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
        
        $courseID = $_GET['CourseId'];
        $stmt= $conn->prepare("SELECT StudentId, YearOfEnrollement,enrollementAccepted, firstname, lastname
        FROM perigrammata_db.Student_is_enrolled
        inner join user on id = studentid
        where courseid=? and enrollementAccepted = 0");
        $stmt->execute([$courseID]);
        $students= $stmt->fetchAll();


        $stmt = $conn->prepare("SELECT RoleId
                FROM course_has_professor
                WHERE CourseId = ? AND ProfessorId =?");    
        $stmt->execute([$courseID , $_SESSION['user_id']]); 
        $role = $stmt->fetchAll(); 

        $courseID = $_GET['CourseId'];
        $stmt = $conn->prepare("SELECT CourseTitle, LessonCode
        FROM perigrammata_db.courses
        WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        if($role[0]['RoleId']==0){
            require APP . 'views/templates/header.php';
            require APP . 'views/ProfessorPage/ManageRequests.php';
            require APP . 'views/templates/footer.php';
        }else{
            require APP . 'views/templates/header.php';
            require APP . 'views/ProfessorPage/NotAllowed.php';
            require APP . 'views/templates/footer.php';
        }

    }

    public function DeclineRequest()
    {
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        $studentId = $_GET['StudentId'];
        $courseId = $_GET['CourseId'];
        $stmt = $conn->prepare(" UPDATE Student_is_enrolled
            SET enrollementAccepted = -1 , course_method = null
            WHERE StudentId =? AND CourseId =?");
            $stmt->execute([$studentId , $courseId]);

        header('location: ' . URL . 'ProfessorController/ManageRequests?CourseId=' . $courseId);
    }

    public function AcceptRequest()
    {
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        
        $studentId = $_GET['StudentId'];
        $courseId = $_GET['CourseId'];
        $stmt = $conn->prepare(" UPDATE Student_is_enrolled
            SET enrollementAccepted = 1 , course_method = null
            WHERE StudentId =? AND CourseId =?");
            $stmt->execute([$studentId , $courseId]);

        $studentId = $_GET['StudentId'];
        $courseId = $_GET['CourseId'];
        $stmt = $conn->prepare(" SELECT categoryId
                    FROM course_has_category
                    where CourseId=?");
        $stmt->execute([$courseId]);
        $categories = $stmt->fetchAll(); 
      
        header('location: ' . URL . 'ProfessorController/ManageRequests?CourseId=' . $courseId);

    }

    public function ChooseMethod()
    {
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        //echo $_GET['CourseId'];
        $courseID = $_GET['CourseId'];
        
        $courseID = $_GET['CourseId'];
        $stmt = $conn->prepare("SELECT CourseTitle, LessonCode
        FROM perigrammata_db.courses
        WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        //if he is a professor in the course, he can evaluate everything and have the other functionalities
        $stmt = $conn->prepare("SELECT RoleId
                                FROM course_has_professor
                                WHERE CourseId = ? AND ProfessorId =?");    
        $stmt->execute([$courseID , $_SESSION['user_id']]); 
        $role = $stmt->fetchAll(); 

        if($role[0]['RoleId']==0){

            $stmt = $conn->prepare("SELECT distinct method_number FROM perigrammata_db.course_has_category
            where CourseId= ?");    
            $stmt->execute([$courseID]); 
            $method_number = $stmt->fetchAll();
    
            require APP . 'views/templates/header.php';
            require APP . 'views/ProfessorPage/ChooseMethod.php';
            require APP . 'views/templates/footer.php';
        }else
        {   //get specific method that the partner can evaluate
            $stmt = $conn->prepare("SELECT distinct method_number FROM partner_jurisdiction
            where partnerId= ? and courseId= ?");    
            $stmt->execute([$_SESSION['user_id'] , $courseID]); 
            $method_number = $stmt->fetchAll();
    
            require APP . 'views/templates/header.php';
            require APP . 'views/ProfessorPage/ChooseMethod.php';
            require APP . 'views/templates/footer.php';

        }
        
    }

    public function ManageCategories()
    {
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        $method_number= $_GET['method_number'];

        $courseID = $_GET['CourseId'];

        $stmt = $conn->prepare("SELECT CourseTitle, LessonCode
        FROM perigrammata_db.courses
        WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        $stmt = $conn->prepare("SELECT RoleId
                                FROM course_has_professor
                                WHERE CourseId = ? AND ProfessorId =?");    
        $stmt->execute([$courseID , $_SESSION['user_id']]); 
        $role = $stmt->fetchAll(); 

        require APP . 'views/templates/header.php';
        require APP . 'views/ProfessorPage/ManageCategories.php';
        require APP . 'views/templates/footer.php';
    }

    public function NumberOfMethodAndCategory()
    {
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        $category = $_GET['category'];

        $method_number = $_GET['method_number'];

        $courseID = $_GET['CourseId'];

        $number = $_GET['number'];

        $stmt = $conn->prepare("SELECT CourseTitle, LessonCode
                                FROM perigrammata_db.courses
                                WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 
        
        //if he is a professor in the course, he can evaluate everything
        $stmt = $conn->prepare("SELECT RoleId
                                FROM course_has_professor
                                WHERE CourseId = ? AND ProfessorId =?");    
        $stmt->execute([$courseID , $_SESSION['user_id']]); 
        $role = $stmt->fetchAll(); 

        $stmt = $conn->prepare("SELECT *
                    FROM user , students_grades 
                    WHERE students_grades.courseId = ? and students_grades.studentId = user.Id 
                    and students_grades.categoryId=? and students_grades.method_number = ? and students_grades.assessmentNumber = ? ");    
        $stmt->execute([$courseID , $category , $method_number, $number] ); 
        $studentsGrades = $stmt->fetchAll();
        
        $stmt = $conn->prepare("SELECT * 
                    FROM perigrammata_db.course_has_category
                    WHERE CourseId = ? and CategoryId= ? and method_number = ?");    
        $stmt->execute([$courseID , $category , $method_number ]); 
        $categories = $stmt->fetchAll();
        
        require APP . 'views/templates/header.php';
        require APP . 'views/ProfessorPage/ManageFinalExam.php';
        require APP . 'views/templates/footer.php';
    }

    public function ManageAssessment()
    {
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        $category = $_GET['category'];

        $method_number = $_GET['method_number'];

        $courseID = $_GET['CourseId'];

        $stmt = $conn->prepare("SELECT CourseTitle, LessonCode
                                FROM perigrammata_db.courses
                                WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 
        
        //if he is a professor in the course, he can evaluate everything
        $stmt = $conn->prepare("SELECT RoleId
                                FROM course_has_professor
                                WHERE CourseId = ? AND ProfessorId =?");    
        $stmt->execute([$courseID , $_SESSION['user_id']]); 
        $role = $stmt->fetchAll(); 

        $stmt = $conn->prepare("SELECT *
        FROM perigrammata_db.number_of_assessment
        WHERE CourseId = ? and AssessmentId= ? and AssessmentMethod = ?");    
        $stmt->execute([$courseID , $category , $method_number ]); 
        $numbers = $stmt->fetchAll();
        
        $stmt = $conn->prepare("SELECT * 
                    FROM perigrammata_db.course_has_category
                    WHERE CourseId = ? and CategoryId= ? and method_number = ?");    
        $stmt->execute([$courseID , $category , $method_number ]); 
        $categories = $stmt->fetchAll();

        if($role[0]['RoleId']==0) // if professor, allowed to evaluate all grades
        {
            require APP . 'views/templates/header.php';
            require APP . 'views/ProfessorPage/ManageCategoryNumber.php';
            require APP . 'views/templates/footer.php';
        }
        else{

            $i =0;
            $stmt = $conn->prepare(" SELECT method_number
                from partner_jurisdiction 
                where partnerId=? and courseId=?");
            $stmt->execute([$_SESSION['user_id'] , $courseID] ); 
            $partner_jurisdictions_methods = array();
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                $partner_jurisdictions_methods[$i]= $row['method_number'];
                $i++;
            }

            $i =0;
            $stmt = $conn->prepare(" SELECT assessmentId
                from partner_jurisdiction 
                where partnerId=? and courseId=?");
            $stmt->execute([$_SESSION['user_id'] , $courseID] ); 
            $partner_jurisdictions_assessment = array();
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                $partner_jurisdictions_assessment[$i]= $row['assessmentId'];
                $i++;
            }
            // if a wrong method or category is inserted from URL, redirect to access denied
            if (!in_array($method_number , $partner_jurisdictions_methods)){

                header('location: ' . URL . 'ProfessorController/AccessDenied?CourseId=' . $courseID);

            }
            if (!in_array($category , $partner_jurisdictions_assessment)){

                header('location: ' . URL . 'ProfessorController/AccessDenied?CourseId=' . $courseID);

            }

            //compare the current date with the deadline set by professor
            $stmt = $conn->prepare(" SELECT Evaluation_Deadline
                from course_has_category 
                where CourseId=? and method_number=? and CategoryId=?");
            $stmt->execute([$courseID, $method_number, $category] ); 
            $deadline_date = $stmt->fetchColumn();
            
            date_default_timezone_set('Europe/Lisbon');
            $curDate = date("Y-m-d");

            if ($deadline_date > $curDate || $deadline_date == null)
            {
                require APP . 'views/templates/header.php';
                require APP . 'views/ProfessorPage/ManageCategoryNumber.php';
                require APP . 'views/templates/footer.php';
            }else{
                
                header('location: ' . URL . 'ProfessorController/DeadlineDenied?CourseId=' . $courseID);
            }
        }
    }

    public function ManageAssessmentNumber()
    {   
       
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

        $category = $_GET['category'];

        $method_number = $_GET['method_number'];

        $courseID = $_GET['CourseId'];

        $stmt = $conn->prepare("SELECT CourseTitle, LessonCode
                                FROM perigrammata_db.courses
                                WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        $stmt = $conn->prepare("SELECT * 
                    FROM perigrammata_db.course_has_category
                    WHERE CourseId = ? and CategoryId= ? and method_number = ?");    
        $stmt->execute([$courseID , $category , $method_number ]); 
        $categories = $stmt->fetchAll();

        
        $stmt = $conn->prepare("SELECT * 
                    FROM perigrammata_db.number_of_assessment
                    WHERE CourseId = ? and AssessmentId= ? and AssessmentMethod = ?");    
        $stmt->execute([$courseID , $category , $method_number ]); 
        $allAssessment = $stmt->fetchAll();

        require APP . 'views/templates/header.php';
        require APP . 'views/ProfessorPage/ManageAssessmentNumber.php';
        require APP . 'views/templates/footer.php';
    }

    //api for adding extra excercises , intermediate exams , labs
    public function addAssessmentNumber()
    {
        
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
  
        //insert new assessment
        $query= $conn->prepare("INSERT INTO number_of_assessment
                            values (?,?,?,?,?)");
        $query->execute([$_GET["CourseId"] , $_GET["method"], $_GET["assessment"] , $_GET["assessmentNumber"]  , $_GET["percentage"]]);
    }
    
    //api for updating percentage of existing excs etc...
    public function updateAssessmentNumber()
    {
        
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
  
        //UPDATE assessment's percentage
        $query= $conn->prepare("UPDATE number_of_assessment
                            SET number_of_assessment.Percentage=?
                            where CourseId = ? and AssessmentId= ? and AssessmentNumber= ? and AssessmentMethod= ?");
        $query->execute([ $_GET["percentage"] , $_GET["CourseId"] , $_GET["assessment"] , $_GET["assessmentNumber"] , $_GET["method"] ]);
    }

    public function DeleteAssessmentSpecific()
    {
        
        $db_username = 'perigrammata_db';
        $db_password = '@ad1p_c0urses_29_01_2020';
        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
  
        //delete specific assessment
        $query= $conn->prepare("DELETE FROM number_of_assessment
                            where CourseId = ? and AssessmentId= ? and AssessmentNumber= ? and AssessmentMethod= ?");
        $query->execute([ $_GET["CourseId"] , $_GET["assessment"] , $_GET["assessmentNumber"] , $_GET["method"] ]);
        
        //update the assessment with higher number than the removed
        $query= $conn->prepare("UPDATE number_of_assessment
                            SET AssessmentNumber = AssessmentNumber - 1
                            where CourseId = ? and AssessmentId= ?  and AssessmentMethod= ? and AssessmentNumber > ?");
        $query->execute([ $_GET["CourseId"] , $_GET["assessment"] , $_GET["method"] , $_GET["assessmentNumber"]]);
    }

    public function AccessDenied()
    {
        require APP . 'views/templates/header.php';
        require APP . 'views/ProfessorPage/NotAllowed.php';
        require APP . 'views/templates/footer.php';
    }

    public function DeadlineDenied()
    {
        require APP . 'views/templates/header.php';
        require APP . 'views/ProfessorPage/DeadlineDenied.php';
        require APP . 'views/templates/footer.php';
    }
    public function submitGrades()
    {
        //echo $_SESSION['user_id'];
        if(isset($_POST['finish_creation']))
        {
                
            $db_username = 'perigrammata_db';
            $db_password = '@ad1p_c0urses_29_01_2020';
            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

            //get previous grades in order to change professor's name and date, only to the ones thats actually changed
            $category = $_GET['categoryId'];
            $courseID = $_GET['CourseId'];
            $method_number = $_GET['method_number'];
            $assessment_number = $_GET['number'];
            $stmt = $conn->prepare("SELECT Id,subcategory1_grade,subcategory2_grade,subcategory3_grade,subcategory4_grade,grade1By,grade1Date,grade2By,grade2Date,grade3By,grade3Date,grade4By,grade4Date,general_grade,general_gradeBy,general_gradeDate
            FROM user , students_grades 
            WHERE students_grades.courseId = ? and students_grades.studentId = user.Id and categoryId =? and students_grades.method_number =? and students_grades.assessmentNumber = ? ");    
            $stmt->execute([$courseID , $category , $method_number, $assessment_number] ); 
            $olderStudentsGrades = $stmt->fetchAll();

            foreach($olderStudentsGrades as $Id => $Grades)
            {

                $olderGradesIndexed[$Grades['Id']] = ["Id"=> $Grades['Id'],
                                                      "subcategory1_grade"=> $Grades['subcategory1_grade'] ,
                                                      "subcategory1_gradeBy"=> $Grades['grade1By'] ,
                                                      "subcategory1_Date"=> $Grades['grade1Date'] ,
                                                      "subcategory2_grade"=> $Grades['subcategory2_grade'] ,
                                                      "subcategory2_gradeBy"=> $Grades['grade2By'] ,
                                                      "subcategory2_Date"=> $Grades['grade2Date'] ,
                                                      "subcategory3_grade"=> $Grades['subcategory3_grade'] ,
                                                      "subcategory3_gradeBy"=> $Grades['grade3By'] ,
                                                      "subcategory3_Date"=> $Grades['grade3Date'] ,
                                                      "subcategory4_grade"=>$Grades['subcategory4_grade'],
                                                      "subcategory4_gradeBy"=> $Grades['grade4By'] ,
                                                      "subcategory4_Date"=> $Grades['grade4Date'] ,
                                                      "general_grade" => $Grades['general_grade'],
                                                      "general_gradeBy"=> $Grades['general_gradeBy'] ,
                                                      "general_Date"=> $Grades['general_gradeDate']];
            }


            foreach ($_POST['Grade'] as $Id => $Grade)
            {
                $finalGrade = 0;
                $subcategory1_grade = 0;
                $subcategory2_grade = 0;
                $subcategory3_grade = 0;
                $subcategory4_grade = 0;
                $general_grade = 0;
                $grade1By = '';
                $grade2By = '';
                $grade3By = '';
                $grade4By = '';
                $general_gradeBy = '';
                $subcategory1_date = null;
                $subcategory2_date = null;
                $subcategory3_date = null;
                $subcategory4_date = null;
                $general_gradeDate = null;

                if (isset($Grade['subcategory1_grade'])){
                    $subcategory1_grade=$Grade['subcategory1_grade'];
                    $grade1By = $olderGradesIndexed[$Id]['subcategory1_gradeBy'];
                    $subcategory1_date = $olderGradesIndexed[$Id]['subcategory1_Date'];
                    //echo '<pre>';
                    if($olderGradesIndexed[$Id]['Id']== $Id && $olderGradesIndexed[$Id]['subcategory1_grade'] != $Grade['subcategory1_grade'])
                    {
                        
                        $subcategory1_grade=$Grade['subcategory1_grade'];
                        $grade1By = $_SESSION['user_id'];;
                        $subcategory1_date = date("Y/m/d h:i:s");

                    }
                }else{
                    $subcategory1_grade = 0;
                }

                if (isset($Grade['subcategory2_grade'])){

                    $subcategory2_grade=$Grade['subcategory2_grade'];
                    $grade2By = $olderGradesIndexed[$Id]['subcategory2_gradeBy'];
                    $subcategory2_date = $olderGradesIndexed[$Id]['subcategory2_Date'];

                    if($olderGradesIndexed[$Id]['Id']== $Id && $olderGradesIndexed[$Id]['subcategory2_grade'] != $Grade['subcategory2_grade'])
                    {

                        $subcategory2_grade=$Grade['subcategory2_grade'];
                        $grade2By = $_SESSION['user_id'];
                        $subcategory2_date = date("Y/m/d h:i:s");

                   }
                }else{
                    $subcategory2_grade = 0;
                }

                if (isset($Grade['subcategory3_grade'])){

                    $subcategory3_grade=$Grade['subcategory3_grade'];
                    $grade3By = $olderGradesIndexed[$Id]['subcategory3_gradeBy'];
                    $subcategory3_date =$olderGradesIndexed[$Id]['subcategory3_Date'];

                    if($olderGradesIndexed[$Id]['Id']== $Id && $olderGradesIndexed[$Id]['subcategory3_grade'] != $Grade['subcategory3_grade'])
                    {
                        
                        $subcategory3_grade=$Grade['subcategory3_grade'];
                        $grade3By = $_SESSION['user_id'];
                        $subcategory3_date = date("Y/m/d h:i:s");

                   }
                }else{
                    $subcategory3_grade = 0;
                }

                if (isset($Grade['subcategory4_grade'])){
                    $subcategory4_grade=$Grade['subcategory4_grade'];
                    $grade4By = $olderGradesIndexed[$Id]['subcategory4_gradeBy'];
                    $subcategory4_date = $olderGradesIndexed[$Id]['subcategory4_Date'];

                    if($olderGradesIndexed[$Id]['Id']== $Id && $olderGradesIndexed[$Id]['subcategory4_grade'] != $Grade['subcategory4_grade']){
                        
                        $subcategory4_grade=$Grade['subcategory4_grade'];
                        $grade4By = $_SESSION['user_id'];
                        $subcategory4_date = date("Y/m/d h:i:s");

                   }
                }else{
                    $subcategory4_grade = 0;
                }

                if (isset($Grade['general_grade'])){
                    $general_grade=$Grade['general_grade'];
                    $general_gradeBy = $olderGradesIndexed[$Id]['general_gradeBy'];
                    $general_gradeDate = $olderGradesIndexed[$Id]['general_Date'];

                    if($olderGradesIndexed[$Id]['Id']== $Id && $olderGradesIndexed[$Id]['general_grade'] != $Grade['general_grade'])
                    {

                        $general_grade=$Grade['general_grade'];
                        $general_gradeBy = $_SESSION['user_id'];
                        $general_gradeDate = date("Y/m/d h:i:s");

                   }
                }else{
                    $general_grade = 0;
                }


                $finalGrade = $subcategory1_grade + $subcategory2_grade + $subcategory3_grade + $subcategory4_grade + $general_grade;
                if ($finalGrade<0 || $finalGrade >10)
                    $finalGrade = 0;

                
                $categoryId = $_GET['categoryId'];
                $courseID = $_GET['CourseId'];
                $method_number = $_GET['method_number'];
                $stmt = $conn->prepare("UPDATE students_grades
                SET students_grades.subcategory1_grade = ?,
                    students_grades.subcategory2_grade = ?,
                    students_grades.subcategory3_grade = ?,
                    students_grades.subcategory4_grade = ?,
                    students_grades.grade1By = ?,
                    students_grades.grade1Date = ?,
                    students_grades.grade2By = ?,
                    students_grades.grade2Date = ?,
                    students_grades.grade3By = ?, 
                    students_grades.grade3Date = ?,
                    students_grades.grade4By = ?,
                    students_grades.grade4Date = ?,
                    students_grades.general_grade = ?,
                    students_grades.general_gradeBy = ?,
                    students_grades.general_gradeDate = ?,
                    finalGrade = $finalGrade,
                    students_grades.assessmentNumber = ?
                WHERE students_grades.studentId = $Id and students_grades.courseId = ? AND students_grades.categoryId= ? and method_number = ? and students_grades.assessmentNumber =?");  
                //$stmt->execute();         
                $stmt->execute([$subcategory1_grade ,$subcategory2_grade ,$subcategory3_grade, $subcategory4_grade,
                                $grade1By,$subcategory1_date,$grade2By, $subcategory2_date ,
                                $grade3By,$subcategory3_date,$grade4By,$subcategory4_date,$general_grade,$general_gradeBy,$general_gradeDate, $assessment_number, $courseID ,$categoryId, $method_number , $assessment_number ]); 
            }

            
            header('location: ' . URL . 'ProfessorController/NumberOfMethodAndCategory?CourseId=' . $courseID ."&method_number=" .$method_number. "&category=".$categoryId . "&number=".$assessment_number); 
            
        }
    }


    public function EditLearningOutcomes()
    {
        
        $Course = $this->CourseModel->getCourse($_GET['CourseId']);
        
        $CourseType = $this->CourseModel->getCourseType($Course['LangId']);
        $RequiredCourses= $this->CourseModel->getRequiredCourses($_GET['CourseId']);
        
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
        //echo'<pre>';
        //var_dump($Assessments);
        //echo'</pre>';
        $bonus = $this->CourseModel->getBonus($Course['LangId']);
        $CourseAssessment = $this->CourseModel->getCourseAssessment($_GET['CourseId']);
       // $CourseAssessment2 = $this->CourseModel->getCourseAssessmentAllMethods($_GET['CourseId']);
        
        $db_username = 'perigrammata_db';
        $db_password = '9ohmHG31';
        $conn = new PDO('mysql:host=database;dbname=perigrammata_db;charset=utf8;port=3306', 
        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
    
        $stmt=$conn->prepare("SELECT max(method_number) as num
            from course_has_category
            where courseid=?");
        $stmt->execute([$_GET['CourseId']]);
        $methods = $stmt->fetchAll();
        //var_dump($methods);
        //echo'<pre>';
        //var_dump($CourseAssessment2);
        //echo'</pre>';
        
        require APP . 'views/templates/header.php';
        require APP . 'views/ProfessorPage/EditLearningOutcomes.php';
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
        require APP . 'views/ProfessorPage/fhtml.php';
        require APP . 'views/templates/footer.php';
    }

    public function deleteCourseOutcome()
    {   
        $CourseId_selected = $_GET['CourseId'];
        // if we have an id of a verb that should be deleted
        if (isset($CourseId_selected)) {
            // do deleteVerb() in models/CourseModel.php
            $this->CourseModel->deleteCourse($CourseId_selected);
        }
        // where to go after verb has been deleted
        header('location: ' . URL . 'AdminController/AllCourses');      
    }


    public function getActivitySkill()
    {
       $Skills = $this->CourseModel->getActivitySkill($_POST["ActivityId"]);
       echo json_encode($Skills);
    }



    public function updateLearningOutcomes()
    {
        $_SESSION['g_message'] = '';

        //var_dump ($_POST['bonus']);
        //var_dump ($_POST['percentage']);
        //var_dump ($_POST['subcategories_1']);
        //if(isset($_POST['finish_creation']))
        //{
              
         
                $_SESSION['updated'] = $_POST["CourseId"];
                $_POST["skills"] = isset( $_POST["skills"] ) ? $_POST["skills"] : array();
                
                $_POST["subcategories_1"] = isset( $_POST["subcategories_1"] ) ? $_POST["subcategories_1"] : array();
                $_POST["subcategories_2"] = isset( $_POST["subcategories_2"] ) ? $_POST["subcategories_2"] : array();
                $_POST["subcategories_3"] = isset( $_POST["subcategories_3"] ) ? $_POST["subcategories_3"] : array();
                $_POST["subcategories_4"] = isset( $_POST["subcategories_4"] ) ? $_POST["subcategories_4"] : array();
                // print_r(array_unique($_POST["Verbs"]));

                $flag = 0;
                $activeVerbs = 0;
                $uniqueVerbs = 0;
                $duplicate = false;

                // for ($i=0;$i<count($_POST["Verbs"]);$i++){
                   
                //     if ($_POST["Verbs"][$i]!=''){
                //         echo $_POST["Verbs"][$i].'('.$i.'<br>';
                //         $activeVerbs ++;
                //     }
            
                // }
                // for ($i=0;$i<$activeVerbs;$i++){
                //     for ($j=0;$j<$activeVerbs;$j++){
                //         if($_POST["Verbs"][$i]!=$_POST["Verbs"][$i] && $i!=$j){
                //             $uniqueVerbs++;
                //         }
                //     }
                // }
                $sentences = '';
                for ($i=0;$i<count($_POST["Verbs"]);$i++){
                   
                    if ( isset($_POST["Verbs"][$i]) && $_POST["Verbs"][$i]!=''){
                        for ($j=0;$j<count($_POST["Verbs"]);$j++){
                            if (isset($_POST["Verbs"][$i]) && isset($_POST["Verbs"][$j]) && $_POST["Verbs"][$i]==$_POST["Verbs"][$j] && $i!=$j){
                                $flag=1;
                                $sentences = $sentences.'<br>'.$_POST["Sentences"][$i];
                            }
                        }
                        //echo $_POST["Verbs"][$i].'('.$i.'<br>';
                        $activeVerbs ++;
                    }
            
                }

                if($flag){
                     // Array has duplicates
                     $_SESSION['g_message'] = 'Error, the same verb cannot be used twice!';
                     $_SESSION['sentences'] = $sentences;
                }else{

                    $db_username = 'perigrammata_db';
                    $db_password = '@ad1p_c0urses_29_01_2020';
                    $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                    $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

                    $_SESSION['sentences'] = '';
                    
                    //for submitting the form with correct method number after deleting method
                    $i = 1;
                    foreach ($_POST['percentage'] as $Id => $value ){
                        
                        $percentage[$i] = $value;
                        $i++;
                    }
                    $j=1;
                    foreach ($_POST['bonus'] as $Id => $value ){
                        
                        $bonus[$j] = $value;
                        $j++;
                    }
                    $k=1;
                    $subcategories_1  = array();
                    $subcategories_2  = array();
                    $subcategories_3  = array();
                    $subcategories_4  = array();
                    $event_date = array();
                    foreach ($_POST['subcategories_1'] as $Id => $value ){
                        
                        $subcategories_1[$k] = $value;
                        $k++;
                    }
                    $l=1;
                    foreach ($_POST['subcategories_2'] as $Id => $value ){
                        
                        $subcategories_2[$l] = $value;
                        $l++;
                    }
                    $m=1;
                    foreach ($_POST['subcategories_3'] as $Id => $value ){
                        
                        $subcategories_3[$m] = $value;
                        $m++;
                    }
                    $n=1;
                    foreach ($_POST['subcategories_4'] as $Id => $value ){
                        
                        $subcategories_4[$n] = $value;
                        $n++;
                    }
                    $g=1;
                    foreach ($_POST['event-date'] as $Id => $value ){
                        
                        $event_date[$g] = $value;
                        $g++;
                    }
                    //var_dump($percentage);

                    //var_dump($_POST['event-date']);
                    //Array does not have duplicates
                    $this->CourseModel->updateLearningOutcomes($_POST["CourseId"],  $_POST["CourseType"], 
                        $_POST["CourseUrl"], $_POST["Verbs"],  $_POST["Sentences"],  $_POST["skills"],  
                        $_POST["Content"], $_POST["LectureMethod"], $_POST["UseOfTechnologies"], $_POST["TextA"],
                        $_POST["TextB"], $_POST["TextC"], $_POST["activities"], $_POST["Hours"], 
                        $_POST["totalHours"], $percentage , $bonus, $subcategories_1,
                        $subcategories_2, $subcategories_3, $subcategories_4,$event_date,
                        $_POST["OrganizationComment"], $_POST["AssessmentComment"], $_POST["Bibliography"]);
                }

             
            header('location: ' . URL . 'ProfessorController/EditLearningOutcomes?CourseId= '. $_POST["CourseId"] );
       // } 

    }

    public function addNewEvaluationMethod()
    {
        
        if(isset($_POST['finish_creation1']))
        {

            $db_username = 'perigrammata_db';
            $db_password = '@ad1p_c0urses_29_01_2020';
            $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
            $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
            
            $courseId= $_GET['CourseId'];
            
            $method = $_GET['EvalMethod'];

            //8 categories in total, update only if percentage is set
            for($i=1; $i<=8; $i++)
            {
                if($_POST['percentage'][$i]!='')
                {
                    if(isset($_POST["subcategories_1"][$i]))
                    {
                        $sub1 = $_POST["subcategories_1"][$i];
                    }else{
                        $sub1 = 0;
                    }
                    if(isset($_POST["subcategories_2"][$i]))
                    {
                        $sub2 = $_POST["subcategories_2"][$i];
                    }else{
                        $sub2 = 0;
                    }
                    if(isset($_POST["subcategories_3"][$i]))
                    {
                        $sub3 = $_POST["subcategories_3"][$i];
                    }else{
                        $sub3 = 0;
                    }
                    if(isset($_POST["subcategories_4"][$i]))
                    {
                        $sub4 = $_POST["subcategories_4"][$i];
                    }else{
                        $sub4 = 0;
                    }
                    if($_POST['event-date'][$i]!=""){
                        $event_date=  date('Y-m-d', strtotime($_POST['event-date'][$i]));
                    }else{
                        $event_date = null;
                    }
                    $stmt = $conn->prepare("INSERT INTO  course_has_category
                    values (?,?,?,?,?,?,?,?,?,?) ");
                    $stmt->execute([$courseId , $method , $i , $_POST["bonus"][$i],$_POST['percentage'][$i],
                                    $sub1 , $sub2, $sub3, $sub4,$event_date]);
            
                    //insert number one as default number with 100% percentage
                    $stmt = $conn->prepare("INSERT INTO  number_of_assessment
                    values (?,?,?,1,100) ");
                    $stmt->execute([$courseId , $method ,  $i ]);
                }
            }

        }

        header('location: ' . URL . 'ProfessorController/EditLearningOutcomes?CourseId= '. $courseId );
    }


}
