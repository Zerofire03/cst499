<?php 

include '_header.php';
include 'storedProcedureCalls.php';

$authSuccess = null;

if ($_POST['login'])
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $authSuccess = getAuthenticatedUser($username, $password);
    
    if($authSuccess == 1)
    {
        $_SESSION['incorrect'] = false;
        
        $userInfo = getAuthUserByUserName($username);
        
        $_SESSION['userid'] = $userInfo['UserID'];
        $_SESSION['username'] = $userInfo['UserName'];
        $_SESSION['role'] = strtoupper($userInfo['Role']);
        $_SESSION['fname'] = $userInfo['FirstName'];
        $_SESSION['lname'] = $userInfo['LastName'];
        
        if($_SESSION['role'] == 'V')
        {
            $_SESSION['volid'] = $userInfo['VolunteerID'];
            header("Location:volProfile.php");
        }
        elseif($_SESSION['role'] == 'O')
        {
            $_SESSION['orgid'] = $userInfo['OrgID'];
            header("Location:orgProfile.php");
        }
    }
    else
    {
        $authSuccess = 0;
    }
}

?>
    <br/><br/>
        
    <!--Login Process-->
    <?php
        if(!isset($_SESSION['username']))
        {
           echo '<button class="accordion" id="userLogin">Returning Users</button>
            <div class="panel">';
        }
    ?>

    <div class="<?php echo isset($_SESSION['username']) ? 'hidden' : 'show';?>" id="loginTable">
        <h3><font color="black">Please Login</font></h3>
        <div id="loginBox">
            
    <?php
        // check for failed login attempt
        if (isset($authSuccess) && $authSuccess == 0)
        {
            // show the error
            echo '<p class="error">Invalid UserName and Password</p>';
            
            // write the script to open the accordion box
            echo ("
                <script>
                    $(function() {
                        $('#userLogin').click();
                    });
                </script>");
        }
    
    ?>
            
            <form method="post" action="" id="login">
                <input type="text" name="username" id="username" placeholder="UserName" title="Enter a valid username" required/>&nbsp;&nbsp;&nbsp;
                <input type="password" name="password" id="password" placeholder="Password" title="Enter a valid password" required/>
                <br/><br/>
                <button class="btn btn-primary" type="submit" id="login" name="login" value="Login">Login</button>
            </form>
            <br/>
        </div>
    </div>

    <!--Create Account Process-->
    <?php
        if(!isset($_SESSION['username']))
        {
            // close the prior panel div
            echo '</div>';
            echo '<button class="accordion" id="createUser">New Users</button>
            <div class="panel">';
        }
    ?>

    <div class="<?php echo isset($_SESSION['username']) ? 'hidden' : 'show';?>">
        <h3><font color="black">Sign Up</font></h3>
        <div id="accountBox">
            <form method="post" action="insertAuthUser.php">
                <input type="text" name="fName" id="fName" placeholder="First Name" size="23" maxlength="100" required/>&nbsp;&nbsp;&nbsp;
                    <input type="text" name="lName" id="lName" placeholder="Last Name" size="23" maxlength="100" required/>
                <br/><br/>
                <input type="email" name="email" id="email" placeholder="Email" size="50" maxlength="200"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                    title="please enter valid email [test@test.com]" />
                <br/><br/>
                <input type="password" name="password" id="password" placeholder="Password" size="50" maxlength="50" required/>
                <br/><br/>
                <input type="radio" name="account" id="volunteer" value="V"> Volunteer&nbsp;&nbsp;
                <input type="radio" name="account" id="organization" value="O"> Organization
                <br/><br/>
                <button class="btn btn-primary" type="submit" name="signup" id="signup" value="signup">Sign Up</button>
            </form>
        </div>
    </div>

    <?php
        if(!isset($_SESSION['username']))
        {
            // close the insert user panel div
            echo '</div>';
        }
    ?>

    <script src="scripts/vss_scripts.js"></script>

<?php include '_footer.php';