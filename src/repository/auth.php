<?php

require_once($GLOBALS["DB_DIR"]);

function Signin(string $fullname,string $password) {
    session_start();
    $stmt = getDB()->prepare("SELECT * FROM User WHERE fullname = ? AND password = ?");
    $stmt->bind_param("ss", $fullname, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

function Signout() {
    session_start();
    session_destroy();
}