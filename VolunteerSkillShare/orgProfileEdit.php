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
        <h1>VOLUNTEER SKILL SHARE</h1><br/>
        <h2>Welcome <?=$_SESSION['userName']?>!</h2><br/>
        </div>
        
        <!-- Navigation Bar-->
        <ul class="nav nav-pills">
          <li role="presentation"><a href="index.php">Home</a></li>
          <li role="presentation"><a href="orgProfile.php">Organization Profile</a></li>
          <li role="presentation" class="active"><a href="orgProfileEdit.php">Profile Editor</a></li>
          <li role="presentation"><a href="orgProject.php">Active Project</a></li>
          <li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>
        </ul>
        
       <!-- code -->
        
        
        
             <form>
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
       
       <input type="submit" value="Submit">
       </form>
       
    <?php
    include "dbConnection.php";
	if(isset($_POST['Submit'])){//if the submit button is clicked
	
	    $sql = "CALL sp_UpdateOrgProfile(orgid, name,description, mission, taxid, contactname, contactphone, address1, address2, city, state, region, country, postal, email, phone, twitter, linkedin)";
	    $dbconn->query($sql) or die("Cannot update");//update or error
	    echo "Update Successful!";
	}
?>
       
       
       
       
       
       
       
       
       
        
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