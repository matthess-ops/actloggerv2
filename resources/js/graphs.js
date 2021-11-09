import moment from 'moment';
import Chart from "chart.js/auto";
import { arrayExpression } from '@babel/types';
import { data } from 'jquery';

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


const mainActivityOptions =
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


const createSelection = (selectionId, selectOptions) => {
    let select = document.createElement("select");
    select.id = selectionId;
    selectOptions.forEach(selectOption => {
        let newOption = document.createElement("option");
        newOption.value = selectOption["id"];
        newOption.text = selectOption["name"];
        select.appendChild(newOption);
    });

    if (selectionId == "subActivitiesSelect") {
        let newOption = document.createElement("option");
        newOption.value = 9999;
        newOption.text = "All";
        select.appendChild(newOption);
    }

    return select;
};


const createGraphingInput = (rowIdIndex, idPrefix) => {
    let graphOptionDiv = document.createElement("div");
    graphOptionDiv.setAttribute("name", idPrefix); //+"@"+ rowIdIndex
    let idSpan = document.createElement("span");
    idSpan.textContent = rowIdIndex

    let mainActivitiesSelect = createSelection("mainActivitiesSelect", timerData["main_activities"]);
    mainActivitiesSelect.setAttribute("name", "mainActivitiesNameId")
    let subActivtiesSelect = createSelection("subActivitiesSelect", timerData["sub_activities"]);
    subActivtiesSelect.setAttribute("name", "subActivitiesNameId")

    let optionsSelect = createSelection("optionsSelect", mainActivityOptions);
    optionsSelect.setAttribute("name", "optionsNameId")

    let deleteRow = document.createElement("button");
    deleteRow.addEventListener("click", event => {
        event.target.parentNode.remove()

    });
    deleteRow.innerHTML = "delete row"
    deleteRow.setAttribute("name", "deleteRow")


    graphOptionDiv.appendChild(idSpan);

    graphOptionDiv.appendChild(mainActivitiesSelect);
    graphOptionDiv.appendChild(subActivtiesSelect);
    graphOptionDiv.appendChild(optionsSelect);
    graphOptionDiv.appendChild(deleteRow);

    const div = document.getElementById("graphingInputs");
    div.appendChild(graphOptionDiv);



}

const listenDeleteRow = () => {
    // document.getElementsByName("deleteRow").addEventListener("click", event => {
    //     // const beh =document.getElementsByName("deleteRow")
    //     console.log("lefack")
    // });

    // document.getElementsByName("deleteRow").addEventListener("click", event => {
    //     // rowIdIndex = rowIdIndex+1
    //     // createGraphingInput(rowIdIndex,idPrefix)

    // });

}

listenDeleteRow()

const makeMainActivitiesOptions = () => {
    const idPrefix = "main"
    let rowIdIndex = 0
    createGraphingInput(rowIdIndex, idPrefix)

    document.getElementById("activityInput").addEventListener("click", event => {
        rowIdIndex = rowIdIndex + 1
        createGraphingInput(rowIdIndex, idPrefix)

    });
}


makeMainActivitiesOptions()

const filterLogs = (optionsArray) => {
    let lineArrays = []
    optionsArray.forEach(option => {
        let optionLogs = []
        logs.forEach(log => {
            if (log["log"]["main_activity_id"] == option[0]) {

            }

            if (option[1] == 9999) {
                optionLogs.push(log)

            } else {
                if (log["log"]["sub_activity_id"] == option[1]) {
                    optionLogs.push(log)

                }
            }
        });
        lineArrays.push(optionLogs)
        console.log(optionLogs.length)
    });

    return lineArrays


}
const getAllLogDates = () => {

    const allStartDates = logs.map(log => log["start_time"].split(" ")[0]);
    const uniqueDate = [...new Set(allStartDates)]
    return uniqueDate;



}

const dateSeperated = (lineArrays) => {
    const dates = this.getAllLogDates()
    let seperated = []

    lineArrays.forEach(lineArray => {
        let datesArray = []
        dates.forEach(date => {
            let logsSeperatedOnDate = []
            lineArray.forEach(log => {
                if (log["start_time"].split(" ")[0] == date) {
                    logsSeperatedOnDate.push(log)
                }
            });
            datesArray.push(logsSeperatedOnDate)
        });
        seperated.push(datesArray)
    });
    return seperated
}


const separateOnDate = (lineArrays) => {
    const dates = getAllLogDates()
    console.log(dates)
    let seperated = []
    lineArrays.forEach(lineArray => {
        let datesArray = []
        dates.forEach(date => {
            let logsSeperatedOnDate = []
            lineArray.forEach(log => {
                if (log["start_time"].split(" ")[0] == date) {
                    logsSeperatedOnDate.push(log)
                }
            });
            datesArray.push(logsSeperatedOnDate)
        });
        seperated.push(datesArray)
    });
    return seperated
}

const calculateValues = (dateSeperated, graphOptionsArrays) => {
    let allLines = []
    console.log("graph otpoins " + graphOptionsArrays)
    graphOptionsArrays.forEach((graphOption, index) => {
        const optionId = graphOption[2]
        if (optionId == 0) { //som values
            let lineValues = []
            dateSeperated[index].forEach(logs => {
                let totalTime = 0
                logs.forEach(log => {
                    totalTime = totalTime + log["elapsed_time"]
                });
                lineValues.push(totalTime)
            });
            allLines.push(lineValues)


        }
        if (optionId == 1) { // average log values
            let lineValues = []
            dateSeperated[index].forEach(logs => {
                let totalTime = 0
                logs.forEach(log => {
                    totalTime = totalTime + log["elapsed_time"]
                });
                lineValues.push(totalTime / logs.length)
            });
            allLines.push(lineValues)
        }
    });

    return allLines

}

// labels: labels,
// datasets: [
//   {
//     label: 'Dataset 1',
//     data: Utils.numbers(NUMBER_CFG),
//     borderColor: Utils.CHART_COLORS.red,
//     backgroundColor: Utils.transparentize(Utils.CHART_COLORS.red, 0.5),
//   },
//   {
//     label: 'Dataset 2',
//     data: Utils.numbers(NUMBER_CFG),
//     borderColor: Utils.CHART_COLORS.blue,
//     backgroundColor: Utils.transparentize(Utils.CHART_COLORS.blue, 0.5),
//   }
// ]

// create the graph
const makeGraph = (lineData, labels) => {
    document.getElementById("logsChart").remove() // remove the previous chart/canvas, because chartjs prevent overriding previouly made charts

    let newCanvas = document.createElement('canvas');
    newCanvas.id = "logsChart"
    document.getElementById("canvasDiv").appendChild(newCanvas) // create a new canvas

    const test = new Chart(document.getElementById("logsChart"), {
        type: "line",

        data: {
            labels: labels,
            datasets: lineData,
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Line Chart'
                }
            }
        },
    });

    test.update()

}


const makeLineLabels = (graphOptionsArrays) => {
    let labels = []
    graphOptionsArrays.forEach(options => {
        const mainActivitiesName = timerData["main_activities"].find(main_activity => main_activity["id"] == options[0])["name"]
        let subActivitiesName = null
        if (options[1] != 9999) {
            subActivitiesName = timerData["sub_activities"].find(sub_activity => sub_activity["id"] == options[1])["name"]

        } else {
            subActivitiesName = "All"
        }

        const optionName = mainActivityOptions.find(option => option["id"] == options[2])["name"]
        const labelName = mainActivitiesName + " " + subActivitiesName + " " + optionName
        labels.push(labelName)

    });
    return labels
}

const makeDataSets = (lineValues,labels) => {
    //     label: 'Dataset 2',
    //     data: Utils.numbers(NUMBER_CFG),
    //     borderColor: Utils.CHART_COLORS.blue,
    //     backgroundColor: Utils.transparentize(Utils.CHART_COLORS.blue, 0.5),
    let data = []
    lineValues.forEach((line,index) => {
        const temp = {
            label: labels[index],
            data:line,
            borderColor: colorScheme[index],
        }
        data.push(temp)
    });
    return data
}


const getUserGraphInput = () => {
    document.getElementById("makeGraph").addEventListener("click", event => {


        const mainSelects = document.querySelectorAll('[name=mainActivitiesNameId]')
        const subSelects = document.querySelectorAll('[name=subActivitiesNameId]')
        const optionSelects = document.querySelectorAll('[name=optionsNameId]')

        let graphOptionsArrays = []

        mainSelects.forEach((mainSelect, index) => {
            graphOptionsArrays.push([mainSelect.value, subSelects[index].value, optionSelects[index].value])
        });

        // console.log(graphOptionsArrays)
        const lineArrays = filterLogs(graphOptionsArrays)
        const dateSeperated = separateOnDate(lineArrays)
        const calculatedValues = calculateValues(dateSeperated, graphOptionsArrays);
        // console.log(dateSeperated)
        // console.log(calculatedValues)
        const labelNames = makeLineLabels(graphOptionsArrays)
        const dates = getAllLogDates()
        const graphData = makeDataSets(calculatedValues,labelNames)
        console.log(dates)
        makeGraph(graphData,dates)
    });

}


getUserGraphInput()
