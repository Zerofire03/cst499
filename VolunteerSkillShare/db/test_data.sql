/*
Install a set of test data into vss tables

This script truncates all tables and inserts a new set of base test data.
*/

-- turn off foreign key checks
SET FOREIGN_KEY_CHECKS=0;

-- delete data
TRUNCATE TABLE volskills;
TRUNCATE TABLE orgprojectskills;
TRUNCATE TABLE skills;
TRUNCATE TABLE volbio;
TRUNCATE TABLE orgproject;
TRUNCATE TABLE authusers;
TRUNCATE TABLE orgprofile;
TRUNCATE TABLE volprofile;

-- reset the checks
SET FOREIGN_KEY_CHECKS=1;

-----------------
-- add some skill records
-----------------
insert into skills (Name, Description, ExperienceMin, ExperienceMax, CreatedDate, CreatedBy, UpdatedDate, UpdatedBy)
select 'SQL Development', 'Ability to code in sql, mysql, MSSQL, etc.', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'HTML', 'Ability write html for web pages', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'JavaScript', 'Ability write javascript for web pages', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'Printer Setup', 'Ability to set up and connect a printer', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'Desktop Administration', 'Desktop computer administration and maintenance', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'Database Administration', 'Administer and maintain an application database', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'Network Installation', 'Installation and planning of computer networks', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'Network Administration', 'Administer computer networks', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'Carpentry', 'Light office and home carpentry', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'Painting', 'Indoor or Outdoor painting', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'Bookkeeping', 'Financial bookkeeping and management', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'Human Resources', 'Human resources management', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'Process Definition', 'Process definition and documentation', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser'
union select 'Tax Preparation', 'Nonprofit tax preparation', 0, 10, current_timestamp, 'rootuser', current_timestamp, 'rootuser';

/*
SQL Development - 1
HTML - 2
JavaScript - 3
Printer Setup - 4
Desktop Administration - 5
Database Administration - 6
Network Installation - 7
Network Administration - 8
Carpentry - 9
Painting - 10
Bookkeeping - 11
Human Resources - 12
Process Definition - 13
Tax Preparation - 14
*/

--------------------------------
-- volunteer 1
--------------------------------

-- insert #1 volunteer record
set @_City = 'Test City';
set @_State = 'CA';
set @_Region = 'Business Center';
set @_Country = 'USA';
set @_PostalCode = '99999';
set @_Url = 'testvolunteer.com/1';
set @_EmailAddress = 'testvolunteer@test.com';
set @_PhoneNumber = '0';
set @_ContactPref = 'E';
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolProfile(@_City, @_State, @_Region, @_Country, @_PostalCode, @_Url, @_EmailAddress, @_PhoneNumber, @_ContactPref, @_CreatedBy);

set @vol1 = (SELECT LAST_INSERT_ID());
select @vol1 as Volunteer1ID;

-- insert volunteer bio
set @_VolunteerID = @vol1;
set @_Description = 'This is a test bio description for volunteer 1';
set @_WorkHistory = 'This is a temporary work history for volunteer 1';
set @_Interests = null;
set @_CreatedBy = '0';
call `cst499-vss`.sp_InsertVolBio(@_VolunteerID, @_Description, @_WorkHistory, @_Interests, @_CreatedBy);
-- select @_VolunteerID, @_Description, @_WorkHistory, @_Interests, @_CreatedBy;

-- insert user auth
set @_Role = 'V';
set @_VolunteerID = @vol1;
set @_OrgID = null;
set @_FirstName = 'firstval';
set @_LastName = 'lastval';
set @_UserName = 'testuser';
set @_Password = 'testpass';
set @_LastLogin = now();
set @_LastPasswordReset = now();
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertAuthUser(@_Role, @_VolunteerID, @_OrgID, @_FirstName, @_LastName, @_UserName, @_Password, @_LastLogin, @_LastPasswordReset, @_CreatedBy);
-- select @_Role, @_VolunteerID, @_OrgID, @_FirstName, @_LastName, @_UserName, @_Password, @_LastLogin, @_LastPasswordReset, @_CreatedBy;

-- insert volunteer skills
-- set @_VolunteerID = @vol1;
set @_SkillID = 1;
set @_ExperienceLevel = 6;
set @_IsCurrent = 1;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolSkill(@vol1, @_SkillID, @_ExperienceLevel, @_IsCurrent, @_CreatedBy);

-- set @_VolunteerID = @vol1;
set @_SkillID = 2;
set @_ExperienceLevel = 7;
set @_IsCurrent = 1;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolSkill(@vol1, @_SkillID, @_ExperienceLevel, @_IsCurrent, @_CreatedBy);

-- set @_VolunteerID = @vol1;
set @_SkillID = 3;
set @_ExperienceLevel = 7;
set @_IsCurrent = 1;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolSkill(@vol1, @_SkillID, @_ExperienceLevel, @_IsCurrent, @_CreatedBy);

-- set @_VolunteerID = @vol1;
set @_SkillID = 9;
set @_ExperienceLevel = 4;
set @_IsCurrent = 0;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolSkill(@vol1, @_SkillID, @_ExperienceLevel, @_IsCurrent, @_CreatedBy);

-- set @_VolunteerID = @vol1;
set @_SkillID = 10;
set @_ExperienceLevel = 5;
set @_IsCurrent = 1;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolSkill(@vol1, @_SkillID, @_ExperienceLevel, @_IsCurrent, @_CreatedBy);


--------------------------------
-- volunteer 2
--------------------------------
-- Create second volunteer profile
set @_City = 'Another City';
set @_State = 'IA';
set @_Region = 'Suburbs';
set @_Country = 'USA';
set @_PostalCode = '45450';
set @_Url = 'testvolunteer.com/2';
set @_EmailAddress = 'testvolunteer2@test.com';
set @_PhoneNumber = '0';
set @_ContactPref = 'E';
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolProfile(@_City, @_State, @_Region, @_Country, @_PostalCode, @_Url, @_EmailAddress, @_PhoneNumber, @_ContactPref, @_CreatedBy);

set @vol2 = (SELECT LAST_INSERT_ID());

-- insert volunteer bio
set @_VolunteerID = @vol2;
set @_Description = 'This is a test bio description for volunteer 2';
set @_WorkHistory = 'This is a temporary work history for volunteer 2';
set @_Interests = null;
set @_CreatedBy = '0';
call `cst499-vss`.sp_InsertVolBio(@_VolunteerID, @_Description, @_WorkHistory, @_Interests, @_CreatedBy);
select @_VolunteerID, @_Description, @_WorkHistory, @_Interests, @_CreatedBy;

-- add second volunteer authuser
set @_Role = 'V';
set @_VolunteerID = @vol2;
set @_OrgID = null;
set @_FirstName = 'John';
set @_LastName = 'Doe';
set @_UserName = 'johndoe@test.com';
set @_Password = 'testpass';
set @_LastLogin = now();
set @_LastPasswordReset = now();
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertAuthUser(@_Role, @_VolunteerID, @_OrgID, @_FirstName, @_LastName, @_UserName, @_Password, @_LastLogin, @_LastPasswordReset, @_CreatedBy);
select @_Role, @_VolunteerID, @_OrgID, @_FirstName, @_LastName, @_UserName, @_Password, @_LastLogin, @_LastPasswordReset, @_CreatedBy;


-- insert volunteer skills
set @_VolunteerID = @vol2;
set @_SkillID = 5;
set @_ExperienceLevel = 6;
set @_IsCurrent = 1;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolSkill(@_VolunteerID, @_SkillID, @_ExperienceLevel, @_IsCurrent, @_CreatedBy);

set @_VolunteerID = @vol2;
set @_SkillID = 6;
set @_ExperienceLevel = 7;
set @_IsCurrent = 1;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolSkill(@_VolunteerID, @_SkillID, @_ExperienceLevel, @_IsCurrent, @_CreatedBy);

set @_VolunteerID = @vol2;
set @_SkillID = 7;
set @_ExperienceLevel = 7;
set @_IsCurrent = 1;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolSkill(@_VolunteerID, @_SkillID, @_ExperienceLevel, @_IsCurrent, @_CreatedBy);

set @_VolunteerID = @vol2;
set @_SkillID = 11;
set @_ExperienceLevel = 4;
set @_IsCurrent = 1;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolSkill(@_VolunteerID, @_SkillID, @_ExperienceLevel, @_IsCurrent, @_CreatedBy);

set @_VolunteerID = @vol2;
set @_SkillID = 13;
set @_ExperienceLevel = 6;
set @_IsCurrent = 0;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertVolSkill(@_VolunteerID, @_SkillID, @_ExperienceLevel, @_IsCurrent, @_CreatedBy);

--------------------------------
-- org 1
--------------------------------
-- create an organization
set @_Description = 'VSS Test NonProfit';
set @_Mission = 'To boldly finish CST499';
set @_TaxIdentifier = 'TestTaxID';
set @_ContactName = 'Test User';
set @_ContactEmail = 'testuser@test.com';
set @_ContactPhone = '999-999-9999';
set @_Address1 = '123 Main St';
set @_Address2 = '0';
set @_City = 'Test City';
set @_State = 'NY';
set @_Region = 'Manhattan';
set @_Country = 'USA';
set @_PostalCode = '14301';
set @_EmailAddress = 'testorg1@test.com';
set @_PhoneNumber = '(999)555-0101';
set @_Twitter = '0';
set @_LinkedIn = '0';
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertOrgProfile(@_Description, @_Mission, @_TaxIdentifier, @_ContactName, @_ContactEmail, @_ContactPhone, @_Address1, @_Address2, @_City, @_State, @_Region, @_Country, @_PostalCode, @_EmailAddress, @_PhoneNumber, @_Twitter, @_LinkedIn, @_CreatedBy);

set @org1 = (select last_insert_id());
select @org1 as Org1ID;

-- create the login
set @_Role = 'O';
set @_VolunteerID = null;
set @_OrgID = @org1;
set @_FirstName = 'Jane';
set @_LastName = 'Doe';
set @_UserName = 'org1@test.com';
set @_Password = 'testpass';
set @_LastLogin = now();
set @_LastPasswordReset = now();
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertAuthUser(@_Role, @_VolunteerID, @_OrgID, @_FirstName, @_LastName, @_UserName, @_Password, @_LastLogin, @_LastPasswordReset, @_CreatedBy);
select @_Role, @_VolunteerID, @_OrgID, @_FirstName, @_LastName, @_UserName, @_Password, @_LastLogin, @_LastPasswordReset, @_CreatedBy;

-- create a project listing
set @_OrgID = @org1;
set @_IsActive = 1;
set @_Priority = 'H';
set @_Description = 'Sample Network Installation

Test Org is looking to install a new network in our 
extended office space.  This office space is a new 
builout space and does not have any existing infrastructure.

The project includes installation of wired network 
lines between a planned cubicle, office, and desk layout 
and a central point and then to the existing office network.

Our staff are free to work in multiple areas in the 
office as well as in conference rooms.  To support 
the open desk plan we would also like wireless to 
be installed and connected to the network.

We will look for the project staff to put together a 
plan, working with the site architect.  This 
will ensure connections and power are installed 
together.
';
set @_StartDate = '08/01/2019';
set @_TimelineDescription = '
Funds will be allocated from the build-out budget 
or by new grant requests once the initial plan 
is reviewed.  Timeline for the start will depend 
on this funding process.
';
set @_City = 'Test City';
set @_State = 'NY';
set @_Region = 'Manhattan';
set @_Country = 'USA';
set @_PostalCode = '14301';
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertOrgProject(@_OrgID, @_IsActive, @_Priority, @_Description, @_StartDate, @_TimelineDescription, @_City, @_State, @_Region, @_Country, @_PostalCode, @_CreatedBy);

set @org1project = (select last_insert_id());
select @org1project as Org1ProjectID;

-- insert the necessary skills
/* Network - 7, 8 */
set @_OrgProjectID = @org1project;
set @_SkillID = 7;
set @_Description = 'Installation and planning for the new network';
set @_IsRequired = 1;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertOrgProjectSkills(@_OrgProjectID, @_SkillID, @_Description, @_IsRequired, @_CreatedBy);

set @_OrgProjectID = @org1project;
set @_SkillID = 8;
set @_Description = 'Administration and assistance for the network setup';
set @_IsRequired = 0;
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertOrgProjectSkills(@_OrgProjectID, @_SkillID, @_Description, @_IsRequired, @_CreatedBy);

