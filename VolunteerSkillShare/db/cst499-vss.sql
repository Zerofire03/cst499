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
