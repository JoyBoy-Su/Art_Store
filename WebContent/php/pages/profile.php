<?php
/**
 * 定义一些函数，动态产生个人中心界面的内容
 */

/**
 * @param $userName
 * @param $phone
 * @param $address
 * @param $email
 * @param $balance
 * @return string
 * 根据用户信息产生在主页显示的页面
 */
function getUserInfoPage($userName, $phone, $address, $email, $balance) {
    return "<!-- 展示用户的个人信息 -->
            <div class='personal-info-item'>
                <div class='item-label'>
                    <label for=''>用户名称：</label>
                </div>
                <div class='item-content'>
                    {$userName}
                </div>
            </div>
            <div class='personal-info-item'>
                <div class='item-label'>
                    <label for=''>电话：</label>
                </div>
                <div class='item-content'>
                    {$phone}
                </div>
            </div>
            <div class='personal-info-item'>
                <div class='item-label'>
                    <label for=''>地址：</label>
                </div>
                <div class='item-content'>
                    {$address}
                </div>
            </div>
            <div class='personal-info-item'>
                <div class='item-label'>
                    <label for=''>邮箱：</label>
                </div>
                <div class='item-content'>
                    {$email}
                </div>
            </div>
            <div class='personal-info-item'>
                <div class='item-label'>
                    <label for=''>当前余额：</label>
                </div>
                <div class='item-content' id='item-balance'>
                    {$balance}
                </div>
            </div>
            <div class='form-btn'>
                <button class='submit-btn' id='charge-btn'>充值</button>
            </div>";
}

/**
 * @param $set
 * @return string
 * 根据艺术品集合，生成上传艺术品的页面
 */
function getUploadPageBySet($set) {
    $page = "";
    foreach ($set as $art) {
        $description = (strlen($art['Description']) >= 30) ?
            (substr($art['Description'], 0, 30)."......") :
            ($art['Description'] == null ? "该艺术品暂无描述" : $art['Description']);
        $page = $page.getUploadArt(
            $art['ArtID'], $art['ImageFileName'], $art['Title'], $art['Author'],
            $description, $art['AccessionDate'], $art['Price']
        );
    }
    return $page;
}

/**
 * @param $artID
 * @param $img
 * @param $artName
 * @param $author
 * @param $description
 * @param $date
 * @param $price
 * @return string
 * 根据信息生成一条已发布的艺术品页面
 */
function getUploadArt($artID, $img, $artName, $author, $description, $date, $price) {
    return "<!-- 展示已发布的艺术品 -->
            <div class='art-item' id='art-{$artID}'>
                <div class='art-item-click' artId='{$artID}'>
                    <div class='image'>
                        <img src='./static/img/works/large/{$img}.jpg'>
                    </div>
                    <!--基本信息-->
                    <div class='art-info'>
                        <h3> {$artName} • {$author}</h3>
                        <div style='margin-top: 5px'> {$description} </div>
                    </div>
                    <!-- 发布信息 -->
                    <div class='date-info'>
                        <h3>发布日期：{$date}</h3>
                    </div>
                    <div class='price'> ￥{$price} </div>
                </div>
                <div class='operation'>
                    <div class='delete-art-btn' artID='{$artID}'>删除</div>
                    <div class='modify-art-btn' artID='{$artID}'>修改</div>
                </div>
            </div>";
}

/**
 * @param $set
 * @return string
 * 根据艺术品集合，生成买入卖出的艺术品订单的页面
 */
function getOrderPageBySet($set) {
    $page = "";
    foreach ($set as $art) {
        $description = (strlen($art['Description']) >= 30) ?
            (substr($art['Description'], 0, 30)."......") :
            ($art['Description'] == null ? "该艺术品暂无描述" : $art['Description']);
        $page = $page.getOrderPage(
                $art['ArtID'], $art['ImageFileName'], $art['Title'], $art['Author'],
                $description, $art['OrderID'], $art['Date'], $art['Price']
            );
    }
    return $page;
}

/**
 * @param $artID
 * @param $img
 * @param $artName
 * @param $author
 * @param $description
 * @param $orderID
 * @param $date
 * @param $price
 * @return string
 * 根据订单信息生成对应的页面
 */
function getOrderPage($artID, $img, $artName, $author, $description, $orderID, $date, $price) {
    return "<!-- 展示买入的艺术品 -->
            <div class='art-item art-item-click' artId='{$artID}'>
                <div class='image'>
                    <img src='./static/img/works/large/{$img}.jpg'>
                </div>
                <div class='art-info'>
                    <h3> {$artName} • {$author}</h3>
                    <div style='margin-top: 5px'> {$description} </div>
                </div>
                <div class='order-info'>
                    <h3>订单编号：<span>{$orderID}</span></h3>
                </div>
                <div class='date-info'>
                    <h3>订单日期：<span>{$date}</span></h3>
                </div>
                <div class='price'> ￥{$price} </div>
            </div>";
}