<?php
/**
 * 定义一些函数，动态产生upload界面的内容
 */

/**
 * @param $artID
 * @param $upload
 * @param $userName
 * @param $art
 * @param $eras
 * @param $genres
 * @return string
 * 获得发布/修改的表单页面
 */
function getUploadInfoPage($artID, $upload, $userName, $art, $eras, $genres) {
    // 修改时，艺术品名称和作者名称不可修改
    $img = ($art['ImageFileName'] == null) ? "" : "./static/img/works/large/{$art['ImageFileName']}.jpg";
    return "<!-- 发布/修改基本信息 -->
        <div class='upload-modify-head'>
            <h3> <span> {$userName} </span> 发布 / 修改</h3>
        </div>
        <!-- 发布/修改的表单内容 -->
        <div class='form-div' artID='{$artID}'>
            <!--  除图片外的元素   -->
            <div class='form-info'>
                <!--  艺术品名称    -->
                <div class='form-item'>
                    <div class='item-label'>
                        <label for='art-title'>艺术品名称：</label>
                    </div>
                    <div class='item-input'>
                        <input type='text' id='art-title' value='{$art['Title']}' "
                            .($upload ? "" : "readonly='readonly'").
                        ">
                    </div>
                    <div class='item-message' id='title-message'></div>
                </div>
                <!--  作者名称    -->
                <div class='form-item'>
                    <div class='item-label'>
                        <label for='art-author'>作者名称：</label>
                    </div>
                    <div class='item-input'>
                        <input type='text' id='art-author' value='{$art['Author']}' "
                            .($upload ? "" : "readonly='readonly'").
                        ">
                    </div>
                    <div class='item-message' id='author-message'></div>
                </div>
                <!--  艺术品简介    -->
                <div class='form-item'>
                    <div class='item-label'>
                        <label for='art-description'>艺术品简介：</label>
                    </div>
                    <div class='item-input'>
                        <input type='text' id='art-description' value='{$art['Description']}'>
                    </div>
                    <div class='item-message' id='description-message'></div>
                </div>
                <!--  艺术品图片    -->
                <div class='form-item'>
                    <div class='item-label'>
                        <label for='art-img'>艺术品图片：</label>
                    </div>
                    <div class='item-input'>
                        <input type='file' id='art-img' value='{$art['ImageFileName']}' accept='image/*'>
                    </div>
                    <div class='item-message' id='img-message'></div>
                </div>
                <!--  艺术品年份    -->
                <div class='form-item'>
                    <div class='item-label'>
                        <label for='art-year'>年份：</label>
                    </div>
                    <div class='item-input'>
                        <input type='number' min='-2020' max='2022' id='art-year' value='{$art['Year']}'>
                    </div>
                    <div class='item-message' id='year-message'></div>
                </div>
                <!--  艺术品时代    -->
                <div class='form-item'>
                    <div class='item-label'>
                        <label for='art-era'>时代：</label>
                    </div>
                    <div class='item-input'>
                        <select id='art-era'>"
                            .getErasSelectPage($eras, $art['EraID']).
                        "</select>
                    </div>
                    <div class='item-message' id='era-message'></div>
                </div>
                <!--  艺术品风格流派    -->
                <div class='form-item'>
                    <div class='item-label'>
                        <label for='art-genre'>风格流派：</label>
                    </div>
                    <div class='item-input'>
                        <select id='art-genre'>"
                            .getGenresSelectPage($genres, $art['GenreID']).
                        "</select>
                    </div>
                    <div class='item-message' id='genre-message'></div>
                </div>
                <!--  艺术品长度    -->
                <div class='form-item'>
                    <div class='item-label'>
                        <label for='art-width'>艺术品长度：</label>
                    </div>
                    <div class='item-input'>
                        <input type='number' min='1' id='art-width' value='{$art['Width']}'>
                    </div>
                    <div class='item-message' id='width-message'></div>
                </div>
                <!--  艺术品宽度    -->
                <div class='form-item'>
                    <div class='item-label'>
                        <label for='art-height'>艺术品宽度：</label>
                    </div>
                    <div class='item-input'>
                        <input type='number' min='1' id='art-height' value='{$art['Height']}'>
                    </div>
                    <div class='item-message' id='height-message'></div>
                </div>
                <!--  艺术品售价    -->
                <div class='form-item'>
                    <div class='item-label'>
                        <label for='art-price'>艺术品售价：</label>
                    </div>
                    <div class='item-input'>
                        <input type='number' min='1' id='art-price' value='{$art['Price']}'>
                    </div>
                    <div class='item-message' id='price-message'></div>
                </div>
            </div>
            <!-- 图片预览 -->
            <div class='form-img'>
                <img src='{$img}' id='img-preview'>
            </div>
            <div class='form-btn'>
                <button class='submit-btn' id='confirm-btn'>确认</button>
            </div>
        </div>";
}


/**
 * @param $set
 * @param $eraID
 * @return string
 * 获取所有年代的下拉框
 */
function getErasSelectPage($set, $eraID) {
    $page = "";
    foreach ($set as $era) {
        if($era['EraID'] != $eraID)
            $page = $page."<option value ='{$era['EraID']}'>{$era['EraName']}</option>";
        else $page = $page."<option value ='{$era['EraID']}' selected='selected'>{$era['EraName']}</option>";
    }
    return $page;
}

/**
 * @param $set
 * @param $genreID
 * @return string
 * 获取所有风格的下拉框
 */
function getGenresSelectPage($set, $genreID) {
    $page = "";
    foreach ($set as $genre) {
        if($genreID != $genre['GenreID'])
            $page = $page."<option value ='{$genre['GenreID']}'>{$genre['GenreName']}</option>";
        else $page = $page."<option value ='{$genre['GenreID']}' selected='selected'>{$genre['GenreName']}</option>";
    }
    return $page;
}