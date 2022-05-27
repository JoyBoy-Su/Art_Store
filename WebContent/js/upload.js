/**
 * 发布修改页面交互逻辑
 */
// 引入commonjs
let newScript = document.createElement("script");
newScript.setAttribute("type","text/javascript");
newScript.setAttribute("src","js/common.js");
document.head.appendChild(newScript);

window.onload = function () {
    // 获取导航栏内容
    getNav();
    // 绑定搜索
    bindSearchBtnInOtherPage();
    // 获取界面：包括头部UserName 发布/修改，艺术品时代的多选选项，艺术品风格的多选选项
    getUploadPage();
}

/**
 * 向后端请求界面
 */
function getUploadPage() {
    // 获得url参数，url参数为艺术品id
    let artID = getUrlParam('id');
    if(!artID) artID = 0;
    // 发请求获取发布/修改详情内容
    $.ajax({
        type: "GET",
        url: "./php/upload.php",
        data : {
            type: "page",
            artID,
        },
        dataType: "json",
        success : function (resp) {
            // 为upload页面插入表单信息
            $(".upload-modify").append(resp.page);
            // 绑定上传文件预览的逻辑
            bindPreviewUploadImage();
            // 绑定按钮单击事件
            bindConfirmBtn();
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 为上传图片的input输入框绑定预览的逻辑
 */
function bindPreviewUploadImage() {
    // 获得input
    let avatar = document.getElementById("art-img");
    avatar.onchange = function () {
        // 获得预览图片的标签
        let imgObj = $("#img-preview");
        // .files 拿到的是用户选中的图片的一个数组
        const file = avatar.files[0];
        // 使用fileReader对象可以读取文件信息 ---- 将图片转换为 base64
        const reader = new FileReader();
        reader.readAsDataURL(file)          // 将选中的文件转换为base64 --- 异步操作
        // 转换完成执行 this.result 就表示 转换成的结果
        reader.onload = function () {
            imgObj.attr("src", this.result);
        }
    };
}

/**
 * 为确定按钮绑定单击事件
 */
function bindConfirmBtn() {
    $("#confirm-btn").click(function () {
        let valid = validForm();
        // 如果信息合法，发请求更新艺术品
        if(valid) {
            // 获得url参数，url参数为艺术品id
            let artID = getUrlParam('id');
            // 准备信息参数
            let info = getFormInfo();
            $.ajax({
                type: "POST",
                url: "./php/upload.php",
                data : {
                    type: (artID === "") ? "add" : "update",
                    artID,
                    info,
                },
                contentType: false,
                processData: false,
                dataType: "json",
                success : function (resp) {
                    console.log(resp);
                },
                error: function (err) {
                    console.log(err);
                },
            });
        }
    });
}

/**
 * 对表单内容的校验
 * @returns {boolean}
 */
function validForm() {
    let valid = true;
    // 校验艺术品名称，作者姓名，作品简介与上传文件非空
    let title = $("#art-title").val();
    if(title === "") {
        $("#title-message").html("名称不能为空");
        valid = false;
    } else $("#title-message").html("");

    let author = $("#art-author").val();
    if(author === "") {
        $("#author-message").html("作者名不能为空");
        valid = false;
    } else $("#author-message").html("");

    let description = $("#art-description").val();
    if(description === "") {
        $("#description-message").html("简介不能为空");
        valid = false;
    } else $("#description-message").html("");

    let img = $("#art-img").prop("files");
    if(img.length === 0) {
        $("#img-message").html("图片不能为空");
        valid = false;
    } else $("#img-message").html("");

    // 校验年份是否为整数，
    let year = $("#art-year").val();
    if(isNaN(parseInt(year))) {
        $("#year-message").html("年份应为整数");
        valid = false;
    } else $("#year-message").html("");

    // 校验长宽为正数
    let width = $("#art-width").val();
    if(!validPositiveNumber(width)) {
        $("#width-message").html("长度应为正数");
        valid = false;
    } else $("#width-message").html("");

    let height = $("#art-height").val();
    if(!validPositiveNumber(height)) {
        $("#height-message").html("宽度度应为正数");
        valid = false;
    } else $("#height-message").html("");

    // 校验价格为正整数
    let price = $("#art-price").val();
    if(!validPositiveInteger(price)) {
        $("#price-message").html("价格应为正整数");
        valid = false;
    } else $("#price-message").html("");

    // 校验时代和风格选项是否选中
    // console.log($("#art-era").val());
    // console.log($("#art-genre").val())
    return valid;
}

/**
 * 得到除文件表单数据
 * @returns {{}}
 */
function getFormInfo() {
    let info = {};
    info.title = $("#art-title").val()
    info.author = $("#art-author").val();
    info.description = $("#art-description").val();
    info.year = parseInt($("#art-year").val());
    info.width = parseFloat($("#art-width").val());
    info.height = parseFloat($("#art-height").val());
    info.price = $("#art-price").val();
    info.era = $("#art-era").val();
    info.genre = $("#art-genre").val();
    // 获取上传文件数据
    let formData = new FormData();
    let files = $("#art-img").prop("files");
    formData.append("file", files[0]);
    info.file = formData;
    return info;
}