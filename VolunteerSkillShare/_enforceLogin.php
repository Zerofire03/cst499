<?php
    $fileName = basename($_SERVER['PHP_SELF']);
    if(!isset($_SESSION['incorrect']))
    {
        header("Location:index.php");
    }
    
    //Check if page is volSearch and make sure role is org
    if(strlen(strstr($fileName, 'volSearch'))>0)
    {
        if($_SESSION['role'] != 'O')
        {
            header("Location:index.php");
        }
    }
    
    //Check if volunteer page and vol role selected
    elseif(strlen(strstr($fileName, 'vol'))>0)
    {
        if($_SESSION['role'] != 'V')
        {
            header("Location:index.php");
        }
    }
    
    //Check if org page and org role
    elseif(strlen(strstr($fileName, 'org'))>0)
    {
        if($_SESSION['role'] != 'O')
        {
            header("Location:index.php");
        }
    }
?>