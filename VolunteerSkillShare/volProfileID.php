<?php 
    include '_header.php';
    include '_enforceLogin.php';
    session_start();
    include 'storedProcedureCalls.php';  
    
    $volid = $_GET["volid"];
    
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <form>
                First Name <br>
                <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID($volid)[FirstName] . ' readonly>'; ?>
                <br>
                
                URL <br>
                <?php echo '<input type="text" name="fname" value= ' . GetVolProfileByVolunteerID($volid)[Url] . ' readonly>'; ?>
                <br>
                
                
            </form>
            
        </div>
        <div class="col-sm-6">
            <form>
                Last Name <br>
                <?php echo '<input type="text" name="fname" value= ' .  GetVolProfileByVolunteerID($volid)[LastName] . ' readonly>'; ?>
                <br>
                
                Email <br>
                <?php echo '<input type="text" name="fname" value= ' .  GetVolProfileByVolunteerID($volid)[EmailAddress] . ' readonly>'; ?>
                <br>
                
                
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                Coutry of Residence <br>
                <?php echo '<input type="text" name="fname" value= ' .  GetVolProfileByVolunteerID($volid)[Country] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                State <br>
                <?php echo '<input type="text" name="fname" value= ' .  GetVolProfileByVolunteerID($volid)[State] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                Region <br>
                <?php echo '<input type="text" name="fname" value= ' .  GetVolProfileByVolunteerID($volid)[Region] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                City <br>
                <?php echo '<input type="text" name="fname" value= ' .  GetVolProfileByVolunteerID($volid)[City] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                Postal Code <br>
                <?php echo '<input type="text" name="fname" value= ' .  GetVolProfileByVolunteerID($volid)[PostalCode] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-4">
            <form>
                Bio <br>
                <?php echo GetVolBioByVolunteerID($volid)[Description]; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-4">
            <form>
                Work History <br>
                <?php echo GetVolBioByVolunteerID($volid)[WorkHistory]; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-4">
            <form>
                Interests <br>
                <?php echo GetVolBioByVolunteerID($volid)[Interests]; ?>
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
                $skills = GetVolSkillsByVolunteerID($volid);
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

        <!-- This is the footer -->
</body>