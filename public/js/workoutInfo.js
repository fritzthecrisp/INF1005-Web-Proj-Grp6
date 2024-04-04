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

