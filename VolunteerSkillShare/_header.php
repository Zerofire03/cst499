<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Volunteer Skill Share</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <style>@import url("css/styles.css");</style>
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed&display=swap" rel="stylesheet">
    </head>

    <body id="activePage">
        
        <!--<div class="header">-->
        <!--    <p id="my-image"><img src= > -->
        <!--    </p> -->
        <!--    <div class="mainLogo">-->
                <!--<h2>Welcome <?=$_SESSION['fname']?></h2>-->
                <!--<h1>VOLUNTEER SKILL SHARE</h1>   -->
            <!--</div>-->
            
            <!--Navigation Bar-->
            <?php include '_navBar.php'; ?>
        <!--</div> -->
        
        
        
         <!--Navigation Bar-->
        <!--    <?php include '_navBar.php'; ?>-->
        <!--    <br> -->
            
        <!--<div class="jumbotron">-->
           
            
            <div class="mainLogo">
                <div class="centered">
                    <h2>Welcome <?=$_SESSION['fname']?></h2>
                </div>
                <img alt="Volunteer Skill Share" src="https://a121af0a084344629db4e685b409fe7f.vfs.cloud9.us-east-2.amazonaws.com/cst499/VolunteerSkillShare/Images/hadnshake_Teamwork.png">
                <!--<h1>VOLUNTEER SKILL SHARE</h1>   -->
            </div>  
        <!--</div>-->