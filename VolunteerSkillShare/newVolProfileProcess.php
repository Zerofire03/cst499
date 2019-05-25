<?php
    session_start();
    include 'storedProcedureCalls.php';
    $volID = InsertVolProfile($_POST['city'], $_POST['state'], $_POST['region'], $_POST['country'], $_POST['postalcode'], $_POST['url'], $_POST['email'], $_POST['phone'], $_POST['contactPref']);
    UpdateVolBio($volID, $_POST['description'], $_POST['workHistory'], $_POST['interests']);
    //Need to call updateAuthUser to insert VolID returned
?>