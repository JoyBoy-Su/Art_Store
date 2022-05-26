<?php

/**
 * 对艺术品进行排序时的枚举类型，包括排序标准和排序方式
 * 排序标准：
 *      0 不排序（id顺序，即查找顺序）  NONE
 *      1 按价格排序                PRICE
 *      2 按热度排序                 HOT
 *      3 按发布时间排序              ACCESSION_DATE
 *      4 按匹配度排序                MATCH_DEGREE
 * 排序方式：
 *      true    升序              ASC
 *      false   降序              DESC
 */
class ArtSortOrder {
    const NONE = 0;
    const PRICE = 1;
    const HOT = 2;
    const ACCESSION_DATE = 3;
    const MATCH_DEGREE = 4;
    const ASC = true;
    const DESC = false;
}