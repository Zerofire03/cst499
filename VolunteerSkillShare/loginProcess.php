<?php

    include "storedProcedureCalls.php";
    
    //using session varaibles to store admin name and display on other pages
    session_start();
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $authSuccess = getAuthenticatedUser($username, $password);
    
    
    if($authSuccess == 1)
    {
        $_SESSION['incorrect'] = false;
        header("Location:testPass.html");
    }
    else
    {
        $_SESSION['incorrect'] = true;
        header("Location:testFail.html");
    }
    
?>