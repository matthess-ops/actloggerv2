tables

USERS =
id
user_id
password

TIMERS = 
id
user_id, 
main_activities: [[id,main_activity(string),active/nonactive(bool),count]]
sub_activities: [[id,sub_Activiti(string),active/nonactive(bool),count]]
scaled_activites:[[id,scaled_activity(string),active/nonactive(bool)]]
fixed_activities:[[id,fixed_activity,active/nonactive(bool),[id,option,count,active/nonactive(bool)]]]
selected_main_activity: id
selected_sub_activity: id
selected_scaled_activities: [[scaled_activity_id,score]]
selected_fixed_activities:[[fixed_activity_id,option_id]]


experiments:[[id,experiment(String)]]
previousLog: [sub_activity_id,main_Activity_id,fixed_activities[[fixed_activity_id,option_id]
,scaled_activities[[scaled_activity_id,score]]
]]
timer_running: bool
start_time: carbon timestamp

LOGS
id:
user_id:
log_Data: [sub_activity_id,main_Activity_id,fixed_activities[[fixed_activity_id,option_id]
,scaled_activities[[scaled_activity_id,score]]
]]
start_time: carbon timestamp
stop_time: carbon timstamp
elapsed_time: secs

POSTS
id:
user_id:
title: string
post: long string

HELPERS:

class ActivtiesHelpers():

    ////////////filter and or order /////////////

    input: TIMER-main_activities, TIMER-sub_activities
    input var: [[id,activity(string),active/nonactive(bool),count]]
    output var: [[id,activity(string),active/nonactive(bool),count]]
    public function orderMainSubActivities(array(input)):
        - order input array decending on count
        return input

  input: TIMER-fixed_activities
  input var: [[id,fixed_activity,active/nonactive(bool),[[id,option,count,active/nonactive(bool)],....]]
  output var: [[id,fixed_activity,active/nonactive(bool),[[id,option,count,active/nonactive(bool)],....]]
    public function orderFixedActivities(array(input)):
    - order the option subarray for count decending
    return input
    
    ///////////////////// set selected ///////////////

    input var: mainActivityId,userId
    output var: none
    public function setSelectedMainActivity(mainActivityId,userId):
        -for user_id set selected_main_activity value in table TIMER to mainActivityID;
    
  
    input var: subActivityId,userId
    output var: none
    public function setSelectedSubActivity(subActivityId,userId):
        -for user_id set selected_sub_activity value in table TIMER to subActivityID;

    input var: fixedActivities[[fixedActicityId,optionID],...],userId
    output var: none
    public function setSelectedSubActivity(subActivityId,userId):
        -for user_id set selected_sub_activity value in table TIMER to subActivityID;


CONTROLLERS

TIMERCONTROLLER:

use LOGS model
use TIMER model

GET route name: timer
public function dashboardTimerData():
    -get for user_id, main_activites, sub_activites, scaled_activities, fixed_activities, timer_running, start_time experiments from timers table.
    -filterOrderMainSubActivities(main_activities)
    -filterOrderMainSubActivities(sub_activities)
    -filterOrderFixedActivities('')
    -filderOrderScaledActivities('')
    -filterOrderExperiments('')

    - get for user_id all logs of today from timers table
    return view(route(dashboard),[userId,userName,mainActivites, subActivties, scaledActivites,fixedActivites,experiment,logs,timerRunning,startTime])


POST timer.startstop
public function startStopTimer(request request):
    - if timerRunning == true:
        - get for user_id previousLog from TIMERS table
        - store previoursLog, user_id, start_time, stop_time,elapsed_time in LOGS table
        - set timerRunning in TIMER table to false
        - get selected main_activities,sub_acties, fixed, scaled, experiments_activities ids from request and update the corresponding cells in TIMER table for user_id to top = true and increase count with 1 if needed:
        -setTopForMainSubActivities(main_activites, id)

    - else timerRunning == false:
        - set previourslog,start_time for user_id in TIMERS table



TimerController

GET route: timer.dashboard
public function dashboardTimerData():
    -get for user_id

    main_activites
    sub_activites
    scaled_activities
    fixed_activities
    timer_running
    start_time
    selected_main_activity
    selected_sub_activity
    selected_scaled_activities
    selected_fixed_activities
    -get all logs of today for userID

    -order main_activites, sub_activites, fixed_activities for counts

    return view(timer.dashboard)
    selected_main_activity,selected_sub_activity,selected_fixed_activities
    orderd main_activites, sub_activites, fixed_activities, logs


POST timer.startstop
public function startStopTimer(request request):
    if timerRunning == true:
        - set timerRunning = false
        - get previousLog
        - save previousLog, with startTime, stopTime and elapsed time to LOGS TABLE
        - set selected_main_activity,selected_sub_activity,selected_fixed_activities
        to the values from the request


    if timerRunning == false
        - set timerRunning = true
        - set previousLog to request values


    redirect to route( timer.dashboard)


PostController

GET: post.index
public function index():
    - for user_ID get all posts, orderby decending created at
    - paginate stuff
    - view(post.index, posts)

POST: post.store
public function store(request request):
    -create new post model
    - save post request title and body text,userID
    -save to posts table
    -redirect route(post.index)


DELETE: post.delete{id}
public function delete(id):
    -delete post from database with id
    -redirect route(post.index)

PUT: post.update{id}
public function update(rquest id):
    updaet for id the title and text
    -redirect route(post.index)









