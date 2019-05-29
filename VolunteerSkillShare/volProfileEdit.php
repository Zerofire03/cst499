<?php
       include '_header.php';
       include '_enforceLogin.php';
       session_start();
       include 'storedProcedureCalls.php';
       
       //Obtain volunteer data
       $authUser = getAuthUserByUserName($_SESSION['username']);
       $volProfile = GetVolProfileByVolunteerID($authUser[VolunteerID]);
       $volBio = GetVolBioByVolunteerID($authUser[VolunteerID]);
       $volSkills = GetVolSkillsByVolunteerID($authUser[VolunteerID]);
?>

    <table class= "biotable">
        <tr>
        <td> First Name</th>
        <td><?php  echo '<input type="text" value= ' . $authUser[FirstName] . ' >'; ?> </th>
        </tr>
        <tr>
        <td> Last Name</th>
        <td><?php  echo '<input type="text" value= ' . $authUser[LastName] . ' >'; ?> </th>
        </tr>
        <tr>
        <td> Email Address</th>
        <td><?php  echo '<input type="text" value= ' . $volProfile[EmailAddress] . ' >'; ?></th>
        </tr>
        <tr>
            <td>Phone Number</th>
            <td><?php  echo '<input type="text" value= ' . $volProfile[PhoneNumber] . ' >'; ?></th>
        </tr>
        <tr>
            <td>Contact Preference</th>
            <input type="radio" name="contactPref" value="E" <?php echo ($volProfile[ContactPref]=="E") ? ' checked' : '' ;?> > Email 
            <input type="radio" name="contactPref" value="P" <?php echo ($volProfile[ContactPref]=="P") ? " checked" : '' ;?> > Phone
        </tr>
        <tr>
        <td> URL</th>
        <td><?php  echo '<input type="text" value= ' . $volProfile[Url] . ' >'; ?></th>
        </tr>
        <tr>
        <td> City </th>
        <td><?php  echo '<input type="text" value= ' . $volProfile[City] . ' >'; ?></th>
        </tr>
        <tr>
        <td> Region</th>
        <td><?php  echo '<input type="text" value= ' . $volProfile[Region] . ' >'; ?></th>
        </tr>
        <tr>
        <td> State</th>
        <td><?php  echo '<input type="text" value= ' . $volProfile[State] . ' >'; ?></th>
        </tr>
        <tr>
        <td> Country</th>
        <td><?php  echo '<input type="text" value= ' . $volProfile[Country] . ' >'; ?></th>
        </tr>
        <tr>
        <td> Postal Code</th>
        <td><?php  echo '<input type="text" value= ' . $volProfile[PostalCode] . ' >'; ?></th>
        </tr>
        </table>
        
        <p class="description">Description</p>
        <br>
        <textarea rows = "25" cols="100"><?php echo $volBio[Description]; ?>  </textarea> </th>
        
        <br>
        
        <p class="description"> Work History</p>
        <br>
        <td><textarea rows = "25" cols="100"><?php echo $volBio[WorkHistory]; ?></textarea> </th>

        <br>

        <p class="description"> Interests </p>
        <br>
        <td><textarea rows = "25" cols="100"><?php echo $volBio[Interests]; ?></textarea> </th>
        
        <br>
        </table>
        <br>
        <button class="btn btn-primary" type="submit" value="update">Update Profile</button>

                     Skills <br>
                     <?php
                            echo "<table>
                                   <tr>
                                          <td>Skill Name</th>
                                          <td>Experience Level</th>
                                          <td>Current</th>
                                   </tr>";
                            foreach($volSkills as $skill)
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