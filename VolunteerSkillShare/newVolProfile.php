<?php
       include '_header.php';
       include '_enforceLogin.php';
       session_start();
       include 'storedProcedureCalls.php'; 
?>
        
<div class="container">
       <div class="row">
              <form id="volProfileEdit" method="post" action="newVolProfileProcess.php">
                     <div class="col-sm-6">
                            First Name <br>
                            <?php echo '<input type="text" name="fname" value= ' . getAuthUserByUserName($_SESSION['username'])[FirstName] . ' >'; ?>
                            <br>
                
                            URL <br>
                            <input type="text" name="url">'
                            <br>
                            
                            Phone Number <br>
                            <input type="text" name="phone">
                            <br>
                     </div>
                     <div class="col-sm-6">
                            Last Name <br>
                            <?php echo '<input type="text" name="lname" value= ' . getAuthUserByUserName($_SESSION['username'])[LastName] . ' >'; ?>
                            <br>
                       
                            Email <br>
                            <?php echo '<input type="text" name="email" value= ' . getAuthUserByUserName($_SESSION['username'])[UserName] . ' >'; ?>
                            <br>
                            
                            Contact Preference <br>
                            <input type="radio" name="contactPref" value="E" checked> Email 
                            <input type="radio" name="contactPref" value="P"> Phone
                            <br>
                     </div>
                     <div class="col-sm-2">
                            Coutry of Residence <br>
                            <input type="text" name="country">
                            <br>
                     </div>
                     <div class="col-sm-2">
                            State <br>
                            <input type="text" name="state">
                            <br>
                     </div>
                     <div class="col-sm-2">
                            Region <br>
                            <input type="text" name="region">
                            <br>
                     </div>
                     <div class="col-sm-2">
                            City <br>
                            <input type="text" name="city">
                            <br>
                     </div>
                     <div class="col-sm-2">
                            Postal Code <br>
                            <input type="text" name="postalcode">'
                            <br>
                     </div>
                     <div class="col-sm-4">
                            Bio <br>
                            <textarea form="volProfileEdit" name="description" rows="10"></textarea>
                            <br>
                     </div>
                     <div class="col-sm-4">
                            Work History <br>
                            <textarea form="volProfileEdit" name="workHistory" rows="10"></textarea>'
                            <br>
                     </div>
                     <div class="col-sm-4">
                            Interests <br>
                            <textarea form="volProfileEdit" name="interests" rows="10"></textarea>'
                            <br>
                     </div>
                     <div class="col-sm-12">
                            <button class="btn btn-primary" type="submit" value="update">Create Profile</button>
                     </div>
              </form>
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
        
<!-- This is the footer -->
<?php include '_footer.php';