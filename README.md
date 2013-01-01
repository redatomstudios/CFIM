CFIM
====
- Validation
- Generalized attachment management

Backend Changes
===============
- Add 'On-Going' as status in myProjects
- Remove colon from subsectors in member -> Home and My Projects
- REMOVE UNNECESSARY OUTPUT STREAMS <- interfering with location headers right now when modifying projects etc.
- On failed captcha or failed login, redirect back to login with error <- I'll integrate notificiations at the end

Notes
=====

- Just My Invested Projects left in member accounts, finish that and we're done with member accounts
- Since there's no $comments defined in myProjects, table won't render until that value is passed in