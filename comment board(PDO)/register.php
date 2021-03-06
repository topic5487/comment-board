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
?>
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
                <li class="nav-item dropdown">
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Page content-->
        <div class="form">
            <ul class="tab-group">
                <li class="tab active"><a href="#signup">註冊</a></li>
                <li class="tab"><a href="#login">登入</a></li>
            </ul>
            <div class="tab-content">
                <div id="signup">
                    <h1>Sign Up for Free</h1>
                    <form method="POST" action="handle_register.php" onsubmit="return check_input()">
                        <div class="top-row">
                            <div class="field-wrap">
                                <label>
                                    帳號<span class="req">*</span>
                                    <span id="uname_response"></span>
                                </label>
                                <input class="register" type="text" id="username" name="username" required autocomplete="off" />
                            </div>
                            
                        <div class="field-wrap">
                            <label>
                                暱稱<span class="req">*</span>
                            </label>
                            <input class="register" type="text" name="nickname" required autocomplete="off" />
                        </div>
                    </div>
                    <div class="field-wrap">
                        <label>
                            E-mail<span class="req">*</span>
                            <span id="email_response"></span>
                        </label>
                        <input class="register" type="email" id="email" name="email" required autocomplete="off" />
                    </div>

                    <div class="field-wrap">
                        <label>
                            密碼<span class="req">*</span>
                        </label>
                        <input class="register" type="password" id="upwd" name="password" required autocomplete="off" onkeyup="checkpassword()"/>
                    </div>
                    <div class="field-wrap">
                        <label>
                            確認密碼<span class="req">*</span>
                            <span id="pwd_response"></span>
                        </label>
                        <input class="register" type="password" id="cpwd" name="repwd" required autocomplete="off" onkeyup="checkpassword()"/>
                    </div>
                    <button type="submit" id="submit" class="button button-block">註冊</button>

                </form>
            </div>
            <div id="login">
                <h1>Welcome Back!</h1>

                <form method="POST" action="handle_login.php">

                    <div class="field-wrap">
                        <label>
                            帳號<span class="req">*</span>
                        </label>
                        <input class="register" type="text" name="username" required autocomplete="off" />
                    </div>

                    <div class="field-wrap">
                        <label>
                            密碼<span class="req">*</span>
                        </label>
                        <input class="register" type="password" name="password" required autocomplete="off" />
                    </div>

                    <p class="forgot"><a href="forget.php">忘記密碼?</a></p>

                    <button class="button button-block">登入</button>

                </form>
            </div>

        </div><!-- tab-content -->

    </div> <!-- /form -->
    <script src='js/jquery.min.js'></script>
    <script src="js/index.js"></script>
    <script src="js/scripts.js"></script>
                <script>
                    //檢查username是否重複
                    $(document).ready(function(){
                    $("#username").keyup(function(){
                        var username = $(this).val().trim(); 
                        if(username != ''){
                            $.ajax({
                                url:'ajax_checkUsername.php',
                                type:'POST',
                                data:{username:username},
                                success:function(response){
                                    if(response == true){
                                        //如果重複則禁用submit
                                        $("#submit").prop("disabled", true);
                                        // Show response
                                        $("#uname_response").html("<span style='font-weight:bold; font-size:20px; color:#E62719;'>此帳號已被使用</span>");
                                }else{
                                    $("#submit").prop("disabled", false);
                                    $("#uname_response").html("<span style='font-weight:bold; font-size:20px; color:white;'>此帳號可用</span>");
                                    }
                                }
                            });
                        }else{
                            $("#uname_response").html("");
                        }
                    });
                })
                //檢查email是否重複
                $(document).ready(function(){
                    $("#email").keyup(function(){
                        var email = $(this).val().trim(); 
                        if(email != ''){
                            $.ajax({
                                url:'ajax_checkemail.php',
                                type:'POST',
                                data:{email:email},
                                success:function(response){
                                    if(response == true){
                                        //如果重複則禁用submit
                                        $("#submit").prop("disabled", true);
                                        // Show response
                                        $("#email_response").html("<span style='font-weight:bold; font-size:20px; color:#E62719;'>此信箱已被使用</span>");
                                    }else{
                                        $("#submit").prop("disabled", false);
                                        $("#email_response").html("<span> </span>");
                                    }
                                }
                            });
                        }else{
                            $("#email_response").html("");
                        }
                    });
                })
                //發送email註冊信
                $(document).on('click', '#submit', function(){
                    var username = $('#username').val();
                    var email = $('#email').val();
                    $.ajax({
                        url:'send_register_mail.php',
                        type:'POST',
                        data:{username:$("#username").val(), email:$("#email").val()},
                        success:function(res){
                            //$('#email_response').show().html(res);
                        }
                    });
                });
                </script>
    </body>
</html>
