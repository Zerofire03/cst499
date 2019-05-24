<?php
    include "storedProcedureCalls.php";
    //using session varaibles to store admin name and display on other pages
    session_start();
    
    UpdateVolProfile(getAuthUserByUserName($_SESSION['username'])[VolunteerID], $_POST['city'], $_POST['state'], $_POST['region'], $_POST['country'], $_POST['postalcode'], $_POST['url'], $_POST['email'], $_POST['phone'], $_POST['contactPref']);
    UpdateVolBio(getAuthUserByUserName($_SESSION['username'])[VolunteerID], $_POST['description'], $_POST['workHistory'], $_POST['interests']);
    header("Location:volProfileEdit.php");
    
?>