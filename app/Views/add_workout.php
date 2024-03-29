<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">
<main class="container">
    <h1>Add Workout</h1>
    <form id="workoutForm" method="post" action='/instance/new'>
        <div class="row">
            <div class="col-sm">
                <label for="name">Workout Name</label><br>
                <input type="text" id="name" name="workout_name"><br>
                <label for="description">Workout Description</label><br>
                <textarea id="description" name="workout_description" rows="3" cols="40"></textarea><br>

                <div class="search-wrapper">
                    <label for="search">Search Users</label>
                    <input id='search' type="search" placeholder="Search exercises" data-search>
                    <div class="bd-example d-md-flex">
                        <div class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-dark" data-exercise-cards-container style="max-width: 260px; max-height: 100px;">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm">
                <h2>Selected Workouts</h2>
            </div>
        </div>
        <div>
            <input type="checkbox" id="publicCheckBox" name="publicWorkout" value="Public">
            <label for="publicCheckBox"> Make Public</label><br>
            <button type="submit" style="margin-top:20px;position: fixed;right: 8%;">Confirm Workout</button>
        </div>
    </form>
</main>
<script src="<?= base_url('js/addWorkout.js') ?>"></script>
<?= $this->endSection() ?>