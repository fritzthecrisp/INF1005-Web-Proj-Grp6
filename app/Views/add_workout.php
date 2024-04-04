<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">
<main class="container">
    <?php if (isset($validation)) : ?>
        <div class="text-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <?php $session = \Config\Services::session();?>
<?php if ($session->has('logged_in') && $session->get('logged_in') === TRUE): ?>
    <form id="workoutForm" method="post" action='/instance/new'>
        <div class="row">
            <div class="col-sm">
                <h1 class="title">Add Workout</h1>
                <div class="mb-3">
                    <label for="workout_name" class="form-label">Workout Name</label><br>
                    <input required type="text" id="workout_name" name="workout_name" class="form-control"><br>
                </div>

                <div class="mb-3">
                    <label for="workout_description" class="form-label">Workout Description</label><br>
                    <textarea required id="workout_description" name="workout_description" rows="3" cols="40" class="form-control"></textarea><br>
                </div>

                <div class="mb-3 search-wrapper">
                    <label for="search" class="form-label">Search Exercises</label><br>
                    <input id='search' type="search" placeholder="Search exercises" class="form-control" data-search>
                    <div class="mb-3 bd-example d-md-flex">
                        <div class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-dark" id="exercise-list" data-exercise-cards-container>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm" id="selectedWorkouts">
                <h1 class="title">Selected Workouts</h1>
            </div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="workout_public" id="publicCheckBox" class="form-check-input">
            <label class="form-check-label" for="publicCheckBox">
                Make workout Public
            </label>
        </div>
        <div>
            <button type="submit" id="cfmWorkout">Confirm Workout</button>
        </div>
    </form>
</main>
<?php else: ?>
    <p>You must be logged in to view this page.</p>
<?php endif; ?>
<script src="<?= base_url('js/addWorkout.js') ?>"></script>
<?= $this->endSection() ?>