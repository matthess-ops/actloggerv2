3 parts

1: main,sub,options  (total time and average log time) all three are selects
2: scaled activities line graph only one select, average score for the day
3: fixed activities bar graph, only one select. Each bar consist of its options. total time

-----------------------
event listners

-add main sub button
-add scaled activities button
-add fixed activities button

-create main sub graph button
-create scaled graph button
-create fixed graph button

----------------------------------
selectsArray: [[main_activities],[sub_activities + [id:9999,name:All]],[[id:0,name: total time], [,,,average log time]]] / [[scaled_activities]]
selectNameIdens: [mainId,subID,optionId] etc
mainDivId: mainSubOptionList


 const addSelectRow  = (selectsArray,selectNameIdens,mainDivId) =>
    -create a selectDiv
    - create for each select in select array and select (name = mainID) plus options (value = id, text = name)
    -create an delete button        event.target.parentNode.remove()
    - add all selects to selectdiv
    -add selectdiv to mainDivId


------------------------------------

selectNameIdens = [mainId,subID,optionId]
logIden = [main_activities,sub_activities, none]
const readSelectRowInput = (selectNameIdens)
    allQuerySelectInput = []
    foreach selectNameIdens do a queryselect of the name
        allQuerySelectInput.push data

    orderSelectInput = [{mainID {id,name, logIden},subID{id, name, logIden}, etc}]
    forech allQuerySelectInput
        order the data in allqueryselectinput in orderselectInput 
    return allqueryselectinput

-------------------------------


selectInputArray = [{mainID {id,name, logIden},subID{id, name, logIden}, etc}]
whichGraph = mainSub,fixed,scaled

const getMainSubRowInputLogs = (selectInputArray,mainSub)
allselectInputArray = []
    loop throught all selectInputArray
        logs = []
        loop through logs:
            if mainID[id] == log[log][main_activities_id]:

                if subID[id] == 9999:
                    logs.push(log)
                else:
                     if subID[id] == log[log][sub_activities_id]:
                        logs.push(log)

        selectInputArray[logs] = logs

    return allselectInputArray


const getScaledRowInputLogs 
const getFixedRowInputLogs 

---------------------------

dateLogs = logs
const getLogsInputDates = (dateLogs) = >
    logDates = []
    foreach log in logs:
        logDates.push(log["start_time"].split(" ")[0]
    return unique ordered logDates



----------------------------------------

rowInputs:[{mainID {id,name, logIden},subID{id, name, logIden}, optionID{id,name},logs: [logs]}]
const splitLogsOverDates = (rowInputs) = >
    dates = getLogsInputDates()
    foreach rowInput in rowInputs:
        foreach date in dates:
            dateLogs = []
            foreach log in logs:
                if log[start_time] == date:
                    dateLogs.push log

            rowInputs[orderdDates] = dateLogs
    return rowInputs


output:[{mainID {id,name, logIden},subID{id, name, logIden}, 
optionID{id,name},logs: [logs],dateLogs: [[dateLogs],[dateLogs],[dateLogs]]}]


----------------

rowInputs:[{mainID {id,name, logIden},subID{id, name, logIden}, 
optionID{id,name},logs: [logs],datesLogs: [[logs],[logs],[logs]]}]

const calculateMainSubGraphData= (rowInputs)=>

    foreach rowinput in rowinputs:
        lineValues = []

 
            foreach dateLogs in datesLogs:

                totalTime = 0
                foreach log in logs:
                    totalTime =totalTime +log["elapsedTime"]
                if optionID == 0:
                    lineValues.push(totaltime)
                if optionID = 1:
                \   lineValues.push(totaltime/logs.length)
        rowinput[lineValues] = lineValues
    return rowInputs

out:[{mainID {id,name, logIden},subID{id, name, logIden}, 
optionID{id,name},logs: [logs],datesLogs: [[logs],[logs],[logs]],lineData:[10,3,5,4 etc]}]
------------------------------------

rowInputs:[{mainID {id,name, logIden},subID{id, name, logIden}, 
optionID{id,name},logs: [logs],datesLogs: [[logs],[logs],[logs]]}

const makeLineDataSet = (rowInput)=>{
    datasets= []
    forach rowInput in rowInputs:
        make labels
         //     label: 'Dataset 2',
    //     data: Utils.numbers(NUMBER_CFG),
    //     borderColor: Utils.CHART_COLORS.blue,
    //     backgroundColor: Utils.transparentize(Utils.CHART_COLORS.blue, 0.5),
        add to datasets



}
-------------------------------

grapDiv: mainSubDiv 

const makeLineGraph = (graphDiv,xaxisLabels,datasets):
    do the stuff here





