Overview:

Dashboard contains 3 parts, a timer part, post part and a graphbar part.

-timer part is responsible for showing the elapsed time since the previours inputted log,
also it contains a submit button to start and stop a log. Also it has various selects to change
the inputted variables of the log. The timer is incremented with javascript

-Post part contains a title input, and main body input and a submit button.

-Graphbar is just and element, but it is built by javascript.

html elements ids/name

h1__timer
form__log
form__select__main_activities/ main_activities
form__select__sub_activities/ sub_actitivies
form__select__scaled_activities/ scaled_activities
form__select__fixed_activities/ fixed_activities
form__select__experiments/ experiments
form__submit__log


form__post
form__input__post_title, title
form__input__post_body, body
form__submit__post

Input data needed from server:
user_id, main_activities,sub_actitivies,scaled_activities,fixed_activities,experiments,
currentSelections,timer_running, previous_Log

timers table:
Eacht user has its own row containing the following headers.

user_id = 1
main_activities = [[id,main_activity,active/nonactive,current],[id,main_activity,active/nonactive]]
sub_actitivies = [[id,sub_activity,active/nonactive],[id,sub_activity,active/nonactive]]
scaled_activities = [[id,scaled_activity,active/nonactive],[id,scaled_activity,active/nonactive]]
fixed_activities = [[id,fixed_activity,[[id,option_1,[id,option_@]]]],etc]
experiments  = [[id,experiment1],[id,experiment2]]
currentSelections = [main_activity=>id,sub_activity=>id, scaled_Activities =>[id, intvalue,id,intvalue etc] ]
timer_running = true/false
previous_Log = same as currentSelection but now with start_time added, use unix timestamp
id = auto makde
timestamps = also auto made

posts table

id
title
post
user_id


STEPS------------

php artisan make:model -m Timer set fillable and json casts
php artisan make:model -m Post  = set fillable
php artisan make:model -m Log = set fillable and json casts
php artisan make:controller TimerController -- index (timer.blade), store(store timer submit)
php artisan make:controller LogController --resource will need all the crud stuff
php artisan make:controller PostController --resource will need all the crud stuff
php artisan make:controller MainActivitiesController --resource will need all the crud stuff
php artisan make:controller SubActivitiesController --resource will need all the crud stuff
php artisan make:controller FixedActivitiesController --resource will need all the crud stuff
php artisan make:controller ScaledActivitiesController --resource will need all the crud stuff
Helper file contain all the filterAndOrder functions, Also set stop and increment count function use all the controllers for normal stuff.

php artisan make:seed TimerSeeder
php artisan make:seed PostSeeder
php artisan make:seed LogSeeder

views
    timer

    log
        index, edit 

    post index, edit



development_blades folder
    timer_development
        timer_development.blade.php = add needed html element in a container
    log_development
log_index_development.blade.php
log_index_development.blade.php


timer.blade.php = add the html elements start with container making it easer to add navbar later


IETS OVER HET hoofd gezien nadenken over multiple, fixed and scaled options dus al die values opslaan


//changes

order the option in sub, main activities to the last one followd by the ones that are used most


main_activities = [[id,main_activity,active/nonactive,is_top(true/false),count]] //same for sub
scaled_activities = [[id,scaled_activity,active/nonactive],[id,scaled_activity,active/nonactive]]

fixed_activities = [[id,fixed_activity,active/nonactive,top_option_id,[[id,option_1,active/nonactive]]

timerController:

private function filterOrderActivities(): //works for main and sub activities
    -throw out all nonactives
    -order main activities top first followd by order count
    return array [[main_activity_id,main_activity],[id,main_activity]]

private function filterOrderScaledActivities():
    -throw out all nonactive scaled activities and options
    return [[scaled_activity_id, scaled_activity,score],[etc]]

private function filterOrderFixedActivities():
    -throw out all nonactive fixed activities and options

    return [[fixed_activity_id, fixed_activity,[[fixed_activity_option_id, fixed_Activity_option]]]

MainActivitiesController():
    import the needed function from ActivitiesHelperController


SubActivitiesController():
    import the needed function from ActivitiesHelperController



ActivitiesHelperController
        public function filterOrderActivities(): //works for main and sub activities
    -throw out all nonactives
    -order main activities top first followd by order count
    return array [[main_activity_id,main_activity],[id,main_activity]]

    public function store():
        see if main activity is previously set to non active/ then put to active
        else add new main activy to array, creat new index
    public function update():
        rename main activity in array and save() //
    public function delete():
        set main acitvy to non active


TimerController:

    main_activties = MainACtivitiesController::filterOrderbla bla
    sub_actiies = SubActivitiesControler:filderorder function



S




///import uit andere controller uitzoeken.
https://stackoverflow.com/questions/45004604/how-to-make-a-custom-helper-function-available-in-every-controller-for-laravel
    


filter and order stuff in helper functions drukken




