<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">

<main class="container">

    <h1 class="title">Workout Sessions</h1>
    <hr>
    <div class="myWorkoutContainer card-headings">
        <h2 class="title">My Workouts</h2>
        <a href="<?php echo base_url('create/instance/new'); ?>" class="green-button">Create your Own Workouts</a>
    </div>
    <p>Here are a list of exisitng workouts you have saved and created. Creating a new one? Click on the "Create your Own Workouts" button to begin!</p>


    <!-- Cards -->
    <div class="card-container" id="myWorkout-container">
        <div class="row">
            <?php foreach ($myWorkouts as $myWorkout) : ?>
                <?php
                $arialabelMyWorkoutName = "My Workout - " . $myWorkout['workout_name']
                ?>
                <?php $myWorkoutImg =  "my_workoutImg_" . $myWorkout['workout_name']
                ?>
                <div class="col-md-6 mb-4 card-border">
                    <a href="<?= site_url("instance/details/{$myWorkout['instance_id']}") ?>" class="exercise-link card-link" aria-label="<?= $arialabelMyWorkoutName ?>">
                        <div class="myWorkout cards">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="card-img" src="<?= $imgURLs . $myWorkout['workout_image'] . "?raw=true" ?>" alt="<?= $myWorkoutImg ?>">
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <div class="text-section">
                                            <h3 class="card-title title"><?= $myWorkout['workout_name'] ?></h3>
                                            <h4 class="card-subtitle mb-2">Made by <?= $myWorkout['user_name'] ?></h4>
                                            <p class="card-text"><?= $myWorkout['workout_description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <hr>

    <div class="card-headings">
        <h2 class="title">Recommended Workouts For You</h2>
        <p> Here are our recommended workouts for you. Click below to find out more! </p>
    </div>

    <!-- Cards -->
    <div class="card-container" id="recommendedWorkout-container">
        <div class="row">
            <?php foreach ($recommendedWorkouts as $recommendedWorkout) : ?>
                <?php
                $arialabelRecommendedWorkoutName = "Recommended Workout - " . $recommendedWorkout['workout_name']
                ?>
                <?php $recommendedWorkoutImg =  "rec_workoutImg_" . $recommendedWorkout['workout_name']
                ?>
                <div class="col-md-6 mb-4 card-border">
                    <a href="<?= site_url("workout/details/{$recommendedWorkout['instance_id']}") ?>" class="exercise-link card-link" aria-label="<?= $arialabelRecommendedWorkoutName ?>">
                        <div class="recommendedWorkout cards">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="card-img" src="<?= $imgURLs . $recommendedWorkout['workout_image'] . "?raw=true" ?>" alt="<?= $recommendedWorkoutImg ?>">
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <div class="text-section">
                                            <h3 class="card-title title"><?= $recommendedWorkout['workout_name'] ?></h3>
                                            <h4 class="card-subtitle mb-2">User ID: <?= $recommendedWorkout['user_name'] ?></h4>
                                            <p class="card-text"><?= $recommendedWorkout['workout_description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="buttonsbelowCards">
        <form action="<?= site_url("/publicWorkout") ?>" method="get">
            <button type="submit">Explore more Recommended Workouts</button>
        </form>
    </div>
</main>
<script src="<?= base_url('js/main.js') ?>"></script>
<?= $this->endSection() ?>