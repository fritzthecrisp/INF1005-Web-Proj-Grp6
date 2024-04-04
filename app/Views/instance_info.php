<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/workout.css') ?>">

<main class="container">
    <div class="row">
        <h1 class="title"><?= $workout['workout_name'] ?></h1>
        <div id="workoutDetails">
            <?php $workoutImg =  "workoutImg - " . $workout['workout_name']
            ?>
            <img class="workoutImg" src=<?= $imgURLs . $workout['workout_image'] . "?raw=true" ?> alt=<?= $workoutImg ?>>
        </div>
        <div class="workoutGuide-description">
            <h2 class="title"><?= "Your Guide to " . $workout['workout_name'] ?></h2>
            <p><?= " (created by: " . $workout['user_name'] . ")" ?></p>
            <h3 class="title">Description:</h3 class="title">
            <p><?= $workout['workout_description'] ?></p>
        </div>
    </div>
    <div>
        <div class="d-flex justify-content-end" id="workoutButtons"> <!-- Added classes here -->
            <!-- <button>SHARE</button> -->
            <form action="<?php echo base_url('workout/start/' . $workout['instance_id']); ?>" method="get">
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
        <div class="allTables">
            <div id="exercise-list">
                <table id="exerciseTable" class="table table-dark">
                    <thead>
                        <tr class="exerciseHeadings">
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

        <?php foreach ($sessionInfo as $sessionNo => $details) : ?>
            <div id="session-list">
                <table id="sessionRecordsTable tables" class="table table-dark">
                    <thead>
                        <tr class="sessionCreationInfo">
                            <th>Session <?= (int)$sessionNo + 1 ?></th>
                            <th colspan="3"><?= "Created " . $details["session_date_created"] ?></th>
                        </tr>
                        <tr>
                            <th>Exercise Name</th>
                            <th>Set #</th>
                            <th>Reps</th>
                            <th>Weights</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($details as $index => $det) :
                            if (is_array($det)) { ?>
                                <tr>
                                    <td><?= $det['exer_name'] ?></td>
                                    <td><?= (int)$det['set_no'] + 1 ?></td>
                                    <td><?= $det['set_reps'] ?></td>
                                    <td><?= $det['session_set_weight'] ?></td>
                                </tr>

                        <?php }
                        endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endforeach; ?>


    </div>
</main>
<script src="<?= base_url('js/workoutInfo.js') ?>"></script>

<?= $this->endSection() ?>