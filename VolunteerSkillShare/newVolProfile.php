<?php
       include '_header.php';
       include '_enforceLogin.php';
       session_start();
       include 'storedProcedureCalls.php';
       
       //Obtain volunteer data
       $authUser = getAuthUserByUserName($_SESSION['username']);
?>
<form id="newVolProfile" method="post" action="newVolProfileProcess.php">
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
                     <td><?php  echo '<input type="text" name="email" value= ' . $authUser[UserName] . '>'; ?></td>
              </tr>
              <tr>
                     <td>Phone Number</th>
                     <td><?php  echo '<input type="text" name="phone" >'; ?></td>
              </tr>
              <tr>
                     <td>Contact Preference</th>
                     <input type="radio" name="contactPref" value="E"> Email 
                     <input type="radio" name="contactPref" value="P"> Phone
              </tr>
              <tr>
                     <td> URL</td>
                     <td><?php  echo '<input type="text" name="url">'; ?></td>
              </tr>
              <tr>
                     <td> City </td>
                     <td><?php  echo '<input type="text" name="city"'; ?></td>
              </tr>
              <tr>
                     <td> Region</th>
                     <td><?php  echo '<input type="text" name="region">'; ?></td>
              </tr>
              <tr>
                     <td> State</th>
                     <td><?php  echo '<input type="text" name="state">'; ?></td>
              </tr>
              <tr>
                     <td> Country</th>
                     <td><?php  echo '<input type="text" name="country">'; ?></td>
              </tr>
              <tr>
                     <td> Postal Code</td>
                     <td><?php  echo '<input type="text" name="postalcode">'; ?></td>
              </tr>
       </table>
        
       <p class="description">Description</p>
       <br>
       <textarea form="newVolProfile" name="description" rows = "25" cols="100" placeholder="Describe yourself here..."></textarea>
        
       <br>
        
       <p class="description"> Work History</p>
       <br>
       <textarea form="newVolProfile" name="workHistory" rows = "25" cols="100" placeholder="Describe your volunteer and work history here..."></textarea>

       <br>

       <p class="description"> Interests </p>
       <br>
       <textarea form="newVolProfile" name="interests" rows = "25" cols="100" placeholder="List your interests here..."></textarea>
        
       <br>
                     
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
                            
                            
              foreach($skills as $skill)
              {
                     echo '<tr>
                                   <td><input type="checkbox" name="skill_list[]" value="' . $skill[SkillID] . '"</td>
                                   <td>' . $skill[Name] . '</td>
                                   <td>
                                          <select name="experience' . $skill[SkillID] . '">
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
                                          <select name="current' . $skill[SkillID] . '">
                                                 <option value="1">Yes</option>
                                                 <option value="0">No</option>
                                          </select>
                                   </td>';
              }
              echo "</table>";
       ?>
       <button class="btn btn-primary" type="submit" value="update">Update Profile</button>
</form>
<br>

<!-- This is the footer -->
<?php include '_footer.php';