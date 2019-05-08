<?php

    include "dbConnection.php";
    
    
    
    /**
     * Get AuthenticateUser
     * @param string $username
     * @param string $password
     * @return int
     */
     
    function getAuthenticatedUser($username, $password)
    {
        $conn = getDatabaseConnection("cst499-vss");
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_AuthenticateUser(:_UserName, :_Password, @AuthSuccess)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindParam(':_UserName', $username, PDO::PARAM_STR);
            $stmt->bindParam(':_Password', $password, PDO::PARAM_STR);
     
            // execute the stored procedure
            $stmt->execute();
            
            $stmt->closeCursor();
     
            // execute the second query to get customer's level
            $row = $conn->query("SELECT @AuthSuccess AS AuthSuccess")->fetch(PDO::FETCH_ASSOC);
            if ($row)
            {
                return $row !== false ? $row['AuthSuccess'] : null;
            }
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Set insertAuthUser
     * @param string $username
     * @param string $password
     * @return int
     * 
     * Role, VolunteerID, 
		OrgID, UserName, 
        Password, LastLogin, 
        LastPasswordReset, CreatedDate, 
        CreatedBy, UpdatedDate, UpdatedBy
     */
     
     
    function setInsertAuthUser($role, $fName, $lName, $username, $password)
    {
        $conn = getDatabaseConnection("cst499-vss");
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_InsertAuthUser(:_Role, :_VolunteerID, :_OrgID, :_FirstName, :_LastName, :_UserName, :_Password, :_LastLogin, :_LastPasswordReset, :_CreatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindParam(':_Role', $role, PDO::PARAM_STR);
            $stmt->bindValue(':_VolunteerID', null, PDO::PARAM_INT);
            $stmt->bindValue(':_OrgID', null, PDO::PARAM_INT);
            $stmt->bindParam(':_FirstName', $fName, PDO::PARAM_STR);
            $stmt->bindParam(':_LastName', $lName, PDO::PARAM_STR);
            $stmt->bindParam(':_UserName', $username, PDO::PARAM_STR);
            $stmt->bindParam(':_Password', $password, PDO::PARAM_STR);
            $stmt->bindValue(':_LastLogin', null, PDO::PARAM_INT);
            $stmt->bindValue(':_LastPasswordReset', null, PDO::PARAM_INT);
            $stmt->bindParam(':_CreatedBy', $username, PDO::PARAM_STR);
     
            // execute the stored procedure
            $stmt->execute();
     
            $stmt->closeCursor();
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get UserID
     * @param string $username
     * @return int
     */
     
    function getUserID($username)
    {
        $conn = getDatabaseConnection("cst499-vss");
        
        try
        {
     
            // calling stored procedure command
            //CALL sp_GetUserIDByUserName('foo1@gmail.com')
            $sql = 'CALL sp_GetUserIDByUserName(:_UserName)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindParam(':_UserName', $username, PDO::PARAM_STR);
     
            // execute the stored procedure
            $stmt->execute();
            
            $stmt->closeCursor();
            
            $userID = $stmt->fetch(PDO::FETCH_ASSOC);
            return $userID;
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Delete AuthUser
     * @param int $userID
     * @return int
     */
     
    function deleteAuthUser($userID)
    {
        $conn = getDatabaseConnection("cst499-vss");
        
        try
        {
     
            // calling stored procedure command
            //CALL sp_DeleteAuthUser(0)
            $sql = 'CALL sp_GetUserIDByUserName(:_UserID, @UserIDOut)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_UserID', $userID, PDO::PARAM_INT);
     
            // execute the stored procedure
            $stmt->execute();
     
            $stmt->closeCursor();
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    function getauthuser ($userid, $role, $volunteerid, $username){
        $conn = getDatabaseConnection("cst499-vss");
        
        $sql = "SELECT * FROM authusers WHERE 1=1";
        
        if (!empty($userid)){
            $sql .= " AND UserID = :userid";
        }
        if (!empty($role)){
            $sql .= " AND Role = :role";
        }
        if (!empty($volunteerid)){
            $sql .= " AND VolunteerID = :volunteerid";
        }
        if (!empty($username)){
            $sql .= " AND UserName = :username";
        }
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam('UserID', $userid);
        $stmt->bindParam('Role', $role);
        $stmt->bindParam('VolunteerID', $volunteerid);
        $stmt->bindParam('username', $username);
    }

    function getorgprofile($orgid, $description, $mission, $taxid, $name, $email, $phone, $address, $city, $state, $region, $country, $postalcode, $twitter, $linkedin){
        $conn = getDatabaseConnection("cst499-vss");
        
        $sql = "SELECT * FROM orgprofile WHERE 1=1";
    
        if (!empty($description)){
            $sql .= " AND Description = :description";
        }
                if (!empty($mission)){
            $sql .= " AND Mission = :mission";
        }
                if (!empty($taxid)){
            $sql .= " AND TaxIdentifier = :taxid";
        }
                if (!empty($name)){
            $sql .= " AND ContactName = :name";
        }
                if (!empty($email)){
            $sql .= " AND ContactEmail = :email";
        }
                if (!empty($phone)){
            $sql .= " AND ContactPhone = :phone";
        }
                if (!empty($address)){
            $sql .= " AND Address1 = :address";
        }
                if (!empty($city)){
            $sql .= " AND City = :city";
        }
                if (!empty($state)){
            $sql .= " AND State = :state";
        }
                if (!empty($region)){
            $sql .= " AND Region = :region";
        }
                if (!empty($country)){
            $sql .= " AND Country = :country";
        }
                if (!empty($postalcode)){
            $sql .= " AND PostalCode = :postalcode";
        }
                if (!empty($twitter)){
            $sql .= " AND Twitter = :twitter";
        }
                if (!empty($linkedin)){
            $sql .= " AND LinkedIn = :linkedin";
        }

        $stmt = $conn->prepare($sql);
            
        $stmt->bindParam('OrgID', $orgid);
        $stmt->bindParam('Description', $description);
        $stmt->bindParam('Mission', $mission);
        $stmt->bindParam('TaxIdentifier', $taxid);
        $stmt->bindParam('ContactName', $name);
        $stmt->bindParam('ContactEmail', $email);
        $stmt->bindParam('ContactPhone', $phone);
        $stmt->bindParam('Address1', $address);
        $stmt->bindParam('City', $city);
        $stmt->bindParam('State', $state);
        $stmt->bindParam('Region', $region);
        $stmt->bindParam('Country', $country);
        $stmt->bindParam('PostalCode', $postalcode);
        $stmt->bindParam('Twitter', $twitter);
        $stmt->bindParam('Linkedin', $linkedin);
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    
    function getorgproject($orgprojectid, $orgID, $isActive, $priority, $descripton, $startdate, $timelinedescription, $city, $state, $region, $country, $postalcode){
        $conn = getDatabaseConnection("cst499-vss");
        
        $sql = "SELECT * FROM orgprofile WHERE 1=1";
    
        if (!empty($orgprojectid)){
            $sql .= " AND OrgProjectID = :prgprojectid";
        }
        if (!empty($orgID)){
            $sql .= " AND OrgID = :orgID";
        }
        if (!empty($isActive)){
            $sql .= " AND isActive = :isActive";
        }
        if (!empty($priority)){
            $sql .= " AND Priority = :priority";
        }
        if (!empty($description)){
            $sql .= " AND Description = :description";
        }
        if (!empty($startdate)){
            $sql .= " AND StartDate = :phone";
        }
        if (!empty($timelinedescription)){
            $sql .= " AND TimelineDescription = :timelinedescripition";
        }
        if (!empty($city)){
            $sql .= " AND City = :city";
        }
        if (!empty($state)){
            $sql .= " AND State = :state";
        }
        if (!empty($region)){
            $sql .= " AND Region = :region";
        }
        if (!empty($country)){
            $sql .= " AND Country = :country";
        }
        if (!empty($postalcode)){
            $sql .= " AND PostalCode = :postalcode";
        }

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam('OrgProjectID', $orgprojectid);    
        $stmt->bindParam('OrgID', $orgid);
        $stmt->bindParam('isActive', $isActice);
        $stmt->bindParam('Priority', $priority);
        $stmt->bindParam('Description', $description);
        $stmt->bindParam('StartDate', $startdate);
        $stmt->bindParam('TimlelineDescription', $timelinedescription);
        $stmt->bindParam('City', $city);
        $stmt->bindParam('State', $state);
        $stmt->bindParam('Region', $region);
        $stmt->bindParam('Country', $country);
        $stmt->bindParam('PostalCode', $postalcode);

        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    
    
    function getskills($skillid, $description, $experiencemin, $experiencemax){
        if (!empty($skillid)){
            $sql .= " AND SkillID = :skillid";
        }
        if (!empty($description)){
            $sql .= " AND Description = :description";
        }
        if (!empty($experiencemin)){
            $sql .= " AND ExperienceMin = :experiencemin";
        }
        if (!empty($experiencemax)){
            $sql .= " AND ExperienceMax = :experiencemax";
        }
        
        $stmt->bindParam('SkillID', $skillid);
        $stmt->bindParam('Description', $description);
        $stmt->bindParam('ExperienceMin', $experiencemin);
        $stmt->bindParam('ExperienceMax', $experiencemax);
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    
    function volbio($volID, $descripiton, $workhistory, $interest){
        if (!empty($volID)){
            $sql .= " AND VolunteerID = :volID";
        }
        if (!empty($description)){
            $sql .= " AND Description = :description";
        }
        if (!empty($workhistory)){
            $sql .= " AND WorkHistory = :workhistory";
        }
        if (!empty($interest)){
            $sql .= " AND Interest = :interest";
        }
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam('VolunteerID', $volID);
        $stmt->bindParam('Description', $description);
        $stmt->bindParam('WorkHistory', $workhistory);
        $stmt->bindParam('Interest', $interest);

        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    
    function volprofile($volID, $firstname, $lastname, $city, $state, $region, $country, $postalcode, $url, $emailaddress, $phonenumber, $contactpref){
        if (!empty($volID)){
            $sql .= " AND VolunteerID = :volID";
        }
        if (!empty($firstname)){
            $sql .= " AND FirstName = :firstname";
        }
        if (!empty($lastname)){
            $sql .= " AND LastName = :lastname";
        }
        if (!empty($city)){
            $sql .= " AND City = :city";
        }
        if (!empty($state)){
            $sql .= " AND State = :state";
        }
        if (!empty($region)){
            $sql .= " AND Region = :region";
        }
        if (!empty($country)){
            $sql .= " AND Country = :country";
        }
        if (!empty($postalcode)){
            $sql .= " AND PostalCodeX = :postalcode";
        }
        if (!empty($url)){
            $sql .= " AND Url = :url";
        }
        if (!empty($emailaddress)){
            $sql .= " AND EmailAddress = :emailaddress";
        }
        if (!empty($phonenumber)){
            $sql .= " AND PhoneNumber = :phonenumber";
        }
        if (!empty($contactpref)){
            $sql .= " AND ContactPref = :contactpref";
        }
        
        
        $stmt->bindParam('VolunteerID', $volUD);
        $stmt->bindParam('FirstName', $firstname);
        $stmt->bindParam('LastName', $lastname);
        $stmt->bindParam('City', $city);
        $stmt->bindParam('State', $state);
        $stmt->bindParam('Region', $region);
        $stmt->bindParam('Country', $country);
        $stmt->bindParam('PostalCode', $postalcode);
        $stmt->bindParam('Url', $url);
        $stmt->bindParam('EmailAdress', $emailaddress);
        $stmt->bindParam('phonenumber', $phonenunmber);
        $stmt->bindParam('ContactPref', $contactpref);
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    
    function volskills($volID, $skillId, $experiencelevel, $iscurrent){
        if (!empty($volID)){
            $sql .= " AND VolunteerID = :volID";
        }
        if (!empty($skillId)){
            $sql .= " AND SkillID = :skillId";
        }
        if (!empty($experiencelevel)){
            $sql .= " AND ExperienceLevel = :experiencelevel";
        }
        if (!empty($iscurrent)){
            $sql .= " AND IsCurrent = :iscurrent";
        }
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam('VolunteerID', $volUD);
        $stmt->bindParam('SkillID', $skillId);
        $stmt->bindParam('ExperienceLevel', $experiencelevel);
        $stmt->bindParam('IsCurrent', $iscurrent);
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

?>