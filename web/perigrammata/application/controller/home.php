<?php
/**
 * Class Home
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 */
class Home extends Controller
{

    /**
     * PAGE: index  
     */
    public function index()
    {
        error_reporting(0);
        header('Cache-Control: no cache'); //no cache
        session_cache_limiter('none'); // works
        //session_cache_limiter('public'); // works too
        
        $hour = 3600; // 1 hour, 3600 sec 	
        	
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $hour * 24)) {	
            if(!isset($_SESSION))    	
            { 	
                // server should keep session data for AT LEAST one day	
                //ini_set('session.gc_maxlifetime', $hour * 24);	
                // each client should remember their session id for EXACTLY one day	
                //session_set_cookie_params($hour * 24);     	
                session_start(); // ready to go	
            } 	
            $_SESSION = array();	
            //session_destroy();	


        }
        // load views


        
        if( isset( $_SESSION['logged'] ) && $_SESSION['user_profile'] == 4 ){
            require APP . 'views/templates/header.php';
            require APP . 'views/home/IndexStudent.php';
            require APP . 'views/templates/footer.php';
        }
        else if( isset( $_SESSION['logged'] ) && $_SESSION['user_profile'] == 2 )
        {
            //var_dump($_SESSION['user_id']);
            $submitedCourses = $this->CourseModel->submitedCourses();
            //$professorCourses = $this->CourseModel->getAllProfessorCourses($_SESSION['user_id']);
            $professorCourses = $this->CourseModel->getAllProfessorCourses($_SESSION['user_id']); 
            require APP . 'views/templates/header1.php';
            require APP . 'views/home/HomeProfessor.php';
        }
        // else if( isset( $_SESSION['logged'] ) && $_SESSION['user_profile'] == 3 ){
            // require APP . 'views/home/IndexSelectProf.php';
        // }
        else if( isset( $_SESSION['logged'] ) && $_SESSION['user_profile'] == 3 ){
            require APP . 'views/templates/header.php';
            require APP . 'views/home/IndexSelectProf.php';
            require APP . 'views/templates/footer.php';
        }
        else{
            require APP . 'views/templates/header.php';
            require APP . 'views/index.php';
            require APP . 'views/templates/footer.php';
        }
        
    }

    public function ChangeLanguage()
    {
        if( isset( $_GET['lang'] ) )
        {
            $_SESSION['lang'] = $_GET['lang'];
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        
    }

}
