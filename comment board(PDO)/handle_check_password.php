<?php
session_start();
require_once("connect.php");
require_once("utility.php");

if(empty($_POST['password'])){
    header("Location: check_password.php?errcode=1");
    die();
}

$password = $_POST["password"];
$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username'] ."'";
$statement = $conn->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
print_r($result);
if(password_verify($password, $result['password'])) {
    header("Location:update_nickname.php");
} else {
    header("Location: check_password.php?errcode=2");
}
?>