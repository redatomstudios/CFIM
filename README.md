CFIM
====
- Generalized attachment management

Backend Changes
===============
- Add 'On-Going' as status in myProjects
- REMOVE UNNECESSARY OUTPUT STREAMS <- interfering with location headers right now when modifying projects etc.

Final Sweep Changes
===================

Admin
-----
- Home: 
> - Completed

- Add New Project
> - Remove ANY from project leader/member selection
> - Require all fields for project creation
> - Fix undefined offset: 1 on line 43, newProject.php

- Modify Existing Project
> - All required
> - Fix undefined offset: 1 on line 43, newProject.php

- Add New Member
> - Only require Member Name, Username, Password, Rank, Title, Status
> - Check for repeating usernames before adding to DB
> - Check member exclusion when selected as project leader

- Modify Current Member
> - *Don't* require password here
> - *If* password is set, then that means *change password*
> - List name instead of username in dropdown when selecting member to edit
> - Check member exclusion when selected as project leader

- Statistics
> - Integrate view
> - test

- Logout
> - Completed

Member - Project Member
-----------------------
- Home: 
> - Completed

- My Projects
> - Completed

- My Invested Projects
> - Completed

- Change Password
> - Completed

- Logout
> - Completed

- Viewing a project
> - Viewing of project attachments
> - Viewing of update/expense attachments
> - Viewing for expense vouchers
> - When displaying update, Expenses, Voucher and Review should be blank ( Might be able to accomplish this in FE just check if Expenses is 0 )
> - Reviewed By Finance should be: Approved, Rejected or Pending

Member - Not Project Member
---------------------------
- Home: 
> - Completed

- My Projects
> - Completed

- My Invested Projects
> - Completed

- Change Password
> - Completed

- Logout
> - Completed

- Viewing a project
> - Viewing of project attachments
> - Hide agree button is member has already agreed

Supervisor
----------
Pending

Finance
-------
Pending