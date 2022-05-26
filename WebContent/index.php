<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/index.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <script src="./js/index.js"></script>
    <title>主页</title>
</head>

<body>
<!-- 导航栏 -->
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
<!-- 广告栏 -->
<div class="banner">
    <!--  轮播图位置，由服务器生成轮播图界面插入该处  -->
    <div class="outside-box">
    </div>
</div>
<!-- 核心内容 -->
<div class="box w">
    <!-- 热门艺术品 -->
    <div class="box-hd">
        <h3>热门艺术品</h3>
    </div>
    <!-- 热门艺术品 -->
    <div class="box-bd">
        <!--   热门艺术品ul，由后端生成每一个插入    -->
        <ul class="hot-arts">
        </ul>
    </div>
    <!-- 最新艺术品 -->
    <div class="box-hd">
        <h3>最新艺术品</h3>
    </div>
    <!-- 最新艺术品 -->
    <div class="box-bd">
        <!--   最新艺术品ul，由后端生成每一个插入    -->
        <ul class="new-arts">
        </ul>
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