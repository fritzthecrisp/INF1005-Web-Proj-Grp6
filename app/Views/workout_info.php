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
            <img class="workoutImg" src=<?= $imgURLs . $workout['workout_image'] . "?raw=true" ?> alt=<?= $workoutImg ?>>
            <div class="workoutGuide">
                <h2><?= "Your Guide to " . $workout['workout_name'] ?></h2>
                <p><?= "Created by " . $workout['user_name'] ?></p>
                <p><?= $workout['workout_description'] ?></p>
            </div>
        </div>
        <div class="col-sm">
            <div class="d-flex justify-content-end" id="workoutButtons"> <!-- Added classes here -->
                <!-- <button>SHARE</button> -->
                <form style="display: inline" action="<?php echo base_url('workout/start/' . $workout['instance_id']); ?>" method="get">
                    <button type="submit">Start Workout</button>
                </form>
                <!-- ?php if ($isLoggedIn) : ? -->
                <form action="<?= site_url('instance/edit/' . $workout['instance_id']) ?>" method="get">
                    <button type="submit">Edit Workout</button>
                </form>
                <form action="" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit">Delete Record</button>
                </form>
                <!-- ?php endif; ? -->

            </div>
            <div id="thisdiv">
                <table id="exerciseTable" class="table table-dark">
                    <thead>
                        <tr>
                            <th>Exercise Name</th>
                            <th>Sets</th>
                            <th>Reps</th>
                            <th>Weights</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sets as $set) : ?>
                            <tr>
                                <td><?= $set['exer_name'] ?></td>
                                <td><?= $set['sets'] ?></td>
                                <td><?= $set['reps'] ?></td>
                                <td><?= $set['weight'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <?php foreach ($sessionInfo as $sessionNo => $details) : ?>

        <div id="sessionRecords">
            <table id="sessionRecordsTable" class="table table-dark">
                <thead>
                    <tr>
                    <th>Session <?= (int)$sessionNo+1 ?></th>
                    <th><?= $details["session_date_created"] ?></th>
                    </tr>
                    <tr>
                        <th>Exercise Name</th>
                        <th>Sets</th>
                        <th>Reps</th>
                        <th>Weights</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $det) : 
                        if (is_array($det)) {?>
                        <tr>
                            <td><?= $det['exer_name'] ?></td>
                            <td><?= (int)$det['set_no']+1 ?></td>
                            <td><?= $det['set_reps'] ?></td>
                            <td><?= $det['session_set_weight'] ?></td>
                        </tr>
                        
                        
                    <?php } endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>

</main>
<script src="<?= base_url('js/workoutInfo.js') ?>"></script>

<?= $this->endSection() ?>