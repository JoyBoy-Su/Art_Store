/**
 * 艺术品详情页面交互逻辑
 */
// 引入commonjs
let newScript = document.createElement("script");
newScript.setAttribute("type","text/javascript");
newScript.setAttribute("src","js/common.js");
document.head.appendChild(newScript);

window.onload = function () {
    // 获取导航栏
    getNav();
    // 获取详情信息
    getDetailInfoPage();
}

/* TODO : 获取nav */

/* TODO : 获取detail页面 */
function getDetailInfoPage() {
    // 获取url参数
    let params = getUrlParam();
    let artID = params['id'];
    // console.log("id = ", artID);
    // 发请求获取艺术品详情内容
    $.ajax({
        type: "GET",
        url: "./php/detail.php?id=" + artID,
        dataType: "json",
        success : function (resp) {
            insertDetailInfo(resp);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function insertDetailInfo(page) {
    // 插入basic
    $(".item").prepend(page.basic);
    // 插入detail
    $(".item-introduction table").append(page.detail);
}