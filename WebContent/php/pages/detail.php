<?php
/**
 * 定义一些函数，动态产生detail界面的内容
 */

/**
 * @param $art
 * @return string
 * 处理艺术品信息生成basic界面
 */
function getBasicInfoPage($art) {
    return getBasicInfo($art['Title'], $art['ArtistName'], $art['ImageFileName']);
}

/**
 * @param $art
 * @return string
 * 处理艺术品信息生成table界面
 */
function getDetailInfoPage($art) {
    return getDetailInfoTable(
        $art['Year'], $art['Width'], $art['Height'],
        $art['EraName'], $art['GenreName'],
        $art['AccessionDate'], $art['UserName'], $art['Price'], $art['VisitTimes'],
        ($art['State'] ? "已售出" : "未售出"), $art['Description']
    );
}

/**
 * @param $title
 * @param $author
 * @param $img
 * @return string
 * 根据艺术品名称，作者和图片生成基本信息盒子
 */
function getBasicInfo($title, $author, $img) {
    return "<div class='basic-info'>
            <h3>{$title} • {$author}</h3>
        </div>
        <!-- 两个盒子，左浮动，img在左，放在一个盒子里 -->
        <div class='item-info-img'>
            <img src='./static/img/works/medium/{$img}.jpg'>
        </div>";
}

/**
 * @param $year
 * @param $width
 * @param $height
 * @param $era
 * @param $genre
 * @param $date
 * @param $user
 * @param $price
 * @param $visit
 * @param $state
 * @param $description
 * @return string
 * 根据艺术品详细信息生成table界面
 */
function getDetailInfoTable($year, $width, $height, $era,
    $genre, $date, $user, $price, $visit, $state, $description) {
    return "<tr>
                    <td class='left-col'>年份</td>
                    <td>{$year}年</td>
                </tr>
                <tr>
                    <td class='left-col'>尺寸</td>
                    <td>{$width} × {$height}</td>
                </tr>
                <tr>
                    <td class='left-col'>时代</td>
                    <td>{$era}</td>
                </tr>
                <tr>
                    <td class='left-col'>风格</td>
                    <td>{$genre}</td>
                </tr>
                <tr>
                    <td class='left-col'>发布日期</td>
                    <td>{$date}</td>
                </tr>
                <tr>
                    <td class='left-col'>发布用户</td>
                    <td>{$user}</td>
                </tr>
                <tr>
                    <td class='left-col'>价格</td>
                    <td><span>￥{$price}</span></td>
                </tr>
                <tr>
                    <td class='left-col'>访问量</td>
                    <td>{$visit}次</td>
                </tr>
                <tr>
                    <td class='left-col'>是否售出</td>
                    <td>{$state}</td>
                </tr>
                <tr>
                    <td class='left-col'>介绍</td>
                    <td>{$description}</td>
                </tr>";
}