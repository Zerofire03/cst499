<?php
include '_header.php';
include 'storedProcedureCalls.php';

    /*
    this page is used to create or edit org projects - if this is an edit, the
    orgprojectid will be passed in.  for all other cases the org should be pulled
    from the logged in user and this is a new project entry
    */
    
    $orgid = $_SESSION['orgid'];
    $orgprojectid = null;
    $orgproject = null;
    $orgprojectskills = null;

    // get the orgid - can be passed as param (get or post), pulled from session, or null (new enrollment)
    if (isset($_REQUEST['orgprojectid']))
    {
        $orgprojectid = $_REQUEST['orgprojectid'];
    }
    
    if (isset($_POST['submit']))
    {
        // save the org project record - check for update or insert
        if (isset($orgprojectid) && $orgprojectid > 0)
        {
            // this is an update
            try
            {
                $active = (strtolower($_POST['isactive']) == "on" ? 1 : 0);
                
                UpdateOrgProject($orgprojectid, $orgID, trim($_POST['name']),
                    $active, $_POST['priority'], trim($_POST['description']),
                    $_POST['startdate'], trim($_POST['timeline']), trim($_POST['city']),
                    trim($_POST['state']), trim($_POST['region']), trim($_POST['country']),
                    trim($_POST['postalcode']));

                // delete the current skills list
                deleteOrgProjectSkills($orgprojectid);

                // insert the newly selected skills                
                if(isset($_POST['skill_list']))
                {
                    $array = $_POST['skill_list'];
        
                    foreach($_POST['skill_list'] as $skillID)
                    {
                        $description = "description" . $skillID;
                        $isrequired = "required" . $skillID;
                        InsertOrgProjectSkill($orgprojectid, $skillID, $_POST[$description], $_POST[$isrequired]);
                    }
                }
                
                echo("<br/><span class='success'><h4>Project updated successfully</h4></span><br/>");
            }
            catch (Exception $e)
            {
                echo ('Caught exception: ' . $e->getMessage() . '<br/><br/>');
            }
        }
        else
        {
            try
            {
                /*
                // test test test 
                echo ('' . $orgID, trim($_POST['name']),
                    $_POST['isactive'], $_POST['priority'], trim($_POST['description']),
                    $_POST['startdate'], trim($_POST['timeline']), trim($_POST['city']),
                    trim($_POST['state']), trim($_POST['region']), trim($_POST['country']),
                    trim($_POST['postalcode']));
                    */
                
                //echo('active = ' . $_POST['isactive']);
                
                $active = (strtolower($_POST['isactive']) == "on" ? 1 : 0);
                
                // this is an insert
                $orgprojectid = InsertOrgProject($orgid, trim($_POST['name']),
                        $active, $_POST['priority'], trim($_POST['description']),
                        $_POST['startdate'], trim($_POST['timeline']), trim($_POST['city']),
                        trim($_POST['state']), trim($_POST['region']), trim($_POST['country']),
                        trim($_POST['postalcode']));
                
                // test test
                //echo("<br/>org project id = " . $orgprojectid . "<br/>");
                
                // insert the newly selected skills                
                if(isset($_POST['skill_list']))
                {
                    $array = $_POST['skill_list'];
        
                    foreach($_POST['skill_list'] as $skillID)
                    {
                        $description = "description" . $skillID;
                        $isrequired = "required" . $skillID;
                        InsertOrgProjectSkill($orgprojectid, $skillID, $_POST[$description], $_POST[$isrequired]);
                    }
                }
                
                echo("<br/><span class='success'><h4>Project created successfully</h4></span><br/>");
            }
            catch (Exception $e)
            {
                echo ('Caught exception: ' . $e->getMessage() . '<br/><br/>');
            }

        }
    }
    
    // get the orgid - can be passed as param (get or post), pulled from session, or null (new enrollment)
    if (isset($orgprojectid))
    {
        // retrieve the project and skills
        $orgproject = GetOrgProjectByOrgProjectID($orgprojectid);
        $orgprojectskills = GetOrgProjectSkillsByOrgProjectID($orgprojectid);
        
        if (!isset($orgproject))
        {
            echo("<br/><span class='error'><h4>Org Project not found<br/>
                Go back to <a href='orgProfile.php'>Org Profile</a> for other projects.</h4></span><br/>");
        }
    }
?>

<!-- code -->
<br/>
<form id="projectedit" name="projectedit" method="post">
<div class="fixedheader">Project Details</div>
<div class="fixedpanel">
    <br/>
    <table class="resultsTbl">
        <tr>
            <th class="resultsThRight"><label for="name">Project Name: </label></th>
            <td class="resultsTdLeft">
                <input type="text" name="name" id="name" size="50" maxlength="100" value="<?php echo($orgproject['Name']); ?>" required/>
            </td>
        </tr>
        <tr>
            <th class="resultsThRight"><label for="isactive">Is Active: </label></th>
            <td class="resultsTdLeft">
                <input type="checkbox" name="isactive" id="isactive" <?php if($orgproject['IsActive']) { echo('checked'); } ?> />
            </td>
        </tr>
        <tr>
            <th class="resultsThRight"><label for="priority">Priority: </label></th>
            <td class="resultsTdLeft">
                <select name="priority" id="priority" required title="Project Priority" required>
                    <option value="H" <?php if(strtolower($orgproject['Priority']) == "h") { echo('selected'); } ?>>High</option>
                    <option value="M" <?php if(strtolower($orgproject['Priority']) == "m") { echo('selected'); } ?>>Medium</option>
                    <option value="L" <?php if(strtolower($orgproject['Priority']) == "l") { echo('selected'); } ?>>Low</option>
                </select>
            </td>
        </tr>
        <tr>
            <th class="resultsThRight"><label for="description">Description:</label></th>
            <td class="resultsTdLeft"><textarea rows="5" cols="50" name="description" id="description" title="Project Description" required><?php echo($orgproject['Description']); ?></textarea></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label for="startdate">Start Date:</label></th>
            <td class="resultsTdLeft">
                <input type="date" name="startdate" id="startdate" 
                    value="<?php echo($orgproject['StartDate']); ?>" title="Expected Project Start Date (optional)" />
            </td>
        </tr>
        <tr>
            <th class="resultsThRight"><label for="timeline">Timeline:</label></th>
            <td class="resultsTdLeft"><textarea rows="5" cols="50" name="timeline" id="timeline" title="Project Timeline Description"><?php echo($orgproject['TimelineDescription']); ?></textarea></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label for="city">City:</label></th>
            <td class="resultsTdLeft">
                <input type="text" name="city" id="city" size="50" maxlength="100"
                    value="<?php echo($orgproject['City']); ?>" title="City" />
            </td>
        </tr>
        <tr>
            <th class="resultsThRight"><label for="region">Region / Neighborhood: </label></th>
            <td class="resultsTdLeft">
                <input type="text" name="region" id="region" size="50" maxlength="100"
                    value="<?php echo($orgproject['Region']); ?>" title="Region or Neighborhood" />
            </td>
        </tr>
        <tr>
            <th class="resultsThRight"><label for="state">State: </label></th>
            <td class="resultsTdLeft">
                <input type="text" name="state" id="state" size="50" maxlength="100"
                    value="<?php echo($orgproject['State']); ?>" title="State" />
            </td>
        </tr>
        <tr>
            <th class="resultsThRight"><label for="country">Country: </label></th>
            <td class="resultsTdLeft">
                <input type="text" name="country" id="country" size="50" maxlength="100"
                    value="<?php echo($orgproject['Country']); ?>" title="Country" />
            </td>
        </tr>
        <tr>
            <th class="resultsThRight"><label for="postalcode">Postal Code: </label></th>
            <td class="resultsTdLeft">
                <input type="text" name="postalcode" id="postalcode" size="20" maxlength="20"
                    value="<?php echo($orgproject['PostalCode']); ?>" title="Postal Code" />
            </td>
        </tr>
    </table>
    <input type="hidden" name="orgprojectid" id="orgprojectid" value="<?php echo($orgprojectid); ?>" />
</div>
<br/>
<div class="fixedheader">Add Skills</div>
<div class="fixedpanel">
    <br/>
    <table class="resultsTbl">
        <tr>
            <th class="resultsThCenter">Add Skill</th>
            <th class="resultsThCenter">Skill Name</th>
            <th class="resultsThCenter">Description</th>
            <th class="resultsThCenter">Required</th>
        </tr>
    <?php
        $skills = getSkills();
        $skillNames = null;
        
        //echo($skills[0]['Name']);
        
        if (isset($orgprojectskills) && count($orgprojectskills) > 0)
        {
            $skillNames = array_column($orgprojectskills, 'SkillName');
            
            foreach($orgprojectskills as $skill)
            {
                echo '<tr>
                <td class="resultsTdCenter"><input type="checkbox" name="skill_list[]" value="' . $skill['SkillID'] . '" checked></td>
                <td class="resultsTdLeft">' . $skill['SkillName'] . '</td>
                <td class="resultsTdCenter">
                    <textarea rows="3" cols="30" name="description' . $skill['SkillID'] . '" id="description' . $skill['SkillID'] . '">' . $skill['Description'] . '</textarea>
                </td>
                <td class="resultsTdCenter">
                    <select name="required' . $skill['SkillID'] . '">
                        <option value="1" ' . ($skill['IsRequired']==1 ? 'selected' : '') . '>Yes</option>
                        <option value="0" ' . ($skill['IsRequired']==0 ? 'selected' : '') . '>No</option>
                    </select>
                </td>';
            }
        }
        else
        {
            $skillNames = array("_+__+_");
            //echo ($skillNames);
        }
        
        foreach($skills as $skill)
        {
            // -- check the array
            if(array_search($skill['Name'], $skillNames) === false)
            {
                echo '<tr>
                    <td class="resultsTdCenter"><input type="checkbox" name="skill_list[]" value="' . $skill['SkillID'] . '"</td>
                    <td class="resultsTdLeft">' . $skill['Name'] . '</td>
                    <td class="resultsTdCenter">
                        <textarea rows="3" cols="30" name="description' . $skill['SkillID'] . '" id="description' . $skill['SkillID'] . '"></textarea>
                    </td>
                    <td class="resultsTdCenter">
                        <select name="required' . $skill['SkillID'] . '">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>';
            }
        }
    ?>
    </table>
</div>
<br/>
<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit Changes" title="Submit Org Project changes">
</form>
<br>

<!-- This is the footer -->
<?php include '_footer.php';