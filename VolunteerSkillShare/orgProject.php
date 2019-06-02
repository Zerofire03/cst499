<?php

include '_header.php';
include 'storedProcedureCalls.php';

/*
This page is to display projects associated with a non-profit org partner.
Linking pages are from the org profile, org project search

if an orgprojectid is not passed in, the page will display a list of projects
    and the user can select one to show the details

User may be logged in as an org user, a volunteer user, or not logged in
*/

$orgid = null;
$displayprojectid = null;
$orgprojectlist = null;
$orgproject = null;
$orgprojectskills = null;

$showlist = false;
$showdetails = false;
$processfail = false;

// get the data
if (isset($_REQUEST['orgprojectid']))
{
    // retrieve the project, get the org id, pull all projects by this org, display details for the select
    $displayprojectid = $_REQUEST['orgprojectid'];
    
    // test test
    //echo ("OrgProjectID = " . $displayprojectid);
    
    $orgproject = GetOrgProjectByOrgProjectID($displayprojectid);
    
    //echo ("OrgProject Name = " . $orgproject['Name']);
    
    if (isset($orgproject))
    {
        $orgid = $orgproject['OrgID'];
        $orgprojectlist = GetOrgProjectsByOrgID($orgid);
        
        // get the skills for the detail project
        $orgprojectskills = GetOrgProjectSkillsByOrgProjectID($displayprojectid);
        
        $showdetails = true;
    }
    else
    {
        $processfail = true;
    }
}
// requesting all projects for a single org
elseif (isset($_REQUEST['orgid']))
{
    // pull all projects for the given org, choose one to display (based on start date?)
    $orgid = $_REQUEST['orgid'];
    $orgprojectlist = GetOrgProjectsByOrgID($orgid);
    
    // test test
    //echo("orgprojectlist count = " . count($orgprojectlist));
    
    if (isset($orgprojectlist))
    {
        $orgproject = $orgprojectlist[0];
        $displayprojectid = $orgproject['OrgProjectID'];
        
        // get the skills for the detail project
        $orgprojectskills = GetOrgProjectSkillsByOrgProjectID($displayprojectid);
        
        $showlist = true;
    }
    else
    {
        $processfail = true;
    }
}
// test for current org user
elseif (isset($_SESSION['orgid']))
{
    // if the current user is an org user, pull their own projects and choose one to display (based on start date?)
    // pull all projects for the given org, choose one to display (based on start date?)
    $orgid = $_SESSION['orgid'];
    $orgprojectlist = GetOrgProjectsByOrgID($orgid);
    
    // test test
    //echo("orgprojectlist count = " . count($orgprojectlist));
    
    if (isset($orgprojectlist))
    {
        $orgproject = $orgprojectlist[0];
        
        // test test
        //echo("orgprojectdetails Name = " . $orgproject["Name"]);
        
        $displayprojectid = $orgproject['OrgProjectID'];
        
        // get the skills for the detail project
        $orgprojectskills = GetOrgProjectSkillsByOrgProjectID($displayprojectid);
        
        $showlist = true;
    }
    else
    {
        $processfail = true;
    }
}
else
{
    $processfail = true;
}

if ($processfail)
{
    // no info to go on.  redirect back to orgsearch
    echo("<br/><span class='error'><h4>No Org Project to display<br/>
            Go to <a href='orgSearch.php'>Org Search</a> to find other projects.</h4></span><br/>");
}

?>

<!-- code -->
<button class="accordion" id="listPanel" title="Organization Project list">Org Projects</button>
<div class="panel">
    <br/>
    <!--
    <h3>Here is a list of active projects that your organization has listed for volunteers to find. <br/>
    If you would like to add, edit, or remove a project please follow the links under the Actions column.</h3>
    -->
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
        </tr>

<?php
    // show the user records
    foreach($orgprojectlist as $item)
    {
        echo "<tr>";
        echo "<td class='resultsTdLeft'><a href='orgProject.php?orgprojectid=". $item['OrgProjectID'] . "'>" . $item['Name'] . "</a></td>";
        echo "<td class='resultsTdLeft'>" . substr($item['Description'], 0, 20) . "...</td>";
        echo "<td class='resultsTdLeft'>" . $item['IsActive'] . "</td>";
        echo "<td class='resultsTdLeft'>";
        if (strtoupper($item['Priority']) == 'H')
        {
            echo "High";
        }
        elseif (strtoupper($item['Priority']) == 'M')
        {
            echo "Medium";
        }
        elseif (strtoupper($item['Priority']) == 'L')
        {
            echo "Low";
        }
        else
        {
            echo "N/A";
        }
        echo "</td>";
        echo "<td class='resultsTdLeft'>" . date('m-d-Y',strtotime($item['StartDate'])) . "</td>";
        echo "<td class='resultsTdLeft'>" . substr($item['TimelineDescription'], 0, 20) . "...</td>";
        echo "<td class='resultsTdLeft'>" . $item['City'] . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['State'] . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['Region'] . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['Country'] . "</td>";
        echo "<td class='resultsTdLeft'>" . $item['PostalCode'] . "</td>";
        echo "</tr>";
    }
?>
    </table>
    <br/>
</div>

<br/>
<button class="accordion" id="detailPanel" title="Org Project Information">Project Details</button>
<div class="panel">
    <br/>
    <table class="resultsTbl">
        <tr>
            <th class="resultsThRight"><label>Name:</label></th>
            <td class="resultsTdLeft"><?php echo($orgproject['Name']); ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Is Active:</label></th>
            <td class="resultsTdLeft"><?php echo(($orgproject['IsActive'] == 1 ? "Yes" : "No")); ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Priority:</label></th>
            <td class="resultsTdLeft"><?php echo($orgproject['Priority']); ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Description:</label></th>
            <td class="resultsTdLeft"><textarea rows="13" cols="80" readonly><?php echo($orgproject['Description']); ?></textarea></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Start Date:</label></th>
            <td class="resultsTdLeft"><?php echo(date('m-d-Y',strtotime($orgproject['StartDate']))); ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Timeline:</label></th>
            <td class="resultsTdLeft"><textarea rows="13" cols="80" readonly><?php echo($orgproject['TimelineDescription']); ?></textarea></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>City:</label></th>
            <td class="resultsTdLeft"><?php echo($orgproject['City']); ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Region / Neighborhood:</label></th>
            <td class="resultsTdLeft"><?php echo($orgproject['Region']); ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>State:</label></th>
            <td class="resultsTdLeft"><?php echo($orgproject['State']); ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Country:</label></th>
            <td class="resultsTdLeft"><?php echo($orgproject['Country']); ?></td>
        </tr>
        <tr>
            <th class="resultsThRight"><label>Postal Code:</label></th>
            <td class="resultsTdLeft"><?php echo($orgproject['PostalCode']); ?></td>
        </tr>
    </table>
    <br/>
    <p class="description">Skills</p>
    <table class='resultsTbl'>
        <tr>
            <th class="resultsThCenter">Skill Name</th>
            <th class="resultsThCenter">Description</th>
            <th class="resultsThCenter">Required</th>
        </tr>
    <?php
        foreach($orgprojectskills as $skill)
        {
            echo "<tr>
                <td class='resultsTdLeft'>" . $skill['SkillName'] . "</td>
                <td class='resultsTdCenter'><textarea rows='3' cols='30' readonly>" . $skill['Description'] . "</textarea></td>
                <td class='resultsTdCenter'>";
                if($skill['IsRequired'] == 1)
                {
                    echo "Yes";
                }
                else
                {
                     echo "No";
                }
            echo "</td>";
            echo "</tr>";
        }
    ?>
    </table>
    <br>
</div>

<script src="scripts/vss_scripts.js"></script>
    
<?php
    // expand the accordian boxes and scroll to page top
    if ($showlist)
    {
        echo ("
            <script>
                $(function() {
                    $('#listPanel').click();
                    window.location = '#';
                });
            </script>");
    }
    if ($showdetails)
    {
        echo ("
            <script>
                $(function() {
                    $('#detailPanel').click();
                    window.location = '#';
                });
            </script>");
    }
?>


<!-- This is the footer -->
<?php include '_footer.php';