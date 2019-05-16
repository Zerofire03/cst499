<<<<<<< HEAD
<?php
    include '_header.php';
    include 'storedProcedureCalls.php';

    $volResults = null;
=======
    <?php include '_header.php';?>
>>>>>>> 5a2bf9f34dc627671cc2c130823dfe0a760a9204
    
    // get the skills list
    if (!isset($skillsList))
    {
        $skillsList = getSkills();
    }
    
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $region = $_REQUEST['region'];
    $country = $_REQUEST['country'];
    $postalcode = $_REQUEST['postalcode'];
    $skillid = $_REQUEST['skills'];
    $experiencelevel = $_REQUEST['experienceLevel'];
    $skillcurrent = $_REQUEST['skillCurrent'];

?>

        <div class="jumbotron text-center">
            <h1>VOLUNTEER SKILL SHARE</h1><br/>
            <h2>Welcome <?=$_SESSION['userName']?>!</h2><br/>
        </div>
        
        <!-- Navigation Bar-->
        <ul class="nav nav-pills">
          <li role="presentation"><a href="index.php">Home</a></li>
          <li role="presentation"><a href="orgProfile.php">Organization Profile</a></li>
          <li role="presentation"><a href="orgProfileEdit.php">Profile Editor</a></li>
          <li role="presentation"><a href="orgProject.php">Active Project</a></li>
          <li role="presentation" class="active"><a href="volSearch.php">Volunteer Search</a></li>
        </ul>
        
        <!-- code -->
        <div class="panel">
            <br/>
            <form id="volsearch" name="volsearch" method="post">
            <table class="tableInput">
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
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Skill: </label></td>
                    <td class="tdLeftAlign">
                        <select class="search" name='skills' id='skills'>
                            <option value = "">Select One</option>
                        <?php
                            if (isset($skillsList))
                            {
                                // build the select list from the $skillsList
                                foreach ($skillsList as $item)
                                {
                                    echo "<option value='" .$item['SkillID']."'";
                                    echo ">".$item['Name']."</option>";
                                }
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Experience Level:<br/>(1-low < 10-high) </label></td>
                    <td class="tdLeftAlign">
                        <select class="search" name="experienceLevel" id="experienceLevel">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Current Skill: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="checkbox" name="skillCurrent" id="skillCurrent"></td>
                </tr>
            </table>
            <br/><br/>
            <input type="submit" name="searchVols" id="searchVols" class="btn btn-primary" value="Search Volunteers">
            </form>

            <div id="searchVolResults" name="searchVolResults" class="resultsDiv">
<?php

    // test for search button press
    if(isset($_REQUEST['searchVols']))
    {
        $volResults = searchVolunteersByVarious($city, $state, $region, $country, $postalcode,
                            $skillid, $experiencelevel, $skillcurrent);
        
        echo "<br/><br/>";
        echo "<span style='font-weight:bold;'>Found Result(s): " . count($volResults) . "</span><br/>";
        echo "<table class='resultsTbl'>";
        
        // header row
        echo "<tr>
                <th class='resultsTh'>Name</th>
                <th class='resultsTh'>Email Address</th>
                <th class='resultsTh'>Url</th>
                <th class='resultsTh'>Contact Preference</th>
                <th class='resultsTh'>City</th>
                <th class='resultsTh'>State</th>
                <th class='resultsTh'>Region</th>
                <th class='resultsTh'>PostalCode</th>
                <th class='resultsTh'>Country</th>
            </tr>";
        
        foreach($orgResults as $item)
        {
            // variables for column results
            $volid = $item['VolunteerID'];
            $firstname = $item['FirstName'];
            $lastname = $item['LastName'];
            
            
            // display rows
            /*
                echo "<tr>";
                echo "<td class='resultsTdLeft'><a href='orgProfile.php?orgid=$orgid'>$name</a></td>";
                echo "<td class='resultsTdLeft'>$taxidentifier</td>";
                echo "<td class='resultsTdLeft'>$city</td>";
                echo "<td class='resultsTdLeft'>$state</td>";
                echo "<td class='resultsTdLeft'>$region</td>";
                echo "<td class='resultsTdLeft'>$postalcode</td>";
                echo "<td class='resultsTdLeft'>$country</td>";
                echo "</tr>";
            */
        }

    }
?>
            </div>
            
        </div>

        <!-- This is the footer -->
        <?php include '_footer.php';