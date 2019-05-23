<?php include '_header.php';?>

       <!-- code -->
        
        
        
             <form>
       <p>Organization ID</p>  <input type="text" name ="orgid">

       <p>Name</p>  <input type="text" name ="name">       
       
       <p>Description</p>  <input type="text" name ="description">
       
       <p>Mission</p>  <input type="text" name ="mission">
       
       <p>Tax Identifier</p>  <input type="text" name ="taxid">
       
       <p>Contact Name</p>  <input type="text" name ="contactname">
       
       <p>Contact Phone Number</p>  <input type="text" name ="contactphone">
       
       <p>Address1</p>  <input type="text" name ="address1">
       
       <p>Address2</p>  <input type="text" name ="address2">
       
       <p>City</p>  <input type="text" name ="city">
       
       <p>State</p>  <input type="text" name ="state">
       
       <p>Region</p>  <input type="text" name ="region">
       
       <p>Country</p>  <input type="text" name ="country">
       
       <p>Postal Code</p>  <input type="text" name ="postal">
       
       <p>Email Address</p>  <input type="text" name ="email">
       
       <p>Phone Number</p>  <input type="text" name ="phone">
       
       <p>Twitter</p>  <input type="text" name ="twitter">
       
       <p>LinkedIn</p>  <input type="text" name ="linkedin">
       
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
<?php include '_footer.php';