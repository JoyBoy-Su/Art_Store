<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <link rel="stylesheet" href="./static/css/register.css">
    <link rel="icon" href="./static/img/favicon.ico" type ="image/x-icon">
    <script src="js/register.js"></script>
    <title>Register</title>
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

<!-- 注册表单 -->
<div class="register-div">
    <form class="register-form">
        <h3>欢迎注册</h3>
        <div class="info">
            <div class="login">
                <a href="login.php">已有账号？去登录</a>
            </div>
        </div>
        <table>
            <tr>
                <td><label for="username">用户名：</label></td>
                <td><input type="text" id="username" placeholder="请输入用户名"></td>
                <td><span id="username-message"></span></td>
            </tr>
            <tr>
                <td><label for="password" id="password-label">密码：</label></td>
                <td><input type="password" id="password" placeholder="请输入密码"></td>
                <td><span id="password-message"></span></td>
            </tr>
            <tr>
                <td><label for="confirm" id="confirm-label">确定密码:</label></td>
                <td><input type="password" id="confirm" placeholder="请确定密码"></td>
                <td><span id="confirm-message"></span></td>
            </tr>
            <tr>
                <td><label for="email">邮箱:</label></td>
                <td><input type="text" id="email" placeholder="请输入邮箱"></td>
                <td><span id="email-message"></span></td>
            </tr>
            <tr>
                <td><label for="phone">电话:</label></td>
                <td><input type="text" id="phone" placeholder="请输入电话"></td>
                <td><span id="phone-message"></span></td>
            </tr>
            <tr>
                <td><label for="address">地址:</label></td>
                <td><input type="text" id="address" placeholder="请输入地址"></td>
                <td><span id="address-message"></span></td>
            </tr>
            <tr>
                <td></td>
                <td><span id="register-message"></span></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class="submit-btn" id="register-btn" type="button">注册</button>
                    <button class="cancel-btn" id="cancel-btn" type="button">重置</button>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>