<?php 
    include '_header.php';
    // include '_enforceLogin.php';
?>
    
    <body id="activePage">
        
        <div class="jumbotron text-center">
        <h1>VOLUNTEER SKILL SHARE</h1><br/>
        <h2>Welcome <?=$_SESSION['userName']?>!</h2><br/>
        </div>
        
        <!-- Navigation Bar-->
        <ul class="nav nav-pills">
          <li role="presentation"><a href="index.php">Home</a></li>
          <li role="presentation" class="active"><a href="orgProfile.php">Organization Profile</a></li>
          <li role="presentation"><a href="orgProfileEdit.php">Profile Editor</a></li>
          <li role="presentation"><a href="orgProject.php">Active Project</a></li>
          <li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>
        </ul>
        
       <!-- code -->
              <p>Organization ID</p>  <input type="text" readonly="readonly" name ="orgid" value="<?=orgid?>">

       <p>Name</p>  <input type="text" readonly="readonly" name ="name" value="<?=name?>">       
       
       <p>Description</p>  <input type="text" readonly="readonly" name ="description" value="<?=description?>">
       
       <p>Mission</p>  <input type="text" name ="mission" value="<?=mission?>">
       
       <p>Tax Identifier</p>  <input type="text" name ="taxid" value="<?=taxid?>">
       
       <p>Contact Name</p>  <input type="text" name ="contactname" value="<?=contactname?>">
       
       <p>Contact Phone Number</p>  <input type="text" name ="contactphone" value="<?=contactphone?>">
       
       <p>Address1</p>  <input type="text" name ="address1" value="<?=address1?>">
       
       <p>Address2</p>  <input type="text" name ="address2" value="<?=address2?>">
       
       <p>City</p>  <input type="text" name ="city" value="<?=city?>">
       
       <p>State</p>  <input type="text" name ="state" value="<?=state?>">
       
       <p>Region</p>  <input type="text" name ="region" value="<?=region?>">
       
       <p>Country</p>  <input type="text" name ="country" value="<?=country?>">
       
       <p>Postal Code</p>  <input type="text" name ="postal" value="<?=postal?>">
       
       <p>Email Address</p>  <input type="text" name ="email" value="<?=email?>">
       
       <p>Phone Number</p>  <input type="text" name ="phone" value="<?=phone?>">
       
       <p>Twitter</p>  <input type="text" name ="twitter" value="<?=twitter?>">
       
       <p>LinkedIn</p>  <input type="text" name ="linkedin" value="<?=linkedin?>">
       <button type="button" onclick="window.location.href = 'orgProfileEdit.php'">Edit</button>
       
       
       
       
       
       
       
       
       
       
        
        <!-- This is the footer -->
        <?php include '_footer.php';