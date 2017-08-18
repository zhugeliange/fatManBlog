<?php
namespace core\common;
/**
* 日志类
*/
class log
{
	public $type;
	public $path;
	public $file;
	public $content;
	public $table;
	public $types;
	public $config;

	public function init($type, $array =[])
	{
		$this -> config = config::gets('log');
		$this -> type = $type ? $type : $this -> config['TYPE'];
		$this -> path = $type == 'file' ? $this -> config['PATH'] : '';
		$this -> path = $type
		if ('sql' == $this -> type) {
			$this -> sql();
		} else {
			$this -> file($file);
		}
	}

	public function file($file = 'log', $content = '')
	{
		$file = preg_replace('/[^\w]/', '', $file);
		// 判断文件名只能为字母数字和下滑线
		if ($file) {
			// 判断目录是否存在，以小时为单位生成日志目录，防止单一文件过大
			if (!is_dir($this -> path.date('YmdH'))) {
				mkdir($this -> path.date('YmdH'), '0777', TRUE);
			}
			// 写入日志文件
			file_put_contents($this -> path.date('YmdH').'/'.$file.'.txt', date('Y-m-d H:i:s').' => '.json_encode($content).PHP_EOL, FILE_APPEND);// 方法一
			// fwrite(fopen($this -> path.date('YmdH').'/'.$file.'.txt', 'a'), date('Y-m-d H:i:s').' => '.json_encode($content).PHP_EOL);// 方法二
		}
	}

	public function sql()
	{
		dump('nashenmeni');
	}
}