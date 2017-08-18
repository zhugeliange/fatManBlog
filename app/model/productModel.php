<?php
namespace app\model;
/**
* 
*/
class productModel extends \core\common\model 
{	
	public $config;

	function __construct()
	{
		parent::__construct();
 		$this -> config = $this -> model[trim(str_replace('Model', '', str_replace(__NAMESPACE__.'\\', '', __CLASS__)))];
	}

	public function selectProductList($type = '', $sort = '', $page = 0)
	{
		$type = trim(strval($type));
		$sort = trim(strval($sort));

		if (isset($this -> config[__FUNCTION__][$type]) && isset($this -> config[__FUNCTION__][$type]['sort'][$sort]) && is_numeric($page) && $page > 0) {
			$config = $this -> config[__FUNCTION__][$type];
			$table = 'a_' . $type;
			$count = $this -> count($table, array('status' => 1));

			if ($count) {
				$pageCount = intval($config['limitCount']);
				$pageAmount = ceil($count / $pageCount);
				$pageStart = intval($pageCount * $page - $pageCount);
				$pageEnd = intval($pageCount * $page - 1);
				$field = $config['field'];
				$order = $config['sort'][$sort];

				$result = $this -> select($table, $field, ['status' => 1, 'LIMIT' => [$pageStart, $pageCount], 'ORDER' => $order]);

				if ($result) {
					return $result;
				}
			}
		}
		return false;
	}

	public function getProduct($type = '', $productid = 0, $more = false, $detail = '')
	{
		$typeRule = \core\common\config::get('key', 'type');
		$productid = intval($productid);

		if ($type && $productid > 0) {
			if (in_array($type, $typeRule)) {
				$table = 'a_'.$type;
				$where = array('AND' => array('status[>]' => 0, $type.'id' => $productid));
				$type = intval(array_search($type, $typeRule));
			} else if (isset($typeRule[$type])) {
				$table = 'a_'.$typeRule[$type];
				$where = array('AND' => array('status[>]' => 0, $typeRule[$type].'id' => $productid));
				$type = intval($type);
			} else {
				return false;
			}

			$field = $detail ? : $this -> config[__FUNCTION__]['normal']['product'][$typeRule[$type]];
			$result = $this -> get($table, $field, $where);

			if ($result) {
				$result['type'] = $typeRule[$type];
				$tagModel = new tagModel();
				$userModel = new userModel();
				$tag = $tagModel -> getTag($productid, $type);

				if ($tag) {
					$result['tag'] = $tag;
				}

				$user = $userModel -> getUser($result['userid']);

				if ($user) {
					$result['user'] = $user;
				}

				if ($more) {
					$comment = $this -> select('b_comment', $this -> config[__FUNCTION__]['normal']['comment'], ['AND' => ['status[>]' => 0, 'type' => $type, 'toid' => $productid]]);

					if ($comment) {
						$comments = [];

						foreach ($comment as $key => $value) {
							if ($value['userid'] == $result['userid']) {
								$value['self'] = true;
							}

							$commentUser = $userModel -> getUser($value['userid']);

							if ($commentUser) {
								$value['user'] = $commentUser;
							}

							$alt = $this -> select('b_comment', $this -> config[__FUNCTION__]['normal']['comment'], ['AND' => ['status[>]' => 0, 'type' => 5, 'toid' => $value['commentid']]]);

							if ($alt) {
								$alts = [];

								foreach ($alt as $k => $v) {
									if ($v['userid'] == $result['userid']) {
										$v['self'] = true;
									}

									$altUser = $userModel -> getUser($v['userid']);

									if ($altUser) {
										$v['user'] = $altUser;
									}

									array_push($alts, $v);
								}

								$value['alt'] = $alts;
							}

							array_push($comments, $value);
						}

						$result['comment'] = $comments;
					}
				}

				return $result;
			}
		}
		return false;
	}
}