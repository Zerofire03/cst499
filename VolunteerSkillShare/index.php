<?php
    //session_start();
    
    //include "dbConnection.php";
    
    //$conn = getDatabaseConnection("cst499-vss");
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Volunteer Skill Share</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>@import url("css/styles.css");</style>
        <link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates" rel="stylesheet">
    </head>
    
    <body id="activePage">
        
        <div class="jumbotron text-center">
        <h1>VOLUNTEER SKILL SHARE</h1>
        </div>
        
        <!-- Navigation Bar-->
        <ul class="nav nav-pills">
          <li role="presentation" class="active"><a href="index.php">Login</a></li>
          <li role="presentation"><a href="volProfile.php">Volunteer Profile</a></li>
          <li role="presentation"><a href="orgProfile.php">Organization Profile</a></li>
          <li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>
        </ul>
        
       <!--Login Process-->
        <div class="instructions">
        <h3><font color="black">Please Login</font></h3>
        <div id="loginBox">
        <form method="post" action="loginProcess.php">
            <input type="text" name="username" id="username" placeholder="UserName"/>
            <input type="password" name="password" id="password" placeholder="Password"/>
            <br>
            <button class="btn btn-primary" type="submit" value="Login">Login</button>
        </form>
        </div>
        </div>
        
        <!--Create Account Process-->
        
        <div class="instructions">
        <h3><font color="black">Sign Up</font></h3>
        <div id="accountBox">
        <form method="post" action="VolunteerSkillShare/insertAuthUser.php">
            <input type="text" name="fName" id="fName" placeholder="First Name" size="20"/> <input type="text" name="lName" id="lName" placeholder="Last Name" size="20"/> <br>
            <input type="text" name="email" id="email" placeholder="Email" size="42"/> <br>
            <input type="password" name="password" id="passwordA" placeholder="Password" size="42"/> <br>
            <input type="radio" name="account" id="volunteer" value="V"> Volunteer <input type="radio" name="account" id="organization" value="O"> Organization<br>
            <button class="btn btn-primary" type="submit" value="signUp">Sign Up</button>
        </form>
        </div>
        </div>
        
        <!-- This is the footer -->
        <footer>
            <hr id="hr_footer">
                CST 499 Group Capstone. 2019&copy; Buckey, Gonzalez, Holmes, Loeser<br />
                <strong>Disclaimer:</strong> The information in this webpage is fictious.<br />
                It is used for academic purposes only.
                
                <figure id="csumb">
                    <img src="Images/csumb_logo.png" alt="CSUMB Logo">
                </figure>
            
        </footer>
        <!-- closing footer -->
    </body>
    
</html>