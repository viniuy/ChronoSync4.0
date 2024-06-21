<?php
$host = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$database_name = "ChronoSync";
$account_table = 'accounts';
$resources_table = 'resources';
$myfile_table = 'myFile';
$calendar_table = 'calendar_event_master';
$my_table = 'announcements';
$files_table = 'files';
$tasks_table = 'tasks';

try {
    // Create a new PDO instance without specifying a database
    $pdo = new PDO("mysql:host=$host", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database_name`");

    // Reconnect to the newly created database
    $pdo->exec("USE `$database_name`");

    // Function to get folders
    function getFolders($parentFolder)
    {
        global $pdo;
        $parentFolder = $pdo->quote($parentFolder); // Quote input for security
        $query = "SELECT * FROM folders WHERE parent_folder = $parentFolder";
        $stmt = $pdo->query($query);
        $folders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $folders;
    }

    // Function to get folder name
    function getFolderName($folderId)
    {
        global $pdo;
        $folderId = $pdo->quote($folderId); // Quote input for security
        $query = "SELECT name FROM folders WHERE id = $folderId";
        $stmt = $pdo->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['name'];
    }

    // Function to get files in a folder
    function getFiles($folderId)
    {
        global $pdo;
        $folderId = $pdo->quote($folderId); // Quote input for security
        $query = "SELECT * FROM files WHERE folder_id = $folderId";
        $stmt = $pdo->query($query);
        $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $files;
    }

    // Create tables if they do not exist
    $sql_create_account_table = "CREATE TABLE IF NOT EXISTS `$account_table` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        position VARCHAR(255) DEFAULT 'student',
        group_name VARCHAR(255) NOT NULL
    )";
    $pdo->exec($sql_create_account_table);

    $sql_create_my_table = "CREATE TABLE IF NOT EXISTS `$my_table` (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        image VARCHAR(255) NOT NULL,
        archived TINYINT NULL,
        url VARCHAR(255) NULL
    ) ENGINE=InnoDB";
    $pdo->exec($sql_create_my_table);

    $sql_create_files_table = "CREATE TABLE IF NOT EXISTS `$files_table` (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        filename VARCHAR(255) NOT NULL,
        filesize INT NOT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        user_id INT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES `$account_table`(id)
    ) ENGINE=InnoDB";
    $pdo->exec($sql_create_files_table);

    $sql_create_resource_table = "CREATE TABLE IF NOT EXISTS `$resources_table` (
        resource_id INT AUTO_INCREMENT PRIMARY KEY,
        resource_name VARCHAR(255) NOT NULL,
        resource_url VARCHAR(255) NOT NULL,
        user_id INT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES `$account_table`(id)
    )";
    $pdo->exec($sql_create_resource_table);

    $sql_create_tasks_table = "CREATE TABLE IF NOT EXISTS `$tasks_table` (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        task_name VARCHAR(255) NOT NULL,
        task_due DATE NOT NULL,
        task_priority VARCHAR(20) NOT NULL,
        task_label VARCHAR(50) NOT NULL,
        archived TINYTEXT NOT NULL,
        user_id INT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES `$account_table`(id)
    ) ENGINE=InnoDB";
    $pdo->exec($sql_create_tasks_table);

    $sql_create_calendar_table = "CREATE TABLE IF NOT EXISTS `$calendar_table` (
        event_id INT AUTO_INCREMENT PRIMARY KEY,
        event_name VARCHAR(255) NOT NULL,
        event_start_date DATE NOT NULL,
        event_end_date DATE NOT NULL,
        user_id INT NOT NULL,
        calendar_id INT NOT NULL
    ) ENGINE = InnoDB";
    $pdo->exec($sql_create_calendar_table);

    $sql_create_calendar = "CREATE TABLE IF NOT EXISTS `calendar` (
        calendar_id INT NOT NULL AUTO_INCREMENT,
        calendar_name VARCHAR(255) NOT NULL,
        user_id INT NOT NULL,
        PRIMARY KEY (calendar_id),
        FOREIGN KEY (user_id) REFERENCES `$account_table`(id)
    ) ENGINE = InnoDB";
    $pdo->exec($sql_create_calendar);

    $sql_create_shared_calendars_table = "CREATE TABLE IF NOT EXISTS `shared_calendars` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        calendar_id INT NOT NULL,
        user_id INT NOT NULL,
        role ENUM('admin', 'viewer') NOT NULL,
        FOREIGN KEY (calendar_id) REFERENCES `$calendar_table`(event_id),
        FOREIGN KEY (user_id) REFERENCES `$account_table`(id)
    ) ENGINE = InnoDB";
    $pdo->exec($sql_create_shared_calendars_table);

    $sql_create_groups_table = "CREATE TABLE IF NOT EXISTS `groups` (
        group_id INT AUTO_INCREMENT PRIMARY KEY,
        group_name VARCHAR(255) NOT NULL,
        UNIQUE (group_name)
    ) ENGINE = InnoDB";
    $pdo->exec($sql_create_groups_table);

    // Check if the foreign key constraint already exists
    $stmt = $pdo->prepare("
        SELECT COUNT(*) AS count 
        FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = :database_name 
          AND TABLE_NAME = :account_table 
          AND CONSTRAINT_NAME = 'group_CONST'
    ");
    $stmt->execute(['database_name' => $database_name, 'account_table' => $account_table]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] == 0) {
        $sql_alter_accounts_table = "
        ALTER TABLE `$account_table` ADD CONSTRAINT `group_CONST` 
        FOREIGN KEY (`group_name`) REFERENCES `groups`(`group_name`) 
        ON DELETE NO ACTION ON UPDATE NO ACTION;
        ";
        $pdo->exec($sql_alter_accounts_table);
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
