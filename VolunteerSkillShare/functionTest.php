<?php
//This page is for testing functions of SP's as they are written

    include "storedProcedureCalls.php";
    session_start();
    
    echo "Hello world!\n";
    $userID = getUserID('foo1@gmail.com');
    echo $userID;
    //echo $_SESSION['userid'];
    //deleteAuthUser($_SESSION['userid']);
    //unset($_SESSION['userid']);
?>