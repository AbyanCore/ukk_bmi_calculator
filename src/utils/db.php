<?php
$host = "db";
$user = "root";
$pass = "letmein";
$db   = "ukk_bmi_db";
$port = 3306; // custom port

$dbcon = new mysqli($host, $user, $pass, $db, $port);

if ($dbcon->connect_error) {
    die("Connection Failed: " . $dbcon->connect_error);
}

function getDB(): mysqli {
    global $dbcon;
    return $dbcon;
}

try {
    // Check if tables exist
    $tables = ['User', 'UserBMI'];
    $tablesExist = true;
    
    foreach ($tables as $table) {
        $result = $dbcon->query("SHOW TABLES LIKE '$table'");
        if ($result->num_rows == 0) {
            $tablesExist = false;
            break;
        }
    }
    
    // Create tables if they don't exist
    if (!$tablesExist) {
        // Create User table
        $createUserTable = "CREATE TABLE IF NOT EXISTS User (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            fullname VARCHAR(100) NOT NULL,
            nip VARCHAR(20),
            gender ENUM('Pria','Wanita') NOT NULL,
            photo VARCHAR(100) NOT NULL,
            password VARCHAR(255) NOT NULL,
            userType ENUM('admin','guru','siswa','lainnya') NOT NULL
        )";
        
        if (!$dbcon->query($createUserTable)) {
            throw new Exception("Error creating User table: " . $dbcon->error);
        }
        
        // Create UserBMI table
        $createBMITable = "CREATE TABLE IF NOT EXISTS UserBMI (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            weight FLOAT NOT NULL,
            height FLOAT NOT NULL,
            ideal_weight FLOAT NOT NULL,
            status_weight ENUM('gemuk','ideal','kurus') NOT NULL,
            FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE ON UPDATE CASCADE
        )";
        
        if (!$dbcon->query($createBMITable)) {
            throw new Exception("Error creating UserBMI table: " . $dbcon->error);
        }
        
        // Insert initial admin user if not exists
        $adminCheck = $dbcon->query("SELECT id FROM User WHERE fullname = 'admin' AND userType = 'admin'");
        
        if ($adminCheck->num_rows == 0) {
            $insertAdmin = "INSERT INTO User (fullname, nip, gender, photo, password, userType) 
                          VALUES ('admin', NULL, 'Pria', 'none', 'admin', 'admin')";
            
            if (!$dbcon->query($insertAdmin)) {
                throw new Exception("Error inserting admin user: " . $dbcon->error);
            }
        }
    }
} catch (Exception $e) {
    error_log($e->getMessage());
}