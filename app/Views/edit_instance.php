<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">
<main class="container">
    <?php if (isset($validation)) : ?>
        <div class="text-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>
    <form id="workoutForm" method="post">
        <div class="row">
            <div class="col-sm">
                <h1 class="title">Edit Workout</h1>
                <div class="mb-3">
                    <label for="workout_name" class="form-label">Workout Name</label><br>
                    <input required type="text" id="workout_name" name="workout_name" class="form-control" value=<?= $workout["workout_name"] ?>><br>
                </div>

                <div class="mb-3">
                    <label for="workout_description" class="form-label">Workout Description</label><br>
                    <textarea required id="workout_description" name="workout_description" rows="3" cols="40" class="form-control"><?= $workout["workout_description"] ?></textarea><br>
                </div>

                <div class="mb-3 search-wrapper">
                    <label for="search" class="form-label">Search Exercises</label><br>
                    <input id='search' type="search" placeholder="Search exercises" class="form-control" data-search>
                </div>
                <div class="mb-3 bd-example d-md-flex">
                    <div class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-dark" id="exercise-list" data-exercise-cards-container>
                    </div>
                </div>
            </div>
            <div class="col-sm" id="selectedWorkouts">
                <h1 class="title">Selected Workouts</h1>
                <?php $counter = 1; ?>
                <?php // Loop through each set
                foreach ($sets as $set) {
                ?>
                    <div id="<?= $set["exer_id"] ?>CheckboxSelected">
                        <p><?= $set["exer_name"] ?></p>
                        <!-- You can add labels and input fields here -->
                        <div class="input-container">
                            <div>
                                <label for="set<?= ($counter) ?>" class="form-label">Sets</label>
                                <input id="set<?= ($counter) ?>" type="text" name="sets[]" class="form-control" value="<?php echo $set['sets']; ?>" required="">
                            </div>
                            <div>
                                <label for="rep<?= ($counter) ?>" class="form-label">Reps</label>
                                <input id="rep<?= ($counter) ?>" type="text" name="reps[]" class="form-control" value="<?php echo $set['reps']; ?>" required="">
                            </div>
                            <div>
                                <label for="weight<?= ($counter) ?>" class="form-label">Weight (Optional)</label>
                                <input id="weight<?= ($counter) ?>" type="text" name="weight[]" class="form-control" value="<?php echo $set['weight']; ?>">
                            </div>
                            <button class="delete-button" aria-label="Delete"><span aria-hidden="true">×</span></button>
                        </div>
                    </div>
                    <?php $counter++; ?>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="workout_public" id="publicCheckBox" class="form-check-input" <?= $workout["checked"] ?>>
            <label class="form-check-label" for="publicCheckBox">
                Make workout Public
            </label>
        </div>
        <div>
            <button type="submit" id="cfmWorkout">Save Changes</button>
        </div>
    </form>
</main>
<script src="<?= base_url('js/addWorkout.js') ?>"></script>
<?= $this->endSection() ?>