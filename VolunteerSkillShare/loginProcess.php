<?php
    //using session varaibles to store admin name and display on other pages
    session_start();
    
    include "dbConnection.php";
    
    $conn = getDatabaseConnection("cst499-vss");
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    //echo $username;
    $sql;
    
    // calling stored procedure command
    $sql = 'CALL AuthenticateUser(:_UserName,@level)';
 
    // prepare for execution of the stored procedure
    $stmt = $pdo->prepare($sql);
 
    // pass value to the command
    $stmt->bindParam(':id', $customerNumber, PDO::PARAM_INT);
    
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
 
    // execute the stored procedure
    $stmt->execute();
    
    
?>