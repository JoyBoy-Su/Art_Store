<?php

/**
 * 艺术品添加到购物车时的枚举类型
 * ENABLE 0 代表正常可添加
 * SOLD  1 代表已出售
 * EXIST 2 代表已存在该艺术品
 * NONEXISTENCE -1 代表该艺术品不存在（已被删除）
 */
class AddCartState {
    const ENABLE = 0;
    const SOLD = 1;
    const EXIST = 2;
    const NONEXISTENCE = -1;

    /**
     * @param $state
     * @return string
     * 解析state
     */
    public static function parse($state) {
        $message = "";
        switch ($state) {
            case self::ENABLE :
                $message = "可添加";
                break;
            case self::SOLD:
                $message = "艺术品已售出";
                break;
            case self::EXIST:
                $message = "艺术品已加入购物车";
                break;
            case self::NONEXISTENCE :
                $message = "艺术品不存在";
                break;
            default:
                $message = "错误";
                break;
        }
        return $message;
    }
}