<script>
    function showhide(divname){
        console.log(divname);
        if (document.getElementsByClassName(divname)[0].style.display=="none"){
            document.getElementsByClassName(divname)[0].style.display="block";
        }
        else
            document.getElementsByClassName(divname)[0].style.display="none";
    }
</script>

<?php 
    include '_header.php';
    include '_enforceLogin.php';
    include 'storedProcedureCalls.php';
    session_start();
    
    $authUser;
    
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
    <button class="accordion" id="profilePanel" onclick="showhide('volbio')">Contact Information</button>
    <div class="volbio">
    <br/>
    <table class= "biotable">
        <tr>
        <td> First Name</th>
        <td><?php echo $authUser[FirstName]; ?> </th>
        </tr>
        <tr>
        <td> Last Name</th>
        <td><?php echo $authUser[LastName]; ?> </th>
        </tr>
        <tr>
        <td> Email Address</th>
        <td><?php echo $volProfile[EmailAddress]; ?></th>
        </tr>
        <tr>
            <td>Phone Number</th>
            <td><?php echo $volProfile[PhoneNumber]; ?></th>
        </tr>
        <tr>
            <td>Contact Preference</th>
            <td><?php echo ($volProfile[ContactPref]=="E") ? 'Email' : 'Phone' ;?></th>
        </tr>
        <tr>
        <td> URL</th>
        <td><?php echo $volProfile[Url]; ?></th>
        </tr>
        <tr>
        <td> City </th>
        <td><?php echo $volProfile[City]; ?></th>
        </tr>
        <tr>
        <td> Region</th>
        <td><?php echo $volProfile[Region]; ?></th>
        </tr>
        <tr>
        <td> State</th>
        <td><?php echo $volProfile[State]; ?></th>
        </tr>
        <tr>
        <td> Country</th>
        <td><?php echo $volProfile[Country]; ?></th>
        </tr>
        <tr>
        <td> Postal Code</th>
        <td><?php echo $volProfile[PostalCode]; ?></th>
        </tr>
        </table>
        </div>
        
    <button class="accordion" id="profilePanel" onclick="showhide('volinfo')">Volunteer Information</button>
    <div class="volinfo">
    <br/>
        <p class="description">Description</p>
        <br>
        <textarea rows = "13" cols="100" readonly="readonly"><?php echo $volBio[Description]; ?>  </textarea> </th>
        
        <br>
        
        <p class="description"> Work History</p>
        <br>
        <td><textarea rows = "13" cols="100" readonly="readonly"><?php echo $volBio[WorkHistory]; ?></textarea> </th>

        <br>

        <p class="description"> Interests </p>
        <br>
        <td><textarea rows = "13" cols="100" readonly="readonly"><?php echo $volBio[Interests]; ?></textarea> </th>
        
        <br>
        </table>

                <p class="description">Skills</p>
                <br>
                <?php
                    echo "<table class='skillstable'>
                            <tr>
                                <th>Skill Name</th>
                                <th>Experience Level</th>
                                <th>Current</th>
                            </tr>";
                    foreach($volSkills as $skills)
                    {
                        echo "<tr>
                                <td>" . $skills[SkillName] . "</td>
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
                <br>
            </div>

    
        <?php include '_footer.php'; ?>