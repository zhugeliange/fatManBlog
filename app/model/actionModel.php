<?php
namespace app\model;
/**
* 
*/
class actionModel extends \core\common\model 
{	
	public $user;

	function __construct()
	{
		parent::__construct();
		if ($_SESSION['user']) {
 			$this -> userid = $_SESSION['user']['userid'];
			$this -> typeRule = \core\common\config::get('key', 'type');
		} else {
			return false;
		}
	}

	public function doComment($type = 0, $content = '', $toid = 0)
	{
		$type = intval($type);
		$content = trim(strval($content));
		$toid = intval($toid);
		$result = false;

		if ($type > 0 && $type < 6 && $content && $toid > 0) {
			if ($type == 5) {
				if ($this -> get('b_comment', 'commentid', ['AND' => ['commentid' => $toid, 'status[>]' => 0, 'type[!]' => 5]])) {
					if($this -> insert('b_comment', ['content' => $content, 'type' => $type, 'toid' => $toid, 'userid' => $this -> userid]))
						$result = true;
				}
			} else {
				if ($this -> get('a_' . $this -> typeRule[$type], $this -> typeRule[$type] . 'id', ['AND' => [$this -> typeRule[$type] . 'id' => $toid, 'status[>]' => 0]])) {
					if($this -> insert('b_comment', ['content' => $content, 'type' => $type, 'toid' => $toid, 'userid' => $this -> userid]))
						$result = true;
				}
			}
		}

		if(!updateNumber(0, $type, $toid))
			$result = false;

		return $result;
	}

	public function doPk($type = 0, $action = 0, $toid = 0)
	{
		$type = intval($type);
		$action = intval($action); // 1 : praise 2 : knock
		$toid = intval($toid);
		$result = false;

		if ($action > 0 && $action < 3 && $toid > 0 && isset($this -> typeRule[$type])) {
			if ($this -> get('a_' . $this -> typeRule[$type], $this -> typeRule[$type] . 'id', ['AND' => [$this -> typeRule[$type] . 'id' => $toid, 'status[>]' => 0]])) {
				if($this -> insert('b_pk', ['action' => $action, 'type' => $type, 'toid' => $toid, 'userid' => $this -> userid]))
					$result = true;
			}
		}

		$option = $action == 1 ? 2 : 3;

		if(!updateNumber($option, $type, $toid))
			$result = false;

		return $result;
	}

	public function doFollow($toid = 0)
	{
		$toid = intval($toid);
		$result = false;

		if ($toid > 0) {
			if ($this -> get('a_user', 'userid', ['AND' => ['userid' => $toid, 'status[>]' => 0]])) {
				if($this -> insert('b_follow', ['toid' => $toid, 'fromid' => $this -> userid]))
					$result = true;
			}
		}

		if(!updateNumber(5, 4, $toid))
			$result = false;

		return $result;
	}

	public function doShare($type = 0, $action = 0, $toid = 0)
	{
		$type = intval($type);
		$action = intval($action); //  1 : qq 2 : wechat 3 : blog
		$toid = intval($toid);
		$result = false;

		if ($action > 0 && $action < 4 && $toid > 0 && isset($this -> typeRule[$type])) {
			if ($this -> get('a_' . $this -> typeRule[$type], $this -> typeRule[$type] . 'id', ['AND' => [$this -> typeRule[$type] . 'id' => $toid, 'status[>]' => 0]])) {
				if($this -> insert('b_share', ['action' => $action, 'type' => $type, 'toid' => $toid, 'userid' => $this -> userid]))
					$result = true;
			}
		}

		if(!updateNumber(4, $type, $toid))
			$result = false;

		return $result;
	}

	public function doCollect($type = 0, $toid = 0)
	{
		$type = intval($type);
		$toid = intval($toid);
		$result = false;

		if ($toid > 0 && isset($this -> typeRule[$type])) {
			if ($this -> get('a_' . $this -> typeRule[$type], $this -> typeRule[$type] . 'id', ['AND' => [$this -> typeRule[$type] . 'id' => $toid, 'status[>]' => 0]])) {
				if($this -> insert('b_share', ['type' => $type, 'toid' => $toid, 'userid' => $this -> userid]))
					$result = true;
			}
		}

		if(!updateNumber(1, $type, $toid))
			$result = false;

		return $result;
	}

	public function cancel($action = -1, $toid = 0, $type = -1, $extend = 0)
	{
		$action = intval($action);
		$type = intval($type);
		$toid = intval($toid);
		$extend = intval($extend); // 1 : qq 2 : wechat 3 : blog
		$result = false;

		// 0 : comment, 1 : collect 2 : praise 3 : knock 4 : share 5 : fan
		$actionRule = ['comment', 'collect', 'praise', 'knock', 'share', 'fan'];

		// 0 : articel 1 : picture 2 : music 3 : video 4 : user
		$typeRule = ['articel', 'picture', 'music', 'video', 'user'];

		if ($action > -1 && $action < 6 && $type < 5 && $type > -1 && $toid > 0) {
			if ($action < 5 && $type < 4 && $this -> get('a_' . $typeRule[$type], $typeRule[$type] . 'id', ['AND' => [$typeRule[$type] . 'id' => $toid, 'status[>]' => 0]])) {
				if ($action < 2) {
					$old = $this -> get('b_' . $actionRule[$action], $actionRule[$action] . 'id', ['AND' => ['type' => $type, 'userid' => $this -> userid, 'toid' => $toid, 'status[>]' => 0]]);
					if ($old) {
						if ($this -> update('b_' . $actionRule[$action], ['status' => 0], [$actionRule[$action] . 'id' => $old])) 
							$result = true;
					}
				} else if ($action < 4) {
					$pk = $action == 3 ? 1 : 2;
					$old = $this -> get('b_pk', 'pkid', ['AND' => ['type' => $type, 'userid' => $this -> userid, 'toid' => $toid, 'status[>]' => 0, 'action' => $pk]]);
					if ($old) {
						if ($this -> update('b_pk', ['status' => 0], ['pkid' => $old])) 
							$result = true;
					}
				} else if ($extend > 0 && $extend < 4) {
					$old = $this -> get('b_share', 'shareid', ['AND' => ['type' => $type, 'userid' => $this -> userid, 'toid' => $toid, 'status[>]' => 0, 'action' => $extend]]);
					if ($old) {
						if ($this -> update('b_share', ['status' => 0], ['shareid' => $old])) 
							$result = true;
					}
				}
			} else {
				if ($this -> get('a_user', 'userid', ['AND' => ['userid' => $toid, 'status[>]' => 0]])) {
					$old = $this -> get('b_follow', 'userid', ['AND' => ['toid' => $toid, 'fromid' => $this -> userid, 'status[>]' => 0]])
					if($old) {
						if ($this -> update('b_follow', ['status' => 0], ['followid' => $old]))
							$result = true;
					}
				}
			}

			if(!updateNumber($action, $type, $toid, '-'))
				$result = false;
		}

		return $result;
	}

	public function updateNumber($action = -1, $type = -1, $toid = 0, $option = '+')
	{
		// 0 : comment, 1 : collect 2 : praise 3 : knock 4 : share 5 : fan
		$actionRule = ['comment', 'collect', 'praise', 'knock', 'share', 'fan'];

		// type 0 : articel 1 : picture 2 : music 3 : video 4 : user
		$typeRule = ['articel', 'picture', 'music', 'video', 'user'];

		$action = intval($action);
		$type = intval($type);
		$toid = intval($toid);
		$option = trim(strval($option));
		$result = false;

		if ($action > -1 && $action < 6 && $type > -1 && $type < 5 && $toid > 0) {
			if ($option != '+') 
				$option = '-';

			$table = $type == 4 ? 'a_' . $typeRule[$type] : 'b_' . $typeRule[$type];

			if ($action == 5 && $type == 4) {
				if ($this -> update($table, [$actionRule[$action] . 'number[' . $option . ']' => 1], ['AND' => [$typeRule[$type] . 'id' => $toid, 'status[>]' => 0]]) && $this -> update($table, ['follownumber[' . $option . ']' => 1], ['AND' => [$typeRule[$type] . 'id' => $this -> userid, 'status[>]' => 0]]))
					$result = true;
			} else if ($action > -1 && $action < 4 && $type > -1 && $type < 4) {
				if ($this -> update($table, [$actionRule[$action] . 'number[' . $option . ']' => 1], ['AND' => [$typeRule[$type] . 'id' => $toid, 'status[>]' => 0]])) 
					$result = true;
			}
		}

		return $result;
	}
}