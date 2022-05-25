/**
 * 主页的页面交互逻辑
 */
// 引入commonjs
let newScript = document.createElement("script");
newScript.setAttribute("type","text/javascript");
newScript.setAttribute("src","js/common.js");
document.head.appendChild(newScript);

window.onload = function () {
    // 发请求右侧半部分的导航栏
    getNav();
    // 发请求获得轮播图
    getRotation();
    // 发请求获取最热艺术品
    getHotArts();
    // 发请求获取最新艺术品
    getNewArts();
}

/**
 * 发请求获取热门艺术品TOP10
 */
function getHotArts() {
    // 发请求获取最热门的艺术品
    $.ajax({
        type: "GET",
        url: "./php/index.php?type=hot",
        dataType: "json",
        success : function (resp) {
            insertHotArt(resp.page);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 发请求获取最新发布艺术品TOP10
 */
function getNewArts() {
    // 发请求获取最新发布的艺术品
    $.ajax({
        type: "GET",
        url: "./php/index.php?type=new",
        dataType: "json",
        success : function (resp) {
            insertNewArt(resp.page);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 发请求获得轮播图页面
 */
function getRotation() {
    // 发请求请求轮播图
    $.ajax({
        type: "GET",
        url: "./php/index.php?type=rotation",
        dataType: "json",
        success : function (resp) {
            insertRotation(resp.page);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 界面插入热门艺术品
 * @param hot
 */
function insertHotArt(hot) {
    $(".hot-arts").append(hot);
}

/**
 * 界面插入最新发布艺术品
 * @param new_art
 */
function insertNewArt(new_art) {
    $(".new-arts").append(new_art);
}

function insertRotation(rotation) {
    $(".outside-box").append(rotation);
}