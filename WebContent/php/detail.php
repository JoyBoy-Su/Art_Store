<?php
/**
 * 处理艺术品详情信息的逻辑
 */
require_once ("./utils/DBUtil.php");
require_once ("./pages/detail.php");
require_once ("./utils/Auth.php");
require_once ("./Enum/AddCartState.php");

$resp = [
    "detail" => "",
    "success" => false,
    "message" => ""
];

$util = new DBUtil();
$auth = new Auth();
// 如果id存在，按id查找艺术品信息
if(isset($_REQUEST['id']) && isset($_REQUEST['type'])) {
    // 判断操作类型
    $type = $_REQUEST['type'];
    $artID = intval($_REQUEST['id']);
    switch ($type) {
        case "detail":
            $page = getArtInfoPage($artID);
            $resp['detail'] = $page;
            break;
        case "cart":
//            $result = addArtToCart($artID, $_REQUEST['version']);
//            $resp['success'] = $result['success'];
//            $resp['message'] = $result['message'];
            $resp['success'] = false;
            $resp['message'] = "login";
            break;
        case "purchase":
            break;
    }
} else {
    $resp["detail"] = "<h1>加载出错</h1>";
}

// 响应数据
echo json_encode($resp);

/**
 * @return string
 * 根据id生成页面返回
 */
function getArtInfoPage($artID) {
    $sql = "select Title, ArtistName, ImageFileName, arts.Year, Width, Height,
        EraName, GenreName, AccessionDate, users.UserName,
        Price, VisitTimes, State, arts.Description, VersionNumber
        from arts join artists on arts.ArtistID = artists.ArtistID
        left join eras on arts.EraID = eras.EraID
        left join genres on arts.GenreID = genres.GenreID
        left join users on arts.AccessionUserID = users.UserID
        where arts.ArtID = ?";
    global $util;
    $set = $util->query($sql, $artID);
    // 如果set的大小为0，即该商品不存在（id不合法或者没有传递id）
    if(count($set) >= 1) {
        $art = $set[0];
        // 根据art信息，生成展示信息
        return getDetailPage($art);
    } else {
        // 没有具体的艺术品，返回所有艺术品界面
        return "<h1>all arts</h1>";
    }
}

/**
 * @param $artID
 * @param $artVersion
 * @return array
 * 根据artID在购物车中添加记录
 */
function addArtToCart($artID, $artVersion) {
    // 校验token，判断是否登录
    global $auth;
    $userID = $auth->checkToken($_COOKIE['token']);
    $result = [
        "success" => false,
        "message" => ""
    ];
    // token无效，返回false并设置登录
    if($userID == 0) $result['message'] = "login";
    // token有效，判断是否可以添加
    else {
        $validState = validCart($userID, $artID);
        // 可以添加
        if($validState == AddCartState::ENABLE) {
            global $util;
            $sql = "insert into carts (UserID, ArtID, ArtVersion) value (?, ?, ?)";
            // 添加表记录
            $util->update($sql, $userID, $artID, $artVersion);
            $result["success"] = true;
        } else {
            // 无法添加，设置message
            $result["message"] = AddCartState::parse($validState);
        }
    }
    return $result;
}

/**
 * @param $userID
 * @param $artID
 * @return int
 * 校验添加到购物车是否合法
 */
function validCart($userID, $artID) {
    global $util;
    // 不允许添加已售出，前端也需要校验
    $sql = "select State from arts where ArtID = ?";
    $set = $util->query($sql, $artID);
    if(count($set) == 0)
        return AddCartState::NONEXISTENCE;
    else if($set[0]['State'])
        return AddCartState::SOLD;
    // 查找数据库，判断是否已添加
    $sql = "select * from carts where UserID = ? and ArtID = ?";
    $set = $util->query($sql, $userID, $artID);
    if(count($set) >= 1)
        return AddCartState::EXIST;
    return AddCartState::ENABLE;
}
