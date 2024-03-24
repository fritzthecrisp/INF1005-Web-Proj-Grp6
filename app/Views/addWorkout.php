<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">
<main class="container">
    <div class="row">
        <div class="col-sm">
            <h1>Push 1</h1>
            <h2>Description</h2>
            <input type="text" placeholder="Search..">
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
        <button style="margin-top:20px;position: fixed;right: 8%;">Confirm Workout</button>
    </div>
</main>
<script src="<?= base_url('js/workout.js') ?>"></script>
<?= $this->endSection() ?>