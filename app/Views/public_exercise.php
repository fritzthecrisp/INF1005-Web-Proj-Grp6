<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">

<main class="container">
    <div class="card-hedings">
        <h2>TOP EXERCISES</h2>
        <p>Here are the Top exercises done by our UniFit members!</p>
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
                                            <h2 class="card-title"><?= $exercise['exer_name'] ?></h2>
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
</main>
<?= $this->endSection() ?>