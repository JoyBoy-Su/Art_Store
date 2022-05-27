<?php
/**
 * 处理发布/修改界面的请求
 */
require_once ("./utils/DBUtil.php");
require_once ("./pages/upload.php");
require_once ("./utils/Auth.php");

$resp = [
    "page" => "",
    "success" => false,
    "message" => ""
];

$util = new DBUtil();
$auth = new Auth();
if(isset($_REQUEST['type'])) {
    // 判断操作类型
    $type = $_REQUEST['type'];
    switch ($type) {
        // 请求获得发布/修改界面
        case "page":
            $resp["page"] = getUploadPage($_COOKIE['token'], $_REQUEST['artID']);
            break;
        case "add" :
            addArt("", $_COOKIE['token']);
            break;
        case "update":
            $resp = paymentCart($_REQUEST['cartArr']);
            break;
    }
} else {
    $resp["page"] = "<h1>加载出错</h1>";
}

echo json_encode($resp);

/**
 * @param $token
 * @param $artID
 * @return string
 * 根据url参数，获取发布/修改页面
 */
function getUploadPage($token, $artID) {
    // 0、获得用户信息
    global $auth;
    global $util;
    $userID = $auth->checkToken($token);
    $sql = "select UserName from users where UserID = ?";
    $userName = $util->query($sql, $userID)[0]['UserName'];
    // 1、查找该艺术品的信息
    $art = [
        "UserName" => "",
        "Title" => "",
        "Author" => "",
        "Description" => "",
        "Year" => "",
        "EraID" => 0,
        "EraName" => "",
        "GenreID" => 0,
        "GenreName" => "",
        "Width" => 0,
        "Height" => 0,
        "ImageFileName" => "",
        "Price" => 0
    ];
    $sql = "select Title, Author, arts.Description, Year,
        arts.EraID, EraName, arts.GenreID, GenreName,
        Width, Height, ImageFileName, Price
        from arts left join eras e on arts.EraID = e.EraID
        left join genres g on arts.EraID = g.EraID
        where ArtID = ?";
    $set = $util->query($sql, $artID);
    if(count($set) > 0) $art = $set[0];
    // 2、查找所有的时代
    $sql = "select EraID, EraName from eras";
    $eras = $util->query($sql);
    // 3、查找所有的风格
    $sql = "select GenreID, GenreName from genres";
    $genres = $util->query($sql);
    // 4、根据以上信息得到页面
    return getUploadInfoPage($userName, $art, $eras, $genres);
}

/**
 * @param $info
 * @param $token
 * @return void
 * 根据信息，添加一个艺术品
 */
function addArt($info, $token) {
    // 1、确定添加的用户id与添加时间
    global $auth;
    $uerID = $auth->checkToken($token);
    $date = date('Y-m-d H:i:s', time());
    // 2、保存艺术品图片，得到ImageFileName
    saveFile($uerID);
    // 3、操作数据库添加艺术品
}

function saveFile($userID) {
    // 1、时间戳和userid生成随机文件名
    $fileName = "user_".strval($userID)."_".time();
    // 2、保存文件
    echo $_FILES['file'];
}