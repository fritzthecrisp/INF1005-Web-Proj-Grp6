<!-- A list of exercises visible to the public when not login -->

<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">

<main class="container">
    <div class="card-headings">
        <h1 class="title">EXERCISES</h1>
        <p>Displaying to you a list of all the exercises available in UniFit.</p>
    </div>

    <!-- Cards -->
    <div class="card-container" id="exercise-container">
        <div class="row">
            <?php foreach ($exercises as $exercise) : ?>
                <?php $arialabelTopExerciseName = "Top Exercise - " . $exercise['exer_name'] ?>
                <?php $exerciseImg =  "exerciseImg_" . $exercise['exer_name'] ?>
                <div class="col-md-6 mb-4 card-border">
                    <a href="<?= site_url("exercises/details/{$exercise['exer_id']}") ?>" class="exercise-link card-link" aria-label="<?= $arialabelTopExerciseName ?>">
                        <div class="exercise cards">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img class="card-img" src="<?= $imgURLs . $exercise['exer_images'] . "?raw=true" ?>" alt="<?= $exerciseImg ?>">
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <div class="text-section">
                                            <h2 class=" title card-title"><?= $exercise['exer_name'] ?></h2>
                                            <h3 class="card-subtitle mb-2">Level: <?= $exercise['exer_level'] ?></h3>
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
        <form action="<?= site_url("/") ?>" method="get">
            <button type="submit">Back to Home</button>
        </form>
    </div>
</main>
<script src="<?= base_url('js/main.js') ?>"></script>
<?= $this->endSection() ?>