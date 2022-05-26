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
];

$util = new DBUtil();
$auth = new Auth();

$resp["page"] = getCartPage($_COOKIE['token']);

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
        Description, Price, State, ArtistName, VersionNumber, ArtVersion
        from carts c left join arts a on c.ArtID = a.ArtID
        left join artists a2 on a.ArtistID = a2.ArtistID
        where c.UserID = ?";
    $set = $util->query($sql, $userID);
    // 获得购物车头部信息页面
    $count = count($set);
    $page['basic'] = getCartBasicInfoPage($userName, $count);
    // 获得每个艺术品的页面
    $page["info"] = getCartArtPageBySet($set);
    return $page;
}