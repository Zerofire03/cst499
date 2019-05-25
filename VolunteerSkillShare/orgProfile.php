<?php 
    include '_header.php';
    include 'storedProcedureCalls.php';
    
    $orgid = null;
    
    // get the orgid
    if (isset($_REQUEST['orgid']))
    {
        $orgid = $_REQUEST['orgid'];
    }
    else
    {
        // pull from the authuser table
        $authuser = getAuthUserByUserName($_SESSION['username']);
        $orgid = $authuser['OrgID'];
    }

    // check for user delete
    if (isset($_REQUEST['deleteuserid']))
    {
        // delete the user -- checks to be sure user is connected with the org
        deleteOrgAuthUser($_REQUEST['deleteuserid'], $orgid);
    }
    
    // check for project delete -- delprojectid
    if (isset($_REQUEST['delprojectid']))
    {
        // delete the project
        deleteOrgProject($orgid, $_REQUEST['delprojectid']);
    }
    
    // retrieve the org profile info
    $orgdata = GetOrgProfileByOrgID($orgid);
    
    $orgusers = GetOrgAuthUsersByOrgID($orgid);
    
    $orgproject = GetOrgProjectsByOrgID($orgid);

?>

    <!-- code -->
    <button class="accordion" id="profilePanel">Org Profile</button>
    <div class="panel">
        <br/>
        <table class="resultsTbl">
            <tr>
                <th class="resultsTh" colspan="2"><h3>Profile</h3></th>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Name:</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['Name']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Description:</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['Description']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Mission:</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['Mission']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Tax ID:</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['TaxIdentifier']); ?></td>
            </tr>
            <tr>
                <!-- spacer -->
                <th class="resultsTh" colspan="2">&nbsp;</th>
            </tr>
            <tr>
                <th class="resultsTh" colspan="2"><h3>Contact Info</h3></th>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Contact Name:</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['Mission']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Contact Email</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['ContactEmail']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Contact Phone</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['ContactPhone']); ?></td>
            </tr>
            <tr>
                <!-- spacer -->
                <th class="resultsTh" colspan="2">&nbsp;</th>
            </tr>
            <tr>
                <th class="resultsTh" colspan="2"><h3>General Info</h3></th>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Address 1</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['Address1']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Address 2</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['Address2']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>City</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['City']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>State</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['State']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Region / Neighborhood</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['Region']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Country</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['Country']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Postal Code</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['PostalCode']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Email Address</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['EmailAddress']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Phone Number</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['PhoneNumber']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Twitter</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['Twitter']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>LinkedIn</h4></th>
                <td class="resultsTdLeft"><?php echo($orgdata['LinkedIn']); ?></td>
            </tr>
            <tr>
                <th class="resultsThRight"><h4>Updated Date</h4></th>
                <td class="resultsTdLeft"><?php echo(date('m-d-Y',strtotime($orgdata['UpdatedDate']))); ?></td>
            </tr>
        </table>
        <br/><br/>
        <a href="orgProfileEdit.php">Edit Profile</a>
    </div>
    <br/>

    <button class="accordion" id="usersPanel">Org Users</button>
    <div class="panel">
        <br/>
        <table class="resultsTbl">
            <tr>
                <th class="resultsTh"><h4>UserName</h4></th>
                <th class="resultsTh"><h4>First Name</h4></th>
                <th class="resultsTh"><h4>Last Name</h4></th>
                <th class="resultsTh"><h4>Last Login</h4></th>
                <th class="resultsTh"><h4>Updated Date</h4></th>
                <th class="resultsTh"><h4>Actions</h4></th>
            </tr>

<?php
    // show the user records
    foreach($orgusers as $item)
    {
        echo "<tr>";
        echo "<td class='resultsTdLeft'>" . $item['UserName'] . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['FirstName'] . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['LastName'] . "</td>";
        echo "<td class='resultsTdLeft'>" . date('m-d-Y',strtotime($item['LastLogin'])) . "</td>";
        echo "<td class='resultsTdLeft'>" . date('m-d-Y',strtotime($item['UpdatedDate'])) . "</td>";
        
        // user can't delete themself
        if ($item['UserID'] != $_SESSION['userid'])
        {
            echo "<td class='resultsTdLeft'><a href='orgProfile.php?orgid=" . $orgid . 
                "&deleteuserid=" . $item['UserID'] . 
                "' onclick='return confirm(\"Delete User - <" . $item['UserName'] . ">?\")'>delete</a></td>";
        }
        else
        {
            echo "<td class='resultsTdLeft'></td>";
        }
        
        echo "</tr>";
    }
?>
        </table>
    </div>
    <br/>
    
    <button class="accordion" id="projectsPanel">Org Projects</button>
    <div class="panel">
        <br/>
        <table class="resultsTbl">
            <tr>
                <th class="resultsTh"><h4>Name</h4></th>
                <th class="resultsTh"><h4>Description</h4></th>
                <th class="resultsTh"><h4>Active</h4></th>
                <th class="resultsTh"><h4>Priority</h4></th>
                <th class="resultsTh"><h4>Start Date</h4></th>
                <th class="resultsTh"><h4>Timeline Desc</h4></th>
                <th class="resultsTh"><h4>City</h4></th>
                <th class="resultsTh"><h4>State</h4></th>
                <th class="resultsTh"><h4>Region / Neighborhood</h4></th>
                <th class="resultsTh"><h4>Country</h4></th>
                <th class="resultsTh"><h4>Postal Code</h4></th>
                <th class="resultsTh"><h4>Updated Date</h4></th>
                <th class="resultsTh"><h4>Actions</h4></th>
            </tr>

<?php
    // show the user records
    foreach($orgproject as $item)
    {
        echo "<tr>";
        echo "<td class='resultsTdLeft'>" . $item['Name'] . "</td>";
        echo "<td class='resultsTdLeft'>" . substr($item['Description'], 0, 20) . "...</td>";
        echo "<td class='resultsTdLeft'>" . $item['IsActive'] . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['Priority'] . "</td>";
        echo "<td class='resultsTdLeft'>" . date('m-d-Y',strtotime($item['StartDate'])) . "</td>";
        echo "<td class='resultsTdLeft'>" . substr($item['TimelineDescription'], 0, 20) . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['City'] . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['State'] . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['Region'] . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['Country'] . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['PostalCode'] . "</td>";
        echo "<td class='resultsTdLeft'>" . date('m-d-Y',strtotime($item['UpdatedDate'])) . "</td>";
        
        // delete comes back to this page
        // project edit links to projectedit page
        echo "<td class='resultsTdLeft'>";
        echo "<a href='orgProjectEdit.php?orgprojectid=" . $item['OrgProjectID'] . "'>edit</a>";
        echo "&nbsp;&nbsp;";
        echo "<a href='orgProfile.php?orgid=" . $orgid . 
                    "&delprojectid=" . $item['OrgProjectID'] . 
                    "' onclick='return confirm(\"Delete Project - <" . $item['Name'] . ">?\")'>delete</a>";
        echo "</td>";
        echo "</tr>";
    }
?>
        </table>


    </div>

    <script src="scripts/vss_scripts.js"></script>
    
<?php
    // expand the accordian boxes and scroll to page top
    
    echo ("
        <script>
            $(function() {
                $('#projectsPanel').click();
                $('#usersPanel').click();
                $('#profilePanel').click();
                window.location = '#';
            });
        </script>");
        
        //$('body').scrollTop(0);
?>

<!-- This is the footer -->
<?php include '_footer.php';