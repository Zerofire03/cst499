<?php

    include "dbConnection.php";
    $dbName = "cst499-vss";
    $createdBy = 'phpRootUser';
    
    /**
     * Get AuthenticateUser
     * @param string $username
     * @param string $password
     * @return int
     */
    function getAuthenticatedUser($username, $password)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
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
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            global $createdBy;
            
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
            $stmt->bindParam(':_CreatedBy', $createdBy, PDO::PARAM_STR);
     
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
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
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
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            //CALL sp_DeleteAuthUser(0)
            $sql = 'CALL sp_DeleteAuthUser(:_UserID)';

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
    
    /**
     * Delete AuthUser for an Org
     * @param int $userID
     * @param int $orgID
     * @return int
     */
    function deleteOrgAuthUser($userID, $orgID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_DeleteOrgAuthUser(:_UserID, :_OrgID)';
            
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_UserID', $userID, PDO::PARAM_INT);
            $stmt->bindValue(':_OrgID', $orgID, PDO::PARAM_INT);
     
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
     * Delete OrgProject record
     * @param int $orgID
     * @param int $orgProjectID
     * @return int
     */
    function deleteOrgProject($orgID, $orgProjectID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_DeleteOrgProject(:_OrgID, :_OrgProjectID)';
            
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_OrgID', $orgID, PDO::PARAM_INT);
            $stmt->bindValue(':_OrgProjectID', $orgProjectID, PDO::PARAM_INT);
     
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
     * Get GetAuthUserIDByUserName
     * @param userName
     */
    function getAuthUserID($userName)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetAuthUserByUserName(:_UserName)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_UserName', $userName, PDO::PARAM_INT);
     
            // execute the stored procedure
            $stmt->execute();
            $return_value = $stmt->fetch();
            $userID = $return_value['UserID'];
     
            $stmt->closeCursor();
            return $userID;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get GetAuthUserVolID
     * @param volID
     */
    function getAuthUserByVolID($volID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetAuthUserByVolID(:_ID)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_ID', $volID, PDO::PARAM_INT);
     
            // execute the stored procedure
            $stmt->execute();
            $return_value = $stmt->fetch();
     
            $stmt->closeCursor();
            return $return_value;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get GetAuthUserIDByUserName
     * @param userName
     */
    function getAuthUserRole($userName)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetAuthUserByUserName(:_UserName)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_UserName', $userName, PDO::PARAM_INT);
     
            // execute the stored procedure
            $stmt->execute();
            $return_value = $stmt->fetch();
            $role = $return_value['Role'];
     
            $stmt->closeCursor();
            return $role;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }

    /**
     * Get GetAuthUserByUserName
     * @param userName
     */
    function getAuthUserByUserName($userName)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetAuthUserByUserName(:_UserName)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_UserName', $userName, PDO::PARAM_INT);
     
            // execute the stored procedure
            $stmt->execute();
            $return_value = $stmt->fetch();
     
            $stmt->closeCursor();
            return $return_value;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get GetOrgAuthUsersByOrgID
     * @param orgID
     */
    function GetOrgAuthUsersByOrgID($orgID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_GetOrgAuthUsersByOrgID(:_OrgID)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);

            // pass value to the command
            $stmt->bindValue(':_OrgID', $orgID, PDO::PARAM_INT);
     
            // execute the stored procedure
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $records;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get searchOrgsByVarious
     * @param name
     * @param taxIdentifier
     * @param city
     * @param state
     * @param region
     * @param country
     * @param postalCode
     */
    function searchOrgsByVarious($name, $taxIdentifier, $city, $state,
        $region, $country, $postalCode)
    {
        /*
        // test output        
        echo("searchOrgs found - " .
                    "\nname = " . $name . 
                    "\ntaxidentifier = " . $taxIdentifier .
                    "\ncity = " . $city . 
                    "\nstate = " . $state .
                    "\nregion = " . $region .
                    "\ncountry = " . $country .
                    "\npostalcode = " . $postalCode);
        
        return;
        */
        
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_SearchOrgsByVarious(?, ?, ?, ?, ?, ?, ?)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $taxIdentifier, PDO::PARAM_STR);
            $stmt->bindParam(3, $city, PDO::PARAM_STR);
            $stmt->bindParam(4, $state, PDO::PARAM_STR);
            $stmt->bindParam(5, $region, PDO::PARAM_STR);
            $stmt->bindParam(6, $country, PDO::PARAM_STR);
            $stmt->bindParam(7, $postalCode, PDO::PARAM_STR);
            
            // execute the stored procedure
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $records;
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }

    /**
     * Get searchOrgProjectsByVarious
     * @param isPriority
     * @param startDateBegin
     * @param startDateEnd
     * @param city
     * @param state
     * @param region
     * @param country
     * @param postalCode
     */
    function searchOrgProjectsByVarious($isPriority, $startDateBegin, $startDateEnd,
        $city, $state, $region, $country, $postalCode)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_SearchOrgProjectsByVarious(?, ?, ?, ?, ?, ?, ?, ?)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);

            // pass value to the command
            $stmt->bindParam(1, $isPriority, PDO::PARAM_STR);
            $stmt->bindParam(2, $startDateBegin, PDO::PARAM_NULL);
            $stmt->bindParam(3, $startDateEnd, PDO::PARAM_NULL);
            $stmt->bindParam(4, $city, PDO::PARAM_STR);
            $stmt->bindParam(5, $state, PDO::PARAM_STR);
            $stmt->bindParam(6, $region, PDO::PARAM_STR);
            $stmt->bindParam(7, $country, PDO::PARAM_STR);
            $stmt->bindParam(8, $postalCode, PDO::PARAM_STR);
            
            // execute the stored procedure
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $records;
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get searchVolunteersByVarious
     * @param city
     * @param state
     * @param region
     * @param country
     * @param postalCode
     * @param skillID
     * @param skillExperienceLevel
     * @param isCurrent
     */
    function searchVolunteersByVarious($city, $state, $region, $country, $postalCode,
        $skillID, $skillExperienceLevel, $isCurrent)
    {
        // values for skillID, skillExperienceLevel, isCurrent must be together
        //      if experience or current is provided but not the skill, we must toss it out
        
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_SearchVolunteersByVarious(?, ?, ?, ?, ?, ?, ?, ?)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);

            // pass value to the command
            $stmt->bindParam(1, $city, PDO::PARAM_STR);
            $stmt->bindParam(2, $state, PDO::PARAM_STR);
            $stmt->bindParam(3, $region, PDO::PARAM_STR);
            $stmt->bindParam(4, $country, PDO::PARAM_STR);
            $stmt->bindParam(5, $postalCode, PDO::PARAM_STR);
            $stmt->bindParam(6, $skillID, PDO::PARAM_INT);
            $stmt->bindParam(7, $skillExperienceLevel, PDO::PARAM_INT);
            $stmt->bindParam(8, $isCurrent, PDO::PARAM_INT);
            
            // execute the stored procedure
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $records;
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get getSkills - retrieves the whole list of skill records
     */
    function getSkills()
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_GetSkills()';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);

            // execute the stored procedure
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $records;
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get GetOrgProfileByOrgID
     * @param $orgID
     */
    function GetOrgProfileByOrgID($orgID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetOrgProfileByOrgID(:_OrgID)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_OrgID', $orgID, PDO::PARAM_INT);
     
            // execute the stored procedure
            $stmt->execute();
            $return_value = $stmt->fetch();
     
            $stmt->closeCursor();
            return $return_value;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get GetOrgProjectsByOrgID
     * @param $orgID
     */
    function GetOrgProjectsByOrgID($orgID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetOrgProjectsByOrgID(:_OrgID)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_OrgID', $orgID, PDO::PARAM_INT);

            // execute the stored procedure
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $records;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get GetOrgProjectsByOrgProjectID
     * @param $orgProjectID
     */
    function GetOrgProjectsByOrgProjectID($orgProjectID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetOrgProjectsByOrgProjectID(:_OrgProjectID)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_OrgProjectID', $orgProjectID, PDO::PARAM_INT);

            // execute the stored procedure
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $records;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get GetOrgProjectSkillsByOrgProjectID
     * @param $orgProjectID
     */
    function GetOrgProjectSkillsByOrgProjectID($orgProjectID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetOrgProjectSkillsByOrgProjectID(:_OrgID, :_OrgProjectID)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            
            $stmt->bindValue(':_OrgID', null, PDO::PARAM_INT);
            $stmt->bindValue(':_OrgProjectID', $orgProjectID, PDO::PARAM_INT);
     
            // execute the stored procedure
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $records;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get GetOrgProjectSkillsByOrgID
     * @param $orgID
     * 
     * I can't think of where this might be needed but functionality was built
     *      in the stored proc so implementing...
     */
    function GetOrgProjectSkillsByOrgID($orgID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetOrgProjectSkillsByOrgProjectID(:_OrgID, :_OrgProjectID)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            
            $stmt->bindValue(':_OrgID', $orgID, PDO::PARAM_INT);
            $stmt->bindValue(':_OrgProjectID', null, PDO::PARAM_INT);
     
            // execute the stored procedure
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $records;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * InsertOrgProfile
     * @param orgName
     * @param description
     * @param mission
     * @param taxIdentifier
     * @param contactName
     * @param contactEmail
     * @param contactPhone
     * @param address1
     * @param address2
     * @param city
     * @param state
     * @param region
     * @param country
     * @param postalCode
     * @param emailAddress
     * @param phoneNumber
     * @param twitter
     * @param linkedIn
     * @return int - newly generated id
     */
    function InsertOrgProfile($orgName, $description, $mission, $taxIdentifier,
            $contactName, $contactEmail, $contactPhone, $address1, $address2,
            $city, $state, $region, $country, $postalCode, $emailAddress,
            $phoneNumber, $twitter, $linkedIn)
    {
        global $dbName, $createdBy;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_InsertOrgProfile(:_Name, :_Description, :_Mission, 
                        :_TaxIdentifier, :_ContactName, :_ContactEmail, 
                        :_ContactPhone, :_Address1, :_Address2, :_City,
                        :_State, :_Region, :_Country, :_PostalCode,
                        :_EmailAddress, :_PhoneNumber, :_Twitter, 
                        :_LinkedIn, :_CreatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindParam(':_Name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':_Description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':_Mission', $mission, PDO::PARAM_STR);
            $stmt->bindValue(':_TaxIdentifier', $taxIdentifier, PDO::PARAM_STR);
            $stmt->bindValue(':_ContactName', $contactName, PDO::PARAM_STR);
            $stmt->bindValue(':_ContactEmail', $contactEmail, PDO::PARAM_STR);
            $stmt->bindValue(':_ContactPhone', $contactPhone, PDO::PARAM_STR);
            $stmt->bindValue(':_Address1', $address1, PDO::PARAM_STR);
            $stmt->bindValue(':_Address2', $address2, PDO::PARAM_STR);
            $stmt->bindValue(':_City', $city, PDO::PARAM_STR);
            $stmt->bindValue(':_State', $state, PDO::PARAM_STR);
            $stmt->bindValue(':_Region', $region, PDO::PARAM_STR);
            $stmt->bindValue(':_Country', $country, PDO::PARAM_STR);
            $stmt->bindValue(':_PostalCode', $postalCode, PDO::PARAM_STR);
            $stmt->bindValue(':_EmailAddress', $emailAddress, PDO::PARAM_STR);
            $stmt->bindValue(':_PhoneNumber', $phoneNumber, PDO::PARAM_STR);
            $stmt->bindValue(':_Twitter', $twitter, PDO::PARAM_STR);
            $stmt->bindValue(':_LinkedIn', $linkedIn, PDO::PARAM_STR);
            $stmt->bindParam(':_CreatedBy', $createdBy, PDO::PARAM_STR);
     
            // execute the stored procedure - retrieve the resulting ID
            $stmt->execute();
            $return_value = $stmt->fetch();
     
            $stmt->closeCursor();
            return $return_value;
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    
    
    /**
     * InsertOrgProject
     * @param orgID
     * @param name
     * @param isActive
     * @param priority
     * @param description
     * @param startDate
     * @param timelineDescription
     * @param city
     * @param state
     * @param region
     * @param country
     * @param postalCode
     * @return int - newly generated id
     */
    function InsertOrgProject($orgID, $name, $isActive, $priority,
            $description, $startDate, $timelineDescription, $city, $state, 
            $region, $country, $postalCode)
    {
        global $dbName, $createdBy;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_InsertOrgProject(:_OrgID, :_Name, :_IsActive, :_Priority, 
                        :_Description, :_StartDate, :_TimelineDescription, :_City, 
                        :_State, :_Region, :_Country, :_PostalCode, :_CreatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindParam(':_OrgID', $orgID, PDO::PARAM_INT);
            $stmt->bindValue(':_Name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':_IsActive', $isActive, PDO::PARAM_INT);
            $stmt->bindValue(':_Priority', $priority, PDO::PARAM_STR);
            $stmt->bindValue(':_Description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':_StartDate', $startDate, PDO::PARAM_STR);
            $stmt->bindValue(':_TimelineDescription', $timelineDescription, PDO::PARAM_STR);
            $stmt->bindValue(':_City', $city, PDO::PARAM_STR);
            $stmt->bindValue(':_State', $state, PDO::PARAM_STR);
            $stmt->bindValue(':_Region', $region, PDO::PARAM_STR);
            $stmt->bindValue(':_Country', $country, PDO::PARAM_STR);
            $stmt->bindValue(':_PostalCode', $postalCode, PDO::PARAM_STR);
            $stmt->bindParam(':_CreatedBy', $createdBy, PDO::PARAM_STR);
     
            // execute the stored procedure - retrieve the resulting ID
            $stmt->execute();
            $return_value = $stmt->fetch();
     
            $stmt->closeCursor();
            return $return_value;
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
  

    /**
     * InsertOrgProjectSkill
     * @param orgProjectID
     * @param skillID
     * @param description
     * @param isRequired
     * @return int - newly generated id
     */
    function InsertOrgProjectSkill($orgProjectID, $skillID, $description, $isRequired)
    {
        global $dbName, $createdBy;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_InsertOrgProjectSkills(:_OrgProjectID, :_SkillID,
                        :_Description, :_IsRequired, :_CreatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindParam(':_OrgProjectID', $orgProjectID, PDO::PARAM_INT);
            $stmt->bindValue(':_SkillID', $skillID, PDO::PARAM_INT);
            $stmt->bindValue(':_Description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':_IsRequired', $isRequired, PDO::PARAM_INT);
            $stmt->bindParam(':_CreatedBy', $createdBy, PDO::PARAM_STR);
     
            // execute the stored procedure - retrieve the resulting ID
            $stmt->execute();
            $return_value = $stmt->fetch();
     
            $stmt->closeCursor();
            return $return_value;
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * InsertVolBio
     * @param volunteerID
     * @param description
     * @param workHistory
     * @param interests
     * @return int - newly generated id
     */
    function InsertVolBio($volunteerID, $description, $workHistory, $interests)
    {
        global $dbName, $createdBy;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_InsertVolBio(:_VolunteerID, :_Description,
                        :_WorkHistory, :_Interests, :_CreatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindParam(':_VolunteerID', $volunteerID, PDO::PARAM_INT);
            $stmt->bindValue(':_Description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':_WorkHistory', $workHistory, PDO::PARAM_STR);
            $stmt->bindValue(':_Interests', $interests, PDO::PARAM_STR);
            $stmt->bindParam(':_CreatedBy', $createdBy, PDO::PARAM_STR);
     
            // execute the stored procedure - retrieve the resulting ID
            $stmt->execute();
            $return_value = $stmt->fetch();
     
            $stmt->closeCursor();
            return $return_value;
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * InsertVolProfile
     * @param city
     * @param state
     * @param region
     * @param country
     * @param postalCode
     * @param url
     * @param emailAddress
     * @param phoneNumber
     * @param contactPreference
     * @return int - newly generated id
     */
    function InsertVolProfile($city, $state, $region, $country, $postalCode, 
            $url, $emailAddress, $phoneNumber, $contactPreference)
    {
        global $dbName, $createdBy;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_InsertVolProfile(:_City, :_State, :_Region, :_Country,
                        :_PostalCode, :_Url, :_EmailAddress, :_PhoneNumber,
                        :_ContactPref, :_CreatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindParam(':_City', $city, PDO::PARAM_STR);
            $stmt->bindParam(':_State', $state, PDO::PARAM_STR);
            $stmt->bindParam(':_Region', $region, PDO::PARAM_STR);
            $stmt->bindParam(':_Country', $country, PDO::PARAM_STR);
            $stmt->bindParam(':_PostalCode', $postalCode, PDO::PARAM_STR);
            $stmt->bindValue(':_Url', $url, PDO::PARAM_STR);
            $stmt->bindValue(':_EmailAddress', $emailAddress, PDO::PARAM_STR);
            $stmt->bindValue(':_PhoneNumber', $phoneNumber, PDO::PARAM_STR);
            $stmt->bindValue(':_ContactPref', $contactPreference, PDO::PARAM_STR);
            $stmt->bindParam(':_CreatedBy', $createdBy, PDO::PARAM_STR);
     
            // execute the stored procedure - retrieve the resulting ID
            $stmt->execute();
            $return_value = $stmt->fetch();
     
            $stmt->closeCursor();
            return $return_value;
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * InsertVolSkill
     * @param volunteerID
     * @param skillID
     * @param experienceLevel
     * @param isCurrent
     * @return int - newly generated id
     */
    function InsertVolSkill($volunteerID, $skillID, $experienceLevel, $isCurrent)
    {
        global $dbName, $createdBy;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_InsertVolSkill(:_VolunteerID, :_SkillID, 
                        :_ExperienceLevel, :_IsCurrent, :_CreatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindParam(':_VolunteerID', $volunteerID, PDO::PARAM_INT);
            $stmt->bindParam(':_SkillID', $skillID, PDO::PARAM_INT);
            $stmt->bindParam(':_ExperienceLevel', $experienceLevel, PDO::PARAM_INT);
            $stmt->bindParam(':_IsCurrent', $isCurrent, PDO::PARAM_INT);
            $stmt->bindParam(':_CreatedBy', $createdBy, PDO::PARAM_STR);
     
            // execute the stored procedure - retrieve the resulting ID
            $stmt->execute();
            $return_value = $stmt->fetch();
     
            $stmt->closeCursor();
            return $return_value;
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * UpdateAuthUser
     * @param userID
     * @param role
     * @param firstName
     * @param lastName
     * @param userName
     * @param password
     * @param lastLogin
     * @param lastPasswordReset
     **/
    function UpdateAuthUser ($userID, $role, $firstName, $lastName, $userName,
            $password, $lastLogin, $lastPasswordReset)
    {
        global $dbName, $createdBy;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_UpdateAuthUser(:_UserID, :_Role, :_FirstName, :_LastName,
                        :_UserName, :_Password, :_LastLogin, :_LastPasswordReset,
                        :_UpdatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_UserID', $userID, PDO::PARAM_INT);
            $stmt->bindValue(':_Role', $role, PDO::PARAM_STR);
            $stmt->bindValue(':_FirstName', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':_LastName', $lastName, PDO::PARAM_STR);
            $stmt->bindValue(':_UserName', $userName, PDO::PARAM_STR);
            $stmt->bindValue(':_Password', $password, PDO::PARAM_STR);
            $stmt->bindValue(':_LastLogin', $lastLogin, PDO::PARAM_STR);
            $stmt->bindValue(':_LastPasswordReset', $lastPasswordReset, PDO::PARAM_STR);
            $stmt->bindValue(':_UpdatedBy', $createdBy, PDO::PARAM_STR);
     
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
     * UpdateOrgProfile
     * @param orgID
     * @param name
     * @param description
     * @param mission
     * @param taxIdentifier
     * @param contactName
     * @param contactEmail
     * @param contactPhone
     * @param address1
     * @param address2
     * @param city
     * @param state
     * @param region
     * @param country
     * @param postalCode
     * @param emailAddress
     * @param phoneNumber
     * @param twitter
     * @param linkedIn
     **/
    function UpdateOrgProfile ($orgID, $name, $description, $mission, $taxIdentifier,
            $contactName, $contactEmail, $contactPhone, $address1, $address2,
            $city, $state, $region, $country, $postalCode, $emailAddress,
            $phoneNumber, $twitter, $linkedIn)
    {
        global $dbName, $createdBy;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_UpdateOrgProfile(:_OrgID, :_Name, :_Description, :_Mission,
                        :_TaxIdentifier, :_ContactName, :_ContactEmail, :_ContactPhone,
                        :_Address1, :_Address2, :_City, :_State, :_Region, :_Country,
                        :_PostalCode, :_EmailAddress, :_PhoneNumber, :_Twitter,
                        :_LinkedIn, :_UpdatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_OrgID', $orgID, PDO::PARAM_INT);
            $stmt->bindValue(':_Name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':_Description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':_Mission', $mission, PDO::PARAM_STR);
            $stmt->bindValue(':_TaxIdentifier', $taxIdentifier, PDO::PARAM_STR);
            $stmt->bindValue(':_ContactName', $contactName, PDO::PARAM_STR);
            $stmt->bindValue(':_ContactEmail', $contactEmail, PDO::PARAM_STR);
            $stmt->bindValue(':_ContactPhone', $contactPhone, PDO::PARAM_STR);
            $stmt->bindValue(':_Address1', $address1, PDO::PARAM_STR);
            $stmt->bindValue(':_Address2', $address2, PDO::PARAM_STR);
            $stmt->bindValue(':_City', $city, PDO::PARAM_STR);
            $stmt->bindValue(':_State', $state, PDO::PARAM_STR);
            $stmt->bindValue(':_Region', $region, PDO::PARAM_STR);
            $stmt->bindValue(':_Country', $country, PDO::PARAM_STR);
            $stmt->bindValue(':_PostalCode', $postalCode, PDO::PARAM_STR);
            $stmt->bindValue(':_EmailAddress', $emailAddress, PDO::PARAM_STR);
            $stmt->bindValue(':_PhoneNumber', $phoneNumber, PDO::PARAM_STR);
            $stmt->bindValue(':_Twitter', $twitter, PDO::PARAM_STR);
            $stmt->bindValue(':_LinkedIn', $linkedIn, PDO::PARAM_STR);
            $stmt->bindValue(':_UpdatedBy', $createdBy, PDO::PARAM_STR);
     
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
     * UpdateOrgProject
     * @param orgProjectID
     * @param orgID
     * @param name
     * @param isActive
     * @param priority
     * @param description
     * @param startDate
     * @param timelineDescription
     * @param city
     * @param state
     * @param region
     * @param country
     * @param postalCode
     **/
    function UpdateOrgProject ($orgProjectID, $orgID, $name, $isActive, $priority,
                $description, $startDate, $timelineDescription, $city, $state,
                $region, $country, $postalCode)
    {
        global $dbName, $createdBy;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_UpdateOrgProject(:_OrgProjectID, :_OrgID, :_Name, :_IsActive,
                        :_Priority, :_Description, :_StartDate, :_TimelineDescription,
                        :_City, :_State, :_Region, :_Country, :_PostalCode, :_UpdatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_OrgProjectID', $orgProjectID, PDO::PARAM_INT);
            $stmt->bindValue(':_OrgID', $orgID, PDO::PARAM_INT);
            $stmt->bindValue(':_Name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':_IsActive', $isActive, PDO::PARAM_INT);
            $stmt->bindValue(':_Priority', $priority, PDO::PARAM_STR);
            $stmt->bindValue(':_Description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':_StartDate', $startDate, PDO::PARAM_STR);
            $stmt->bindValue(':_TimelineDescription', $timelineDescription, PDO::PARAM_STR);
            $stmt->bindValue(':_City', $city, PDO::PARAM_STR);
            $stmt->bindValue(':_State', $state, PDO::PARAM_STR);
            $stmt->bindValue(':_Region', $region, PDO::PARAM_STR);
            $stmt->bindValue(':_Country', $country, PDO::PARAM_STR);
            $stmt->bindValue(':_PostalCode', $postalCode, PDO::PARAM_STR);
            $stmt->bindValue(':_UpdatedBy', $createdBy, PDO::PARAM_STR);
     
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
     * UpdateVolBio
     * @param volunteerID
     * @param description
     * @param workHistory
     * @param interests
     **/
    function UpdateVolBio ($volunteerID, $description, $workHistory, $interests)
    {
        global $dbName, $createdBy;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_UpdateVolBio(:_VolunteerID, :_Description, :_WorkHistory,
                        :_Interests, :_UpdatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_VolunteerID', $volunteerID, PDO::PARAM_INT);
            $stmt->bindValue(':_Description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':_WorkHistory', $workHistory, PDO::PARAM_STR);
            $stmt->bindValue(':_Interests', $interests, PDO::PARAM_STR);
            $stmt->bindValue(':_UpdatedBy', $createdBy, PDO::PARAM_STR);
     
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
     * UpdateVolProfile
     * @param volunteerID
     * @param city
     * @param state
     * @param region
     * @param country
     * @param postalCode
     * @param url
     * @param emailAddress
     * @param phoneNumber
     * @param contactPref
     **/
    function UpdateVolProfile ($volunteerID, $city, $state, $region, $country, 
            $postalCode, $url, $emailAddress, $phoneNumber, $contactPref)
    {
        global $dbName, $createdBy;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
            // calling stored procedure command
            $sql = 'CALL sp_UpdateVolProfile(:_VolunteerID, :_City, :_State,
                        :_Region, :_Country, :_PostalCode, :_Url,
                        :_EmailAddress, :_PhoneNumber, :_ContactPref, :_UpdatedBy)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_VolunteerID', $volunteerID, PDO::PARAM_INT);
            $stmt->bindValue(':_City', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':_State', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':_Region', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':_Country', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':_PostalCode', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':_Url', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':_EmailAddress', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':_PhoneNumber', $workHistory, PDO::PARAM_STR);
            $stmt->bindValue(':_ContactPref', $interests, PDO::PARAM_STR);
            $stmt->bindValue(':_UpdatedBy', $createdBy, PDO::PARAM_STR);

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
    
    // Get methods for Volunteers
    /**
     * Get GetVolBioByVolunteerID
     * @param $volunteerID
     */
    function GetVolBioByVolunteerID($volunteerID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetVolBioByVolunteerID(:_VolunteerID)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_VolunteerID', $volunteerID, PDO::PARAM_INT);
     
            // execute the stored procedure
            $stmt->execute();
            $return_value = $stmt->fetch();
     
            $stmt->closeCursor();
            return $return_value;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get GetVolSkillsByVolunteerID
     * @param $volunteerID
     */
    function GetVolSkillsByVolunteerID($volunteerID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetVolSkillsByVolunteerID(:_VolunteerID)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_VolunteerID', $volunteerID, PDO::PARAM_INT);
     
            // execute the stored procedure
            $stmt->execute();
            $return_value = $stmt->fetchAll();
     
            $stmt->closeCursor();
            return $return_value;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    /**
     * Get GetVolProfileByVolunteerID
     * @param $volunteerID
     */
    function GetVolProfileByVolunteerID($volunteerID)
    {
        global $dbName;
        $conn = getDatabaseConnection($dbName);
        
        try
        {
     
            // calling stored procedure command
            $sql = 'CALL sp_GetVolProfileByVolunteerID(:_VolunteerID)';
     
            // prepare for execution of the stored procedure
            $stmt = $conn->prepare($sql);
     
            // pass value to the command
            $stmt->bindValue(':_VolunteerID', $volunteerID, PDO::PARAM_INT);

            // execute the stored procedure
            $stmt->execute();
            $return_value = $stmt->fetch();
     
            $stmt->closeCursor();
            return $return_value;
            
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
?>