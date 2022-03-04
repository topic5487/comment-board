<?php
session_start();
require_once("connect.php");
//檢查是否輸入
if(empty($_POST['nickname']) || empty($_POST['password']) || empty($_POST['username']) || empty($_POST['email']) ){
    print "<script language=
    \"JavaScript\">alert
    (\"資料不齊\");
    location.href='register.php';
    </script>";
    die();
}

$nickname = $_POST["nickname"];
$username = $_POST["username"];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];

$sql="INSERT INTO users(nickname, username, password, email) VALUES (:nickname, :username, :password, :email)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":nickname", $nickname, PDO::PARAM_STR);
$stmt->bindParam(":username", $username, PDO::PARAM_STR);
$stmt->bindParam(":password", $password, PDO::PARAM_STR);
$stmt->bindParam(":email", $email, PDO::PARAM_STR);

try {$result=$stmt->execute();
}catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        print "<script language=
        \"JavaScript\">alert
        (\"資料已被註冊\");
        location.href='register.php';
        </script>";
        die();
    } else {
        print "<script language=
        \"JavaScript\">alert
        (\"預料外錯誤\");
        location.href='register.php';
        </script>";
        die();
    }
 }


//註冊完成即登入
$_SESSION['username'] = $username;
header("Location: index.php");
?>