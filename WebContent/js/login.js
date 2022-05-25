/**
 * 登录界面的交互逻辑
 */
// 引入commonjs
let newScript = document.createElement("script");
newScript.setAttribute("type","text/javascript");
newScript.setAttribute("src","js/common.js");
document.head.appendChild(newScript);

//为登录页面绑定逻辑
window.onload = function () {
    // 为每个输入项绑定校验函数
    userinfoBlur();
    loginPasswordBlur();
    // 绑定注册的单击事件
    $("#login-btn").click(function () {
        submitLogin();
    });
    // 绑定重置的单击事件
    $("#cancel-btn").click(function () {
        resetForm();
    })
}

// 登录时密码校验
function loginPasswordBlur() {
    // 当失去焦点时进行密码校验
    let passwordObj = document.getElementById("password");
    passwordObj.onblur = function () {
        if(passwordObj.value === "") {
            $("#password-message").html("密码不能为空");
            $("#password-message").css("color", "red");
            $("#password-message").css("font-weight", "200");
        } else {
            $("#password-message").html("");
        }
    }
}

// 信息合法后发起登录申请
function submitLogin() {
    // 校验表单信息
    const userinfo =  $("#userinfo").val();
    const password = $("#password").val();
    let pass = true;
    if(!validUserName(userinfo) && !validEmail(userinfo)) {
        pass = false;
        changeMessage("登录信息","userinfo-message", false);
    }
    if(password === "") {
        pass = false;
       $("#password-message").html("密码不能为空");
       $("#password-message").css("color", "red");
       $("#password-message").css("font-weight", "200");
    }
    // 如果通过校验则发送请求进行登录
    if(pass) {
        const info = { userinfo, password };
        // 发请求进行注册
        $.ajax({
            type: "POST",
            url: "./php/login.php",
            dataType: "json",
            data: info,
            success : function (resp) {
                loginSuccess(resp);
            },
            error: function (err) {
                loginFail(err);
            },
        });
    }
}

// 登录成功
function loginSuccess(resp) {
    // 判断resp的success与message
    if(resp.success) {
        // 登录成功则把token存到cookie里，然后跳转到主页
        setCookie("token", resp.token);
        window.location.href = "index.php";
    } else {
        // 登录失败，显示错误信息
        $("#login-message").html(resp.message);
        $("#login-message").css("color", "red");
        $("#login-message").css("font-weight", "200");
    }
}

// 登录失败
function loginFail(err) {
    $("#login-message").html("请求失败");
    $("#login-message").css("color", "red");
    $("#login-message").css("font-weight", "200");
}

// 重置表单
function resetForm() {
    // 每个input项的内容设置为空
    $("#userinfo").val("");
    $("#password").val("");
    // 每个span设置为空
    $("#userinfo-message").html("");
    $("#password-message").html("");
    $("#login-message").html("");
}