window.addEventListener('resize', function () {
    var workoutDetailsRow = document.getElementById('workoutDetails');
    if (window.innerWidth <= 992) {
        workoutDetailsRow.classList.add('justify-content-center');
        workoutDetailsRow.classList.add('text-center');
    } else {
        workoutDetailsRow.classList.remove('justify-content-center');
        workoutDetailsRow.classList.remove('text-center');
    }
});


// // Assuming you have an array of exercise details
// var exerciseDetails = [
//     { name: "Exercise 1", sets: 3, reps: 12, weights: 0 },
//     { name: "Exercise 2", sets: 4, reps: 10, weights: 20 },
//     // Add more exercise details as needed
// ];

// // Get the table body element
// var tableBody = document.querySelector("#exerciseTable tbody");

// // Clear any existing rows in the table body
// tableBody.innerHTML = '';

// // Loop through exercise details array and dynamically create table rows
// exerciseDetails.forEach(function(exercise) {
//     var row = document.createElement('tr');
//     row.innerHTML = `
//         <td>${exercise.name}</td>
//         <td>${exercise.sets}</td>
//         <td>${exercise.reps}</td>
//         <td>${exercise.weights}</td>
//     `;
//     tableBody.appendChild(row);
// });