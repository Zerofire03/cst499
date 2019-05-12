<?php 
    include '_header.php';
    include '_enforceLogin.php';
?>


    
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