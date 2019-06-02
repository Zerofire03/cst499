<?php
// move the role tests into the nav items for more detail testing
//include '_enforceLogin.php';

$fileName = strtolower(basename($_SERVER['PHP_SELF'], '.php'));

echo '<nav class="navbar navbar-fixed-top">';
  echo '<div class="container-fluid">';
    echo '<div class="navbar-header">';
    // echo '<img src="/Images/teamwork-icon.jpg">';
      echo '<a class="navbar-brand image" href="#">
        <img alt="Volunteer Skill Share" src="https://a121af0a084344629db4e685b409fe7f.vfs.cloud9.us-east-2.amazonaws.com/cst499/VolunteerSkillShare/Images/handShakeHeart.png">
        </a>';
        echo '<a class="navbar-brand" href="#">
        Volunteer Skill Share
        </a>';
      
    echo '</div>';
    echo '<ul class="nav nav-pills" id="navBar">';
      
        echo '<ul class="nav nav-pills" id="navBar">';
          
        $vol = ($_SESSION['role'] == "V" ? TRUE : FALSE);
        $org = ($_SESSION['role'] == "O" ? TRUE : FALSE);
        
        // test the page names
        //echo "TESTTESTTEST - " . $fileName;
        
        if ($fileName == 'index')
        {
            // add top level items for volunteer or org
            echo '<li role="presentation" class="active"><a href="index.php">Home</a></li>';
            echo isset($_SESSION['username']) ? '<li class="hidden" role="presentation"><a href="login.php">Login</a></li>' : '<li class="show" role="presentation"><a href="login.php">Login</a></li>';
            
            if($vol)
            {
                echo '<li role="presentation"><a href="volProfile.php">My Profile</a></li>';
                echo '<li role="presentation"><a href="volProfileEdit.php">My Profile Edit</a></li>';
            }
            if($org)
            {
                echo '<li role="presentation"><a href="orgProfile.php">Org Profile</a></li>';
                echo '<li role="presentation"><a href="orgProfileEdit.php">Org Profile Editor</a></li>';
                echo '<li role="presentation"><a href="orgProject.php">Org Projects</a></li>';
                echo '<li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>';
            }
            
            echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
         }
         
        elseif ($fileName == 'login')
        {
            // available to all, including anonymous
            echo '<li role="presentation"><a href="index.php">Home</a></li>';
            echo '<li role="presentation" class="active"><a href="login.php">Login</a></li>';
            if($vol)
            {
                echo '<li role="presentation"><a href="volProfile.php">My Profile</a></li>';
                echo '<li role="presentation"><a href="volProfileEdit.php">My Profile Edit</a></li>';
            }
            if($org)
            {
                echo '<li role="presentation"><a href="orgProfile.php">Org Profile</a></li>';
                echo '<li role="presentation"><a href="orgProfileEdit.php">Org Profile Edit</a></li>';
                echo '<li role="presentation"><a href="orgProject.php">Org Projects</a></li>';  
                echo '<li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>';
            }
            echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
        }
        
        elseif ($fileName == 'orgsearch')
        {
            // available to all, including anonymous
            echo '<li role="presentation"><a href="index.php">Home</a></li>';
            echo '<li role="presentation"><a href="login.php">Login</a></li>';
            if($vol)
            {
                echo '<li role="presentation"><a href="volProfile.php">My Profile</a></li>';
                echo '<li role="presentation"><a href="volProfileEdit.php">My Profile Edit</a></li>';
            }
            if($org)
            {
                echo '<li role="presentation"><a href="orgProfile.php">Org Profile</a></li>';
                echo '<li role="presentation"><a href="orgProfileEdit.php">Org Profile Edit</a></li>';
                echo '<li role="presentation"><a href="orgProject.php">Org Projects</a></li>';  
                echo '<li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>';
            }
            echo '<li role="presentation" class="active"><a href="orgSearch.php">Active Project Search</a></li>';
        }
        
        elseif ($fileName == "volsearch")
        {
            // user should be a organization
            if(!$org)
            {
                header("Location:index.php");
            }
            
            echo '<li role="presentation"><a href="index.php">Home</a></li>';
            echo '<li role="presentation"><a href="orgProfile.php">Org Profile</a></li>';
            echo '<li role="presentation"><a href="orgProfileEdit.php">Org Profile Editor</a></li>';
            echo '<li role="presentation"><a href="orgProject.php">Org Projects</a></li>';  
            echo '<li role="presentation" class="active"><a href="volSearch.php">Volunteer Search</a></li>';
            echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
        }
        elseif ($fileName == "orgprofile")
        {
            // this page is visible to volunteers and orgs through the org/project search
            echo '<li role="presentation"><a href="index.php">Home</a></li>';
            if($vol)
            {
                echo '<li role="presentation"><a href="volProfile.php">My Profile</a></li>';
                echo '<li role="presentation"><a href="volProfileEdit.php">My Profile Edit</a></li>';
                echo '<li role="presentation" class="active"><a href="orgSearch.php">Active Project Search</a></li>';
            }
            elseif($org)
            {
                echo '<li role="presentation" class="active"><a href="orgProfile.php">Org Profile</a></li>';
                echo '<li role="presentation"><a href="orgProfileEdit.php">Org Profile Editor</a></li>';
                echo '<li role="presentation"><a href="orgProject.php">Org Projects</a></li>';  
                echo '<li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>';
                echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
            }
            else
            {
                echo '<li role="presentation" class="active"><a href="orgSearch.php">Active Project Search</a></li>';
            }
          // org project search put into role tests
        }
        
        // consolidate the org profile edit and org project edit to show the org project edit nav
        elseif ($fileName == "orgprofileedit" || $fileName == "orgprojectedit")
        {
            // this should be viewed by orgs
            if(!$org)
            {
                header("Location:index.php");
            }
        
            echo '<li role="presentation"><a href="index.php">Home</a></li>';
            echo '<li role="presentation"><a href="orgProfile.php">Org Profile</a></li>';
            echo '<li role="presentation" class="active"><a href="orgProfileEdit.php">Org Profile Editor</a></li>';
            echo '<li role="presentation"><a href="orgProject.php">Org Projects</a></li>';  
            echo '<li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>';
            echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
        }
        elseif ($fileName == "orgproject")
        {
            // this is visible to orgs and volunteers through the org/project search
            echo '<li role="presentation"><a href="index.php">Home</a></li>';
            if($vol)
            {
                echo '<li role="presentation"><a href="volProfile.php">My Profile</a></li>';
                echo '<li role="presentation"><a href="volProfileEdit.php">My Profile Edit</a></li>';
                echo '<li role="presentation" class="active"><a href="orgSearch.php">Active Project Search</a></li>';
            }
            elseif($org)
            {
                echo '<li role="presentation"><a href="orgProfile.php">Org Profile</a></li>';
                echo '<li role="presentation"><a href="orgProfileEdit.php">Org Profile Edit</a></li>';
                echo '<li role="presentation" class="active"><a href="orgProject.php">Org Projects</a></li>';  
                echo '<li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>';
                echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
            }
            else
            {
                echo '<li role="presentation" class="active"><a href="orgSearch.php">Active Project Search</a></li>';
            }
            // org project search put into role tests
        }
        /*
        elseif ($fileName == "orgprojectedit")
        {
            // this should be viewed by orgs
            if(!$org)
            {
                header("Location:index.php");
            }
            
            echo '<li role="presentation"><a href="index.php">Home</a></li>';
            echo '<li role="presentation"><a href="orgProfile.php">Org Profile</a></li>';
            echo '<li role="presentation"><a href="orgProfileEdit.php">Org Profile Edit</a></li>';
            echo '<li role="presentation"><a href="orgProject.php">Org Projects</a></li>';  
            echo '<li role="presentation" class="active"><a href="orgProjectEdit.php">Org Project Edit</a></li>';
            echo '<li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>';
            echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
        }
        */
        elseif ($fileName == "volprofile")
        {
            echo '<li role="presentation"><a href="index.php">Home</a></li>';
            if($vol){
                echo '<li role="presentation" class="active"><a href="volProfile.php">My Profile</a></li>';
                echo '<li role="presentation"><a href="volProfileEdit.php">My Profile Edit</a></li>';
            }
            elseif($org)
            {
                echo '<li role="presentation"><a href="orgProfile.php">Org Profile</a></li>';
                echo '<li role="presentation"><a href="orgProfileEdit.php">Org Profile Edit</a></li>';
                echo '<li role="presentation"><a href="orgProject.php">Org Projects</a></li>';  
                echo '<li role="presentation" class="active"><a href="volSearch.php">Volunteer Search</a></li>';
            }
            echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
        }
        
        elseif ($fileName == "volprofileid")
        {
            echo '<li role="presentation"><a href="index.php">Home</a></li>';
            if($vol){
                echo '<li role="presentation" class="active"><a href="volProfile.php">My Profile</a></li>';
                echo '<li role="presentation"><a href="volProfileEdit.php">My Profile Edit</a></li>';
            }
            elseif($org)
            {
                echo '<li role="presentation"><a href="orgProfile.php">Org Profile</a></li>';
                echo '<li role="presentation"><a href="orgProfileEdit.php">Org Profile Editor</a></li>';
                echo '<li role="presentation"><a href="orgProject.php">Org Projects</a></li>';  
                echo '<li role="presentation" class="active"><a href="volSearch.php">Volunteer Search</a></li>';
            }
            echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
        }
        elseif ($fileName == "volprofileedit")
        {
            // user must be a volunteer
            if(!$vol)
            {
                header("Location:index.php");
            }
            echo '<li role="presentation"><a href="index.php">Home</a></li>';
            echo '<li role="presentation"><a href="volProfile.php">My Profile</a></li>';
            echo '<li role="presentation" class="active"><a href="volProfileEdit.php">My Profile Edit</a></li>';
            echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
        }
        elseif ($fileName == "insertauthuser")
        {
            echo '<li role="presentation" class="active"><a href="index.php">Home</a></li>';
            echo '<li role="presentation"><a href="login.php">Login</a></li>';
            echo '<li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>';
        }
        
        // remove logout to all pages after login
        if($vol || $org){ echo '<li role="presentation"><a href="logout.php">Logout</a></li>'; }
        
        echo '</ul>';

   echo '</ul>';
          echo '</div>';
        echo '</nav>';

?>
