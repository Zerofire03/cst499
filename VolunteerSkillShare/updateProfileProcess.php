<?php
    include "storedProcedureCalls.php";
    //using session varaibles to store admin name and display on other pages
    session_start();
    
    $authUser = getAuthUserByUserName($_SESSION['username']);

    UpdateVolProfile($authUser[VolunteerID], $_POST['city'], $_POST['state'], 
                        $_POST['region'], $_POST['country'], $_POST['postalcode'], 
                        $_POST['url'], $_POST['email'], $_POST['phone'], 
                        $_POST['contactPref']);
    
    UpdateVolBio($authUser[VolunteerID], $_POST['description'], $_POST['workHistory'], $_POST['interests']);
    UpdateAuthUser($authUser[UserID], NULL, NULL, NULL, $_POST['fname'], $_POST['lname'], NULL, NULL, NULL, NULL);
    
    if(isset($_POST['skill_list']))
    {
        $array = $_POST['skill_list'];
        
        
        foreach($_POST['skill_list'] as $skillID)
        {
            $experienceLevel = "experience" . $skillID;
            $isCurrent = "current" . $skillID;
            InsertVolSkill($authUser[VolunteerID], $skillID, $_POST[$experienceLevel], $_POST[$isCurrent]);
        }
    }
    
    
    
    header("Location:volProfileEdit.php");
    
?>