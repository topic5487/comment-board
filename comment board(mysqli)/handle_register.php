<?php
session_start();
require_once("connect.php");
if(empty($_POST['nickname']) || empty($_POST['password']) || empty($_POST['username'])){
    header("Location:register.php?errcode=1");
    die("資料不齊");
}

$nickname = $_POST["nickname"];
$username = $_POST["username"];

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql="INSERT INTO users(nickname, username, password) VALUES (?, ?, ?)";
$statement = $conn->prepare($sql);
$statement->bind_param("sss", $nickname, $username, $password);
$result=$statement->execute();

if(!$result){
    $code=$conn->errno;
    if($code === 1062){
        header('Location: register.php?errcode=2');
    }
    die($conn->error);
}

//註冊完成即登入
$_SESSION['username'] = $username;
header("Location: index.php");
?>