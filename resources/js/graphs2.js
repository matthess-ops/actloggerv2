
// dbColumnsToCreateSelectsFor: [main_activities,sub_activities,main_sub_options]/ [scaled_activities]
// nameIdsForSelect: [maindID,subId,optionId]/[scaled_id]
// divIdToAddRowTo: mainSubRowDiv

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
    deleteButton.textContent="delete row"
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

    timerData["sub_activities"].push(  {
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






// scaledInputs
// addScaledInput
