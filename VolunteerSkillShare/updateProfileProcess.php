<?php
    include "storedProcedureCalls.php";
    //using session varaibles to store admin name and display on other pages
    session_start();
    
    $authUser = getAuthUserByUserName($_SESSION['username']);
    $volProfile = GetVolProfileByVolunteerID($authUser[VolunteerID]);
    $volBio = GetVolBioByVolunteerID($authUser[VolunteerID]);
    $volSkills = GetVolSkillsByVolunteerID($authUser[VolunteerID]);
    
  
    
    UpdateVolProfile($authUser[VolunteerID], $_POST['city'], $_POST['state'], $_POST['region'], $_POST['country'], $_POST['postalcode'], $_POST['url'], $_POST['email'], $_POST['phone'], $_POST['contactPref']);
    UpdateVolBio($authUser[VolunteerID], $_POST['description'], $_POST['workHistory'], $_POST['interests']);
    
    //print_r($_POST['skill_list']);
    
    /*
    foreach($_POST['skill_list'] as $selected)
    {
        print_r($selected);
        echo "<br>";
    }
    */
    
    
    header("Location:volProfileEdit.php");
    
?>