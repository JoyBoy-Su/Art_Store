<?php

/**
 * 模糊搜索可以匹配到的艺术品
 */
class ArtMatch {

    /**
     * @param $primary
     * @param $keyword
     * @return float|int
     * 计算两字符串的相似度
     */
    public static function getSimulation($primary, $keyword) {
        if(strlen($keyword) == 0) return 1;
        if(strlen($primary) == 0) return 0;
        // 计算两字符串的编辑距离
        $distance = self::getLevenshteinDistance($primary, $keyword);
        // 计算相似性
        $min = min(strlen($primary), strlen($keyword));
        $dis = abs((strlen($primary) - strlen($keyword)));
        return 1 - ($distance - $dis) / $min;
    }

    /**
     * @param $str1
     * @param $str2
     * @return mixed
     * 计算两字符串的编辑距离
     */
    private static function getLevenshteinDistance($str1, $str2) {
        $len1 = strlen($str1);
        $len2 = strlen($str2);
        // 构造二位数组，进行迭代
        $matrix = array_fill(0, $len1 + 1,
            array_fill(0, $len2 + 1, array()));
        for ($i = 0; $i <= $len1; $i++) $matrix[$i][0] = $i;      // 从pattern到空
        for ($i = 0; $i <= $len2; $i++) $matrix[0][$i] = $i;      // 从primary到空
        // 开始迭代
        $pt = "";
        $pr = "";
        $cost = 0;
        for ($i = 1; $i <= $len1; $i++) {
            $pt = $str1[$i - 1];
            // 遍历第i行，计算pattern[1, , i]到primary[1, , j]的距离
            for ($j = 1; $j <= $len2; $j++) {
                $pr = $str2[$j - 1];
                $cost = ($pt == $pr) ? 0 : 1;
                /**
                 * matrix[i][j]表示从pattern[0, i]到primary[0, j]的距离
                 * 三种情况：
                 * 1、pattern[0, i - 1]到primary[0, j]，再进行一次删除操作
                 * 2、pattern[0, i]到primary[0, j - 1]，再进行一次添加操作
                 * 3、pattern[0, i - 1]到primary[0, j - 1]，若pr != pt再进行一次替换操作
                 * 三者取最小，即从pattern[0, i]到primary[0, j]的编辑距离
                 */
                $matrix[$i][$j] = self::min($matrix[$i - 1][$j] + 1, $matrix[$i][$j - 1] + 1, $matrix[$i - 1][$j - 1] + $cost);
            }
        }
        //
        return $matrix[$len1][$len2];
    }

    private static function min($num, ...$other) {
        $minNum = $num;
        for ($i = 0; $i < count($other); $i++) {
            if($other[$i] < $minNum) $minNum = $other[$i];
        }
        return $minNum;
    }

}