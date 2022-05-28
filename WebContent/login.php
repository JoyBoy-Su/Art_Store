<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <link rel="stylesheet" href="./static/css/login.css">
    <script src="js/login.js"></script>
    <title>Login</title>
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
            <div class="welcome"> welcome to art store </div>
        </div>
        <body>
        <!-- 右侧选项栏 -->
        <div class="right">
            <a href="index.php">主页</a>
            <a href="login.php">登录</a>
            <a href="register.php">注册</a>
            <a href="cart.php">购物车</a>
        </div>
    </div>
</nav>

<!-- 登录表单 -->
<div class="login-div">
    <form class="login-form">
        <h3>欢迎登陆</h3>
        <div class="info">
            <div>
                <a href="register.php">注册</a>
            </div>
            <div>|</div>
            <div>
                <a href="#">忘记密码？</a>
            </div>
        </div>
        <table>
            <tr>
                <td><label for="userinfo">用户名（邮箱）：</label></td>
                <td><input type="text" id="userinfo" placeholder="请输入用户名或邮箱"></td>
                <td><span id="userinfo-message"></span></td>
            </tr>
            <tr>
                <td><label for="password" id="password-label">密码：</label></td>
                <td><input type="password" id="password" placeholder="请输入密码"></td>
                <td><span id="password-message"></span></td>
            </tr>
            <tr>
                <td></td>
                <td><span id="login-message"></span></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class="submit-btn" id="login-btn" type="button">登录</button>
                    <button class="cancel-btn" id="cancel-btn" type="button">取消</button>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>

</html>