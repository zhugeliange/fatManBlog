<?php
/**
 * mysql配置
 */
	return array(
	'database_type' => 'mysql',
    'database_name' => 'fsociety',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'port' => 3306,
    'option' => array('PDO::ATTR_CASE' => 'PDO::CASE_NATURAL')
    );