CFIM
====
- Generalized attachment management

Backend Changes
===============
- Add 'On-Going' as status in myProjects
- REMOVE UNNECESSARY OUTPUT STREAMS <- interfering with location headers right now when modifying projects etc.

Final Sweep Changes
===================
*Italicised text denotes a completed task*
**Emphasized text denotes a NOTE**


Admin
-----
- Home: 
> - Completed

- Add New Project
> - *Remove ANY from project leader/member selection* <-Fixed
> - *Require all fields for project creation*
> - *Fix undefined offset: 1 on line 43, newProject.php*

- Modify Existing Project
> - *All required*
> - *Fix undefined offset: 1 on line 43, newProject.php*

- Add New Member
> - *Only require Member Name, Username, Password, Rank, Title, Status*
> - *Check for repeating usernames before adding to DB*
> - *Check member exclusion when selected as project leader*

- Modify Current Member
> - *Don't require password here*
> - *If password is set, then that means change password*
> - *List name instead of username in dropdown when selecting member to edit*
> - *Check member exclusion when selected as project leader*

- Statistics
> - Integrate view **<- View completed, statistics.php. Use dashboard.php without passing $dates for listing projects**
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
> - *Viewing of project attachments*
> - *Viewing of update/expense attachments*
> - *Viewing for expense vouchers*
> - *When displaying update, Expenses, Voucher and Review should be blank*
> - *Reviewed By Finance should be: Approved, Rejected or Pending*

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
> - *Viewing of project attachments*
> - *Hide agree button if member has already agreed*

Supervisor
----------
- Home
> - Add ANY option for project leader and member dropdowns
> - *Return total 'expenses' from backend for each project*

- View Project
> - Adding root comments, comments and responses aren't working right now
> - Adding update or expenses not working right now
> - After adding comment, response, expense or update, user is redirected to home. User should be redirected back to this project.

- Change Password
> - *Change password isn't working for supervisor yet either. I guess you just need to copy the controller fn and view from member >_>*

Finance
-------
- Home
> - *Process form to filter results*

- View Project
> - *Process form to Approve/Reject*
> - *Display Vouchers*
> - Get voucher as array for each expense in $expense['vouchers']

- Change Password
> - *Uh, this isn't redirecting properly now, I thought the passwordChange was independent of member rank? I only saw member/changePassword in controller.*