<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">


<main class="container">
    <div class="bg-image">
        <img src="https://images.unsplash.com/photo-1599058918144-1ffabb6ab9a0?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="motivational_image">
        <div class="quote">
            <h2>"The pain you feel today is the strength you feel tomorrow." <br>-Stephen Richards</h2>
        </div>
    </div>
    <div class="quote-responsive">
        <h2>"The pain you feel today is the strength you feel tomorrow." <br>-Stephen Richards</h2>
    </div>
    <div class="openingTagline">
        <h1>WELCOME TO UNIFIT!</h1>
        <h1>Your One-stop Fitness Tracking Application</h1>
    </div>
    <div class="card-headings">
        <h2>TOP EXERCISES</h2>
        <p>Here are the Top exercises done by our UniFit members! Click on the exercises below to find out more!</p>
    </div>
    <div class="card-container" id="exercise-container">
        <div class="row">
            <?php foreach ($exercises as $exercise) : ?>
                <?php $arialabelTopExerciseName = "Top Exercise - " . $exercise['exer_name'] ?>
                <?php $exerciseImg =  "exerciseImg_" . $exercise['exer_name'] ?>
                <div class="col-sm-6 mb-4 card-border">
                    <a href="<?= site_url("exercises/details/{$exercise['exer_id']}") ?>" class="exercise-link card-link" aria-label="<?= $arialabelTopExerciseName ?>">
                        <div class="exercise cards">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="card-img" src="<?= $imgURLs . $exercise['exer_images'] . "?raw=true" ?>" alt="<?= $exerciseImg ?>">
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <div class="text-section">
                                            <h3 class="card-title"><?= $exercise['exer_name'] ?></h3>
                                                <h4 class="card-subtitle mb-2">Level: <?= $exercise['exer_level'] ?></h4>
                                                <p class="card-text">Exercise Eqiupment: <?= $exercise['exer_equipment'] ?></p>
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
        <form action="<?= site_url("/publicExercise") ?>" method="get">
            <button type="submit">Explore more Exercises</button>
        </form>
    </div>
    <div class="card-headings">
        <h2>TOP WORKOUT PLANS</h2>
        <p>Here are the Top Workout Plans created by physical trainers and also Unifit Members! Click on the workout plans below to find out more!</p>
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
                    <a href="<?= site_url("workout/details/{$workout['instance_id']}") ?>" class="workout-link card-link" aria-label="<?= $arialabelTopWorkoutName ?>">
                        <div class="workout cards">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="card-img" src=<?= $imgURLs . $workout['workout_image'] . "?raw=true" ?> alt="<?= $workoutImg ?>">
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <div class="text-section">
                                            <h3 class="card-title"><?= $workout['workout_name'] ?></h3>
                                            <h4 class="card-subtitle mb-2">Made by: <?= $workout['user_name'] ?></h4>
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
        <form action="<?= site_url("/publicWorkout") ?>" method="get">
            <button type="submit">Explore more Workout Plans</button>
        </form>
    </div>
</main>
<?= $this->endSection() ?>