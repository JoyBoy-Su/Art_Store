<?php
/**
 * 各个界面通用的请求处理
 */
require_once ("./pages/common.php");
require_once ("./utils/Auth.php");

$type = $_GET['type'];
$resp = [
    "page" => ""                // 请求得到的页面
];

// 判断$type确定请求的是nav还是hot或new
switch ($type) {
    // 请求导航栏
    case "nav" :
        $resp['page'] = getNavPage();
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
        if($auth->checkToken($token)) {
            // token 有效，用户已登陆，获取登录后的nav
            return getNav(true);
        } else return getNav(false);
    }
}