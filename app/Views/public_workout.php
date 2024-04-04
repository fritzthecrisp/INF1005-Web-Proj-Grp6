<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">

<main class="container">
    <div class="card-headings">
        <h2>TOP WORKOUT PLANS</h2>
        <p>Here are the Top Workout Plans created by physical trainers and also Unifit Members!</p>
    </div>
    <div class="card-container" id="workout-container">
        <div class="row">
            <?php foreach ($workouts as $workout) : ?>
                <?php
                $arialabelTopWorkoutName = "Top Workout - " . $workout['workout_name']
                ?>
                <?php $workoutImg =  "workoutImg_" . $workout['workout_name']
                ?>
                <div class="col-md-6 mb-4 card-border">
                    <a href="<?= site_url("workout/details/{$workout['workout_id']}") ?>" class="exercise-link card-link" aria-label="<?= $arialabelTopWorkoutName ?>">
                        <div class="workout cards">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="card-img" src="/img/image.png" alt="<?= $workoutImg ?>">
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <div class="text-section">
                                            <h3 class="card-title"><?= $workout['workout_name'] ?></h3>
                                            <h4 class="card-subtitle mb-2">Made by: </h4>
                                            <p class="card-text"><?= $workout['workout_description'] ?></p>
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
</main>
<?= $this->endSection() ?>