<?php
/**
 * 处理一系列加密
 */

// 随机生成盐
function salt() {
    // 对时间戳进行md5加密，生成随机字符串取8位作为盐
    $str = md5(time());
    return substr($str, 0, 8);
}

// 用SHA-256哈希加密
function encrypt($str = ''){
    return substr(hash("sha256", $str), 0, 32);
}