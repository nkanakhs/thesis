<?php
$db_username = 'perigrammata_db';  
$db_password = '@ad1p_c0urses_29_01_2020';
$conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
$db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));

try {    
    // prepare sql and bind parameters
    $sql = "UPDATE admin set AdminId = ?, ManagedDepartmentId = ? where UserId = ?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$AdminId,$ManagedDepartmentId,$UserId]);

    // insert a row   
    $stmt->execute();    
    //$lastId = $conn->lastInsertId();
    //$pdo->lastInsertId();
} catch(PDOException $e) {
    $_SESSION['g_message'] = 'Something went wrong!! Please try again.';
    //echo "Error: " . $stmt2 . "<br>" . $conn->error;
}


?>