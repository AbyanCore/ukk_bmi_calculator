<?php
$host = "localhost";
$user = "root";
$pass = "letmein";
$db   = "ukk_bmi_db";
$port = 8011; // custom port

$dbcon = new mysqli($host, $user, $pass, $db, $port);

if ($dbcon->connect_error) {
    die("Connection Failed: " . $dbcon->connect_error);
}

function getDB(): mysqli {
    global $dbcon;
    return $dbcon;
}