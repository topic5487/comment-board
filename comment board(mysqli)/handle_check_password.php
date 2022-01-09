<?php
session_start();
require_once("connect.php");
require_once("utility.php");

if(empty($_POST['password'])){
    header("Location: check_password.php?errcode=1");
    die();
}

$password = $_POST["password"];
$sql = "SELECT * FROM users WHERE username ='".$_SESSION['username'] ."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if(password_verify($password, $row['password'])) {
    header("Location:update_nickname.php");
} else {
    header("Location: check_password.php?errcode=2");
}
?>