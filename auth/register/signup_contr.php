<?php
require_once './signup_model.php';

function is_input_empty(string $email, string $password, string $name)
{
    if (empty($email) || empty($password || empty($name) || empty($datetime))) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_email_taken(object $pdo, string $email)
{
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $email, string $password, string $name, string $group_name)
{
    set_user($pdo, $email, $password, $name, $group_name);
}
