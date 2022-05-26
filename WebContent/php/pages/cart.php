<?php
/**
 * 定义一些函数，动态产生cart界面的内容
 */
const NORMAL = 0;
const SOLD = 1;
const MODIFIED = 2;

/**
 * @param $set
 * @return string
 * 获得所有购物车界面
 */
function getCartArtPageBySet($set) {
    $page = "";
    foreach ($set as $art) {
        $description = strlen($art['Description']) >= 270 ?
            (substr($art['Description'], 0, 270)."......") :
            ($art['Description'] == null ? "该艺术品暂无描述" : $art['Description']);
        // 判断state是已售出还是信息有变动还是无误，优先级从左至右降低
        $state = $art['State'] ? SOLD :
            $art['VersionNumber'] > $art['ArtVersion'] ? MODIFIED : NORMAL;
        $page = $page.getCartArtInfoPage(
            $art['ImageFileName'], $art['Title'], $art['ArtistName'],
            $description, $art['Price'], $state
        );
    }
    return $page;
}

/**
 * @param $userName
 * @param $count
 * @return string
 * 获取基本的购物车顶栏信息
 */
function getCartBasicInfoPage($userName, $count){
    return "<!-- 购物车基本信息 -->
        <div class='cart-head'>
            <h3> <span>$userName</span> 的购物车（全部 {$count} 个）</h3>
            <div class='selected'>
                已选商品（不含运费） <span>0.00</span>
                <button> 结算 </button>
            </div>
        </div>
        <div class='all-check'>
            <input type='checkbox'> 全选
        </div>";
}

/**
 * @param $img
 * @param $artName
 * @param $author
 * @param $description
 * @param $price
 * @param $state
 * @return string
 * 获得一个艺术品的购物车信息界面
 */
function getCartArtInfoPage($img, $artName, $author, $description, $price, $state) {
    return "<!-- 购物车的内容 -->
        <div class='cart-item'>
            <div class='check'>
                <input type='checkbox'>
            </div>
            <div class='image'>
                <img src='./static/img/works/medium/{$img}.jpg'>
            </div>
            <div class='art-info'>
                <h3> {$artName} • {$author}</h3>
                <div style='margin-top: 5px'> {$description} </div>
            </div>
            <div class='tips'>"
                .getTipsInfoPage($state).
            "</div>
            <div class='price'> {$price} </div>
            <div class='operation'>
                <div id='delete-cart'>从购物车中删除</div>
                <div id='detail'>查看详情</div>
            </div>
        </div>";
}

/**
 * @param $state 0代表无误，1代表艺术品已售出，2代表信息存在变动
 * @return string
 * 获得购物车中提示的界面（已售出/信息待更新）
 */
function getTipsInfoPage($state) {
    $tips = "";
    if($state == SOLD) {
        $tips = "该艺术品已售出，请删除";
    } else if($state == MODIFIED) {
        $tips = "该艺术品信息存在变动<br>
                <span class='update'>点击更新</span>";
    }
    return $tips;
}