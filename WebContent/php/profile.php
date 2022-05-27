<?php
/**
 * 处理个人中心界面的请求
 */
require_once ("./utils/DBUtil.php");
require_once ("./utils/Auth.php");
require_once ("./pages/profile.php");

$resp = [
    "page" => "",
    "success" => false,
    "message" => ""
];

$util = new DBUtil();
$auth = new Auth();

if(isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
    switch ($type) {
        case "personal" :
            $resp["page"] = getPersonalInfoPage($_COOKIE['token']);
            break;
        case "upload" :
            $resp["page"] = getUploadArtPage($_COOKIE['token']);
            break;
        case "buy" :
            $resp["page"] = getBuyArtPage($_COOKIE['token']);
            break;
        case "sell" :
            $resp["page"] = getSellArtPage($_COOKIE['token']);
            break;
        case "charge":
            chargeMoney($_COOKIE['token'], $_REQUEST['money']);
            $resp['success'] = true;
            break;
    }
}

echo json_encode($resp);

/**
 * @param $token
 * @return string
 * 生成个人信息展示界面
 */
function getPersonalInfoPage($token) {
    // 获取用户详细信息
    global $util;
    global $auth;
    $userID = $auth->checkToken($token);
    $sql = "select * from users where UserID = ?";
    $info = $util->query($sql, $userID)[0];
    // 根据信息生成页面
    return getUserInfoPage($info['UserName'], $info['Phone'], $info['Address'], $info['Email'], $info['Balance']);
}

/**
 * @param $token
 * @return string
 * 生成上传艺术品界面
 */
function getUploadArtPage($token) {
    // 获取用户详细信息
    global $util;
    global $auth;
    $userID = $auth->checkToken($token);
    $sql = "select * from arts where AccessionUserID = ?";
    $set = $util->query($sql, $userID);
    return getUploadPageBySet($set);
}

/**
 * @param $token
 * @return string
 * 生成该用户买入的艺术品界面
 */
function getBuyArtPage($token) {
    // 获取用户详细信息
    global $util;
    global $auth;
    $userID = $auth->checkToken($token);
    $sql = "select OrderID, orders.Date, orders.Price,
        arts.Title, arts.ImageFileName, arts.Author, arts.Description
        from orders join arts on orders.ArtID = arts.ArtID
        where orders.PayUserID = ?";
    $set = $util->query($sql, $userID);
    return getOrderPageBySet($set);
}

/**
 * @param $token
 * @return string
 * 生成该用户卖出的艺术品界面
 */
function getSellArtPage($token) {
    // 获取用户详细信息
    global $util;
    global $auth;
    $userID = $auth->checkToken($token);
    $sql = "select OrderID, orders.Date, orders.Price,
        arts.Title, arts.ImageFileName, arts.Author, arts.Description
        from orders join arts on orders.ArtID = arts.ArtID
        where orders.ReceiveUserID = ?";
    $set = $util->query($sql, $userID);
    return getOrderPageBySet($set);
}

/**
 * @param $token
 * @param $money
 * @return void
 * 为指定用户充值
 */
function chargeMoney($token, $money) {
    // 1、确定用户id
    global $auth;
    $userID = $auth->checkToken($token);
    // 2、确定用户当前余额
    global $util;
    $sql = "select Balance from users where UserID = ?";
    $balance = $util->query($sql, $userID)[0]['Balance'];
    // 3、设置新的余额
    $sql = "update users set Balance = ? where UserID = ?";
    $util->update($sql, $balance + $money, $userID);
}