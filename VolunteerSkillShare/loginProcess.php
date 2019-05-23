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
        
        $userInfo = getAuthUserByUserName($username);
        
        $_SESSION['userid'] = $userInfo['UserID'];
        $_SESSION['role'] = strtoupper($userInfo['Role']);
        $_SESSION['fname'] = $userInfo['FirstName'];
        $_SESSION['lname'] = $userInfo['LastName'];
        
        /*
        $_SESSION['userid'] = getAuthUserID($username);
        $_SESSION['role'] = getAuthUserRole($username);
        */
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
        header("Location:index.php");
    }
    
?>