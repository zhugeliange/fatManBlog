<?php
/**
 * 入口文件
 * 1. 定义常量
 * 2. 加载函数库
 * 3. 自动加载类
 * 4. 启动框架
 */
// 1. 定义常量
define('ROOT', realpath('./'));	//	定义根目录
define('APP', ROOT.'/app'); // 定义项目文件目录
define('CORE', ROOT.'/core'); // 定义框架核心文件目录
define('CACHE', ROOT.'/cache'); // 定义框架缓存文件目录
define('LOG', ROOT.'/log'); // 定义框架日志文件目录

define('DEBUG', TRUE); // 定义是否开启调试模式

include_once ROOT.'/vendor/autoload.php';// 引入composer

// 是否开启php的错误输出
if (DEBUG) {
	ini_set('display_error', 'On');
	//加载第三方错误提示工具whoops
	$whoops = new \Whoops\Run;
	$whoops -> pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops -> register();
} else {
	ini_set('display_error', 'Off');
}

// 开启session
session_start();

// 2. 加载函数库
include_once CORE.'/extend/filter.php';
include_once CORE.'/extend/sqlProtect.php';
include_once CORE.'/common/function.php';
include_once CORE.'/fsociety.php';

// 3. 自动加载类
spl_autoload_register('\core\fsociety::load'); // 当创建的类和模型不存在时自动调用load这个函数

// 4. 启动框架
\core\fsociety::run(); // 这里用到的比较多所以写成静态方法