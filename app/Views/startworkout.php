<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<main class="container">
    <div class="workout-name">Workout Name</div>
    <div class="exercise">
        <img src="/img/image.png" alt="Exercise Icon" />
        <div class="exercise-info">
            <div>Exercise Name</div>
            <div>Equipment 5 rep</div>
        </div>
        <button class="start-button">START</button>
    </div>
    <div class="exercise">
        <img src="/img/image.png" alt="Exercise Icon" />
        <div class="exercise-info">
            <div>Exercise Name</div>
            <div>Equipment 5 rep</div>
        </div>
        <button class="start-button">START</button>
    </div>
    <div class="exercise">
        <img src="/img/image.png" alt="Exercise Icon" />
        <div class="exercise-info">
            <div>Exercise Name</div>
            <div>Equipment 5 rep</div>
        </div>
        <button class="start-button">START</button>
    </div>
</main>
<?= $this->endSection() ?>
