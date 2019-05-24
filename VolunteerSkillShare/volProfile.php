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
                <?php echo '<input type="text" name="url" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Url] . ' readonly>'; ?>
                <br>
                
                Phone Number <br>
                <?php echo '<input type="text" name="phone" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[PhoneNumber] . ' readonly>'; ?>
                <br>
            </form>
            
        </div>
        <div class="col-sm-6">
            <form>
                Last Name <br>
                <?php echo '<input type="text" name="lname" value= ' . getAuthUserByUserName($_SESSION['username'])[LastName] . ' readonly>'; ?>
                <br>
                
                Email <br>
                <?php echo '<input type="text" name="email" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[EmailAddress] . ' readonly>'; ?>
                <br>
                
                Contact Preference <br>
                <?php echo (GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[ContactPref]=="E") ? 'Email' : 'Phone' ;?> 
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                Coutry of Residence <br>
                <?php echo '<input type="text" name="country" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Country] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                State <br>
                <?php echo '<input type="text" name="state" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[State] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                Region <br>
                <?php echo '<input type="text" name="region" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Region] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                City <br>
                <?php echo '<input type="text" name="city" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[City] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-2">
            <form>
                Postal Code <br>
                <?php echo '<input type="text" name="postalcode" value= ' . GetVolProfileByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[PostalCode] . ' readonly>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-4">
            <form>
                Bio <br>
                <?php echo '<textarea readonly form="volProfileEdit" rows="10">' . GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Description] . '</textarea>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-4">
            <form>
                Work History <br>
                <?php echo '<textarea readonly form="volProfileEdit" rows="10">' . GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[WorkHistory] . '</textarea>'; ?>
                <br>
            </form>
        </div>
        <div class="col-sm-4">
            <form>
                Interests <br>
                <?php echo '<textarea readonly form="volProfileEdit" rows="10">' . GetVolBioByVolunteerID(getAuthUserByUserName($_SESSION['username'])[VolunteerID])[Interests] . '</textarea>'; ?>

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