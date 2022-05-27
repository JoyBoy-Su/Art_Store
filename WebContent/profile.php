<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <link rel="stylesheet" href="./static/css/profile.css">
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

<!-- 核心内容 -->
<div class="box">
    <div class="profile w">
        <div class='profile-head'>
            <h3> <span> UserName </span> 的个人中心 </h3>
        </div>
        <!-- 选择展示的信息 -->
        <div class="profile-choice" checked="1">
            <ul>
                <li class="checked-choice" index="1">个人信息</li>
                <li index="2">已发布</li>
                <li index="3">已买入</li>
                <li index="3">已售出</li>
            </ul>
        </div>
        <!-- 展示的信息 -->
        <div class="profile-info">
            <!-- 展示用户的个人信息 -->
<!--            <div class='personal-info-item'>-->
<!--                <div class='item-label'>-->
<!--                    <label for=''>用户名称：</label>-->
<!--                </div>-->
<!--                <div class='item-content'>-->
<!--                    UserName-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class='personal-info-item'>-->
<!--                <div class='item-label'>-->
<!--                    <label for=''>电话：</label>-->
<!--                </div>-->
<!--                <div class='item-content'>-->
<!--                    Phone-->
<!--                </div>-->
<!--                <div class='item-message' id='title-message'></div>-->
<!--            </div>-->
<!--            <div class='personal-info-item'>-->
<!--                <div class='item-label'>-->
<!--                    <label for=''>地址：</label>-->
<!--                </div>-->
<!--                <div class='item-content'>-->
<!--                    Address-->
<!--                </div>-->
<!--                <div class='item-message' id='title-message'></div>-->
<!--            </div>-->
<!--            <div class='personal-info-item'>-->
<!--                <div class='item-label'>-->
<!--                    <label for=''>邮箱：</label>-->
<!--                </div>-->
<!--                <div class='item-content'>-->
<!--                    Email-->
<!--                </div>-->
<!--                <div class='item-message' id='title-message'></div>-->
<!--            </div>-->
<!--            <div class='personal-info-item'>-->
<!--                <div class='item-label'>-->
<!--                    <label for=''>用户当前余额：</label>-->
<!--                </div>-->
<!--                <div class='item-content'>-->
<!--                    Balance-->
<!--                </div>-->
<!--                <div class='item-message' id='title-message'></div>-->
<!--            </div>-->
            <!-- 展示已发布的艺术品 -->
            <div class='art-item'>
                <div class='image'>
                    <img src='./static/img/works/large/006040.jpg'>
                </div>
                <!-- 基本信息 -->
                <div class='art-info'>
                    <h3> artName • author</h3>
                    <div style='margin-top: 5px'> description </div>
                </div>
                <!-- 发布信息 -->
                <div class='accession-info'>
                    <h3>发布日期：2022-5-27</h3>
                </div>
                <div class='price'> ￥price </div>
                <div class='operation'>
                    <div class='delete'>删除</div>
                    <div class='detail'>修改</div>
                </div>
            </div>
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