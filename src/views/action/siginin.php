<?php
require_once($GLOBALS["REPOSITORY_DIR"] . "auth.php");

$user = Signin($_POST["fullname"], $_POST["password"]);

if (isset($user)) {
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["fullname"] = $user["fullname"];
    $_SESSION["userType"] = $user["userType"];
    $_SESSION["isLoggedIn"] = true;
} else {
    $_SESSION["isLoggedIn"] = false;
    $_SESSION["isAdmin"] = false;
}

header("Location: /dashboard");