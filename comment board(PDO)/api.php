<?php
require_once("connect.php");

$pageSize = 10; //每頁顯示五條留言
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
    $pageNow=1; //則在此設定起始頁
} else {
    $pageNow = intval($_GET["page"]);
}
$pageStart = ($pageNow - 1) * $pageSize; //每一頁開始的資料序號

$statement = $conn->prepare("SELECT C.id as id, C.content as content, C.created_at as created_at, U.nickname as nickname, U.username as username FROM comments as C left join users as U on C.user_id = U.username WHERE C.deleted_date IS NULL  ORDER BY C.id DESC LIMIT :pageSize OFFSET :pageStart");

$statement->bindParam(':pageSize', $pageSize, PDO::PARAM_INT);
$statement->bindParam(':pageStart', $pageStart, PDO::PARAM_INT);
$result = $statement->execute();

if(!$result){
    die($conn->errorInfo());
}

$comments = array();
while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    array_push($comments,array(
        "id" => $row['id'],
        "content" => $row['content'],
        "created_at" => $row['created_at'],
        "nickname" => $row['nickname'],
        "username" => $row['username']
    ));
}
$json = array("comments" => $comments);
$response = json_encode($json);
header('Content-Type: application/json; charset=utf-8');
echo $response;
?>