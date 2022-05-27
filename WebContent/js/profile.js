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
    // 为选项栏选择绑定事件
    bindChoice();
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

/**
 * 为几个选项绑定单击事件
 */
function bindChoice() {
    // li在点击时触发
    let liObjs = $(".profile-choice ul li");
    for (let i = 0; i < liObjs.length; i++) {
        liObjs[i].onclick = function () {
            // 获取当前的选项
            let choicesObj = $(".profile-choice");
            let checked = parseInt(choicesObj.attr("index"));
            if (checked === i + 1) return;
            // 修改choicesObj的属性
            choicesObj.attr("index", i + 1);
            // 更新界面
            // 旧的choice去掉class
            $("#choice-" + checked).attr("class", "");
            // 将新的choice加上class
            $("#choice-" + (i + 1)).attr("class", "checked-choice");
            // 发请求更新内容
            updateProfilePage(i + 1);
        }
    }
}

/**
 * 更新展示的内容
 * @param index
 */
function updateProfilePage(index) {
    // 二者不相等，更新界面
    switch (index) {
        case 1 :
            getUserInfoPage();
            break;
        case 2:
            getUploadPage();
            break;
        case 3:
            getBuyPage();
            break;
        case 4:
            getSellPage();
            break;
    }
}

/**
 * 发请求获取已发布界面
 */
function getUploadPage() {
    // 发请求获取个人信息详情内容
    $.ajax({
        type: "GET",
        url: "./php/profile.php?type=upload",
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

/**
 * 发请求获取已买入界面
 */
function getBuyPage() {
    // 发请求获取个人信息详情内容
    $.ajax({
        type: "GET",
        url: "./php/profile.php?type=buy",
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

/**
 * 发请求获取已卖出界面
 */
function getSellPage() {
    // 发请求获取个人信息详情内容
    $.ajax({
        type: "GET",
        url: "./php/profile.php?type=sell",
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