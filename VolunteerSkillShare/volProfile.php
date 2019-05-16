<?php 
    include '_header.php';
    //include '_enforceLogin.php';
?>


    
    <body id="activePage">
        
        <div class="jumbotron text-center">
        <h1>VOLUNTEER SKILL SHARE</h1><br/>
        <h2>Welcome <?=$_SESSION['username']?>!</h2><br/>
        </div>
        
        <!-- Navigation Bar-->
        <ul class="nav nav-pills">
          <li role="presentation"><a href="index.php">Home</a></li>
          <li role="presentation" class="active"><a href="volProfile.php">Volunteer Profile</a></li>
          <li role="presentation"><a href="volProfileEdit.php">Profile Editor</a></li>
          <li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>
        </ul>
        
       <!-- code -->
       
       
        
<<<<<<< HEAD
        <?php include '_footer.php'; ?>
=======
        <!-- This is the footer -->
        <?php include '_footer.php';
>>>>>>> 5a2bf9f34dc627671cc2c130823dfe0a760a9204
