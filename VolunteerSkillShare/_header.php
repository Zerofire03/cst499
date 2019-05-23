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
        <style>@import url("css/styles.css");</style>
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed&display=swap" rel="stylesheet">
    </head>

    <body id="activePage">
        
        <div class="mainLogo">
            <h2>Welcome <?=$_SESSION['fname']?> To</h2>
            <h1>VOLUNTEER SKILL SHARE</h1>
            
             <!--Navigation Bar-->
            <?php include '_navBar.php'; ?>
        </div>
