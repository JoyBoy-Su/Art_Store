/**
 * cart界面的交互逻辑
 */

// 引入commonjs
let newScript = document.createElement("script");
newScript.setAttribute("type","text/javascript");
newScript.setAttribute("src","js/common.js");
document.head.appendChild(newScript);

window.onload = function () {
    // 获得nav
    getNav();
    // 获得购物车界面
    getCartPage();
}

function getCartPage() {
    // 发请求获取艺术品详情内容
    $.ajax({
        type: "GET",
        url: "./php/cart.php?type=get",
        dataType: "json",
        success : function (resp) {
            insertCartPage(resp.page);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function insertCartPage(page) {
    // 插入购物车的基本信息
    $(".cart").append(page.basic);
    // 插入购物车的每条记录
    $(".cart").append(page.info);
}