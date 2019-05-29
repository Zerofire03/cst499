<?php
    session_start();
    include 'storedProcedureCalls.php'; 
    
    
    $authUser = getAuthUserByUserName($_SESSION['username']);
    $volProfile = GetVolProfileByVolunteerID($authUser[VolunteerID]);
    $volBio = GetVolBioByVolunteerID($authUser[VolunteerID]);
    $volSkills = GetVolSkillsByVolunteerID($authUser[VolunteerID]);
    
    $skills = getSkills();
    $skillNames = array_column($skills, 'Name');
    
    print_r($skillNames);
    
    //array_search($skill[Name], $skillNames);
    
    if(array_search("Tax Preparation", $skillNames))
    {
        echo "<br>In Array";
    }
?>