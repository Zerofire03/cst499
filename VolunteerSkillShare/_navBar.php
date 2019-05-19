 <!-- Navigation Bar-->
        <ul class="nav nav-pills" id="navBar">
          <li role="presentation" class="active"><a href="index.php">Login</a></li>
          <li role="presentation"><a href="volProfile.php">Volunteer Profile</a></li> 
          <li role="presentation"><a href="orgProfile.php">Organization Profile</a></li>
          <li role="presentation"><a href="orgSearch.php">Active Project Search</a></li>
          <div class="<?php echo isset($_SESSION['username']) ? 'show' : 'hidden';?>"
            <li role="presentation"><a href="logout.php">Logout</a></li>
          </div>
        </ul>