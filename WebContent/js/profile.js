/**
 * 个人中心页面交互逻辑
 */
// 引入commonjs
let newScript = document.createElement("script");
newScript.setAttribute("type","text/javascript");
newScript.setAttribute("src","js/common.js");
document.head.appendChild(newScript);

window.onload = function () {
    getNav();
    bindSearchBtnInOtherPage();
    // 发请求获取用户名
    getUserName();
    // 发请求获取个人信息页面
    getUserInfoPage();
}

/**
 * 发请求获取用户名
 */
function getUserName() {
    $.ajax({
        type: "GET",
        url: "./php/common.php?type=userinfo",
        dataType: "json",
        success : function (resp) {
            // 插入userName
            $("#user-name").html(resp.userinfo.userinfo.username);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 发请求获取个人信息页面
 */
function getUserInfoPage() {
    // 发请求获取个人信息详情内容
    $.ajax({
        type: "GET",
        url: "./php/profile.php?type=personal",
        dataType: "json",
        success : function (resp) {
            // 展示个人信息页面
            $(".profile-info").html(resp.page);
        },
        error: function (err) {
            console.log(err);
        },
    });
}
