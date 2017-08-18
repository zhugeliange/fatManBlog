<?php
namespace app\control;
use core\common;
/**
* 
*/
class uploadControl extends \core\common\control
{
	public function index()
	{
		$this -> display('upload/index');
	}

	public function upload()
	{
		$user = $this -> isLogin();
		if (!$user) {
			$result['url'] = 'upload';
			$result['status'] = -1;
			echo json_encode($result, JSON_UNESCAPED_UNICODE);
			exit();
		}

		$type = pass('type') > 0 ? pass('type') : 0;
		$title = pass('title');
		$tag = pass('tag');
		$result['status'] = 1;

		if (!preg_match("/^[\x80-\xffA-Za-z0-9\,_\.\-\@\(\)\*]{1,50}$/", $title)) {
			// title format error
			$result['status'] = 2;
			echo json_encode($result, JSON_UNESCAPED_UNICODE);
			exit();
		} else if (!preg_match("/^([\x80-\xffA-Za-z0-9\*]{1,50},){0,4}[\x80-\xffA-Za-z0-9\*]{1,50}$/", $tag)) {
			// tag format error
			$result['status'] = 3;
			echo json_encode($result, JSON_UNESCAPED_UNICODE);
			exit();
		}

		$tagModel = new \app\model\tagModel();

		switch ($type) {
			case 1:
				// type is articel
				$content = markDown(pass('content'));
				if (!$content || mb_strlen($content, 'UTF8') > 1000000) {
					// articel content format error
					$result['status'] = 4;
					break;
				} else {
					$parameter = array('title' => $title, 'content' => $content, 'userid' => $user['userid']);
					$articelid = $this -> model -> insert('a_articel', $parameter);
					if (!$articelid) {
						// articel insert error
						$result['status'] = 5;
						break;
					} else if(!$tagModel -> insertTag($user['userid'], $articelid, $tag, $type)) {
						// articel tag insert error
						$result['status'] = 6;
						break;
					} else {
						// articel success
						$result['status'] = 1;
						break;
					}
				}
				break;

			case 2:
				// type is picture
				$introduce = markDown(pass('introduce'));
				if (!$introduce || mb_strlen($introduce, 'UTF8') > 2000) {
					// picture introduce format error
					$result['status'] = 4;
					break;
				} else {
					if (!isset($_FILES['file']['tmp_name'])) {
						// picture add error
						$result['status'] = 8;
						break;
					} else {
						$picture = qnUpload($_FILES['file']);
						if(is_array($picture) && isset($picture[0]['hash'])) foreach ($picture as $key => $value) {
							$link = formatPicture($value['key'], 'large');
							if (!$link) {
								// picture upload error
								$result['status'] = 5;
								continue;
							}
							$parameter = array('title' => $title, 'introduce' => $introduce, 'userid' => $user['userid'], 'link' => $link, 'hash' => $value['hash'], 'size' => 1);
							$pictureid = $this -> model -> insert('a_picture', $parameter);
							if (!$pictureid) {
								// picture insert error
								$result['status'] = 6;
								continue;
							} else if (!$tagModel -> insertTag($user['userid'], $pictureid, $tag, $type)) {
								// picture tag insert error
								$result['status'] = 7;
								continue;
							} else {
								// picture success
								$result['status'] = 1;
								continue;
							}
						} else {
							// picture upload error
							$result['status'] = 5;
							break;
						}
					}
				} 
				break;

			case 3:
				// type is music
				$introduce = markDown(pass('introduce'));
				$author = pass('author');
				$onlinetime = pass('onlinetime');
				$link = pass('link');
				if (!$introduce || mb_strlen($introduce, 'UTF8') > 2000) {
					// music introduce format error
					$result['status'] = 4;
					break;
				} else if (!preg_match("/^[\x80-\xffA-Za-z0-9\*\s\-]{1,50}$/", $author)) {
					// author format error
					$result['status'] = 5;
					break;
				} else if (!preg_match("/^((?:19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/", $onlinetime)) {
					// onlinetime format error
					$result['status'] = 6;
					break;
				} else if (!preg_match("/^[a-zA-z]+:\/\/[^\s]*/", $link)) {
					// link format error
					$result['status'] = 7;
					break;
				} else if (!isset($_FILES['file']['tmp_name'])) {
					// cover picture add error
					$result['status'] = 9;
					break;
				} else {
					$linkResult = $this -> checkLink($link, 'music');
					if ($linkResult['status'] == 2) {
						$result['status'] = 8;
					} else if ($linkResult['status'] == 3) {
						$result['status'] = 14;
					} else if ($linkResult['status'] == 4) {
						$result['status'] = 15;
					} else if ($linkResult['status'] == 5) {
						$result['status'] = 16;
					}
					if ($result['status'] != 1) {
						break;
					}
					$coverPicture = qnUpload($_FILES['file']);
					if(is_array($coverPicture) && isset($coverPicture[0]['hash'])) foreach ($coverPicture as $key => $value) {
						$coverlink = formatPicture($value['key'], 'middle');
						if (!$coverlink) {
							// cover picture upload error
							$result['status'] = 10;
							continue;
						}
						$parameter = array('title' => $title, 'author' => $author, 'link' => $link, 'introduce' => $introduce, 'onlinetime' => $onlinetime, 'userid' => $user['userid'], 'coverlink' => $coverlink, 'coverhash' => $value['hash'], 'coversize' => 2);
						$musicid = $this -> model -> insert('a_music', $parameter);
						if (!$musicid) {
							// music insert error
							$result['status'] = 11;
							continue;
						} else if (!$tagModel -> insertTag($user['userid'], $musicid, $tag, $type)) {
							// music tag insert error
							$result['status'] = 12;
							continue;
						} else {
							// music success
							$result['status'] = 1;
							continue;
						}
					} else {
						// cover picture upload error
						$result['status'] = 13;
						break;
					}
				}
				break;

			case 4:
				// type is video
				$introduce = markDown(pass('introduce'));
				$director = pass('director');
				$actor = pass('actor');
				$language = pass('language');
				$types = pass('types');
				$onlinetime = pass('onlinetime');
				$link = pass('link');
				if (!preg_match("/^([\x80-\xffA-Za-z0-9\*\-]{1,20}\/){0,4}[\x80-\xffA-Za-z0-9\*\-]{1,20}$/", $director)) {
					// video director format error
					$result['status'] = 4;
					break;
				} else if(!preg_match("/^([\x80-\xffA-Za-z0-9\*\-]{1,20}\/){0,9}[\x80-\xffA-Za-z0-9\*\-]{1,20}$/", $actor)) {
					// video actor format error
					$result['status'] = 5;
					break;
				} else if(!isset(parent::$key['language'][$language])) {
					// video actor format error
					$result['status'] = 6;
					break;
				} else if (!preg_match("/^((?:19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/", $onlinetime)) {
					// onlinetime format error
					$result['status'] = 7;
					break;
				} else if(!isset(parent::$key['type'][$types])) {
					// video actor format error
					$result['status'] = 8;
					break;
				}  else if (!preg_match("/^[a-zA-z]+:\/\/[^\s]*/", $link)) {
					// link format error
					$result['status'] = 9;
					break;
				} else if (!$introduce || mb_strlen($introduce, 'UTF8') > 2000) {
					// music introduce format error
					$result['status'] = 10;
					break;
				} else if (!isset($_FILES['file']['tmp_name'])) {
					// cover picture add error
					$result['status'] = 11;
					break;
				} else {
					$linkResult = $this -> checkLink($link, 'video');
					if ($linkResult['status'] == 2) {
						$result['status'] = 12;
					} else if ($linkResult['status'] == 3) {
						$result['status'] = 13;
					} else if ($linkResult['status'] == 4) {
						$result['status'] = 14;
					} else if ($linkResult['status'] == 5) {
						$result['status'] = 15;
					}
					if ($result['status'] != 1) {
						break;
					}
					// RemoveDuplicates
					$director = implode('/', array_unique(explode('/', $director)));
					$actor = implode('/', array_unique(explode('/', $actor)));

					$coverPicture = qnUpload($_FILES['file']);
					if(is_array($coverPicture) && isset($coverPicture[0]['hash'])) foreach ($coverPicture as $key => $value) {
						$coverlink = formatPicture($value['key'], 'middle');
						if (!$coverlink) {
							// cover picture upload error
							$result['status'] = 16;
							continue;
						}
						$parameter = array('title' => $title, 'link' => $link, 'introduce' => $introduce, 'onlinetime' => $onlinetime, 'director' => $director, 'actor' => $actor, 'language' => $language, 'type' => $type, 'userid' => $user['userid'], 'coverlink' => $coverlink, 'coverhash' => $value['hash'], 'coversize' => 2);
						$videoid = $this -> model -> insert('a_video', $parameter);
						if (!$videoid) {
							// video insert error
							$result['status'] = 17;
							continue;
						} else if (!$tagModel -> insertTag($user['userid'], $videoid, $tag, $type)) {
							// video tag insert error
							$result['status'] = 18;
							continue;
						} else {
							// video success
							$result['status'] = 1;
							continue;
						}
					} else {
						// cover picture upload error
						$result['status'] = 19;
						break;
					}
				}
				break;
			
			default:
				$result['status'] = -2;
				break;
		}

		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		exit();
	}

	public function checkLink($link = '', $type = '')
	{
		$status = 2;
		$links = isAjax() && !$link ? pass('link') : $link;
		$types = isAjax() && !$type ? pass('type') : $type;

		if (!$links || !$types) {
			return false;
		}

		$contentType = $types == 'music' ? array('audio/mp3', 'audio/mpeg') : array('video/avi', 'video/mpeg4', 'video/mp4', 'video/x-ms-wmv');
		$contentSize = $types == 'music' ? 50000000 : 1000000000;

		$result = [];
		$detail = curl($links, 'GET', [], 5, 0, 1, 1);

		if (!$detail) {
			// curl error
			$result['status'] = 2;
			$result['message'] = 'illegal url!';
		} else if(!isset($detail['http_code']) || $detail['http_code'] != 200) {
			// http state code error 
			$result['status'] = 3;
			$result['message'] = 'illegal url!';
		} else if (!isset($detail['content_type']) || !in_array($detail['content_type'], $contentType)) {
			// content type error 
			$result['status'] = 4;
			$result['message'] = $types == 'music' ? 'illegal music type url!' : 'illegal video type url!';
		} else if (isset($detail['size_download']) && $detail['size_download'] > $contentSize) {
			// content size too big
			$result['status'] = 5;
			$result['message'] = $types == 'music' ? 'this music file must small than 50M!' : 'this video file must small than 1G!';
		} else {
			// curl ok
			$result['status'] = 1;
			$result['message'] = 'url is ok!';
		}

		if ($link) {
			return $result;
		}

		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		exit();
	}

}