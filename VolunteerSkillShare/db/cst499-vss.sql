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
  `FirstName` varchar(100) NULL,
  `LastName` varchar(100) NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `LastLogin` timestamp NULL DEFAULT NULL,
  `LastPasswordReset` timestamp NULL DEFAULT NULL,
  `CreatedDate` timestamp NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL,
  `UpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- Table structure for table `orgprofile`
--

DROP TABLE IF EXISTS `orgprofile`;
CREATE TABLE `orgprofile` (
  `OrgID` int(11) NOT NULL,
  `Name` VARCHAR(100) NOT NULL,
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
  `CreatedDate` timestamp NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL,
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
  `Name` VARCHAR(100) NOT NULL,
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
  `CreatedDate` timestamp NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL,
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
  `CreatedDate` timestamp NOT NULL,
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
  `CreatedDate` timestamp NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL,
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
  `CreatedDate` timestamp NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL,
  `UpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `volprofile`
--

DROP TABLE IF EXISTS `volprofile`;
CREATE TABLE `volprofile` (
  `VolunteerID` int(11) NOT NULL,
  `City` varchar(100) DEFAULT NULL,
  `State` varchar(100) DEFAULT NULL,
  `Region` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `PostalCode` varchar(20) DEFAULT NULL,
  `Url` varchar(200) DEFAULT NULL,
  `EmailAddress` varchar(200) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `ContactPref` varchar(5) NOT NULL DEFAULT 'E' COMMENT 'E - Email\nP - Phone',
  `CreatedDate` timestamp NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedDate` timestamp NOT NULL,
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
  `CreatedDate` timestamp NOT NULL,
  `CreatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authusers`
--
ALTER TABLE `authusers`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName_UNIQUE` (`UserName`);

--
-- Indexes for table `orgprofile`
--
ALTER TABLE `orgprofile`
  ADD PRIMARY KEY (`OrgID`),
  ADD UNIQUE KEY `Name_UNIQUE` (`Name`);

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
  ADD PRIMARY KEY (`SkillID`),
  ADD UNIQUE KEY `Name_UNIQUE` (`Name`);

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
-- AUTO_INCREMENT for table `authusers`
--
ALTER TABLE `authusers`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

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
CREATE PROCEDURE `sp_AuthenticateUser` (IN `_UserName` VARCHAR(100), IN `_Password` VARCHAR(255), OUT `AuthSuccess` TINYINT)  BEGIN
    
    IF (EXISTS(SELECT 1
				FROM authusers
				WHERE UserName = _UserName
					AND Password = PASSWORD(_Password))) THEN
		SET AuthSuccess = 1;
	ELSE
		SET AuthSuccess = 0;
    END IF;
    
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteAuthUser`$$
CREATE PROCEDURE `sp_DeleteAuthUser` (`_UserID` INT)  BEGIN
    
    Delete From authusers Where UserID = _UserID;
        
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteOrgProjectSkills`$$
CREATE PROCEDURE `sp_DeleteOrgProjectSkills` (`_OrgProjectID` INT)  BEGIN
    
    DELETE FROM orgprojectskills WHERE OrgProjectID = _OrgProjectID;
        
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteVolSkills`$$
CREATE PROCEDURE `sp_DeleteVolSkills` (`_VolunteerID` INT)  BEGIN
    
    Delete From volskills WHERE VolunteerID = _VolunteerID;
	
END$$

DROP PROCEDURE IF EXISTS `sp_GetAuthUserByUserName`$$
CREATE PROCEDURE `sp_GetAuthUserByUserName` (`_UserName` VARCHAR(100))  BEGIN
    
    Select UserID, Role, VolunteerID, OrgID, FirstName, LastName,
		UserName, LastLogin, LastPasswordReset, CreatedDate, CreatedBy,
        UpdatedDate, UpdatedBy
	From authusers
    Where UserName = _UserName;
	
END$$


DROP PROCEDURE IF EXISTS `sp_GetOrgProfileByOrgID`$$
CREATE PROCEDURE `sp_GetOrgProfileByOrgID` (IN `_OrgID` INT)  BEGIN
    
    SELECT OrgID,
		Name,
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
	FROM orgprofile
    WHERE OrgID = _OrgID;
    
END$$

DROP PROCEDURE IF EXISTS `sp_GetOrgProjectsByOrgID`$$
CREATE PROCEDURE `sp_GetOrgProjectsByOrgID` (IN `_OrgID` INT)  BEGIN
    
    SELECT OrgProjectID,
		OrgID,
        Name,
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
	FROM orgproject
    WHERE OrgID = _OrgID;
    
END$$

DROP PROCEDURE IF EXISTS `sp_GetOrgProjectsByOrgProjectID`$$
CREATE PROCEDURE `sp_GetOrgProjectsByOrgProjectID` (IN `_OrgProjectID` INT)  BEGIN
    
    SELECT OrgProjectID,
		OrgID,
        Name,
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
	FROM orgproject
    WHERE OrgProjectID = _OrgProjectID;
    
END$$

DROP PROCEDURE IF EXISTS `sp_GetOrgProjectSkillsByOrgProjectID`$$
CREATE PROCEDURE `sp_GetOrgProjectSkillsByOrgProjectID` (IN `_OrgID` INT, IN `_OrgProjectID` INT)  BEGIN
    
    SELECT ops.OrgProjectID,
		ops.SkillID,
        ops.Description,
        ops.IsRequired,
        ops.CreatedDate,
        ops.CreatedBy,
        s.Name as SkillName,
        s.Description as SkillDescription
	FROM orgproject as op
		JOIN orgprojectskills as ops
			on op.OrgProjectID = ops.OrgProjectID
		JOIN skills as s
			on ops.SkillID = s.SkillID
    WHERE op.OrgID = Coalesce(_OrgID, op.OrgID)
		AND ops.OrgProjectID = Coalesce(_OrgProjectID, ops.OrgProjectID);

    
END$$

DROP PROCEDURE IF EXISTS `sp_GetSkills`$$
CREATE PROCEDURE `sp_GetSkills` ()  BEGIN
    
    SELECT SkillID,
		Name,
        Description,
        ExperienceMin,
        ExperienceMax,
        CreatedDate,
        CreatedBy,
        UpdatedDate,
        UpdatedBy
	FROM skills;
    
END$$

DROP PROCEDURE IF EXISTS `sp_GetVolBioByVolunteerID`$$
CREATE PROCEDURE `sp_GetVolBioByVolunteerID` (`_VolunteerID` INT)  BEGIN
    
    SELECT
		VolunteerID,
        Description,
        WorkHistory,
        Interests,
        CreatedDate,
        CreatedBy,
        UpdatedDate,
        UpdatedBy
	FROM volbio
    WHERE VolunteerID = _VolunteerID;
        
END$$

DROP PROCEDURE IF EXISTS `sp_GetVolSkillsByVolunteerID`$$
CREATE PROCEDURE `sp_GetVolSkillsByVolunteerID` (`_VolunteerID` INT)  BEGIN
    
    Select VolunteerID, 
		SkillID, 
        ExperienceLevel, 
        IsCurrent, 
        CreatedDate, 
        CreatedBy
    FROM volskills 
    WHERE VolunteerID = _VolunteerID;
    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertAuthUser`$$
CREATE PROCEDURE `sp_InsertAuthUser` (`_Role` VARCHAR(2), `_VolunteerID` INT, 
		`_OrgID` INT, `_FirstName` VARCHAR(100),
        `_LastName` VARCHAR(100), `_UserName` VARCHAR(100), 
        `_Password` VARCHAR(255), `_LastLogin` TIMESTAMP, 
        `_LastPasswordReset` TIMESTAMP, `_CreatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO authusers
    (
		Role, VolunteerID, 
		OrgID, FirstName, LastName,
        UserName, Password, LastLogin, 
        LastPasswordReset, CreatedDate, 
        CreatedBy, UpdatedDate, UpdatedBy
	)
    VALUES
    (
		_Role, _VolunteerID, 
		_OrgID, _FirstName, _LastName,
        _UserName, PASSWORD(_Password), _LastLogin, 
        _LastPasswordReset, CURRENT_TIMESTAMP, 
        _CreatedBy, CURRENT_TIMESTAMP, _CreatedBy
	);
    
    SELECT LAST_INSERT_ID();
    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertOrgProfile`$$
CREATE PROCEDURE `sp_InsertOrgProfile` (`_Name` VARCHAR(100), `_Description` TEXT, 
					`_Mission` TEXT, `_TaxIdentifier` VARCHAR(45), 
                    `_ContactName` VARCHAR(200), `_ContactEmail` VARCHAR(200), 
                    `_ContactPhone` VARCHAR(20), `_Address1` VARCHAR(200), 
                    `_Address2` VARCHAR(200), `_City` VARCHAR(100), 
                    `_State` VARCHAR(100), `_Region` VARCHAR(100), 
                    `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), 
                    `_EmailAddress` VARCHAR(200), `_PhoneNumber` VARCHAR(20), 
                    `_Twitter` VARCHAR(200), `_LinkedIn` VARCHAR(200), 
                    `_CreatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO orgprofile
    (
		Name, Description, Mission, TaxIdentifier, ContactName, ContactEmail,
        ContactPhone, Address1, Address2, City, State, Region,
        Country, PostalCode, EmailAddress, PhoneNumber, Twitter,
        LinkedIn, CreatedDate, CreatedBy, UpdatedDate, UpdatedBy
	)
    VALUES
    (
		_Name, _Description, _Mission, _TaxIdentifier, _ContactName, _ContactEmail,
        _ContactPhone, _Address1, _Address2, _City, _State, _Region,
        _Country, _PostalCode, _EmailAddress, _PhoneNumber, _Twitter,
        _LinkedIn, CURRENT_TIMESTAMP, _CreatedBy, CURRENT_TIMESTAMP, _CreatedBy
	);
    
    SELECT LAST_INSERT_ID();
    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertOrgProject`$$
CREATE PROCEDURE `sp_InsertOrgProject` (`_OrgID` INT, `_Name` VARCHAR(100),
		`_IsActive` TINYINT, `_Priority` VARCHAR(2), 
        `_Description` TEXT, `_StartDate` DATETIME, 
        `_TimelineDescription` TEXT, `_City` VARCHAR(100), 
        `_State` VARCHAR(100), `_Region` VARCHAR(100), 
        `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), 
        `_CreatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO orgproject
    (
		OrgID, Name, IsActive, Priority, Description,
        StartDate, TimelineDescription, City, State, Region,
        Country, PostalCode, CreatedDate, CreatedBy, UpdatedDate, 
        UpdatedBy
	)
    VALUES
    (
		_OrgID, _Name, _IsActive, _Priority, _Description,
        _StartDate, _TimelineDescription, _City, _State, _Region,
        _Country, _PostalCode, CURRENT_TIMESTAMP, _CreatedBy, CURRENT_TIMESTAMP, 
        _CreatedBy
	);
    
    SELECT LAST_INSERT_ID();
    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertOrgProjectSkills`$$
CREATE PROCEDURE `sp_InsertOrgProjectSkills` (`_OrgProjectID` INT, `_SkillID` INT, 
		`_Description` TEXT, `_IsRequired` TINYINT, 
        `_CreatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO orgprojectskills
    (
		OrgProjectID, SkillID, Description, IsRequired, CreatedDate, CreatedBy
	)
    VALUES
    (
		_OrgProjectID, _SkillID, _Description, _IsRequired, CURRENT_TIMESTAMP, _CreatedBy
	);
        
END$$

DROP PROCEDURE IF EXISTS `sp_InsertVolProfile`$$
CREATE PROCEDURE `sp_InsertVolProfile` (`_City` VARCHAR(100), 
        `_State` VARCHAR(100), `_Region` VARCHAR(100), 
        `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), 
        `_Url` VARCHAR(200), `_EmailAddress` VARCHAR(200), 
        `_PhoneNumber` VARCHAR(20), `_ContactPref` VARCHAR(5), 
        `_CreatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO volprofile (
        City, State, Region, Country, 
        PostalCode, Url, EmailAddress, PhoneNumber, ContactPref, 
        CreatedDate, CreatedBy, UpdatedDate, UpdatedBy
	)
	Values
    (
		_City, _State, _Region, _Country,
        _PostalCode, _Url, _EmailAddress, _PhoneNumber, _ContactPref,
        CURRENT_TIMESTAMP, _CreatedBy, CURRENT_TIMESTAMP, _CreatedBy
    );
	
    SELECT LAST_INSERT_ID();
    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertVolBio`$$
CREATE PROCEDURE `sp_InsertVolBio` (`_VolunteerID` INT, 
		`_Description` text, `_WorkHistory` text, `_Interests` text, 
        `_CreatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO volbio (
        VolunteerID, Description, WorkHistory, Interests,
        CreatedDate, CreatedBy, UpdatedDate, UpdatedBy
	)
	Values
    (
		_VolunteerID, _Description, _WorkHistory, _Interests,
        CURRENT_TIMESTAMP, _CreatedBy, CURRENT_TIMESTAMP, _CreatedBy
    );
	    
END$$

DROP PROCEDURE IF EXISTS `sp_InsertVolSkill`$$
CREATE PROCEDURE `sp_InsertVolSkill` (`_VolunteerID` INT, 
		`_SkillID` INT, `_ExperienceLevel` INT, 
        `_IsCurrent` TINYINT, `_CreatedBy` VARCHAR(100))  BEGIN
    
    INSERT INTO volskills
    (
		VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy
	)
    Values
    (
		_VolunteerID, _SkillID, _ExperienceLevel, _IsCurrent, CURRENT_TIMESTAMP, _CreatedBy
    );
	
END$$

DROP PROCEDURE IF EXISTS `sp_SearchOrgProjectsByVarious`$$
CREATE PROCEDURE `sp_SearchOrgProjectsByVarious` (IN `_IsPriority` VARCHAR(2), 
		IN `_StartDateBegin` DATETIME, IN `_StartDateEnd` DATETIME, 
        IN `_City` VARCHAR(100), IN `_State` VARCHAR(100), 
        IN `_Region` VARCHAR(100), IN `_Country` VARCHAR(100), 
        IN `_PostalCode` VARCHAR(20))  BEGIN
    
    IF (ISNULL(_StartDateBegin) OR ISEMPTY(_StartDateBegin)) THEN
		SET _StartDateBegin = STR_TO_DATE('01-01-1900','%d-%m-%Y');
    END IF;
    IF (ISNULL(_StartDateEnd) OR ISEMPTY(_StartDateEnd)) THEN
		SET _StartDateEnd = STR_TO_DATE('31-12-2299','%d-%m-%Y');
    END IF;

    SELECT op.OrgProjectID,
		op.OrgID,
		op.Name,
        o.Name as OrgName,
		op.IsActive,
        op.Priority,
        op.Description,
        op.StartDate,
        op.TimelineDescription,
        op.City,
        op.State,
        op.Region,
        op.Country,
        op.PostalCode,
        op.CreatedDate,
        op.CreatedBy,
        op.UpdatedDate,
        op.UpdatedBy
	FROM orgproject as op
		join orgprofile as o
			on op.OrgID = o.OrgID
    WHERE LOWER(op.Priority) = LOWER(Coalesce(_IsPriority, op.Priority))
		AND op.StartDate between _StartDateBegin AND _StartDateEnd
        AND op.City LIKE CONCAT('%', coalesce(_City, ''), '%')
        AND op.State LIKE CONCAT('%', coalesce(_State, ''), '%')
        AND op.Region LIKE CONCAT('%', coalesce(_Region, ''), '%')
        AND op.Country LIKE CONCAT('%', coalesce(_Country, ''), '%')
        AND op.PostalCode LIKE CONCAT('%', coalesce(_PostalCode, ''), '%');

    
END$$


DROP PROCEDURE IF EXISTS `sp_SearchOrgsByVarious`$$
CREATE PROCEDURE `sp_SearchOrgsByVarious` (IN `_Name` VARCHAR(100), 
        IN `_TaxIdentifier` VARCHAR(50), 
        IN `_City` VARCHAR(100), IN `_State` VARCHAR(100), 
        IN `_Region` VARCHAR(100), IN `_Country` VARCHAR(100), 
        IN `_PostalCode` VARCHAR(20))  BEGIN
    
    SELECT OrgID,
		Name,
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
	FROM orgprofile
    WHERE Name like CONCAT('%', _Name, '%') 
		AND TaxIdentifier like CONCAT('%', _TaxIdentifier, '%') 
        AND City like CONCAT('%', _City, '%') 
        AND State like CONCAT('%', _State, '%') 
        AND Region like CONCAT('%', _Region, '%') 
        AND Country like CONCAT('%', _Country, '%') 
        AND PostalCode like CONCAT('%', _PostalCode, '%');


END$$

DROP PROCEDURE IF EXISTS `sp_SearchVolunteersByVarious`$$
CREATE PROCEDURE `sp_SearchVolunteersByVarious` (`_City` VARCHAR(100), 
		`_State` VARCHAR(100), `_Region` VARCHAR(100), 
        `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), 
        `_SkillID` INT, `_ExperienceLevel` INT, 
        `_IsCurrent` TINYINT)  BEGIN
    
    SELECT vp.VolunteerID,
		au.FirstName,
        au.LastName,
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
        vp.UpdatedBy,
        vs.SkillID,
        vs.ExperienceLevel,
        vs.IsCurrent,
        s.Name
	FROM volprofile as vp
		JOIN volbio as vb
			on vp.VolunteerID = vb.VolunteerID
		JOIN authusers as au
			on au.VolunteerID = vp.VolunteerID
				and au.Role = 'V'
		LEFT OUTER JOIN volskills as vs
			on vs.VolunteerID = vp.VolunteerID
                AND vs.SkillID = _SkillID
                AND vs.ExperienceLevel >= Coalesce(_ExperienceLevel, vs.ExperienceLevel)
                AND vs.IsCurrent = Coalesce(_IsCurrent, vs.IsCurrent)
		LEFT OUTER JOIN skills as s
			on s.SkillID = vs.SkillID
    WHERE vp.City like CONCAT('%', ifnull(_City, vp.City), '%') 
        AND vp.State like CONCAT('%', ifnull(_State, vp.State), '%') 
        AND vp.Region like CONCAT('%', ifnull(_Region, vp.Region), '%') 
        AND vp.Country like CONCAT('%', ifnull(_Country, vp.Country), '%') 
        AND vp.PostalCode like CONCAT('%', ifnull(_PostalCode, vp.PostalCode), '%')
        AND EXISTS (SELECT 1 
					FROM volskills as vs
					WHERE vs.VolunteerID = vp.VolunteerID
						AND vs.SkillID = ifnull(_SkillID, vs.SkillID)
                        AND vs.ExperienceLevel >= ifnull(_ExperienceLevel, vs.ExperienceLevel)
                        AND vs.IsCurrent = ifnull(_IsCurrent, vs.IsCurrent));

END$$

DROP PROCEDURE IF EXISTS `sp_UpdateAuthUser`$$
CREATE PROCEDURE `sp_UpdateAuthUser` (`_UserID` INT, 
		`_Role` VARCHAR(2), `_FirstName` VARCHAR(100), 
        `_LastName` VARCHAR(100), `_UserName` VARCHAR(100), 
        `_Password` VARCHAR(255), `_LastLogin` TIMESTAMP, 
        `_LastPasswordReset` TIMESTAMP, `_UpdatedBy` VARCHAR(100))  BEGIN
    
    Update authusers
    SET Role = _Role,
		FirstName = _FirstName,
        LastName = _LastName,
		UserName = _UserName,
        Password = Coalesce(PASSWORD(_Password), Password),
        LastLogin = Coalesce(_LastLogin, LastLogin),
        LastPasswordReset = Coalesce(_LastPasswordReset, LastPasswordReset),
        UpdatedDate = CURRENT_TIMESTAMP,
        UpdatedBy = _UpdatedBy
	WHERE UserID = _UserID;
    
    
END$$

DROP PROCEDURE IF EXISTS `sp_UpdateOrgProfile`$$
CREATE PROCEDURE `sp_UpdateOrgProfile` (`_OrgID` INT, `_Name` VARCHAR(100),
		`_Description` TEXT, 
		`_Mission` TEXT, `_TaxIdentifier` VARCHAR(45), 
        `_ContactName` VARCHAR(200), `_ContactEmail` VARCHAR(200), 
        `_ContactPhone` VARCHAR(20), `_Address1` VARCHAR(200), 
        `_Address2` VARCHAR(200), `_City` VARCHAR(100), 
        `_State` VARCHAR(100), `_Region` VARCHAR(100), 
        `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), 
        `_EmailAddress` VARCHAR(200), `_PhoneNumber` VARCHAR(20), 
        `_Twitter` VARCHAR(200), `_LinkedIn` VARCHAR(200), 
        `_UpdatedBy` VARCHAR(100))  BEGIN
    
    UPDATE orgprofile
		SET Name = _Name,
			Description = _Description,
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
CREATE PROCEDURE `sp_UpdateOrgProject` (`_OrgProjectID` INT, 
		`_OrgID` INT, `_Name` VARCHAR(100), `_IsActive` TINYINT, 
        `_Priority` VARCHAR(2), `_Description` TEXT, 
        `_StartDate` DATETIME, `_TimelineDescription` TEXT, 
        `_City` VARCHAR(100), `_State` VARCHAR(100), 
        `_Region` VARCHAR(100), `_Country` VARCHAR(100), 
        `_PostalCode` VARCHAR(20), `_UpdatedBy` VARCHAR(100))  BEGIN
    
    UPDATE orgproject
		SET Name = _Name,
			IsActive = _IsActive,
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
CREATE PROCEDURE `sp_UpdateVolProfile` (`_VolunteerID` INT, `_FirstName` VARCHAR(100), `_LastName` VARCHAR(100), `_City` VARCHAR(100), `_State` VARCHAR(100), `_Region` VARCHAR(100), `_Country` VARCHAR(100), `_PostalCode` VARCHAR(20), `_Url` VARCHAR(200), `_EmailAddress` VARCHAR(200), `_PhoneNumber` VARCHAR(20), `_ContactPref` VARCHAR(5), `_UpdatedBy` VARCHAR(100))  BEGIN
    
    UPDATE volprofile
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
CREATE PROCEDURE `sp_UpdateVolBio`(
		`_VolunteerID` INT, `_Description` TEXT, 
        `_WorkHistory` TEXT, `_Interests` TEXT,
        `_UpdatedBy` VARCHAR(100))
BEGIN
    
    UPDATE volbio
		set Description = _Description,
			WorkHistory = _WorkHistory,
            Interests = _Interests,
			UpdatedDate = CURRENT_TIMESTAMP,
            UpdatedBy = _UpdatedBy
	WHERE VolunteerID = _VolunteerID;
    
END$$

GRANT ALL ON `cst499-vss`.* TO 'root'@'%';$$
GRANT ALL ON `cst499-vss`.* TO 'root'@'127.0.0.1';$$

