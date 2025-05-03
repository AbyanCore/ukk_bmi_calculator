<?php

require_once($GLOBALS["DB_DIR"]);

function getUserById(int $id) {
    $stmt = getDB()->prepare("SELECT * FROM User WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getAllUsers() {
    $stmt = getDB()->prepare("SELECT * FROM User");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function addUser(string $fullname, string $nip, string $gender, string $userType, string $photo, string $password, ) {
    $stmt = getDB()->prepare("INSERT INTO User (fullname, nip, gender, userType, photo, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullname, $nip, $gender, $userType, $photo, $password);
    $stmt->execute();
    $result = getUserById($stmt->insert_id);
    return $result;
}

function updateUser(int $id, string $fullname, string $nip, string $gender, string $userType, string $photo, string $password) {
    $stmt = getDB()->prepare("UPDATE User SET fullname = ?, nip = ?, gender = ?, userType = ?, photo = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $fullname, $nip, $gender, $userType, $photo, $password, $id);
    $stmt->execute();
    $result = getUserById($id);
    return $result;
}

function deleteUser(int $id) {
    $result = getUserById($id);
    $stmt = getDB()->prepare("DELETE FROM User WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $result;
}