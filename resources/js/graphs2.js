import moment from 'moment';
// import Chart from "chart.js/auto";
import Chart from 'chart.js/auto'
import { arrayExpression } from '@babel/types';
import { data } from 'jquery';

import { forEach } from "lodash";
//array to pick colors from
const colorScheme = [
    "#25CCF7",
    "#FD7272",
    "#54a0ff",
    "#00d2d3",
    "#1abc9c",
    "#2ecc71",
    "#3498db",
    "#9b59b6",
    "#34495e",
    "#16a085",
    "#27ae60",
    "#2980b9",
    "#8e44ad",
    "#2c3e50",
    "#f1c40f",
    "#e67e22",
    "#e74c3c",
    "#ecf0f1",
    "#95a5a6",
    "#f39c12",
    "#d35400",
    "#c0392b",
    "#bdc3c7",
    "#7f8c8d",
    "#55efc4",
    "#81ecec",
    "#74b9ff",
    "#a29bfe",
    "#dfe6e9",
    "#00b894",
    "#00cec9",
    "#0984e3",
    "#6c5ce7",
    "#ffeaa7",
    "#fab1a0",
    "#ff7675",
    "#fd79a8",
    "#fdcb6e",
    "#e17055",
    "#d63031",
    "#feca57",
    "#5f27cd",
    "#54a0ff",
    "#01a3a4",
];

//dbColumnsToCreateSelectFor = ["main_activities","sub_activities",options] or ["scaled_activities"]
//nameIdsForSelect = ["mainId",subId,optionId]/ ["scaledId"]
//divIdToAddRowTo = mainSubSelectRows/ scaledSelectRows
// function create selects with options from de db column from dbColumnsToCreateSelectFor
// each select gets an nameId identifier from nameIdsForSelect
// also an delte button is added
// these are added to the divIdToAddRowTo div.
const addSelectRow = (dbColumnsToCreateSelectFor, nameIdsForSelect, divIdToAddRowTo) => {
    let newRowDiv = document.createElement("div");
    newRowDiv.setAttribute("class", "form-group form-inline mb-1")

    dbColumnsToCreateSelectFor.forEach((dbColumnName, index) => {
        let newSelect = document.createElement("select"); // creating the select
        newSelect.setAttribute("name", nameIdsForSelect[index])
        newSelect.setAttribute("class", "form-control mr-1 mb-1")

        timerData[dbColumnName].forEach(selectOption => {
            let newOption = document.createElement("option"); // creating the options
            newOption.value = selectOption["id"];
            newOption.text = selectOption["name"];
            newSelect.appendChild(newOption);
        });
        newRowDiv.appendChild(newSelect)

    });

    //delete button
    let deleteButton = document.createElement("button");
    deleteButton.textContent = "remove"
    deleteButton.setAttribute("class","btn btn-primary form-control ")
    deleteButton.addEventListener("click", event => {
        event.target.parentNode.remove()
    });

    newRowDiv.appendChild(deleteButton)

    document.getElementById(divIdToAddRowTo).appendChild(newRowDiv)



}


// creates a new main and sub activity select input row
const createNewMainSubInputRow = () => {

    // since a select is made by passing the db column of interest
    // in the addSelectRow() function. And the options doesnt exist
    // in timerData. The options are added to timerData
    // FIX: kinda messy fix in the next version
    const mainSubRowOptions =
        [
            {
                "id": 0,
                "name": "total time"
            },
            {
                "id": 1,
                "name": "ave logtime"
            }


        ]

    //all does not exists sub_activities db column. Therefore it is added to the sub_activities db column.
    // for the same reason as mainSubRowOptions above
    timerData["sub_activities"].push({
        "id": 9999,
        "name": "All"
    })

    timerData["main_sub_options"] = mainSubRowOptions


    document.getElementById("addMainSubInput").addEventListener("click", event => {
        addSelectRow(["main_activities", "sub_activities", "main_sub_options"], ["mainId", "subId", "optionId"], "mainSubInputs")

    });
}

createNewMainSubInputRow()

// creates and adds a scaled activity select input row
const createNewScaledInputRow = () => {


    document.getElementById("addScaledInput").addEventListener("click", event => {
        addSelectRow(["scaled_activities"], ["scaledId"], "scaledInputs")

    });
}

createNewScaledInputRow()

//creates and add an fixed activity select input row
const createNewFixedInputRow = () => {


    document.getElementById("addFixedInput").addEventListener("click", event => {
        addSelectRow(["fixed_activities"], ["fixedId"], "fixedInputs")

    });
}

createNewFixedInputRow()

//selectIds = mainId, subId, scaledId etc
// this function is used to read the selected input of the select of interest,
// multiple rows can exist with the same selectId.
const readSelectInput = (selectIds) => {
    let selectData = []
    selectIds.forEach(selectId => {
        // if multiple selects with the same selectId exist the query selector will yield an array
        const selectInputs = document.querySelectorAll('[name=' + selectId + ']')
        let select = []
        selectInputs.forEach((selectInput, index) => {
            //id: selected value of the select, text: selected text of the select
            const data = {
                "id": selectInput.value, "text":
                selectInput.options[selectInput.options.selectedIndex].text
            }
            select.push(data)

        });
        selectData.push(select)


    });

    // the data of the various selects input arrays need to be orderd
    // into select input rows.
    let selectDicts = []
    const length = selectData[0].length
    for (let index = 0; index < selectData[0].length; index++) {
        let dict = {}
        selectIds.forEach((selectId, indextwo) => {
            dict[selectId] = selectData[indextwo][index]
        });

        selectDicts.push(dict)
    }

    return selectDicts



}

const addDayToGraphLabels = (dates)=>{
    const formatted = dates.map((date) =>{

        let momentDate = moment(date, 'YYYY-MM-DD')
        const weekDay = momentDate.format('ddd')
        return weekDay +" "+momentDate.format("DD-MM-YYYY")

    }
       )

    return formatted
}

// main function that listens to create an main /sub activities graph
const mainSubMain = () => {
    addSelectRow(["main_activities", "sub_activities", "main_sub_options"], ["mainId", "subId", "optionId"], "mainSubInputs")

    document.getElementById("makeMainSubGraph").addEventListener("click", event => {
        const selectData = readSelectInput(["mainId", "subId", "optionId"])

        if (selectData.length > 0) {
            const selectDataInputLogs = getLogsForMainSubInputs(selectData)
            const selectLogsDateSeperated = seperateLogsForDates(selectDataInputLogs)
            const graphData = calculateMainSubGraphData(selectLogsDateSeperated)
            const graphDataSets = makeMainSubDataSets(graphData)

            makeGraph(graphDataSets,addDayToGraphLabels(graphData[0]["dates"]),"mainSubChart",'main and sub activity graphs')



        } else {

            console.log("erro no main sub data")
        }


    });


}

//function that listens to create and scaled activity graph
const scaledMain = () => {
    addSelectRow(["scaled_activities"], ["scaledId"], "scaledInputs")

    document.getElementById("makeScaledGraph").addEventListener("click", event => {
        const selectData = readSelectInput(["scaledId"])
        if (selectData.length > 0) {
            const selectDataInputLogs = getLogsScaledFixedInputs(selectData)
            const selectLogsDateSeperated = seperateLogsForDates(selectDataInputLogs)
            const graphData =calculateScaledGraphData(selectLogsDateSeperated)
            const graphDataSets = makeScaledDatasets(graphData)
            makeGraph(graphDataSets,addDayToGraphLabels(graphData[0]["dates"]),"scaledChart",'scaled activities graphs')

        } else {
            console.log("no scaled data")
        }


    });

}
//function that listens to create and fixed activity bar graph

const fixedMain = () => {

    addSelectRow(["fixed_activities"], ["fixedId"], "fixedInputs")
    document.getElementById("makeFixedGraph").addEventListener("click", event => {
        const selectData = readSelectInput(["fixedId"])
        if (selectData.length > 0) {
            const selectDataInputLogs = getLogsScaledFixedInputs(selectData)
            const selectLogsDateSeperated = seperateLogsForDates(selectDataInputLogs)
            const optionIds = getAllFixedAssociatedOptionIds(selectLogsDateSeperated)
            const optionNames = getFixedAssociatedOptionIdsNames(optionIds)
            const graphData = calculateFixedGraphData(optionNames)
            const bargraphDataSets = makeFixedDatasets(graphData)
            createCanvas(bargraphDataSets)
            barGraphFixed(bargraphDataSets, addDayToGraphLabels(bargraphDataSets[0]["dates"]))

            console.log("bargraphDataSets")
            console.log(bargraphDataSets)





        } else {
            console.log("no fixed data")
        }


    });
}

//generate the required chartjs data format for fixed activities calculated graph data.
const makeFixedDatasets = (rowInputs)=>{

    rowInputs.forEach(rowInput => {
        let data = []
        Object.keys(rowInput["optionsDateValues"]).forEach((key,index) => {
            const optionDateValue = rowInput["optionsDateValues"][key]
            data.push({
                label: rowInput["optionNames"][index],
                backgroundColor: colorScheme[index],
                data: optionDateValue,
              })

        });
        rowInput["data"] = data;

    });

    return rowInputs

}

// sums the elapsed_time of all the logs of a particular dates
// and returns these in the correct format

// loop through each rowInput
// loop through each option id
// loop thorugh each datechuck
// loop throught each datechuck log
// if the log has the correct fixed activity id and fixed activity option id
// sum the elapsed_time for each chuck

const calculateFixedGraphData = (rowInputs)=>{
    rowInputs.forEach(rowInput => { // each select select row
        let dateDateValues = {}
        rowInput["fixedOptionIds"].forEach(rowInputOptionId => { // loop through the fixed option ids
            let optionIdDateValues = []
            rowInput["dateLogs"].forEach(dateChunk => { // loop through the datechucks
                let sumDateChunk = 0
                dateChunk.forEach(log => {
                    log["log"]["fixed_activities_ids"].forEach(fixedAct => {
                        // look if the log has the same fixed Id and optionId of the rowInput and loop
                        if(fixedAct["id"] == rowInput["fixedId"]["id"]){
                            if(rowInputOptionId ==fixedAct["option_id"] ){
                                sumDateChunk = sumDateChunk+ log["elapsed_time"]
                            }
                        }
                    });
                });
                optionIdDateValues.push(sumDateChunk)
                dateDateValues[rowInputOptionId] = optionIdDateValues
            });

        });
        rowInput["optionsDateValues"] = dateDateValues
    });

    return rowInputs

}


const getFixedAssociatedOptionIdsNames = (rowInputs)=>{
    rowInputs.forEach(rowInput => {
        let optionNames = []
        rowInput["fixedOptionIds"].forEach(rowInputOptionId => {
            timerData["fixed_activities"].forEach(fixed_activity => {
                if(fixed_activity["id"] ==rowInput["fixedId"]["id"] ) //correct fixed activity
                fixed_activity["options"].forEach(option => {
                    if(option["id"] == rowInputOptionId){
                        const optionName = option["name"]
                        optionNames.push(optionName)
                    }
                });
            });
        });
        rowInput["optionNames"]= optionNames
    });
    return rowInputs
}




const getAllFixedAssociatedOptionIds = (rowInputs)=>{
    // console.log(selectDataInputLogs)
    rowInputs.forEach(rowInput => {
        let allOptionIds = []

        rowInput["logs"].forEach(log => {
            log["log"]["fixed_activities_ids"].forEach(element => {
                if(element["id"] ==rowInput["fixedId"]["id"]){
                    allOptionIds.push(element["option_id"])
                }
            });



            // console.log(    log["log"]["fixed_activities_ids"])
        });
        const uniqueOptionIds = [...new Set(allOptionIds)].sort()
        rowInput["fixedOptionIds"] = uniqueOptionIds

    });

    return rowInputs

}





const getLogsScaledFixedInputs = (rowInputs) => {

    rowInputs.forEach(rowInput => {
        rowInput["logs"] = logs
    });

    return rowInputs

}


const getLogsForMainSubInputs = (rowInputs) => {
    rowInputs.forEach(rowInput => {
        let rowInputLogs = []
        logs.forEach(log => {
            if (log["log"]["main_activity_id"] == rowInput["mainId"]["id"]) {
                if (rowInput["subId"]["id"] == "9999") {
                    rowInputLogs.push(log)
                } else {
                    if (log["log"]["sub_activity_id"] == rowInput["subId"]["id"]) {
                        rowInputLogs.push(log)

                    }

                }
            }
        });
        rowInput["logs"] = rowInputLogs
    });
    return rowInputs
}

const getAllLogDates = () => {

    const allStartDates = logs.map(log => log["start_time"].split(" ")[0]);
    const uniqueDate = [...new Set(allStartDates)]
    return uniqueDate.sort();



}

const seperateLogsForDates = (rowInputs) => {
    const dates = getAllLogDates()
    rowInputs.forEach(rowInput => {
        rowInput["dates"] = dates
        let datesLogs = []
        dates.forEach(date => {
            const dateLogs = rowInput["logs"].filter(log => log["start_time"].split(" ")[0] == date)
            datesLogs.push(dateLogs)
        });
        rowInput["dateLogs"] = datesLogs
    });
    return rowInputs

}

const calculateMainSubGraphData = (rowInputs) => {

    rowInputs.forEach(rowInput => {


        let sumElapsedTime = []
        let averageElapsedTime = []
        rowInput.dateLogs.forEach(dateChunk => {
            let dateValue = 0
            dateChunk.forEach(log => {
                dateValue = dateValue + log["elapsed_time"]
            });
            sumElapsedTime.push(dateValue)
            averageElapsedTime.push(dateValue / dateChunk.length)

        });

        if (rowInput.optionId.id == 0) { //total time

            rowInput["calculatedLineData"] = sumElapsedTime


        } else if (rowInput.optionId.id == 1) { // average log tim
            rowInput["calculatedLineData"] = averageElapsedTime

        }



    });
    return rowInputs

}

const calculateScaledGraphData = (rowInputs)=>{
    rowInputs.forEach(rowInput => {

        let averageScores = []
        rowInput.dateLogs.forEach(dateChunk => {
            let sumScore = 0
            dateChunk.forEach(log => {
                // console.log("score found ",log["log"]["scaled_activities_ids"].find(element =>element["id"] ==rowInput["scaledId"]["id"] ).score)
                sumScore =sumScore+ log["log"]["scaled_activities_ids"].find(element =>element["id"] ==rowInput["scaledId"]["id"] ).score
            });
            averageScores.push(sumScore / dateChunk.length)

        });


        rowInput["calculatedLineData"] = averageScores


    });


    return rowInputs
}

// for each row input
    // rowinputdateArray = []
//for each optionid
// datearray = []

// loop through datechucks
    // totalOptionid time  = 0
    // for each log in datechuck:
        //add elapsed time to totaloptionid time
    //add to datearray

// rowinput["optionGraphdata"] = [option1, option2]
// rowinputdateArray add






// const calculateFixedGraphData = (rowInputs)=>{
//     rowInputs.forEach(rowInput => {
//         let dateData = []
//         rowInput.dateLogs.forEach(dateChunk =>{
//             let optionIdsTotalCounts = []
//             rowInput["fixedOptionIds"].forEach(id => {
//                 optionIdsTotalCounts.push(0)
//             });
//             dateChunk.forEach(log => {




//                 rowInput["fixedOptionIds"].forEach((id,index) => {
//                     log["log"]["fixed_activities_ids"].forEach(fixedOptionId => {
//                         // console.log("id =",id,fixedOptionId)
//                         if(id ==fixedOptionId["option_id"] ){
//                             optionIdsTotalCounts[index] = optionIdsTotalCounts[index]+log["elapsed_time"]
//                         }
//                     });

//                 });
//             });

//             dateData.push(optionIdsTotalCounts)


//         })
//         rowInput["graphData"] = dateData
//     });
//     return rowInputs
// }

const makeMainSubDataSets = (inputRows) => {
    //     label: 'Dataset 2',
    //     data: Utils.numbers(NUMBER_CFG),
    //     borderColor: Utils.CHART_COLORS.blue,
    //     backgroundColor: Utils.transparentize(Utils.CHART_COLORS.blue, 0.5),


    let data = []
    inputRows.forEach((inputRow,index) => {
        const temp = {
            label: inputRow["mainId"]["text"]+" "+inputRow["subId"]["text"]+" "+inputRow["optionId"]["text"],
            data:inputRow.calculatedLineData,
            backgroundColor: colorScheme[index],
            borderColor:colorScheme[index],
        }
        console.log(temp)
        data.push(temp)
    });
    return data
}


const makeScaledDatasets = (inputRows) => {
    //     label: 'Dataset 2',
    //     data: Utils.numbers(NUMBER_CFG),
    //     borderColor: Utils.CHART_COLORS.blue,
    //     backgroundColor: Utils.transparentize(Utils.CHART_COLORS.blue, 0.5),


    let data = []
    inputRows.forEach((inputRow,index) => {
        const temp = {
            label: inputRow["scaledId"]["text"],
            data:inputRow.calculatedLineData,
            backgroundColor: colorScheme[index],
            borderColor:colorScheme[index], }
        data.push(temp)
    });
    return data
}

// niet nodig
const footer = (tooltipItems) => {
    let sum = 0;

    tooltipItems.forEach(function(tooltipItem) {
      sum += tooltipItem.parsed.y;
    });
    return 'Total: ' + sum;
  };

const makeGraph = (lineData, labels,canvasId,text) => {
    document.getElementById(canvasId).remove() // remove the previous chart/canvas, because chartjs prevent overriding previouly made charts

    let newCanvas = document.createElement('canvas');
    newCanvas.id = canvasId
    document.getElementById("canvasDiv").appendChild(newCanvas) // create a new canvas

    const test = new Chart(document.getElementById(canvasId), {
        type: "line",

        data: {
            labels: labels,
            datasets: lineData,
        },
        options: {
            responsive: true,
            interaction: {
                intersect: false,
                mode: 'index',
              },

            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: text
                },
                tooltip: {
                    callbacks: {
                        footer: footer,
                    }
                  },

            },

        },
    });

    test.update()

}


const createCanvas = (inputRows) =>{

    try{
        document.getElementById("fixedGraphs").innerHTML = ""
        // document.getElementById(inputRow["fixedId"]["text"]).remove() // remove the previous chart/canvas, because chartjs prevent overriding previouly made charts

    }catch(error){
        console.log(error)
    }

    inputRows.forEach(inputRow => {



        let canvas = document.createElement('canvas');
        // canvas.setAttribute("style","min-height: 100px")
        // canvas.setAttribute("style","min-width: 100px")

        canvas.setAttribute("style","background-color: red: red")

        canvas.id = inputRow["fixedId"]["text"]
        document.getElementById("fixedGraphs").appendChild(canvas)
    });
}

            // barGraphFixed(bargraphDataSets[0]["data"], bargraphDataSets[0]["dates"],"fixedChart","fixed bar graph")

const barGraphFixed = (inputRows, labels) => {

    inputRows.forEach(inputRow => {


        // let lineData = inputRow["data"]

    const test = new Chart(document.getElementById(inputRow["fixedId"]["text"]), {


            type: "bar",

            data: {
                labels: labels,
                datasets: inputRow["data"]
            },
            options: {
                plugins: {
                  title: {
                    display: true,
                    text: inputRow["fixedId"]["text"]
                  },
                  tooltip: {
                    callbacks: {
                        footer: footer,
                    }
                  },
                },
                responsive: true,
                scales: {
                  x: {
                    stacked: true,
                  },
                  y: {
                    stacked: true
                  }
                }
              }
        });


    test.update()
});
}





mainSubMain()
scaledMain()
fixedMain()


const newFormat = addDayToGraphLabels(["2021-11-23"])
console.log(newFormat)
