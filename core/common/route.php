<?php
namespace core\common;
/**
* 框架路由
*/
class route
{
	public $control;
	public $action;
	public $config;
	
	public function __construct()
	{
		$this -> config = config::gets('route');
		$this -> control = $this -> config['CONTROL'];
		$this -> action = $this -> config['ACTION'];
		/**
		 * 1. 优化url，隐藏index.php （改服务器配置文件）
		 * 2. 获取url的参数部分 （1. 返回对应的控制器和方法 2. 将url多余的参数部分以get方式返回）
		 */
		if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/' && !strpos($_SERVER['REQUEST_URI'], 'favicon.ico')) {
			if(strpos($_SERVER['REQUEST_URI'], '?')) {
				$path = explode('?', trim($_SERVER['REQUEST_URI'], '?'));
			} else {
				$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
				if(isset($path[0])){
					$this -> control = preg_replace('/[^\w]*/', '', strval($path[0]));
				}
				if(isset($path[1])){
					$this -> action = preg_replace('/[^\w]*/', '', strval($path[1]));
				}
				unset($path);
			}

			// 1. 返回对应的控制器和方法
			if(isset($path[0])){
				$paths = explode('/', trim($path[0], '/'));
				if(isset($paths[0])){
					$this -> control = preg_replace('/[^\w]*/', '', strval($paths[0]));
				}
				if(isset($paths[1])){
					$this -> action = preg_replace('/[^\w]*/', '', strval($paths[1]));
				}
			}

			// 2. 将url多余的参数部分以get方式返回
			if(isset($path[1])){
				$paths = explode('&', trim($path[1], '&'));
				if(is_array($paths)) foreach ($paths as $key => $value) {
					if (strpos($value, '=')) {
						$values = explode('=', $value);
						if (isset($values[0]) && isset($values[1])) {
							$_GET[$values[0]] = $values[1];
						}
					}
				}
			}
		}
	}
}