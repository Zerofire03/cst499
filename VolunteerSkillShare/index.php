    <?php include '_header.php';?>
    
    <body id="activePage">
        
        <div class="jumbotron text-center">
        <h1>VOLUNTEER SKILL SHARE</h1>
        </div>
        
        <!-- Navigation Bar-->
        <?php include '_navBar.php'; ?>
        
        <br>
        
       <!--Login Process-->
       <?php
            if(!isset($_SESSION['username']))
            {
               echo '<button class="accordion" id="userLogin">Returning Users</button>
                <div class="panel"';
            }
        ?>
         
        <p>
        <div class="<?php echo isset($_SESSION['username']) ? 'hidden' : 'show';?>"
        <h3><font color="black">Please Login</font></h3>
        <div id="loginBox">
        <form method="post" action="loginProcess.php">
            <input type="text" name="username" id="username" placeholder="UserName"/>
            <input type="password" name="password" id="password" placeholder="Password"/>
            <br>
            <button class="btn btn-primary" type="submit" value="Login">Login</button>
        </form>
        </div>
        </div>
        </p>   
        
        </div>
        
        
        
        <!--Create Account Process-->
        <?php
            if(!isset($_SESSION['username']))
            {
                echo '<button class="accordion" id="createUser">New Users</button>
                <div class="panel">';
            }
        ?>
            
        <div class="<?php echo isset($_SESSION['username']) ? 'hidden' : 'show';?>"
        <h3><font color="black">Sign Up</font></h3>
        <div id="accountBox">
        <form method="post" action="insertAuthUser.php">
            <input type="text" name="fName" id="fName" placeholder="First Name" size="20"/> <input type="text" name="lName" id="lName" placeholder="Last Name" size="20"/> <br>
            <input type="text" name="email" id="email" placeholder="Email" size="42"/> <br>
            <input type="password" name="password" id="passwordA" placeholder="Password" size="42"/> <br>
            <input type="radio" name="account" id="volunteer" value="V"> Volunteer <input type="radio" name="account" id="organization" value="O"> Organization<br>
            <button class="btn btn-primary" type="submit" value="signUp">Sign Up</button>
        </form>
        </div>
        </div>
        
        </div>
        
       <!-- Action: Button Click -->
       <script>
            var acc = document.getElementsByClassName("accordion");
            var i;
            
            for (i = 0; i < acc.length; i++) {
              acc[i].addEventListener("click", function() {
                this.classList.toggle("open");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight){
                  panel.style.maxHeight = null;
                } else {
                  panel.style.maxHeight = panel.scrollHeight + "px";
                } 
              });
            }
        </script>
        
    
        
<?php include '_footer.php';