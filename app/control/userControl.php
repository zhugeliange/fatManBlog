<?php
namespace app\control;
/**
* 
*/
class userControl extends \core\common\control
{
	public function index()
	{
		$this -> display('user/index');
	}
}