<?php

/**
 * detail界面的业务处理逻辑
 */
require_once ("../dao/CartDao.php");
class DetailService {
    private $dao = null;

    public function __construct() {
        $this->dao = new CartDao();
    }
}