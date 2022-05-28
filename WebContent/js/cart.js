/**
 * cart界面的交互逻辑
 */

// 引入commonjs
let newScript = document.createElement("script");
newScript.setAttribute("type","text/javascript");
newScript.setAttribute("src","js/common.js");
document.head.appendChild(newScript);

window.onload = function () {
    // 请求进入
    enterCart();
    // 获得nav
    getNav();
    // 获得购物车界面
    getCartPage();
    // 绑定搜索栏
    bindSearchBtnInOtherPage();
}

function enterCart() {
    // 发请求，enter
    $.ajax({
        type: "GET",
        url: "./php/cart.php?type=enter",
        dataType: "json",
        async: false,
        success : function (resp) {
            if(!resp.success & resp.message === "login") {
                // 跳转到login
                beforeToLogin();
                window.location.href = "login.php";
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function getCartPage() {
    // 发请求获取购物车详情内容
    $.ajax({
        type: "GET",
        url: "./php/cart.php?type=get",
        dataType: "json",
        success : function (resp) {
            if(!resp.success & resp.message === "login") {
                // 跳转到login
                beforeToLogin();
                window.location.href = "login.php";
                return;
            }
            insertCartPage(resp.page);
            // 插入后绑定查看详情的单击事件
            bindDetailClick();
            // 插入后绑定删除的单击事件
            bindDeleteClick();
            // 为选择购物车绑定单击事件
            bindCheckbox();
            // 为全选按钮绑定单击事件
            bindCheckAll();
            // 绑定结算按钮
            bindPayment();
            // 绑定更新
            bindUpdateClick();
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
 * 为选择购物车记录绑定单击事件
 */
function bindCheckbox() {
    let checkboxObjs = $(".cart-checkbox");
    for (let i = 0; i < checkboxObjs.length; i++) {
        // 为复选框绑定单击事件
        checkboxObjs[i].onclick = function () {
            let checked = checkboxObjs[i].checked;
            // console.log(checked);
            // 如果选中
            if( checked ) {
                // console.log(checkboxObjs[i].getAttribute("cartID"));
                updateAfterChecked(parseInt(checkboxObjs[i].getAttribute("cartID")));
            } else {
                updateAfterCanceled(parseInt(checkboxObjs[i].getAttribute("cartID")));
            }
        }
    }
}

/**
 * 为全选绑定单击事件
 */
function bindCheckAll() {
    let checkAllObj = document.getElementById("check-all-cart");
    checkAllObj.onclick = function () {
        let checked = checkAllObj.checked;
        console.log(checked);
        // 如果选中
        if( checked ) {
            // console.log(checkboxObjs[i].getAttribute("cartID"));
            updateAfterCheckedAll();
        } else {
            updateAfterCanceledAll();
        }
    }
}

/**
 * 为结算按钮绑定单击事件
 */
function bindPayment() {
    // 判断total，如果没有选择则无反应
    let paymentObj = $("#payment-btn");
    paymentObj.click(function () {
        let arr = JSON.parse(paymentObj.attr("total"));
        if(arr.length === 0) return;
        // 显示总价、账户余额、地址、电话
        let userInfo = getUserInfo();
        let resp = confirm(
            "您的信息：\n" +
            "用户名：" + userInfo.username + "\n" +
            "电话：" + userInfo.phone + "\n" +
            "地址：" + userInfo.address + "\n"
        );
        // 如果确认，则处理支付逻辑
        if(resp) {
            let cartArr = JSON.parse($("#payment-btn").attr("total"));
            paymentCart(cartArr);
            // console.log(cartArr);
        }
    });
}

/**
 * 绑定更新的点击事件
 */
function bindUpdateClick() {
    let updateObjs = $("#update-cart-info");
    updateObjs.click(function () {
        let cartID = parseInt(updateObjs.attr("cartID"));
        updateCart(cartID);
    });
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
            if(!resp.success & resp.message === "login") {
                // 跳转到login
                beforeToLogin();
                window.location.href = "login.php";
                return;
            }
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
 * 绑定update，将版本号低的购物车修改
 */
function updateCart(cartID) {
    $.ajax({
        type: "POST",
        url: "./php/cart.php",
        data: {
            type: "update",
            cartID,
        },
        dataType: "json",
        success : function (resp) {
            if(!resp.success & resp.message === "login") {
                // 跳转到login
                beforeToLogin();
                window.location.href = "login.php";
                return;
            }
            // 判断响应做出提示
            if(resp.success) {
                // 更新页面
                $("#cart-" + cartID).html(resp.page);
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 在删除一条信息后更新页面
 * @param cartID
 */
function updateAfterDelete(cartID) {
    // 更新总数total
    let totalObj = $("#cart-total");
    let total = parseInt(totalObj.html()) - 1;
    totalObj.html(total);
    // 更新结算，判断当前状态
    let checkboxObj = document.getElementById("checkbox-" + cartID);
    // 如果当前状态为选中，则减少总金额，并减少total
    if(checkboxObj.checked) updateAfterCanceled(cartID);
    // 删除div
    $("#cart-" + cartID).remove();
    // 判断是否全选
    let paymentObj = $("#payment-btn");
    let arr = JSON.parse(paymentObj.attr("total"));
    if(arr.length === parseInt($("#cart-total").html())) {
        document.getElementById("check-all-cart").checked = true;
    }
}

/**
 * 在选中一条记录后更新
 * @param cartID
 */
function updateAfterChecked(cartID) {
    // 更新结算与总价
    addCartRecord(cartID);
    let priceObj = $("#total-price");
    let price = parseFloat($("#cart-price-" + cartID).attr("price"));
    // console.log(price);
    // console.log(priceObj.html());
    priceObj.html(parseFloat(priceObj.html()) + price);
}

/**
 * 在取消一条记录后更新
 * @param cartID
 */
function updateAfterCanceled(cartID) {
    // 更新结算与总价
    deleteCartRecord(cartID);
    let priceObj = $("#total-price");
    let price = parseFloat($("#cart-price-" + cartID).attr("price"));
    priceObj.html(parseFloat(priceObj.html()) - price);
}

/**
 * 从total数组中添加一个id
 * @param cartID
 */
function addCartRecord(cartID) {
    let paymentObj = $("#payment-btn");
    let arr = JSON.parse(paymentObj.attr("total"));
    arr.push(cartID);
    paymentObj.attr("total", JSON.stringify(arr));
    if(arr.length > 0) paymentObj.css("background-color", "#ff8300");
    // 判断是否全选
    if(arr.length === parseInt($("#cart-total").html())) {
        document.getElementById("check-all-cart").checked = true;
    }
}

/**
 * 从total数组中删除一个id
 * @param cartID
 */
function deleteCartRecord(cartID) {
    let paymentObj = $("#payment-btn");
    let arr = JSON.parse(paymentObj.attr("total"));
    let result = arr.filter(
        (p) => p !== cartID
    );
    paymentObj.attr("total", JSON.stringify(result));
    if(result.length === 0) paymentObj.css("background-color", "#aaaaaa");
    document.getElementById("check-all-cart").checked = false;
}

/**
 * 全选的回调
 */
function updateAfterCheckedAll() {
    // 遍历div，更新price和total
    let checkboxObjs = $(".cart-checkbox");
    for (let i = 0; i < checkboxObjs.length; i++) {
        // 为复选框绑定单击事件
        if(checkboxObjs[i].checked) return;
        checkboxObjs[i].checked = true;
        updateAfterChecked(parseInt(checkboxObjs[i].getAttribute("cartID")));
    }
}

/**
 * 全选的回调
 */
function updateAfterCanceledAll() {
    // 遍历div，更新price和total
    let checkboxObjs = $(".cart-checkbox");
    for (let i = 0; i < checkboxObjs.length; i++) {
        // 为复选框绑定单击事件
        checkboxObjs[i].checked = false;
        updateAfterCanceled(parseInt(checkboxObjs[i].getAttribute("cartID")));
    }
}

/**
 * 发起请求进行支付
 */
function paymentCart(cartArr) {
    $.ajax({
        type: "POST",
        url: "./php/cart.php",
        data: {
            type: "payment",
            cartArr
        },
        dataType: "json",
        success : function (resp) {
            if(!resp.success & resp.message === "login") {
                // 跳转到login
                beforeToLogin();
                window.location.href = "login.php";
                return;
            }
            // 如果返回成功，则提示成功，订单已生成
            if(resp.success) {
                alert("交易成功，订单已生成！");
                // 按cartArr删除div
                for (let i = 0; i < cartArr.length; i++) {
                    updateAfterDelete(cartArr[i]);
                }
            }
            else alert("交易失败！\n" + resp.message);
        },
        error: function (err) {
            console.log("error", err);
        },
    });
}