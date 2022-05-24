<?php
/**
 * 处理用户注册的逻辑
 * 拿到表单后根据信息进行注册或注册失败
 */
// 校验合法后去数据库查询该用户名是否已使用
/**
 * TODO : 校验电子邮箱的重复性
 */
require ("./utils/DBUtil.php");
require ("./utils/encrypt.php");
//require ("./dao/UserDao.php");

$util = new DBUtil();
$sql = "select * from users where UserName = ?";
$result = $util->query($sql, $_POST['username']);
$resp = ["success" => false, "message" => ""];
if(count($result) >= 1) {
    // 注册失败，返回信息
    $resp['message'] = "该用户名已存在";
} else {
    // 可以注册
    $resp['success'] = true;
    // 处理数据库
    register();
}
echo json_encode($resp);

// 注册一个用户的一系列操作，包括密码加密，操作数据库
function register() {
    // 1、获取用户信息
    $info = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'salt' => "",
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'address' => $_POST['address']
    ];
    // 2、密码哈希加盐
    $info['salt'] = salt();
    $info['password'] = encrypt($info['password'].$info['salt']);
    // 3、数据存入数据库
    $sql = "insert into users (UserName, Password, Salt, Phone, Email, Address) value (?, ?, ?, ?, ?, ?)";
    global $util;
    $util->update($sql,
        $info['username'], $info['password'], $info['salt'],
        $info['phone'], $info['email'], $info['address']
    );
}
