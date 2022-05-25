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
    // 发请求获取最热艺术品
    getHotArts();
    // 发请求获取最新艺术品
    getNewArts();
}

/**
 * 发请求获取右侧导航栏
 */
function getNav() {
    // 发请求进行注册
    $.ajax({
        type: "GET",
        url: "./php/index.php?type=nav",
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
 * 发请求获取热门艺术品TOP10
 */
function getHotArts() {
    // 发请求进行注册
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
    // 发请求进行注册
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
 * 界面中插入导航栏
 * @param nav
 */
function insertNav(nav) {
    $(".top").append(nav);
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