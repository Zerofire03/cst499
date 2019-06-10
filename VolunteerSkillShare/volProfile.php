<?php 
    include '_header.php';
    include 'storedProcedureCalls.php';

    $authUser = null;
    
    //Obtain volunteer data
    if(isset($_GET["volid"]))
    {
        $authUser = getAuthUserByVolID($_GET["volid"]);
    }
    else
    {
        $authUser = getAuthUserByUserName($_SESSION['username']);
    }
    $volProfile = GetVolProfileByVolunteerID($authUser[VolunteerID]);
    $volBio = GetVolBioByVolunteerID($authUser[VolunteerID]);
    $volSkills = GetVolSkillsByVolunteerID($authUser[VolunteerID]);
    
?>
<br/>
<button class="accordion" id="contactPanel" title="Expand to display volunteer contact info">Volunteer Contact Info</button>
<div class="panel">
    <br/>
    <table class="resultsTbl">
        <tr>
            <th class="resultsThRight"><label>First Name:</label></th>
            <td class='resultsTdLeft'><?php echo $authUser[FirstName]; ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Last Name:</label></th>
            <td class='resultsTdLeft'><?php echo $authUser[LastName]; ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Email Address:</label></th>
            <td class='resultsTdLeft'><?php echo $volProfile[EmailAddress]; ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Phone Number:</label></th>
            <td class='resultsTdLeft'><?php echo $volProfile[PhoneNumber]; ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Contact Preference:</label></th>
            <td class='resultsTdLeft'><?php echo ($volProfile[ContactPref]=="E") ? 'Email' : 'Phone' ;?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>URL:</label></th>
            <td class='resultsTdLeft'><?php echo $volProfile[Url]; ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>City:</label></th>
            <td class='resultsTdLeft'><?php echo $volProfile[City]; ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Region:</label></th>
            <td class='resultsTdLeft'><?php echo $volProfile[Region]; ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>State:</label></th>
            <td class='resultsTdLeft'><?php echo $volProfile[State]; ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Country:</label></th>
            <td class='resultsTdLeft'><?php echo $volProfile[Country]; ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Postal Code:</label></th>
            <td class='resultsTdLeft'><?php echo $volProfile[PostalCode]; ?></td>
        </tr>
    </table>
</div>

<button class="accordion" id="workPanel" >Work History Info</button>
<div class="panel">
    <br/>
    <table class="resultsTbl">
        <tr>
            <th class="resultsThRight"><label>Description:</label></th>
            <td class='resultsTdLeft'><textarea rows="13" cols="80" readonly><?php echo $volBio[Description]; ?></textarea></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Work History:</label></th>
            <td class='resultsTdLeft'><textarea rows="13" cols="80" readonly><?php echo $volBio[WorkHistory]; ?></textarea></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Interests:</label></th>
            <td class='resultsTdLeft'><textarea rows="13" cols="80" readonly><?php echo $volBio[Interests]; ?></textarea></td>
        </tr>
    </table>
    <br/><br/>
    <p class="description">Skills</p>
    <table class='resultsTbl'>
        <tr>
            <th class="resultsTh">Skill Name</th>
            <th class="resultsTh">Experience Level</th>
            <th class="resultsTh">Current</th>
        </tr>
    <?php
        foreach($volSkills as $skill)
        {
            echo "<tr>
                <td class='resultsTdLeft'>" . $skill[SkillName] . "</td>
                <td class='resultsTdCenter'>" . $skill[ExperienceLevel] . "</td>
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
    <br>
</div>
<script src="scripts/vss_scripts.js"></script>
    
<?php
    // expand the accordian boxes and scroll to page top
    
    echo ("
        <script>
            $(function() {
                $('#contactPanel').click();
                $('#workPanel').click();
                window.location = '#';
            });
        </script>");
?>
    
<?php include '_footer.php'; ?>