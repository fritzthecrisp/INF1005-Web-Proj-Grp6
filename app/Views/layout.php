<!DOCTYPE html>
<html lang="en">

<head>
    <title>UniFit</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>

<body>
    <div class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="<?= site_url("Home") ?>"><img src="/img/logos.png" alt="logo" id="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <?php
                        if (isset($_COOKIE['user_logged_in']) && $_COOKIE['user_logged_in'] == true) {
                            // If the user is logged in (cookie is set), show profile link
                            echo '<li class="nav-item">
                              <a class="nav-link" href="/register.php">MY WORKOUT</a>
                          </li>
                          <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">PROFILE</a>
                          <ul class="dropdown-menu dropdown-menu-end">
                              <li>
                                  <a class="" href="' . site_url("profile") . '">MY PROFILE</a>
                              </li>
                              <li>
                                  <a class="dropdown-item" href="#">SETTINGS</a>
                              </li>
                              <li>
                                  <a class="dropdown-item" href="/logout.php">LOGOUT</a>
                              </li>
                          </ul>
                      </li>';
                        } else {
                            // If the user is not logged in (cookie is not set), show login link
                            echo '<li class="nav-item">
                            <a class="nav-link w3-bar-item w3-button w3-hover-none w3-border-white w3-bottombar w3-hover-border-black" href="' . site_url("register") . '">SIGN UP</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link w3-bar-item w3-button w3-hover-none w3-border-white w3-bottombar w3-hover-border-black" href="' . site_url("login") . '">LOGIN</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link w3-bar-item w3-button w3-hover-none w3-border-white w3-bottombar w3-hover-border-black" href="' . site_url("myWorkout") . '">MY WORKOUT</a>
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
            <div class="row">
                <div class="col-md-6 footer_sections">
                    <p class="text-uppercase mb-2"><u>About</u></p>
                    <ul class="list-unstyled">
                        <li><a href="<?= site_url("about") ?>" class="text-reset" style="text-decoration: none;">About Us</a></li>
                        <li><a href="#" class="text-reset" style="text-decoration: none;">Motto</a></li>
                        <li><a href="#" class="text-reset" style="text-decoration: none;">Team</a></li>
                    </ul>
                </div>
                <div class="col-md-6 footer_sections">
                    <p class="text-uppercase mb-2"><u>Others</u></p>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-reset" style="text-decoration: none;">Contact Us</a></li>
                        <li><a href="#" class="text-reset" style="text-decoration: none;">Q&A</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    <link rel="stylesheet" href="<?= base_url('js/main.js') ?>">
</body>

</html>