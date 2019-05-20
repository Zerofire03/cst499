 <?php 
      $fileName = basename($_SERVER['PHP_SELF']);
?>
 
 <!-- Navigation Bar-->
        <ul class="nav nav-pills" id="navBar">
          <li role="presentation" class="active"><a href="index.php">Home</a></li>
          <?php if(isset($_SESSION['username']) && $_SESSION['role'] == "V"){ echo '<li role="presentation"><a href="volProfile.php">Volunteer Profile</a></li>'; } ?>
          <?php if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href=orgProfile.php">Organization Profile</a></li>'; } ?>
          <?php if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="orgProfileEdit.php">Profile Editor</a></li>'; } ?>
          <?php if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="orgProject.php">Active Project</a></li>'; } ?>
          <?php if(isset($_SESSION['username']) && $_SESSION['role'] == "O"){ echo '<li role="presentation"><a href="volSearch.php">Volunteer Search</a></li>'; } ?>
          <li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>
          <?php echo isset($_SESSION['username']) ? '<li role="presentation"><a href="logout.php">Logout</a></li>' : ''; ?> 
        </ul>