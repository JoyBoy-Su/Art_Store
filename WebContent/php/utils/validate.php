<?php
/**
 * TODO : 在后端定义一些校验函数，进行信息的二次校验
 */

/**
 * @param $email
 * @return false|int
 * 校验邮箱
 */
function validEmail($email) {
    $emailReg = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
    return preg_match($emailReg, $email);
}

/**
 * @param $username
 * @return false|int
 * 校验用户名
 */
function validUserName($username) {
    $usernameReg = "/^[a-zA-Z0-9_-]*$/";
    return preg_match($usernameReg, $username);
}

/**
 * @param $artID
 * @return bool
 * 返回artID是否有效
 */
function validArtID($artID) {
    // 若为0，则不存在
    if($artID == 0) return false;
    $util = new DBUtil();
    $sql = "select ArtID from arts where ArtID = ?";
    $len = count($util->query($sql, $artID));
    if($len == 0) return false;
    return true;
}