<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <link rel="stylesheet" href="./static/css/detail.css">
    <script src="js/detail.js"></script>
    <title>Details</title>
</head>

<body>
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
                <a href="#">ArtStore</a>
            </div>
            <div class="welcome"> welcome to art store </div>
        </div>
        <!-- 右侧选项栏，由php动态生成 -->
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
        <!--   艺术品基础信息，包括名称，作者和图片     -->
        <!-- 两个盒子，左浮动，img在左，放在一个盒子里 -->
        <!--    艺术品的详细信息    -->
        <div class="item-introduction">
            <!-- 用table展示基本信息，信息由后端返回页面插入 -->
            <table>
                <tr>
                    <th colspan="2">商品详情</th>
                </tr>
            </table>
            <button class="submit-btn">加入购物车</button>
            <button class="submit-btn">购买</button>
        </div>
    </div>
</div>

<!-- 底部 -->
<div class="footer">
    <div class="w">
        <div class="copyright">
            <img src="./static/img/logo-full.png" alt="">
            <p>
                艺术品交易网站……
            </p>
        </div>
        <div class="links">
            <dl>
                <dt>关于ArtTrading</dt>
                <dd>关于</dd>
                <dd>团队管理</dd>
                <dd>工作机会</dd>
                <dd>客户服务</dd>
                <dd>帮助</dd>
            </dl>
            <dl>
                <dt>关于ArtTrading</dt>
                <dd>关于</dd>
                <dd>团队管理</dd>
                <dd>工作机会</dd>
                <dd>客户服务</dd>
                <dd>帮助</dd>
            </dl>
            <dl>
                <dt>关于ArtTrading</dt>
                <dd>关于</dd>
                <dd>团队管理</dd>
                <dd>工作机会</dd>
                <dd>客户服务</dd>
                <dd>帮助</dd>
            </dl>
        </div>
    </div>
</div>
</body>

</html>