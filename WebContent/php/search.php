<?php
/**
 * 处理用户搜索的逻辑
 */
require_once ("./utils/DBUtil.php");
require_once ("./utils/ArtMatch.php");
require_once ("./utils/ArtSort.php");
require_once ("./pages/search.php");

$resp = [
    "page" => "",
    "total" => 0
];
$util = new DBUtil();

// 判断是否存在关键字keyword与请求类型type
if(isset($_REQUEST['keyword']) && $_REQUEST['type']) {
    // 判断操作类型
    $type = $_REQUEST['type'];
    $keyword = intval($_REQUEST['keyword']);
    // 判断type类型
    switch ($type) {
        // 获得搜索结果
        case "get":
            $resp = getSearchPage(
                $_REQUEST['keyword'], $_REQUEST['attribute'], $_REQUEST['sortAttr'],
                $_REQUEST['pageNumber'], $_REQUEST['pageSize']
            );
            break;
        case "other":
            $resp['page'] = "other";
            break;
    }
} else {
    $resp["page"] = "<h1>加载出错</h1>";
}

if($auth->checkToken($_COOKIE['token']) != 0)
    $auth->updateToken($_COOKIE['token']);
echo json_encode($resp);

/**
 * @param $keyword
 * @param $attribute
 * @param $sortAttr
 * @param $pageNumber
 * @param $pageSize
 * @return array
 * 生成page页面，得到搜索总数
 */
function getSearchPage($keyword, $attribute, $sortAttr, $pageNumber, $pageSize) {
    $result = [
        "page" => "",
        "total" => 0
    ];
    // 查询所有艺术品
    $set = searchArt($keyword, $attribute);
    $result["total"] = count($set);
    // 排序分页并获得列表
    $sortSet = sortLimitArt($set, $sortAttr, $pageNumber, $pageSize);
    $result["page"] = getArtSearchPage($sortSet);
    return $result;
}

/**
 * @param $keyword
 * @param $attribute
 * @return array
 * 搜索符合条件的所有艺术品
 */
function searchArt($keyword, $attribute) {
    // 查找所有艺术品
    global $util;
    $sql = "select ArtID, Title, ImageFileName, Author, Price, Description, VisitTimes, AccessionDate from arts";
    $set = $util->query($sql);
    // 查找到所有艺术品，进行搜索匹配
    $precision = 0.7;
    $filterResult = array();
    foreach ($set as $art) {
        if(strcmp($attribute, "title") == 0 &&
            ($sim = ArtMatch::getSimulation($art['Title'], $keyword)) >= $precision) {
            // 添加一个degree字段
            $art['MatchDegree'] = $sim;
            array_push($filterResult, $art);
        } else if(strcmp($attribute, "author") == 0 &&
            stristr($art['Author'], $keyword) != FALSE) {
            array_push($filterResult, $art);
        }
    }
    return $filterResult;
}

/**
 * @param $set
 * @param $sortAttr
 * @param $pageNumber
 * @param $pageSize
 * @return array
 * 根据搜索到的结果排序分页
 */
function sortLimitArt($set, $sortAttr, $pageNumber, $pageSize) {
    if(count($set) == 0) return array();
    $set = ArtSort::sort($set, $sortAttr);
    // 开始下标
    $start = ($pageNumber - 1) * $pageSize;
    return array_slice($set, $start, $pageSize);
}