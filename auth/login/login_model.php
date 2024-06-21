<?php
function get_user(object $pdo, string $email)
{
    $query = "SELECT * FROM accounts WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function is_admin(object $pdo, string $email)
{
    $query = "SELECT position FROM accounts WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result['position'] === "admin") {
        return true;
    } else {
        return false;
    }
}
