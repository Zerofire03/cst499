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
select @_Role, @_VolunteerID, @_OrgID, @_FirstName, @_LastName, @_UserName, @_Password, @_LastLogin, @_LastPasswordReset, @_CreatedBy;

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
set @_Address1 = '0';
set @_Address2 = '0';
set @_City = 'Test City';
set @_State = 'NY';
set @_Region = 'Manhattan';
set @_Country = 'USA';
set @_PostalCode = '14301';
set @_EmailAddress = 'testorg1@test.com';
set @_PhoneNumber = '0';
set @_Twitter = '0';
set @_LinkedIn = '0';
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertOrgProfile(@_Description, @_Mission, @_TaxIdentifier, @_ContactName, @_ContactEmail, @_ContactPhone, @_Address1, @_Address2, @_City, @_State, @_Region, @_Country, @_PostalCode, @_EmailAddress, @_PhoneNumber, @_Twitter, @_LinkedIn, @_CreatedBy);

set @org1 = (select last_insert_id());
select @org1 as Org1ID;

set @_Role = 'O';
set @_VolunteerID = null;
set @_OrgID = @org1;
set @_FirstName = 'Jane';
set @_LastName = 'Doe';
set @_UserName = 'janedoe@test.com';
set @_Password = 'testpass';
set @_LastLogin = now();
set @_LastPasswordReset = now();
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertAuthUser(@_Role, @_VolunteerID, @_OrgID, @_FirstName, @_LastName, @_UserName, @_Password, @_LastLogin, @_LastPasswordReset, @_CreatedBy);
select @_Role, @_VolunteerID, @_OrgID, @_FirstName, @_LastName, @_UserName, @_Password, @_LastLogin, @_LastPasswordReset, @_CreatedBy;

