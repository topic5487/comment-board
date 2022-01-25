<?php 
session_start();
require_once("connect.php");
$user_id = $_SESSION['username'];
$content = $_POST['content'];
$id = $_POST['id'];
if(empty($_POST['content'])){
    header('Location: update_comment.php?errcode=1&id='.$_POST['id']);
    die("資料不齊全");
}
$sql = "UPDATE comments SET `content`=:content WHERE id =:id AND user_id = :user_id";
$statement = $conn->prepare($sql);
$statement->bindParam('user_id', $user_id, PDO::PARAM_STR);
$statement->bindParam('content', $content, PDO::PARAM_STR);
$statement->bindParam('id', $id, PDO::PARAM_INT);
$statement->execute();


if($statement){
    header('location:index.php');
}
?>