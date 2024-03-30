<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">

<main class="container">
    <h1>Workout Sessions</h1>
    <hr>

    <div class="myWorkoutContainer">
        <h2>My Workouts</h2>
        <a href="<?php echo base_url('instance/new'); ?>" class="green-button">Create your Own Workout</a>
    </div>
    <p>Here are a list of exisitng workouts you have saved and created. Creating a new one? Click on the "Create your Own Workout button" to begin!</p>

    <div class="card-container" id="myWorkout-container">
        <?php foreach ($myWorkouts as $myWorkout) : ?>
            <?php
            $arialabelMyWorkoutName = "My Workout - " . $myWorkout['workout_name']
            ?>
            <?php $myWorkoutImg =  "my_workoutImg_" . $myWorkout['workout_name']
            ?>
            <a href="<?= site_url("workout/details/{$myWorkout['instance_id']}") ?>" class="exercise-link card-link" aria-label=<?= $arialabelMyWorkoutName ?>>
                <div class="myWorkout cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src=<?= $imgURLs . $myWorkout['workout_image'] . "?raw=true"?> alt=<?= $myWorkoutImg ?>>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <div class="text-section">
                                    <h4 class="card-title"><?= $myWorkout['workout_name'] ?></h4>
                                    <h5 class="card-subtitle mb-2">Made by <?= $myWorkout['user_name'] ?></h5>
                                    <p class="card-text"><?= $myWorkout['workout_description'] ?></p>
                                </div>
                                <div class="button-section">
                                    <form action="<?= site_url("workout/details/{$myWorkout['instance_id']}") ?>" method="get">
                                        <button type="submit">View</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        <div class="buttons">
            <button class="btn btn-primary btn-next"><i class="material-icons">arrow_right</i></button>
        </div>
    </div>

    <hr>

    <h2>Create a Workout by Physical Trainers</h2>
    <p>Unsure how to create your workout? Here are a list of workouts created by our physical trainers! Click below to find out more and start your workout journey!</p>
    <div class="card-container" id="physicalTrainers-container">
        <?php foreach ($physicalTrainers as $physicalTrainer) : ?>
            <a href="<?= site_url("workout/details/{$physicalTrainer['id']}") ?>" class="exercise-link card-link">
                <div class="physicalTrainers cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src="/img/image.png" alt="PTworkoutImg">
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <div class="text-section">
                                    <h3 class="card-title"><?= $physicalTrainer['workout_name'] ?></h3>
                                    <h4 class="card-subtitle mb-2">Made by <?= $physicalTrainer['made_by'] ?></h4>
                                    <p class="card-text"><?= $physicalTrainer['description'] ?></p>
                                </div>
                                <div class="button-section">
                                    <form action="<?= site_url("workout/details/{$physicalTrainer['id']}") ?>" method="get">
                                        <button type="submit">View</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        <div class="buttons">
            <button class="btn btn-primary btn-next"><i class="material-icons">arrow_right</i></button>
        </div>
    </div>

    <hr>

    <h2>Recommended Workouts For You</h2>
    <p> We have also provided additional recommendations to assist you in creating your workouts. Click below to find out more! </p>

    <div class="card-container" id="recommendedWorkout-container">
        <?php foreach ($recommendedWorkouts as $recommendedWorkout) : ?>
            <?php
            $arialabelRecommendedWorkoutName = "Recommended Workout - " . $recommendedWorkout['workout_name']
            ?>
            <?php $recommendedWorkoutImg =  "rec_workoutImg_" . $recommendedWorkout['workout_name']
            ?>
            <a href="<?= site_url("workout/details/{$recommendedWorkout['workout_id']}") ?>" class="exercise-link card-link" aria-label=<?= $arialabelRecommendedWorkoutName ?>>
                <div class="recommendedWorkout cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src="/img/image.png" alt=<?= $recommendedWorkoutImg ?>>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <div class="text-section">
                                    <h4 class="card-title"><?= $recommendedWorkout['workout_name'] ?></h4>
                                    <h5 class="card-subtitle mb-2">User ID: <?= $recommendedWorkout['workout_creator'] ?></h5>
                                    <p class="card-text"><?= $recommendedWorkout['workout_description'] ?></p>
                                </div>
                                <div class="button-section">
                                    <form action="<?= site_url("workout/details/{$recommendedWorkout['workout_id']}") ?>" method="get">
                                        <button type="submit">View</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        <div class="buttons">
            <button class="btn btn-primary btn-next"><i class="material-icons">arrow_right</i></button>
        </div>
    </div>
</main>
<script src="<?= base_url('js/myWorkout.js') ?>"></script>
<?= $this->endSection() ?>