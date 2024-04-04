<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('css/workout_exercise.css') ?>">

<main class="container">
    <h1><?= $exercise['exer_name'] ?></h1>
    <div id="exerciseDetails">
        <?php $exerciseImg =  "exerciseImg - " . $exercise['exer_name']
        ?>
        <img class="exerciseImg" src=<?= $imgURLs . $exercise['exer_images'] . "?raw=true" ?> alt="<?= $exerciseImg ?>">
    </div>
    <div class="exerciseDescription">
        <h2 class="title"><?= "Difficulty: " . $exercise['exer_level'] ?></h2>
        <h2 class="title"><?= "Equipment used: " . $exercise['exer_equipment'] ?></h2>
        <h3>Instructions</h3>
        <ol>
            <?php foreach ($exercise['exer_instructions'] as $instruction) { ?>
                <li><?= $instruction ?></li>
            <?php } ?>
        </ol>
    </div>
    <div class="buttonsbelowDescription">
        <form action="<?= site_url("/publicExercise") ?>" method="get">
            <button type="submit">Explore more Exercises</button>
        </form>
    </div>
</main>
<?= $this->endSection() ?>