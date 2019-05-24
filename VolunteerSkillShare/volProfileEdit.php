<?php
       include '_header.php';
       include '_enforceLogin.php';
       session_start();
       include 'storedProcedureCalls.php'; 
?>
        
<div class="container">
       <div class="row">
              <form id="volProfileEdit" method="post" action="updateProfileProcess.php">
                     <div class="col-sm-6">
                            First Name <br>
                            <?php echo '<input type="text" name="fname" value= ' . getAuthUserByUserName($_SESSION['username'])[FirstName] . ' >'; ?>
                            <br>
                
                            URL <br>
                            <?php echo '<input type="text" name="url" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Url] . ' >'; ?>
                            <br>
                            
                            Phone Number <br>
                            <?php echo '<input type="text" name="phone" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[PhoneNumber] . ' >'; ?>
                            <br>
                     </div>
                     <div class="col-sm-6">
                            Last Name <br>
                            <?php echo '<input type="text" name="lname" value= ' . getAuthUserByUserName($_SESSION['username'])[LastName] . ' >'; ?>
                            <br>
                       
                            Email <br>
                            <?php echo '<input type="text" name="email" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[EmailAddress] . ' >'; ?>
                            <br>
                            
                            Contact Preference <br>
                            <input type="radio" name="contactPref" value="E" <?php echo (GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[ContactPref]=="E") ? ' checked' : '' ;?> > Email 
                            <input type="radio" name="contactPref" value="P" <?php echo (GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[ContactPref]=="P") ? " checked" : '' ;?> > Phone
                            <br>
                     </div>
                     <div class="col-sm-2">
                            Coutry of Residence <br>
                            <?php echo '<input type="text" name="country" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Country] . ' >'; ?>
                            <br>
                     </div>
                     <div class="col-sm-2">
                            State <br>
                            <?php echo '<input type="text" name="state" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[State] . ' >'; ?>
                            <br>
                     </div>
                     <div class="col-sm-2">
                            Region <br>
                            <?php echo '<input type="text" name="region" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Region] . ' >'; ?>
                            <br>
                     </div>
                     <div class="col-sm-2">
                            City <br>
                            <?php echo '<input type="text" name="city" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[City] . ' >'; ?>
                            <br>
                     </div>
                     <div class="col-sm-2">
                            Postal Code <br>
                            <?php echo '<input type="text" name="postalcode" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[PostalCode] . ' >'; ?>
                            <br>
                     </div>
                     <div class="col-sm-4">
                            Bio <br>
                            <?php echo '<textarea form="volProfileEdit" name="description" rows="10">' . GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Description] . '</textarea>'; ?>
                            <br>
                     </div>
                     <div class="col-sm-4">
                            Work History <br>
                            <?php echo '<textarea form="volProfileEdit" name="workHistory" rows="10">' . GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[WorkHistory] . '</textarea>'; ?>
                            <br>
                     </div>
                     <div class="col-sm-4">
                            Interests <br>
                            <?php echo '<textarea form="volProfileEdit" name="interests" rows="10">' . GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Interests] . '</textarea>'; ?>
                            <br>
                     </div>
                     <div class="col-sm-12">
                            <button class="btn btn-primary" type="submit" value="update">Update Profile</button>
                     </div>
              </form>
              <div class="col-sm-12">
                     Skills <br>
                     <?php
                            echo "<table>
                                   <tr>
                                          <th>Skill Name</th>
                                          <th>Experience Level</th>
                                          <th>Current</th>
                                   </tr>";
                            $skills = GetVolSkillsByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID]);
                            foreach($skills as $skill)
                            {
                                   echo "<tr>
                                          <td>" . $skill[SkillName] . "</td>
                                          <td>" . $skill[ExperienceLevel] . "</td>
                                          <td>";
                                   if($skill[IsCurrent] == 1)
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
        
<!-- This is the footer -->
<?php include '_footer.php';