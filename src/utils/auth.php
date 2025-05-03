<?php

function isLoggedIn() {
    return isset($_SESSION['isLoggedIn']);
}

function isAdmin() {
    $userType = $_SESSION['userType'] ?? null;
    return ($userType == 'admin');
}

function getUserId() {
    return $_SESSION['user_id'] ?? null;
}