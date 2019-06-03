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
                     <td><input type="text" name="firstname" id="firstname" size="50"
                value="<?php echo $authUser['FirstName']; ?>" maxlength="100" required> </td>
              </tr>
              <tr>
                     <td> Last Name</td>
                     <td><input type="text" name="lastname" id="lastname" size="50"
                value="<?php echo $authUser['LastName']; ?>" maxlength="100" required> </td>
              </tr>
              <tr>
                     <td> Email Address</td>
                     <td><input type="email" name="email" id="email" size="50" value="<?php echo $authUser[UserName]; ?>"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                title="please enter valid email [test@test.com]"
                maxlength="200"/></td>
                     
              </tr>
              <tr>
                     <td>Phone Number</td>
                     <td><input type="tel" name="phone" id="phone" size="20"
                pattern="\d{3}[\-]\d{3}[\-]\d{4}"
                maxlength="20" 
                title="###-###-####"/></td>
              </tr>
              <tr>
                     <td>Contact Preference</td>
                     <td>
                     <input type="radio" name="contactPref" value="E" required> Email 
                     <input type="radio" name="contactPref" value="P"> Phone
                     </td>
              </tr>
              <tr>
                     <td> URL</td>
                     <td><input type="text" name="url" id="url" size="50" maxlength="100"> </td>
              </tr>
              <tr>
                     <td> City </td>
                     <td><input type="text" name="city" id="city" size="50" maxlength="100"> </td>
              </tr>
              <tr>
                     <td> Region</th>
                     <td><input type="text" name="url" id="city" size="50" maxlength="100"> </td>
              </tr>
              <tr>
                     <td> State</th>
                     <td><input type="text" name="state" id="state" size="50" maxlength="100"> </td>
              </tr>
              <tr>
                     <td> Country</th>
                     <td><input type="text" name="country" id="country" size="50" maxlength="100"> </td>
              </tr>
              <tr>
                     <td> Postal Code</td>
                     <td><input type="text" name="url" id="url" size="50" maxlength="100"> </td>
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
