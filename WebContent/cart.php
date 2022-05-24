<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/cart.css">
    <title>ShoppingCart</title>
</head>

<body>
<!-- 导航栏 -->
<nav>
    <div class="top">
        <ul>
            <li><a href="profile.php">个人中心</a></li>
            <li><a href="cart.php">购物车</a></li>
            <li><a href="#">登出</a></li>
        </ul>
    </div>
</nav>
<!-- logo与搜索栏 -->
<div class="headers">
    <div class="logo">
        <h1>Art Trading</h1>
    </div>
    <!-- 搜索框 -->
    <div class="container">
        <input type="text" class="search" placeholder="搜索">
    </div>
</div>
<!-- 操作导航栏 -->
<div class="opeartion-navbar">
    <div class="opeartion">首页</div>
    <div class="opeartion">搜索</div>
    <div class="opeartion">详情</div>
    <div class="opeartion">发布艺术品</div>
</div>
<!-- 购物车 -->
<h2 style="margin-left: 30px;">购物车</h2>
<div class="cart">
    <div class="cart-item">
        <img src="./static//img/rotation6.webp" alt="">
        <div class="item-introduction">
            <div class="item-resume">
                介绍：XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
            </div>
            <div class="item-resume">
                价格：￥99999
            </div>
            <div class="item-operation">
                <button style="background-color: aqua;">购买</button>
                <button style="background-color: red;">删除</button>
            </div>
        </div>
    </div>
    <div class="cart-item">
        <img src="./static//img/rotation3.webp" alt="">
        <div class="item-introduction">
            <div class="item-resume">
                介绍：XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
            </div>
            <div class="item-resume">
                价格：￥99999
            </div>
            <div class="item-operation">
                <button class="buy-btn">购买</button>
                <button class="delete-btn">删除</button>
            </div>
        </div>
    </div>
    <button class="apply-btn">结账</button>
</div>
</body>

</html>