<?php
/**
 * 定义一些函数，动态产生各个界面的通用内容
 */
/**
 * @param $login
 * @return string
 * 根据登录状态，生成不同的导航栏
 */
function getNav($login) {
    if($login) {
        $page = "<div class='right'>
            <a href='index.php'>主页</a>
            <a href='detail.php'>详情</a>
            <a href='cart.php'>购物车</a> 
            <a href='#'>登出</a>
            <a href='login.php' onclick='beforeToLogin()'>重新登录</a>
        </div>";
    } else {
        $page = "<div class='right'>
            <a href='index.php'>主页</a>
            <a href='login.php' onclick='beforeToLogin()'>登录</a>
            <a href='register.php'>注册</a>
            <a href='detail.php'>详情</a>
            <a href='cart.php'>购物车</a>
        </div>";
    }
    return $page;
}

/**
 * @param $type
 * @param $id
 * @param $name
 * @param $author
 * @param $price
 * @param $visit
 * @param $img
 * @param $date
 * @return string
 * 根据传入的信息，生成该艺术品的html展示页面
 */
function getArtToShow($type, $id, $name, $author, $price, $visit, $img, $date) {
    return "<li class='art-{$type}' id='{$type}-{$id}'>
                <img src='./static/img/works/small/{$img}.jpg'>
                    <h4>{$name} | {$author}</h4>
                    <div class='info'>
                        <span>{$price}</span> • {$visit}次访问 • {$date}发布
                    </div>
            </li>";
}