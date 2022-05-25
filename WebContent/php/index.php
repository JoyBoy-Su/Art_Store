<?php
/**
 * 处理主页界面的逻辑，主要动态生成页面内容
 * 1、最顶层导航栏：判断用户的登录状态，调用page得到导航栏的操作项
 */
require_once ("./pages/index.php");
require_once ("./utils/DBUtil.php");

$type = $_GET['type'];
$resp = [
    "page" => ""                // 请求得到的页面
];
$util = new DBUtil();

// 判断$type确定请求的是nav还是hot或new
switch ($type) {
    // 请求热门艺术品
    case "hot" :
        $resp['page'] = getHotArtsPage();
        break;
    // 请求最新发布艺术品
    case "new" :
        $resp['page'] = getNewArtsPage();
        break;
    case "rotation":
        $resp['page'] = getRotationsPage();
        break;
    default:
        $resp['page'] = "";
        break;
}

// 响应
echo json_encode($resp);

/**
 * @return string
 * 查找并返回最火的10件艺术品
 */
function getHotArtsPage() {
    // 分页查询参数，查询前10个艺术品
    $pageSize = 10;
    $startPage = 0;
    // 降序分页查询，前10个艺术品的信息
    $sql = "select ArtID, Title, ArtistName, Price, VisitTimes, ImageFileName, AccessionDate  
            from arts join artists
            on arts.ArtistID = artists.ArtistID
            order by VisitTimes desc
            limit {$startPage}, {$pageSize}";
    global $util;
    $set = $util->query($sql);
    return getArtShowPage("hot", $set);
}

/**
 * @return string
 * 查找并返回最新的10件艺术品
 */
function getNewArtsPage() {
    // 分页查询参数，查询前10个艺术品
    $pageSize = 10;
    $startPage = 0;
    // 降序分页查询，前10个艺术品的信息
    $sql = "select ArtID, Title, ArtistName, Price, VisitTimes, ImageFileName, AccessionDate  
            from arts join artists
            on arts.ArtistID = artists.ArtistID
            order by AccessionDate desc
            limit {$startPage}, {$pageSize}";
    global $util;
    $set = $util->query($sql);
    return getArtShowPage("new", $set);
}

/**
 * @return string
 * 随机生成5个轮播艺术品，返回html页面
 */
function getRotationsPage() {
    // 随机查询arts中的5条记录
    $count = 5;
    $sql = "select ArtID, ImageFileName, Title, Description from arts
        where arts.ArtID >= (rand() * (select max(ArtID) from arts)) limit {$count}";
    global $util;
    return getRotationBySet($util->query($sql));
}