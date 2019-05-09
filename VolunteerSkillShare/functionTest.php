<?php
//This page is for testing functions of SP's as they are written

    include "storedProcedureCalls.php";
    session_start();
    
    echo "Hello world!\n";
    $return_value = getAuthUserID("testvol1@test.com");
    echo $return_value;
    //echo $_SESSION['userid'];
    //deleteAuthUser($_SESSION['userid']);
    //unset($_SESSION['userid']);
?>