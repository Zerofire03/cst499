<?php

    include "dbConnection.php";
    $dbName = "cst499-vss";
    
    
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
    
    /**
     * Get GetAuthUserIDByUserName
     * @param username
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
     * Get GetAuthUserIDByUserName
     * @param username
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
            $stmt->bindParam(8, $isCurrent, PDO::PARAM_BOOL);
            
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
    
    // sp_GetSkills
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
    
?>