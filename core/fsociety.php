<?php
namespace core;
/**
 * 框架核心类
 */
class fsociety
{
	public $assign = [];
	static public $key = [];
	static public $type = [];

	/**
	 * [框架入口]
	 * @return [type] [description]
	 */
	static public function run()
	{
		// 加载路由
		$route = new \core\common\route();
		$control = $route -> control;
		$action = $route -> action;

		if (preg_match('/[^\w]/', $control) < 1 && preg_match('/[^\w]/', $action) < 1) {
			// 自动根据controller和action加载相应的字典
			self::$key = \core\common\config::get('key', $control);
			self::$type = \core\common\config::get('key', 'type');
			$file = APP.'/control/'.$control.'Control.php';
			$class = '\app\control\\'.$control.'Control';

			// 控制器和方法名不能有特殊字符
			if (is_file($file)) {
				include_once $file;
				$class = new $class();
				$class -> $action();
			} else {
				throw new \Exception("找不到控制器：".$control);
			}
		}
	}

	/**
	 * [自动加载类库]
	 * @param  [string] $class [类名]
	 * @return [type] [description]
	 */
	static public function load($class)
	{
		// 将 默认的 new \core\route(); $class = '\core\route';
		// 这种形式转换为 ROOT.'/core/route.php'这种符合框架的形式
		$class = str_replace('\\', '/', $class); // 将反斜线替换为正斜线
		$file = ROOT.'/'.$class.'.php';
		
		if (is_file($file)) {
			include_once $file; // 避免重复加载类
		} else {
			return FALSE;
		}
		
	}

	/**
	 * [分配参数]
	 * @param  [string] $name  [参数名]
	 * @param  [mixed] $value [参数值]
	 */
	public function assign($name, $value)
	{
		$this -> assign[$name] = $value;
	}

	/**
	 * [加载视图文件]
	 * @param  [string] $file [视图文件目录]
	 */
	public function display($file)
	{
		if (!preg_match("/^[A-Za-z]+\/[A-Za-z]*$/", $file)) {
			return false;
		}

		$this -> assign['css'] = '../static/css/'.$file.'.css';
		$this -> assign['js'] = '../static/js/'.$file.'.js';
		$file = explode('/', $file);

		$control = isset($file[0]) ? $file[0] : 'index';
		$action = isset($file[1]) ? $file[1] : 'index';

		$this -> assign['control'] = $control;
		$this -> assign['action'] = $action;

		$this -> assign['navbar'] = \core\common\config::get('key', 'navbar');

		// 在加载页面的同时自动分配相应的字典
		$this -> assign['key'] = \core\common\config::get('key', $control);

		// 路径导航 如果有id就显示
		$this -> assign['breadcrumb'] = pass('id') && in_array(pass('type'), self::$type) ? array('Home' => 'index', pass('type') => pass('type'), pass('title') => $control.'?type='.pass('type').'&id='.pass('id').'&title='.pass('title')) : array('Home' => 'index', $control => $control);

		$file = $control.'/'.$action.'.html';
		$files = APP.'/view/'.$file;
		if (is_file($files)) {
			$path =  ROOT.'/cache/view/'.date('Ymd').'/';
			// 判断目录是否存在，以小时为单位生成日志目录，防止单一文件过大
			if (!is_dir($path)) {
				mkdir($path);
				chmod($path, 0777);
			}
			\Twig_Autoloader::register();
			$loader = new \Twig_Loader_Filesystem(APP.'/view');
			$twig = new \Twig_Environment($loader, array(
				'debug' => DEBUG,
				'cache' => $path
			));
			$twig->addExtension(new \Twig_Extension_Debug());
			$template = $twig->load($file);
			$template -> display($this -> assign ? $this -> assign : '');
		}
	}

	public function log()
	{
		$log = \core\common\config::get('log', 'ID');
		return new $log();
	}

}