import moment from 'moment';
import Chart from "chart.js/auto";


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


const createGraphingInput = () => {
    let graphOptionDiv = document.createElement("div");
    let mainActivitiesSelect = createSelection("mainActivitiesSelect", timerData["main_activities"]);
    let subActivtiesSelect = createSelection("subActivitiesSelect", timerData["sub_activities"]);
    let optionsSelect = createSelection("optionsSelect", mainActivityOptions);



    graphOptionDiv.appendChild(mainActivitiesSelect);
    graphOptionDiv.appendChild(subActivtiesSelect);
    graphOptionDiv.appendChild(optionsSelect);

    const div = document.getElementById("graphingInputs");
    div.appendChild(graphOptionDiv);



}
createGraphingInput()

document.getElementById("activityInput").addEventListener("click", event => {

    createGraphingInput()

});

