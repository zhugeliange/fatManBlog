<?php
namespace app\control;
/**
* 1. 注册时用户名不能以 QQ用户， 微信用户， 微博用户等这些开头
* 2. 也不能为纯数字，不能包含@符号
* 3. 长度为5-50个字符
* 4. 登录时可以用用户名（唯一），也可以用手机号和邮箱（如果有的话）
*/
class loginControl extends \core\common\control
{
	public function index()
	{
		$this -> display('login/index');
	}

	public function login()
	{
		$username = pass('username');
		$password = pass('password');
		$status = 0;

		$type = checkUser($username);
		if($type) {
			if (!$this -> model -> get('a_user', 'userid', ['AND' => ['status[>]' => 0, $type => $username]])) {
				$status = 2;
			} else if (!$this -> model -> get('a_user', 'userid', ['AND' => ['status[>]' => 0, $type => $username, 'password' => $password]])) {
				$status = 3;
			} else {
				$data = $this -> model -> get('a_user', '*', ['AND' => ['status[>]' => 0, $type => $username]]);
				if ($data) {
					$_SESSION['user'] = $data;
					$status = 1;
				}
			}
		}

		$result['status'] = $status;
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
	}

	public function register()
	{
		$username = pass('username');
		$password = pass('password');
		if (pass('headlink') && pass('headhash')) {
			$headlink = pass('headlink');
			$headhash = pass('headhash');
		} else {
			$head = $this -> model -> query('SELECT link,hash FROM a_head WHERE status > 0 AND headid >= ((SELECT MAX(headid) FROM a_head WHERE status > 0) - (SELECT MIN(headid) FROM a_head WHERE status > 0)) * RAND() + (SELECT MIN(headid) FROM a_head WHERE status > 0) LIMIT 1') -> fetchAll();
			$headlink = $head[0]['link'];
			$headhash = $head[0]['hash'];
		}

		$status = 0;
		$type = checkUser($username);
		if($type == 'username') {
			if ($this -> model -> get('a_user', 'userid', ['AND' => ['status[>]' => 0, $type => $username]])) {
				$status = 2;
			} else {
				$parameter = array('username' => $username, 'password' => $password, 'headlink' => $headlink, 'headhash' => $headhash, 'headsize' => 3);
				$data = $this -> model -> insert('a_user', $parameter);
				if ($data) {
					setcookie('new_user', true, time() + 3600*24*365, '/');
					$_SESSION['user'] = $data;
					$status = 1;
				}
			}
		}

		$result['status'] = $status;
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
	} 

	public function qnUpload()
	{
		$config = \core\common\config::gets('qiniu');

        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = $config['ACCESS_KEY'];
        $secretKey = $config['SECRET_KEY'];

        // 空间名
        $bucket = $config['BUCKET_NAME'];

        // 构建鉴权对象
        $auth = new \Qiniu\Auth($accessKey, $secretKey);

        // 生成上传Token
        $uptoken = $auth->uploadToken($bucket);

        echo json_encode($uptoken, JSON_UNESCAPED_UNICODE);
	}
}