main sub

html:

button:add main sub input event listner addSelectRow
button: create main sub graph event listner createGraph

js code

add to timer main_sub_options/ see below

---------------------------------------------------
dbColumnsToCreateSelectsFor: [main_activities,sub_activities,main_sub_options]/ [scaled_activities]
nameIdsForSelect: [maindID,subId,optionId]/[scaled_id]
divIdToAddRowTo: mainSubRowDiv

const addSelectRow = (dbColumnToCreateSelectsFor,nameIdsForSelect,divIdToAddRowTo) =>{
    -create newRowInputDiv
    -create for each db colum in dbColumnsToCreateSelectsFor an select and add options(id and name) + create an delete button/ event.target.parentNode.remove()
    -add all created select to newRowInputDiv
    -add newRowInputDiv to  divIdToAddRowTo


-------------------------------------------------

nameIdsForSelect: [maindID,subId,optionId]/[scaled_id]

const readSelectInputs = (nameIdsForSelect)=>{
    allSelectInputs = []
    foreach nameId in nameIdsForSelect:
        allSelectInputs.push(nameId data)

    ordererdSelectInputs = []

    order allSelectInputs to create orderSelectInput dictionary

    return orderSelectInputs

return dict =[[mainId:{id:,name:},subId:{id:,name:},optionId:{id:,name:}],'']

}
-------------------------------------------------

selectInput =[[mainId:{id:,name:},subId:{id:,name:},optionId:{id:,name:}],'']

const getLogsForMainSubInputs = (rowInputs)=>{

    foreach rowInput in rowInputs:
        rowInputLogs = []
        foreach log in logs:
            if main[Id] == log[log][main_activities_id]
                
                if subID[id] == 9999:
                    rowInputLogs.push(log)
                else:
                     if subID[id] == log[log][sub_activities_id]:
                        rowInputLogs.push(log)
        rowInputs[logs] = rowInputLogs

    return rowInputLogs
}


return dict =[[mainId:{id:,name:},subId:{id:,name:},optionId:{id:,name:},logs:[log1,log2,logs3]],'']

-------------------------------------

const getLogsStartDates = (logs) =>{
    logDates = []
    foreach log in logs:
        logDates.push(log["start_time"].split(" ")[0]

    - remove double dates
    - order dates
    return dates
}

dates = [2014-09-11, etc]

---------------------------------

rowInputs =[[mainId:{id:,name:},subId:{id:,name:},optionId:{id:,name:},logs:[log1,log2,logs3]],'']

const matchLogsWithDates = (rowInputs)=>
{
    dates = getLogsStartDates
    foeach rowInput in rowInputs:
        logsDated= []
        foreach date in dates:
            logdate = []
            foreach log in logs:
                if log[start_time] == date:
                        logdate.push log
        rowInput[dateOrderdLogs] =logsDated
    return rowInputs
}

rowInputs =[[mainId:{id:,name:},subId:{id:,name:},optionId:{id:,name:},logs:[log1,log2,logs3],datelogs,[[log22, log4],[log5,log6]]],''] 

------------------------------------

rowInputs =[[mainId:{id:,name:},subId:{id:,name:},optionId:{id:,name:},logs:[log1,log2,logs3],datelogs,[[log22, log4],[log5,log6]]],''] 

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

----------------

graphDiv: mainSubDiv

const makeLineGraph = (graphDiv,xaxisLabels,datasets):
    do the stuff here

-----------------------
graphCanvasName: mainSubDiv
const createGraph = ()=>{

    -const mainSubInputs = readSelectInputs ([maindID,subId,optionId])
    -const mainSubInputsWithLogs =getLogsForMainSubInputs(mainSubInputs)
    -const mainSubInputDateLogs =matchLogsWithDates(mainSubInputsWithLogs)
    -const mainSubInputLineData = calculateMainSubGraphData(mainSubInputDateLogs)
    -const graphDataSets = makeLineDataSet(mainSubInputDateLogs)
    -makeLineGraph(mainSubDiv,dates,graphDataSets)


    
}



-------------------------------------------------

SCALED ACTIVITIES SIZZLE
-------------------------------
const readSelectInputs = (nameIdsForSelect)=>{
    allSelectInputs = []
    foreach nameId in nameIdsForSelect:
        allSelectInputs.push(nameId data)


    return orderSelectInputs

return dict =[[mainId:{id:,name:},subId:{id:,name:},optionId:{id:,name:}],'']

}


---------------------

selectInput =[[scaledId:{id:,name:}],'']

const getLogsForScaledInputs = ()=>{



}


const createGraph = ()=>{

    -const mainSubInputs = readSelectInputs ([scaledId])
    -const scaledInputsWithLogs =getLogsForScaledInputs(mainSubInputs)
    -const mainSubInputDateLogs =matchLogsWithDates(mainSubInputsWithLogs)
    -const mainSubInputLineData = calculateMainSubGraphData(mainSubInputDateLogs)
    -const graphDataSets = makeLineDataSet(mainSubInputDateLogs)
    -makeLineGraph(mainSubDiv,dates,graphDataSets)


    
}




