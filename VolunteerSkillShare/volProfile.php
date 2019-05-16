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