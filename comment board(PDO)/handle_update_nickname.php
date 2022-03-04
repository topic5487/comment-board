<?php 
session_start();
require_once("connect.php");
$new_nickname = $_POST['new_nickname'];
if(empty($new_nickname)){
    print "<script language=
        \"JavaScript\">alert
        (\"請輸入內容\");
        location.href='index.php';
        </script>";
        die();
}
$sql = "UPDATE users SET nickname='$new_nickname' WHERE username ='".$_SESSION['username'] ."'";
$stmt = $conn->prepare($sql);
$stmt->execute();


if($stmt){
    //清除確認密碼SESSION並回首頁
    unset($_SESSION['nicknamekey']);
    header('location:index.php');
}else{
    echo "更改失敗" . $conn->errorInfo();
}
?>