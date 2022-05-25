<?php
/**
 * 定义一些函数，动态产生index界面的内容
 */
require_once ("common.php");

/**
 * @param $type
 * @param $hots
 * @return string
 * 根据艺术品列表，获取列表的html页面展示
 */
function getArtShowPage($type, $hots) {
    // hots为最热门的艺术品列表，遍历生成页面
    $page = "";
    foreach ($hots as $hot) {
        // 把hot中的信息生成html
        $page = $page.getArtToShow(
            $type, $hot['ArtID'], $hot['Title'], $hot['ArtistName'], $hot['Price'],
            $hot['VisitTimes'], $hot['ImageFileName'], $hot['AccessionDate']
        );
    }
    return $page;
}

/**
 * @param $set
 * @return string
 * 生成5个轮播图（前端css要求只能设置5个）
 */
function getRotationBySet($set) {
    $page = "";
    // 循环产生轮播图
    for($i = 0; $i < count($set); $i++) {
        $page = $page.getRotation(
            $i + 1, $set[$i]['ArtID'], $set[$i]['ImageFileName'],
            $set[$i]['Title'], $set[$i]['Description']
        );
    }
    return $page;
}

/**
 * @param $count
 * @param $id
 * @param $img
 * @param $title
 * @param $description
 * @return string
 * 根据参数生成轮播图的一个图页面
 */
function getRotation($count, $id, $img, $title, $description) {
    return "<div class='main'>
            <input type='radio' name='button' id='but{$count}' checked='checked'>
            <label for='but{$count}' style='--i:{$count}'></label>
            <div class='image art-rotation' id='rotation-{$id}'>
                <img src='./static/img/works/large/{$img}.jpg'>
                <div class='title'>
                    <h1>{$title}</h1>
                    <p>{$description}</p>
                </div>
            </div>
        </div>";
}