<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">
<main class="container">
    <h1>Edit Workout</h1>
    <form id="workoutForm" method="post" action='/instance/new'>
        <div class="row">
            <div class="col-sm">
                <label for="name">Workout Name</label><br>
                <input type="text" id="name" name="workout_name" value="<?= esc($workout['name']) ?>"><br>
                <label for="description">Workout Description</label><br>
                <textarea id="description" name="workout_description" rows="3" cols="40"><?= esc($workout['description']) ?></textarea><br>
                <input type="search" placeholder="Search..">
                <div style="border-style: solid;border-width: 1px;margin-top: 10px;width: 200px">
                    <input type="checkbox" id="dumbbellCheckbox" name="workoutOption" value="Dumbbell" <?= $workout['options']['Dumbbell'] ? 'checked' : '' ?>>
                    <label for="dumbbellCheckbox"> Dumbbell</label><br>
                    <input type="checkbox" id="pushupCheckbox" name="workoutOption" value="Pushup" <?= $workout['options']['Pushup'] ? 'checked' : '' ?>>
                    <label for="pushupCheckbox"> Pushup</label><br>
                </div>
            </div>
            <input type="hidden" name="workout_id" value="<?= esc($workout['id']) ?>">
            <div class="col-sm selected-workouts"> <!-- Example of adding a unique class -->
                <h2>Selected Workouts</h2>
            </div>
        </div>
        <div>
            <button type="submit" style="margin-top:20px;position: fixed;right: 8%;">Confirm Workout</button>
        </div>
    </form>
</main>
<script src="<?= base_url('js/editWorkout.js') ?>"></script>
<?= $this->endSection() ?>