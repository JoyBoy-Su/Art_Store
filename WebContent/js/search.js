/**
 * 搜索界面的交互逻辑
 */

// 引入commonjs
let newScript = document.createElement("script");
newScript.setAttribute("type","text/javascript");
newScript.setAttribute("src","js/common.js");
document.head.appendChild(newScript);

window.onload = function () {
    // 获取导航栏
    getNav();
    // 设置关键字与输入框内容
    let keyword = getUrlParam('keyword');
    keyword = keyword.replace(/%20/g, ' ');
    $("#keyword-span").html(keyword);
    $("#search-input").val(keyword);
    let attr = window.sessionStorage.getItem("attribute");
    console.log(attr);
    $("#select-attribute").val(attr);
    // 为搜索按钮绑定单击事件
    bindSearchBtnInSearchPage();
    // 发请求获取页面
    getSearchPage();
    // 为箭头绑定点击事件，修改页码并发请求获取
    $(".firstPage").click(function () {
        let totalPage = parseInt($("#totalPage").val());
        // 如果总的页码不为0，则改为1，否则不变
        if(totalPage !== 0) $("#currentPage").val(1);
        getSearchPage();
    });
    $(".lastPage").click(function () {
        let totalPage = parseInt($("#totalPage").val());
        // 如果总的页码不为0，则改为total，否则不变
        if(totalPage !== 0) $("#currentPage").val(totalPage);
        getSearchPage();
    });
    $(".beforePage").click(function () {
        let curPage = parseInt($("#currentPage").val());
        if(curPage > 1) {
            console.log("change currentPage");
            $("#currentPage").val(curPage - 1);
            getSearchPage();
        }
    })
    $(".nextPage").click(function () {
        let curPage = parseInt($("#currentPage").val());
        let totalPage = parseInt($("#totalPage").val());
        console.log(curPage);
        if(curPage < totalPage) {
            $("#currentPage").val(curPage + 1);
            getSearchPage();
        }
    })
    // 绑定页码改变时的钩子，获取新的一页界面
    $("#currentPage").change(function () {
        getSearchPage();
    });
    // 限制页码输入改变
    // $("#currentPage").keydown(function () {
    //     // Save old value.
    //     $(this).data("old",$(this).val());
    // });
    // $("#currentPage").keydown(function () {
    //     let curPageStr = $("#currentPage").val();
    //     if(curPageStr === undefined || curPageStr === "") {
    //         $("#currentPage").val(1);
    //         return;
    //     }
    //     let totalPage = parseInt($("#totalPage").val());
    //     if(parseInt(curPageStr) > totalPage) $("#currentPage").val(totalPage);
    // });
}

/**
 * 为搜索界面的btn绑定单击事件
 */
function bindSearchBtnInSearchPage() {
    $("#search-btn").click(function () {
        // 判断input的内容是否有改变（与url）参数比较
        let oldValue = getUrlParam('keyword').replace(/%20/g, ' ');
        let newValue = $("#search-input").val();
        // 如果发生改变，跳转页面到新的search
        if(oldValue !== newValue) window.location.href = "search.php?keyword=" + newValue;
        else console.log('equal');
    })
}

// 获取搜索的数据
function getSearchPage() {
    // 获取url参数
    let keyword = getUrlParam('keyword');
    let attribute = $("#select-attribute option:selected").val();
    let sortAttr = "price";
    let pageNumber = parseInt($("#currentPage").val());
    let pageSize = 10;
    // 发请求搜索艺术品
    $.ajax({
        type: "GET",
        url: "./php/search.php",
        data: {
            type: "get",
            keyword,
            attribute,
            sortAttr,
            pageNumber,
            pageSize
        },
        dataType: "json",
        success : function (resp) {
            afterGetPage(resp);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * 请求页面后的回调函数
 * @param resp
 */
function afterGetPage(resp) {
    $(".box-bd ul").html(resp.page);
    bindSearchResult();
    // 设置页码
    $("#total-span").html(resp.total);
    let totalPage = Math.ceil(resp.total / 10)
    $("#totalPage").val(totalPage);            // 这里10为每页的记录个数，暂时硬编码进去
    if(totalPage === 0) {
        $("#currentPage").val(0);
        $("#currentPage").attr('max', 0);
        $("#currentPage").attr('min', 0);
    } else {
        $("#currentPage").attr('max', totalPage);
        $("#currentPage").attr('min', 1);
    }
}

/**
 * 为搜索的结果结果绑定点击事件
 */
function bindSearchResult() {
    let searchObjs = $(".art-search");
    // console.log(rotationObjs);
    for (let i = 0; i < searchObjs.length; i++) {
        searchObjs[i].onclick = function () {
            // 从artID中读取出ArtID，id为整数，需要解析
            let artID = searchObjs[i].getAttribute("artID");
            // 携带artID参数跳转到detail界面
            window.location.href = 'detail.php?id=' + artID;
        }
    }
}