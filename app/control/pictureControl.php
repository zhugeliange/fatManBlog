<?php
namespace app\control;
/**
* 
*/
class pictureControl extends \core\common\control
{
	public function index()
	{
		$productList = [];
		$productModel = new \app\model\productModel();
		$sort = isAjax() && pass('sort') ? pass('sort') : 'default';
		$page = isAjax() && pass('page') ? pass('page') : 1;
		$productList = $productModel -> selectProductList('picture', $sort, $page);

		if (isAjax()) {
			$status = $productList ? 1 : 0;
			echo json_encode(array('result' => $productList, 'status' => $status), JSON_UNESCAPED_UNICODE);
			exit();
		}

		$this -> assign('product', $productList);
		$this -> display('picture/index');
	}
}