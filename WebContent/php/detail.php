<?php
/**
 * 处理艺术品详情信息的逻辑
 */
require_once ("./utils/DBUtil.php");
require_once ("./pages/detail.php");

$resp = [
    "nav" => "",
    "basic" => "",
    "detail" => "",
];

$util = new DBUtil();
// 如果id存在，按id查找艺术品信息
if(isset($_GET['id'])) {
    $page = getArtInfoPage();
    $resp['basic'] = $page['basic'];
    $resp['detail'] = $page['detail'];
}

// 响应数据
echo json_encode($resp);

/**
 * @return array
 * 根据id生成页面返回
 */
function getArtInfoPage() {
    $artID = intval($_GET['id']);
    $sql = "select Title, ArtistName, ImageFileName, arts.Year, Width, Height,
        EraName, GenreName, AccessionDate, users.UserName,
        Price, VisitTimes, State, arts.Description
        from arts join artists on arts.ArtistID = artists.ArtistID
        left join eras on arts.EraID = eras.EraID
        left join genres on arts.GenreID = genres.GenreID
        left join users on arts.AccessionUserID = users.UserID
        where arts.ArtID = ?";
    global $util;
    $art = $util->query($sql, $artID)[0];
    // 根据art信息，生成展示信息
    $basic = getBasicInfoPage($art);
    $detail = getDetailInfoPage($art);
    return [
        "basic" => $basic,
        "detail" => $detail
    ];
}