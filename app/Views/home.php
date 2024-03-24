<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">

<main class="container">
    <h3>TOP EXERCISE</h3>
    <div class="card-container" id="exercise-container">
        <?php foreach ($exercises as $exercise) : ?>
            <a href="<?= site_url("exercises/details/{$exercise['exer_id']}") ?>" class="exercise-link card-link">
                <div class="exercise cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src="/img/image.png" />
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title"><?= $exercise['exer_name'] ?></h5>
                                <h6 class="card-subtitle mb-2">Level: <?= $exercise['exer_level'] ?></h6>
                                <p class="card-text">Exercise Eqiupment:<?= $exercise['exer_equipment'] ?></p>
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
    
    <h3>TOP WORKOUT PLANS</h3>
    <div class="card-container" id="workout-container">
        <?php foreach ($workouts as $workout) : ?>
            <a href="<?= site_url("workout/details/{$workout['workout_id']}") ?>" class="workout-link card-link">
                <div class="workout cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src="/img/image.png" />
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title"><?= $workout['workout_name'] ?></h5>
                                <h6 class="card-subtitle mb-2">Made by:</h6>
                                <p class="card-text"><?= $workout['workout_description'] ?></p>
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
<script src="<?= base_url('js/home.js') ?>"></script>
<?= $this->endSection() ?>