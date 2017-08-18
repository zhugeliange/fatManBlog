<?php
namespace core\common;
/**
* 项目公共控制器类
*/
class control extends \core\fsociety
{
	public $model;
	
	function __construct()
	{
		$this -> assign['statics'] = '../static/';
		$this -> assign['static'] = '../../static/';
		$this -> model = new model();
	}

	/**
	 * [判断是否登录]
	 * @return [mixed]
	 */
	function isLogin()
	{
		if (isset($_SESSION['user'])) {
			return $_SESSION['user'];
		} 
		return FALSE;
	}

	/**
	 * [判断是否注册过]
	 * @param  [string]  $username [用户名]
	 * @return [boolean]
	 */
	function isRegister($username)
	{
		if (trim(strval($username))) {
			if ($this -> model -> get('a_user', 'userid', ['username' => $username])) {
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * [model函数]
	 * @param  [string]  $username [用户名]
	 * @return [boolean]
	 */
	function model($class)
	{
		if ($class) {
			$file = APP.'/model/'.$class.'Model.php';
			if (is_file($file)) {
				include_once $file; // 避免重复加载类
			} else {
				return FALSE;
			}
		}
		return FALSE;
	}

}