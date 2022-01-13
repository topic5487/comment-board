<?php
session_start();
require_once("connect.php");
require_once("utility.php");
$username = NULL;
if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
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
        <link href="styles.css" rel="stylesheet" />
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
                        <h3 class="wellcomehello">你好! <?php echo $user['nickname'] ?> </h3>
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
        <main class="register_board">
            <?php 
            //判斷顯示資料不齊全
            if(!empty($_GET['errcode'])){
                $code=$_GET['errcode'];
                $msg='error';
                if($code === '1'){
                    $msg = "資料不齊全";
                }else if($code === '2'){
                    $msg = "此帳號已被註冊";
                }
                echo '<h2>' . $msg . '</h2>';
            }
            ?>
            <form class="new_comment" method="POST" action="handle_update_nickname.php">
                <div class="board_nickname">
                    <span style="color:white;">請輸入新暱稱：</span>
                    <input type="text" name="new_nickname"/>
                </div>
                <input class="submit_btn" type="submit" />
            </form>
        </main>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="scripts.js"></script>
    </body>
</html>
