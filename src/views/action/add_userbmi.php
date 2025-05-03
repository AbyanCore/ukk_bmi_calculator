<?php
require_once($UTIL_DIR . "uuid.php");
require_once($REPOSITORY_DIR . "user.php");
require_once($REPOSITORY_DIR . "userBmi.php");

$_SERVER['REQUEST_METHOD'] === 'POST' or die("Method not allowed");

$fullname = $_POST["fullname"];
$nip = $_POST["nip"];
$gender = $_POST["gender"];
$userType = $_POST["userType"];
$password = $_POST["password"];
$photo = $_FILES["photo"] ?? null;

$weight = @floatval($_POST["weight"]);
$height = @floatval($_POST["height"]);
$ideal_weight = 0.0;
$status_weight = "Ideal";

$file_path =  gen_uuid() .".". explode("/",$photo["type"])[1];

move_uploaded_file($photo["tmp_name"], $UPLOAD_DIR . $file_path);

$res_user = addUser($fullname, $nip, $gender, $userType, $file_path, $password);

$res_userBmi = null;

if ($weight || $height) {
    if ($gender == "Pria") {
        $ideal_weight = ($height - 100) - (0.1 * ($height - 100));
    } elseif ($gender == "Wanita") {
        $ideal_weight = ($height - 100) - (0.15 * ($height - 100));
    }
    
    if ($weight > $ideal_weight + 5) {
        $status_weight = "gemuk";
    } elseif ($weight < $ideal_weight - 5) {
        $status_weight = "kurus";
    } else {
        $status_weight = "ideal";
    }
    
    $res_userBmi = addUserBmi($res_user["id"], $height, $weight, $ideal_weight, $status_weight);
}


$result = [
    'id' => $res_user['id'],
    'fullname' => $res_user['fullname'],
    'nip' => $res_user['nip'],
    'gender' => $res_user['gender'],
    'photo' => $res_user['photo'],
    'password' => $res_user['password'],
    'userType' => $res_user['userType'],
    'userBmi' => $res_userBmi,
];

echo json_encode([
    'error' => false,
    'message' => 'success',
    'data' => $result
]);