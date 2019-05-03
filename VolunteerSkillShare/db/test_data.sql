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

SELECT @vol1 = LAST_INSERT_ID();

set @_Role = 'V';
set @_VolunteerID = null;
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

set @_Role = 'V';
set @_VolunteerID = null;
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

set @_Role = 'O';
set @_VolunteerID = null;
set @_OrgID = null;
set @_FirstName = 'Jane';
set @_LastName = 'Doe';
set @_UserName = 'janedoe@test.com';
set @_Password = 'testpass';
set @_LastLogin = now();
set @_LastPasswordReset = now();
set @_CreatedBy = 'rootuser';
call `cst499-vss`.sp_InsertAuthUser(@_Role, @_VolunteerID, @_OrgID, @_FirstName, @_LastName, @_UserName, @_Password, @_LastLogin, @_LastPasswordReset, @_CreatedBy);
select @_Role, @_VolunteerID, @_OrgID, @_FirstName, @_LastName, @_UserName, @_Password, @_LastLogin, @_LastPasswordReset, @_CreatedBy;



