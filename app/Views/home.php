<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">

<main class="container">
    <h3>TOP EXERCISE</h3>
    <div class="card-container" id="exercise-container">
        <?php foreach ($exercises as $exercise) : ?>
            <a href="<?= site_url("exercises/details/{$exercise['id']}") ?>" class="exercise-link card-link">
                <div class="exercise cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src="/img/image.png" />
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title"><?= $exercise['exercise_name'] ?></h5>
                                <h6 class="card-subtitle mb-2">Made by <?= $exercise['made_by'] ?></h6>
                                <p class="card-text"><?= $exercise['description'] ?></p>
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
            <a href="<?= site_url("workout/details/{$workout['id']}") ?>" class="workout-link card-link">
                <div class="workout cards">
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="card-img" src="/img/image.png" />
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title"><?= $workout['workout_name'] ?></h5>
                                <h6 class="card-subtitle mb-2">Duration: <?= $workout['duration'] ?></h6>
                                <p class="card-text"><?= $workout['description'] ?></p>
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