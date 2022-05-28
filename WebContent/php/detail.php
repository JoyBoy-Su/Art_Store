<?php
/**
 * 处理艺术品详情信息的逻辑
 */
require_once ("./pages/detail.php");
require_once ("./utils/DBUtil.php");
require_once ("./utils/Auth.php");
require_once ("./utils/validate.php");
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
            if(!validArtID($artID)) $artID = getRandomArtID();
            increaseVisit($artID);          // 先增加访问次数，再获取页面
            $resp['detail'] = getArtInfoPage($artID);
            break;
        case "cart":
            $result = addArtToCart($artID, $_REQUEST['version']);
            $resp['success'] = $result['success'];
            $resp['message'] = $result['message'];
            break;
        case "purchase":
            break;
    }
} else {
    $resp["detail"] = "<h1>加载出错</h1>";
}

if(isset($_COOKIE['token'])) {
    if($auth->checkToken($_COOKIE['token']) != 0)
        $auth->updateToken($_COOKIE['token']);
}
// 响应数据
echo json_encode($resp);

/**
 * @return mixed
 * 随机生成artID
 */
function getRandomArtID() {
    global $util;
    $sql = "select ArtID from arts";
    $set = $util->query($sql);
    // 随机生成一个下标，查找该下标对应的art
    $index = rand(0, count($set) - 1);
    return $set[$index]['ArtID'];
}

/**
 * @param $artID
 * @return void
 * 根据artID增加访问次数
 */
function increaseVisit($artID) {
    global $util;
    $sql = "select VisitTimes from arts where ArtID = ?";
    $times = $util->query($sql, $artID)[0]['VisitTimes'];
    $sql = "update arts set VisitTimes = ? where ArtID = ?";
    $util->update($sql, $times + 1, $artID);
}

/**
 * @return string
 * 根据id生成页面返回，若没有id则随机生成id
 */
function getArtInfoPage($artID) {
    $sql = "select Title, Author, ImageFileName, arts.Year, Width, Height,
        EraName, GenreName, AccessionDate, users.UserName,
        Price, VisitTimes, State, arts.Description, VersionNumber
        from arts
        left join eras on arts.EraID = eras.EraID
        left join genres on arts.GenreID = genres.GenreID
        left join users on arts.AccessionUserID = users.UserID
        where arts.ArtID = ?";
    global $util;
    $set = $util->query($sql, $artID);
    // 如果set的大小为0，即该商品不存在（id不合法或者没有传递id）
    $art = $set[0];
    // 根据art信息，生成展示信息
    return getDetailPage($art);
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