<?php
    include "storedProcedureCalls.php";
    
    //using session varaibles to store admin name and display on other pages
    session_start();
    if(!isset($_POST['fName']) || !isset($_POST['lName']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['account']))
    {
        header("Location:login.php");
    }
    
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $accountType = $_POST['account'];
    
    $insertAccount = setInsertAuthUser($accountType, $fname, $lname, $email, $password);
    
    //Called to 'login' user
    $userInfo = getAuthUserByUserName($username);
    
    
    if(empty($insertAccount))
    {
        $_SESSION['incorrect'] = false;
        $_SESSION['username'] = $email;
        
        
        $userInfo = getAuthUserByUserName($username);
        
        $_SESSION['userid'] = $userInfo['UserID'];
        $_SESSION['role'] = strtoupper($accountType);
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        
        if($_SESSION['role'] == 'V')
        {
            $_SESSION['orgid'] = null;
            $_SESSION['volid'] = $userInfo['VolunteerID'];
            header("Location:newVolProfile.php");
        }
        elseif($_SESSION['role'] == 'O')
        {
            $_SESSION['orgid'] = $userInfo['OrgID'];
            $_SESSION['volid'] = null;
            header("Location:orgProfileEdit.php");
        }
    }
    else
    {
        $_SESSION['incorrect'] = true;
        header("Location:login.php");
    }
    
?>
