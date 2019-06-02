<?php
include '_header.php';
include 'storedProcedureCalls.php';

    /*
    this page is used to create or edit org projects - if this is an edit, the
    orgprojectid will be passed in.  for all other cases the org should be pulled
    from the logged in user and this is a new project entry
    */
    
    $orgid = $_SESSION['orgid'];
    $orgprojectid = null;
    $orgdata = null;
    
    // get the orgid - can be passed as param (get or post), pulled from session, or null (new enrollment)
    if (isset($_REQUEST['orgprojectid']))
    {
        $orgid = $_REQUEST['orgid'];
    }
    else
    {
        // pull from the session table
        $orgid = $_SESSION['orgid'];
    }

?>

<!-- code -->





<!-- This is the footer -->
<?php include '_footer.php';