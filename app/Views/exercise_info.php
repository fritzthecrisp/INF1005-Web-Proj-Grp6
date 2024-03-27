<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">

<main class="container" style="display: grid;place-items: center;">
    <img src="/img/image.png" alt="exerciseImg">
    <h1><?= $exercise['exercise_name'] ?></h1>
    <div class="column">
        <button>INFO</button>
        <button>INSTRUCTIONS</button>
    </div>
    <div class="rounded-border">
        <span>Difficulty</span>
        <span></span>
        <span>Easy</span>
    </div>
    <div class="rounded-border">
        <span>Equipment</span>
        <span></span>
        <span>Eq Name</span>
    </div>
</main>
<?= $this->endSection() ?>