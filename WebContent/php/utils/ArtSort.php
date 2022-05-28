<?php

/**
 * 对艺术品进行排序
 */
class ArtSort {

    /**
     * @param $set
     * @param $sortAttr
     * @return array
     * 根据attr进行降序
     */
    public static function sort($set, $sortAttr) {
        $func = "";
        switch ($sortAttr) {
            case "price" :
                $func = "\\ArtSort::sortPrice";
                break;
            case "hot" :
                $func = "\\ArtSort::sortHot";
                break;
            case "date" :
                $func = "\\ArtSort::sortDate";
                break;
            case "title" :
                $func = "\\ArtSort::sortTitle";
                break;
            case "degree" :
                $func = "\\ArtSort::sortDegree";
                break;
            default:
                $func = "\\ArtSort::sortID";
                break;
        }
        usort($set, $func);
        return $set;
    }

    private static function sortID($art1, $art2) {
        return $art1['ArtID'] > $art2['ArtID'];
    }

    private static function sortPrice($art1, $art2) {
        return $art1['Price'] > $art2['Price'];
    }

    private static function sortHot($art1, $art2) {
        return $art1['VisitTimes'] < $art2['VisitTimes'];
    }

    private static function sortDate($art1, $art2) {
        return strtotime($art1['AccessionDate']) < strtotime($art2['AccessionDate']);
    }

    private static function sortTitle($art1, $art2) {
        return $art1['Title'] > $art2['Title'];
    }

    private static function sortDegree($art1, $art2) {
        return $art1['MatchDegree'] < $art2['MatchDegree'];
    }
}