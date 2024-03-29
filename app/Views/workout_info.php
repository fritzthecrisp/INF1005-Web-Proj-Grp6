<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<main class="container">
    <div class="row">
        <div class="col-sm">
            <img src="/img/image.png" alt="workoutImg">
            <h1><?= $workout['workout_name'] ?></h1>
            <h2><?= $workout['description'] ?></h2>
            <p>5X Chest Press</p>
            <p>Break</p>
            <p>6X Chest Press</p>
            <p>Break</p>
        </div>
        <div class="col-sm">
            <div class="d-flex justify-content-end"> <!-- Added classes here -->
                <button>SHARE</button>
                <form style="display: inline" action="<?php echo base_url('workout/startWorkout/1'); ?>" method="get">
                    <button type="submit">Start Workout</button>
                </form>
                <!-- ?php if ($isLoggedIn) : ? -->
                <form action="<?= site_url('instance/edit') ?>" method="get">
                    <button type="submit">Edit Workout</button>
                </form>
                <form action="" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit">Delete Record</button>
                </form>
                <!-- ?php endif; ? -->
            </div>
        </div>
    </div>


</main>
<?= $this->endSection() ?>