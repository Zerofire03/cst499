-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2019 at 04:27 PM
-- Server version: 5.7.20
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cst499-vss`
--
DROP DATABASE IF EXISTS `cst499-vss`;
CREATE DATABASE IF NOT EXISTS `cst499-vss` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cst499-vss`;

-- --------------------------------------------------------

--
-- Table structure for table `authusers`
--

DROP TABLE IF EXISTS `authusers`;
CREATE TABLE `authusers` (
  `UserID` int(11) NOT NULL,
  `Role` varchar(2) NOT NULL DEFAULT 'V' COMMENT 'V - volunteer, O - organization, A - admin',
  `VolunteerID` int(11) DEFAULT NULL,
  `OrgID` int(11) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `LastLogin` timestamp NULL DEFAULT NULL,
  `LastPasswordReset` timestamp NULL DEFAULT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- Table structure for table `orgprofile`
--

DROP TABLE IF EXISTS `orgprofile`;
CREATE TABLE `orgprofile` (
  `OrgID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Mission` text,
  `TaxIdentifier` VARCHAR(50) NULL,
  `ContactName` varchar(200) NOT NULL,
  `ContactEmail` varchar(200) DEFAULT NULL,
  `ContactPhone` varchar(20) DEFAULT NULL,
  `Address1` varchar(200) DEFAULT NULL,
  `Address2` varchar(200) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `State` varchar(100) DEFAULT NULL,
  `Region` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `PostalCode` varchar(20) DEFAULT NULL,
  `EmailAddress` varchar(200) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Twitter` varchar(200) DEFAULT NULL,
  `LinkedIn` varchar(200) DEFAULT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orgproject`
--

DROP TABLE IF EXISTS `orgproject`;
CREATE TABLE `orgproject` (
  `OrgProjectID` int(11) NOT NULL,
  `OrgID` int(11) NOT NULL,
  `IsActive` tinyint(4) NOT NULL DEFAULT '1',
  `Priority` varchar(2) NOT NULL DEFAULT 'H',
  `Description` text NOT NULL,
  `StartDate` datetime DEFAULT NULL,
  `TimelineDescription` text,
  `City` varchar(100) DEFAULT NULL,
  `State` varchar(100) DEFAULT NULL,
  `Region` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `PostalCode` varchar(20) DEFAULT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orgprojectskills`
--

DROP TABLE IF EXISTS `orgprojectskills`;
CREATE TABLE `orgprojectskills` (
  `OrgProjectID` int(11) NOT NULL,
  `SkillID` int(11) NOT NULL,
  `Description` text,
  `IsRequired` tinyint(4) NOT NULL DEFAULT '0',
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `SkillID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Description` text,
  `ExperienceMin` int(11) DEFAULT NULL,
  `ExperienceMax` int(11) DEFAULT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `volbio`
--

DROP TABLE IF EXISTS `volbio`;
CREATE TABLE `volbio` (
  `VolunteerID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `WorkHistory` text,
  `Interests` text,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `volprofile`
--

DROP TABLE IF EXISTS `volprofile`;
CREATE TABLE `volprofile` (
  `VolunteerID` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `State` varchar(100) DEFAULT NULL,
  `Region` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `PostalCode` varchar(20) DEFAULT NULL,
  `Url` varchar(200) DEFAULT NULL,
  `EmailAddress` varchar(200) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `ContactPref` varchar(5) NOT NULL DEFAULT 'E' COMMENT 'E - Email\nP - Phone',
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `volskills`
--

DROP TABLE IF EXISTS `volskills`;
CREATE TABLE `volskills` (
  `VolunteerID` int(11) NOT NULL,
  `SkillID` int(11) NOT NULL,
  `ExperienceLevel` int(11) DEFAULT NULL,
  `IsCurrent` tinyint(4) DEFAULT '0',
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orgprofile`
--
ALTER TABLE `orgprofile`
  ADD PRIMARY KEY (`OrgID`);

--
-- Indexes for table `orgproject`
--
ALTER TABLE `orgproject`
  ADD PRIMARY KEY (`OrgProjectID`),
  ADD KEY `OrgProject_OrgProfile_idx` (`OrgID`);

--
-- Indexes for table `orgprojectskills`
--
ALTER TABLE `orgprojectskills`
  ADD PRIMARY KEY (`OrgProjectID`,`SkillID`),
  ADD KEY `OrgProjectSkills_Skills_idx` (`SkillID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`SkillID`);

--
-- Indexes for table `volbio`
--
ALTER TABLE `volbio`
  ADD PRIMARY KEY (`VolunteerID`),
  ADD UNIQUE KEY `VolunteerID_UNIQUE` (`VolunteerID`);

--
-- Indexes for table `volprofile`
--
ALTER TABLE `volprofile`
  ADD PRIMARY KEY (`VolunteerID`);

--
-- Indexes for table `volskills`
--
ALTER TABLE `volskills`
  ADD PRIMARY KEY (`VolunteerID`,`SkillID`),
  ADD KEY `VolSkill_Skill_idx` (`SkillID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orgprofile`
--
ALTER TABLE `orgprofile`
  MODIFY `OrgID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orgproject`
--
ALTER TABLE `orgproject`
  MODIFY `OrgProjectID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `SkillID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `volprofile`
--
ALTER TABLE `volprofile`
  MODIFY `VolunteerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orgproject`
--
ALTER TABLE `orgproject`
  ADD CONSTRAINT `OrgProject_OrgProfile` FOREIGN KEY (`OrgID`) REFERENCES `orgprofile` (`OrgID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orgprojectskills`
--
ALTER TABLE `orgprojectskills`
  ADD CONSTRAINT `OrgProjectSkills_OrgProject` FOREIGN KEY (`OrgProjectID`) REFERENCES `orgproject` (`OrgProjectID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `OrgProjectSkills_Skills` FOREIGN KEY (`SkillID`) REFERENCES `skills` (`SkillID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `volbio`
--
ALTER TABLE `volbio`
  ADD CONSTRAINT `VolProfile_VolBio` FOREIGN KEY (`VolunteerID`) REFERENCES `volprofile` (`VolunteerID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `volskills`
--
ALTER TABLE `volskills`
  ADD CONSTRAINT `VolSkill_Skill` FOREIGN KEY (`SkillID`) REFERENCES `skills` (`SkillID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `VolSkill_VolProfile` FOREIGN KEY (`VolunteerID`) REFERENCES `volprofile` (`VolunteerID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `sp_AuthenticateUser`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_AuthenticateUser` (IN `_UserName` VARCHAR(100), IN `_Password` VARCHAR(255), OUT `AuthSuccess` TINYINT)  BEGIN
    
    IF (EXISTS(SELECT 1
				FROM AuthUsers
				WHERE UserName = _UserName
					AND Password = PASSWORD(_Password))) THEN
		SET AuthSuccess = 1;
	ELSE
		SET AuthSuccess = 0;
    END IF;
    
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteAuthUser`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_DeleteAuthUser` (`_UserID` INT)  BEGIN
    
    Delete From AuthUsers Where UserID = _UserID;
        
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteOrgProjectSkills`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_DeleteOrgProjectSkills` (`_OrgProjectID` INT)  BEGIN
    
    DELETE FROM OrgProjectSKills WHERE OrgProjectID = _OrgProjectID;
        
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteVolSkills`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_DeleteVolSkills` (`_VolunteerID` INT)  BEGIN
    
    Delete From VolSkills WHERE VolunteerID = _VolunteerID;
	
END$$

DROP PROCEDURE IF EXISTS `sp_GetOrgProfileByOrgID`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_GetOrgProfileByOrgID` (IN `_OrgID` INT)  BEGIN
    
    SELECT OrgID,
		Description,
        Mission,
        TaxIdentifier,
        ContactName,
        ContactEmail,
        ContactPhone,
        Address1,
        Address2,
        City,
        State,
        Region,
        Country,
        PostalCode,
        EmailAddress,
        PhoneNumber,
        Twitter,
        LinkedIn,
        CreatedDate,
        CreatedBy,
        UpdatedDate,
        UpdatedBy
	FROM OrgProfile
    WHERE OrgID = _OrgID;
    
END$$

DROP PROCEDURE IF EXISTS `sp_GetOrgProjectsByOrgID`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_GetOrgProjectsByOrgID` (IN `_OrgID` INT)  BEGIN
    
    SELECT OrgProjectID,
		OrgID,
		IsActive,
        Priority,
        Description,
        StartDate,
        TimelineDescription,
        City,
        State,
        Region,
        Country,
        PostalCode,
        CreatedDate,
        CreatedBy,
        UpdatedDate,
        UpdatedBy
	FROM OrgProject
    WHERE OrgID = _OrgID;
    
END$$

DROP PROCEDURE IF EXISTS `sp_GetOrgProjectsByOrgProjectID`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_GetOrgProjectsByOrgProjectID` (IN `_OrgProjectID` INT)  BEGIN
    
    SELECT OrgProjectID,
		OrgID,
		IsActive,
        Priority,
        Description,
        StartDate,
        TimelineDescription,
        City,
        State,
        Region,
        Country,
        PostalCode,
        CreatedDate,
        CreatedBy,
        UpdatedDate,
        UpdatedBy
	FROM OrgProject
    WHERE OrgProjectID = _OrgProjectID;
    
END$$

DROP PROCEDURE IF EXISTS `sp_GetOrgProjectSkillsByOrgProjectID`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_GetOrgProjectSkillsByOrgProjectID` (IN `_OrgID` INT, IN `_OrgProjectID` INT)  BEGIN
    
    SELECT ops.OrgProjectID,
		ops.SkillID,
        ops.Description,
        ops.IsRequired,
        ops.CreatedDate,
        ops.CreatedBy,
        s.Name as SkillName,
        s.Description as SkillDescription
	FROM OrgProject as op
		JOIN OrgProjectSkills as ops
			on op.OrgProjectID = ops.OrgProjectID
		JOIN Skills as s
			on ops.SkillID = s.SkillID
    WHERE op.OrgID = Coalesce(_OrgID, op.OrgID)
		AND ops.OrgProjectID = Coalesce(_OrgProjectID, ops.OrgProjectID);

    
END$$

DROP PROCEDURE IF EXISTS `sp_GetSKills`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_GetSKills` ()  BEGIN
    
    SELECT SkillID,
		Name,
        Description,
        ExperienceMin,
        ExperienceMax,
        CreatedDate,
        CreatedBy,
        UpdatedDate,
        UpdatedBy
	FROM Skills;
    
END$$

DROP PROCEDURE IF EXISTS `sp_GetVolBioByVolunteerID`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_GetVolBioByVolunteerID` (`_VolunteerID` INT)  BEGIN
    
    SELECT
		VolunteerID,
        Description,
        WorkHistory,
        Interests,
        CreatedDate,
        CreatedBy,
        UpdatedDate,
        UpdatedBy
	FROM VolBio
    WHERE VolunteerID = _VolunteerID;
        
END$$

DROP PROCEDURE IF EXISTS `sp_GetVolSkillsByVolunteerID`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_GetVolSkillsByVolunteerID` (`_VolunteerID` INT)  BEGIN
    
    Select VolunteerID, 
		SkillID, 
        ExperienceLevel, 
        IsCurrent, 
        CreatedDate, 
        CreatedBy
    FROM VolSkills 
    WHERE VolunteerID = _VolunteerID;
    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertAuthUser`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_InsertAuthUser` (`_Role` VARCHAR(2), `_VolunteerID` INT, `_OrgID` INT, `_UserName` VARCHAR(100), `_Password` VARCHAR(255), `_LastLogin` TIMESTAMP, `_LastPasswordReset` TIMESTAMP, `_CreatedBy` VARCHAR(100), `_UpdatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO AuthUsers
    (
		Role, VolunteerID, 
		OrgID, UserName, 
        Password, LastLogin, 
        LastPasswordReset, CreatedDate, 
        CreatedBy, UpdatedDate, UpdatedBy
	)
    VALUES
    (
		_Role, _VolunteerID, 
		_OrgID, _UserName, 
        PASSWORD(_Password), _LastLogin, 
        _LastPasswordReset, CURRENT_TIMESTAMP, 
        _CreatedBy, CURRENT_TIMESTAMP, _UpdatedBy
	);
    
    SELECT LAST_INSERT_ID();
    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertOrgProfile`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_InsertOrgProfile` (`_OrgID` INT, `_Description` TEXT, `_Mission` TEXT, `_TaxIdentifier` VARCHAR(45), `_ContactName` VARCHAR(200), `_ContactEmail` VARCHAR(200), `_ContactPhone` VARCHAR(20), `_Address1` VARCHAR(200), `_Address2` VARCHAR(200), `_City` VARCHAR(100), `_State` VARCHAR(100), `_Region` VARCHAR(100), `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), `_EmailAddress` VARCHAR(200), `_PhoneNumber` VARCHAR(20), `_Twitter` VARCHAR(200), `_LinkedIn` VARCHAR(200), `_CreatedBy` VARCHAR(100), `_UpdatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO OrgProfile
    (
		OrgID, Description, Mission, TaxIdentifier, ContactName, ContactEmail,
        ContactPhone, Address1, Address2, City, State, Region,
        Country, PostalCode, EmailAddress, PhoneNumber, Twitter,
        LinkedIn, CreatedDate, CreatedBy, UpdatedDate, UpdatedBy
	)
    VALUES
    (
		_OrgID, _Description, _Mission, _TaxIdentifier, _ContactName, _ContactEmail,
        _ContactPhone, _Address1, _Address2, _City, _State, _Region,
        _Country, _PostalCode, _EmailAddress, _PhoneNumber, _Twitter,
        _LinkedIn, CURRENT_TIMESTAMP, _CreatedBy, CURRENT_TIMESTAMP, _UpdatedBy
	);
    
    SELECT LAST_INSERT_ID();
    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertOrgProject`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_InsertOrgProject` (`_OrgProjectID` INT, `_OrgID` INT, `_IsActive` TINYINT, `_Priority` VARCHAR(2), `_Description` TEXT, `_StartDate` DATETIME, `_TimelineDescription` TEXT, `_City` VARCHAR(100), `_State` VARCHAR(100), `_Region` VARCHAR(100), `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), `_CreatedBy` VARCHAR(100), `_UpdatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO OrgProject
    (
		OrgProjectID, OrgID, IsActive, Priority, Description,
        StartDate, TimelineDescription, City, State, Region,
        Country, PostalCode, CreatedDate, CreatedBy, UpdatedDate, 
        UpdatedBy
	)
    VALUES
    (
		_OrgProjectID, _OrgID, _IsActive, _Priority, _Description,
        _StartDate, _TimelineDescription, _City, _State, _Region,
        _Country, _PostalCode, CURRENT_TIMESTAMP, _CreatedBy, CURRENT_TIMESTAMP, 
        _UpdatedBy
	);
    
    SELECT LAST_INSERT_ID();
    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertOrgProjectSkills`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_InsertOrgProjectSkills` (`_OrgProjectID` INT, `_SkillID` INT, `_Description` TEXT, `_IsRequired` TINYINT, `_CreatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO OrgProjectSkills
    (
		OrgProjectID, SkillID, Description, IsRequired, CreatedDate, CreatedBy
	)
    VALUES
    (
		_OrgProjectID, _SkillID, _Description, _IsRequired, CURRENT_TIMESTAMP, _CreatedBy
	);
    
    SELECT LAST_INSERT_ID();
    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertVolProfile`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_InsertVolProfile` (`_FirstName` VARCHAR(100), `_LastName` VARCHAR(100), `_City` VARCHAR(100), `_State` VARCHAR(100), `_Region` VARCHAR(100), `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), `_Url` VARCHAR(200), `_EmailAddress` VARCHAR(200), `_PhoneNumber` VARCHAR(20), `_ContactPref` VARCHAR(5), `_CreatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO VolProfile (
        FirstName, LastName, City, State, Region, Country, 
        PostalCode, Url, EmailAddress, PhoneNumber, ContactPref, 
        CreatedDate, CreatedBy, UpdatedDate, UpdatedBy
	)
	Values
    (
		_FirstName, _LastName, _City, _State, _Region, _Country,
        _PostalCode, _Url, _EmailAddress, _PhoneNumber, _ContactPref,
        CURRENT_TIMESTAMP, _CreatedBy, CURRENT_TIMESTAMP, _CreatedBy
    );
	
    SELECT LAST_INSERT_ID();
    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertVolSkill`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_InsertVolSkill` (`_VolunteerID` INT, `_SkillID` INT, `_ExperienceLevel` INT, `_IsCurrent` TINYINT, `_CreatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO VolSkills
    (
		VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy
	)
    Values
    (
		_VolunteerID, _SkillID, _ExperienceLevel, _IsCurrent, CURRENT_TIMESTAMP, _CreatedBy
    );
	
END$$

DROP PROCEDURE IF EXISTS `sp_SearchOrgProjectsByVarious`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_SearchOrgProjectsByVarious` (IN `_IsActive` TINYINT, IN `_StartDateBegin` DATETIME, IN `_StartDateEnd` DATETIME, IN `_City` VARCHAR(100), IN `_State` VARCHAR(100), IN `_Region` VARCHAR(100), IN `_Country` VARCHAR(100), IN `_PostalCode` VARCHAR(20))  BEGIN
    
    SELECT OrgProjectID,
		OrgID,
		IsActive,
        Priority,
        Description,
        StartDate,
        TimelineDescription,
        City,
        State,
        Region,
        Country,
        PostalCode,
        CreatedDate,
        CreatedBy,
        UpdatedDate,
        UpdatedBy
	FROM OrgProject
    WHERE IsActive = Coalesce(_IsActive, IsActive)
		AND (StartDate >= Coalesce(_StartDateBegin, StartDate) AND StartDate <= Coalesce(_StartDateEnd, StartDate))
        AND City = Coalesce(_City, City)
        AND State = Coalesce(_State, State)
        AND Region = Coalesce(_Region, Region)
        AND Country = Coalesce(_Country, Country)
        AND PostalCode = Coalesce(_PostalCode, PostalCode);

    
END$$

DROP PROCEDURE IF EXISTS `sp_SearchVolunteersByVarious`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_SearchVolunteersByVarious` (`_City` VARCHAR(100), `_State` VARCHAR(100), `_Region` VARCHAR(100), `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), `_SkillID` INT, `_ExperienceLevel` INT, `_IsCurrent` TINYINT)  BEGIN
    
    SELECT vp.VolunteerID,
		vp.FirstName,
        vp.LastName,
        vp.City,
        vp.State,
        vp.Region,
        vp.Country,
        vp.PostalCode,
        vp.Url,
        vp.EmailAddress,
        vp.PhoneNumber,
        vp.ContactPref,
        vb.Description,
        vb.WorkHistory,
        vb.Interests,
        vp.CreatedDate,
        vp.CreatedBy,
        vp.UpdatedDate,
        vp.UpdatedBy
	FROM VolunteerProfile as vp
		JOIN VolunteerBio as vb
			on vp.VolunteerID = vb.VolunteerID
    WHERE vp.City = Coalesce(_City, vp.City)
        AND vp.State = Coalesce(_State, vp.State)
        AND vp.Region = Coalesce(_Region, vp.Region)
        AND vp.Country = Coalesce(_Country, vp.Country)
        AND vp.PostalCode = Coalesce(_PostalCode, vp.PostalCode)
		AND EXISTS (SELECT 1 
					FROM VolSkills as vs
					WHERE vs.VolunteerID = vp.VolunteerID
						AND vs.SkillID = Coalesce(_SkillID, vs.SkillID)
                        AND vs.ExperienceLevel = Coalesce(_ExperienceLevel, vs.ExperienceLevel)
                        AND vs.IsCurrent = Coalesce(_IsCurrent, vs.IsCurrent));


END$$

DROP PROCEDURE IF EXISTS `sp_UpdateAuthUser`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_UpdateAuthUser` (`_UserID` INT, `_Role` VARCHAR(2), `_UserName` VARCHAR(100), `_Password` VARCHAR(255), `_LastLogin` TIMESTAMP, `_LastPasswordReset` TIMESTAMP, `_UpdatedBy` VARCHAR(100))  BEGIN
    
    Update AuthUsers
    SET Role = _Role,
		UserName = _UserName,
        Password = Coalesce(PASSWORD(_Password), Password),
        LastLogin = Coalesce(_LastLogin, LastLogin),
        LastPasswordReset = Coalesce(_LastPasswordReset, LastPasswordReset),
        UpdatedDate = CURRENT_TIMESTAMP,
        UpdatedBy = _UpdatedBy
	WHERE UserID = _UserID;
    
    
END$$

DROP PROCEDURE IF EXISTS `sp_UpdateOrgProfile`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_UpdateOrgProfile` (`_OrgID` INT, `_Description` TEXT, `_Mission` TEXT, `_TaxIdentifier` VARCHAR(45), `_ContactName` VARCHAR(200), `_ContactEmail` VARCHAR(200), `_ContactPhone` VARCHAR(20), `_Address1` VARCHAR(200), `_Address2` VARCHAR(200), `_City` VARCHAR(100), `_State` VARCHAR(100), `_Region` VARCHAR(100), `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), `_EmailAddress` VARCHAR(200), `_PhoneNumber` VARCHAR(20), `_Twitter` VARCHAR(200), `_LinkedIn` VARCHAR(200), `_UpdatedBy` VARCHAR(100))  BEGIN
    
    UPDATE OrgProfile
		SET Description = _Description,
			Mission = _Mission,
            TaxIdentifier = _TaxIdentifier,
            ContactName = _ContactName,
            ContactEmail = _ContactEmail,
			ContactPhone = _ContactPhone,
            Address1 = _Address1,
            Address2 = _Address2,
            City = _City,
            State = _State,
            Region = _Region,
			Country = _Country,
            PostalCode = _PostalCode,
            EmailAddress = _EmailAddress,
            PhoneNumber = _PhoneNumber,
            Twitter = _Twitter,
            LinkedIn = _LinkedIn,
            UpdatedDate = current_timestamp,
            UpdatedBy = _UpdatedBy
	WHERE OrgID = _OrgID;
        
END$$

DROP PROCEDURE IF EXISTS `sp_UpdateOrgProject`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_UpdateOrgProject` (`_OrgProjectID` INT, `_OrgID` INT, `_IsActive` TINYINT, `_Priority` VARCHAR(2), `_Description` TEXT, `_StartDate` DATETIME, `_TimelineDescription` TEXT, `_City` VARCHAR(100), `_State` VARCHAR(100), `_Region` VARCHAR(100), `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), `_UpdatedBy` VARCHAR(100))  BEGIN
    
    UPDATE OrgProject
		SET IsActive = _IsActive,
			Priority = _Priority,
            Description = _Description,
            StartDate = _StartDate,
            TimelineDescription = _TimelineDescription,
            City = _City,
            State = _State,
            Region = _Region,
			Country = _Country,
            PostalCode = _PostalCode,
            UpdatedDate = current_timestamp,
            UpdatedBy = _UpdatedBy
	WHERE OrgProjectID = _OrgProjectID
		AND OrgID = _OrgID;
        
END$$

DROP PROCEDURE IF EXISTS `sp_UpdateVolProfile`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_UpdateVolProfile` (`_VolunteerID` INT, `_FirstName` VARCHAR(100), `_LastName` VARCHAR(100), `_City` VARCHAR(100), `_State` VARCHAR(100), `_Region` VARCHAR(100), `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), `_Url` VARCHAR(200), `_EmailAddress` VARCHAR(200), `_PhoneNumber` VARCHAR(20), `_ContactPref` VARCHAR(5), `_UpdatedBy` VARCHAR(100))  BEGIN
    
    UPDATE VolProfile
		set FirstName = _FirstName,
			LastName = _LastName,
            City = _City,
            State = _State,
            Region = _Region,
            Country = _Country,
			PostalCode = _PostalCode,
            Url = _Url,
            EmailAddress = _EmailAddress,
            PhoneNumber = _PhoneNumber,
            ContactPref = _ContactPref, 
			UpdatedDate = CURRENT_TIMESTAMP,
            UpdatedBy = _UpdatedBy
	WHERE VolunteerID = _VolunteerID;
    
END$$

DROP PROCEDURE IF EXISTS `sp_UpdateVolBio`$$
CREATE DEFINER=`root`@`%` PROCEDURE `sp_UpdateVolBio`(
		`_VolunteerID` INT, `_Description` TEXT, 
        `_WorkHistory` TEXT, `_Interests` TEXT,
        `_UpdatedBy` VARCHAR(100))
BEGIN
    
    UPDATE VolBio
		set Description = _Description,
			WorkHistory = _WorkHistory,
            Interests = _Interests,
			UpdatedDate = CURRENT_TIMESTAMP,
            UpdatedBy = _UpdatedBy
	WHERE VolunteerID = _VolunteerID;
    
END$$
