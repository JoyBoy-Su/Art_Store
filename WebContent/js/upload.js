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