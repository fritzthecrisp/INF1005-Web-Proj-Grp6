<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">

<main class="container">
    <h1>Home</h1>
    <div id="carousel" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/img/image.png" class="d-block w-100" alt="First slide" style="width: 800px; height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>First slide label</h1>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/logos.png" class="d-block w-100" alt="Second slide" style="width: 800px; height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Second slide label</h1>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/image.png" class="d-block w-100" alt="Third slide" style="width: 800px; height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Third slide label</h1>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <h2 class=top_Headings>TOP EXERCISES</h2>
    <p> Here are the Top exercises done by our UniFit members!
    <div class="card-container" id="exercise-container">
        <?php foreach ($exercises as $exercise) : ?>
            <div class="exercise cards">
                <?php $arialabelTopExerciseId = "Top Exercise - " . $exercise['exer_name'] ?>
                <div class="row" aria-label=<?= $arialabelTopExerciseId ?>>
                    <div class="col-sm-5">
                        <img class="card-img" src="/img/image.png" alt="exerciseImg">
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body">
                            <div class="text-section">
                                <h5 class="card-title"><?= $exercise['exer_name'] ?></h5>
                                <h6 class="card-subtitle mb-2">Level: <?= $exercise['exer_level'] ?></h6>
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
        <?php endforeach; ?>
        <div class="buttons">
            <button class="btn btn-primary btn-next"><i class="material-icons" style="font-size: 10em;color:green">arrow_right</i></button>
        </div>
    </div>

    <h2 class="top_Headings">TOP WORKOUT PLANS</h2>
    <p>Here are the Top Workout Plans created by Instructors and also Unifit Members!
    <div class="card-container" id="workout-container">
        <?php foreach ($workouts as $workout) : ?>
            <div class="workout cards">
                <?php $arialabelTopWorkoutId = "Top Workout - " . $workout['workout_id'] ?>
                <div class="row" aria-label=<?= $arialabelTopWorkoutId ?>>
                    <div class="col-sm-5">
                        <img class="card-img" src="/img/image.png" alt="workoutImg">
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body">
                            <div class="text-section">
                                <h5 class="card-title"><?= $workout['workout_name'] ?></h5>
                                <h6 class="card-subtitle mb-2">Made by:</h6>
                                <p class="card-text"><?= $workout['workout_description'] ?></p>
                            </div>
                            <div class="cta-section">
                                <form action="<?= site_url("workout/details/{$workout['workout_id']}") ?>" method="get">
                                    <button type="submit">View</button>
                                </form>
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