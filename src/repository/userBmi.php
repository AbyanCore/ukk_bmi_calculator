<?php

require_once($GLOBALS["DB_DIR"]);

function getUserBmiById(int $id) {
    $stmt = getDB()->prepare("SELECT * FROM UserBMI WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getUserBmiByUserId(int $userId): mixed {
    $stmt = getDB()->prepare("SELECT * FROM UserBMI WHERE user_Id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function addUserBmi(int $userId, float $height, float $weight, float $ideal_weight, string $status_weight) {
    $stmt = getDB()->prepare("INSERT INTO UserBMI (user_id, height, weight, ideal_weight, status_weight) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iddds", $userId, $height, $weight, $ideal_weight, $status_weight);
    $stmt->execute();
    $result = getUserBmiById($stmt->insert_id);
    return $result;
}

function updateUserBmi(int $id, float $height, float $weight, float $ideal_weight, string $status_weight) {
    $stmt = getDB()->prepare("UPDATE UserBMI SET height = ?, weight = ?, ideal_weight = ?, status_weight = ? WHERE id = ?");
    $stmt->bind_param("dddsi", $height, $weight, $ideal_weight, $status_weight, $id);
    $stmt->execute();
    $result = getUserBmiById($id);
    return $result;
}
