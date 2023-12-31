<?php
session_start();

require_once("../dbcon/dbconfig.php");
require_once("../functions/code.php");

$id = $_SESSION["auth_user"]["user_id"];
$conditions = array(
    array("ID" => ["=", $id])
);
$user = select("users", $conditions)[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Aperture">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mentor</title>
    <meta name="description" content="Aperture">

    <style>
        #main-content,
        .sidebar {
            display: none;
        }
    </style>

    <link rel="icon" type="image/png" href="./assets/img/favicon.png">


    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/select2.min.css">
    <link rel="stylesheet" href="./assets/css/select2-bootstrap-5-theme.min.css">
    <link rel="stylesheet" href="./assets/css/password-strength.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.4.2-web/css/all.css" />


    <script src="./assets/js/jquery-3.7.0.min.js"></script>
    <script src="./assets/js/bootstrap.js"></script>
    <script src="./assets/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="./assets/css/dash.css" />
    <link rel="stylesheet" href="./assets/css/site.css" />
</head>

<body>
    <?php
    require_once("script.php");
    ?>
    <script src="./assets/js/sweetalert2.js"></script>
    <div id="main-content">
        <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                        <img src="../uploads/<?= $user["Img_url"] ?>" alt="User">
                    </span>
                    <div class="text logo-text">
                        <span class="name">Mentor</span>
                        <span class="profession">The best choice</span>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-right toggle"></i>
            </header>

            <div class="menu-bar">
                <div class="menu">
                    <ul class="m-auto">
                        <li class="search-box">
                            <i class='fa-solid fa-magnifying-glass icon'></i>
                            <input type="text" placeholder="Search...">
                        </li>

                        <li>
                            <a href="./users.php" title="Users">
                                <i class="fa-solid fa-users icon"></i>
                                <span class="text nav-text">
                                    Users
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="./subjects.php" title="">
                                <i class="fa-solid fa-chalkboard-teacher icon"></i>
                                <span class="text nav-text">
                                    Subjects
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="./courses.php" title="Courses">
                                <i class="fa-solid fa-chalkboard icon"></i>
                                <span class="text nav-text">
                                    Courses
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="./employees.php" title="Employees">
                                <i class="fa-solid fa-person-half-dress icon"></i>
                                <span class="text nav-text">
                                    Employees
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="bottom-content">
                    <ul>
                        <li>
                            <a href="../functions/logout.php">
                                <i class="fa-solid fa-arrow-right-from-bracket icon"></i>
                                <span class="text nav-text">Logout</span>
                            </a>
                        </li>

                        <li class="mode">
                            <div class="sun-moon">
                                <i class="fas fa-sun icon sun"></i>
                                <i class="fa-solid fa-sun icon sun"></i>
                                <i class="fa-solid fa-moon icon moon"></i>
                            </div>
                            <span class="mode-text text">Light mode</span>

                            <div class="toggle-switch">
                                <span class="switch"></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>