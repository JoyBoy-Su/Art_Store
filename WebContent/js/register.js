/**
 * 注册界面的交互逻辑
 */
// 引入commonjs
let newScript = document.createElement("script");
newScript.setAttribute("type","text/javascript");
newScript.setAttribute("src","js/common.js");
document.head.appendChild(newScript);

//为注册页面绑定逻辑
window.onload = function () {
    // 为每个输入项绑定校验函数
    usernameBlur();
    passwordBlur();
    confirmBlur();
    phoneBlur();
    emailBlur();
    addressBlur();
    // 绑定注册的单击事件
    $("#register-btn").click(function () {
        submitRegister();
    });
    // 绑定重置的单击事件
    $("#cancel-btn").click(function () {
        resetForm();
    })
}

// 信息合法后发起注册申请，为注册按钮绑定单击事件
function submitRegister() {
    // 校验表单信息
    const username =  $("#username").val();
    const password = $("#password").val();
    const confirm = $("#confirm").val();
    const phone = $("#phone").val();
    const email = $("#email").val();
    const address = $("#address").val();
    let pass = true;
    if(!validUserName(username)) {
        pass = false;
        changeMessage("用户名","username-message", false);
    }
    if(password === "" || !validPassword(password, username)) {
        pass = false;
        changeMessage("密码","password-message", false);
    }
    // 如果密码为空
    if(password === "") {
        pass = false;
        $("#confirm-message").text("请先输入密码");
        $("#confirm-message").css("color", "red");
        $("#confirm-message").css("font-weight", "200");
    }
    // 如果密码不一致
    if(password !== confirm) {
        pass = false;
        $("#confirm-message").text("密码不一致");
        $("#confirm-message").css("color", "red");
        $("#confirm-message").css("font-weight", "200");
    }
    if(!validPhone(phone)) {
        pass = false;
        changeMessage("电话","phone-message", false);
    }
    if(!validEmail(email)) {
        pass = false;
        changeMessage("邮箱","email-message", false);
    }
    if(address === "") {
        pass = false;
        changeMessage("地址","address-message", false);
    }
    // 如果通过校验则发送请求进行注册
    if(pass) {
        const info = {
            username, password, phone, email, address
        };
        // 发请求进行注册
        $.ajax({
            type: "POST",
            url: "./php/register.php",
            dataType: "json",
            data: info,
            success : function (resp) {
                registerSuccess(resp);
            },
            error: function (err) {
                registerFail(err);
            },
        })
    }
}

// 注册成功
function registerSuccess(resp) {
    // 判断resp的success与message
    if(resp.success) {
        // 注册成功
        $("#register-message").html("注册成功，请登录");
        $("#register-message").css("color", "green");
        $("#register-message").css("font-weight", "200");
    } else {
        // 注册失败，用户名已重复
        $("#register-message").html("该用户名已存在");
        $("#register-message").css("color", "red");
        $("#register-message").css("font-weight", "200");
    }
}

// 注册失败
function registerFail(err) {
    $("#register-message").html("请求失败");
    $("#register-message").css("color", "red");
    $("#register-message").css("font-weight", "200");
}

// 重置表单
function resetForm() {
    // 每个input项的内容设置为空
    $("#username").val("");
    $("#password").val("");
    $("#confirm").val("");
    $("#phone").val("");
    $("#email").val("");
    $("#address").val("");
    // 每个span设置为空
    $("#username-message").html("");
    $("#password-message").html("");
    $("#confirm-message").html("");
    $("#phone-message").html("");
    $("#email-message").html("");
    $("#address-message").html("");
    $("#register-message").html("");
}