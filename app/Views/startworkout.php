<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/workout.css') ?>">

<main class="container">
    <h1>Workout Name</h1>
    <div class="exercise-container">
        <div class="exercise" data-sets="2">
            <div class="exercise-info">
                <img src="/img/image.png" alt="Exercise Icon" />
                <div class="exercise-name">Exercise Name</div>
                <div class="equipment">Equipment</div>
                <div class="sets">2 sets</div>
                <button class="start-btn">START</button>
            </div>
            <div class="exercise-inputs" style="display: none;">
                <!-- Inputs will be generated here -->
            </div>
        </div>
        <div class="exercise" data-sets="3">
            <div class="exercise-info">
                <img src="/img/image.png" alt="Exercise Icon" />
                <div class="exercise-name">Exercise Name</div>
                <div class="equipment">Equipment</div>
                <div class="sets">3 sets</div>
                <button class="start-btn">START</button>
            </div>
            <div class="exercise-inputs" style="display: none;">
                <!-- Inputs will be generated here -->
            </div>
        </div>
        <div class="exercise" data-sets="4">
            <div class="exercise-info">
                <img src="/img/image.png" alt="Exercise Icon" />
                <div class="exercise-name">Exercise Name</div>
                <div class="equipment">Equipment</div>
                <div class="sets">4 sets</div>
                <button class="start-btn">START</button>
            </div>
            <div class="exercise-inputs" style="display: none;">
                <!-- Inputs will be generated here -->
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('js/startWorkout.js') ?>"></script>
<?= $this->endSection() ?>