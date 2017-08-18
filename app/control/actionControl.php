<?php
namespace app\control;
/**
* 
*/
class actionControl extends \core\common\control
{
	public function action()
	{
		// type 0 : articel 1 : picture 2 : music 3 : video 4 : user
		// action 0 : comment, 1 : share, 2 : collect, 3 : praise, 4 : knock, 5 : follow

		$action = pass('action');
		$type = pass('type');
		$toid = pass('toid');
		$option = pass('option');
		$extends = pass('extends'); // content || 1 : qq 2 : wechat 3 : blog
		$status = false;

		if (isAjax() && $action > -1 && $action < 6 && $type > -1 && $type < 5 && $toid > 0 && $option > 0 && $option < 3) {
			$actionModel = new \app\model\actionModel();
			if ($option == 2) {
				$extends = intval($extends);
				$status = $actionModel -> cancel($action, $toid, $type, $extends);
			} else {
				switch ($action) {
					case 0:
						$status = $actionModel -> doComment($type, $extends, $toid);
						break;
					
					case 1:
						$extends = intval($extends);
						$status = $actionModel -> doShare($type, $extends, $toid);
						break;

					case 2:
						$status = $actionModel -> doCollect($type, $toid);
						break;

					case 3:
						$status = $actionModel -> doPk($type, 1, $toid);
						break;

					case 4:
						$status = $actionModel -> doPk($type, 2, $toid);
						break;

					case 5:
						$status = $actionModel -> doFollow($toid);
						break;
				}
			}
		}

		echo json_encode(array('status' => $status), JSON_UNESCAPED_UNICODE);
		exit();
	}
}