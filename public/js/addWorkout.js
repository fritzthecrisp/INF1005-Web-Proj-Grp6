console.log("I am attached to instance/new page");
// console.log('Cached data:', data);

const exerciseCardContainer = document.querySelector("[data-exercise-cards-container]")
const searchInput = document.querySelector("[data-search]")

let exercises = []
// Here is the search Event listener
searchInput.addEventListener("input", (e) => {
    const value = e.target.value.toLowerCase()
    exercises.forEach(exercise => {

        const isVisible = exercise.exer_name.toLowerCase().includes(value)
        exercise.exer_card.classList.toggle("hide", !isVisible);
    })
})

fetch('http://localhost/api/get-exercises')
    .then(res => res.json())
    .then(data => {
        exercises = data.map(exercise => {
            // Create exerciseCard element.
            const exerciseCard = document.createElement('div')
            exerciseCard.classList.add('exercise-card');

            // Create checkbox element
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.id = `${exercise.exer_id}Checkbox`;
            checkbox.name = 'workoutOption[]';
            checkbox.value = exercise.exer_id;
            checkbox.dataset.exerciseName = exercise.exer_name; // Store exercise name in dataset
            checkbox.addEventListener('change', function () {
                updateWorkout(this); // Call updateWorkout function on checkbox change
            });

            // Set accessibility for the checkbox
            checkbox.setAttribute('aria-label', `${exercise.exer_name}`);

            // Create label element
            const label = document.createElement('label');
            label.htmlFor = `${exercise.exer_id}Checkbox`;
            label.innerText = exercise.exer_name;

            // Append checkbox and label to container
            exerciseCard.appendChild(checkbox);
            exerciseCard.appendChild(label);
            exerciseCard.appendChild(document.createElement('br')); // Line break
            exerciseCardContainer.appendChild(exerciseCard);


            // const card = exerciseCardTemplate.content.cloneNode(true).children[0] // child of the card template. 

            //     // Handle the cached data here
            // console.log('Cached data:', data);
            //     // Use the cached data as needed
            //     // For example, update the UI with the cached data
            return { exer_name: exercise.exer_name, exer_id: exercise.exer_id, exer_card: exerciseCard }
        })
    })



function updateWorkout(checkbox) {
    // Get the value and id of the checkbox
    let exercise_name = checkbox.dataset.exerciseName;
    let id = checkbox.id + "Selected"; // Adding "new ID will be <exer_id>CheckboxSelected" to create unique id
    let exercise_id = checkbox.id.replace(/Checkbox/g, '');
    if (checkbox.checked) {
        // Create a new div element
        var workoutDiv = document.createElement("div");

        // Create a new p element
        var pElement = document.createElement("p");
        pElement.textContent = exercise_name;

        var hiddenElement = document.createElement("input");
        hiddenElement.setAttribute("type", "hidden");
        hiddenElement.setAttribute("name", "exercises[]");
        hiddenElement.setAttribute("value", exercise_id);
        hiddenElement.classList.add("form-control");

        // pElement.classList.add("form-control");


        workoutDiv.appendChild(pElement);

        // Create a container div for horizontal text inputs
        var inputContainer = document.createElement("div");
        inputContainer.classList.add("input-container");

        // Create a new div for each input
        var setDiv = document.createElement("div");
        var repsDiv = document.createElement("div");
        var weightDiv = document.createElement("div");
        var deleteDiv = document.createElement("div");

        // Create a new label element for "Sets"
        var labelElement1 = document.createElement("label");
        labelElement1.setAttribute("for", "sets");
        labelElement1.classList.add("form-label");
        labelElement1.textContent = "Sets";
        var inputElement1 = document.createElement("input");
        inputElement1.setAttribute("type", "text");
        inputElement1.setAttribute("name", "sets[]");
        inputElement1.classList.add("form-control");

        // Create a new label element for "Reps"
        var labelElement2 = document.createElement("label");
        labelElement2.setAttribute("for", "reps");
        labelElement2.classList.add("form-label");
        labelElement2.textContent = "Reps";
        var inputElement2 = document.createElement("input");
        inputElement2.setAttribute("type", "text");
        inputElement2.setAttribute("name", "reps[]");
        inputElement2.classList.add("form-control");

        // Create a new label element for "Weight"
        var labelElement3 = document.createElement("label");
        labelElement3.setAttribute("for", "weight");
        labelElement3.classList.add("form-label");
        labelElement3.textContent = "Weight (Optional)";
        var inputElement3 = document.createElement("input");
        inputElement3.setAttribute("type", "text");
        inputElement3.setAttribute("name", "weight[]");
        inputElement3.setAttribute("value", 0);
        inputElement3.classList.add("form-control");

        // Create a new button for deleting the row
        var deleteBtn = document.createElement("button");
        deleteBtn.className = "delete-button"; // Set the class name for styling
        deleteBtn.setAttribute("aria-label", "Delete"); // Set aria-label attribute for accessibility
        // deleteBtn.classList.add('form-control');

        // Create a span element for the "x" icon
        var deleteIcon = document.createElement("span");
        deleteIcon.setAttribute("aria-hidden", "true");
        deleteIcon.innerHTML = "&times;"; // Insert the "x" symbol into the span

        // Append the delete icon to the delete button
        deleteBtn.appendChild(deleteIcon);

        // Add click event listener to the delete button
        deleteBtn.addEventListener('click', function () {
            // Perform delete action here
            checkbox.checked = false;
            updateWorkout(checkbox);
        });

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
        inputContainer.appendChild(deleteBtn);

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
