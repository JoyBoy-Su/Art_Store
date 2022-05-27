/**
 * 定义一些校验合法性的函数
 */

/**
 * 校验用户名是否符合规范
 * @param username
 */
function validUserName(username) {
    if(username === "") return false;
    let usernameReg = /^[a-zA-Z0-9_-]*$/;       // 只能出现大小写字母，数字，下划线与杠
    return usernameReg.test(username);
}

/**
 * 校验密码是否符合规范
 * @param password
 */
function validPassword(password, username) {
    let validResult = {
        pass : false,
        strength : 0
    };
    // 先判断长度校验是否通过，通过再判断特殊情况（与用户名重复，纯数字），然后再判断强度
    let min = 6, max = 32;
    if(password.length >= min && password.length <= 32) {
        // 若用户名和密码相同，则校验不通过
        if(password === username) return validResult;
        // 若全部为数字，则校验不通过
        let numReg = /^\d+$/;       // 纯数字正则
        if(numReg.test(password)) return validResult;
        /**
         * 通过合法校验，判断强度，强度标准：
         * 1、只包含数字、大小写字母与特殊字符中一种
         * 2、包含数字、大小写字母与特殊字符中的两种
         * 3、包含数字、大小写字母与特殊字符
         */
            // 弱类型密码正则
        let alphabetReg = /^[a-zA-Z]+$/;    // 纯字母正则
        let charReg = /^[!@#%^&_]+$/;       // 纯特殊字符正则
        // 强类型密码正则
        let _numReg = /\d+/;
        let _alphabetReg = /[a-zA-Z]+/;
        let _charReg = /[!@#%^&_]+/;
        validResult.pass = true;
        // 弱类型密码
        if(alphabetReg.test(password) || charReg.test(password)) validResult.strength = 1;
        // 强类型密码
        else if(_alphabetReg.test(password) && _numReg.test(password) && _charReg.test(password))
            validResult.strength = 3;
        // 中类型密码
        else validResult.strength = 2;
    }
    return validResult;
}

/**
 * 校验电话是否符合规范
 * @param phone
 */
function validPhone(phone) {
    let mobileReg = /^1(3|4|5|6|7|8|9)\d{9}$/;
    let fixedReg = /^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$/;
    return mobileReg.test(phone) || fixedReg.test(phone);
}

/**
 * 校验电子邮箱是否符合规范
 * @param email
 */
function validEmail(email) {
    let emailReg = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
    return emailReg.test(email);
}

/**
 * 校验输入是否为正整数
 * @param cont
 * @returns {boolean}
 */
function validPositiveInteger(cont) {
    let reg = /^[0-9]*[1-9][0-9]*$/;
    return reg.test(cont);
}

/**
 * 校验输入是否为正数
 * @param cont
 * @returns {boolean}
 */
function validPositiveNumber(cont) {
    // 先判断是否为数据
    let par = parseFloat(cont);
    if(isNaN(par)) return false;
    return par > 0;
}