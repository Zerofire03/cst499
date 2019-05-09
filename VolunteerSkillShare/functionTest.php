<html>
    <head>
        <title>Volunteer Skill Share</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <style>@import url("css/styles.css");</style>
        <link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates" rel="stylesheet">
    </head>

<?php
//This page is for testing functions of SP's as they are written

    include "storedProcedureCalls.php";
    session_start();
?>




    <body>
        
        <!--Login Process-->
        <div class="<?php echo !isset($_SESSION['incorrect']) ? 'show' : 'hidden';?>"
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
        
        <!--Logout Process-->
        <div id="logoutButton">
            <div class="<?php echo isset($_SESSION['incorrect']) ? 'show' : 'hidden';?>"
                <form method="post" action="logout.php">
                    <br>
                    <button class="btn btn-logout" type="submit" value="Logout">Logout</button>
                </form>
            </div>
        </div>
        
    </body>
</html>