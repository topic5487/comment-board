<?php 
session_start();
require_once("connect.php");
$id = $_GET['id'];
if(empty($_GET['id'])){
    header('Location: index.php?errcode=1');
    die("資料不齊全");
}
//soft delete
$sql = "UPDATE comments SET deleted_date=NOW() WHERE `id` =:id";
$statement = $conn->prepare($sql);
$statement->bindParam('id', $id, PDO::PARAM_INT);
$statement->execute();


if($statement){
    header('location:index.php');
}
?>