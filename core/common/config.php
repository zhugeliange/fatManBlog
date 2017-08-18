<?php
namespace core\common;
/**
* 
*/
class config
{
	static public $configs = array();
	/**
	 * [加载配置文件的某个配置项]
	 * @param  [string] $file [配置文件名]
	 * @param  [string] $name [配置项名]
	 * @return [string]       [配置值]
	 */
	static public function get($file, $name)
	{
		if (!preg_match("/^[A-Za-z]+$/", $file) || !preg_match("/^[A-Za-z]+$/", $name)) {
			return false;
		}
		if ($name != 'index') {
			if (isset(self::$configs[$file][$name])) {
				return self::$configs[$file][$name];
			} else {
				$files = CORE.'/config/'.$file.'.php';
				if (is_file($files)) {
					$config = include $files;
					if (isset($config[$name])) {
						self::$configs[$file] = $config;
						return $config[$name];
					} else {
						// throw new \Exception("没有这个配置项：".$name);
					}
				} else {
					// throw new \Exception("找不到配置文件：".$file);
				}
				return false;
			}
		}
	}

	/**
	 * [加载整个配置文件]
	 * @param  [string] $file [配置文件名]
	 * @return [array]       [整个配置文件的所有配置项]
	 */
	static public function gets($file)
	{
		if (!preg_match("/^[A-Za-z]+$/", $file)) {
			return false;
		}

		$file = CORE.'/config/'.$file.'.php';
		if (is_file($file)) {
			$config = include $file;
			return $config;
		} else {
			throw new \Exception("找不到配置文件：".$file);
		}
	}
}