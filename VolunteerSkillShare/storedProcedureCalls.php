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
        }
        catch (PDOException $e)
        {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    }
    
    
?>