<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">

<main class="container">
    <h1>Workout Sessions</h1>
    <hr>

    <div class="myWorkoutContainer">
        <h1>My Workout</h1>
        <a href="<?php echo base_url('MyWorkout/addWorkout'); ?>" class="green-button">Create your Own Workout</a>
    </div>


    <div class="card-container" id="myWorkout-container">
        <?php foreach ($myWorkouts as $myWorkout) : ?>
            <a href="<?= site_url("exercises/details/{$myWorkout['id']}") ?>" class="exercise-link card-link">
                <div class="myWorkout cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src="/img/image.png" />
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h4 class="card-title"><?= $myWorkout['workout_name'] ?></h4>
                                <h6 class="card-subtitle mb-2">Made by <?= $myWorkout['made_by'] ?></h6>
                                <p class="card-text"><?= $myWorkout['description'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        <div class="buttons">
            <button class="btn btn-primary btn-next"><i class="material-icons" style="font-size: 10em;color:green">arrow_right</i></button>
        </div>
    </div>

    <hr>

    <h1>Create a Workout by Physical Trainers</h1>

    <div class="card-container" id="physicalTrainers-container">
        <?php foreach ($physicalTrainers as $physicalTrainer) : ?>
            <a href="<?= site_url("exercises/details/{$physicalTrainer['id']}") ?>" class="exercise-link card-link">
                <div class="physicalTrainers cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src="/img/image.png" />
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h4 class="card-title"><?= $physicalTrainer['workout_name'] ?></h4>
                                <h6 class="card-subtitle mb-2">Made by <?= $physicalTrainer['made_by'] ?></h6>
                                <p class="card-text"><?= $physicalTrainer['description'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        <div class="buttons">
            <button class="btn btn-primary btn-next"><i class="material-icons" style="font-size: 10em;color:green">arrow_right</i></button>
        </div>
    </div>

    <hr>

    <h1>Recommended Workout you can follow</h1>

    <div class="card-container" id="recommendedWorkout-container">
        <?php foreach ($recommendedWorkouts as $recommendedWorkout) : ?>
            <a href="<?= site_url("workout/details/{$recommendedWorkout['id']}") ?>" class="workout-link card-link">
                <div class="recommendedWorkout cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src="/img/image.png" />
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h4 class="card-title"><?= $recommendedWorkout['workout_name'] ?></h4>
                                <h6 class="card-subtitle mb-2"><?= $recommendedWorkout['made_by'] ?></h6>
                                <p class="card-text"><?= $recommendedWorkout['description'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        <div class="buttons">
            <button class="btn btn-primary btn-next"><i class="material-icons" style="font-size: 10em;color:green">arrow_right</i></button>
        </div>
    </div>
</main>
<script src="<?= base_url('js/myWorkout.js') ?>"></script>
<?= $this->endSection() ?>