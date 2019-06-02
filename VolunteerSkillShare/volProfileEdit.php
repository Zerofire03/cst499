<?php
    include '_header.php';
    include 'storedProcedureCalls.php';

    //Obtain volunteer data
    $authUser = getAuthUserByUserName($_SESSION['username']);

    // test values
    if (isset($_POST['update']))
    {
        // adjust the email address for lower case for matching
        $_POST['email'] = strtolower($_POST['email']);
        
        try
        {
            // base user info
            UpdateAuthUser($authUser[UserID], NULL, NULL, NULL, $_POST['fname'], $_POST['lname'], NULL, NULL, NULL, NULL);

            // update the session variables
            $_SESSION['fname'] = $_POST['fname'];
            $_SESSION['lname'] = $_POST['lname'];

            // test test
            //echo('phone number = ' . $_POST['phone']);

            // profile info
            UpdateVolProfile($authUser['VolunteerID'], trim($_POST['city']), trim($_POST['state']), 
                            trim($_POST['region']), trim($_POST['country']), trim($_POST['postalcode']), 
                            trim($_POST['url']), trim($_POST['email']), trim($_POST['phone']), 
                            trim($_POST['contactPref']));

            // bio info
            UpdateVolBio($authUser[VolunteerID], trim($_POST['description']), trim($_POST['workHistory']), trim($_POST['interests']));

            if(isset($_POST['skill_list']))
            {
                $array = $_POST['skill_list'];
    
                foreach($_POST['skill_list'] as $skillID)
                {
                    $experienceLevel = "experience" . $skillID;
                    $isCurrent = "current" . $skillID;
                    InsertVolSkill($authUser['VolunteerID'], $skillID, $_POST[$experienceLevel], $_POST[$isCurrent]);
                }
            }

            echo("<br/><span class='success'><h4>Org inserted successfully</h4></span><br/>");
        }
        catch (Exception $e)
        {
            echo ('Caught exception: ' . $e->getMessage() . '<br/><br/>');
        }
    }

    //Obtain volunteer data
    $authUser = getAuthUserByUserName($_SESSION['username']);
    $volProfile = GetVolProfileByVolunteerID($authUser[VolunteerID]);
    $volBio = GetVolBioByVolunteerID($authUser[VolunteerID]);
    $volSkills = GetVolSkillsByVolunteerID($authUser[VolunteerID]);
   
?>
<form id="volProfileEdit" method="post" action="">
    <div class="fixedheader" title="Contact Information">Contact Info</div>
    <div class="fixedpanel">
        <table class="resultsTbl">
            <tr>
                <th class="resultsThRight"><label for="fname">First Name:</label></th>
                <td class="resultsTdLeft">
                    <input type="text" name="fname" id="fname" size="50" maxlength="100"
                        value="<?php echo($authUser['FirstName']); ?>" title="First Name" required />
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="fname">Last Name</label></th>
                <td class="resultsTdLeft">
                    <input type="text" name="lname" id="lname" size="50" maxlength="100"
                        value="<?php echo($authUser['LastName']); ?>" title="Last Name" required />
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="email">Email Address</label></th>
                <td class="resultsTdLeft">
                    <input type="email" name="email" id="email" size="50" maxlength="200"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        title="please enter valid email [test@test.com]"
                        value="<?php  echo($volProfile['EmailAddress']); ?>" required />
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="phone">Phone Number</label></th>
                <td class="resultsTdLeft">
                    <input type="tel" name="phone" id="phone" size="20" maxlength="20" 
                        value="<?php echo($volProfile['PhoneNumber']); ?>" 
                        pattern="\d{3}[\-]\d{3}[\-]\d{4}"
                        title="###-###-####"/>
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="contactPref">Contact Preference</label></th>
                <td class="resultsTdLeft">
                    <input type="radio" name="contactPref" value="E" <?php echo ($volProfile['ContactPref']=="E") ? ' checked' : '' ;?> /> Email 
                    <input type="radio" name="contactPref" value="P" <?php echo ($volProfile['ContactPref']=="P") ? " checked" : '' ;?> /> Phone
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="url">URL</label></th>
                <td class="resultsTdLeft">
                    <input type="url" name="url" id="url" size="50" maxlength="200"
                        value="<?php echo($volProfile['Url']); ?>" title="Personal URL" />
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="city">City</label></th>
                <td class="resultsTdLeft">
                    <input type="text" name="city" id="city" size="50" maxlength="100"
                        value="<?php echo($volProfile['City']); ?>" title="City" />
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="region">Region / Neighborhood</label></th>
                <td class="resultsTdLeft">
                    <input type="text" name="region" id="region" size="50" maxlength="100"
                        value="<?php echo($volProfile['Region']); ?>" title="Region or Neighborhood" />
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="state">State</label></th>
                <td class="resultsTdLeft">
                    <input type="text" name="state" id="state" size="50" maxlength="100"
                        value="<?php echo($volProfile['State']); ?>" title="State"/>
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="country">Country</label></th>
                <td class="resultsTdLeft">
                    <input type="text" name="country" id="country" size="50" maxlength="100"
                        value="<?php echo($volProfile['Country']); ?>" title="Country"/>
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="postalcode">Postal Code</label></th>
                <td class="resultsTdLeft">
                    <input type="text" name="postalcode" id="postalcode" size="20" maxlength="20"
                        value="<?php echo($volProfile['PostalCode']); ?>" title="Postal Code"/>
                </td>
            </tr>
        </table>
    </div>
    <br/>
    
    <div class="fixedheader" title="Work History Information">Work History Info</div>
    <div class="fixedpanel">
        <table class="resultsTbl">
            <tr>
                <th class="resultsThRight"><label for="description">Description</label></th>
                <td class="resultsTdLeft">
                    <textarea form="volProfileEdit" name="description" id="description" rows="13" cols="80" required><?php echo $volBio['Description']; ?></textarea>
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="description">Work History</label></th>
                <td class="resultsTdLeft">
                    <textarea form="volProfileEdit" name="workHistory" id="workHistory" rows="13" cols="80"><?php echo $volBio['WorkHistory']; ?></textarea>
                </td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="interests">Interests</label></th>
                <td class="resultsTdLeft">
                    <textarea form="volProfileEdit" name="interests" id="interests" rows="13" cols="80"><?php echo $volBio['Interests']; ?></textarea>
                </td>
            </tr>
        </table>
    </div>
    <br/>
    
    <div class="fixedheader" title="Current skills data">Skills List - Current</div>
    <div class="fixedpanel">
        <table class="resultsTbl">
        <tr>
            <th class="resultsThCenter">Skill Name</th>
            <th class="resultsThCenter">Experience Level</th>
            <th class="resultsThCenter">Current</th>
        </tr>
        <?php
            foreach($volSkills as $skill)
            {
                echo "<tr>
                    <td class='resultsTdLeft'>" . $skill['SkillName'] . "</td>
                    <td class='resultsTdCenter'>" . $skill['ExperienceLevel'] . "</td>
                    <td class='resultsTdCenter'>";
    
                if($skill[IsCurrent] == 1)
                {
                      echo "Yes";
                }
                else
                {
                      echo "No";
                }
                echo "</td>";
                echo "</tr>";
            }
        ?>
        </table>
    </div>
    <br/>
    
    <div class="fixedheader">Add Skills</div>
    <div class="fixedpanel">
        <table class="resultsTbl">
            <tr>
                <th class="resultsThCenter">Add Skill</th>
                <th class="resultsThCenter">Skill Name</th>
                <th class="resultsThCenter">Experience Level</th>
                <th class="resultsThCenter">Current</th>
            </tr>
        <?php
            echo "";
            $count = 1;
            $skills = getSkills();
            $skillNames = array_column($volSkills, 'SkillName');
            
            foreach($skills as $skill)
            {
                if(!(array_search($skill['Name'], $skillNames)))
                {
                    echo '<tr>
                        <td class="resultsTdCenter"><input type="checkbox" name="skill_list[]" value="' . $skill['SkillID'] . '"</td>
                        <td class="resultsTdLeft">' . $skill['Name'] . '</td>
                        <td class="resultsTdCenter">
                            <select name="experience' . $skill['SkillID'] . '">
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
                        <td class="resultsTdCenter">
                            <select name="current' . $skill['SkillID'] . '">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </td>';
                }
                $count++;
            }
        ?>
        </table>
    </div>
    <br/>
    <button class="btn btn-primary" type="submit" name="update" id="update" value="update" title="Update Profile">Update Profile</button>
</form>
<br>

<!-- This is the footer -->
<?php include '_footer.php';