<?php
/**
 * 定义一个user的dao类，用来封装对user表的操作
 */
require_once ("../utils/DBUtil.php");

class UserDao {
    private $util;

    public function __construct(){
        $this->util = new DBUtil();
    }

    // 实现对user的按UserName查找
    public function findByUserName($username) {
        $sql = "select * from user where username = ?";
        return $this->util->query($sql, $username);
    }
}