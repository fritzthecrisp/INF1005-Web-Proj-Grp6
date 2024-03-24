<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<main class="container">
    <img src="/img/image.png" />
    <h1><?= $workout['workout_name'] ?></h1>
    <h2><?= $workout['description'] ?></h2>
    <p>5X Chest Press</p>
    <p>Break</p>
    <p>6X Chest Press</p>
    <p>Break</p>
    <button>SHARE</button>
    <a href="<?php echo base_url('workout/startWorkout/1'); ?>">
        <button>Start Workout</button>
    </a>
</main>
<?= $this->endSection() ?>