<?php
session_start();
//檢查是否登入
if(!isset($_SESSION["username"])){
print "<script language=\"JavaScript\">
alert(\"請先登入\");
location.href='index.php';
</script>";
}elseif(!isset($_SESSION["nicknamekey"])){
    //檢查是否已通過密碼確認
    print "<script language=\"JavaScript\">
    alert(\"請先驗證密碼\");
    location.href='index.php';
    </script>";
}
?>