<?php 
    include '_header.php';
    include '_enforceLogin.php';
?>
    
    <body id="activePage">
        
        <div class="jumbotron text-center">
        <h1>VOLUNTEER SKILL SHARE</h1><br/>
        <h2>Welcome <?=$_SESSION['username']?>!</h2><br/>
        </div>
        
        <!-- Navigation Bar-->
        <ul class="nav nav-pills">
          <li role="presentation"><a href="index.php">Home</a></li>
          <li role="presentation" class="active"><a href="orgProfile.php">Organization Profile</a></li>
          <li role="presentation"><a href="orgProfileEdit.php">Profile Editor</a></li>
          <li role="presentation"><a href="orgProject.php">Active Project</a></li>
          <li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>
          <?php echo isset($_SESSION['username']) ? '<li role="presentation"><a href="logout.php">Logout</a></li>' : ''; ?>
        </ul>
        
       <!-- code -->
       
       
       
       
       
       
       
       
       
       
       
        
        <!-- This is the footer -->
        <?php include '_footer.php';