<?php
session_start();
require_once("connect.php");
require_once("utility.php");
$username = NULL;
$user=NULL;

if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
}
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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bare - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="bodybackground">
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Comments</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <?php //設定登入與否顯示註冊登入
                         if (!$username) { ?>
                         <a class="nav-link active" aria-current="page" href="register.php">註冊</a>
                         <?php } ?>
                        </li>
                        <?php //設定登入與否顯示註冊登入
                         if (!$username) { ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">登入</a>
                        <?php } ?>
                        <?php //判斷是否顯示登出
                        if ($username) { ?>
                        <h3 class="wellcomehello">你好! <?php 
                        echo $user['nickname'] ?> </h3>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" 
                            data-bs-toggle="dropdown" aria-expanded="false"> </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="check_password.php">更改暱稱</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><a class="dropdown-item" href="logout.php">登出</a></li>
                            </ul>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <main class="board">
            <?php 
            //判斷顯示資料不齊全
            if(!empty($_GET['errcode'])){
                $code=$_GET['errcode'];
                $msg='error';
                if($code === '1'){
                    $msg = "資料不齊全";
                }
                echo '<h2>' . $msg . '</h2>';
            }
            ?>
            <?php //設定登入才能留言
            if ($username) { ?>
            <form class="new_comment" method="POST" action="handle_add_comment.php">
                <textarea name="content" rows="5"></textarea>
                <input class="submit_btn" type="submit" />
            </form>
            <?php }else { ?>
                <h3>請登入開啟留言功能</h3>
            <?php } ?>
            <div class="board_hr"></div>
            <section>
                <?php
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="comment_user">
                    <div class="comment_user_avater">
                    </div>
                    <div class="comment_user_body">
                        <div class="comment_user_info">
                        <span class="comment_author"><?php echo $row['nickname'] ?></span>
                        <span><?php echo $row['created_at'] ?></span>
                        <!--//判斷是否為自己的留言 才顯示編輯刪除-->
                        <?php if ($row['username'] === $username) { ?>
                        <a class="update_comment" href="update_comment.php?id=<?php echo $row['id'] ?>">編輯</a>
                        <a class="update_comment" href="handle_delete_comment.php?id=<?php echo $row['id'] ?>">刪除</a>
                        <?php } ?>
                        </div>
                        <p class="comment_user_content"><?php echo escape($row['content']) ?>
                    </div>
                </div>
                <?php } ?>
            </section>
            <div>
            <?php
                $statement = $conn->prepare('SELECT count(id) AS count FROM comments WHERE deleted_date IS NULL');
                $result = $statement->execute();
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                $count=$row['count'];
                $pages = ceil($count / $pageSize);
            ?>
            </div>
        </main>
        <div class='page-info'>
            <?php
            echo "共有". $row['count'] . "筆留言-目前在第" .$pageNow. "頁 -共" .$pages. "頁";
            ?>
        </div>
        <div class='pagebtn'>
            <?php
            echo "<br /><a href=index.php?page=1>首頁</a> ";
            for( $i=1; $i<=$pages; $i++ ) {
                if ( $pageNow-5 < $i && $i < $pageNow+5 ){
                    echo "<a href=index.php?page=".$i.">".$i."</a> ";
                }
            }
            echo "<a href=index.php?page=". $pages .">末頁</a><br /><br />";
            ?>
            </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>