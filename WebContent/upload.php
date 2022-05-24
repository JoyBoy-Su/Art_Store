<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/upload.css">
    <title>Upload</title>
</head>
<body>
<!-- 导航栏 -->
<nav>
    <div class="top">
        <ul>
            <li><a href="profile.php">个人中心</a></li>
            <li><a href="cart.php">购物车</a></li>
            <li><a href="#">登出</a></li>
        </ul>
    </div>
</nav>
<!-- logo与搜索栏 -->
<div class="headers">
    <div class="logo">
        <h1>Art Trading</h1>
    </div>
    <!-- 搜索框 -->
    <div class="container">
        <input type="text" class="search" placeholder="搜索">
    </div>
</div>
<!-- 操作导航栏 -->
<div class="opeartion-navbar">
    <div class="opeartion">首页</div>
    <div class="opeartion">搜索</div>
    <div class="opeartion">详情</div>
    <div class="opeartion">发布艺术品</div>
</div>
<!-- 发布艺术品 -->
<div class="upload">
    <img src="../static/img/rotation7.webp" alt="">
    <!-- 发布信息表单 -->
    <form class="upload-form">
        <table class="upload-form">
            <tr>
                <td>标题</td>
                <td colspan="5"><input type="text" style="width: 100%;"></td>
            </tr>
            <tr>
                <td>内容</td>
                <td><input type="text"></select></td>
                <td>地区</td>
                <td><input type="text"></select></td>
                <td>城市</td>
                <td><input type="text"></select></td>
            </tr>
            <tr>
                <td>描述</td>
                <td colspan="5"><input type="text" style="width: 100%;"></td>
            </tr>
        </table>
    </form>
    <button class="buy-btn">发布</button>
</div>
</body>
</html>