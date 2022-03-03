<?php
require_once("connect.php");
if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
    $upwd = stripslashes(trim($_POST['password']));
    $cpwd = stripslashes(trim($_POST['repwd']));
    $email = $_POST["email"];
        if($upwd != $cpwd){
            print "<script language=
            \"JavaScript\">alert
            (\"兩次密碼不一致\");
            </script>";
            die();
        }
    }else{
        header("Location: index.php");
    }

$pass1 = password_hash($_POST['password'], PASSWORD_DEFAULT);
$sql = "UPDATE users SET password=:password WHERE email=:email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $pass1, PDO::PARAM_STR);
$stmt->execute(); 
if($stmt){
    print "<script language=
    \"JavaScript\">alert
    (\"密碼變更成功\");
    location.href='register.php';
    </script>";
}else{
    print "<script language=
    \"JavaScript\">alert
    (\"密碼變更失敗\");
    location.href='forget.php';
    </script>";
}
?>