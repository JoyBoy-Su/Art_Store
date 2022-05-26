/**
 * 艺术品详情页面交互逻辑
 */
// 引入commonjs
let newScript = document.createElement("script");
newScript.setAttribute("type","text/javascript");
newScript.setAttribute("src","js/common.js");
document.head.appendChild(newScript);

window.onload = function () {
    // 绑定搜索的点击事件
    bindSearchBtnInOtherPage();
    // 获取导航栏
    getNav();
    // 获取详情信息
    getPage();
}

/**
 * 发请求获取页面，后端根据id的内容返回不同的界面
 * 如果id为空或者id不存在，
 */
function getPage() {
    // 获取url参数
    let artID = getUrlParam('id');
    // console.log("id = ", artID);
    // 发请求获取艺术品详情内容
    $.ajax({
        type: "GET",
        url: "./php/detail.php?type=detail&id=" + artID,
        dataType: "json",
        success : function (resp) {
            insertPage(resp.detail);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function insertPage(page) {
    // 插入detail
    $(".box").append(page);
    // 为cart按钮绑定单击事件
    $("#cart-btn").click(function () {
        cartClick();
    });
    // 为purchase绑定单击事件
    $("#purchase-btn").click( function () {
        purchaseClick();
    });
}

/**
 * 添加购物车的单击事件
 */
function cartClick() {
    // 获取艺术品的状态是否已售出
    let artState = parseInt($(".item").attr('state'));
    if( artState !== 0) {
        // 如果该艺术品已售出，返回
        alert("添加失败！\n该艺术品已售出");
        return;
    }
    // 获取url参数
    let artID = getUrlParam('id');
    // 获取艺术品版本号
    let artVersion = $(".item").attr('version');
    // 发请求添加购物车
    $.ajax({
        type: "POST",
        url: "./php/detail.php?type=cart&id=" + artID,
        data: {
            version: artVersion
        },
        dataType: "json",
        success : function (resp) {
            addCart(resp);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 购买艺术品的单击事件
 */
function purchaseClick() {
    // 获取url参数
    let params = getUrlParam();
    let artID = params['id'];
    // 发请求添加购物车
    $.ajax({
        type: "POST",
        url: "./php/detail.php?type=purchase&id=" + artID,
        dataType: "json",
        success : function (resp) {
            purchaseArt(resp);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 添加购物车的回调
 * @param resp
 */
function addCart(resp) {
    // 添加成功
    if(resp.success) {
        alert("添加成功");
    } else {
        if(resp.message === "login") {
            alert("请先登录");
            // 跳转到登录界面，并存储from路径
            beforeToLogin();
            window.location.href = "login.php";
        } else {
            alert("添加失败!\n" + resp.message);
        }
    }
}

/**
 * 购买艺术品的回调
 * @param resp
 */
function purchaseArt(resp) {
    // 添加成功
    if(resp.success) {
        console.log("购买成功");
    } else {
        if(resp.message == "login") {
            console.log("购买需要登录");
        } else {
            console.log("请求失败");
        }
    }
}