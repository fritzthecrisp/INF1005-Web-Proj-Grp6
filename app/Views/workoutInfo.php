<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<main class="container">
    <img src="/img/image.png" />
    <h1><?= $workout['workout_name'] ?></h1>
    <h2><?=$workout['description'] ?></h2>
    <p>5X Chest Press</p>
    <p>Break</p>
    <p>6X Chest Press</p>
    <p>Break</p>
    <button>SHARE</button>
    <button onclick="window.location.href='/startworkout.php';">START WORKOUT</button>
    <button onclick="window.location.href='/addworkout.php';">Add workout</button>
</main>
<?= $this->endSection() ?>
