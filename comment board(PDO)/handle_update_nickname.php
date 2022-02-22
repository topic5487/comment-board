<?php 
session_start();
require_once("connect.php");
$new_nickname = $_POST['new_nickname'];
if(empty($new_nickname)){
    die('請輸入新暱稱');
}
$sql = "UPDATE users SET nickname='$new_nickname' WHERE username ='".$_SESSION['username'] ."'";
$statement = $conn->prepare($sql);
$statement->execute();


if($statement){
    //清除確認密碼SESSION並回首頁
    unset($_SESSION['nicknamekey']);
    header('location:index.php');
}else{
    echo "更改失敗" . $conn->errorInfo();
}
?>