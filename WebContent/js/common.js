/**
 * 一些公用的逻辑
 */
// 引入validate.js
let newScript1 = document.createElement("script");
newScript1.setAttribute("type","text/javascript");
newScript1.setAttribute("src","js/utils/validate.js");
document.head.appendChild(newScript1);
// 引入jquery
let newScript2 = document.createElement("script");
newScript2.setAttribute("type","text/javascript");
newScript2.setAttribute("src","js/lib/jquery-3.6.0.min.js");
document.head.appendChild(newScript2);

// 修改每个input的message
function changeMessage(message ,messageId, valid) {
    let messageObj = document.getElementById(messageId);
    if(valid) {
        // 如果合法，输出绿色合法
        messageObj.innerHTML = "合法";
        messageObj.style.cssText = "color : green; font-weight : 200";
    } else {
        // 如果不合法，输出红色不合法
        messageObj.innerHTML = message + "不合法";
        messageObj.style.cssText = "color : red; font-weight : 200";
    }
}

// username校验
function usernameBlur() {
    // 当失去焦点时进行用户名校验
    let usernameObj = document.getElementById("username");
    usernameObj.onblur = function () {
        changeMessage("用户名", "username-message", validUserName(usernameObj.value));
    }
}

// password校验
function passwordBlur() {
    // 当失去焦点时进行密码校验
    let passwordObj = document.getElementById("password");
    passwordObj.onblur = function () {
        let username = document.getElementById("username").value;
        changeMessage("密码", "password-message", validPassword(passwordObj.value, username).pass);
    }
}

// confirm-password校验
function confirmBlur() {
    // 失去焦点时进行confirm校验
    let confirmObj = document.getElementById("confirm");
    let messageObj = document.getElementById("confirm-message");
    confirmObj.onblur = function () {
        let passwordObj = document.getElementById("password");
        // 如果密码为空
        if(passwordObj.value === "") {
            messageObj.innerHTML = "请先输入密码";
            messageObj.style.cssText = "color : red; font-weight : 200";
            return;
        }
        if(confirmObj.value === passwordObj.value) {
            messageObj.innerHTML = "密码一致";
            messageObj.style.cssText = "color : green; font-weight : 200";
        } else {
            messageObj.innerHTML = "密码不一致";
            messageObj.style.cssText = "color : red; font-weight : 200";
        }
    }
}
//

// 电话校验
function phoneBlur() {
    let phoneObj = document.getElementById("phone");
    phoneObj.onblur = function () {
        changeMessage("电话", "phone-message", validPhone(phoneObj.value));
    }
}

// 邮箱校验
function emailBlur() {
    let emailObj = document.getElementById("email");
    emailObj.onblur = function () {
        changeMessage("邮箱", "email-message", validEmail(emailObj.value));
    }
}

// 地址校验
function addressBlur() {
    let addressObj = document.getElementById("address");
    addressObj.onblur = function () {
        changeMessage("地址", "address-message", addressObj.value !== "");
    }
}

// 登录时用户名或电子邮箱校验
function userinfoBlur() {
    // 当失去焦点时进行用户名或电子邮箱校验
    let userinfoObj = document.getElementById("userinfo");
    userinfoObj.onblur = function () {
        // 首先判断是否符合用户名的规范
        if(!validUserName(userinfoObj.value) && !validEmail(userinfoObj.value)) {
            changeMessage("登录信息", "userinfo-message", false);
        } else {
            $("#userinfo-message").html("");
        }
    }
}