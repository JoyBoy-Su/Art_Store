<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <link rel="stylesheet" href="./static/css/detail.css">
    <title>Details</title>
</head>

<body>
<!-- 登录前导航栏 -->
<nav>
    <div class="top">
        <!-- 左侧导航栏 -->
        <div class="left">
            <!-- welcome -->
            <div class="welcome">欢迎来到</div>
            <!-- 艺术字设置为背景图片 -->
            <div class="name">
                <a href="index.php">ArtStore</a>
            </div>
        </div>
        <!-- 右侧选项栏 -->
        <div class="right">
            <a href="index.php">主页</a>
            <a href="login.php">登录</a>
            <a href="register.php">注册</a>
            <a href="cart.php">购物车</a>
        </div>
    </div>
</nav>

<!-- 头部栏 -->
<div class="header w">
    <!-- logo部分 -->
    <div class="logo">
        <img src="./static/img/logo.png" alt="logo">
    </div>
    <!-- 导航栏部分 -->
    <div class="nav">
        <ul>
            <li><a href="index.php">首页</a></li>
            <li><a href="profile.php">个人中心</a></li>
            <li><a href="upload.php">发布艺术品</a></li>
        </ul>
    </div>
    <!-- 搜索部分 -->
    <div class="search">
        <input type="text" value="请输入关键词">
        <button></button>
    </div>
</div>

<!-- 核心内容，搜索到的结果 -->
<div class="box w">
    <!-- 艺术品详情信息 -->
    <div class="item">
        <div class="basic-info">
            <h3>艺术品名称 • 作者名称</h3>
        </div>
        <!-- 两个盒子，左浮动，img在左，放在一个盒子里 -->
        <div class="item-info-img">
            <img src="./static/img/works/medium/001020.jpg" alt="艺术品1">
        </div>
        <div class="item-introduction">
            <!-- 用table展示基本信息 -->
            <table>
                <tr>
                    <th colspan="2">商品详情</th>
                </tr>
                <tr>
                    <td>年份</td>
                    <td>1850年</td>
                </tr>
                <tr>
                    <td>尺寸</td>
                    <td>290 × 120</td>
                </tr>
                <tr>
                    <td>时代</td>
                    <td>文艺复兴</td>
                </tr>
                <tr>
                    <td>风格</td>
                    <td>xxx</td>
                </tr>
                <tr>
                    <td>发布日期</td>
                    <td>2020-5-20</td>
                </tr>
                <tr>
                    <td>发布用户</td>
                    <td>su</td>
                </tr>
                <tr>
                    <td>价格</td>
                    <td><span>￥999</span></td>
                </tr>
                <tr>
                    <td>访问量</td>
                    <td>1129次</td>
                </tr>
                <tr>
                    <td>是否售出</td>
                    <td>否</td>
                </tr>
                <tr>
                    <td>介绍</td>
                    <td>这是一个xxxxx</td>
                </tr>
            </table>
            <button class="submit-btn">加入购物车</button>
            <button class="submit-btn">购买</button>
        </div>
    </div>
</div>
</body>

</html>