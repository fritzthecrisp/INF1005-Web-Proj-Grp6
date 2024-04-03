<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/workout.css') ?>">

<main class="container">
    <h1><?= $workout["workout_name"] ?></h1>
    <form id="workoutForm" action="process_workout.php" method="POST">
        <?php $counter = 1; ?>
        <?php foreach ($sets as $set) : ?>
            <div class="info" style="display: none;">
                <div class="info-left"> 
                    <img src=<?= $imgURLs . $set['exer_image'] . "?raw=true" ?> alt="Exercise Icon">
                </div>
                <div class="info-right">
                    <div class="equipment">Equipment</div>
                    <div class="sets" style="display: block; clear: both;"><?= $set['sets'] ?> sets</div>
                </div>
            </div>
            <div class="exercise-container">
                <div class="exercise" data-sets="<?= $set['sets'] ?>">
                    <div class="exercise-info">
                        <div class="exercise-name">Exercise <?= ($counter) ?> : <?= $set['exer_name'] ?></div>
                        <button type="button" class="start-btn">START</button>
                    </div>
                    <div class="exercise-inputs">
                        <!-- Inputs will be generated here -->
                        <?php for ($i = 1; $i <= $set['sets']; $i++) { ?>
                            <div class="set" style="display: none;">
                                <span>Set <?= $i ?>: </span>
                                <input type="number" placeholder="Reps" class="reps-input">
                                <input type="number" placeholder="Weight" class="weight-input">
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
            <?php $counter++; ?>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
</main>
<script src="<?= base_url('js/startWorkout.js') ?>"></script>
<?= $this->endSection() ?>