import moment from 'moment';
import Chart from "chart.js/auto";
import { floor } from 'lodash';


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

const timer = () => {
    let secondElapsed = (moment().subtract(moment().parseZone().utcOffset(), 'minutes').unix() - moment(startTime).unix());
    if (timerRunning == true) {


        setInterval(function () {
            secondElapsed = secondElapsed + 1;
            const formatted = moment.utc(secondElapsed * 1000).format('HH:mm:ss');
            document.getElementById("timerH3").innerText = formatted;

        }, 1000);

    }
}

timer();

console.log(logs);

//get all unique main activity  and sub activity ids from log data.

const getMainAndSubIds = (logs) => {
    let mainIds = [];
    let subIds = [];
    logs.forEach(log => {
        mainIds.push(log["log"]["main_activity_id"]);
        subIds.push(log["log"]["sub_activity_id"]);

    });

    return [[... new Set(mainIds)], [... new Set(subIds)]]


}

const makeMainSubCountArray = (mainSubIds) => {
    const mainIds = mainSubIds[0]
    const subIds = mainSubIds[1]
    console.log(mainIds)
    console.log(subIds)
    let matrix = {};
    subIds.forEach(subId => {
        let temp = {}
        mainIds.forEach(mainId => {
            temp[mainId] = 0
        });
        matrix[subId] = temp;
    });

    return matrix;


}


const calcAddLogTime = (matrix, logs) => {
    logs.forEach(log => {
        matrix[log["log"]["sub_activity_id"]][log["log"]["main_activity_id"]] =
        matrix[log["log"]["sub_activity_id"]][log["log"]["main_activity_id"]]+ floor(log["elapsed_time"]/60)

    });
    return matrix
}



const getMainActivityLabelNames = (mainIds,mainActivitiesData) =>{
    let labelNames = []
    mainIds.forEach(mainId => {
                mainActivitiesData.forEach(mainActivity => {
                    if(mainActivity["id"] == mainId){
                        labelNames.push(mainActivity["name"])
                    }
                });
            });

    return labelNames
}


const generateGraphData = (matrix,colors,subActivitiesData)=>
{
    // const data = [{
    //     label: 'Employee',
    //     backgroundColor: "#caf270",
    //     data: [12, 59, 5, 56, 58,12, 59, 87, 45],
    //   }, {
        // colorScheme

    let data = []

    const matrixSubActivitiesIds =  Object.keys(matrix)
    matrixSubActivitiesIds.forEach(subActId => {
        let subActName = ""
        const color = colors[subActId]
        const dataValues = Object.values(matrix[subActId])
        subActivitiesData.forEach(subActivity => {
            if(subActivity["id"] ==subActId ){
                subActName = subActivity["name"]
            }
        });
        data.push({
            label: subActName,
            backgroundColor: color,
            data: dataValues,
          })
    });

    return data
}

// create the graph
const makeGraph = (columns, labels) => {
    var ctx = document.getElementById("chart");

    var myChart = new Chart(ctx, {
        type: "bar",

        data: {
            labels: labels,
            datasets: columns,
        },
        options: {
            plugins: {
              title: {
                display: true,
                text: 'Main/sub activity statisticss'
              },
            },
            tooltips: {
                // Overrides the global setting
                mode: 'label'
            },
            responsive: true,
            scales: {
              x: {
                stacked: true,
              },
              y: {
                stacked: true,


              },

            },


          }
    });

}

const mainSubIds = getMainAndSubIds(logs)
const matrix = makeMainSubCountArray(mainSubIds)
const labelNames =getMainActivityLabelNames(mainSubIds[0],timerData["main_activities"])
const elapsedTimeMatrix =calcAddLogTime(matrix,logs)
const barData = generateGraphData(elapsedTimeMatrix,colorScheme,timerData["sub_activities"])






makeGraph(barData, labelNames)

