<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>testDBUtil</title>
</head>
<body>
<!--测试数据库连接-->
<?php
//    require ("../utils/DBUtil.php");
//    创建一个util对象
    $util = new DBUtil();
    $sql = "select * from artists where Gender = ?";
    $util->query($sql, "M");
?>

</body>
</html>