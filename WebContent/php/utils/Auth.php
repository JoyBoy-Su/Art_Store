<?php

/**
 * 用户权限类，用来生成token，存储token和确认token
 * 用户发起请求后，有两种请求：1、登录请求 2、其他请求
 * 1、登录请求：登录请求时查表，判断表中是否有token信息
 *    如果有旧的token，不管是否过期，都update成新的token和新的过期时间
 *    如果没有旧的token，就设置token及有效期
 *    调用setToken()方法设置新的token与有效期
 * 2、其他请求：其他请求时，先查token是否有效，
 *    如果传过来的token有效，则执行操作，并更新token的有效时间；
 *    更新token有效时间时，无需判断是否存在，直接update有效时间即可；
 *    如果token无效（不管是过期还是不存在），就返回失败重新登录
 *    调用checkToken()方法检查token是否有效，
 *    调用updateToken()方法为token设置新的有效时间
 */
require_once ("DBUtil.php");
require_once ("encrypt.php");
//require_once ("../dao/UserLogonDao.php");

class Auth {
    // 数据库访问工具
    private $util = null;
    private $VALIDITY = 3600 * 24 * 3;

    public function __construct() {
        $this->util = new DBUtil();
    }

    /**
     * @param $userid
     * @return string
     * 设置并返回新的token
     */
    public function setToken($userid) {
        // 对userid和时间戳进行加密得到token
        $token = encrypt($userid.salt());
        // 设置有效期为3天，并转换格式
        $expiration = date( 'Y-m-d H:i:s', time() + $this->VALIDITY );
        if($this->existToken($userid)) {
            // 存在旧的token，根据userid设置新的token
            $sql = "update userlogon set Token = ?, ExpirationTime = ? where UserID = ?";
            $this->util->update($sql, $token, $expiration, $userid);
        } else {
            // 不存在旧的token，设置新的
            $sql = "insert into userlogon (UserID, Token, ExpirationTime) value (?, ?, ?)";
            $this->util->update($sql, $userid, $token, $expiration);
        }
        return $token;
    }

    /**
     * @param $token
     * @return int|mixed
     * 判断token是否有效
     */
    public function checkToken($token) {
        // 如果token为空，返回0
        if(strcmp($token, "") == 0) return 0;
        // 根据token查找数据库中是否存在该token
        $user = 0;
        $sql = "select * from userlogon where Token = ?";
        $set = $this->util->query($sql, $token);
        // 如果token存在并且当前token未过期，则通过
        if(count($set) != 0 && strtotime($set[0]['ExpirationTime']) > time())
            $user = $set[0]['UserID'];
        return $user;
    }

    /**
     * @param $token
     * @return void
     * 删除token
     */
    public function deleteToken($token) {
        // 根据token删除token
        $sql = "delete from userlogon where Token = ?";
        $this->util->update($sql, $token);
    }

    /**
     * @param $token
     * @return void
     * 更新token的有效期
     */
    public function updateToken($token) {
        // 设置有效期为3天，并转换格式
        $expiration = date( 'Y-m-d H:i:s', time() + $this->VALIDITY );
        // 更新有效期
        $sql = "update userlogon set ExpirationTime = ? where Token = ?";
        $this->util->update($sql, $expiration, $token);
    }

    /**
     * @param $userid
     * @return bool
     * 判断token是否存在
     */
    private function existToken($userid) {
        $sql = "select * from userlogon where UserID = ?";
        $set = $this->util->query($sql, $userid);
        if(count($set) == 0) return false;
        return true;
    }
}