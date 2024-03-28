<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">
<main class="container">
    <form id="workoutForm" method="post" action='/instance/new'>
        <div class="row">
            <div class="col-sm">
                <label for="name">Workout Name</label><br>
                <input type="text" id="name" name="workout_name"><br>
                <label for="description">Workout Description</label><br>
                <textarea id="description" name="workout_description" rows="3" cols="40"></textarea><br>
                <input type="search" placeholder="Search..">
                <div style="border-style: solid;border-width: 1px;margin-top: 10px;width: 200px">
                    <input type="checkbox" id="dumbbellCheckbox" name="workoutOption" value="Dumbbell" onchange="updateWorkout(this)">
                    <label for="dumbbellCheckbox"> Dumbbell</label><br>
                    <input type="checkbox" id="pushupCheckbox" name="workoutOption" value="Pushup" onchange="updateWorkout(this)">
                    <label for="pushupCheckbox"> Pushup</label><br>
                </div>
            </div>
            <div class="col-sm">
                <h2>Selected Workouts</h2>
            </div>
        </div>
        <div>
            <button class="btn btn-sm" style="margin-top:20px;position: fixed;right: 8%;">Confirm Workout</button>
        </div>
    </form>
</main>
<script src="<?= base_url('js/addWorkout.js') ?>"></script>
<?= $this->endSection() ?>