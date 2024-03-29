document.addEventListener('DOMContentLoaded', function () {
    const predefinedWorkouts = [
        { id: 'dumbbellCheckbox', sets: '3', reps: '12', weight: '15' },
        // Add more predefined workouts here
    ];
    initializeWorkouts(predefinedWorkouts);
    
    const checkboxes = document.querySelectorAll('input[name="workoutOption"]');
    
    // Loop through each checkbox and attach event listener
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Call updateWorkout function passing the clicked checkbox
            updateWorkout(this);
        });
    });
});

function updateWorkout(checkbox, sets = '', reps = '', weight = '') {
    var value = checkbox.value;
    var id = checkbox.id + "Selected"; // Adding "Selected" to create unique id

    var selectedWorkoutsDiv = document.querySelector(".selected-workouts");

    if (checkbox.checked) {
        var workoutDiv = document.getElementById(id);
        if (!workoutDiv) {
            workoutDiv = document.createElement("div");
            workoutDiv.id = id;

            var pElement = document.createElement("p");
            pElement.textContent = value;
            workoutDiv.appendChild(pElement);

            var inputContainer = document.createElement("div");
            inputContainer.classList.add("input-container");

            // Function to create and append input elements for sets, reps, and weight
            function appendInputElements(labelText, inputId, inputName, inputValue) {
                var div = document.createElement("div");
                var labelElement = document.createElement("label");
                labelElement.setAttribute("for", inputId);
                labelElement.textContent = labelText;
                var inputElement = document.createElement("input");
                inputElement.setAttribute("type", "text");
                inputElement.setAttribute("id", inputId);
                inputElement.setAttribute("name", inputName);
                inputElement.classList.add("form-control");
                inputElement.value = inputValue;

                div.appendChild(labelElement);
                div.appendChild(inputElement);
                inputContainer.appendChild(div);
            }

            appendInputElements("Sets", "sets" + id, "sets[]", sets);
            appendInputElements("Reps", "reps" + id, "reps[]", reps);
            appendInputElements("Weight (Optional)", "weight" + id, "weight[]", weight);

            workoutDiv.appendChild(inputContainer);
            selectedWorkoutsDiv.appendChild(workoutDiv);
        }
    } else {
        var existingDiv = document.getElementById(id);
        if (existingDiv) {
            existingDiv.remove();
        }
    }
}


function initializeWorkouts(predefinedWorkouts) {
    predefinedWorkouts.forEach(workout => {
        const checkbox = document.getElementById(workout.id);
        if (checkbox) {
            checkbox.checked = true;
            updateWorkout(checkbox, workout.sets, workout.reps, workout.weight); // Adjust the function to accept sets, reps, weight
        }
    });
}
