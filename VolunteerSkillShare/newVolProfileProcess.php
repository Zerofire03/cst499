<?php
    session_start();
    include 'storedProcedureCalls.php';
    $authUser = getAuthUserByUserName($_SESSION['username']);
    
    $volID = InsertVolProfile($_POST['city'], $_POST['state'], $_POST['region'], $_POST['country'], $_POST['postalcode'], $_POST['url'], $_POST['email'], $_POST['phone'], $_POST['contactPref']);
    
    UpdateAuthUser($authUser[UserID], NULL, $volID['VolunteerID'], NULL, $_POST['fname'], $_POST['lname'], NULL, NULL, NULL, NULL);
    InsertVolBio($volID['VolunteerID'], $_POST['description'], $_POST['workHistory'], $_POST['interests']);
    
    
    if(isset($_POST['skill_list']))
    {
        $array = $_POST['skill_list'];
        
        
        foreach($_POST['skill_list'] as $skillID)
        {
            $experienceLevel = "experience" . $skillID;
            $isCurrent = "current" . $skillID;
            InsertVolSkill($volID['VolunteerID'], $skillID, $_POST[$experienceLevel], $_POST[$isCurrent]);
        }
    }
    
    header("Location:volProfile.php");
    
?>