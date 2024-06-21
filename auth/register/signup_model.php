<?php


function get_email(object $pdo, string $email)
{
    $query = "SELECT email FROM accounts WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function set_user(object $pdo, string $email, string $password, string $name, string $group_name)
{
    $query = "INSERT INTO accounts (email, password, name, position, group_name) VALUES (:email, :password, :name, :position, :group_name)";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":password", $hashedPassword);
    $stmt->bindValue(":name", $name);
    $stmt->bindValue(":position", 'student');
    $stmt->bindValue(":group_name", $group_name);
    $stmt->execute();
}
