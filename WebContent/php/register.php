<?php
/**
 * 处理用户注册的逻辑
 * 拿到表单后根据信息进行注册或注册失败
 */
require_once ("./utils/DBUtil.php");
require_once ("./utils/encrypt.php");
//require_once ("./dao/UserDao.php");

$util = new DBUtil();
$resp = ["success" => false, "message" => ""];
// 查找用户名是否存在
if(existUserName($_POST['username'])) {
    // 注册失败，返回信息
    $resp['message'] = "该用户名已存在";
} else if(existEmail($_POST['email'])) {
    // 注册失败，返回信息
    $resp['message'] = "该邮箱已存在";
} else {
    // 可以注册
    $resp['success'] = true;
    // 处理数据库
    $info = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'salt' => "",
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'address' => $_POST['address']
    ];
    register($info);
}
echo json_encode($resp);

// 注册一个用户的一系列操作，包括密码加密，操作数据库
function register($info) {
    // 密码哈希加盐
    $info['salt'] = salt();
    $info['password'] = encrypt($info['password'].$info['salt']);
    // 3、数据存入数据库
    $sql = "insert into users (UserName, Password, Salt, Phone, Email, Address) values (?, ?, ?, ?, ?, ?)";
    global $util;
    $util->update($sql,
        $info['username'], $info['password'], $info['salt'],
        $info['phone'], $info['email'], $info['address']
    );
}

/**
 * @param $username
 * @return bool
 * 查看用户名是否已存在
 */
function existUserName($username) {
    global $util;
    // 查找用户名是否存在
    $sql = "select * from users where UserName = ?";
    $result = $util->query($sql, $username);
    if(count($result) >= 1) return true;
    return false;
}

/**
 * @param $email
 * @return bool
 * 查看邮箱是否已存在
 */
function existEmail($email) {
    global $util;
    // 查找用户名是否存在
    $sql = "select * from users where Email = ?";
    $result = $util->query($sql, $email);
    if(count($result) >= 1) return true;
    return false;
}