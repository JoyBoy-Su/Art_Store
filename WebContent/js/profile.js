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
            // 为充值按钮绑定事件
            bindCharge();
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
 * 为充值按钮绑定单击事件
 */
function bindCharge() {
    $("#charge-btn").click(function () {
        // 1、弹出充值框，输入充值的数字，校验正整数
        let value = prompt("请输入您要充值的金额：", "0");
        if(value === null || !validPositiveInteger(value)) return;
        // 2、校验通过后再谈一个确认框，确定则发请求，不确定则取消
        let money = parseInt(value);
        let ensure = confirm("您的充值金额为：" + money + "\n您确定要充值吗？");
        if(!ensure) return;
        // 3、将该数据发给后端进行充值，直接到账
        $.ajax({
            type: "POST",
            url: "./php/profile.php?type=charge",
            dataType: "json",
            data: { money },
            success : function (resp) {
                if(resp.success) {
                    alert("充值成功");
                    // 修改余额
                    let balanceObj = $("#item-balance");
                    balanceObj.html(parseInt(balanceObj.html()) + money);
                } else {
                    alert("充值失败，" + resp.message);
                }
            },
            error: function (err) {
                console.log(err);
            },
        });
    });
}

/**
 * 为艺术品div绑定点击事件
 */
function bindArtClick() {
    let artObjs = $(".art-item-click");
    for (let i = 0; i < artObjs.length; i++) {
        artObjs[i].onclick = function () {
            window.location.href = "detail.php?id=" + artObjs[i].getAttribute("artID");
        }
    }
}

/**
 * 为发布的艺术品绑定删除单击事件
 */
function bindDelete() {
    let btnObjs = $(".delete-art-btn");
    for (let i = 0; i < btnObjs.length; i++) {
        btnObjs[i].onclick = function () {
            // 发请求删除
            let artID = parseInt(btnObjs[i].getAttribute("artID"));
            $.ajax({
                type: "POST",
                url: "./php/profile.php?type=delete",
                dataType: "json",
                data: { artID },
                success : function (resp) {
                    if(resp.success) {
                        alert("删除成功");
                        // 删除dom
                        $("#art-" + artID).remove();
                    } else {
                        alert("删除失败，" + resp.message);
                    }
                },
                error: function (err) {
                    console.log(err);
                },
            });
        }
    }
}

/**
 * 为艺术品修改绑定单击事件
 */
function bindModify() {
    let btnObjs = $(".modify-art-btn");
    for (let i = 0; i < btnObjs.length; i++) {
        btnObjs[i].onclick = function () {
            // 带参数跳转到发布/修改界面
            window.location.href = "upload.php?id=" + btnObjs[i].getAttribute("artID");
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
            // 展示已发布信息页面
            $(".profile-info").html(resp.page);
            // 绑定单击事件
            bindArtClick();
            bindDelete();
            bindModify();
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
            // 展示已买入页面
            $(".profile-info").html(resp.page);
            // 绑定单击事件
            bindArtClick();
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
            // 展示已卖出页面
            $(".profile-info").html(resp.page);
            // 绑定单击事件
            bindArtClick();
        },
        error: function (err) {
            console.log(err);
        },
    });
}