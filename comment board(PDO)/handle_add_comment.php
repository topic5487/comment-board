<?php
session_start();
require_once("connect.php");
require_once("utility.php");

if(empty($_POST['content'])){
    header("Location:index.php?errcode=1");
    die("資料不齊");
} 
$user_id = $_SESSION['username'];
$content = $_POST["content"];

$sql="INSERT INTO comments(user_id, content) VALUES (?, ?)";
$statement = $conn->prepare($sql);
$result = $statement->execute([$user_id, $content]);
if(!$result){
    die($conn->error);
}

header("Location: index.php");
?>