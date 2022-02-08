<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>會員註冊</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="bodybackground">
        <script src="scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Comments</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">返回留言板</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">登入</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
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
            <form class="new_comment" method="POST" action="handle_register.php" onsubmit="return check_input()">
                <div class="board_nickname">
                    <span class="text-danger">*</span>
                    <span style="font-size:20px; color:white;">暱稱：</span>
                    <input type="text" name="nickname"/>
                </div>
                <div class="board_nickname">
                    <span class="text-danger">*</span>
                    <span style="font-size:20px; color:white;">帳號：</span>
                    <input type="text" id="username" name="username"/>
                    <span id="uname_response"></span>
                </div>
                <div class="board_nickname">
                    <span class="text-danger">*</span>
                    <span style="font-size:20px; color:white;">密碼：</span>
                    <input type="password" id="upwd" name="password"/>
                </div>
                <div class="board_nickname">
                    <span class="text-danger">*</span>
                    <span style="font-size:20px; color:white;">確認密碼：</span>
                    <input type="password" id="cpwd" name="cpassword" onkeyup="checkpassword()"/>
                    <span id="pwd_response"></span>
                </div>
                <div class="board_nickname">
                    <span class="text-danger">*</span>
                    <span style="font-size:20px; color:white;">E-MAIL：</span>
                    <input type="email" name="email"/>
                </div>
                <span class="required_warning">* 為必填欄位，請填妥欄位資訊。 <br> </span>
                <input class="submit_btn" id="submit" type="submit" />
                <script>
                    $(document).ready(function(){
                    $("#username").keyup(function(){
                        var username = $(this).val().trim(); 
                        if(username != ''){
                            $.ajax({
                                url:'ajaxfile.php',
                                type:'POST',
                                data:{username:username},
                                success:function(response){
                    
                                    // Show response
                                    $("#uname_response").html(response);
                                }
                            });
                        }else{
                            $("#uname_response").html("");
                        }
                    });
                });
                </script>
            </form>
        </main>
    </body>
</html>
