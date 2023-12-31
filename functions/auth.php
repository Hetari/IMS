<?php
session_start();
require_once("../dbcon/dbconfig.php");
require_once("code.php");

$first_name = $last_name = $phone = $username = $email = $gender = $password = $password_confirmation = $terms = "";
$errors = array();

if (isset($_POST["login-btn"])) {
    $requiredLoginFields = [
        "email-login" => "email",
        "password-login" => "password",
    ];

    foreach ($requiredLoginFields as $field => $fieldName) {
        if (empty($_POST[$field])) {
            $errors[$field . "Empty"] = ucfirst($fieldName) . " field is required!";
        }
    }

    if (!empty($errors)) {
        re_direct("../login.php", "warning", "The email or the password are not correct");
        die();
    }

    foreach ($requiredLoginFields as $fieldName => $variableName) {
        ${$variableName} = validate($_POST[$fieldName]);
    }

    $conditions = array(
        array("Email" => ["=", $email])
    );

    $results = select("users", $conditions);

    if (!count($results)) {
        re_direct("../login.php", "warning", "The email or the password are not correct");
        die();
    }

    $db_password = $results[0]['Password'];
    $password_correct = password_verify($password, $db_password);

    if (!$password_correct) {
        re_direct("../login.php", "warning", "The email or the password are not correct");
        die();
    }

    if (!$results[0]["Is_active"]) {
        re_direct("../login.php", "error", "Your account is banned!");
        die();
    }

    $_SESSION["auth"] = true;

    $UserData = $results[0];

    $user_id = $UserData["ID"];
    $username = $UserData["Name"];
    $user_email = $UserData["Email"];
    $roleAs = $UserData["Role_id"];

    $_SESSION["auth_user"] = [
        "user_id" => $user_id,
        "name" => $username,
        "email" => $user_email,
    ];

    $_SESSION["roleAs"] = $roleAs;
    if ($roleAs == 1) {
        re_direct("../admin/index.php", "success", "Welcome to Dashboard");
        die();
    } else if ($roleAs == 2) {
        re_direct("../index.php", "success", "Logged in Successfully");
        die();
    }
} else if (isset($_POST["register-btn"])) {
    $requiredRegisterFields = [
        "fname-register" => "first_name",
        "lname-register" => "last_name",
        "phone-register" => "phone",
        "username-register" => "username",
        "email-register" => "email",
        "gender-register" => "gender",
        "password-register" => "password",
        "conPassword-register" => "password_confirmation",
        // "terms-register" => "terms"
    ];


    foreach ($requiredRegisterFields as $field => $fieldName) {
        if (empty($_POST[$field])) {
            $errors[$field . "Empty"] = ucfirst($fieldName) . " field is required!";
        }
    }

    // $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()\-_=+{};:,<.>]).*$/';

    // if (!preg_match($pattern, $password)) {
    //     $errors["Password"] = "Password should contain numbers, alphabets (both capital and small), and symbols!";
    // }

    if (!empty($errors)) {
        re_direct("../login.php", "error", "Error: " . implode(", ", $errors) . " fields are required!");
        die();
    }

    foreach ($requiredRegisterFields as $fieldName => $variableName) {
        ${$variableName} = validate($_POST[$fieldName]);
    }

    $name = ucwords(concat_str(strtolower($first_name), " ", strtolower($last_name)));

    if (!$password === $password_confirmation) {
        re_direct("../login.php", "info", "Passwords doesn't match!");
        die();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $data = [
        "name" => $name,
        "username" => $username,
        "email" => $email,
        "phone" => $phone,
        "password" => $password,
        "gender" => $gender
    ];

    $results = add("users", ...array_flatten($data));

    if ($results) {
        $_SESSION["auth"] = true;

        $UserData = $results[0];

        $user_id = $UserData["id"];
        $username = $UserData["name"];
        $user_email = $UserData["email"];
        $roleAs = $UserData["role_id"];

        $_SESSION["auth_user"] = [
            "user_id" => $user_id,
            "user_email" => $user_email,
        ];

        $_SESSION["roleAs"] = $roleAs;
        re_direct("../index.php", "success", "Logged in Successfully");
        die();
    } else {
        re_direct("../login.php#pills-login", "info", "Email is already exists Or password is so week!");
        die();
    }
}
