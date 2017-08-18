<?php
namespace core\common;
/**
* model类，继承PDO
*/
class model extends \medoo
{
	public $model;
	
	function __construct()
	{
		$this -> model = config::gets('model');
		try{
			parent::__construct(config::gets('database'));
		} catch (\PDOException $e) {
			dump($e -> getMessage());
		}
	}
}