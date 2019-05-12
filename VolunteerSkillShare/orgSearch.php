<?php
    include '_header.php';
    include 'storedProcedureCalls.php';

    if(isset($_REQUEST['searchOrgs']))
    {
        $name = $_REQUEST['name'];
        $taxidentifier = $_REQUEST['taxidentifier'];
        $city = $_REQUEST['city'];
        $state = $_REQUEST['state'];
        $region = $_REQUEST['region'];
        $country = $_REQUEST['country'];
        $postalcode = $_REQUEST['postalcode'];

        /*
        // test output        
        echo("searchOrgs found - " .
                    "\nname = " . $name . 
                    "\ntaxidentifier = " . $taxidentifier .
                    "\ncity = " . $city . 
                    "\nstate = " . $state .
                    "\nregion = " . $region .
                    "\ncountry = " . $country .
                    "\npostalcode = " . $postalcode);
        */
        
        $results = searchOrgsByVarious($name, $taxidentifier, $city, $state, $region, 
                $country, $postalcode);
        
        echo $results;
    }
    
    if (isset($_REQUEST['searchProjectOrgs']))
    {
        $isactive = $_REQUEST['isactive'];
        $isactive = $_REQUEST['startdatebegin'];
        $isactive = $_REQUEST['startdateend'];
        $isactive = $_REQUEST['city'];
        $isactive = $_REQUEST['state'];
        $isactive = $_REQUEST['region'];
        $isactive = $_REQUEST['country'];
        $isactive = $_REQUEST['postalcode'];
        
        $results = searchOrgProjectsByVarious($isactive, $startdatebegin, 
                $startdateend, $city, $state, $region, $country, $postalcode);
        
        echo $results;
    }
?>

    <body id="activePage">
        <div class="jumbotron text-center">
        <h1>VOLUNTEER SKILL SHARE</h1><br/>
        </div>
        
        <!-- Navigation Bar-->
        <ul class="nav nav-pills">
          <li role="presentation"><a href="index.php">Home</a></li>
          <li role="presentation"><a href="volProfile.php">Volunteer Profile</a></li>
          <li role="presentation"><a href="volProfileEdit.php">Profile Editor</a></li>
          <li role="presentation" class="active"><a href="orgSearch.php">Active Project Search</a></li>
        </ul>
        
        <!-- code -->
        <br/>
        <button class="accordion" id="orgSearchPanel">Search for Organizations</button>
        <div class="panel">
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
            <br/>
            <input type="submit" name="searchOrgs" class="btn btn-primary" value="Search Orgs">
            </form>
            
            <div id="searchOrgResults" name="searchOrgResults">
                
            </div>
        </div>
       
        <button class="accordion" id="projectSearchPanel">Search for Projects</button>
        <div class="panel">
            <form id="orgprojectsearch" name="orgprojectsearch" method="post">
            <table class="tableInput">
               <tr>
                    <td class="tdRightAlign"><label class="inputHeading">Active Only: </label></td>
                    <td class="tdLeftAlign"><input class="search" type="checkbox" name="isactive" id="isactive"/></td>
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
            
            <br/>
            <input type="submit" name="searchOrgProjects" class="btn btn-primary" value="Search Projects">
            </form>
            
            <div id="searchOrgProjectResults" name="searchOrgProjectResults">
                
            </div>
        </div>

        <script src="scripts/vss_scripts.js"></script>
        
        <script>
            // default the org search panel to open
            $(function() {
                $('#orgSearchPanel').click();
            });
        </script>
        
        <!-- This is the footer -->
        <footer>
            <hr id="hr_footer">
                CST 499 Group Capstone. 2019&copy; Buckey, Gonzalez, Holmes, Loeser<br />
                <strong>Disclaimer:</strong> The information in this webpage is fictious.<br />
                It is used for academic purposes only.
                
                <figure id="csumb">
                    <img src="Images/csumb_logo.png" alt="CSUMB Logo">
                </figure>
            
        </footer>
        <!-- closing footer -->
    </body>
    
</html>