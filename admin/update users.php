﻿<?php
require_once("../dbcon/dbconfig.php");
require_once("../functions/code.php");

$title = "Update users";
include("includes/header.php");

if (isset($_SESSION["auth"])) {
    if ($_SESSION["roleAs"] != 1) {
        re_direct("../index.php", "warning", "You are not the admin");
        die();
    }
} else {
?>
    <script>
        window.location.assign("../index.php")
    </script>
<?php
    die();
}

$id = encrypt_machine("decrypt", $_GET['id']);
$conditions = array(
    array("ID" => ["=", $id])
);
$user = select("users", $conditions)[0];
$nameParts = explode(" ", $user['Name']);
$fname = $nameParts[0];
$lname = $nameParts[1];
?>
<main role="main" class="home text main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="card navbar navbar-main navbar-expand-lg px-0 mx-4 border-radius-xl shadow-none" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3 d-flex justify-content-between">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm opacity-5 text-dark">
                        Pages
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active">
                        <?= (basename($_SERVER['PHP_SELF'], ".php") == 'index') ? "Dashboard" : ucwords(basename($_SERVER['PHP_SELF'], ".php")) ?>
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0"><?= (basename($_SERVER['PHP_SELF'], ".php") == 'index') ? "Dashboard" : ucwords(basename($_SERVER['PHP_SELF'], ".php")) ?></h6>
            </nav>
            <ul class="navbar-nav  d-flex  align-items-end justify-content-around">
                <li class="nav-item px-3">
                    <a href="profile.php" class="nav-link p-0 text-body">
                        <i class="fa fa-user fixed-plugin-button-nav cursor-pointer fs-4" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->

    <header class="card my-3 mx-4 border-radius-xl shadow-none d-flex justify-content-center align-items-center">
        <div class="text-center my-3">
            <img class="img-fluid rounded-circle" style="width: 150px;" src="../uploads/<?= $user["Img_url"] ?>" alt="..." />
        </div>
    </header>

    <div class="card my-2 mx-4 border-radius-xl shadow-none">
        <div class="container-fluid p-4">
            <form enctype="multipart/form-data" action="users_conf.php?action=<?= isset($_GET["action"]) ? $_GET["action"] : "" ?>&id=<?= $user['ID'] ?>&img=<?= $user['Img_url'] ?>" method="post" class="row needs-validation" novalidate>
                <div class="my-2 col-lg-3 col-md-4 col-sm-12 form-outline">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" aria-describedby="inputGroupPrepend3 nameFeedback">
                </div>

                <div class="my-2 col-lg-3 col-md-4 col-sm-6 form-outline">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" aria-describedby="inputGroupPrepend3 nameFeedback" required value=<?= "{$fname}" ?>>
                    <div id="fnameFeedback" class="invalid-feedback">
                        Write your first name correctly!
                    </div>
                </div>

                <div class="my-2 col-lg-3 col-md-4 col-sm-6 form-outline">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" aria-describedby="inputGroupPrepend3 nameFeedback" required value=<?= "{$lname}" ?>>
                    <div id="lnameFeedback" class="invalid-feedback">
                        Write your last name correctly!
                    </div>
                </div>

                <div class="my-2 col-lg-3 col-md-4 col-sm-6 form-outline">
                    <label class="form-label" for="phone">Phone number</label>
                    <input type="tel" id="phone" class="form-control" placeholder="7xxxxxxxx" name="phone" value=<?= "{$user['Phone']}" ?> />
                    <div id="phoneFeedback" class="invalid-feedback">
                        Write your number correctly!
                    </div>
                </div>

                <div class="my-2 col-lg-2 col-md-2 col-sm-6 form-outline">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required value=<?= "{$user['Username']}" ?>>
                    <div id="usernameFeedback" class="invalid-feedback">
                        Please write a valid username.
                    </div>
                </div>

                <div class="my-2 col-lg-4 col-md-4 col-sm-12 form-outline">
                    <label for="email" class="form-label">Email address</label>
                    <input type="text" class="form-control" id="email" aria-describedby="emailHelp" autocomplete="off" placeholder="name@domain.com" name="email" required value=<?= "{$user['Email']}" ?>>
                    <div id="emailHelp" class="form-text">
                    </div>
                    <small class="form-text text-danger invalid-feedback">Email must be valid!</small>
                </div>

                <div class="my-2 col-lg-2 col-md-2 col-sm-3 form-outline">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option disabled>You are...</option>
                        <?php
                        $genderOptions = [
                            1 => "Male",
                            2 => "Female",
                            3 => "Don't mention it"
                        ];

                        foreach ($genderOptions as $value => $label) {
                            $selected = ($user['Gender'] == $value) ? 'selected' : '';
                            echo "<option value=\"$value\" $selected>$label</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="my-2 col-lg-2 col-md-2 col-sm-3 form-outline">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option disabled>The role is...</option>
                        <?php
                        $all_roles = select("roles");

                        foreach ($all_roles as $values) {
                            $selected = ($user["Role_id"] == $values['ID']) ? ' selected' : '';
                            echo "<option value=\"{$values['ID']}\"$selected>{$values['Name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-lg-1 col-md-1 col-sm-2 form-check mt-5">
                    <div class="form-check">
                        <?php
                        ($user["Is_active"] == 1) ? $check = "checked" : $check = " "

                        ?>
                        <input <?= $check ?> name="active" class="form-check-input" type="checkbox" id="flexCheckDefault">
                        <label class="form-check-label text-black" for="flexCheckDefault">
                            Active
                        </label>
                    </div>
                    <div class="invalid-feedback">
                        You must tell the account is active or not!
                    </div>
                </div>

                <div class="my-2 row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <a href="users.php" class="btn btn-danger m-auto">Cancel</a>
                        <input type="submit" name="update-user-btn" value="Update" class="btn btn-success new-btn m-auto"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php
include("includes/footer.php");
?>