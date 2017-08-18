<?php 
/**
 * 日志配置
 */
	// return array('ID' => 'seaslog', 'TYPE' => 'file', 'PATH' => ROOT.'/log/'); // 第三方seaslog
	return array('ID' => 'log', 'TYPE' => 'sql', 'PATH' => 'c_log'); //自定义的log