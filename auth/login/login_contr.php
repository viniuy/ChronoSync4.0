<?php

function is_username_wrong($result) {
    return !$result;
}



function is_password_wrong(string $password, string $hashedpassword){
    return !password_verify($password, $hashedpassword);
}

function is_input_empty($email, $password) {
    return empty($email) && empty($password);
}