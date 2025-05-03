<?php
require_once($REPOSITORY_DIR . "user.php");

$_SERVER['REQUEST_METHOD'] === 'DELETE' or die("Method not allowed");

$user_id = intval($_GET["user_id"]);

$result = deleteUser($user_id);

if ($result) {
    echo json_encode([
        'error' => false,
        'message' => 'User deleted successfully',
        'data' => $result,
    ]);
} else {
    echo json_encode([
        'error' => true,
        'message' => 'Failed to delete user',
    ]);
}