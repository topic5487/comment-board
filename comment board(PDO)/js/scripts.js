function checkpassword() {
    var password = document.getElementById("upwd").value;
    var repassword = document.getElementById("cpwd").value;
    
    if(password == repassword) {
        document.getElementById("pwd_response").innerHTML="<span> </span>";
        document.getElementById("submit").disabled = false;
        return true;
     }else {
         document.getElementById("pwd_response").innerHTML="<span style='font-weight:bold; font-size:20px; color:#E62719;'>密碼輸入不一致!</span>";
         document.getElementById("submit").disabled = true;
     } 
}

function check_input() {
    //檢查註冊帳號是否有特殊字元
    var re = /[^a-zA-Z0-9.-_]/;
    var okname = re.exec ( document.getElementById("username").value);
    if ( okname ) {
            window.alert ( "帳號只允許英文、數字、底線、小數點與減號" );
            document.getElementById("username").focus();
            return false;
    }
    //檢查密碼長度是否正確
    var pw1 = document.getElementById("upwd");
    if ( pw1.value.length < 5 ) {
            window.alert ( "密碼長度必須要大於 5 個字元以上" );
            document.getElementById("upwd").focus();
            return false;
    }

}

function check_restpwd() {
    //檢查密碼長度是否正確
    var pw1 = document.getElementById("upwd");
    if ( pw1.value.length < 5 ) {
            window.alert ( "密碼長度必須要大於 5 個字元以上" );
            document.getElementById("upwd").focus();
            return false;
    }

}