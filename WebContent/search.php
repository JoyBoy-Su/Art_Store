<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <link rel="stylesheet" href="./static/css/page.css">
    <title>搜索</title>
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
    <!-- 查询到的艺术品数据 -->
    <div class="box-hd">
        <h3>关键字： 搜索结果</h3>
    </div>
    <div class="box-bd">
        <ul>
            <li>
                <img src="./static/img/works/small/001020.jpg" alt="">
                <h4>艺术品名称 | 作者</h4>
                <div class="info">
                    <div>作品简介</div>
                    <span>价格</span> • 1125次访问
                </div>
            </li>
            <li>
                <img src="./static/img/works/small/001050.jpg" alt="">
                <h4>艺术品名称 | 作者</h4>
                <div class="info">
                    <div>作品简介</div>
                    <span>价格</span> • 1125次访问
                </div>
            </li>
            <li>
                <img src="./static/img/works/small/001060.jpg" alt="">
                <h4>艺术品名称 | 作者</h4>
                <div class="info">
                    <div>作品简介</div>
                    <span>价格</span> • 1125次访问
                </div>
            </li>
            <li>
                <img src="./static/img/works/small/001080.jpg" alt="">
                <h4>艺术品名称 | 作者</h4>
                <div class="info">
                    <div>作品简介</div>
                    <span>价格</span> • 1125次访问
                </div>
            </li>
            <li>
                <img src="./static/img/works/small/001090.jpg" alt="">
                <h4>艺术品名称 | 作者</h4>
                <div class="info">
                    <div>作品简介</div>
                    <span>价格</span> • 1125次访问
                </div>
            </li>
            <li>
                <img src="./static/img/works/small/001100.jpg" alt="">
                <h4>艺术品名称 | 作者</h4>
                <div class="info">
                    <div>作品简介</div>
                    <span>价格</span> • 1125次访问
                </div>
            </li>
            <li>
                <img src="./static/img/works/small/001130.jpg" alt="">
                <h4>艺术品名称 | 作者</h4>
                <div class="info">
                    <div>作品简介</div>
                    <span>价格</span> • 1125次访问
                </div>
            </li>
            <li>
                <img src="./static/img/works/small/001140.jpg" alt="">
                <h4>艺术品名称 | 作者</h4>
                <div class="info">
                    <div>作品简介</div>
                    <span>价格</span> • 1125次访问
                </div>
            </li>
            <li>
                <img src="./static/img/works/small/001150.jpg" alt="">
                <h4>艺术品名称 | 作者</h4>
                <div class="info">
                    <div>作品简介</div>
                    <span>价格</span> • 1125次访问
                </div>
            </li>
            <li>
                <img src="./static/img/works/small/001170.jpg" alt="">
                <h4>艺术品名称 | 作者</h4>
                <div class="info">
                    <div>作品简介</div>
                    <span>价格</span> • 1125次访问
                </div>
            </li>
        </ul>
    </div>

    <!-- 分页 -->
    <div class="page">
        <button class="firstPage"><img src="./static/img/page-icon/left-end.png" /></button>
        <button class="beforePage"><img src="./static/img/page-icon/page-left.png" /></button>
        <button>第<input id="currentPage" type="text" value="1" />页</button>
        <button>/&nbsp;&nbsp;&nbsp;共<input id="totalPage" type="button" value="3" readonly="readonly">页</button>
        <button class="nextPage"><img src="./static/img/page-icon/page-right.png" /></button>
        <button class="lastPage"><img src="./static/img/page-icon/right-end.png" /></button>
    </div>
</div>

<!-- 底部 -->
<div class="footer">
    <div class="w">
        <div class="copyright">
            <img src="./static/img/logo.png" alt="">
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