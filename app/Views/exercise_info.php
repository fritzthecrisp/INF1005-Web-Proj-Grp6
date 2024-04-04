<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">

<main class="container" style="display: grid;place-items: center;">
    <img src="<?= $imgURLs . $exercise['exer_images'] . "?raw=true" ?>" alt="exerciseImg">
    <h1 class="title"><?= $exercise['exer_name'] ?></h1>
    <div class="column">
        <button>INFO</button>
        <button>INSTRUCTIONS</button>
    </div>
    <div class="rounded-border">
        <span>Difficulty</span>
        <span></span>
        <span><?= $exercise['exer_level'] ?></span>
    </div>
    <div class="rounded-border">
        <span>Equipment</span>
        <span></span>
        <span><?= $exercise['exer_equipment'] ?></span>
    </div>
    <ol>
    <?php foreach ($exercise['exer_instructions'] as $instruction) {?>
        <li><?= $instruction ?></li>
    <?php } ?>   
</ol>
</main>
<?= $this->endSection() ?>