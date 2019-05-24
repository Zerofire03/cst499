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
    
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <form>
                First Name <br>
                <?php echo '<input type="text" name="fname" value= ' . getAuthUserByUserName($_SESSION['username'])[FirstName] . ' readonly>'; ?>
                <br>
                
                URL <br>
                <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Url] . ' readonly>'; ?>
                <br>
                
                
            </form>
            
        </div>
        <div class="col-sm-6">
            <form>
                Last Name <br>
                <?php echo '<input type="text" name="fname" value= ' . getAuthUserByUserName($_SESSION['username'])[LastName] . ' readonly>'; ?>
                <br>
                
                Email <br>
                <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[EmailAddress] . ' readonly>'; ?>
                <br>
                
                
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                Coutry of Residence <br>
                <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Country] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                State <br>
                <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[State] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                Region <br>
                <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Region] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                City <br>
                <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[City] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                Postal Code <br>
                <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[PostalCode] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-4">
            <form>
                Bio <br>
                <?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Description]; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-4">
            <form>
                Work History <br>
                <?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[WorkHistory]; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-4">
            <form>
                Interests <br>
                <?php echo GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Interests]; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-12">
            Skills <br>
            <?php
                echo "<table>
                        <tr>
                            <th>Skill Name</th>
                            <th>Experience Level</th>
                            <th>Current</th>
                        </tr>";
                $skills = GetVolSkillsByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID]);
                foreach($skills as $skill)
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

<?php include '_footer.php'; ?>