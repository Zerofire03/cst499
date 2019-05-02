<?php

    include "storedProcedureCalls.php";
    
    //using session varaibles to store admin name and display on other pages
    session_start();
    
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $accountType = $_POST['account'];
    
    $insertAccount = setInsertAuthUser($accountType, $email, $password);
    
    
    if(empty($insertAccount))
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