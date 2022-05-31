/**
 * 一些公用的页面交互逻辑
 */
// 引入jquery
let newScript1 = document.createElement("script");
newScript1.setAttribute("type","text/javascript");
newScript1.setAttribute("src","js/lib/jquery-3.6.0.min.js");
document.head.appendChild(newScript1);
// 引入validate.js
let newScript2 = document.createElement("script");
newScript2.setAttribute("type","text/javascript");
newScript2.setAttribute("src","js/utils/validate.js");
document.head.appendChild(newScript2);
// 引入cookie.js
let newScript3 = document.createElement("script");
newScript3.setAttribute("type","text/javascript");
newScript3.setAttribute("src","js/utils/cookie.js");
document.head.appendChild(newScript3);

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

/**
 * 为password-label绑定单击事件，显示隐藏密码
 */
function passwordClick() {
    let labelObj = document.getElementById("password-label");
    labelObj.onclick = function () {
        // 判断当前密码的状态
        let passwordObj = document.getElementById("password");
        if(passwordObj.getAttribute("type") === "password") {
            passwordObj.setAttribute("type", "text");
        } else {
            passwordObj.setAttribute("type", "password");
        }
    }
}

/**
 * 发请求获取右侧导航栏
 */
function getNav() {
    // 发请求获取导航栏
    $.ajax({
        type: "GET",
        url: "./php/common.php?type=nav",
        dataType: "json",
        success : function (resp) {
            insertNav(resp.page);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 界面中插入导航栏
 * @param nav
 */
function insertNav(nav) {
    $(".top").append(nav);
}

/**
 * 绑定退出登录选项
 */
function logout() {
    $.ajax({
        type: "POST",
        url: "./php/common.php?type=logout",
        dataType: "json",
        success : function (resp) {
            if(resp.success) {
                // 退出登录成功，清除token，返回主页
                removeCookie('token');
                window.location.href = "index.php";
            }
        },
        error: function (err) {
            loginFail(err);
        },
    });
}

/**
 * 获得url参数key
 * @param key
 * @returns {string}
 */
function getUrlParam(key) {
    let url = window.location.href;
    if(url.indexOf('?') != -1){
        let value = "";
        let arr = url.slice(url.indexOf('?')+1).split('&');
        arr.forEach(item => {
            let param = item.split('=');
            if(key === param[0]) value = param[1];
        })
        return value;
    }else{
        return "";
    }
}

/**
 * 跳转到login界面前记录跳转地址
 */
function beforeToLogin() {
    let storage = window.sessionStorage;
    let pathname = window.location.pathname;
    let href = window.location.href;
    // 从全地址中把path前的内容去掉
    let path = href.substring(href.indexOf(pathname));
    storage.setItem("from", path);
}

/**
 * 为搜索框的按钮绑定点击事件
 */
function bindSearchBtnInOtherPage() {
    let btn = document.getElementById("search-btn");
    btn.onclick = function () {
        // 如果input的输入内容不为空
        let keyword = document.getElementById("search-input").value;
        // 如果有搜索内容，则跳转到搜索界面
        if(keyword !== "") {
            // 存储当前选择的attribute
            window.sessionStorage.setItem("attribute", $("#select-attribute option:selected").val());
            window.location.href = "search.php?keyword=" + keyword;
        }
    }
}

/**
 * 获取用户的基本信息
 * @returns {*[]}
 */
function getUserInfo() {
    const xhr = new XMLHttpRequest();
    const url = './php/common.php?type=userinfo';
    xhr.open('get', url, false);     // 同步请求
    xhr.send();
    const res = JSON.parse(xhr.responseText);
    if(res.userinfo.success) {
        return res.userinfo.userinfo;
    } return null;
}