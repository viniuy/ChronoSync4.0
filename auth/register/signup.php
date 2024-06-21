<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["username"];
    $group_name = $_POST["group_name"];

    try {
        require_once '../important/sqlconnect.php';
        require_once './signup_model.php';
        require_once './signup_contr.php';
        $errors = [];
        // ERROR HANDLERS
        if (is_input_empty($email, $password, $name)) {
            $errors["empty_input"] = "Fill in all fields";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Email invalid";
        }
        if (is_email_taken($pdo, $email)) {
            $errors["email_taken"] = "Email already taken";
        }

        require_once '../important/session.php'; //Session start()

        if (!empty($errors)) {
            $_SESSION["error_signup"] = $errors;
            header('Location: /register.php');
            die();
        }

        create_user($pdo, $email, $password, $name, $group_name);
        header('Location: /login.php');
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Query Failed : " . $e->getMessage());
    }
}
