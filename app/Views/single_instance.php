<?= $this->extend('layouts/main') ?>


<?= $this->section('content') ?>

<h1>This is the <?= $page_name ?> page.</h1>
<a href="/instance/delete/<?= $instance["workout_id"] ?>" class="btn btn-danger">Delete</a>
<a href="/instance/edit/<?= $instance["workout_id"] ?>" class="btn btn-success">Delete</a>

<?= $this->endSection('content') ?>