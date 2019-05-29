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
<form id="volProfileEdit" method="post" action="updateProfileProcess.php">
       <table class= "biotable">
              <tr>
                     <td> First Name</td>
                     <td><?php  echo '<input type="text" name="fname" value= ' . $authUser[FirstName] . ' >'; ?> </td>
              </tr>
              <tr>
                     <td> Last Name</td>
                     <td><?php  echo '<input type="text" name="lname" value= ' . $authUser[LastName] . ' >'; ?> </td>
              </tr>
              <tr>
                     <td> Email Address</th>
                     <td><?php  echo '<input type="text" name="email" value= ' . $volProfile[EmailAddress] . ' >'; ?></td>
              </tr>
              <tr>
                     <td>Phone Number</th>
                     <td><?php  echo '<input type="text" name="phone" value= ' . $volProfile[PhoneNumber] . ' >'; ?></td>
              </tr>
              <tr>
                     <td>Contact Preference</th>
                     <input type="radio" name="contactPref" value="E" <?php echo ($volProfile[ContactPref]=="E") ? ' checked' : '' ;?> > Email 
                     <input type="radio" name="contactPref" value="P" <?php echo ($volProfile[ContactPref]=="P") ? " checked" : '' ;?> > Phone
              </tr>
              <tr>
                     <td> URL</td>
                     <td><?php  echo '<input type="text" name="url" value= ' . $volProfile[Url] . ' >'; ?></td>
              </tr>
              <tr>
                     <td> City </td>
                     <td><?php  echo '<input type="text" name="city" value= ' . $volProfile[City] . ' >'; ?></td>
              </tr>
              <tr>
                     <td> Region</th>
                     <td><?php  echo '<input type="text" name="region" value= ' . $volProfile[Region] . ' >'; ?></td>
              </tr>
              <tr>
                     <td> State</th>
                     <td><?php  echo '<input type="text" name="state" value=' . $volProfile[State] . ' >'; ?></td>
              </tr>
              <tr>
                     <td> Country</th>
                     <td><?php  echo '<input type="text" name="country" value=' . $volProfile[Country] . ' >'; ?></td>
              </tr>
              <tr>
                     <td> Postal Code</td>
                     <td><?php  echo '<input type="text" name="postalcode" value=' . $volProfile[PostalCode] . ' >'; ?></td>
              </tr>
       </table>
        
       <p class="description">Description</p>
       <br>
       <textarea form="volProfileEdit" name="description" rows = "25" cols="100"><?php echo $volBio[Description]; ?>  </textarea>
        
       <br>
        
       <p class="description"> Work History</p>
       <br>
       <textarea form="volProfileEdit" name="workHistory" rows = "25" cols="100"><?php echo $volBio[WorkHistory]; ?></textarea>

       <br>

       <p class="description"> Interests </p>
       <br>
       <textarea form="volProfileEdit" name=interests" rows = "25" cols="100"><?php echo $volBio[Interests]; ?></textarea>
        
       <br>
        

       <br> Skills <br>
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
                     
       Add Skills<br>
       <?php
              echo "<table>
                            <tr>
                                   <th>Add Skill</th>
                                   <th>Skill Name</th>
                                   <th>Experience Level</th>
                                   <th>Current</th>
                            </tr>";
              $count = 1;
              $skills = getSkills();
              $skillNames = array_column($volSkills, 'SkillName');
                            
                            
              foreach($skills as $skill)
              {
                     if(!(array_search($skill[Name], $skillNames)))
                     {
                            echo '<tr>
                                          <td><input type="checkbox" name="skill_list[]" value="' . $skill[Name] . '"</td>
                                          <td>' . $skill[Name] . '</td>
                                          <td>
                                                 <select>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                 </select>
                                          </td>
                                          <td>
                                                 <select>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                 </select>
                                          </td>';
                     }
                     $count++;
              }
              echo "</table>";
       ?>
       <button class="btn btn-primary" type="submit" value="update">Update Profile</button>
</form>
<br>

<!-- This is the footer -->
<?php include '_footer.php';