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

$sql="SELECT * FROM users WHERE username=:username";
$result = $conn->prepare($sql);
$result->bindParam('username', $username, PDO::PARAM_STR);
$result->execute();
//藉由rowCount()返回值判斷是否有此帳號
$count = $result->rowCount();

//如果查無使用者
if($count === 0){
    header("Location: login.php?errcode=2");
    exit();
}
//如果查有使用者
$row = $result->fetch(PDO::FETCH_ASSOC);
if(password_verify($password, $row['password'])){
    $_SESSION['username'] = $username;
    header("Location: index.php");
}   else {
        header("Location: login.php?errcode=2");
    }
    
?>