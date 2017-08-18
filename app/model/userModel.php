<?php
namespace app\model;
/**
* 
*/
class userModel extends \core\common\model 
{	
	public $config;

	function __construct()
	{
		parent::__construct();
 		$this -> config = $this -> model[trim(str_replace('Model', '', str_replace(__NAMESPACE__.'\\', '', __CLASS__)))];
	}

	public function getUser($userid = 0, $more = 1, $detail = '')
	{
		$userid = intval($userid);
		if ($userid > 0) {
			$table = 'a_user';
			$field = $detail ? : ($more === 1 && isset($this -> config[__FUNCTION__]['normal']['user']) ? $this -> config[__FUNCTION__]['normal']['user'] : '*');
			$where = ['AND' => ['userid' => $userid, 'status[>]' => 0]];
			$result = $this -> get($table, $field, $where);
			$tagModel = new tagModel();
			$tag = $tagModel -> getTag($userid, 5);
			$result['tag'] = $tag ? : '';
			$type = array(1 => 'articel', 2 => 'picture', 3 => 'music', 4 => 'video');
			if ($more === 2) {
				foreach ($type as $key => $value) {
					$result[$value] = $this -> select('a_'.$value, $this -> config[__FUNCTION__]['normal']['product'][$value], $where);
				}
			} else if ($more === 3) {
				$productModel = new productModel();
				/**
				 * praise
				 */
				foreach ($type as $key => $value) {
					$praise = [];
					$praise = $this -> select('b_pk', 'toid', ['AND' => ['userid' => $userid, 'action' => 1, 'type' => $key]]);
					if ($praise) {
						$praises = [];
						foreach ($praise as $k => $v) {
							array_push($praises, $productModel -> getProduct($key, $v ,true));
						}
						$result['praise'][$value] = $praises;
					}
				}

				/**
				 * knock
				 */
				foreach ($type as $key => $value) {
					$knock = [];
					$knock = $this -> select('b_pk', 'toid', ['AND' => ['userid' => $userid, 'action' => 2, 'type' => $key]]);
					if ($knock) {
						$knocks = [];
						foreach ($knock as $k => $v) {
							array_push($knocks, $productModel -> getProduct($key, $v ,true));
						}
						$result['knock'][$value] = $knocks;
					}
				}

				/**
				 * collect
				 */
				foreach ($type as $key => $value) {
					$collect = [];
					$collect = $this -> select('b_collect', 'toid', ['AND' => ['userid' => $userid, 'type' => $key]]);
					if ($collect) {
						$collects = [];
						foreach ($collect as $k => $v) {
							array_push($collects, $productModel -> getProduct($key, $v ,true));
						}
						$result['collect'][$value] = $collects;
					}
				}

				/**
				 * share
				 */
				foreach ($type as $key => $value) {
					$share = [];
					$share = $this -> select('b_share', 'toid', ['AND' => ['userid' => $userid, 'type' => $key]]);
					if ($share) {
						$shares = [];
						foreach ($share as $k => $v) {
							array_push($shares, $productModel -> getProduct($key, $v ,true));
						}
						$result['share'][$value] = $shares;
					}
				}

				/**
				 * comment
				 */
				$type = array(1 => 'articel', 2 => 'picture', 3 => 'music', 4 => 'video', 5 => 'comment');
				foreach ($type as $key => $value) {
					$comment = [];
					if ($key < 5) {
						$comment = $this -> select('b_comment', 'toid', ['AND' => ['userid' => $userid, 'type' => $key, 'status[>]' => 0]]);
						if ($comment) {
							$comments = [];
							foreach ($comment as $k => $v) {
								array_push($comments, $productModel -> getProduct($key, $v ,true));
							}
							$result['comment'][$value] = $comments;
						}
					} else {
						$alt = $this -> query(sprintf("SELECT type, toid FROM b_comment WHERE commentid IN (SELECT DISTINCT toid FROM b_comment WHERE userid = %d AND type = %d AND status > 0)", $userid, $key)) -> fetchAll();
						if ($alt) {
							$alts = [];
							foreach ($alt as $k => $v) {
								array_push($alts, $productModel -> getProduct($v['type'], $v['toid'], true));
								$result['alt'][$v['type']] = $alts;
							}
						}
					}
				}
			}

			if ($result) {
				return $result;
			}
		}
		return false;
	}

	public function selectUser($key = '', $type = 'userid', $more = false, $detail = '')
	{
		if ($key && isset($this -> user[$type])) {
			$table = 'a_user';
			$field = $detail ? : '*';
			$where = array('AND' => array('userid' => $userid, 'status[>]' => 0));
			$result = $this -> get($table, $field, $where);
			if ($result) {
				return $result;
			}
		}
		return false;
	}

}