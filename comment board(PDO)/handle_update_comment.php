<?php 
session_start();
require_once("connect.php");
$user_id = $_SESSION['username'];
$content = $_POST['content'];
$id = $_POST['id'];
if(empty($_POST['content'])){
    print "<script language=
        \"JavaScript\">alert
        (\"請輸入內容\");
        location.href='update_comment.php?id=" . $id . "';
        </script>";
        die();
}
$sql = "UPDATE comments SET `content`=:content WHERE id =:id AND user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam('user_id', $user_id, PDO::PARAM_STR);
$stmt->bindParam('content', $content, PDO::PARAM_STR);
$stmt->bindParam('id', $id, PDO::PARAM_INT);
$stmt->execute();


if($stmt){
    header('location:index.php');
}
?>