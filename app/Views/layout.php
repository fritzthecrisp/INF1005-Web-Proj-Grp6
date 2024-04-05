<!DOCTYPE html>

<!-- The page that defines the header, body, navigation bar, footer that will affect all other web pages created. -->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>UniFit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=0.5">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>

<body>
    <div class="header">
        <?php $session = \Config\Services::session(); ?>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="<?= site_url("/") ?>">
                    <img src="/img/logos.png" alt="logo" id="logo">
                    <span class="logo-unifit title">UNIFIT</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <?php
                        if ($session->has('logged_in') && $session->get('logged_in') === TRUE) {
                            // If the user is logged in (cookie is set), show profile link
                            echo '
                            <li>
                                <a class="nav-link welcome-link">Welcome '. $session->get('user_username').'!</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="' . site_url("about") . '">ABOUT US</a>
                        </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">EXPLORE</a>
                                <ul class="dropdown-menu dropdown-align">
                                    <li>
                                        <a class="nav-link" href="' . site_url("/publicExercise") . '">EXERCISES</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="' . site_url("/publicWorkout") . '">WORKOUTS</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="' . site_url("myWorkout") . '">MY WORKOUT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="' . site_url("logout") . '">LOGOUT</a>
                            </li>
                          ';
                        } else {
                            // If the user is not logged in (cookie is not set), show login link
                            echo '
                            <li class="nav-item">
                            <a class="nav-link" href="' . site_url("about") . '">ABOUT US</a>
                        </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">EXPLORE</a>
                                <ul class="dropdown-menu dropdown-align">
                                    <li>
                                        <a class="nav-link" href="' . site_url("/publicExercise") . '">EXERCISES</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="' . site_url("/publicWorkout") . '">WORKOUTS</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="' . site_url("register") . '">SIGN UP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="' . site_url("login") . '">LOGIN</a>
                            </li>
                    ';
                        }
                        ?> </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

    <div class="footer">
        <footer class="container-fluid py-4">
            <p class="text-center mb-0">&copy; 2024 UniFit Pte. Ltd. All rights reserved.</p>
        </footer>
    </div>
    <link rel="stylesheet" href="<?= base_url('js/main.js') ?>">

</body>


</html>