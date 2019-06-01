<?php
    session_start();
    include 'storedProcedureCalls.php'; 
    
    
    $authUser = getAuthUserByUserName($_SESSION['username']);
    $volProfile = GetVolProfileByVolunteerID($authUser[VolunteerID]);
    $volBio = GetVolBioByVolunteerID($authUser[VolunteerID]);
    $volSkills = GetVolSkillsByVolunteerID($authUser[VolunteerID]);
    
    $skills = getSkills();
    $skillNames = array_column($volSkills, 'SkillName');
                            
    foreach($skills as $skill)
    {
        if(!(array_search($skill[Name], $skillNames)))
        {
            print_r($skill);
            echo "<br>";
        }
    }
?>