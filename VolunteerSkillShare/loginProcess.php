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
        
        $userInfo = getAuthUserByUserName($username);
        
        $_SESSION['userid'] = $userInfo['UserID'];
        $_SESSION['username'] = $userInfo['UserName'];
        $_SESSION['role'] = strtoupper($userInfo['Role']);
        $_SESSION['fname'] = $userInfo['FirstName'];
        $_SESSION['lname'] = $userInfo['LastName'];
        
        if($_SESSION['role'] == 'V')
        {
            $_SESSION['volid'] = $userInfo['VolunteerID'];
            header("Location:volProfile.php");
        }
        elseif($_SESSION['role'] == 'O')
        {
            $_SESSION['orgid'] = $userInfo['OrgID'];
            header("Location:orgProfile.php");
        }
    }
    else
    {
        header("Location:index.php");
    }
    
?>