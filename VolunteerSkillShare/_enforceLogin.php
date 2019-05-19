<?php
    $fileName = basename($_SERVER['PHP_SELF']);
    echo $fileName;
    if(!isset($_SESSION['incorrect']))
    {
        //header("Location:index.php");
    }
    
    if(strlen(strstr($fileName, 'vol'))>0)
    {
        if($_SESSION['role'] != 'V')
        {
            header("Location:index.php");
        }
    }
    elseif(strlen(strstr($fileName, 'org'))>0)
    {
        if($_SESSION['role'] != 'O')
        {
            header("Location:index.php");
        }
    }
?>