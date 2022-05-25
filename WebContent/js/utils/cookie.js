/**
 * 存取cookie
 */

const VALIDATION = 24 * 3600 * 1000;

/**
 * 存储一个cookie
 * @param name
 * @param value
 */
function setCookie (key, value){
    //设置名称为name,值为value的Cookie
    let validDate=new Date();
    validDate.setTime(validDate.getTime() + VALIDATION);
    document.cookie = key + '=' + value + ';expires=' + validDate;
}

/**
 * 根据name读取cookie的值
 * @param name
 * @returns {string}
 */
function getCookie(key) {
    let cookies = document.cookie.split('; ');
    for(let i = 0; i < cookies.length; i++)
    {
        let cookie=cookies[i].split('=');

        if(cookie[0] == key)
        {
            return cookie[1];
        }
    }
    return '';  //如果没有就返回空值
}

/**
 * 根据name删除一个cookie
 * @param name
 */
function removeCookie(key) {
    setCookie(key, '1', -1);   //将有效时间设置为昨天，系统就自动删除了
}