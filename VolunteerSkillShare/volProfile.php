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
    
    <?php
        include 'storedProcedureCalls.php';   
       
    $Username = $_SESSION['username'];
    echo $Username;
    echo '<br><br>';
    $VolunteerID = getVolunteerID($Username);
    echo $VolunteerID;
    echo '<br><br>';
    $VolunteerBio = array(getVolBiobyVolunteerID($VolunteerID));
    print_r($VolunteerBio);
    echo '<br><br>';
    echo $VolunteerBio[2];
   
    
       echo '<table>';
           echo '<tr>';
           echo '<th>User Name</th>';
           echo '<th>'.$Username.'</th>';
           echo '</tr>';
           
           echo '<tr>';
               echo '<th>Volunteer ID</th>';
               echo '<th>'.$VolunteerBio["VolunteerID"].'</th>';
           echo '</tr>';
          
           echo '<tr>';
               echo '<th>First Name</th>';
               echo '<th>   </th>';
           echo '</tr>';
           
           echo '<tr>';
               echo '<th>Last Name</th>';
               echo '<th>   </th>';
           echo '</tr>';
          
           echo '<tr>';
               echo '<th>City</th>';
               echo '<th>   </th>';
           echo '</tr>';
          
           echo '<tr>';
               echo '<th>State</th>';
               echo '<th>   </th>';
           echo '</tr>';
          
           echo '<tr>';
               echo '<th>Region</th>';
               echo '<th>   </th>';
           echo '</tr>';
          
           echo '<tr>';
               echo '<th>Country</th>';
               echo '<th>   </th>';
           echo '</tr>';
         
           echo '<tr>';
               echo '<th>Website</th>';
               echo '<th>   </th>';
           echo '</tr>';
          
           echo '<tr>';
               echo '<th>Email Address</th>';
               echo '<th>   </th>';
           echo '</tr>';
          
           echo '<tr>';
               echo '<th>Phone Number</th>';
               echo '<th>   </th>';
           echo '</tr>';
          
           echo '<tr>';
               echo '<th>Contact Preference</th>';
               echo '<th>   </th>';
           echo '</tr>';
           
                      echo '<tr>';
               echo '<th>Description</th>';
               echo '<th>   </th>';
           echo '</tr>';
          
           echo '<tr>';
               echo '<th>Work History</th>';
               echo '<th>   </th>';
           echo '</tr>';
          
           echo '<tr>';
               echo '<th>Interests</th>';
               echo '<th>   </th>';
           echo '</tr>';
       
       echo '</table>';
       ?>
            <button type="button" onclick="window.location.href = 'volProfileEdit.php'">Edit</button>

       
        

        <?php include '_footer.php'; ?>

        <!-- This is the footer -->
</body>
