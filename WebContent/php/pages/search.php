<?php
/**
 * 定义一些函数，动态产生detail界面的内容
 */

/**
 * @param $set
 * @return string
 * 根据分页后的结果生成html界面
 */
function getArtSearchPage($set) {
    $page = "";
    foreach ($set as $art) {
        $description = (strlen($art['Description']) >= 60) ?
            (substr($art['Description'], 0, 70)."......") :
            ($art['Description'] == null ? "该艺术品暂无描述" : $art['Description']);
        $page = $page.getArtToShowSearch(
            $art['ArtID'], $art['Title'], $art['Author'], $art['Price'],
            $art['VisitTimes'], $art['ImageFileName'], $description
        );
    }
    return $page;
}

/**
 * @param $id
 * @param $name
 * @param $author
 * @param $price
 * @param $visit
 * @param $img
 * @param $description
 * @return string
 * 根据传入的信息，生成该艺术品的html展示页面
 */
function getArtToShowSearch($id, $name, $author, $price, $visit, $img, $description) {
    return "<li class='art-search' artID='{$id}'>
                <img src='./static/img/works/large/{$img}.jpg'>
                    <h4>{$name} | {$author}</h4>
                    <div class='info'> {$description} </div>
                    <div class='info'>
                        <span>￥{$price}</span> • {$visit}次访问
                    </div>
            </li>";
}