<?php
require_once("connect.php");

if(isset($_POST['username'])){
    $username = $_POST['username'];
 
    // Check username
    $stmt = $conn->prepare("SELECT count(*) FROM users WHERE username=:username");
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute(); 
    $count = $stmt->fetchColumn();
 
    $response = "<span style='font-weight:bold; font-size:20px; color:white;'>此帳號可用</span>";
    if($count > 0){
       $response = "<span style='font-weight:bold; font-size:20px; color:#E62719;'>此帳號已被使用</span>";
    }
 
    echo $response;
    exit;
 }
?>