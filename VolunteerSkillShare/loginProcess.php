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
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = getAuthUserID($username);
        $_SESSION['role'] = getAuthUserRole($username);
        if($_SESSION['role'] == 'V')
        {
            header("Location:volProfile.php");
        }
        elseif($_SESSION['role'] == 'O')
        {
            header("Location:orgProfile.php");
        }
    }
    else
    {
        $_SESSION['incorrect'] = true;
        header("Location:index.php");
    }
    
?>