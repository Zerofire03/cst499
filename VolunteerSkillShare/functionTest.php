<?php
    session_start();
    include 'storedProcedureCalls.php'; 
    UpdateVolProfile(2, 'Riverside', 'CA', 'SoCal', 'USA', '92507', 'foo.com', 'foo@foo.com', '1234567890', 'P');
?>