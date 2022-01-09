<?php
require_once("connect.php");
require_once("utility.php");

if(empty($_POST['content'])){
    header("Location:index.php?errcode=1");
    die("資料不齊");
}
$user = getUserFromUsername($_SESSION['username']);
$nickname = $user['nickname'];
$content = $_POST["content"];

$sql="INSERT INTO comments(nickname, content) VALUES (?, ?)";
$statement = $conn->prepare($sql);
$statement->bind_param('ss', $nickname, $content);
$result=$statement->execute();
if(!$result){
    die($conn->error);
}

header("Location: index.php");
?>