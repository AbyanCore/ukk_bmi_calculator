<?php
require_once($GLOBALS["REPOSITORY_DIR"] . "auth.php");

Signout();

header("Location: /dashboard");