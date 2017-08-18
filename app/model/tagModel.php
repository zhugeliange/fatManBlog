<?php
namespace app\model;
/**
* 
*/
class tagModel extends \core\common\model 
{	
	public function insertTag($userid, $toid, $tag, $type)
	{
		$userid = intval($userid);
		$toid = intval($toid);
		$type = intval($type);
		$tag = trim(strval($tag));
		if ($tag && $userid > 0 && $toid > 0 && $type > 0) {
			$tag = explode(',', $tag);
		} else {
			return false;
		}
		if (is_array($tag) && count($tag) > 0) {
			foreach (array_unique($tag) as $key => $value) {
				if(!$this -> insert('b_tag', ['content' => trim($value), 'userid' => $userid, 'toid' => $toid, 'type' => $type])){
					return false;
					break;
				}
			}
		}
		return true;
	}

	public function getTag($toid = 0, $type = 0, $detail = 'content')
	{
		$toid = intval($toid);
		$type = intval($type);
		if ($toid > 0 && $type > 0) {
			$tag = $this -> select('b_tag', $detail, ['AND' => ['toid' => $toid, 'status[>]' => 0, 'type' => $type]]);
			if ($tag) {
				return $tag;
			}
		}
		return false;
	}
}