<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];


    try {
        require_once '../important/sqlconnect.php';
        require_once './login_model.php';
        require_once './login_contr.php';

        //ERROR HANDLERS
        $errors = [];
        // ERROR HANDLERSs
        if (is_input_empty($email, $password)) {
            $errors["empty_input"] = "Fill in all fields";
        }

        $result = get_user($pdo, $email);

        if (is_username_wrong($result)) {
            $errors['login_incorrect'] = "Incorrect Login Info";
        }

        if (!is_username_wrong($result) && is_password_wrong($password, $result["password"])) {
            $errors['login_incorrect'] = "Incorrect Password";
        }



        require_once '../important/session.php'; //Session start()


        if ($errors) {
            $_SESSION["error_signup"] = $errors;

            header('Location: login.php');
            die();
        }

        // $newSessionId = session_create_id();
        // $sessionId = $newSessionId . "_" . $result["id"];
        // session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["full_name"] = $result["name"];
        $_SESSION["user_email"] =  htmlspecialchars($result["email"]);

        $_SESSION["last_regeneration"] = time();

        if (is_admin($pdo, $email)) {
            $_SESSION["admin"] =  htmlspecialchars($result["admin"]);
        }

        header("Location: ../../index.php");
        $pdo = null;
        $statement = null;

        die();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../login.php?login=error");
    die();
}
