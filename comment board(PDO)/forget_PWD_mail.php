<?php
require_once("connect.php");
require_once("send_restpwd_mail.php");
$email = stripslashes(trim($_POST['mail']));

$sql="SELECT * FROM users WHERE email=:email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute(); 
$count = $stmt->rowCount();

if($count==0){//查無郵箱
    echo 'noreg';
    exit;
}else{
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $getpasstime = time();
    $uid = $row['id'];
    $token = md5($uid.$row['username'].$row['password']);//組合驗證碼
    $url = "http://localhost/work_comments/comment%20board(PDO)/Checkrest.php?email=".$email."&token=".$token;
    date_default_timezone_set("Asia/Taipei");
    $time = date('Y-m-d H:i');
    $result = sendmail($time,$email,$url);
    if($result == 1){//郵件發送成功
        $sql= "UPDATE users SET getpasstime=$getpasstime WHERE id=$uid"; //記錄用戶密碼活動的時間
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }else{
        $msg = '郵件發送失敗 預料外錯誤';
    }
    echo $msg;
}
?>