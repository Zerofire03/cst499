<?php
    include '_header.php';
    include 'storedProcedureCalls.php';
    
    $orgResults = null;
    $orgProjectResults = null;

    // grab the results for orgsearch
    $name = $_REQUEST['name'];
    $taxidentifier = $_REQUEST['taxidentifier'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $region = $_REQUEST['region'];
    $country = $_REQUEST['country'];
    $postalcode = $_REQUEST['postalcode'];

    // grab the results for orgprojectsearch
    //$projectpriority = $_REQUEST['projectpriority'];
    $projectpriority = ($_REQUEST['projectpriority'] == "on" ? 'H':NULL);
    $projectcity = $_REQUEST['projectcity'];
    $projectstate = $_REQUEST['projectstate'];
    $projectregion = $_REQUEST['projectregion'];
    $projectcountry = $_REQUEST['projectcountry'];
    $projectpostalcode = $_REQUEST['projectpostalcode'];
    
    if (isset($_REQUEST['startdatebegin']))
    {
        if (!(empty(trim($_REQUEST['startdatebegin']))))
        {
        $startdatebegin = date('Y-m-d', strtotime($_REQUEST['startdatebegin']));
        }
        else
        {
        $startdatebegin = date('Y-m-d', strtotime('1900-01-01'));
        }
    }
    if (isset($_REQUEST['startdateend']))
    {
        if (!(empty(trim($_REQUEST['startdateend']))))
        {
        $startdateend = date('Y-m-d', strtotime($_REQUEST['startdateend']));
        }
        else
        {
        $startdateend = date('Y-m-d', strtotime('2199-12-31'));
        }
    }

    // testing
    //echo "projectpriority = " . $projectpriority . " - startdatebegin = " . $startdatebegin . " - startdateend = " . $startdateend . "<br/>";

    // determine which items to show
    // write the script element to open the orgsearch if no search form was passed
    $openOrgs = FALSE;
    $openProjects = FALSE;
    
    if (isset($_REQUEST['searchOrgs']))
    {
        $openOrgs = TRUE;
    }
    if (isset($_REQUEST['searchOrgProjects']))
    {
        $openProjects = TRUE;
    }
    
    if ($openOrgs == FALSE and $openProjects == FALSE)
    {
        $openOrgs = TRUE;
    }
?>
        
        <!-- code -->
        <br/>
        <button class="accordion" id="orgSearchPanel">Search for Organizations</button>
        <div class="panel">
            <br/>
            <form id="orgsearch" name="orgsearch" method="post">
            <table class="tableInput">
               <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Name: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="name" id="name"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Tax Identifier: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="taxidentifier" id="taxidentifier"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">City: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="city" id="city"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">State: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="state" id="state"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Region / Neighborhood: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="region" id="region"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Country: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="country" id="country"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Postal Code: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="postalcode" id="postalcode"/></td>
                </tr>
            </table>
            <br/><br/>
            <input type="submit" name="searchOrgs" id="searchOrgs" class="btn btn-primary" value="Search Orgs">
            </form>

            <div id="searchOrgResults" name="searchOrgResults" class="resultsDiv">
<?php

    // searching orgs
    if(isset($_REQUEST['searchOrgs']))
    {
        // test output        
        //echo("searchOrgs found - " .
        //            "\nname = " . $name . 
        //            "\ntaxidentifier = " . $taxidentifier .
        //            "\ncity = " . $city . 
        //            "\nstate = " . $state .
        //            "\nregion = " . $region .
        //            "\ncountry = " . $country .
        //            "\npostalcode = " . $postalcode);
        
        $orgResults = searchOrgsByVarious($name, $taxidentifier, $city, $state, $region, 
                $country, $postalcode);

        //echo count($orgResults);

        // write the output
        if (isset($orgResults))
        {
            // track the item counts per row
            //$orgCount = count($orgResults);
    
            echo "<br/><br/>";
            echo "<span style='font-weight:bold;'>Found Result(s): " . count($orgResults) . "</span><br/>";
            echo "<table class='resultsTbl'>";
            echo "<tr>
                    <th class='resultsTh'>Name</th>
                    <th class='resultsTh'>Tax Identifier</th>
                    <th class='resultsTh'>City</th>
                    <th class='resultsTh'>State</th>
                    <th class='resultsTh'>Region</th>
                    <th class='resultsTh'>PostalCode</th>
                    <th class='resultsTh'>Country</th>
                </tr>";
            
            foreach($orgResults as $item)
            {
                $orgid = $item['OrgID'];
                $name = $item['Name'];
                //$description = $item['Description'];
                //$mission = $item['Mission'];
                $taxidentifier = $item['TaxIdentifier'];
                //$contactname = $item['ContactName'];
                //$contactemail = $item['ContactEmail'];
                //$contactphone = $item['ContactPhone'];
                //$address1 = $item['Address1'];
                //$address2 = $item['Address2'];
                $city = $item['City'];
                $state = $item['State'];
                $region = $item['Region'];
                $country = $item['Country'];
                $postalcode = $item['PostalCode'];
                //$emailaddress = $item['EmailAddress'];
                //$phonenumber = $item['PhoneNumber'];
                //$twitter = $item['Twitter'];
                //$linkedin = $item['LinkedIn'];
                
                echo "<tr>";
                echo "<td class='resultsTdLeft'><a href='orgProfile.php?orgid=$orgid'>$name</a></td>";
                echo "<td class='resultsTdLeft'>$taxidentifier</td>";
                echo "<td class='resultsTdLeft'>$city</td>";
                echo "<td class='resultsTdLeft'>$state</td>";
                echo "<td class='resultsTdLeft'>$region</td>";
                echo "<td class='resultsTdLeft'>$postalcode</td>";
                echo "<td class='resultsTdLeft'>$country</td>";
                echo "</tr>";
            }
            
            echo "</table>";
        }
    }

?>
            </div>
        </div>
       
        <button class="accordion" id="projectSearchPanel">Search for Projects</button>
        <div class="panel">
            <br/>
            <form id="orgprojectsearch" name="orgprojectsearch" method="post">
            <table class="tableInput">
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">High Priority Project: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="checkbox" name="projectpriority" id="projectpriority"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Date Range - Start: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="date" name="startdatebegin" id="startdatebegin"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Date Range - End: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="date" name="startdateend" id="startdateend"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">City: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="projectcity" id="projectcity"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">State: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="projectstate" id="projectstate"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Region / Neighborhood: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="projectregion" id="projectregion"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Country: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="projectcountry" id="projectcountry"/></td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Postal Code: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="text" name="projectpostalcode" id="projectpostalcode"/></td>
                </tr>
            </table>
            <br/><br/>
            <input type="submit" name="searchOrgProjects" id="searchOrgProjects" class="btn btn-primary" value="Search Projects">
            </form>
            
            <div id="searchOrgProjectResults" name="searchOrgProjectResults" class="resultsDiv">
<?php

    if (isset($_REQUEST['searchOrgProjects']))
    {
        $orgProjectResults = searchOrgProjectsByVarious($projectpriority, 
                $startdatebegin, $startdateend, $projectcity, $projectstate, 
                $projectregion, $projectcountry, $projectpostalcode);

        // test values
        //echo count($orgProjectResults);
        
        // write the output
        if (isset($orgProjectResults))
        {
            // track the item counts per row
            //$projectCount = count($orgProjectResults);
            
            echo "<br/><br/>";
            echo "<span style='font-weight:bold;'>Found Result(s): " . count($orgProjectResults) . "</span><br/>";
            echo "<table class='resultsTbl'>";
            echo "<tr>
                    <th class='resultsTh'>Project</th>
                    <th class='resultsTh'>Organization</th>
                    <th class='resultsTh'>Priority</th>
                    <th class='resultsTh'>Active</th>
                    <th class='resultsTh'>Start Date</th>
                    <th class='resultsTh'>Timeline</th>
                    <th class='resultsTh'>City</th>
                    <th class='resultsTh'>State</th>
                    <th class='resultsTh'>Region</th>
                    <th class='resultsTh'>PostalCode</th>
                    <th class='resultsTh'>Country</th>
                </tr>";
    
            foreach($orgProjectResults as $item)
            {
                $orgprojectid = $item['OrgProjectID'];
                $projectorgid = $item['OrgID'];
                $name = $item['Name'];
                $orgname = $item['OrgName'];
                $isactive = $item['IsActive'];
                $priority = $item['Priority'];
                //$description = $item['Description'];
                $startdate = $item['StartDate'];
                $timeline = $item['TimelineDescription'];
                $projectcity = $item['City'];
                $projectstate = $item['State'];
                $projectregion = $item['Region'];
                $projectcountry = $item['Country'];
                $projectpostalcode = $item['PostalCode'];
                
                echo "<tr>";
                echo "<td class='resultsTdLeft'><a href='orgProject.php?orgprojectid=$orgprojectid'>$name</a></td>";
                echo "<td class='resultsTdLeft'><a href='orgProfile.php?orgid=$projectorgid'>$orgname</a></td></td>";
                echo "<td class='resultsTdLeft'>$priority</td>";
                echo "<td class='resultsTdLeft'>" . ($isactive==1 ? "Y" : "N") . "</td>";
                echo "<td class='resultsTdLeft'>$startdate</td>";
                echo "<td class='resultsTdLeft'>$timeline</td>";
                echo "<td class='resultsTdLeft'>$projectcity</td>";
                echo "<td class='resultsTdLeft'>$projectstate</td>";
                echo "<td class='resultsTdLeft'>$projectregion</td>";
                echo "<td class='resultsTdLeft'>$projectpostalcode</td>";
                echo "<td class='resultsTdLeft'>$projectcountry</td>";
                echo "</tr>";
            }
            
            echo "</table>";
            //echo $orgResults;
        }
    }

?>
            </div>
        </div>

        <script src="scripts/vss_scripts.js"></script>

<?php
    // test the panel variables
    
    if ($openOrgs)
    {
        echo ("
            <script>
                $(function() {
                    $('#orgSearchPanel').click();
                });
            </script>");
    }

    if ($openProjects)
    {
        echo ("
            <script>
                $(function() {
                    $('#projectSearchPanel').click();
                });
            </script>");
    }
?>

        <!-- This is the footer -->
        <?php include '_footer.php';