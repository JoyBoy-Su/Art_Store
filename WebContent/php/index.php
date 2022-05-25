<?php
/**
 * 处理主页界面的逻辑，主要动态生成页面内容
 * 1、最顶层导航栏：判断用户的登录状态，调用page得到导航栏的操作项
 */
require_once ("./pages/common.php");
require_once ("./pages/index.php");
require_once ("./utils/Auth.php");
require_once ("./utils/DBUtil.php");

$type = $_GET['type'];
$resp = [
    "page" => ""                // 请求得到的页面
];
$util = new DBUtil();

// 判断$type确定请求的是nav还是hot或new
switch ($type) {
    // 请求导航栏
    case "nav" :
        $resp['page'] = getNavPage();
        break;
    // 请求热门艺术品
    case "hot" :
        $resp['page'] = getHotPage();
        break;
    // 请求最新发布艺术品
    case "new" :
        $resp['page'] = getNewPage();
        break;
}

// 响应
echo json_encode($resp);

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

function getHotPage() {
    // 查找数据库，获取最火的艺术品
    $set = queryHotArts();
    // 根据set的内容生成html界面
    return getArtShowPage($set);
}

function getNewPage() {
    // 查找数据库，获取最火的艺术品
    $set = queryNewArts();
    // 根据set的内容生成html界面
    return getArtShowPage($set);
}

/**
 * @return array|void
 * 查找并返回最火的10件艺术品
 */
function queryHotArts() {
    // 分页查询参数，查询前10个艺术品
    $pageSize = 10;
    $startPage = 0;
    // 降序分页查询，前10个艺术品的信息
    $sql = "select Title, ArtistName, Price, VisitTimes, ImageFileName, AccessionDate  
            from arts join artists
            on arts.ArtistID = artists.ArtistID
            order by VisitTimes desc
            limit {$startPage}, {$pageSize};";
    global $util;
    return $util->query($sql);
}

function queryNewArts() {
    // 分页查询参数，查询前10个艺术品
    $pageSize = 10;
    $startPage = 0;
    // 降序分页查询，前10个艺术品的信息
    $sql = "select Title, ArtistName, Price, VisitTimes, ImageFileName, AccessionDate  
            from arts join artists
            on arts.ArtistID = artists.ArtistID
            order by AccessionDate desc
            limit {$startPage}, {$pageSize};";
    global $util;
    return $util->query($sql);
}