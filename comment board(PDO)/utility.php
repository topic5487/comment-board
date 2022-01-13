<?php
require_once("connect.php");
//產生Token
function generateToken(){
    $S = '';
    for($i=1; $i<=16; $i++){
        $S .=chr(rand(65,90));
    }
    return $S;
}

function getUserFromUsername($username){
    global $conn;
    $sql=sprintf("SELECT * FROM users WHERE username='%s'",$username);
    $statement = $conn->prepare($sql);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row; //$row已擁有id、username、nickname
}

function escape($str){
    return htmlspecialchars($str, ENT_QUOTES);
}
?>