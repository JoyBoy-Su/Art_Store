<?php
/**
 * 处理用户登录的逻辑，拿到表单后根据信息判断是否登录成功
 * 1、拿到用户上传的数据，用户名（或邮箱）与密码，
 * 2、查询该用户名（或邮箱），得到salt，将密码进行哈希加盐，与数据库password对比
 * 3、若信息匹配，则登录成功，生成token返回并记录
 */
require_once ("./utils/DBUtil.php");
require_once ("./utils/validate.php");
require_once ("./utils/Auth.php");
//require ("./dao/UserDao.php");

$util = new DBUtil();
// 区分用户名与邮箱登录
$sql = "";
if(validEmail($_POST['userinfo'])) {
    $sql = "select * from users where Email = ?";
} else {
    $sql = "select * from users where UserName = ?";
}
// 准备响应数据
$resp = ["success" => false, "message" => "", "token" => ""];
// 查找
$result = $util->query($sql, $_POST['userinfo']);
// 判断用户是否存在
if(count($result) == 0) {
    $resp['message'] = "用户不存在";
} else {
    // 根据用户名得到用户信息匹配
    $user = $result[0];
    $salt = $user['Salt'];
    if (strcmp(encrypt($_POST['password'].$salt), $user['Password']) == 0) {
        // 如果匹配，则登录成功
        $resp['success'] = true;
        $resp['token'] = login($user['UserID']);
    } else {
        // 如果不匹配，登录失败
        $resp['message'] = "密码错误";
    }
}
echo json_encode($resp);

// 登录成功需要执行的函数，包括生成token
function login($userid) {
    // 生成、设置并返回token
    $auth = new Auth();
    return $auth->setToken($userid);
}