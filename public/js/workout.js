function updateWorkout(checkbox) {
    // Get the value and id of the checkbox
    var value = checkbox.value;
    var id = checkbox.id + "Selected"; // Adding "Selected" to create unique id

    if (checkbox.checked) {
        // Create a new div element
        var workoutDiv = document.createElement("div");

        // Create a new p element
        var pElement = document.createElement("p");
        pElement.textContent = value;

        workoutDiv.appendChild(pElement);

        // Create a container div for horizontal text inputs
        var inputContainer = document.createElement("div");
        inputContainer.classList.add("input-container");

        // Create a new div for each input
        var setDiv = document.createElement("div");
        var repsDiv = document.createElement("div");
        var weightDiv = document.createElement("div");

        // Create a new label element for "Sets"
        var labelElement1 = document.createElement("label");
        labelElement1.setAttribute("for", "sets");
        labelElement1.classList.add("form-label");
        labelElement1.textContent = "Sets";
        var inputElement1 = document.createElement("input");
        inputElement1.setAttribute("type", "text");
        inputElement1.setAttribute("id", "sets");
        inputElement1.setAttribute("name", "sets");
        inputElement1.classList.add("form-control");

        // Create a new label element for "Reps"
        var labelElement2 = document.createElement("label");
        labelElement2.setAttribute("for", "reps");
        labelElement2.classList.add("form-label");
        labelElement2.textContent = "Reps";
        var inputElement2 = document.createElement("input");
        inputElement2.setAttribute("type", "text");
        inputElement2.setAttribute("id", "reps");
        inputElement2.setAttribute("name", "reps");
        inputElement2.classList.add("form-control");

        // Create a new label element for "Weight"
        var labelElement3 = document.createElement("label");
        labelElement3.setAttribute("for", "weight");
        labelElement3.classList.add("form-label");
        labelElement3.textContent = "Weight (Optional)";
        var inputElement3 = document.createElement("input");
        inputElement3.setAttribute("type", "text");
        inputElement3.setAttribute("id", "weight");
        inputElement3.setAttribute("name", "weight");
        inputElement3.classList.add("form-control");

        // Append elements to the div
        setDiv.appendChild(labelElement1);
        setDiv.appendChild(inputElement1);
        repsDiv.appendChild(labelElement2);
        repsDiv.appendChild(inputElement2);
        weightDiv.appendChild(labelElement3);
        weightDiv.appendChild(inputElement3);

        inputContainer.appendChild(setDiv);
        inputContainer.appendChild(repsDiv);
        inputContainer.appendChild(weightDiv);

        workoutDiv.appendChild(inputContainer);

        // Set the id of the div
        workoutDiv.id = id;

        // Append the div to the "Selected Workouts" div
        document.querySelector(".col-sm:nth-child(2)").appendChild(workoutDiv);
    } else {
        // Remove the selected workout div if checkbox is unchecked
        var selectedDiv = document.getElementById(id);
        if (selectedDiv) {
            selectedDiv.remove();
        }
    }
}
