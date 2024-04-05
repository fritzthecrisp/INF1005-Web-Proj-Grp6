<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
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
            <h3>Description:</h3>
            <p><?= $workout['workout_description'] ?></p>
        </div>
    </div>
    <div>
        <?php $session = \Config\Services::session(); ?>
        <?php
        if ($session->has('logged_in') && $session->get('logged_in') === TRUE) {
            echo '<div class="d-flex justify-content-end" id="workoutButtons">';

            // Form for creating a workout
            echo '<form action="' . site_url('instance/edit/' . $workout['instance_id']) . '" method="get">';
            echo '<button type="submit">Create Workout</button>';
            echo '</form>';

            // Check if the workout is public and display a copy link button if true
            if ($workout['workout_public'] === "Public") {
                echo '<form>';
                echo '<input type="hidden" id="linkToCopy">';
                echo '<button onclick="copyCurrentUrl()">Copy Link</button>';
                echo '</form>';
            }

            echo '</div>';
        } else {
            echo '<div class="d-flex justify-content-end" id="workoutButtons">';
            if ($workout['workout_public'] === "Public") {
                echo '<form>';
                echo '<input type="hidden" id="linkToCopy">';
                echo '<button onclick="copyCurrentUrl()">Copy Link</button>';
                echo '</form>';
            }
            echo '</div>';
        }
        ?>

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
    </div>
    <div class="buttonsbelowDescription">
        <form action="<?= site_url("/publicWorkout") ?>" method="get">
            <button type="submit">Explore more Workout Plans</button>
        </form>
    </div>
</main>
<?= $this->endSection() ?>