<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/navigation.css">
    <link rel="stylesheet" href="./static/css/upload.css">
    <title>发布修改</title>
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
<!-- 发布艺术品 -->
<div class="box">
    <div class="upload-modify w">
        <!-- 发布/修改基本信息 -->
        <div class='upload-modify-head'>
            <h3> <span> UserName </span> 发布 / 修改</h3>
        </div>
        <!-- 发布/修改的表单内容 -->
        <div class='form-div'>
            <!--  艺术品名称    -->
            <div class='form-item'>
                <div class="item-label">
                    <label for="art-title">艺术品名称：</label>
                </div>
                <div class="item-input">
                    <input type='text' id="art-title">
                </div>
                <div class="item-message"></div>
            </div>
            <!--  作者名称    -->
            <div class='form-item'>
                <div class="item-label">
                    <label for="art-author">作者名称：</label>
                </div>
                <div class="item-input">
                    <input type='text' id="art-author">
                </div>
                <div class="item-message"></div>
            </div>
            <!--  艺术品简介    -->
            <div class='form-item'>
                <div class="item-label">
                    <label for="art-description">艺术品简介：</label>
                </div>
                <div class="item-input">
                    <input type='text' id="art-description">
                </div>
                <div class="item-message"></div>
            </div>
            <!--  艺术品图片    -->
            <div class='form-item'>
                <div class="item-label">
                    <label for="art-img">艺术品图片：</label>
                </div>
                <div class="item-input">
                    <input type='text' id="art-img">
                </div>
                <div class="item-message"></div>
            </div>
            <!--  艺术品年份    -->
            <div class='form-item'>
                <div class="item-label">
                    <label for="art-description">年份：</label>
                </div>
                <div class="item-input">
                    <input type='text' id="art-year">
                </div>
                <div class="item-message"></div>
            </div>
            <!--  艺术品时代    -->
            <div class='form-item'>
                <div class="item-label">
                    <label for="art-era">时代：</label>
                </div>
                <div class="item-input">
                    <input type='text' id="art-era">
                </div>
                <div class="item-message"></div>
            </div>
            <!--  艺术品风格流派    -->
            <div class='form-item'>
                <div class="item-label">
                    <label for="art-genre">艺术品风格流派：</label>
                </div>
                <div class="item-input">
                    <input type='text' id="art-genre">
                </div>
                <div class="item-message"></div>
            </div>
            <!--  艺术品长度    -->
            <div class='form-item'>
                <div class="item-label">
                    <label for="art-width">艺术品长度：</label>
                </div>
                <div class="item-input">
                    <input type='text' id="art-width">
                </div>
                <div class="item-message"></div>
            </div>
            <!--  艺术品宽度    -->
            <div class='form-item'>
                <div class="item-label">
                    <label for="art-height">艺术品宽度：</label>
                </div>
                <div class="item-input">
                    <input type='text' id="art-height">
                </div>
                <div class="item-message"></div>
            </div>
            <!--  艺术品售价    -->
            <div class='form-item'>
                <div class="item-label">
                    <label for="art-price">艺术品售价：</label>
                </div>
                <div class="item-input">
                    <input type='text' id="art-price">
                </div>
                <div class="item-message"></div>
            </div>
        </div>
    </div>

    </div>

<!--    <form class="upload-form">-->
<!--        <table class="upload-form">-->
<!--            <tr>-->
<!--                <td>标题</td>-->
<!--                <td colspan="5"><input type="text" style="width: 100%;"></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>内容</td>-->
<!--                <td><input type="text"></select></td>-->
<!--                <td>地区</td>-->
<!--                <td><input type="text"></select></td>-->
<!--                <td>城市</td>-->
<!--                <td><input type="text"></select></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>描述</td>-->
<!--                <td colspan="5"><input type="text" style="width: 100%;"></td>-->
<!--            </tr>-->
<!--        </table>-->
<!--    </form>-->
<!--    <button class="buy-btn">发布</button>-->
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