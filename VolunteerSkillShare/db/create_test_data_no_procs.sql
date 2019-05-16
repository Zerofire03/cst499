USE `cst499-vss`;

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

-- ---------------
-- add some skill records
-- ---------------
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

-- ------------------------------
-- volunteer 1
-- ------------------------------
insert into volprofile 
(	City, State, Region, Country, 
        PostalCode, Url, EmailAddress, PhoneNumber, ContactPref, 
        CreatedDate, CreatedBy, UpdatedDate, UpdatedBy)
values
('Test City', 'CA', 'Business Center', 'USA', '99999', 'http://testvolunteer.com/1',
	'testvol1@test.com', null, 'E', current_timestamp, 'rootuser', current_timestamp, 
    'rootuser');

set @vol1 = (SELECT LAST_INSERT_ID());
select @vol1 as Volunteer1ID;

INSERT INTO volbio (
	VolunteerID, Description, WorkHistory, Interests,
	CreatedDate, CreatedBy, UpdatedDate, UpdatedBy
)
Values
(
	@vol1, 'This is a test bio description for volunteer 1', 
	'This is a temporary work history for volunteer 1', 
    null, current_timestamp, 'rootuser', current_timestamp, 'rootuser');


INSERT INTO authusers
    (Role, VolunteerID, 
		OrgID, FirstName, LastName,
        UserName, Password, LastLogin, 
        LastPasswordReset, CreatedDate, 
        CreatedBy, UpdatedDate, UpdatedBy)
    VALUES
    ('V', @vol1, 
		null, 'testuser', 'testlast',
        'testvol1@test.com', PASSWORD('testpass'), current_timestamp, 
        current_timestamp, CURRENT_TIMESTAMP, 
        'rootuser', CURRENT_TIMESTAMP, 'rootuser');


-- insert volunteer skills
INSERT INTO volskills
(VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy)
Values
(@vol1, 1, 6, 1, CURRENT_TIMESTAMP, 'rootuser');

INSERT INTO volskills
(VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy)
Values
(@vol1, 2, 7, 1, CURRENT_TIMESTAMP, 'rootuser');

INSERT INTO volskills
(VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy)
Values
(@vol1, 3, 7, 1, CURRENT_TIMESTAMP, 'rootuser');

-- set @_VolunteerID = @vol1;
INSERT INTO volskills
(VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy)
Values
(@vol1, 9, 1, 0, CURRENT_TIMESTAMP, 'rootuser');

-- set @_VolunteerID = @vol1;
INSERT INTO volskills
(VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy)
Values
(@vol1, 10, 5, 1, CURRENT_TIMESTAMP, 'rootuser');


-- ------------------------------
-- volunteer 2
-- ------------------------------
-- Create second volunteer profile

insert into volprofile 
(	City, State, Region, Country, 
        PostalCode, Url, EmailAddress, PhoneNumber, ContactPref, 
        CreatedDate, CreatedBy, UpdatedDate, UpdatedBy)
values
('Another City', 'IA', 'Suburbs', 'USA', '45450', 'http://testvolunteer.com/2',
	'testvol2@test.com', '9999999999', 'E', current_timestamp, 'rootuser', current_timestamp, 
    'rootuser');

set @vol2 = (SELECT LAST_INSERT_ID());
select @vol2 as Volunteer1ID;

INSERT INTO volbio (
	VolunteerID, Description, WorkHistory, Interests,
	CreatedDate, CreatedBy, UpdatedDate, UpdatedBy
)
Values
(@vol2, 'This is a test bio description for volunteer 2', 
	'This is a temporary work history for volunteer 2', 
    null, current_timestamp, 'rootuser', current_timestamp, 'rootuser');


INSERT INTO authusers
    (Role, VolunteerID, 
		OrgID, FirstName, LastName,
        UserName, Password, LastLogin, 
        LastPasswordReset, CreatedDate, 
        CreatedBy, UpdatedDate, UpdatedBy)
    VALUES
    ('V', @vol2, 
		null, 'testuser2', 'testlast',
        'testvol2@test.com', PASSWORD('testpass'), current_timestamp, 
        current_timestamp, CURRENT_TIMESTAMP, 
        'rootuser', CURRENT_TIMESTAMP, 'rootuser');


-- insert volunteer skills
INSERT INTO volskills
(VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy)
Values
(@vol2, 5, 6, 1, CURRENT_TIMESTAMP, 'rootuser');

INSERT INTO volskills
(VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy)
Values
(@vol2, 6, 7, 1, CURRENT_TIMESTAMP, 'rootuser');

INSERT INTO volskills
(VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy)
Values
(@vol2, 7, 7, 1, CURRENT_TIMESTAMP, 'rootuser');

INSERT INTO volskills
(VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy)
Values
(@vol2, 11, 4, 1, CURRENT_TIMESTAMP, 'rootuser');

INSERT INTO volskills
(VolunteerID, SkillID, ExperienceLevel, IsCurrent, CreatedDate, CreatedBy)
Values
(@vol2, 13, 6, 0, CURRENT_TIMESTAMP, 'rootuser');


-- ------------------------------
-- org 1
-- ------------------------------
-- create an organization
INSERT INTO orgprofile
    (
		Name, Description, Mission, TaxIdentifier, ContactName, ContactEmail,
        ContactPhone, Address1, Address2, City, State, Region,
        Country, PostalCode, EmailAddress, PhoneNumber, Twitter,
        LinkedIn, CreatedDate, CreatedBy, UpdatedDate, UpdatedBy
	)
    VALUES
    (
		'VSS Test NonProfit', 'VSS Test NonProfit is a test nonprofit organization',
        'To boldly finish CST499', 'TestTaxID', 
        'Test Org User', 'testorg1contact@test.com',
        '987-999-0123', '123 Main St', '10th floor', 'Test City', 
        'NY', 'Manhattan', 'USA', '14301', 'testorg1@test.com', 
        '(999) 555-0101', null, null, CURRENT_TIMESTAMP, 'rootuser',
        CURRENT_TIMESTAMP, 'rootuser');

set @org1 = (select last_insert_id());
select @org1 as Org1ID;

-- create the login
INSERT INTO authusers
    (Role, VolunteerID, 
		OrgID, FirstName, LastName,
        UserName, Password, LastLogin, 
        LastPasswordReset, CreatedDate, 
        CreatedBy, UpdatedDate, UpdatedBy)
    VALUES
    ('O', null, 
		@org1, 'Jane', 'Doe',
        'testorg1@test.com', PASSWORD('testpass'), current_timestamp, 
        current_timestamp, CURRENT_TIMESTAMP, 
        'rootuser', CURRENT_TIMESTAMP, 'rootuser');


-- create a project listing
set @_ProjectName = 'Sample Network Installation';
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
set @_StartDate = CAST('2019-08-01' AS DATE);
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

INSERT INTO orgproject
(OrgID, Name, IsActive, Priority, Description,
	StartDate, TimelineDescription, City, State, Region,
	Country, PostalCode, CreatedDate, CreatedBy, UpdatedDate, 
	UpdatedBy)
VALUES
(@org1, @_ProjectName, 1, 'H', @_Description,
	@_StartDate, @_TimelineDescription, @_City, @_State, @_Region,
	@_Country, @_PostalCode, CURRENT_TIMESTAMP, @_CreatedBy, CURRENT_TIMESTAMP, 
	@_CreatedBy);
set @org1project = (select last_insert_id());
select @org1project as Org1ProjectID;

-- insert the necessary skills
/* Network - 7, 8 */
INSERT INTO orgprojectskills
(OrgProjectID, SkillID, Description, IsRequired, CreatedDate, CreatedBy)
VALUES
(@org1project, 7, 'Installation and planning for the new network', 1, CURRENT_TIMESTAMP, 'rootuser');

INSERT INTO orgprojectskills
(OrgProjectID, SkillID, Description, IsRequired, CreatedDate, CreatedBy)
VALUES
(@org1project, 8, 'Administration and assistance for network setup', 0, CURRENT_TIMESTAMP, 'rootuser');

