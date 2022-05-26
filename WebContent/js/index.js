/**
 * 主页的页面交互逻辑
 */
// 引入commonjs
let newScript = document.createElement("script");
newScript.setAttribute("type","text/javascript");
newScript.setAttribute("src","js/common.js");
document.head.appendChild(newScript);

window.onload = function () {
    // 为搜索绑定单击事件
    bindSearchBtnInOtherPage();
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
            // 插入元素后，绑定单击事件
            bindRotation();
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
    // 发请求获取最热门的艺术品
    $.ajax({
        type: "GET",
        url: "./php/index.php?type=hot",
        dataType: "json",
        success : function (resp) {
            insertHotArt(resp.page);
            // 插入元素后，绑定单击事件
            bindHotArts();
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
            // 插入元素后绑定单击事件
            bindNewArts();
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 界面插入轮播图
 * @param rotation
 */
function insertRotation(rotation) {
    $(".outside-box").append(rotation);
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

/**
 * 为轮播图绑定点击事件
 */
function bindRotation() {
    let rotationObjs = $(".art-rotation");
    // console.log(rotationObjs);
    for (let i = 0; i < rotationObjs.length; i++) {
        // console.log(rotationObjs[i]);
        // alert(rotationObjs[i]);
        rotationObjs[i].onclick = function () {
            // console.log("artID : ", rotationObjs[i].id);
            // 从id中读取出ArtID，id为整数，需要解析
            let artID = rotationObjs[i].id.slice(9);
            // 携带artID参数跳转到detail界面
            window.location.href = 'detail.php?id=' + artID;
        }
    }
}

/**
 * 为热门艺术品绑定单击事件
 */
function bindHotArts() {
    let hotArtObjs = $(".art-hot");
    for (let i = 0; i < hotArtObjs.length; i++) {
        hotArtObjs[i].onclick = function () {
            // 从id中读取出ArtID，id为整数，需要解析
            let artID = hotArtObjs[i].id.slice(4);
            // 携带artID参数跳转到detail界面
            window.location.href = 'detail.php?id=' + artID;
        }
    }
}

/**
 * 为最新发布艺术品绑定单击事件
 */
function bindNewArts() {
    let newArtObjs = $(".art-new");
    for (let i = 0; i < newArtObjs.length; i++) {
        newArtObjs[i].onclick = function () {
            // 从id中读取出ArtID，id为整数，需要解析
            let artID = newArtObjs[i].id.slice(4);
            // 携带artID参数跳转到detail界面
            window.location.href = 'detail.php?id=' + artID;
        }
    }
}