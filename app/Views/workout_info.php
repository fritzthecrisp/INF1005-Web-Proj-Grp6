<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/card.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('css/others.css') ?>">

<main class="container">
    <div class="row">
        <div class="col-sm" id="workoutDetails">
            <?php $workoutImg =  "workoutImg - " . $workout['workout_name']
            ?>
            <h1><?= $workout['workout_name'] ?></h1>
            <img class="workoutImg" src="/img/image.png" alt=<?= $workoutImg ?>>
            <div class="workoutGuide">
                <h2><?= "Your Guide to " . $workout['workout_name'] ?></h2>
                <p><?="Created by " . $workout['user_name'] ?></p>
                <p><?= $workout['workout_description'] ?></p>
            </div>
        </div>
        <div class="col-sm">
            <div class="d-flex justify-content-end" id="workoutButtons"> <!-- Added classes here -->
                <!-- <button>SHARE</button> -->
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
<script src="<?= base_url('js/workoutInfo.js') ?>"></script>

<?= $this->endSection() ?>