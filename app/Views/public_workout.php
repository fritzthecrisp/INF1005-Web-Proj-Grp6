<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">

<main class="container">
    <div class="card-headings">
        <h1 class="title">WORKOUT PLANS</h1>
        <p>A list of all Workout Plans created by our physical trainers and Unifit Members.</p>
    </div>

    <!-- Cards -->
    <div class="card-container" id="workout-container">
        <div class="row">
            <?php foreach ($workouts as $workout) : ?>
                <?php
                $arialabelTopWorkoutName = "Top Workout - " . $workout['workout_name']
                ?>
                <?php $workoutImg =  "workoutImg_" . $workout['workout_name']
                ?>
                <div class="col-md-6 mb-4 card-border">
                    <a href="<?= site_url("workout/details/{$workout['instance_id']}") ?>" class="exercise-link card-link" aria-label="<?= $arialabelTopWorkoutName ?>">
                        <div class="workout cards">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="card-img" src=<?= $imgURLs . $workout['workout_image'] . "?raw=true" ?> alt="<?= $workoutImg ?>">
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <div class="text-section">
                                            <h2 class="card-title"><?= $workout['workout_name'] ?></h2>
                                            <h3 class="card-subtitle mb-2">Made by: <?= $workout['user_name'] ?></h3>
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
    <div class="buttonsbelowCards">
        <form action="<?= site_url("/") ?>" method="get">
            <button type="submit">Back to Home</button>
        </form>
    </div>
</main>
<script src="<?= base_url('js/main.js') ?>"></script>
<?= $this->endSection() ?>