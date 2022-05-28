<?php
/**
 * 处理购物车界面的请求
 */
require_once ("./utils/DBUtil.php");
require_once ("./utils/Auth.php");
require_once ("./pages/cart.php");

$resp = [
    "page" => [
        "basic" => "",
        "info" => "",
    ],
    "success" => false,
    "message" => ""
];

$util = new DBUtil();
$auth = new Auth();

if(isset($_REQUEST['type'])) {
    // 判断操作类型
    $type = $_REQUEST['type'];
    switch ($type) {
        case "enter" :
            // 判断token
            if(!isset($_COOKIE['token']) || $auth->checkToken($_COOKIE['token']) == 0) {
                $resp["message"] = "login";
            } else $resp['success'] = true;
            break;
        case "get":
            // 判断token
            if(!isset($_COOKIE['token']) || $auth->checkToken($_COOKIE['token']) == 0) {
                $resp["message"] = "login";
            } else $resp["page"] = getCartPage($_COOKIE['token']);
            break;
        case "delete":
            // 判断token
            if(!isset($_COOKIE['token']) || $auth->checkToken($_COOKIE['token']) == 0) {
                $resp["message"] = "login";
            } else {
                $cartID = $_REQUEST['cartID'];
                $result = deleteCart($cartID);
                $resp['success'] = $result['success'];
                $resp['message'] = $result['message'];
            }
            break;
        case "payment":
            // 判断token
            if(!isset($_COOKIE['token']) || $auth->checkToken($_COOKIE['token']) == 0) {
                $resp["message"] = "login";
            } else $resp = paymentCart($_REQUEST['cartArr']);
            break;
        case "update":
            // 判断token
            if(!isset($_COOKIE['token']) || $auth->checkToken($_COOKIE['token']) == 0) {
                $resp["message"] = "login";
            } else {
                $resp["success"] = true;
                $resp["page"] = updateCart($_REQUEST["cartID"]);
            }
    }
} else {
    $resp["detail"] = "<h1>加载出错</h1>";
}

if(isset($_COOKIE['token'])) {
    if($auth->checkToken($_COOKIE['token']) != 0)
        $auth->updateToken($_COOKIE['token']);
}
echo json_encode($resp);

/**
 * @param $token
 * @return string[]
 * 根据token锁定用户得到其购物车页面
 */
function getCartPage($token) {
    $page = [
        "basic" => "",
        "info" => ""
    ];
    global $auth;
    // 进入购物车肯定已经登陆了，无需再检验
    $userID = $auth->checkToken($token);
    global $util;
    // 查找用户名
    $sql = "select UserName from users where UserID = ?";
    $userName = $util->query($sql, $userID)[0]['UserName'];
    // 根据userID查找其购物车的artID，并查找对应的art信息
    $sql = "select CartID, c.UserID, c.ArtID, ImageFileName, Title,
        Description, Price, State, Author, VersionNumber, ArtVersion
        from carts c left join arts a on c.ArtID = a.ArtID
        where c.UserID = ?";
    $set = $util->query($sql, $userID);
    // 获得购物车头部信息页面
    $count = count($set);
    $page['basic'] = getCartBasicInfoPage($userName, $count);
    // 获得每个艺术品的页面
    $page["info"] = getCartArtPageBySet($set);
    return $page;
}

/**
 * @param $cartID
 * @return array
 * 删除一条购物车信息
 */
function deleteCart($cartID) {
    $result = [
        "success" => false,
        "message" => ""
    ];
    global $util;
    // 先查找是否存在
    $sql = "select * from carts where CartID = ?";
    $set = $util->query($sql, $cartID);
    if(count($set) == 0) {
        $result["success"] = false;
        $result["message"] = "您的购物车中无该艺术品";
    } else {
        $sql = "delete from carts where CartID = ?";
        $util->update($sql, $cartID);
        $result["success"] = true;
    }
    return $result;
}

/**
 * @param $cartArr
 * @return array
 * 按购物车编号处理交易
 */
function paymentCart($cartArr) {
    $result = [
        "success" => false,
        "message" => ""
    ];
    // 0、得到所有的艺术品信息
    // 生成占位符
    $placeholder = "?";
    for ($i = 1; $i < count($cartArr); $i++) {
        $placeholder = $placeholder.",?";
    }
    global $util;
    // 生成sql语句
    $sql = "select c.CartID, c.UserID, c.ArtID, u.Balance PayUserBalance,
        a.Price, a.State, a.AccessionUserID, u2.Balance ReceiveUserBalance
        from carts c
        left join arts a on c.ArtID = a.ArtID
        left join users u on c.UserID = u.UserID
        left join users u2 on a.AccessionUserID = u2.UserID
        where c.CartID in (".$placeholder.")";
    $set = $util->queryByArray($sql, $cartArr);
    // 1、校验支付是否合法
    $valid = validPayment($set);
    if(!$valid) {
        $result['message'] = "存在已售出的艺术品";
        return $result;
    }
    // 2、校验余额是否足够
    $valid = validBalance($set, $set[0]['PayUserBalance']);
    if(!$valid) {
        $result['message'] = "余额不足";
        return $result;
    }
    // 3、可以交易，处理双方余额
    manageBalance($set, $set[0]['UserID'], $set[0]['PayUserBalance']);
    // 4、支付成功后处理艺术品状态
    manageArtState($set);
    // 5、支付成功后处理订单信息，一件艺术品生成一个订单
    generateOrders($set);
    // 6、订单生成完毕，从购物车中删除
    foreach ($set as $item) deleteCart($item['CartID']);
    // 6、全部完成返回成功
    $result['success'] = true;
    return $result;
}

/**
 * @param $set
 * @return bool
 * 判断此次支付中是否有已出售的艺术品
 */
function validPayment($set) {
    // 判断是否存在已出售的艺术品，如果有则false
    foreach ($set as $item) {
        if($item['State']) return false;
    }
    return true;
}

/**
 * @param $set
 * @param $balance
 * @return bool
 * 判断余额是否足够
 */
function validBalance($set, $balance) {
    // 判断余额是否足够
    $price = 0;
    foreach ($set as $item) $price += $item['Price'];
    if($balance < $price) return false;
    return true;
}

/**
 * @param $set
 * @param $payUserID
 * @param $balance
 * @return void
 * 处理双方余额
 */
function manageBalance($set, $payUserID, $balance) {
    // 一件艺术品一件艺术品地交易，循环中设置收款方的余额增加，循环结束一次性减少付款方余额
    global $util;
    $totalPrice = 0;
    $sql = "update users set Balance = ? where UserID = ?";
    // 更新收款方的余额
    foreach ($set as $item) {
        $userID = $item['AccessionUserID'];
        $newBalance = $item['ReceiveUserBalance'] + $item['Price'];
        $util->update($sql, $newBalance, $userID);
        $totalPrice += $item['Price'];
    }
    // 更新付款方的余额
    $newBalance = $balance - $totalPrice;
    $util->update($sql, $newBalance, $payUserID);
}

/**
 * @param $set
 * @return void
 * 处理艺术品的状态
 */
function manageArtState($set) {
    global $util;
    $sql = "update arts set State = true where ArtID = ?";
    foreach ($set as $item)
        $util->update($sql, $item['ArtID']);
}

/**
 * @param $set
 * @return void
 * 为每件交易的艺术品生成订单
 */
function generateOrders($set) {
    // 为每件艺术品生成订单，包括交易双方id，交易时间与交易金额
    global $util;
    $sql = "insert into orders (PayUserID, ReceiveUserID, ArtID, Date, Price) value (?, ?, ?, ?, ?)";
    foreach ($set as $item) {
        // 生成订单
        $date = date('Y-m-d H:i:s', time() + 6*60*60);
        // 如果存在出售者
        $util->update($sql, $item['UserID'], $item['AccessionUserID'], $item['ArtID'], $date, $item['Price']);
    }
}

/**
 * @param $cartID
 * @return string
 * 更新购物车信息并返回新的界面
 */
function updateCart($cartID) {
    // 1、根据cart查到完整的艺术品信息
    global $util;
    $sql = "select * from arts
        join carts c on arts.ArtID = c.ArtID
        where c.CartID = ?";
    $art = $util->query($sql, $cartID)[0];
    // 2、更新cart的版本号
    $sql = "update carts set ArtVersion = ? where CartID = ?";
    $util->update($sql, $art['VersionNumber'], $cartID);
    // 3、生成新的界面返回
    return getACartInfo($cartID, $art["ArtID"], $art["ImageFileName"], $art["Title"],
        $art["Author"], $art["Description"], $art["Price"], $art["State"]);
}