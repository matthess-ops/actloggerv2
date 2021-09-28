Naming conventions: Database underscore, html name/id also underscore, rest camelCase
Rest normal laravel naming conventions


mainActivities = array[[id1,mainActivity1,active/nonactive],[id2,mainActivity2,active/nonactive]],etc]
subActivities = array[[id1,subActivity1,active/nonactive]],[id2,subActivity2,active/nonactive]],etc]
scaledActivities = array[[id1,scaledActivity1,active/nonactive]],[id2,scaledActivity2,active/nonactive]],etc]
fixedActivities = array[[id1,fixedActivity1, [id1,fixedActivityOption,active/nonactive]]],[id2,fixedActivity2,active/nonactive]]etc]
experiments = [[id,experiment 1],[id,experiment 2],etc]
timerrunning = bool true/false
previous_Log = [mainActivity=>mainActivityID,subActivtiy =>subActivityID etc,startTime]
currentSelection = [mainActivity=>mainActivityID,subActivtiy =>subActivityID etc]


Pages

DASHBOARD: 
-data input = currentSelection,mainActivities,subActivties,scaledActivities,fixedActivities,userName,prvirous_Log

html element: 

h1__timer
form__log
form__select__main_activities, main_activities
form__select__sub_activities, sub_actitivies
form__select__scaled_activities, scaled_activities
form__select__fixed_activities, fixed_activities
form__select__experiments, experiments
form__submit__log

form__post
form__textarea__post
form__submit_post






-previour_selections = the selected options for main,sub,scaled and fixedActivites for the previous log.
- timer = calculates the elapsed time uses previours_log startTime and currenTime
- 


Pages

Dashboard
-input =




Overall stuff:

Make multi user:

Dashboard, configuration, posts ,logs,logs-details-page,Logs-add-log-page, graphs

Dashboard: Shows a timer and all input fields (main/sub activites, scale activites, fixed activities) for a log and a button to start and stop logging. also it contains an field to create posts with a title. Also it shows a bar graph
that display the most important data for today, for example time worked, time relaxtion.

Configuration: create, update, delete values of (main/sub activites, scale activites, fixed activities) plus a save button

Logs: Shows a listing with pagination of the logs. The most recent is on top. Each log has a show button. That brings the user to a detail page. Also contain an button that point to a
manually create log page.


Logs-details-page: On this page the user can change the (main/sub activites, scale activites, fixed activities) inputted values. And saving them.

Logs-create-log-page: On this page the user can manually create a log.

post: listing of all the post. This a a pagination of thepost. Each post is in a textarea plus an update and a delete button.

Graphs: a page used to plot logs data. The user can select a begin and end date. And then can select for each of the (main/sub activites, scale activites, fixed activities)

