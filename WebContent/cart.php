<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <link rel="stylesheet" href="./static/css/cart.css">
    <title>购物车</title>
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
        <input type="text" placeholder="请输入关键词" id="search-input">
        <button id="search-btn"></button>
    </div>
</div>

<!-- 核心内容 -->
<div class="box">
    <div class="cart w">
        <!-- 购物车基本信息 -->
        <div class="cart-head">
            <h3> 用户a 的购物车（全部 100 个）</h3>
            <div class="selected">
                已选商品（不含运费） <span>0.00</span>
                <button> 结算 </button>
            </div>
        </div>
        <div class="all-check">
            <input type="checkbox"> 全选
        </div>
        <!-- 购物车的内容 -->
        <div class="cart-item">
            <div class="check">
                <input type="checkbox">
            </div>
            <div class="image">
                <img src="./static/img/works/medium/006040.jpg">
            </div>
            <div class="art-info">
                <h3> Art Name • Author Name</h3>
                <div style="margin-top: 5px"> Description </div>
            </div>
            <div class="tips">
                该艺术品信息存在变动<br>
                <span class="update">点击更新</span>
            </div>
            <div class="price"> $999.000 </div>
            <div class="operation">
                <span>从购物车中删除</span>
            </div>
        </div>
        <div class="cart-item">
            <div class="check">
                <input type="checkbox">
            </div>
            <div class="image">
                <img src="./static/img/works/medium/006040.jpg">
            </div>
            <div class="art-info">
                <h3> Art Name • Author Name</h3>
                <div style="margin-top: 5px"> Description </div>
            </div>
            <div class="tips">
                该艺术品信息存在变动<br>
                <span class="update">点击更新</span>
            </div>
            <div class="price"> $999.000 </div>
            <div class="operation">
                <span>从购物车中删除</span>
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