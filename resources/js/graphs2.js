
// dbColumnsToCreateSelectsFor: [main_activities,sub_activities,main_sub_options]/ [scaled_activities]
// nameIdsForSelect: [maindID,subId,optionId]/[scaled_id]
// divIdToAddRowTo: mainSubRowDiv

import { forEach } from "lodash";

// const addSelectRow = (dbColumnToCreateSelectsFor,nameIdsForSelect,divIdToAddRowTo) =>{
//     -create newRowInputDiv
//     -create for each db colum in dbColumnsToCreateSelectsFor an select and add options(id and name) + create an delete button/ event.target.parentNode.remove()
//     -add all created select to newRowInputDiv
//     -add newRowInputDiv to  divIdToAddRowTo


const addSelectRow = (dbColumnsToCreateSelectFor, nameIdsForSelect, divIdToAddRowTo) => {
    let newRowDiv = document.createElement("div");

    dbColumnsToCreateSelectFor.forEach((dbColumnName, index) => {
        let newSelect = document.createElement("select");
        newSelect.setAttribute("name", nameIdsForSelect[index])

        timerData[dbColumnName].forEach(selectOption => {
            let newOption = document.createElement("option");
            newOption.value = selectOption["id"];
            newOption.text = selectOption["name"];
            newSelect.appendChild(newOption);
        });
        newRowDiv.appendChild(newSelect)

    });


    let deleteButton = document.createElement("button");
    deleteButton.textContent = "delete row"
    deleteButton.addEventListener("click", event => {
        event.target.parentNode.remove()
    });

    newRowDiv.appendChild(deleteButton)

    document.getElementById(divIdToAddRowTo).appendChild(newRowDiv)



}








const createNewMainSubInputRow = () => {


    const mainSubRowOptions =
        [
            {
                "id": 0,
                "name": "total time"
            },
            {
                "id": 1,
                "name": "average log time"
            }


        ]

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


const createNewScaledInputRow = () => {


    document.getElementById("addScaledInput").addEventListener("click", event => {
        addSelectRow(["scaled_activities"], ["scaledId"], "scaledInputs")

    });
}

createNewScaledInputRow()


const createNewFixedInputRow = () => {


    document.getElementById("addFixedInput").addEventListener("click", event => {
        addSelectRow(["fixed_activities"], ["fixedId"], "fixedInputs")

    });
}

createNewFixedInputRow()

const readSelectInput = (selectIds) => {
    let selectData = []
    console.log(selectIds)
    selectIds.forEach(selectId => {
        const selectInputs = document.querySelectorAll('[name=' + selectId + ']')
        let select = []
        selectInputs.forEach((selectInput, index) => {
            console.log(selectInput)
            const data = {
                "id": selectInput.value, "text":


                    // selectInputs.find( (tempSelectInput) => tempSelectInput.value === selectInput.value );
                    selectInput.options[index].text


            }
            select.push(data)

        });
        selectData.push(select)


    });

    let selectDicts = []
    const length = selectData[0].length
    for (let index = 0; index < selectData[0].length; index++) {
        let dict = {}
        selectIds.forEach((selectId, indextwo) => {
            dict[selectId] = selectData[indextwo][index]
        });

        selectDicts.push(dict)
    }
    console.log(selectDicts)
    return selectDicts



}

const mainSubMain = () => {
    addSelectRow(["main_activities", "sub_activities", "main_sub_options"], ["mainId", "subId", "optionId"], "mainSubInputs")

    document.getElementById("makeMainSubGraph").addEventListener("click", event => {
        const selectData = readSelectInput(["mainId", "subId", "optionId"])
        if (selectData.length > 0) {
            const selectDataInputLogs = getLogsForMainSubInputs(selectData)
            const selectLogsDateSeperated = seperateLogsForDates(selectDataInputLogs)
            console.log("main sub bla bla")
            console.log(selectLogsDateSeperated)
            const graphData = calculateMainSubGraphData(selectLogsDateSeperated)
            console.log("graph data")
            console.log(graphData)

        } else {

            console.log("erro no main sub data")
        }


    });


}


const scaledMain = () => {
    addSelectRow(["scaled_activities"], ["scaledId"], "scaledInputs")

    document.getElementById("makeScaledGraph").addEventListener("click", event => {
        const selectData = readSelectInput(["scaledId"])
        if (selectData.length > 0) {
            const selectDataInputLogs = getLogsScaledFixedInputs(selectData)
            const selectLogsDateSeperated = seperateLogsForDates(selectDataInputLogs)
            const graphData =calculateScaledGraphData(selectLogsDateSeperated)
            console.log("graph data is")
            console.log(graphData)
        } else {
            console.log("no scaled data")
        }


    });

}

const fixedMain = () => {

    addSelectRow(["fixed_activities"], ["fixedId"], "fixedInputs")
    document.getElementById("makeFixedGraph").addEventListener("click", event => {
        const selectData = readSelectInput(["fixedId"])
        if (selectData.length > 0) {
            const selectDataInputLogs = getLogsScaledFixedInputs(selectData)
            const selectLogsDateSeperated = seperateLogsForDates(selectDataInputLogs)

        } else {
            console.log("no fixed data")
        }


    });
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

mainSubMain()
scaledMain()
fixedMain()


