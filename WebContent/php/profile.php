<?php
/**
 * 处理个人中心界面的请求
 */
require_once ("./utils/DBUtil.php");
require_once ("./utils/Auth.php");
require_once ("./pages/profile.php");

$resp = [
    "page" => ""
];

$util = new DBUtil();
$auth = new Auth();

if(isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
    switch ($type) {
        case "personal" :
            $resp["page"] = getPersonalInfoPage($_COOKIE['token']);
            break;
        case "upload" :
            $resp["page"] = "dsf";
            break;
    }
}

echo json_encode($resp);

/**
 * @param $token
 * @return string
 * 生成个人信息展示界面
 */
function getPersonalInfoPage($token) {
    // 获取用户详细信息
    global $util;
    global $auth;
    $userID = $auth->checkToken($token);
    $sql = "select * from users where UserID = ?";
    $info = $util->query($sql, $userID)[0];
    // 根据信息生成页面
    return getUserInfoPage($info['UserName'], $info['Phone'], $info['Address'], $info['Email'], $info['Balance']);
}