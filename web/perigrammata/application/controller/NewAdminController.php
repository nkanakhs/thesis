<?php

class NewAdminController extends Controller{

    public function Workload(){

        if ($_SESSION['admin_id'] == 1){//institution admin

        }else if($_SESSION['admin_id'] == 2){//school admin

        }else if($_SESSION['admin_id'] == 3){//syllabus

        }else if($_SESSION['admin_id'] == 4){ //super admin
            $stmt1 = $this->conn->prepare("SELECT *
                                FROM perigrammata_db.school");
            $stmt1->execute(); 
            $schools = $stmt1->fetchAll();
        }


        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/SchoolAdminHome.php';
    }

    public function SearchCourse(){

        if ($_SESSION['admin_id'] == 1){//institution admin

        }else if($_SESSION['admin_id'] == 2){//school admin

        }else if($_SESSION['admin_id'] == 3){//syllabus

        }else if($_SESSION['admin_id'] == 4){ //super admin
            $stmt1 = $this->conn->prepare("SELECT *
                                FROM perigrammata_db.school");
            $stmt1->execute(); 
            $schools = $stmt1->fetchAll();
        }


        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/SchoolAdminSearchCourse.php';
    }

    public function SearchProfessor(){

        if ($_SESSION['admin_id'] == 1){//institution admin

        }else if($_SESSION['admin_id'] == 2){//school admin

        }else if($_SESSION['admin_id'] == 3){//syllabus

        }else if($_SESSION['admin_id'] == 4){ //super admin
            $stmt1 = $this->conn->prepare("SELECT *
                                FROM perigrammata_db.user
                                where ProfileId= 2 or ProfileId=3");
            $stmt1->execute(); 
            $users = $stmt1->fetchAll();
            

            $stmt = $this->conn->prepare("SELECT *
                            from Semester_period");  
                    $stmt->execute();   
            $semesters = $stmt->fetchAll();
            }

        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/SchoolAdminSearchProfessor.php';
    }

    //API for getting the courses of the selected course
    public function GetSchools(){

        $query= $this->conn->prepare("SELECT Id , CourseTitle
                    FROM courses
                    WHERE DepartmentId = ? and Semester=? ");
        $query->execute( [$_GET["SchoolId"], $_GET["Semester"]]);
        $data = $query->fetchAll();
        
        echo json_encode($data);
    }

    //API for getting the semesters of the selected school
    public function GetSemesters(){

        $query= $this->conn->prepare("SELECT distinct Semester
                    FROM courses
                    WHERE SchoolId = ? 
                    ORDER BY Semester ASC");
        $query->execute( [$_GET["SchoolId"]]);
        $data = $query->fetchAll();
        
        echo json_encode($data);
    }

    //API for getting the Course's Workload
    public function TableWorkloadResults(){

        $query= $this->conn->prepare("SELECT ProfessorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , q.activities, t.Start_year, t.End_year , t.title
                from professor_calendar_workload
                inner join user as d on d.Id=ProfessorId
                inner join activities as q on q.Id=ActivityId
                inner join Semester_period as t on t.Id in (SELECT Id from Semester_period where current = 1 )
                where courseId= ? and (Day < t.End_date and Day > t.Start_date)
                group by ProfessorId , ActivityId , SectionNumber,t.Start_year, t.End_year , t.title");
        $query->execute( [$_GET["courseId"]]);
        $data = $query->fetchAll();
        
        echo json_encode($data);
    }

    //API for getting the Professor's Workload
    public function ProfWorkloadResults(){

        $query= $this->conn->prepare("SELECT ProfessorId, ActivityId, SectionNumber , sum(duration) as total , d.firstname, d.lastname , l.CourseTitle, q.activities, t.Start_year, t.End_year , t.title
                        from professor_calendar_workload
                        inner join user as d on d.Id=ProfessorId
                        inner join activities as q on q.Id=ActivityId
                        inner join courses as l on l.Id=CourseId
                        inner join Semester_period as t on t.Id in (SELECT Id from Semester_period where Id = ? )
                        where Day < t.End_date and Day > t.Start_date and d.Id=? and t.Id= ?
                        group by ProfessorId , ActivityId ,CourseTitle, SectionNumber,t.Start_year, t.End_year , t.title");
        $query->execute( [$_GET["semester"] , $_GET["profId"], $_GET["semester"]]);
        $data = $query->fetchAll();
        
        echo json_encode($data);
    }

    public function InsertCurrentSemester()
    {
        $query= $this->conn->prepare("SELECT *
                    FROM Semester_period
                    WHERE Current = 1");
        $query->execute();
        $currentSemester = $query->fetchAll();

        require APP . 'views/templates/header1.php';
        require APP . 'views/ManageWorkload/SchoolAdminInsertCurrentSemester.php';
    }

    public function SubmitSemester(){
        
        $startyear = date('Y', strtotime($_POST['starting-date']));
        $endyear = date('Y', strtotime($_POST['ending-date']));

        $query= $this->conn->prepare("UPDATE Semester_period
                    SET Current = 0
                    WHERE Current = 1");
        $query->execute();
        
        $query= $this->conn->prepare("SELECT  max(Id) as id
                    FROM Semester_period");
        $query->execute();
        $maxId = $query->fetchAll();
        $ptr= $maxId[0]['id'] + 1;

        $timestamp = strtotime($_POST['starting-date']);

        // Convert the timestamp to the SQL date format 'YYYY-MM-DD'
        $sql_date_start = date('Y-m-d', $timestamp);

        
        $timestamp1 = strtotime($_POST['ending-date']);

        // Convert the timestamp to the SQL date format 'YYYY-MM-DD'
        $sql_date_end = date('Y-m-d', $timestamp1);

        if($_POST['SemesterType']==1){
            $type='Χειμερινό';
            $endyear = $startyear +1;
        }else{
            $type='Εαρινό';
            $startyear = $endyear -1;
        }
        $query= $this->conn->prepare("INSERT INTO Semester_period
                    VALUES (?,?,?,?,?,?,1)");
        $query->execute([$ptr ,$sql_date_start, $sql_date_end, $startyear,$endyear ,$type]);
        
        header('location:' . URL . 'NewAdminController/InsertCurrentSemester');
    }
}
?>