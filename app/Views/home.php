<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">

<main class="container">
    <h1>Home</h1>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/img/image.png" alt="First slide" style="width: 800px; height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Text1</h1>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/logos.png" alt="Second slide" style="width: 800px; height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Text2</h1>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/image.png" alt="Third slide" style="width: 800px; height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Text3</h1>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <h2>TOP EXERCISE</h2>
    <div class="card-container" id="exercise-container">
        <?php foreach ($exercises as $exercise) : ?>
            <div class="exercise cards">
                <div class="row">
                    <div class="col-sm-5">
                        <img class="card-img" src="/img/image.png" alt="exerciseImg">
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title"><?= $exercise['exer_name'] ?></h5>
                            <h6 class="card-subtitle mb-2">Level: <?= $exercise['exer_level'] ?></h6>
                            <p class="card-text">Exercise Eqiupment:<?= $exercise['exer_equipment'] ?></p>
                            <button onclick="window.location.href='<?= site_url("exercises/details/{$exercise['exer_id']}") ?>'">View</button>
    <h1>WELCOME TO UNIFIT!</h1>
    <h2>TOP EXERCISES</h2>
    <div class="card-container" id="exercise-container">
        <?php foreach ($exercises as $exercise) : ?>
            <?php
            $exerciseId = $exercise['exer_id'];
            $exerciseName = $exercise['exer_name'];
            $ariaLabelExerciseId = "Exercise Number " . $exerciseId ."- ". $exerciseName;
            ?>
            <a href="<?= site_url("exercises/details/{$exerciseId}") ?>" class="exercise-link card-link" style="text-decoration: none;" aria-label="<?= $ariaLabelExerciseId ?>">
                <div class="exercise cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src="/img/image.png" alt="<?= "exerciseImg".$exerciseId?>">
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h3 class="card-title"><?= $exerciseName?></h3>
                                <h4 class="card-subtitle">Level: <?= $exercise['exer_level'] ?></h4>
                                <p class="card-text">Exercise Eqiupment: <?= $exercise['exer_equipment'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="buttons">
            <button class="btn btn-primary btn-next"><i class="material-icons" style="font-size: 10em;color:green">arrow_right</i></button>
        </div>
    </div>

    <h2>TOP WORKOUT PLANS</h2>
    <div class="card-container" id="workout-container">
        <?php foreach ($workouts as $workout) : ?>
            <div class="workout cards">
                <div class="row">
                    <div class="col-sm-5">
                        <img class="card-img" src="/img/image.png" alt="workoutImg">
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title"><?= $workout['workout_name'] ?></h5>
                            <h6 class="card-subtitle mb-2">Made by:</h6>
                            <p class="card-text"><?= $workout['workout_description'] ?></p>
                            <button onclick="window.location.href='<?= site_url("workout/details/{$workout['workout_id']}") ?>'">View</button>
            <?php
            $workoutId = $workout['workout_id'];
            $workoutName = $workout['workout_name'];
            $ariaLabelWorkoutId = "Workout Number " . $workoutId . "- ". $workoutName;
            ?>
            <a href="<?= site_url("workout/details/{$workoutId}") ?>" class="workout-link card-link" style="text-decoration: none;" aria-label="<?= $ariaLabelWorkoutId ?>">
                <div class="workout cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src="/img/image.png" alt="<?="workoutImg".$workoutId?>">
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h3 class="card-title"><?= $workoutName ?></h3>
                                <h4 class="card-subtitle">Made by: </h4>
                                <p class="card-text"><?= $workout['workout_description'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="buttons">
            <button class="btn btn-primary btn-next"><i class="material-icons" style="font-size: 10em;color:green">arrow_right</i></button>
        </div>
    </div>
</main>
<script src="<?= base_url('js/home.js') ?>"></script>
<?= $this->endSection() ?>