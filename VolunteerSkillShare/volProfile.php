<?php 
    include '_header.php';
    include '_enforceLogin.php';
    
    if(isset($_GET["volid"]))
    {
        header('Location:volProfileID.php?volid=' . $_GET["volid"]);
    }
    
    session_start();
    include 'storedProcedureCalls.php';   
       
       

    ?>
    <table class= "biotable">
        <tr>
        <th> First Name</th>
        <th><?php echo getAuthUserByUserName($_SESSION['username'])[FirstName]; ?> </th>
        </tr>
        <tr>
        <th> Last Name</th>
        <th><?php echo getAuthUserByUserName($_SESSION['username'])[LastName]; ?> </th>
        </tr>
        <tr>
        <th> Email Address</th>
        <th><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[EmailAddress]; ?></th>
        </tr>
        <tr>
        <th> URL</th>
        <th><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Url]; ?></th>
        </tr>
        <tr>
        <th> City </th>
        <th><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[City]; ?></th>
        </tr>
        <tr>
        <th> Region</th>
        <th><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Region]; ?></th>
        </tr>
        <tr>
        <th> State</th>
        <th><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[State]; ?></th>
        </tr>
        <tr>
        <th> Country</th>
        <th><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Country]; ?></th>
        </tr>
        <tr>
        <th> Postal Code</th>
        <th><?php echo GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[PostalCode]; ?></th>
        </tr>
        </table>
        
        <p class="description">Description</p>
        <br>
        <textarea rows = "25" cols="100" readonly="readonly"><?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Description]; ?>  </textarea> </th>
        
        <br>
        
        <p class="description"> Work History</p>
        <br>
        <th><textarea rows = "25" cols="100" readonly="readonly"><?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[WorkHistory]; ?></textarea> </th>

        <br>

        <p class="description"> Interests </p>
        <br>
        <th><textarea rows = "25" cols="100" readonly="readonly"><?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Interests]; ?></textarea> </th>
        
        <br>

                <p class="description">Skills</p>
                <br>
                <?php
                    echo "<table class='skillstable'>
                            <tr>
                                <th>Skill Name</th>
                                <th>Experience Level</th>
                                <th>Current</th>
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

<?php include '_footer.php'; ?>