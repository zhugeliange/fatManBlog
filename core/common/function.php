<?php
/**
 * 自定义的框架公共函数
 */

/**
 * [格式化输出函数]
 * @param [mixed] $vars [待输出的值]
 * @param string $label [是否显示键名]
 * @param boolean $return [返回值还是直接输出]
 * @return [mixed] [返回值]
 */
function dumps($vars, $label = '', $return = false) 
{
    if (ini_get('html_errors')) {
        $content = "<pre>\n";

        if ($label != '') {
            $content .= "<strong>{$label} :</strong>\n";
        }

        $content .= htmlspecialchars(print_r($vars, true));
        $content .= "\n</pre>\n";
    } else {
        $content = $label . " :\n" . print_r($vars, true);
    }

    if ($return) { return $content; }
    echo $content;
    return NULL;
}

/**
 * [curl链接测试]
 * @param  [string] $url [测试链接]
 * @param  [string] $type [链接类型]
 * @param  [array] $parameter [POST参数]
 * @param  [int] $time [设置超时时间s]
 * @param  [boolen] $header [是否返回 header 信息]
 * @param  [boolen] $echo [设置结果输出形式]
 * @param  [boolen] $detail [是否返回链接详细信息]
 * @return [string]      [返回的内容]
 */
function curl($url, $type = 'GET', $parameter = [], $time = 5, $header = 0, $echo = 1, $detail = 0)
{
    if (!$url) {
        return false;
    }

    // 1. 初始化
    $ch = curl_init();

    // 2. 设置选项
    curl_setopt($ch, CURLOPT_URL, $url);// 设置要抓取的 url
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, $echo);// 设置结果输出形式 （0：直接输出到屏幕上 1：保存到字符串中，后续需要用 echo 这一类函数再打印出来）
    // curl_setopt($ch, CURLOPT_TIMEOUT, $time); // 设置超时时间
    curl_setopt($ch, CURLOPT_HEADER, $header);// 是否返回 header 信息 （0：否 1：是）
    if ($type == 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);// 表明用 POST 方式传递 （0：关闭 1：开启）
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);// 绑定要传递的 POST 参数
    }

    // 3. 执行并获取HTML文档内容
    $content = curl_exec($ch);

    // 4. 直接返回链接详细信息
    if ($detail) {
        $details = curl_getinfo($ch);
    }

    curl_close($ch);

    if ($detail) {
        return $details;
    }

    if ($echo !== 1) {
        exit();
    }
    return $content;
}

/**
 * [Unicode字符转换成utf8字符]
 * @param  [type] $unicode_str Unicode字符
 * @return [type]              Utf-8字符
 */
function unicodeToUtf8($unicode_str) 
{
    if ($unicode_str) {
        $unicode_str = explode('\u', $unicode_str);
        if (is_array($unicode_str) && count($unicode_str)) {
            $utf8_str = '';
            foreach ($unicode_str as $key => $value) {
                if ($value) {
                    $temp = '';
                    $code = intval(hexdec($value));
                    //这里注意转换出来的code一定得是整形，这样才会正确的按位操作
                    $ord_1 = decbin(0xe0 | ($code >> 12));
                    $ord_2 = decbin(0x80 | (($code >> 6) & 0x3f));
                    $ord_3 = decbin(0x80 | ($code & 0x3f));
                    $temp = chr(bindec($ord_1)) . chr(bindec($ord_2)) . chr(bindec($ord_3));
                    $utf8_str .= $temp;
                }
            }
            return $utf8_str;
        }
        return false;
    }
    return false;
}

/**
 * [json（Unicode）转为数组]
 * @param  [json] $json [json（Unicode）字符串]
 * @return [array]       [转换之后的数组]
 */
function jsonToArray($json)
{
    if ($json) {
        $array = array();
        $json = explode(',', preg_replace('/{|}|"/', '', strval($json)));
        if (is_array($json) && count($json)) {
            foreach ($json as $key => $value) {
                $value = explode(':', $value);
                $keys = strval($value[0]);
                $values = unicodeToUtf8(strval($value[1]));
                $array[$keys] = $values ? $values : '保密~~~';
            }
            return $array;
        }
        return false;
    }
    return false;
}

/**
 * [正则表达式验证字符串是邮箱，电话还是用户名]
 * @param  [string] $string [待验证的字符串]
 * @return [int]         [1：邮箱 2：电话 3：用户名]
 */
function checkUser($string)
{
    $string = trim(strval($string));
    if ($string) {
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if(preg_match($pattern, $string)) {
            return 'email';
        } 

        $pattern = "/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\\d{8}$/";
        if (preg_match($pattern, $string)) {
            return 'phonenumber';
        }
        
        $pattern = "/^[\x80-\xffA-Za-z0-9]{5,50}$/";
        if (preg_match($pattern, $string)) {
            return 'username';
        }
    }
    return false;
}

/**
 * [格式化上传图片的尺寸]
 * @param  string  图片名
 * @return [string] [返回图片名]
 */
function formatPicture($key, $size = '')
{
    $config = \core\common\config::gets('qiniu');
    return strlen($key) == 16 && in_array($size, $config['SIZE']) ? $config['DOMAIN'].$key.'-'.$size : false;
}

/**
 * [七牛上传]
 * @param  array  $file [文件数组]
 * @return [mixed]      [link / false]
 */
function qnUpload($file = array())
{
    if (is_array($file) && isset($file['tmp_name'])) {
        $config = \core\common\config::gets('qiniu');

        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = $config['ACCESS_KEY'];
        $secretKey = $config['SECRET_KEY'];

        // 空间名
        $bucket = $config['BUCKET_NAME'];

        // 构建鉴权对象
        $auth = new \Qiniu\Auth($accessKey, $secretKey);
        
        $return = $error = [];
        foreach ($file['tmp_name'] as $key => $value) {
            if (!empty($value) && isset($file['size'][$key]) && $file['size'][$key] > 0 && isset($file['name'][$key]) && !empty($file['name'][$key])) {
                $fileName = $file['name'][$key];
                $fileSize = $file['size'][$key];
                $filePath = $value;

                // 上传到七牛后保存的文件名
                $name = setRandomString($file['name'][$key]);

                // 生成上传Token
                $uptoken = $auth->uploadToken($bucket);

                // 构建 UploadManager 对象
                $uploadMgr = new \Qiniu\Storage\UploadManager();

                // 返回文件信息或者错误信息
                list($ret, $err) = $uploadMgr->putFile($uptoken, $name, $filePath);
                
                $return[] = $ret;
                $error[$file['name'][$key]] = $err;
            }
        }

        if ($err !== null) {
            return $error;
        } else {
            return $return;
        }
    }
    return false;
}

/**
 * [markDown解析插件]
 * @param  [mixed] $text [待处理的文本]
 * @return [mixed]       [处理后的文本]
 */
function markDown($text)
{
    if (trim($text)) {
        return \Michelf\MarkdownExtra::defaultTransform($text);
    }
    return false;
}

/**
 * [生成随机不重复的字符串]
 * @param [string]  $string [要处理的字符串]
 * @param string  $key    [key]
 * @param integer $length [长度]
 */
function setRandomString($string, $key = 'fsociety', $length = 16)
{
    if (!empty($string)) {
        // key+string+当前时间，先md5再sha1加密然后返回指定长度的随机不重复字符串
        return substr(sha1(md5($key.$string.time())), 0, $length);
    }
    return false;
}

/**
 * [传递数据，兼容get和post]
 * @param  [string] $name [参数名]
 * @return [mixed]       [处理过后的值]
 */
function pass($name = '')
{
    if(isset($_SERVER['REQUEST_METHOD']) && !strcasecmp($_SERVER['REQUEST_METHOD'], 'POST')) {
        return $name ? (isset($_POST[$name]) ? filter($_POST[$name]) : false) : filter($_POST);
    } else {
        return $name ? (isset($_GET[$name]) ? $_GET[$name] : false) : $_GET;
    }
}

/**
 * [敏感词过滤，支持数组，字符串和数字]
 * @param  [mixed] $parameter [待处理的内容]
 * @return [mixed]            [处理后的内容]
 */
function filter($parameter) 
{
    //如果是数组，遍历数组，递归调用
    if (is_array ($parameter)) {
        foreach ($parameter as $key => $value) {
            $parameter[$key] = filter($value);
        }
    } else if (is_string($parameter)) {
        //使用addslashes函数来处理
        $filter = new \SimpleDict(CORE.'/extend/keys');
        $parameter = addslashes ($filter -> replace(trim(strval($parameter)), '*'));
    } else if (is_numeric ($parameter)) {
        $parameter = intval (trim($parameter));
    }
    return $parameter;
}

/**
 * [判断请求是否为ajax]
 * @return boolean [是否为ajax]
 */
function isAjax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}