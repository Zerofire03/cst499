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
    //include '_enforceLogin.php';
    session_start();
?>
        
       <!-- code -->
    
    <?php
        include 'storedProcedureCalls.php';   
       
       
    ?>
    <button class="accordion" id="profilePanel" onclick="showhide('volbio')">Contact Information</button>
    <div class="volbio">
    <br/>
    <table class= "biotable">
        <tr>
        <td> First Name</th>
        <td><?php echo getAuthUserByUserName($_SESSION['username'])[FirstName]; ?> </th>
        </tr>
        <tr>
        <td> Last Name</th>
        <td><?php echo getAuthUserByUserName($_SESSION['username'])[LastName]; ?> </th>
        </tr>
        <tr>
        <td> Email Address</th>
        <td><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[EmailAddress]; ?></th>
        </tr>
        <tr>
            <td>Phone Number</th>
            <td><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[PhoneNumber]; ?></th>
        </tr>
        <tr>
            <td>Contact Preference</th>
            <td><?php echo (GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[ContactPref]=="E") ? 'Email' : 'Phone' ;?></th>
        </tr>
        <tr>
        <td> URL</th>
        <td><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Url]; ?></th>
        </tr>
        <tr>
        <td> City </th>
        <td><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[City]; ?></th>
        </tr>
        <tr>
        <td> Region</th>
        <td><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Region]; ?></th>
        </tr>
        <tr>
        <td> State</th>
        <td><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[State]; ?></th>
        </tr>
        <tr>
        <td> Country</th>
        <td><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Country]; ?></th>
        </tr>
        <tr>
        <td> Postal Code</th>
        <td><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[PostalCode]; ?></th>
        </tr>
        </table>
        </div>
        
    <button class="accordion" id="profilePanel" onclick="showhide('volinfo')">Volunteer Information</button>
    <div class="volinfo">
    <br/>
        <p class="description">Description</p>
        <br>
        <textarea rows = "13" cols="100" readonly="readonly"><?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Description]; ?>  </textarea> </th>
        
        <br>
        
        <p class="description"> Work History</p>
        <br>
        <td><textarea rows = "13" cols="100" readonly="readonly"><?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[WorkHistory]; ?></textarea> </th>

        <br>

        <p class="description"> Interests </p>
        <br>
        <td><textarea rows = "13" cols="100" readonly="readonly"><?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Interests]; ?></textarea> </th>
        
        <br>
        </table>
        </div>
        
    <button class="accordion" id="profilePanel" onclick="showhide('volskills')">Volunteer Skills</button>
    <div class="volskills">
    <br/>

        <p class="description">Skills</p>
        <br>
        <?php
            echo "<table class='skillstable'>
                <tr>
                    <td>Skill Name</th>
                    <td>Experience Level</th>
                    <td>Current</th>
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
        <br>
    </div>
    
        <?php include '_footer.php'; ?>

        <!-- This is the footer -->
</body>
