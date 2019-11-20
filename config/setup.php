<?php
    require_once 'database.php';
    $pdo = new PDO("mysql:host=$host;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'CREATE DATABASE IF NOT EXISTS ' . $db_name .' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $sql = 'USE ' . $db_name;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(50) NOT NULL,
        `username` VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        `groups` INT NOT NULL,
        `password` VARCHAR(64) NOT NULL,
        salt VARCHAR(350) NOT NULL,
        confirmed TINYINT DEFAULT 0,
        notify	TINYINT DEFAULT 0,
        joined DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    // $sql = 'CREATE TABLE IF NOT EXISTS user_session (
    //     s_id INT AUTO_INCREMENT PRIMARY KEY,
    //     u_id INT NOT NULL,
    //     hash VARCHAR(64) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute();
    $sql = 'CREATE TABLE IF NOT EXISTS images (
        i_id INT AUTO_INCREMENT PRIMARY KEY,
        u_id INT NOT NULL,
        i_dest VARCHAR(130) NOT NULL,
        i_name VARCHAR(64) NOT NULL,
        creation_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $sql = 'CREATE TABLE IF NOT EXISTS comments (
        c_id INT AUTO_INCREMENT PRIMARY KEY,
        i_id INT NOT NULL,
        u_id INT NOT NULL,
        commenter_id INT NOT NULL,
        comment LONGBLOB NOT NULL,
        creation_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $sql = 'CREATE TABLE IF NOT EXISTS likes (
        l_id INT AUTO_INCREMENT PRIMARY KEY,
        i_id INT NOT NULL,
        u_id INT NOT NULL,
        liker_id INT NOT NULL,
        creation_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>
