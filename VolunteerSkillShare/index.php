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
        <!--<style>@import url("css/styles.css");</style>-->
    </head>
    
    <body>
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
    </body>
    
</html>