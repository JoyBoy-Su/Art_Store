<?php
/**
 * 定义一些函数，动态产生index界面的内容
 */
require_once ("common.php");

/**
 * @param $hots
 * @return string
 * 根据艺术品列表，获取列表的html页面展示
 */
function getArtShowPage($hots) {
    // hots为最热门的艺术品列表，遍历生成页面
    $page = "";
    foreach ($hots as $hot) {
        // 把hot中的信息生成html
        $page = $page.getArtToShow(
            $hot['Title'], $hot['ArtistName'], $hot['Price'],
            $hot['VisitTimes'], $hot['ImageFileName'], $hot['AccessionDate']
        );
    }
    return $page;
}