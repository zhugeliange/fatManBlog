<?php
namespace app\control;
/**
* 
*/
class indexControl extends \core\common\control
{
	public function index()
	{
		// $model = new \core\common\model();
		// $sql = 'SELECT * FROM user';
		// $result = $model -> query($sql);
		// dump($result -> fetchAll());
		
		// $config = \core\common\config::get('database', 'DSN');
		// $configs = \core\common\config::get('database', 'USERNAME');
		// dump($configs);
		
		// $model = new \core\common\model();
		// $result = $model -> select('a_user', '*', array('userid' => 1));
		// dump($result);
		// dump($model);
		
		// $data = "ttt";
		// $this -> assign('css', 'css/index/index.css');
		// $this -> display('index/index');
		// $data = curl('笑话');
		// dump($data);
		// $test = str_replace('"', '', strval($data));
		// $test = preg_replace('/{|}|"/', '', strval($data));
		// echo $test;
		// $data = jsonToArray($data);
		// dump($data);
		// $test = unicodeToUtf8("\u903e\u4e1c\u5bb6\u5899\u800c\u6402\u5176\u5904\u5b50\uff0c\u5219\u5f97\u59bb\u3002\u4e0d\u6402\uff0c\u5219\u4e0d\u5f97\u59bb\u3002");
		// dump($test);
		// exit();
		// phpinfo();
		// $log = $this -> log();
		// dump($log::setBasePath(ROOT.'/log/'));
		// dump($log::getBasePath());
		// dump($log::log('debug', 'ddddddd'));
		// dump($log::log('info', 'iiiiiiii'));
		// dump($log::analyzerCount());
		// dump($log::log('warning', 'wwwwwww'));
		// phpinfo();
		// dump($this -> isRegister('arthursjy@gmail.com'));
		// if($this -> isLogin()) {
		// 	$this -> display('index/index');
		// 	exit();
		// }
		// $this -> display('index/index');
		// phpinfo();
		// $tagmodel = new \app\model\tagModel();
		// $tagmodel -> test();
		// $test = \core\common\config::gets('database');
		// dump($test);
		// $model = new \medoo(\core\common\config::gets('database'));
		// dump($model -> info());
		// $test = $this -> model -> get('a_articel', '*', ['articelid' => 57]);
		// dump($test['content']);
		// $markDown = new \core\extend\markdown('* d');
		// $tests = markDown($test['content']);
		// dump($markDown);
		// $my_html = \Michelf\MarkdownExtra::defaultTransform('* d');
		// dump(markDown($test['content']));
		// $userModel = new \app\model\userModel();
		// $user = $userModel -> getUser(6, 3);
		// dump($user);
		$this -> display('index/index');
	}
}