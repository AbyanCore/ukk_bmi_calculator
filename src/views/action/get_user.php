<?php
require_once($REPOSITORY_DIR . "user.php");
require_once($REPOSITORY_DIR . "userBmi.php");

$_SERVER['REQUEST_METHOD'] === 'GET' or die("Method not allowed");

$user_id = intval($_GET["user_id"]);

$user = getUserById($user_id);

$result = [
    'id' => $user['id'],
    'fullname' => $user['fullname'],
    'nip' => $user['nip'],
    'gender' => $user['gender'],
    'photo' => $user['photo'],
    'password' => $user['password'],
    'userType' => $user['userType'],
    'userBmi' => getUserBmiByUserId($user['id']) ?: null,
];

echo json_encode([
    "error" => false,
    "message" => "success",
    "data" => $result
]);