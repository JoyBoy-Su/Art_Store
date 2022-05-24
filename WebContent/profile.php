<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <link rel="stylesheet" href="./static/css/profile.css">
    <title>Profile</title>
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
<div class="box w">
    <!-- 个人信息，左浮动 -->
    <div class="profile-nav">
        <ul>
            <li>个人信息</li>
            <li>上传的艺术品</li>
            <li>购买的艺术品</li>
            <li>卖出的艺术品</li>
        </ul>
    </div>
    <!-- 艺术品信息 -->
    <div class="commodity-info">
        <div class="upload commodity">
            我上传的艺术品：
        </div>
        <div class="buy commodity">
            我购买的艺术品：
            <table class="commodity-table">
                <tr>
                    <th>订单编号</th>
                    <th>订单名称</th>
                    <th>订单时间</th>
                    <th>订单金额</th>
                </tr>
                <tr>
                    <td>xxx</td>
                    <td>xxx</td>
                    <td>xxx</td>
                    <td>xxx</td>
                </tr>
                <tr>
                    <td>xxx</td>
                    <td>xxx</td>
                    <td>xxx</td>
                    <td>xxx</td>
                </tr>
            </table>
        </div>
        <div class="sell commodity">
            我卖出的艺术品：
        </div>
    </div>
</div>

</body>

</html>