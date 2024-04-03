<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">

<main class="container">
    <h1 class="openingTagline">WELCOME TO UNIFIT</h1>
    <div id="carousel" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/img/image.png" class="d-block w-100" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h2>First slide label</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/logos.png" class="d-block w-100" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Second slide label</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/image.png" class="d-block w-100" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Third slide label</h2>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev" aria-label="previous-slide">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next" aria-label="next-slide">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="alt-headings">
        <h1>WELCOME TO UNIFIT!</h1>
        <h1>Your One-stop Fitness Tracking Application</h1>
    </div>

    <h2 class=top_Headings>TOP EXERCISES</h2>
    <p>Here are the Top exercises done by our UniFit members!</p>
    <div class="card-container" id="exercise-container">
        <?php foreach ($exercises as $exercise) : ?>
            <?php $arialabelTopExerciseName = "Top Exercise - " . $exercise['exer_name'] ?>
            <?php $exerciseImg =  "exerciseImg_" . $exercise['exer_name'] ?>
            <a href="<?= site_url("exercises/details/{$exercise['exer_id']}") ?>" class="exercise-link card-link" aria-label="<?= $arialabelTopExerciseName ?>">
                <div class="exercise cards" aria-label=<?= $arialabelTopExerciseName ?>>
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src=<?= $imgURLs . $exercise['exer_images'] . "?raw=true" ?> alt="<?= $exerciseImg ?>">
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <div class="text-section">
                                    <h3 class="card-title"><?= $exercise['exer_name'] ?></h5>
                                        <h4 class="card-subtitle mb-2">Level: <?= $exercise['exer_level'] ?></h4>
                                        <p class="card-text">Exercise Eqiupment: <?= $exercise['exer_equipment'] ?></p>
                                </div>
                                <div class="button-section">
                                    <form action="<?= site_url("exercises/details/{$exercise['exer_id']}") ?>" method="get">
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

    <h2 class="top_Headings">TOP WORKOUT PLANS</h2>
    <p>Here are the Top Workout Plans created by physical trainers and also Unifit Members!</p>
    <div class="card-container" id="workout-container">
        <?php foreach ($workouts as $workout) : ?>
            <?php
            $arialabelTopWorkoutName = "Top Workout - " . $workout['workout_name']
            ?>
            <?php $workoutImg =  "workoutImg_" . $workout['workout_name']
            ?>
            <a href="<?= site_url("workout/details/{$workout['workout_id']}") ?>" class="exercise-link card-link" aria-label="<?= $arialabelTopWorkoutName ?>">
                <div class="workout cards" aria-label="<?= $arialabelTopWorkoutName ?>">
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
                                <div class="button-section">
                                    <form action="<?= site_url("workout/details/{$workout['workout_id']}") ?>" method="get">
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
<script src="<?= base_url('js/home.js') ?>"></script>
<?= $this->endSection() ?>