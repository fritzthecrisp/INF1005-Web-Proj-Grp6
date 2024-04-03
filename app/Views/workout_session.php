<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/workout.css') ?>">

<main class="container">
    <h1><?= $workout["workout_name"] ?></h1>
    <form id="workoutForm" method="POST">
        <div class="exercise-container" >
            <?php foreach ($sets as $set) : ?>
                <div class="exercise" data-sets="<?= $set['sets'] ?>">
                    <div class="exercise-info">
                        <img src=<?= $imgURLs . $set['exer_image'] . "?raw=true" ?> alt="Exercise Icon">
                        <div class="exercise-name"><?= $set['exer_name'] ?></div>
                        <div class="equipment">Equipment</div>
                        <div class="sets"><?= $set['sets'] ?> sets</div>
                        <button type="button" class="start-btn">START</button>
                    </div>
                    <div class="exercise-inputs" >
                        <!-- Inputs will be generated here -->
                        <?php for ($i = 1; $i <= $set['sets']; $i++) { ?>
                            <div class="set" >
                                <span>Set <?= $i?>: </span>
                                <input type="number" placeholder="Reps" name="set_reps[<?= $set["exer_id"]?>][]" class="reps-input">
                                <input type="number" placeholder="Weight" name="set_weight[<?= $set["exer_id"]?>][]" class="weight-input">
                            </div>

                        <?php } ?>

                    </div>
                </div>

            <?php endforeach; ?>
        </div>
        <button type="submit">Submit</button>
    </form>
</main>
<script src="<?= base_url('js/startWorkout.js') ?>"></script>
<?= $this->endSection() ?>