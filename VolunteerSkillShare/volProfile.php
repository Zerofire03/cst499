<?php 
    include '_header.php';
    //include '_enforceLogin.php';
    session_start();
?>
        
       <!-- code -->
    
    <?php
        include 'storedProcedureCalls.php';   
       
       
    ?>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <form>
                    First Name <br>
                    <?php echo '<input type="text" name="fname" value= ' . getAuthUserByUserName($_SESSION['username'])[FirstName] . ' readonly>'; ?>
                    <br>
                    
                    URL <br>
                    <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Url] . ' readonly>'; ?>
                    <br>
                    
                    
                </form>
                
            </div>
            <div class="col-sm-6">
                <form>
                    Last Name <br>
                    <?php echo '<input type="text" name="fname" value= ' . getAuthUserByUserName($_SESSION['username'])[LastName] . ' readonly>'; ?>
                    <br>
                    
                    Email <br>
                    <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[EmailAddress] . ' readonly>'; ?>
                    <br>
                    
                    
                </form>
            </div>
            <div class="col-sm-2">
                <form>
                    Coutry of Residence <br>
                    <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Country] . ' readonly>'; ?>
                    <br>
                </form>
            </div>
            <div class="col-sm-2">
                <form>
                    State <br>
                    <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[State] . ' readonly>'; ?>
                    <br>
                </form>
            </div>
            <div class="col-sm-2">
                <form>
                    Region <br>
                    <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Region] . ' readonly>'; ?>
                    <br>
                </form>
            </div>
            <div class="col-sm-2">
                <form>
                    City <br>
                    <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[City] . ' readonly>'; ?>
                    <br>
                </form>
            </div>
            <div class="col-sm-2">
                <form>
                    Postal Code <br>
                    <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[PostalCode] . ' readonly>'; ?>
                    <br>
                </form>
            </div>
            <div class="col-sm-4">
                <form>
                    Bio <br>
                    <?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Description]; ?>
                    <br>
                </form>
            </div>
            <div class="col-sm-4">
                <form>
                    Work History <br>
                    <?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[WorkHistory]; ?>
                    <br>
                </form>
            </div>
            <div class="col-sm-4">
                <form>
                    Interests <br>
                    <?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Interests]; ?>
                    <br>
                </form>
            </div>
            <div class="col-sm-12">
                Skills <br>
                <?php
                    echo "<table>
                            <tr>
                                <th>Skill Name</th>
                                <th>Experience Level</th>
                                <th>Current</th>
                            </tr>";
                    foreach(GetVolSkillsByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID]) as $skills)
                    {
                        echo "<tr>
                                <td>" . $skills[SkillID] . "</td>
                                <td>" . $skills[ExperienceLevel] . "</td>
                                <td>";
                                if($skills[IsCurrent] == 1)
                                {
                                    echo "Yes</td>";
                                }
                                else
                                {
                                     echo "No</td>";
                                }
                    }
                    echo "</table>";
                ?>
            </div>
        </div>
    </div>
    
    
    
    <?php
       
       
       
    /*   
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
       
       */
       ?>

       
        

        <?php include '_footer.php'; ?>

        <!-- This is the footer -->
</body>
