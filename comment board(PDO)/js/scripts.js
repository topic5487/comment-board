/*function $(id){
    return document.getElementById(id)
}

function check_pwd(){
    var boo=$('upwd').value==$('cpwd').value;
    if (boo) {
        return true;
    }else{
        alert('密碼不一致')
    }
}*/

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
    // 檢查登入帳號是否有特殊字元
    var re = /[^a-zA-Z0-9.-_]/;
    var okname = re.exec ( document.getElementById("username").value);
    if ( okname ) {
            window.alert ( "帳號只允許英文、數字、底線、小數點與減號" );
            document.getElementById("username").focus();
            return false;
    }
}