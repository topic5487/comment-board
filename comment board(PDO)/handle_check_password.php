<?php
session_start();
require_once("connect.php");
require_once("utility.php");

if(empty($_POST['password'])){
    print "<script language=
    \"JavaScript\">alert
    (\"資料不得為空\");
    location.href='check_password.php';
    </script>";
    die();
}

$password = $_POST["password"];
$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username'] ."'";
$statement = $conn->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
print_r($result);
if(password_verify($password, $result['password'])) {
    //session_start();
    $_SESSION["nicknamekey"] = $password;
    header("Location:update_nickname.php");

} else {
    print "<script language=
    \"JavaScript\">alert
    (\"密碼錯誤\");
    location.href='check_password.php';
    </script>";
    exit();
}
?>