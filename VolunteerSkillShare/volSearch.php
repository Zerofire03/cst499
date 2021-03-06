<?php
    include '_header.php';
    include 'storedProcedureCalls.php';

    $volResults = null;

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
    
    // default skill values to null
    $skillid = $experiencelevel = $skillcurrent = null;
    
    // only populate other params if skill is selected
    if (isset($_REQUEST['skills']) and $_REQUEST['skills'] != "")
    {
        $skillid = $_REQUEST['skills'];
        $experiencelevel = (isset($_REQUEST['experienceLevel']) ? $_REQUEST['experienceLevel'] : null);
        $skillcurrent = (isset($_REQUEST['skillCurrent']) ? 1 : null);
    }

    /*
    // testing
    echo "city - " . $city . "<br/>";
    echo "state - " . $state . "<br/>";
    echo "region - " . $region . "<br/>";
    echo "country - " . $country . "<br/>";
    echo "postalcode - " . $postalcode . "<br/>";
    echo "skillid - " . $skillid . "<br/>";
    echo "experiencelevel - " . $experiencelevel . "<br/>";
    echo "skillcurrent - " . $skillcurrent . "<br/>";
    */

?>
    <!-- code -->
    <br/>
    <div class="fixedheader">Volunteer Search</div>
    <div class="fixedpanel">
        <br/>
        <form id="volsearch" name="volsearch" method="post">
        <table class="resultsTbl">
            <tr>
                <th class="resultsThRight"><label for="city">City: </label></th>
                <td class="resultsTdLeft"><input class="search" type="text" name="city" id="city"/></td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="state">State: </label></th>
                <td class="resultsTdLeft"><input class="search" type="text" name="state" id="state"/></td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="region">Region / Neighborhood: </label></th>
                <td class="resultsTdLeft"><input class="search" type="text" name="region" id="region"/></td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="country">Country: </label></th>
                <td class="resultsTdLeft"><input class="search" type="text" name="country" id="country"/></td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="postalcode">Postal Code: </label></th>
                <td class="resultsTdLeft"><input class="search" type="text" name="postalcode" id="postalcode"/></td>
            </tr>
            <tr>
                <th class="resultsThRight"><label for="skills">Skill: </label></th>
                <td class="resultsTdLeft">
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
                <th class="resultsThRight"><label for="experienceLevel">Min Experience:<br/>(1-low < 10-high) </label></th>
                <td class="resultsTdLeft">
                    <select class="search" name="experienceLevel" id="experienceLevel">
                        <option value="">Select Level</option>
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
                <th class="resultsThRight"><label for="skillCurrent">Current Skill: </label></th>
                <td class="resultsTdLeft"><input class="search" type="checkbox" name="skillCurrent" id="skillCurrent"></td>
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
        // testing
        //echo "skill id = " . $skillid . "<br/>";
        
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
                <th class='resultsTh'>Skill</th>
                <th class='resultsTh'>Experience Level</th>
                <th class='resultsTh'>Current</th>
            </tr>";
        
        foreach($volResults as $item)
        {
            // variables for column results
            $volid = $item['VolunteerID'];
            $firstname = $item['FirstName'];
            $lastname = $item['LastName'];
            $email = $item['EmailAddress'];
            $url = $item['Url'];
            $pref = $item['ContactPref'];
            $city = $item['City'];
            $state = $item['State'];
            $region = $item['Region'];
            $postalcode = $item['PostalCode'];
            $country = $item['Country'];

            /*
            // Testing
            echo "skill id = " . $skillid . "<br/>";
            echo "item['SkillID'] = " . $item['SkillID'] . "<br/>";
            */
            
            if ($item['SkillID'] != "")
            {
                $skillid = $item['SkillID'];
                $explevel = $item['ExperienceLevel'];
                $curr = $item['IsCurrent'] == 1 ? "Y" : "N";
                $skillname = $item['Name'];
            }
            else
            {
                $skillid = "N/A";
                $explevel = "N/A";
                $curr = "N/A";
                $skillname = "N/A";
            }
            
            //echo "skill id = " . $skillid . "<br/>";
            
            // display rows
            echo "<tr>";
            echo "<td class='resultsTdLeft'><a href='volProfile.php?volid=$volid'>$firstname $lastname</a></td>";
            echo "<td class='resultsTdLeft'>$email</td>";
            echo "<td class='resultsTdLeft'>$url</td>";
            echo "<td class='resultsTdLeft'>$pref</td>";
            echo "<td class='resultsTdLeft'>$city</td>";
            echo "<td class='resultsTdLeft'>$state</td>";
            echo "<td class='resultsTdLeft'>$region</td>";
            echo "<td class='resultsTdLeft'>$postalcode</td>";
            echo "<td class='resultsTdLeft'>$country</td>";
            echo "<td class='resultsTdLeft'>$skillname</td>";
            echo "<td class='resultsTdLeft'>$explevel</td>";
            echo "<td class='resultsTdLeft'>$curr</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
?>
        </div>
    </div>
    <br/>
        
<!-- This is the footer -->
<?php include '_footer.php';