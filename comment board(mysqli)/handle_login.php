<?php
session_start();
require_once("connect.php");
require_once("utility.php");

if(empty($_POST['username']) || empty($_POST['password'])){
    header("Location: login.php?errcode=1");
    die();
}

$username = $_POST["username"];
$password = $_POST["password"];

$sql="SELECT * FROM users WHERE username=?";
$statement = $conn->prepare($sql);
$statement->bind_param('s', $username);
$result=$statement->execute();

if(!$result){
    die($conn->error);
}
//如果查無使用者
$result = $statement->get_result();
if($result->num_rows === 0){
    header("Location: login.php?errcode=2");
    exir();
}
//如果查有使用者
$row = $result->fetch_assoc();
if(password_verify($password, $row['password'])){
    $_SESSION['username'] = $username;
    header("Location: index.php");
}else {
    header("Location: login.php?errcode=2");
}

?>