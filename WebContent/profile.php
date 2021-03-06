<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <link rel="stylesheet" href="./static/css/profile.css">
    <link rel="icon" href="./static/img/favicon.ico" type ="image/x-icon">
    <script src="js/profile.js"></script>
    <title>个人中心</title>
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
        <input type="text" placeholder="请输入关键词" id="search-input">
        <button id="search-btn"></button>
        <select id="select-attribute">
            <option value="title"selected="selected">艺术品名称</option>
            <option value="author">作者名称</option>
        </select>
    </div>
</div>

<!-- 核心内容 -->
<div class="box">
    <div class="profile w">
        <div class='profile-head'>
            <h3> <span id="user-name"></span> 的个人中心 </h3>
        </div>
        <!-- 选择展示的信息 -->
        <div class="profile-choice" index="1">
            <ul>
                <li class="checked-choice" id="choice-1">个人信息</li>
                <li id="choice-2">已发布</li>
                <li id="choice-3">已买入</li>
                <li id="choice-4">已售出</li>
            </ul>
        </div>
        <!-- 展示的信息 -->
        <div class="profile-info">
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
            <p>
                Art Store ©2022JoyBoy Su
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