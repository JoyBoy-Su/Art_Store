<?php
/**
 * 各个界面通用的请求处理
 */
require_once ("./pages/common.php");
require_once ("./utils/Auth.php");
require_once ("./utils/DBUtil.php");

$type = $_GET['type'];
$resp = [
    "page" => "",                // 请求得到的页面
    "userinfo" => []
];

// 判断$type确定请求的是nav还是hot或new
switch ($type) {
    // 请求导航栏
    case "nav" :
        $resp['page'] = getNavPage();
        break;
    case "userinfo":
        $resp['userinfo'] = getUserInfo();
        break;
    default:
        $resp['page'] = "";
        break;
}

echo json_encode($resp);

/**
 * @return string
 * 根据登录状态返回导航栏
 */
function getNavPage() {
    // 获取cookie中的token
    if(!isset($_COOKIE['token'])) {
        // token不存在
        return getNav(false);
    } else {
        // token 存在，获得token判断是否有效
        $token = $_COOKIE['token'];
        $auth = new Auth();
        if($auth->checkToken($token) != 0) {
            // token 有效，用户已登陆，获取登录后的nav
            return getNav(true);
        } else return getNav(false);
    }
}

/**
 * @return array
 * 根据用户token返回完整的用户信息
 */
function getUserInfo() {
    $resp = [
        "success" => false,
        "userinfo" => [
            "userid" => 0,
            "username" => "",
            "address" => "",
            "phone" => "",
            "email" => ""
        ],
    ];
    // 获取cookie中的token
    if(isset($_COOKIE['token'])) {
        // token 存在，获得token判断是否有效
        $token = $_COOKIE['token'];
        $auth = new Auth();
        $userID = $auth->checkToken($token);
        if($userID != 0) {
            // token 有效，根据userid查信息
            $util = new DBUtil();
            $sql = "select UserID, UserName, Address, Phone, Email
                from users where UserID = ?";
            $user = $util->query($sql, $userID)[0];
            $resp['userinfo']['userid'] = $userID;
            $resp['userinfo']['username'] = $user['UserName'];
            $resp['userinfo']['address'] = $user['Address'];
            $resp['userinfo']['phone'] = $user['Phone'];
            $resp['userinfo']['email'] = $user['Email'];
            $resp['success'] = true;
        }
    }
    return $resp;
}