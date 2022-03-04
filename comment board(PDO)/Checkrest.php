<?php
require_once("connect.php");
require_once("utility.php");
echo '<link rel="icon" type="image/x-icon" href="favicon.ico" />';
echo '<link href="css/styles.css" type="text/css" rel="stylesheet">';
echo '<link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600" rel="stylesheet" type="text/css">';
echo '<link href="css/normalize.min.css" type="text/css" rel="stylesheet">';

$token = $_GET['token'];
$email = $_GET['email'];

$sql = "SELECT * FROM users WHERE email=:email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row){
    //創建token值並與$token進行對比
    $mt = md5($row['id'].$row['username'].$row['password']);
        if($mt==$token){
            //判斷網址是否過期
            if(time()-intval($row['getpasstime'])<24*60*60){ ?>
            <form method="POST" action="handle_Checkrest.php" name="update" onsubmit="return check_restpwd()">
            <input type="hidden" name="action" value="update" />
            <div class="form">
                <div class="tab-content">
                    <div id="signup">
                        <h1>重置密碼</h1>   
                    </div>
                    <div class="field-wrap">
                        <label>
                            請輸入新密碼<span class="req">*</span>
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
                    <input type="hidden" name="email" value="<?php echo $email;?>"/>
                    <button type="submit" id="submit" class="button button-block">下一步</button>
                    <script src='js/jquery.min.js'></script>
                    <script src="js/index.js"></script>
                    <script src="js/scripts.js"></script>
                </form>
                </div>
            </div
            <?php
            }else{
                print "<script language=
                \"JavaScript\">alert
                (\"此網址已過期\");
                location.href='forget.php';
                </script>";
                die();
            }
        }else{
            print "<script language=
            \"JavaScript\">alert
            (\"無效的網址\");
            location.href='forget.php';
            </script>";
            die();
         }
}else{
    print "<script language=
    \"JavaScript\">alert
    (\"無效的網址\");
    location.href='forget.php';
    </script>";
    die();
}
?>