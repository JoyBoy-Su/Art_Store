<?php
/**
 * TODO : 在后端定义一些校验函数，进行信息的二次校验
 */

function validEmail($email) {
    $emailReg = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
    return preg_match($emailReg, $email);
}

function validUserName($username) {
    $usernameReg = "/^[a-zA-Z0-9_-]*$/";
    return preg_match($usernameReg, $username);
}
