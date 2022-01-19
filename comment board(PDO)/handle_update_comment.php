<?php 
session_start();
require_once("connect.php");
$content = $_POST['content'];
$id = $_POST['id'];
if(empty($_POST['content'])){
    header('Location: update_comment.php?errcode=1&id='.$_POST['id']);
    die("資料不齊全");
}
$sql = "UPDATE comments SET `content`=:content WHERE `id` =:id";
$statement = $conn->prepare($sql);
$statement->bindParam('content', $content, PDO::PARAM_STR);
$statement->bindParam('id', $id, PDO::PARAM_INT);
$statement->execute();


if($statement){
    header('location:index.php');
}
?>