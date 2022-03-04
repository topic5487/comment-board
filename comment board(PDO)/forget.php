<?php
session_start();
require_once("connect.php");
require_once("utility.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>找回密碼</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.min.css">
</head>
<body class="bodybackground">
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
                <li class="nav-item"><a class="nav-link active" href="register.php">登入</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Page content-->
<div class="form">
    <div class="tab-content">
        <div id="signup">
            <h1>找回密碼</h1>
            <form method="POST" action="">   
        </div>
        <div class="field-wrap">
            <label>
                E-mail<span class="req">*</span>
                <span id="chkmsg"></span>
            </label>
            <input class="register" type="email" id="email" name="email" required autocomplete="off" />
        </div>
        <button type="submit" id="submit" class="button button-block">下一步</button>

            </form>

    </div><!-- tab-content -->

</div> <!-- /form -->
    <script src='js/jquery.min.js'></script>
    <script src="js/index.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        $(function(){
        $("#submit").click(function(){
            var email = $("#email").val();
            var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
            if(email=='' || !preg.test(email)){
                $("#chkmsg").html("請填寫正確郵箱");
            }else{
                //設置submit為disabled 防止重複點擊
                $("#submit").prop("disabled",true);
                $.post("forget_PWD_mail.php",{mail:email},function(msg){
                    if(msg=="noreg"){
                        $("#chkmsg").html("<span style='font-weight:bold; font-size:20px; color:#E62719;'>此信箱未註冊</span>");
                        $("#submit").removeAttr("disabled",false);
                    }else{
                        $("#chkmsg").html("<span style='font-weight:bold; font-size:20px; color:white;'>已發送重置密碼信件</span>");
                    }
                });
            }
        });
    })
    </script>
    </body>
</html>
