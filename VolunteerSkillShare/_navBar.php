<?php
  // move the role tests into the nav items for more detail testing
  //include '_enforceLogin.php';

  $fileName = strtolower(basename($_SERVER['PHP_SELF'], '.php'));

  echo '<ul class="nav nav-pills" id="navBar">';


 // test the page names
 //echo "TESTTESTTEST - " . $fileName;

 if ($fileName == 'index')
 {
  // add top level items for volunteer or org
  echo '<li role="presentation" class="active"><a href="index.php">Home</a></li>';
  if(isset($_SESSION['username']) && $_SESSION['role'] == "V"){ echo '<li role="presentation"><a href="volProfile.php">Volunteer Profile</a></li>'; }
  if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="orgProfile.php">Organization Profile</a></li>'; }
  if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="orgProfileEdit.php">Profile Editor</a></li>'; }
  if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="orgProject.php">Active Project</a></li>'; }
  if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>'; }
  echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';

 }
 elseif ($fileName == 'orgsearch')
 {
  echo '<li role="presentation"><a href="index.php">Home</a></li>';
  echo '<li role="presentation" class="active"><a href="orgSearch.php">Active Project Search</a></li>';
 }
 elseif ($fileName == "volsearch")
 {
  // user should be a organization
  if($_SESSION['role'] != 'O')
  {
      header("Location:index.php");
  }
  
  echo '<li role="presentation"><a href="index.php">Home</a></li>';
  if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="orgProfileEdit.php">Profile Editor</a></li>'; }
  if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="orgProject.php">Active Project</a></li>'; }
  if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation" class="active"><a href="volSearch.php">Volunteer Search</a></li>'; }
  echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
 }
 elseif ($fileName == "orgprofile")
 {
  echo '<li role="presentation"><a href="index.php">Home</a></li>';
  if(isset($_SESSION['username']) && $_SESSION['role'] == "V"){ echo '<li role="presentation"><a href="volProfile.php">Volunteer Profile</a></li>'; }
  if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="orgProfileEdit.php">Profile Editor</a></li>'; }
  if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="orgProject.php">Active Project</a></li>'; }
  if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>'; }
  echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
 }
 elseif ($fileName == "orgprofileedit")
 {
  echo '<li role="presentation"><a href="index.php">Home</a></li>';
  echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
 }
 elseif ($fileName == "orgproject")
 {
  echo '<li role="presentation"><a href="index.php">Home</a></li>';
    if(isset($_SESSION['username']) && $_SESSION['role'] == "V"){ echo '<li role="presentation"><a href="volProfile.php">Volunteer Profile</a></li>'; }
    echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
 }
 elseif ($fileName == "orgprojectedit")
 {
  echo '<li role="presentation"><a href="index.php">Home</a></li>';
  echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
 }
 elseif ($fileName == "volprofile")
 {
  echo '<li role="presentation"><a href="index.php">Home</a></li>';
    if(isset($_SESSION['username']) && $_SESSION['role'] == "V"){ echo '<li role="presentation" class="active"><a href="volProfile.php">Volunteer Profile</a></li>'; }
    echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
 }
 elseif ($fileName == "volprofileedit")
 {
  echo '<li role="presentation"><a href="index.php">Home</a></li>';
    if(isset($_SESSION['username']) && $_SESSION['role'] == "V"){ echo '<li role="presentation"><a href="volProfile.php">Volunteer Profile</a></li>'; }
    echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
 }
 elseif ($fileName == "insertauthuser")
 {
  echo '<li role="presentation"><a href="index.php">Home</a></li>';
  echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
 }
 
 // add logout to all pages after login
 if(isset($_SESSION['username'])){ echo '<li role="presentation"><a href="logout.php">Logout</a></li>'; }
 echo '</ul>';

?>

