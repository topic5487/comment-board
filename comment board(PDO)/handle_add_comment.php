<?php
session_start();
require_once("connect.php");
require_once("utility.php");

if(empty($_POST['content'])){
    print "<script language=
        \"JavaScript\">alert
        (\"資料已被註冊\");
        location.href='index.php';
        </script>";
        die();
} 
$user_id = $_SESSION['username'];
$content = $_POST["content"];

$sql="INSERT INTO comments(user_id, content) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$user_id, $content]);
if(!$result){
    die($conn->error);
}

header("Location: index.php");
?>