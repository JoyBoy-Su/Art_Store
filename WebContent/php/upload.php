<?php
/**
 * 处理发布/修改界面的请求
 */
require_once ("./utils/DBUtil.php");
require_once ("./pages/upload.php");
require_once ("./utils/Auth.php");
require_once ("./utils/validate.php");

$resp = [
    "page" => "",
    "success" => false,
    "message" => ""
];

$util = new DBUtil();
$auth = new Auth();
if(isset($_REQUEST['type'])) {
    // 判断操作类型
    $type = $_REQUEST['type'];
    switch ($type) {
        case "enter":
            $resp = validUploadAuth($_REQUEST['artID']);
            break;
        // 请求获得发布/修改界面
        case "page":
            $result = validUploadAuth($_REQUEST['artID']);
            if(!$result['success']) {
                $resp["message"] = $result['message'];
            } else {
                $resp["page"] = getUploadPage($_COOKIE['token'], $_REQUEST['artID']);
                $resp["success"] = true;
            }
            break;
        case "add" :
            $result = validUploadAuth($_REQUEST['artID']);
            if(!$result['success']) {
                $resp["message"] = $result['message'];
            } else addArt($_COOKIE['token']);
//            addArt($_COOKIE['token']);
//            echo json_encode($_FILES);
            break;
        case "update":
            $result = validUploadAuth($_REQUEST['artID']);
            if(!$result['success']) {
                $resp["message"] = $result['message'];
            } else updateArt($_COOKIE['token'], $_REQUEST['artID']);
            break;
    }
} else {
    $resp["page"] = "<h1>加载出错</h1>";
}

echo json_encode($resp);

/**
 * @param $artID
 * @return array
 * 检查权限
 */
function validUploadAuth($artID) {
    global $auth;
    $resp = ['success' => false, 'message' => ""];
    // 判断token，未登录则无权限
    $userID = $auth->checkToken($_COOKIE['token']);
    if($userID == 0) {
        $resp["message"] = "login";
        return $resp;
    }
    // 判断是否是修改页面
    if(!validArtID($artID)) {
        // 若artID无效，即不是修改
        $resp['success'] = true;
        return $resp;
    }
    // 修改判断用户权限
    global $util;
    $sql = "select AccessionUserID from arts where ArtID = ?";
    $art = $util->query($sql, $artID)[0];
    if($art['AccessionUserID'] != $userID) {
        // 发布者id和用户不一致，
        $resp['message'] = "no auth";
        return $resp;
    }
    $resp['success'] = true;
    return $resp;
}

/**
 * @param $token
 * @param $artID
 * @return string
 * 根据url参数，获取发布/修改页面
 */
function getUploadPage($token, $artID) {
    // 0、获得用户信息
    global $auth;
    global $util;
    $userID = $auth->checkToken($token);
    $sql = "select UserName from users where UserID = ?";
    $userName = $util->query($sql, $userID)[0]['UserName'];
    // 1、查找该艺术品的信息
    $art = [
        "UserName" => "",
        "Title" => "",
        "Author" => "",
        "Description" => "",
        "Year" => "",
        "EraID" => 0,
        "EraName" => "",
        "GenreID" => 0,
        "GenreName" => "",
        "Width" => 0,
        "Height" => 0,
        "ImageFileName" => "",
        "Price" => 0
    ];
    $sql = "select Title, Author, arts.Description, Year,
        arts.EraID, EraName, arts.GenreID, GenreName,
        Width, Height, ImageFileName, Price
        from arts left join eras e on arts.EraID = e.EraID
        left join genres g on arts.EraID = g.EraID
        where ArtID = ?";
    $set = $util->query($sql, $artID);
    if(count($set) > 0) $art = $set[0];
    // 2、查找所有的时代
    $sql = "select EraID, EraName from eras";
    $eras = $util->query($sql);
    // 3、查找所有的风格
    $sql = "select GenreID, GenreName from genres";
    $genres = $util->query($sql);
    // 4、根据以上信息得到页面
    return getUploadInfoPage($artID, ($artID == 0), $userName, $art, $eras, $genres);
}

/**
 * @param $token
 * @return void
 * 根据信息，添加一个艺术品
 */
function addArt($token) {
    global $resp;
    // 1、确定添加的用户id与添加时间
    global $auth;
    $userID = $auth->checkToken($token);
    $date = date('Y-m-d H:i:s', time());
    // 2、保存艺术品图片，得到ImageFileName
    $imgFileName = saveImageFile($userID);
    if(strcmp($imgFileName, "") == 0) {
        // 图片保存失败
        return;
    }
    // 3、操作数据库添加艺术品
    addArtToDataBase($_REQUEST, $userID, $date, $imgFileName);
    $resp['success'] = true;
}

/**
 * @param $token
 * @param $artID
 * @return void
 * 根据信息，更新一个艺术品
 */
function updateArt($token, $artID) {
    global $resp;
    // 1、确定添加的用户id添加时间
    global $auth;
    $userID = $auth->checkToken($token);
    $date = date('Y-m-d H:i:s', time());
    // 2、判断权限
    global $util;
    $sql = "select * from arts where ArtID = ?";
    $set = $util->query($sql, $artID);
    if(count($set) == 0) {
        $resp["message"] = "该艺术品不存在";
        return;
    }
    $art = $set[0];
    if($art["AccessionUserID"] != $userID) {
        $resp["message"] = "权限不足";
        return;
    }
    // 3、判断是否需要修改
    if(!isUpdate($artID, $_REQUEST)) {
        echo "not change";
        $resp['success'] = true;
        return;
    }
    // 4、按照id更新艺术品图片文件
    $save = saveImg("../static/img/works/large/", $art['ImageFileName'].".jpg");
    if(!$save) {
        // 图片保存失败
        return;
    }
    // 5、操作数据库添加艺术品
    updateArtToDataBase($artID, $_REQUEST, $art['VersionNumber'] + 1);
    $resp['success'] = true;
}

/**
 * @param $userID
 * @return string
 * 保存上传的文件，并生成文件名
 */
function saveImageFile($userID) {
    // 1、时间戳和userid生成文件名
    $fileName = "user_".strval($userID)."_".strval(time());
    // 2、保存文件
    if(saveImg("../static/img/works/large/", $fileName.".jpg"))
        return $fileName;
    return "";
}

/**
 * @param $info
 * @param $userID
 * @param $date
 * @param $img
 * @return void
 * 根据信息存储一个新的艺术品
 */
function addArtToDataBase($info, $userID, $date, $img) {
    global $util;
    $sql = "insert into arts 
        (Title, Author, Description, ImageFileName, Year, 
         EraID, GenreID, Width, Height, Price,
         AccessionUserID, AccessionDate) value 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $util->update($sql,
        $info['title'], $info['author'], $info['description'], $img,
        intval($info['year']), intval($info['era']), intval($info['genre']),
        floatval($info['width']), floatval($info['height']),
        intval($info['price']), $userID, $date
    );
}

/**
 * @param $artID
 * @param $info
 * @param $newVersion
 * @return void
 * 根据艺术品id修改艺术品信息
 */
function updateArtToDataBase($artID, $info, $newVersion) {
    global $util;
    $sql = "update arts 
        set Description = ?, Year = ?, EraID = ?, GenreID = ?, 
        Width = ?, Height = ?, Price = ?, VersionNumber = ?
        where ArtID = ?";
    $util->update($sql,
        $info['description'], intval($info['year']), intval($info['era']), intval($info['genre']),
        floatval($info['width']), floatval($info['height']), intval($info['price']), $newVersion, $artID
    );
}

/**
 * @param $path
 * @param $name
 * @return bool
 * 根据路径与文件名保存上传的文件
 */
function saveImg($path, $name) {
    global $resp;
    // 校验文件类型
    if ((($_FILES["picFile"]["type"] == "image/gif")
            || ($_FILES["picFile"]["type"] == "image/jpeg")
            || ($_FILES["picFile"]["type"] == "image/png")
            || ($_FILES["picFile"]["type"] == "image/jpg")
            || ($_FILES["picFile"]["type"] == "image/pjpeg"))) {
        // 判断文件大小
        if(($_FILES["picFile"]["size"] < 1048576 * 5)) {
            // 判断是否出错
            if ($_FILES["picFile"]["error"] > 0) {
                // TODO：设置不同的错误码译码
                return false;
            }
            else {
//            echo "Upload: " . $_FILES["picFile"]["name"] . "<br />";
//            echo "Type: " . $_FILES["picFile"]["type"] . "<br />";
//            echo "Size: " . ($_FILES["picFile"]["size"] / 1024) . " Kb<br />";
//            echo "Temp file: " . $_FILES["picFile"]["tmp_name"] . "<br />";
                move_uploaded_file($_FILES["picFile"]["tmp_name"], $path . $name);
                return true;
//            echo "Stored in: " . $path . $name;
            }
        } else {
            $resp["message"] = "文件大小不合法";
            return false;
        }
    } else {
        $resp["message"] = "文件类型不合法";
        return false;
    }
}

/**
 * @param $artID
 * @param $info
 * @return bool
 * 校验是否出现修改项
 */
function isUpdate($artID, $info) {
    global $util;
    // 1、查找旧的信息
    $sql = "select * from arts where ArtID = ?";
    $art = $util->query($sql, $artID)[0];
    // 2、比较除图片外的信息
    if(strcmp($info['description'], $art['Description']) != 0) return true;
    echo "description <br>";
    if($art['Year'] != intval($info['year'])) return true;
    echo "year <br>";
    if($art['EraID'] != intval($info['era'])) return true;
    echo "era <br>";
    if($art['GenreID'] != intval($info['genre'])) return true;
    echo "genre <br>";
    if($art['Width'] != floatval($info['width'])) return true;
    echo "width <br>";
    if($art['Height'] != floatval($info['height'])) return true;
    echo "height <br>";
    if($art['Price'] != floatval($info['price'])) return true;
    echo "price <br>";
    // 3、比较图片
    $file1 = "../static/img/works/large/".$art['ImageFileName'].".jpg";
    $file2 = $_FILES["picFile"]["tmp_name"];
    $gg = sha1_file($file1);
    $aa = sha1_file($file2);
    if($aa != $gg) return true;
    echo "img<br>";
    return false;
}