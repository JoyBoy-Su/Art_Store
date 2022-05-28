<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <link rel="stylesheet" href="./static/css/page.css">
    <link rel="stylesheet" href="./static/css/search.css">
    <script src="js/search.js"></script>
    <title>搜索</title>
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
                <a href="index.php">ArtStore</a>
            </div>
        </div>
        <!-- 右侧选项栏，由后端插入 -->
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

<!-- 核心内容，搜索到的结果 -->
<div class="box w">
    <!-- 查询到的艺术品数据 -->
    <div class="box-hd">
        <h3>关键字： <span id="keyword-span"></span> 搜索结果：</h3>
        <div class="sort">
            <select id="select-sort">
                <option value="" selected="selected">默认</option>
                <option value="price">价格</option>
                <option value="hot">热度</option>
                <option value="date">发布日期</option>
                <option value="title">艺术品名称</option>
            </select>
        </div>
    </div>
    <div class="box-bd">
        <!--   搜索结果   -->
        <ul>
        </ul>
    </div>

    <!-- 分页 -->
    <div class="page">
        <button>共<span id="total-span">0</span>条</button>
        <button class="firstPage"><img src="./static/img/page-icon/left-end.png" /></button>
        <button class="beforePage"><img src="./static/img/page-icon/page-left.png" /></button>
        <button>第<input id="currentPage" type="number" value="1" />页</button>
        <button>/&nbsp;&nbsp;&nbsp;共<input id="totalPage" type="button" value="1" readonly="readonly">页</button>
        <button class="nextPage"><img src="./static/img/page-icon/page-right.png" /></button>
        <button class="lastPage"><img src="./static/img/page-icon/right-end.png" /></button>
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