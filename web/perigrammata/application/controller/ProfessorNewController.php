<?php
        
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProfessorNewController extends Controller{
    
    public function redirectAdmins()
    {
        if (isset($_POST['button1'])){
            $submitedCourses = $this->CourseModel->submitedCourses();
            $professorCourses = $this->CourseModel->getAllProfessorCourses($_SESSION['user_id']);
            require APP . 'views/templates/header1.php';
            require APP . 'views/home/HomeProfessor.php';
        }
        
        if(isset($_POST['button2'])) { 

            $_SESSION['admin_id'] = 0; 

            $stmt = $this->conn->prepare("SELECT * FROM admin WHERE UserId = ?");   
            $stmt->execute([$_SESSION['user_id']]);   
            $stmt->execute(); 
            $admin = $stmt->fetchAll(); // get the mysqli result

            $superAdminFlag = 0;
            $institutionAdminFlag = 0;
            $schoolAdminFlag = 0;
            $syllabusAdminFlag = 0;

            foreach ($admin as $Id => $row ) {

                $admin_id = $row['AdminId'];

                // institution admin
                if($admin_id == 1) {   
                    $institutionAdminFlag = 1;  
                    $managedInstitutionId = $row['ManagedDepartmentId'];
                    $_SESSION['managedInstitutionId'] = $managedInstitutionId; 
                    $_SESSION['admin_id'] = 1;
                }

                // school admin
                if($admin_id == 2) { 
                    $schoolAdminFlag = 1;    
                    $managedSchoolId = $row['ManagedDepartmentId'];   
                    $_SESSION['managedSchoolId'] = $managedSchoolId; 
                    $_SESSION['admin_id'] = 2;  
                    $_SESSION['user_role_title'] = " ΣΧΟΛΗΣ";
                }

                // syllabus admin
                if($admin_id == 3) {  
                    $syllabusAdminFlag = 1;   
                    $managedSyllabusId = $row['ManagedDepartmentId'];
                    $_SESSION['managedSyllabusId'] = $managedSyllabusId; 
                    $_SESSION['admin_id'] = 3;
                }

                // super admin 
                if($admin_id == 4) {   
                    $superAdminFlag = 1;
                    $_SESSION['admin_id'] = 4;
                } 

            }

            require APP . 'views/templates/header.php';
            require APP . 'views/home/IndexAdmin.php'; 
        } 
    }
    public function MyCalendar()
    {
        /*this is only for the demo application. 
        I insert default password for every professor
        $pass = password_hash('9ohmHG31', PASSWORD_BCRYPT);

        $sql = $this->db->query("SELECT id FROM user");
        $sql->execute();

        while ($row = $sql->fetch(PDO::FETCH_BOTH)) {
            $userId = $row["id"];
            $query=$this->db->prepare("UPDATE user SET Password=? WHERE id = ?");
            $query->execute([$pass,$userId ]);
        }*/
        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/ProfessorCalendar.php';
    }
    //insert professors in course
    public function Admin()
    {     
        $courseID = $_GET['CourseId'];
        $stmt = $this->conn->prepare("SELECT CourseTitle, LessonCode
                    FROM perigrammata_db.courses
                    WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 
        
        $stmt = $this->conn->prepare("SELECT RoleId
                    FROM course_has_professor
                    WHERE CourseId = ? AND ProfessorId =?");    
        $stmt->execute([$courseID , $_SESSION['user_id']]); 
        $role = $stmt->fetchAll(); 

        //get enrolled professors
        $stmt= $this->conn->prepare("SELECT ProfessorId ,u.firstname , u.lastname ,roleId
                    FROM perigrammata_db.course_has_professor
                    inner join user as u on ProfessorId = u.id
                    where courseid=? 
                    order by roleId");
        $stmt->execute([$courseID]);
        $professorsId = $stmt->fetchAll();

        //get enrolled partners
        $stmt= $this->conn->prepare("SELECT ProfessorId ,u.firstname , u.lastname ,roleId
                    FROM perigrammata_db.course_has_professor
                    inner join user as u on ProfessorId = u.id
                    where courseid=? and RoleId=1");
        $stmt->execute([$courseID]);
        $partners = $stmt->fetchAll();

        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/Admin.php';
        require APP . 'views/templates/footer1.php';
    }


    //insert workload at courses activities
    public function ManageActivities()
    {
        
        $courseID = $_GET['CourseId'];
        $stmt = $this->conn->prepare("SELECT CourseTitle, LessonCode
                    FROM perigrammata_db.courses
                    WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        
        $stmt = $this->conn->prepare("SELECT RoleId
                    FROM course_has_professor
                    WHERE CourseId = ? AND ProfessorId =?");    
        $stmt->execute([$courseID , $_SESSION['user_id']]); 
        $role = $stmt->fetchAll(); 

        //get activities for the course
        $stmt = $this->conn->prepare("SELECT d.Activities , Hours , d.Id
                    from teaching_organization , activities as d
                    where activityId = d.Id and CourseId = ? and (d.Id = 1 or d.Id = 2 or d.Id = 3 or d.Id = 4 or d.Id = 12 )");
        $stmt->execute([$courseID]); 
        $activities = $stmt->fetchAll();
      
        //find current semester's Id
        
        $query= $this->conn->prepare("SELECT Id
                                FROM Semester_period
                                Where Current=1");
        $query->execute();
        $Semester= $query->fetchAll();
        //get new activities for the course
        $stmt = $this->conn->prepare("SELECT d.Activities , SemesterHours , SectionNumber, d.Id
                    from course_workload , activities as d
                    where activityId = d.Id and CourseId = ? and (d.Id = 1 or d.Id = 2 or d.Id = 3 or d.Id = 4 or d.Id = 12 ) and SemesterId=?");
        $stmt->execute([$courseID, $Semester[0]['Id']]); 
        $activitiesnew = $stmt->fetchAll();

        //get new activities for the course select
        $stmt = $this->conn->prepare("SELECT distinct d.Activities , d.Id
                    from course_workload , activities as d
                    where activityId = d.Id and CourseId = ? and (d.Id = 1 or d.Id = 2 or d.Id = 3 or d.Id = 4 or d.Id = 12 )");
        $stmt->execute([$courseID]); 
        $activitiesnew1 = $stmt->fetchAll();

        $stmt = $this->conn->prepare("SELECT q.FirstName , q.LastName , d.activities , week_hours , semester_hours, SectionNumber
                        FROM professor_workload
                        inner join user as q on q.Id = ProfessorId
                        inner join activities as d on ActivityId = d.Id 
                        where courseId=?");
        $stmt->execute([$courseID]); 
        $professorsWorkload = $stmt->fetchAll();

        //get available activities for the course
        $stmt = $this->conn->prepare("SELECT Activities , Id
                        from activities 
                        where (Id = 1 or Id = 2 or Id = 3 or Id = 4 or Id = 12 )");
        $stmt->execute(); 
        $activitiesavailable = $stmt->fetchAll();

        //get enrolled professors
        $stmt= $this->conn->prepare("SELECT ProfessorId ,u.firstname , u.lastname ,roleId
                                    FROM course_has_professor
                                    inner join user as u on ProfessorId = u.id
                                    where courseid=? 
                                    order by roleId");
                                    $stmt->execute([$courseID]);
        $professorsId = $stmt->fetchAll();

        //get workload from calendar
        $stmt= $this->conn->prepare("SELECT ProfessorId ,u.firstname , u.lastname ,roleId
                                    FROM course_has_professor
                                    inner join user as u on ProfessorId = u.id
                                    where courseid=? 
                                    order by roleId");
                                    $stmt->execute([$courseID]);
        $professorsSpecificWorkload = $stmt->fetchAll();

        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/ManageCrew1.php';
        require APP . 'views/templates/footer1.php';
    }

    //api for deleting activity on  button click
    public function deleteSpecificActivity(){
        
        $courseID = $_POST['courseId'];
        $section = $_POST['section'];
        $activityID = $_POST['id'];
        
        $stmt = $this->conn->prepare("DELETE 
                    FROM course_workload
                    WHERE CourseId = ? AND ActivityId=? and SectionNumber=? and SemesterId = 1");    
        $stmt->execute([$courseID,$activityID ,$section ]); 
        
        echo json_encode(array('status' => 'Success'));
    }

    
    //charts for workload activity and professors
    public function ShowStatisticWorkload()
    {

        $courseID = $_GET['CourseId'];

        $stmt = $this->conn->prepare("SELECT CourseTitle, LessonCode
                    FROM courses
                    WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        //find current semester's Id
        
        $query= $this->conn->prepare("SELECT Id
                                FROM Semester_period
                                Where Current=1");
        $query->execute();
        $Semester= $query->fetchAll();

         $stmt = $this->conn->prepare("SELECT ActivityId, SemesterHours , weeklyHours , Activities
                    FROM course_workload , activities as d
                    WHERE CourseId = ? and d.Id = ActivityId and SemesterId=?");    
        $stmt->execute([$courseID, $Semester[0]['Id']]); 
        $activities = $stmt->fetchAll();
        //max num of canvas
        $stmt = $this->conn->prepare("SELECT MAX(SectionNumber) as max
                        FROM course_workload 
                        WHERE CourseId = ? ");    
                $stmt->execute([$courseID]); 
        $maxcanvas = $stmt->fetchAll();
        
        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/ChartsNew.php';
    }

    //charts for workload activity and professors
    public function ShowStatisticWorkload1()
    {

        $courseID = $_GET['CourseId'];

        $stmt = $this->conn->prepare("SELECT CourseTitle, LessonCode
                    FROM courses
                    WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        $stmt = $this->conn->prepare("SELECT ActivityId, SemesterHours , Activities
                    FROM course_workload , activities as d
                    WHERE CourseId = ? and d.Id = ActivityId");    
        $stmt->execute([$courseID]); 
        $activities = $stmt->fetchAll();

        //max num of canvas
        $stmt = $this->conn->prepare("SELECT distinct ActivityId , t.Activities 
                        FROM course_workload 
                        inner join activities as t on t.Id = ActivityId 
                        WHERE CourseId = ? ");    
        $stmt->execute([$courseID]); 
        $maxcanvas1 = $stmt->fetchAll();

        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/Charts.php';
    }
    
    public function dataForChart1(){

        $courseID = $_GET['CourseId'];
        
        $data[] = array();
        $stmt = $this->conn->prepare("SELECT ActivityId, SectionNumber, SemesterHours , weeklyHours , Activities
                    FROM course_workload , activities as d
                    WHERE CourseId = ? and d.Id = ActivityId ");    
        $stmt->execute([$courseID]); 
        $activities = $stmt->fetchAll();
    
        foreach($activities as $row)
        {
            $data[] = array(
                'activity' => $row["ActivityId"],
                'weekly_hours' => $row['weeklyHours'],
                'semester_hours' => $row["SemesterHours"],
                'activity_name' => $row["Activities"],
                'section_number' => $row["SectionNumber"]
            );
        } 

        $data1[] = array();
        //sums the total workload for each activity on each section for the current semester period
        $stmt = $this->conn->prepare("SELECT professorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , activities , t.Start_year, t.End_year , t.title
                                    from professor_calendar_workload 
                                    inner join user as d on d.Id=ProfessorId
                                    inner join activities as q on q.Id=ActivityId
                                    inner join Semester_period as t on t.Id in (SELECT Id from Semester_period where current = 1 )
                                    where courseId= ? and (Day < t.End_date and Day > t.Start_date)
                                    group by ProfessorId , ActivityId , SectionNumber ,t.Start_year, t.End_year , t.title");    
        $stmt->execute([$courseID]); 
        $professorSemesterWorkload = $stmt->fetchAll();

        if(!empty($professorSemesterWorkload)){
            $i =0;
            foreach($professorSemesterWorkload as $row)
            {
                $data1[$i] = array(
                    'profid' => $row["professorId"],
                    'firstname' => $row["firstname"],
                    'lastname'	=> $row["lastname"],
                    'activity' => $row["ActivityId"],
                    'semester_hours' => $row["total"],
                    'activity_name' => $row["activities"],
                    'section_number' => $row["SectionNumber"]
                );
                $i++;
            }
        }else{
            $data1 = array();
        }

        $response = array(
            "data" => $data,
            "data1" => $data1
        );
        echo json_encode($response);
    }

    public function dataForChart(){

        $courseID = $_GET['CourseId'];
        
        $data[] = array();
        $stmt = $this->conn->prepare("SELECT ActivityId, SectionNumber, SemesterHours , weeklyHours , Activities
                    FROM course_workload , activities as d
                    WHERE CourseId = ? and d.Id = ActivityId ");    
        $stmt->execute([$courseID]); 
        $activities = $stmt->fetchAll();
    
        foreach($activities as $row)
        {
            $data[] = array(
                'activity' => $row["ActivityId"],
                'weekly_hours' => $row['weeklyHours'],
                'semester_hours' => $row["SemesterHours"],
                'activity_name' => $row["Activities"],
                'section_number' => $row["SectionNumber"]
            );
        } 

        $data1[] = array();
        //sums the total workload for each activity on each section for the current semester period
        $stmt = $this->conn->prepare("SELECT professorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , activities , t.Start_year, t.End_year , t.title
                                    from professor_calendar_workload 
                                    inner join user as d on d.Id=ProfessorId
                                    inner join activities as q on q.Id=ActivityId
                                    inner join Semester_period as t on t.Id in (SELECT Id from Semester_period where current = 1 )
                                    where courseId= ? and (Day < t.End_date and Day > t.Start_date)
                                    group by ProfessorId , ActivityId , SectionNumber ,t.Start_year, t.End_year , t.title");    
        $stmt->execute([$courseID]); 
        $professorSemesterWorkload = $stmt->fetchAll();

        if(!empty($professorSemesterWorkload)){
            $i =0;
            foreach($professorSemesterWorkload as $row)
            {
                $data1[$i] = array(
                    'profid' => $row["professorId"],
                    'firstname' => $row["firstname"],
                    'lastname'	=> $row["lastname"],
                    'activity' => $row["ActivityId"],
                    'semester_hours' => $row["total"],
                    'activity_name' => $row["activities"],
                    'section_number' => $row["SectionNumber"]
                );
                $i++;
            }
        }else{
            $data1 = array();
        }

        $response = array(
            "data" => $data,
            "data1" => $data1
        );
        echo json_encode($response);
    }
    //enhanced search for workload
    public function AnalyticWorkload(){

        $courseID = $_GET['CourseId'];
        
        $stmt = $this->conn->prepare("SELECT CourseTitle, LessonCode
                    FROM perigrammata_db.courses
                    WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        $stmt = $this->conn->prepare("SELECT distinct ActivityId, d.Activities
                    FROM course_workload 
                    inner join activities as d on d.Id= ActivityId
                    WHERE CourseId = ? ");    
        $stmt->execute([$courseID]); 
        $activities = $stmt->fetchAll();

        
        $stmt = $this->conn->prepare("SELECT ProfessorId, q.firstname, q.lastname
                    from course_has_professor
                    INNER JOIN user as q on q.Id = ProfessorId
                    where courseId= ?");    
        $stmt->execute([$courseID]); 
        $stuff = $stmt->fetchAll();
        
        $stmt = $this->conn->prepare("SELECT *
                    from Semester_period");  
        $stmt->execute();   
        $semesters = $stmt->fetchAll();

        
        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/AnalyticWorkload.php';
    }
    //api for getting the sections for the selected activity
    public function getSectionsForSelectedActivity(){
        
        $activity = $_GET['activity'];
        $courseID = $_GET['courseId'];

        $query= $this->conn->prepare("SELECT max(SectionNumber) as sectionNumber
                         FROM course_workload
                        WHERE CourseId = ? and ActivityId = ? ");
        $query->execute([$courseID,$activity]);
        $secNum= $query->fetchAll();
        echo json_encode($secNum);
    }
    //api for removing a partner from a course
    public function RemovePartnerFromCourse(){
        
        $courseID = $_GET['CourseId'];
        $partnerID = $_GET['partnerId'];
         //delete partner
        $query= $this->conn->prepare("DELETE FROM course_has_professor
                        WHERE CourseId = ? and ProfessorId = ? ");
        $query->execute([$courseID , $partnerID]);

    }
    //api for getting results of partners workload
    public function TableWorkloadResults()
    {
        $courseID = $_GET['courseId'];
        //the results filter will be 0 if no filter is added
        $profId = $_GET['profId'];  
        $activityId = $_GET['activityId'];
        $semesterId = $_GET['semesterId'];

        if($profId== 0 && $activityId == 0 && $semesterId== 0)
        {
            $stmt = $this->conn->prepare("SELECT ProfessorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , q.activities, t.Start_year, t.End_year , t.title
                        from professor_calendar_workload
                        inner join user as d on d.Id=ProfessorId
                        inner join activities as q on q.Id=ActivityId
                        inner join Semester_period as t on t.Id in (SELECT Id from Semester_period where current = 1 )
                        where courseId= ? and (Day < t.End_date and Day > t.Start_date)
                        group by ProfessorId , ActivityId , SectionNumber,t.Start_year, t.End_year , t.title");
            $stmt->execute([$courseID]); 
            $data = $stmt->fetchAll();
        }else if($profId!= 0){        
            $numbers = array_map('intval', $profId); // convert strings to integers
            $placeholders = implode(',', array_fill(0, count($numbers), '?'));
            if($activityId == 0  && $semesterId== 0)
            {
                    $stmt = $this->conn->prepare("SELECT ProfessorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , q.activities, t.Start_year, t.End_year , t.title
                            from professor_calendar_workload
                            inner join user as d on d.Id=ProfessorId
                            inner join activities as q on q.Id=ActivityId
                            inner join Semester_period as t on t.Id in (SELECT Id from Semester_period where current = 1 )
                            where courseId= ? and ProfessorId IN ($placeholders) and (Day < t.End_date and Day > t.Start_date)
                            group by ProfessorId , ActivityId , SectionNumber,t.Start_year, t.End_year , t.title");
                    
                    $params = array_merge([$courseID], $numbers);
                    $stmt->execute($params);
                    $data = $stmt->fetchAll();
                    
            }else if($activityId != 0  && $semesterId== 0)
            {
                $numbers1 = array_map('intval', $activityId); // convert strings to integers
                $placeholders1 = implode(',', array_fill(0, count($numbers1), '?'));
                $stmt = $this->conn->prepare("SELECT ProfessorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , q.activities, t.Start_year, t.End_year , t.title
                        from professor_calendar_workload
                        inner join user as d on d.Id=ProfessorId
                        inner join activities as q on q.Id=ActivityId
                        inner join Semester_period as t on t.Id in (SELECT Id from Semester_period where current = 1 )
                        where courseId= ? and ProfessorId IN ($placeholders) and ActivityId IN ($placeholders1) and (Day < t.End_date and Day > t.Start_date)
                        group by ProfessorId , ActivityId , SectionNumber, t.Start_year, t.End_year , t.title");
                
                $params = array_merge([$courseID], $numbers , $numbers1);
                $stmt->execute($params);
                $data = $stmt->fetchAll();
            }else if($activityId != 0  && $semesterId != 0)
            {
                $numbers1 = array_map('intval', $activityId); // convert strings to integers
                $placeholders1 = implode(',', array_fill(0, count($numbers1), '?'));
                $numbers2 = array_map('intval', $semesterId); // convert strings to integers
                $placeholders2 = implode(',', array_fill(0, count($numbers2), '?'));
                $stmt = $this->conn->prepare("SELECT ProfessorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , q.activities, t.Start_year, t.End_year , t.title
                        from professor_calendar_workload
                        inner join user as d on d.Id=ProfessorId
                        inner join activities as q on q.Id=ActivityId
                        inner join Semester_period as t on t.Id in ($placeholders2)
                        where courseId= ? and ProfessorId IN ($placeholders) and ActivityId IN ($placeholders1) and (Day < t.End_date and Day > t.Start_date)
                        group by ProfessorId , ActivityId , SectionNumber, t.Start_year, t.End_year , t.title");
                
                $params = array_merge( $numbers2 ,[$courseID], $numbers , $numbers1 );
                $stmt->execute($params); 
                $data = $stmt->fetchAll();
            }else if($activityId == 0  && $semesterId != 0)
            {
                $numbers1 = array_map('intval', $semesterId); // convert strings to integers
                $placeholders1 = implode(',', array_fill(0, count($numbers1), '?'));
                $stmt = $this->conn->prepare("SELECT ProfessorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , q.activities, t.Start_year, t.End_year , t.title
                        from professor_calendar_workload
                        inner join user as d on d.Id=ProfessorId
                        inner join activities as q on q.Id=ActivityId
                        inner join Semester_period as t on t.Id in ($placeholders1)
                        where courseId= ?  and ProfessorId IN ($placeholders) and (Day < t.End_date and Day > t.Start_date)
                        group by ProfessorId , ActivityId , SectionNumber, t.Start_year, t.End_year , t.title");
                
                $params = array_merge( $numbers1 ,[$courseID] , $numbers);
                $stmt->execute($params); 
                $data = $stmt->fetchAll();

            }
        }else if($activityId!= 0){
            $numbers = array_map('intval', $activityId); // convert strings to integers
            $placeholders = implode(',', array_fill(0, count($numbers), '?'));
            if($profId == 0  && $semesterId== 0)
            {
                $stmt = $this->conn->prepare("SELECT ProfessorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , q.activities, t.Start_year, t.End_year , t.title
                        from professor_calendar_workload
                        inner join user as d on d.Id=ProfessorId
                        inner join activities as q on q.Id=ActivityId
                        inner join Semester_period as t on t.Id in (SELECT Id from Semester_period where current = 1 )
                        where courseId= ?  and ActivityId IN ($placeholders) and (Day < t.End_date and Day > t.Start_date)
                        group by ProfessorId , ActivityId , SectionNumber, t.Start_year, t.End_year , t.title");
                
                $params = array_merge( [$courseID], $numbers );
                $stmt->execute($params); 
                $data = $stmt->fetchAll();

            }else if($profId == 0  && $semesterId != 0)
            {
                $numbers1 = array_map('intval', $semesterId); // convert strings to integers
                $placeholders1 = implode(',', array_fill(0, count($numbers1), '?'));
                $stmt = $this->conn->prepare("SELECT ProfessorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , q.activities, t.Start_year, t.End_year , t.title
                        from professor_calendar_workload
                        inner join user as d on d.Id=ProfessorId
                        inner join activities as q on q.Id=ActivityId
                        inner join Semester_period as t on t.Id in ($placeholders1)
                        where courseId= ? and ActivityId IN ($placeholders) and (Day < t.End_date and Day > t.Start_date)
                        group by ProfessorId , ActivityId , SectionNumber, t.Start_year, t.End_year , t.title");
                
                $params = array_merge($numbers1, [$courseID], $numbers );
                $stmt->execute($params); 
                $data = $stmt->fetchAll();

            }
        }else if($semesterId!= 0){
            $numbers1 = array_map('intval', $semesterId); // convert strings to integers
            $placeholders1 = implode(',', array_fill(0, count($numbers1), '?'));
            if($profId == 0  && $activityId== 0)
            {
                $stmt = $this->conn->prepare("SELECT ProfessorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , q.activities, t.Start_year, t.End_year , t.title
                            from professor_calendar_workload
                            inner join user as d on d.Id=ProfessorId
                            inner join activities as q on q.Id=ActivityId
                            inner join Semester_period as t on t.Id in ($placeholders1)
                            where courseId= ? and (Day < t.End_date and Day > t.Start_date)
                            group by ProfessorId , ActivityId , SectionNumber, t.Start_year, t.End_year , t.title");
                
                $params = array_merge($numbers1, [$courseID] );
                $stmt->execute($params); 
                $data = $stmt->fetchAll();

            }
        }
        echo json_encode($data);
    }

   

    public function PartnerWorkload()
    {

        $courseID = $_GET['CourseId'];
        $stmt = $this->conn->prepare("SELECT CourseTitle, LessonCode
                        FROM perigrammata_db.courses
                        WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/PartnerWorkload.php';
    }

    //calendar
    public function Calendar()
    {

        $courseID = $_GET['CourseId'];

        $stmt = $this->conn->prepare("SELECT CourseTitle, LessonCode
                        FROM perigrammata_db.courses
                        WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        //get enrolled professors
        $stmt= $this->conn->prepare("SELECT ProfessorId ,u.firstname , u.lastname ,roleId
                        FROM perigrammata_db.course_has_professor
                        inner join user as u on ProfessorId = u.id
                        where courseid=? 
                        order by roleId");
        $stmt->execute([$courseID]);
        $professorsId = $stmt->fetchAll();

        //get course's activities
        $stmt = $this->conn->prepare("SELECT distinct ActivityId, d.Activities
                    FROM course_workload , activities as d
                    WHERE CourseId = ? and d.Id = ActivityId");    
        $stmt->execute([$courseID]); 
        $activities = $stmt->fetchAll(); 
        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/CalendarNew.php';
        //manually include the scripts in order to avoid putting fullcalendar in footer, might do it elsewhere
    }

    //for filling the semester until the choosen date
    public function CalendarAutoComplete()
    {

        $courseID = $_GET['CourseId'];
        $startDate = $_POST['startingdate'];
        $endDate = $_POST['endingdate'];
        $finalDate = $_POST['finaldate'];

        $failed = 0;
        $finalDateptr = new DateTime($finalDate);
        $finalformat = $finalDateptr->format('Y-m-d');
        //get calendar schedule from the selected week
        $stmt = $this->conn->prepare("SELECT *
                FROM professor_calendar_workload
                WHERE CourseId = ? and Day>=? and Day <=?
                order by Day ASC");    
        $stmt->execute([$courseID, $startDate , $endDate]); 
        $weeklycalendar = $stmt->fetchAll(); 

        foreach($weeklycalendar as $row){


            $date = new DateTime($row['Day']);
            $date->add(new DateInterval('P1W'));
            $dateformat = $date->format('Y-m-d');

            while($dateformat <= $finalDate){

                //here we check if there is any conflict between the insertion and any other workload on the same day for that prof
                $query = $this->conn->prepare("SELECT * 
                    FROM professor_calendar_workload
                    WHERE ProfessorId = ? and Day = ? and SemesterId=1 and(
                        ( StartTime < ? AND ? < EndTime) OR (EndTime > ? AND ? > StartTime) ) ");
                $query->execute([$row['ProfessorId'] ,$dateformat , $row['EndTime'] ,  $row['StartTime'], $row['StartTime'] , $row['EndTime'] ]);
                $data = $query->fetchAll();

                if(count($data)==0){
                // here goes the insertion, i have the correct day format 
                $stmt = $this->conn->prepare(" INSERT INTO professor_calendar_workload
                                        values(?,?,?,?,?,?,?,?,1) ");
                $stmt->execute([$row['ProfessorId'],$row['CourseId'],$row['ActivityId'],$dateformat,$row['StartTime'],$row['EndTime'],
                                $row['Duration'],$row['SectionNumber']]);
                }else{
                    $failed++;
                }
                $date->add(new DateInterval('P1W'));
                $dateformat = $date->format('Y-m-d');
            }
        }
        
        header('location: ' . URL . 'ProfessorNewController/Calendar?CourseId= '. $courseID );

    }

    //API for ajax getting partner's calendar workload for specific course
    public function CalendarGet()
    { 
       
            //get inserted partners workloads
            $query= $this->conn->prepare("SELECT  ProfessorId , CourseId, activityId , Day , StartTime , EndTime , d.firstname , d.lastname , q.Activities , SectionNumber
                                    FROM professor_calendar_workload , user as d , activities as q
                                    WHERE CourseId = ? and ProfessorId = d.Id and activityId = q.Id ");
            $query->execute([ $_GET["courseId"]  ]);
            $data = $query->fetchAll();
    
            echo json_encode($data);
            
    }

     //API for ajax getting total partner's calendar workload 
     public function CalendarGetTotalWorkload()
     { 
             
             //get inserted partners workloads
             $query= $this->conn->prepare("SELECT  ProfessorId ,CourseId ,activityId , Day , StartTime , EndTime , d.firstname , d.lastname, q.Activities, t.LessonCode
                                    FROM professor_calendar_workload 
                                    inner join user as d on ProfessorId= d.Id
                                    inner join activities as q on q.Id= activityId
                                    inner join courses as t on t.Id = CourseId
                                    WHERE  ProfessorId in (select c.ProfessorId from course_has_professor as c where c.courseId=?) AND ProfessorId= ?");
             $query->execute([ $_GET["courseId"] , $_GET["partnersId"] ]);
             $data = $query->fetchAll();
     
             echo json_encode($data);
             
     }

     //API for ajax getting total partner's calendar workload 
     public function CalendarMyWorkload()
     { 
             
             //get inserted partners workloads
             $query= $this->conn->prepare("SELECT  ProfessorId ,CourseId ,activityId , Day , StartTime , EndTime , d.firstname , d.lastname, q.Activities, t.LessonCode
                                    FROM professor_calendar_workload 
                                    inner join user as d on ProfessorId= d.Id
                                    inner join activities as q on q.Id= activityId
                                    inner join courses as t on t.Id = CourseId
                                    WHERE  ProfessorId = ?");
             $query->execute([ $_GET["userId"] ]);
             $data = $query->fetchAll();
     
             echo json_encode($data);
             
    }

    //API for ajax submit partner's calendar workload
    public function CalendarPost()
    { 


        $time = $_POST["start"];
        $dateTime = new DateTime($time);
        $dateTime->modify('+1 hour');
        $newTime = $dateTime->format('H:i:s');

        $query= $this->conn->prepare("SELECT Id
                                FROM Semester_period
                                Where Current=1");
        $query->execute();
        $Semester= $query->fetchAll();
        //insert workload
        if($time != '00:00:00')
        {
            //here we check if there is any conflict between the insertion and any other workload on the same day for that prof
            $query = $this->conn->prepare("SELECT * 
                                    FROM professor_calendar_workload
                                    WHERE ProfessorId = ? and Day = ? and (
                                          ( StartTime < ? AND ? < EndTime) OR (EndTime > ? AND ? > StartTime) ) ");
            $query->execute([$_POST["id"] ,$_POST["day"] ,  $newTime ,  $_POST["start"],  $_POST["start"] ,  $newTime ]);
            $data = $query->fetchAll();
            //if data is zero, it means there are no results conflicting with the new workload 
            if(count($data)==0){
                try { // this try catch block is added in order to inform the user whenever he is trying to insert a professor at a time he already has workload
                    $query= $this->conn->prepare("INSERT INTO professor_calendar_workload
                                        values (?,?,?,?,?,?,1,?,?)");
                    $query->execute([$_POST["id"] , $_POST["courseId"] , $_POST["value"] , $_POST["day"] , $_POST["start"] , $newTime, $_POST["section"] , $Semester[0]['Id'] ]);

                    echo json_encode(array("status"=>"Success"));
                } catch (PDOException $e) {

                    echo json_encode("Error: " . $e->getMessage());
                }
            }else{

                echo json_encode(array("status"=>"Αποτυχία: Ελέγξτε το πρόγραμμα του καθηγητή!"));
            }
        }else{
            //insertion at the all-day label of the calendar
            $query= $this->conn->prepare("INSERT INTO professor_calendar_workload
                                values (?,?,?,?,0,null,0,?,?)");
            $query->execute([$_POST["id"] , $_POST["courseId"] , $_POST["value"] , $_POST["day"] , $_POST["section"] , $Semester[0]['Id'] ]);

            echo json_encode(array("status"=>"Success"));
        }
             
    }

    //API for ajax updateting partner's calendar workload
    public function CalendarUpdate()
    { 
            //here we check if there is any conflict between the insertion and any other workload on the same day for that prof
            $query = $this->conn->prepare("SELECT * 
                                    FROM professor_calendar_workload
                                    WHERE ProfessorId = ? and Day = ? and (
                                          ( StartTime < ? AND ? < EndTime) OR (EndTime > ? AND ? > StartTime) )
                                           AND NOT ( ProfessorId = ? 
                                                    AND Day = ?
                                                    AND StartTime = ?
                                                    AND EndTime = ?  ); ");
            $query->execute([$_POST["id"] ,$_POST["newdate"] ,  $_POST["newendtime"] ,  $_POST["newstarttime"],  $_POST["newstarttime"] , $_POST["newendtime"] ,
                                $_POST["id"] , $_POST['olddate'] ,  $_POST['oldtime'] ,  $_POST['oldtimeEnd']  ]);
            $data = $query->fetchAll();
            //if data is zero, it means there are no results conflicting with the new workload 
            if(count($data)==0){
                //update partner's workload
                $query= $this->conn->prepare("UPDATE professor_calendar_workload
                                        SET ProfessorId= ?, CourseId = ?, ActivityId=? , Day=? ,StartTime=?, EndTime=?, Duration=?
                                        WHERE ProfessorId =? AND CourseId =? AND Day=? AND StartTime=? and SectionNumber=?");
                $query->execute([ $_POST["id"] , $_POST["courseId"] , $_POST["value"] , $_POST["newdate"] ,$_POST["newstarttime"] ,$_POST["newendtime"],
                                    $_POST['duration'] , $_POST["id"] , $_POST["courseId"],$_POST['olddate'], $_POST['oldtime'], $_POST['section'] ]);
                
                echo json_encode(array('status' => 'Success'));
            }else{

                echo json_encode(array("status"=>"Αποτυχία: Ελέγξτε το πρόγραμμα του καθηγητή!"));
            }

    }

    //API for ajax updateting event on calendar, either activity,partner or section
    public function CalendarUpdateEdit()
    { 
            //here we check if there is any conflict between the insertion and any other workload on the same day for that prof
            $query = $this->conn->prepare("SELECT * 
                                    FROM professor_calendar_workload
                                    WHERE ProfessorId = ? and Day = ? and (
                                          ( StartTime < ? AND ? < EndTime) OR (EndTime > ? AND ? > StartTime) )
                                           AND NOT ( ProfessorId = ? 
                                                    AND Day = ?
                                                    AND StartTime = ?
                                                    AND EndTime = ?  ); ");
            $query->execute([$_POST["newProf"] , $_POST["date"] ,  $_POST["endTime"] ,  $_POST["time"],  $_POST["time"] , $_POST["endTime"] ,
                                $_POST["newProf"] , $_POST['date'] ,  $_POST['time'] ,  $_POST['endTime']  ]);
            $data = $query->fetchAll();
            if(count($data)==0){
            
            //update partner's workload
            $query= $this->conn->prepare("UPDATE professor_calendar_workload
                                    SET ProfessorId= ?, CourseId = ?, ActivityId=? , Day=? ,StartTime=? , SectionNumber = ?
                                    WHERE ProfessorId =? AND CourseId =? AND Day=? AND StartTime=? ");
            $query->execute([ $_POST["newProf"] ,$_POST["courseId"] , $_POST["newActivity"] , $_POST["date"] ,$_POST["time"] , $_POST["section"] ,$_POST["profid"],
                                $_POST["courseId"],$_POST['date'], $_POST['time'] ]);
            //$data = $query->fetchAll(); 
            }
            
    }
    //API for ajax deleting partner's calendar workload
    public function CalendarDelete()
    { 
            //data: {profid: profid , activityid: activityid , date: mysqlDatetime , courseId: courseId ,time: sqlStarttime},
            //delete partner's workload
            $query= $this->conn->prepare("DELETE FROM professor_calendar_workload
                                    WHERE ProfessorId =? AND CourseId =? AND ActivityId =? AND Day=? AND StartTime=? and SectionNumber=?");
            $query->execute([ $_POST["profid"] ,$_POST["courseId"] , $_POST["activityid"] , $_POST["date"] ,$_POST["time"],$_POST["section"] ]);
            //$data = $query->fetchAll();          
    }
    
    //API for ajax request in livesearch, work for both requests, one for unenrolled professors and two for enrolled in course
    public function get_users()
    { 
            $data = array();
            //enrolled is 0 when it is called for the whole database porfessors
            if($_GET['enrolled'] == 0)
            {
                $courseID= $_GET['courseId'];
                //get all possible partners
                $query= $this->conn->prepare("SELECT d.Id,d.firstname,d.LastName
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
            }else if ($_GET['enrolled'] == 1){
                //and it is 1 when i want to search only for the enrolled

                $courseID= $_GET['courseId'];
                //get all possible partners
                $query= $this->conn->prepare("SELECT d.Id,d.firstname,d.LastName
                                        FROM user as d
                                        inner join course_has_professor on ProfessorId = d.Id
                                        WHERE (d.LastName LIKE '%".$_GET["query"]."%' || d.firstname LIKE '%".$_GET["query"]."%' 
                                                || CONCAT(d.firstname, ' ', d.lastname) LIKE '%".$_GET["query"]."%') 
                                                AND CourseId = ? 
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
            }
            
            echo json_encode($data);

    }

    //API for ajax submit partners as a role
    public function SubmitPartners()
    { 
        if (isset($_GET["id"]) && isset($_GET['role']) )
        {
            //insert partner
            $query= $this->conn->prepare("INSERT INTO course_has_professor
                                values (?,?,?)");
            $query->execute([$_GET["courseId"] , $_GET["id"], $_GET['role']]);
            
        }
    }

    //API for inserting activity in a course 
    public function AddActivityInCourse()
    {
        //find current semester's Id
        
        $query= $this->conn->prepare("SELECT Id
                                FROM Semester_period
                                Where Current=1");
        $query->execute();
        $Semester= $query->fetchAll();
        for ($i=1; $i<=$_GET['section']; $i++ )
        {
            //insert activity into semester
            $query= $this->conn->prepare("INSERT INTO course_workload
                                values (?,?,?,?,?,?)");
            $query->execute([$_GET["courseId"] , $_GET["activityId"], $i , $_GET['hours'], ($_GET['hours'] /13 ), $Semester[0]['Id']]);
        }
    }
    
    //API for editting activity in a course 
    public function EditActivityInCourse()
    {
        //edit existing activity
        $query= $this->conn->prepare("UPDATE course_workload
                                SET SemesterHours = ? , weeklyHours = ?
                                WHERE CourseId = ? and ActivityId = ? and SectionNumber=?");
        $query->execute([$_GET['hours'], ($_GET['hours'] /13 ),$_GET["courseId"] , $_GET["activityId"], ($_GET['sectionNumber'] )]);

    }
    //API for inserting professor's workload
    public function AddProfessorWorkload()
    {
        //insert workload
        $query= $this->conn->prepare("INSERT INTO professor_workload
                                values (?,?,?,?,?,?)");
        $query->execute([$_GET["partnerid"],$_GET["courseId"] , $_GET["activityId"], ($_GET['hours'] /13 ), $_GET['hours'], $_GET['sectionNum']]);

    }
    
    //API for getting remaining time for an activity
    public function getHoursLeftForActivity()
    {
        //get remaining workload for that activity
        $query= $this->conn->prepare("SELECT SemesterHours - (SELECT sum(semester_hours)
                                            FROM professor_workload
                                            where CourseId = ? and ActivityId = ? and SectionNumber=?) AS total
                                from course_workload
                                where courseId =? AND ActivityId = ? and SectionNumber =?");
        $query->execute([$_GET["courseId"] , $_GET["activityId"], $_GET['sectionNumber'],$_GET["courseId"] , $_GET["activityId"], $_GET['sectionNumber']]);
        $data = $query->fetchAll();
        
        if ($data[0]['total'] == null){ //here i go if there is no workload set, so i get the full initial workload
            $query= $this->conn->prepare("SELECT SemesterHours as total
                                    from course_workload
                                    where courseId =? AND ActivityId = ? and SectionNumber =?");
                    $query->execute([$_GET["courseId"] , $_GET["activityId"], $_GET['sectionNumber']]);
        $data = $query->fetchAll();
        }

        echo json_encode($data);

    }

    //API for inserting workload on plot
    public function PlotWorkload()
    {
        $data = array();  

        $stmt = $this->conn->prepare("SELECT ActivityId, SemesterHours , weeklyHours , Activities
            FROM course_workload , activities as d
            WHERE CourseId = ? and d.Id = ActivityId");    
        $stmt->execute([$_GET["courseId"]]); 
        $activities = $stmt->fetchAll(); 

        foreach($activities as $row)
            {
                $data[] = array(
                    'activity' => $row["Activities"],
                    'id' => $row["ActivityId"],
                    'Hours' => $row["SemesterHours"]
                );
            }

        echo json_encode($data);
    }

    //API for getting the section number
    public function GetActivitiesMaxSectionNumber()
    { 
            $data = array();
            //insert partner
            $stmt= $this->conn->prepare("SELECT MAX(SectionNumber) as maxNum
                                FROM course_workload
                                where CourseId= ? and ActivityId=?");
            $stmt->execute([$_GET["CourseId"] , $_GET["activityid"]]);
            $data = $stmt->fetchAll();
        
            echo json_encode($data);
        
    }

    //insert students
    public function InsertStudents()
    { 
        $courseID = $_GET['CourseId'];

        $stmt = $this->conn->prepare("SELECT CourseTitle, LessonCode
                    FROM perigrammata_db.courses
                    WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 
        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/InsertStudents.php';
    }

    //insert students
    public function UploadStudentsToDb()
    { 
        require '../../vendor/autoload.php';
        $courseID = $_POST['courseId'];
        
        if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            // Get the temporary file path
            $tmpFilePath = $_FILES['file']['tmp_name'];
          
            // Load the Excel file using PhpSpreadsheet
            try {
                $spreadsheet = IOFactory::load($tmpFilePath);
                // Rest of the code...
            } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                echo 'Error loading the Excel file: ', $e->getMessage();
            }

            // Process the Excel file as needed
            // Example: Read data from the uploaded file
            $worksheet = $spreadsheet->getActiveSheet();

            foreach ($worksheet->getRowIterator() as $Id=>$row) {
                //echo PHP_EOL;
                //echo $Id;
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
                                                                   //    even if a cell value is not set.
                                                                   // For 'TRUE', we loop through cells
                                                                   //    only when their value is set.
                                                                   // If this method is not called,
                                                                   //    the default value is 'false'.
                                                                   
                $rowData = [];
                foreach ($cellIterator as $cell) {
                        $rowData[] = $cell->getValue();    
                }
                $i = 0;
                if ($Id!= 1){
                    //here we insert the student
                    $stmt = $this->conn->prepare("INSERT INTO Student_Table
                            VALUES (?,?,?,?,?,?,?,?,?)");    
                    $stmt->execute([$rowData[$i+2] , $rowData[$i+1] , $rowData[$i+4] , $rowData[$i+3], $rowData[$i+5], $rowData[$i+6],
                                     $rowData[$i+7], $rowData[$i+8], $rowData[$i+10] ]); 

                    //here we insert the enrollment
                    $stmt = $this->conn->prepare("INSERT INTO Enrollement_Table
                            VALUES (?,?,?,NULL,NULL)");    
                    $stmt->execute([$rowData[$i+2] ,$courseID , $rowData[$i] ]); 
                    
                    //here we insert the course code for the current semester
                    //first we find the id of the current semester
                    
                    $stmt = $this->conn->prepare("SELECT Id
                            FROM Semester_period
                            WHERE Current = 1");    
                    $stmt->execute();
                    $SemesterId = $stmt->fetchAll();

                    //then we delete the course code for the current semester if it's already set, in case anything goes wrong
                    $stmt = $this->conn->prepare("DELETE FROM courses_code_per_semester
                            WHERE semesterId=? and courseId=?");    
                    $stmt->execute([$SemesterId[0]['Id'], $courseID  ]);
                    //and then we insert the code for the course at the specific semester
                    $stmt = $this->conn->prepare("INSERT INTO courses_code_per_semester
                            VALUES (?,?,?)");    
                    $stmt->execute([$rowData[$i] , $courseID , $SemesterId[0]['Id'] ]);
                }
            }
          } else {
            echo "Error uploading file.";
          }
    }

    //insert student's grades
    public function StudentGrades()
    { 
        $courseID = $_GET['CourseId'];
        
       
        $stmt = $this->conn->prepare("SELECT CourseTitle, LessonCode
                    FROM perigrammata_db.courses
                    WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 
        //first we find the id of the current semester
                            
        $stmt = $this->conn->prepare("SELECT Id
                    FROM Semester_period
                    WHERE Current = 1");    
        $stmt->execute();
        $SemesterId = $stmt->fetchAll();
        
        //then we find the code for the current semester
                            
        $stmt = $this->conn->prepare("SELECT codeId
                    FROM courses_code_per_semester
                    WHERE semesterId = ? and courseId = ?");    
        $stmt->execute([ $SemesterId[0]['Id'] ,$courseID ]);
        $course_code = $stmt->fetchAll();
        //if no students are inserted for this current year course_code will be empty
        //and then we retrieve the students for the selected course
        if(!empty($course_code)){
            $stmt = $this->conn->prepare("SELECT s.student_am, s.first_name, s.lastname, e.grade , t.FirstName , t.LastName
                            FROM Student_Table s
                            JOIN Enrollement_Table e ON s.student_am = e.student_id
                            JOIN courses_code_per_semester c ON e.code_id = c.codeId
                            left JOIN user t on t.Id=e.grade_by
                            WHERE e.code_id = ?
                            AND c.semesterId = ?");    
            $stmt->execute([$course_code[0]['codeId'] , $SemesterId[0]['Id']]); 
            $students = $stmt->fetchAll(); 
        }else{
            $students = array();
        }
        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/StudentsGrades.php';
    }

    //api for submitting each grade for a student at a specific course for a specific year
    public function InsertGrades(){
        
        $courseID = $_POST['courseId'];
        $courseCode = $_POST['courseCode'];
        $studentAM = $_POST['studentAm'];
        $grade = $_POST['grade'];
        $profid = $_POST['profid'];
        
        //insert new grade 
        $stmt = $this->conn->prepare("UPDATE Enrollement_Table
                        SET grade = ? , grade_by =?
                        WHERE student_id = ?
                        AND code_id = ?
                        AND course_id = ?");    
        $stmt->execute([$grade  , $profid, $studentAM ,$courseCode , $courseID ]); 
    }

    public function OlderGrades(){
        
        $courseID = $_GET['CourseId'];
        
        $stmt = $this->conn->prepare("SELECT CourseTitle, LessonCode
                    FROM perigrammata_db.courses
                    WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        $stmt = $this->conn->prepare("SELECT c.Id, c.Start_date, c.End_date, c.Start_year,c.End_year,.c.Title
                        FROM courses_code_per_semester
                        inner join Semester_period as c on c.Id=semesterId
                        WHERE courseId=? and c.Current=0");    
        $stmt->execute([$courseID]); 
        $Semesters = $stmt->fetchAll();
        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/OlderGrades.php';
    }
    //api for generate the excel
    public function generate_excel(){
        require '../../vendor/autoload.php';

        $code = $_GET['courseCode'];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Κωδικός');
        $sheet->setCellValue('B1', 'Φοιτητής');
        $sheet->setCellValue('C1', 'ΑΕΜ');
        $sheet->setCellValue('D1', 'Επώνυμο');
        $sheet->setCellValue('E1', 'Όνομα');
        $sheet->setCellValue('F1', 'Πατρώνυμο');
        $sheet->setCellValue('G1', 'Κατάσταση');
        $sheet->setCellValue('H1', 'Έτος εισαγωγής');
        $sheet->setCellValue('I1', 'Εξάμηνο');
        $sheet->setCellValue('J1', 'Τμήμα τάξης');
        $sheet->setCellValue('K1', 'Κατάσταση δήλωσης μαθήματος');
        $sheet->setCellValue('L1', 'Βαθμός');

        $stmt = $this->conn->prepare("SELECT student_code , student_id, t.lastname,t.first_name ,t.father_name,t.status ,t.year_of_enrollment,t.semester,t.declaration_status,grade
                        from Enrollement_Table 
                        inner join Student_Table as t on student_id=t.student_am
                        where code_id = ?");
        $stmt->execute([$code]);
        $students=$stmt->fetchAll();

        $excelRow= 2;
        foreach($students as $row)
        {
            $sheet->setCellValue('A' . $excelRow, $code);
            $sheet->setCellValue('B' . $excelRow, $row['student_code']);
            $sheet->setCellValue('C' . $excelRow, $row['student_id']);
            $sheet->setCellValue('D' . $excelRow, $row['lastname']);
            $sheet->setCellValue('E' . $excelRow, $row['first_name']);
            $sheet->setCellValue('F' . $excelRow, $row['father_name']);
            $sheet->setCellValue('G' . $excelRow, $row['status']);
            $sheet->setCellValue('H' . $excelRow, $row['year_of_enrollment']);
            $sheet->setCellValue('I' . $excelRow, $row['semester']);
            $sheet->setCellValue('J' . $excelRow, '');
            $sheet->setCellValue('K' . $excelRow, $row['declaration_status']);
            $sheet->setCellValue('L' . $excelRow, $row['grade']);
            $excelRow++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('file.xlsx');

        // Output the Excel file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Βαθμοί.xlsx"');
        header('Cache-Control: max-age=0');

        readfile('file.xlsx');

    }

    //api for getting older grades
    public function GetOlderGradesForSelectedSemester()
    {
        
        $semester = $_GET['semester'];
        $courseId = $_GET['courseId'];
        
        $stmt = $this->conn->prepare("SELECT s.student_am, s.first_name, s.lastname, e.grade
                            FROM Student_Table s
                            JOIN Enrollement_Table e ON s.student_am = e.student_id
                            JOIN courses_code_per_semester c ON e.code_id = c.codeId
                            WHERE CourseId=?
                            AND c.semesterId = ?");
        $stmt->execute([$courseId, $semester]);
        
        $students=$stmt->fetchAll();

        echo json_encode($students);
    }

    //handle evaluation methods
    public function EditLearningOutcomes()
    {
        $courseID = $_GET['CourseId'];
        

        $Course = $this->CourseModel->getCourse($_GET['CourseId']);
        $CourseMethod = $this->CourseModel->getCourseMethod($_GET['CourseId']);
        $Assessments = $this->CourseModel->getCategoriesAssessment($Course['LangId']);

        $bonus = $this->CourseModel->getBonus($Course['LangId']);

        $CourseAssessment2 = $this->CourseModel->getCourseAssessmentNew($_GET['CourseId']);

        $stmt = $this->conn->prepare("SELECT CourseTitle, LessonCode
                    FROM courses
                    WHERE Id = ?");    
        $stmt->execute([$courseID]); 
        $title = $stmt->fetchAll(); 

        $stmt = $this->conn->prepare("SELECT RoleId
                    FROM course_has_professor
                    WHERE CourseId = ? AND ProfessorId =?");    
        $stmt->execute([$courseID , $_SESSION['user_id']]); 
        $role = $stmt->fetchAll(); 

        $stmt = $this->conn->prepare("SELECT max(method_number) as num
                    from course_has_category
                    where courseid=?");
        $stmt->execute([$courseID]);
        
        $methods=$stmt->fetchAll();
        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/EditEvaluationMethods.php';
        require APP . 'views/templates/footer1.php';

    }

    //to store the new evaluation details
    public function updateLearningOutcomes()
    {
                $courseID = $_GET['CourseId'];
                //var_dump($_POST['subcategories_1']);
                $_POST["subcategories_1"] = isset( $_POST["subcategories_1"] ) ? $_POST["subcategories_1"] : array();
                $_POST["subcategories_2"] = isset( $_POST["subcategories_2"] ) ? $_POST["subcategories_2"] : array();
                $_POST["subcategories_3"] = isset( $_POST["subcategories_3"] ) ? $_POST["subcategories_3"] : array();
                $_POST["subcategories_4"] = isset( $_POST["subcategories_4"] ) ? $_POST["subcategories_4"] : array();
                // print_r(array_unique($_POST["Verbs"]));
 
                 $flag = 0;
                // foreach($_POST["totalScore_"] as $Id=> $Score){
                //     if($Score != '100')
                //     {
                //         $flag =1;
                //         header('location: ' . URL . 'ProfessorNewController/EditLearningOutcomes?CourseId= '. $courseID .'&flag=' .$flag );
                        
                //     }
                // }
                $activeVerbs = 0;
                $uniqueVerbs = 0;
                $duplicate = false;

                $sentences = '';
                

                if($flag){
                     // Array has duplicates
                     $_SESSION['g_message'] = 'Error, the same verb cannot be used twice!';
                     $_SESSION['sentences'] = $sentences;
                }else{
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

                    //Array does not have duplicates
                    $this->CourseModel->updateLearningOutcomes($courseID,  $percentage , $bonus, $subcategories_1,
                        $subcategories_2, $subcategories_3, $subcategories_4);
                }

             
            header('location: ' . URL . 'ProfessorNewController/EditLearningOutcomes?CourseId= '. $courseID );
    }
    //function to add new method
    public function addNewEvaluationMethod()
    {
        
        if(isset($_POST['finish_creation1']))
        {
            
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
                    $stmt = $this->conn->prepare("INSERT INTO  course_has_category
                    values (?,?,?,?,?,?,?,?,?,?) ");
                    $stmt->execute([$courseId , $method , $i , $_POST["bonus"][$i],$_POST['percentage'][$i],
                                    $sub1 , $sub2, $sub3, $sub4,null]);
                }
            }

        }

        header('location: ' . URL . 'ProfessorNewController/EditLearningOutcomes?CourseId= '. $courseId );
    }

    //function for deleting a method
    public function DeleteMethod(){

        $stmt = $this->conn->prepare("DELETE FROM  course_has_category
                WHERE CourseId=? and method_number = ? ");
        $stmt->execute([$_GET['courseId'] , $_GET['methodNumber']]);
    }
}