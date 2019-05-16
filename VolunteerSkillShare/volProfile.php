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


            <p>Volunteer ID</p>  <input type="text" readonly="readonly" name ="volunteerid">

            <p>First Name</p>  <input type="text" readonly="readonly" name ="firstname">       
       
            <p>Last Name</p>  <input type="text" readonly="readonly" name ="lastname">
      
            <p>City</p>  <input type="text" readonly="readonly" name ="city">
       
             <p>State</p>  <input type="text" readonly="readonly" name ="state">
       
            <p>Region</p>  <input type="text" readonly="readonly" name ="vregion">
       
            <p>Country</p>  <input type="text" readonly="readonly" name ="country">
       
            <p>Website</p>  <input type="text" readonly="readonly" name ="website">
       
            <p>Email Address</p>  <input type="text" readonly="readonly" name ="email">
       
             <p>Phone Number</p>  <input type="text" readonly="readonly" name ="phoned">
       
             <p>Contact Preference</p>  <input type="text" readonly="readonly" name ="contactpreference">
       
            <button type="button" onclick="window.location.href = 'volProfileEdit.php'">Edit</button>

       
       
       
       
       
       
       

        <?php include '_footer.php'; ?>

        <!-- This is the footer -->
        <?php include '_footer.php';

