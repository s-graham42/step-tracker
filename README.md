StepTracker Readme

sessfasteptracker.org

This tiny webapp allows users to add their pedometer steps to the database for each day of
the SESSFA Move a Thon.  The total steps for all kid users and all adult users are then
shown on the results page.

Move a thon start date (first day a user can add steps for): April 19th 2024
Move a thon end date (last date a user can add steps for): May 3rd 2024

Before the Move a thon start date, we will empty the kid steps and adult steps tables:

in phpmyadmin:
- select table ('kid_steps')
- go to 'Operations' tab.
- select 'Empty the table (TRUNCATE)'
- confirm