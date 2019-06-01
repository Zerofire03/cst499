<?php 

include '_header.php';
include 'storedProcedureCalls.php';
    
    /*
    this page is used to create or edit org profiles - it uses the orgid param value
       to determine if this is an add (part of the enrollment) or edit
    */
    
    $orgid = null;
    $orgdata = null;
    
    // get the orgid - can be passed as param (get or post), pulled from session, or null (new enrollment)
    if (isset($_REQUEST['orgid']))
    {
        $orgid = $_REQUEST['orgid'];
    }
    else
    {
        // pull from the session table
        $orgid = $_SESSION['orgid'];
    }
    
    // test test
    //echo ("POST = " . isset($_POST['submit']) . "<br/>");
    
    // test for form submit - update the record before doing the data pull
    if (isset($_POST['submit']))
    {
        // testing
        //echo ("in the form processing<br/>");
        
        // retrieve the values
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $mission = trim($_POST['mission']);
        $taxid = trim($_POST['taxid']);
        $contactname = trim($_POST['contactname']);
        $contactemail = (isset($_POST['contactemail']) ? strtolower(trim($_POST['contactemail'])) : null) ;
        $contactphone = $_POST['contactphone'];
        $address1 = trim($_POST['address1']);
        $address2 = trim($_POST['address2']);
        $city = trim($_POST['city']);
        $state = trim($_POST['state']);
        $region = trim($_POST['region']);
        $country = trim($_POST['country']);
        $postalcode = trim($_POST['postalcode']);
        $email = (isset($_POST['email']) ? strtolower(trim($_POST['email'])) : null) ;
        $phone = $_POST['phone'];
        $twitter = trim($_POST['twitter']);
        $linkedin = trim($_POST['linkedin']);
        
        // additional data validations -- ??

        
        // check for new vs update
        if (isset($orgid) && $orgid != null)
        {
            // update
            try
            {
                //echo("testing the update - orgid = ". $orgid . " <br/>");
                
                UpdateOrgProfile($orgid, $name, $description, $mission, $taxid,
                        $contactname, $contactemail, $contactphone, $address1,
                        $address2, $city, $state, $region, $country, $postalcode,
                        $email, $phone, $twitter, $linkedin);
                
                echo("<br/><span class='success'><h4>Org updated successfully</h4></span><br/>");
            }
            catch (Exception $e)
            {
                echo ('Caught exception: ' . $e->getMessage() . '<br/><br/>');
            }
        }
        else
        {
            // new
            try
            {
                $orgid = InsertOrgProfile($name, $description, $mission, $taxid,
                        $contactname, $contactemail, $contactphone, $address1,
                        $address2, $city, $state, $region, $country, $postalcode,
                        $email, $phone, $twitter, $linkedin);
                
                if (isset($orgid) && $orgid <= 0)
                {
                    echo("<br/><span class='error'><h4>Org failed to insert</h4></span><br/>");
                }
                else
                {
                    $_SESSION['orgid'] = $orgid;
                    echo("<br/><span class='success'><h4>Org inserted successfully</h4></span><br/>");
                }
            }
            catch (Exception $e)
            {
                echo ('Caught exception: ' . $e->getMessage() . '<br/><br/>');
            }
        }
    }
    
    // pull the data for the display - will grab new updates
    $orgdata = GetOrgProfileByOrgID($orgid);
?>

<!-- code -->
<br/>
<form method="post" action="" id="profileedit">
<table class="resultsTbl">
    <tr>
        <th class="resultsTh" colspan="2"><h3>Profile</h3></th>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="name">Name:</label></th>
        <td class="resultsTdLeft">
            <input type="text" name="name" id="name" size="50"
                value="<?php if(isset($orgdata)){ echo($orgdata['Name']); } ?>" maxlength="100" required/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="description">Description:</label></th>
        <td class="resultsTdLeft">
            <textarea name="description" id="description" rows="10" cols="70" required><?php if(isset($orgdata)){ echo($orgdata['Description']); } ?></textarea>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="mission">Mission:</label></th>
        <td class="resultsTdLeft">
            <textarea name="mission" id="mission" rows="10" cols="70"><?php if(isset($orgdata)){ echo($orgdata['Mission']); } ?></textarea>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="taxid">Tax ID:</label></th>
        <td class="resultsTdLeft">
            <input type="text" name="taxid" id="taxid" size="50"
                value="<?php if(isset($orgdata)){ echo($orgdata['TaxIdentifier']); } ?>" maxlength="50" required/>
        </td>
    </tr>
    <tr>
        <!-- spacer -->
        <th class="resultsTh" colspan="2">&nbsp;</th>
    </tr>
    <tr>
        <th class="resultsTh" colspan="2"><h3>Contact Info</h3></th>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="contactname">Contact Name:</label></th>
        <td class="resultsTdLeft">
            <input type="text" name="contactname" id="contactname" size="50"
                value="<?php if(isset($orgdata)){ echo($orgdata['ContactName']); } ?>" maxlength="200" required/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="contactemail">Contact Email:</label></th>
        <td class="resultsTdLeft">
            <input type="email" name="contactemail" id="contactemail" size="50"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                title="please enter valid email [test@test.com]"
                value="<?php if(isset($orgdata)){ echo($orgdata['ContactEmail']); } ?>" 
                maxlength="200"/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="contactphone">Contact Phone:</label></th>
        <td class="resultsTdLeft">
            <input type="tel" name="contactphone" id="contactphone" size="20"
                value="<?php if(isset($orgdata)){ echo($orgdata['ContactPhone']); } ?>" 
                pattern="\d{3}[\-]\d{3}[\-]\d{4}"
                maxlength="20" 
                title="###-###-####"/>
        </td>
    </tr>
    <tr>
        <!-- spacer -->
        <th class="resultsTh" colspan="2">&nbsp;</th>
    </tr>
    <tr>
        <th class="resultsTh" colspan="2"><h3>General Info</h3></th>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="address1">Address 1:</label></th>
        <td class="resultsTdLeft">
            <input type="text" name="address1" id="address1" size="50"
                value="<?php if(isset($orgdata)){ echo($orgdata['Address1']); } ?>" 
                maxlength="200"/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="address2">Address 2:</label></th>
        <td class="resultsTdLeft">
            <input type="text" name="address2" id="address2" size="50"
                value="<?php if(isset($orgdata)){ echo($orgdata['Address2']); } ?>" 
                maxlength="200"/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="city">City:</label></th>
        <td class="resultsTdLeft">
            <input type="text" name="city" id="city" size="50"
                value="<?php if(isset($orgdata)){ echo($orgdata['City']); } ?>" 
                maxlength="100"/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="state">State:</label></th>
        <td class="resultsTdLeft">
            <input type="text" name="state" id="state" size="50"
                value="<?php if(isset($orgdata)){ echo($orgdata['State']); } ?>" 
                maxlength="100"/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="region">Region / Neighborhood:</label></th>
        <td class="resultsTdLeft">
            <input type="text" name="region" id="region" size="50"
                value="<?php if(isset($orgdata)){ echo($orgdata['Region']); } ?>" 
                maxlength="100"/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="country">Country:</label></th>
        <td class="resultsTdLeft">
            <input type="text" name="country" id="country" size="50"
                value="<?php if(isset($orgdata)){ echo($orgdata['Country']); } ?>" 
                maxlength="100"/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="postalcode">Postal Code:</label></th>
        <td class="resultsTdLeft">
            <input type="text" name="postalcode" id="postalcode" size="20"
                value="<?php if(isset($orgdata)){ echo($orgdata['PostalCode']); } ?>" 
                pattern="(\d{5}([\-]\d{4})?)"
                title="#####-####"
                maxlength="20"/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="email">Email Address:</label></th>
        <td class="resultsTdLeft">
            <input type="email" name="email" id="email" size="50"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                title="please enter valid email [test@test.com]"
                value="<?php if(isset($orgdata)){ echo($orgdata['EmailAddress']); } ?>" 
                maxlength="200"/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="phone">Phone Number:</label></th>
        <td class="resultsTdLeft">
            <input type="tel" name="phone" id="phone" size="20"
                value="<?php if(isset($orgdata)){ echo($orgdata['PhoneNumber']); } ?>" 
                pattern="\d{3}[\-]\d{3}[\-]\d{4}"
                maxlength="20" 
                title="###-###-####"/>
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="twitter">Twitter:</label></th>
        <td class="resultsTdLeft">
            <input type="text" name="twitter" id="twitter" size="50"
                value="<?php if(isset($orgdata)){ echo($orgdata['Twitter']); } ?>" 
                maxlength="200" />
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label for="linkedin">LinkedIn:</label></th>
        <td class="resultsTdLeft">
            <input type="url" name="linkedin" id="linkedin" size="50"
                value="<?php if(isset($orgdata)){ echo($orgdata['LinkedIn']); } ?>" 
                maxlength="200" />
        </td>
    </tr>
    <tr>
        <th class="resultsThRight"><label>Updated Date:</label></th>
        <td class="resultsTdLeft"><?php echo(date('m-d-Y',strtotime($orgdata['UpdatedDate']))); ?></td>
    </tr>
</table>
<input type="hidden" name="orgid" value="<?php echo($orgid); ?>"/>
<br/>
<button class="btn btn-link" id="submit" name="submit" type="submit">Submit</button>

</form>


<!-- This is the footer -->
<?php include '_footer.php';