<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/workout.css') ?>">
<script src="<?= base_url('js/main.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/workout_exercise.css') ?>">

<main class="container">
    <div class="row">
        <h1><?= $workout['workout_name'] ?></h1>
        <div id="workoutDetails">
            <?php $workoutImg =  "workoutImg - " . $workout['workout_name']
            ?>
            <img class="workoutImg" src=<?= $imgURLs . $workout['workout_image'] . "?raw=true" ?> alt="<?= $workoutImg ?>">
        </div>
        <div class="workoutGuide-description">
            <h2><?= "Your Guide to " . $workout['workout_name'] ?></h2>
            <p><?= " (created by: " . $workout['user_name'] . ")" ?></p>
            <h3 class="title">Description:</h3>
            <p><?= $workout['workout_description'] ?></p>
        </div>
    </div>
    <div>
        <div class="d-flex justify-content-end" id="workoutButtons"> <!-- Added classes here -->
            <!-- <button>SHARE</button> -->
            <form action="<?php echo base_url('workout/start/' . $workout['instance_id']); ?>" method="get">
                <button type="submit">Share</button>
            </form>
            <!-- ?php if ($isLoggedIn) : ? -->
            <form action="<?= site_url('instance/edit/' . $workout['instance_id']) ?>" method="get">
                <button type="submit">Create Workout</button>
            </form>
            <?php if ($workouts['workout_public'] === "Public"): ?>
            <form action="">
                <input type="hidden" id="linkToCopy"">
                    <button onclick="copyCurrentUrl()">Copy Link</button>
                </form>
                <?php endif; ?>
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

            <?php foreach ($sessionInfo as $sessionNo => $details) : ?>
                <div id="session-list">
                    <table id="sessionRecordsTable" class="table table-dark">
                        <thead>
                            <tr class="sessionCreationInfo">
                                <th>Session <?= (int)$sessionNo + 1 ?></th>
                                <th colspan="3"><?= "Created " . $details["session_date_created"] ?></th>
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

    </div>
</main>
<script src="<?= base_url('js/workoutInfo.js') ?>"></script>

<?= $this->endSection() ?>