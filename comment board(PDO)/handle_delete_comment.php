<?php 
session_start();
require_once("connect.php");
$user_id = $_SESSION['username'];
$id = $_GET['id'];
if(empty($_GET['id'])){
    header('Location: index.php?errcode=1');
    die("資料不齊全");
}
//soft delete
$sql = "UPDATE comments SET deleted_date=NOW() WHERE id =:id AND user_id = :user_id";
$statement = $conn->prepare($sql);
$statement->bindParam('id', $id, PDO::PARAM_INT);
$statement->bindParam('user_id', $user_id, PDO::PARAM_STR);
$statement->execute();


if($statement){
    header('location:index.php');
}
?>