<?php
    session_start();
?>

    <?php include '_header.php';?>
    <body id="activePage">
        
        <div class="jumbotron text-center">
        <h1>VOLUNTEER SKILL SHARE</h1>
        </div>
        
        <!-- Navigation Bar-->
        <ul class="nav nav-pills">
          <li role="presentation" class="active"><a href="index.php">Login</a></li>
          <?php 
            if(isset($_SESSION['incorrect']))
            {
                echo '<li role="presentation"><a href="volProfile.php">Volunteer Profile</a></li>'; 
                echo '<li role="presentation"><a href="orgProfile.php">Organization Profile</a></li>';
            }  
            ?>
          <li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>
        </ul>
        
       <!--Login Process-->
        <div class="<?php echo empty($_SESSION['incorrect']) ? 'show' : 'hidden';?>"
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
        
        <div class="<?php echo empty($_SESSION['incorrect']) ? 'show' : 'hidden';?>"
        <h3><font color="black">Sign Up</font></h3>
        <div id="accountBox">
        <form method="post" action="insertAuthUser.php">
            <input type="text" name="fName" id="fName" placeholder="First Name" size="20"/> <input type="text" name="lName" id="lName" placeholder="Last Name" size="20"/> <br>
            <input type="text" name="email" id="email" placeholder="Email" size="42"/> <br>
            <input type="password" name="password" id="passwordA" placeholder="Password" size="42"/> <br>
            <input type="radio" name="account" id="volunteer" value="V"> Volunteer <input type="radio" name="account" id="organization" value="O"> Organization<br>
            <button class="btn btn-primary" type="submit" value="signUp">Sign Up</button>
        </form>
        </div>
        </div>
        
<?php include '_footer.php';