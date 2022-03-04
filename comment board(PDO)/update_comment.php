<?php
session_start();
require_once("connect.php");
require_once("utility.php");
$username = NULL;
$user = NULL;
$id = $_GET['id'];
if(empty($id)){
    header("Location: index.php");
}
if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
}
$stmt = $conn->prepare("SELECT * FROM comments WHERE `id` = :id");
$stmt->bindParam('id', $id, PDO::PARAM_INT);
$result = $stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
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
        <title>編輯留言</title>
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
                        <?php //判斷是否顯示登出
                        if ($username) { ?>
                        <h3 class="wellcomehello">你好! <?php 
                        echo escape($user['nickname']) ?> </h3>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" 
                            data-bs-toggle="dropdown" aria-expanded="false"> </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="check_password.php">更改暱稱</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" onclick="return confirm('確定要登出嗎?');" href="logout.php">登出</a></li>
                            </ul>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <main class="board">
            <?php //設定登入才能留言
            if ($username) { ?>
            <form class="new_comment" method="POST" action="handle_update_comment.php">
                <textarea name="content" rows="5"><?php echo escape($row['content']) ?></textarea>
                <input type="hidden" name="id" value="<?php echo escape($row['id'])?>" />
                <input class="submit_btn" type="submit" />
            </form>
            <?php }else { ?>
                <h3>請登入開啟留言功能</h3>
            <?php } ?>
        </main>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>