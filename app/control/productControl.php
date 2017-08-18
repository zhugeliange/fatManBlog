<?php
namespace app\control;
/**
* 
*/
class productControl extends \core\common\control
{
	public function index()
	{
		$productid = pass('id') ? : 0;
		$type = pass('type') ? : '';
		$title = pass('title') ? : '';

		if ($productid && is_numeric($productid) && in_array($type, parent::$type) && preg_match("/^[\x80-\xffA-Za-z0-9\,_\.\-\@\(\)\*]{1,50}$/", $title)) {
			$product = [];
			$productModel = new \app\model\productModel();
			$product = $productModel -> getProduct($type, $productid, true);
			$this -> assign('product', $product);
			$this -> display('product/index');
		}
	}

	public function getProduct()
	{
		if (isAjax() && (pass('action') == 'prev' || pass('action') == 'next') && in_array(pass('type'), \core\common\config::get('key', 'type')) && pass('id')) {
			$action = pass('action');
			$type = pass('type');
			$id = intval(pass('id'));
			if ($action == 'prev') {
				$sql = 'SELECT '. $type .'id FROM a_'. $type .' WHERE '. $type .'id = (SELECT '. $type .'id FROM a_'. $type .' WHERE '. $type .'id < '. $id .' AND `status` > 0 ORDER BY '. $type .'id DESC LIMIT 1)  AND `status` > 0';
			} else {
				$sql = 'SELECT '. $type .'id FROM a_'. $type .' WHERE '. $type .'id = (SELECT '. $type .'id FROM a_'. $type .' WHERE '. $type .'id > '. $id .' AND `status` > 0 ORDER BY '. $type .'id ASC LIMIT 1)  AND `status` > 0';
			}
			$productid = $this -> model -> query($sql) -> fetchAll();
			if (isset($productid[0][0])) {
				$product = [];
				$productModel = new \app\model\productModel();
				$product = $productModel -> getProduct($type, $productid[0][0], true);	
				$status = $product ? 1 : 0;
				echo json_encode(array('result' => $product, 'status' => $status), JSON_UNESCAPED_UNICODE);
				exit();	
			}
		}
		return false;
	}
}