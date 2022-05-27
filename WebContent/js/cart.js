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
            // 插入后绑定查看详情的单击事件
            bindDetailClick();
            // 插入后绑定删除的单击事件
            bindDeleteClick();
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

/**
 * 为查看详情绑定的单击事件
 */
function bindDetailClick() {
    let detailObj = $(".detail");
    for (let i = 0; i < detailObj.length; i++) {
        detailObj[i].onclick = function () {
            // 获得artID
            let artID = parseInt(detailObj[i].getAttribute("artID"));
            // console.log(artID);
            // 跳转到相应id的详情界面
            window.location.href = "detail.php?id=" + artID;
        }
    }
}

/**
 * 为删除购物车记录绑定单击事件
 */
function bindDeleteClick() {
    let deleteObjs = $(".delete-cart");
    for (let i = 0; i < deleteObjs.length; i++) {
        deleteObjs[i].onclick = function () {
            // 获得cartID
            let cartID = parseInt(deleteObjs[i].getAttribute("cartID"));
            // 发请求删除该购物车信息
            deleteCart(cartID);
        }
    }
}

/**
 * 按cartID发请求删除购物车信息
 * @param cartID
 */
function deleteCart(cartID) {
    // 发请求删除购物车
    $.ajax({
        type: "POST",
        url: "./php/cart.php",
        data: {
            type: "delete",
            cartID,
        },
        dataType: "json",
        success : function (resp) {
            // 判断响应做出提示
            if(resp.success) {
                alert("删除成功");
                // 根据cartID删除该购物车后更新页面
                updateAfterDelete(cartID);
            }
            else alert("删除失败" + resp.message);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 在删除一条信息后更新页面
 */
function updateAfterDelete(cartID) {
    // 更新总数total
    let totalObj = $("#cart-total");
    let total = parseInt(totalObj.html()) - 1;
    totalObj.html(total);
    // 更新结算，判断当前状态
    let checkboxObj = $("#checkbox-" + cartID);
    // 如果当前状态为选中，则减少总金额，并减少total
    if(checkboxObj.attr("checked")) {
        let priceObj = $("#total-price");
        let price = parseFloat($("#cart-" + cartID + ".price").attr("price"));
        priceObj.val(priceObj.val() - price);
        let paymentObj = $("#payment-btn");
        paymentObj.attr("total", total);
        if(total === 0) paymentObj.css("background-color", "#aaaaaa");
    }
    // 删除div
    $("#cart-" + cartID).remove();
}