<?php
require_once("connect.php");

if(isset($_POST['username'])){
    $username = $_POST['username'];
 
    // Check username
    $stmt = $conn->prepare("SELECT count(*) FROM users WHERE username=:username");
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute(); 
    $count = $stmt->fetchColumn();
 
    //預設為false 配合success做真假判斷
    $response = false;
    if($count > 0){
       //有資料=已註冊過 則調整為true將submit禁用
       $response = true;
    }
 
    echo $response;
    exit;
 }
?>