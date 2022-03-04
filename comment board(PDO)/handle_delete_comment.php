<?php 
session_start();
require_once("connect.php");
$user_id = $_SESSION['username'];
$id = $_GET['id'];
if(empty($_GET['id'])){
    print "<script language=
        \"JavaScript\">alert
        (\"資料不齊\");
        location.href='index.php';
        </script>";
        die();
}
//soft delete
$sql = "UPDATE comments SET deleted_date=NOW() WHERE id =:id AND user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam('id', $id, PDO::PARAM_INT);
$stmt->bindParam('user_id', $user_id, PDO::PARAM_STR);
$stmt->execute();


if($stmt){
    header('location:index.php');
}
?>