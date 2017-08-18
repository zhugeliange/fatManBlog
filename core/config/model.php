<?php 
/**
 * model配置 格式为： array[类名][函数名]
 */
	return array(
		'product' => array(
			'selectProductList' => array(
				'articel' => array(
					'field' 		=> ['articelid', 'title', 'content', 'createtime'],
					'limitCount' 	=> 50,
					'sort'			=> \core\common\config::get('key', 'articel')['sort']
				),
				'picture' => array(
					'field' 		=> ['pictureid', 'title', 'link'],
					'limitCount' 	=> 30,
					'sort'			=> \core\common\config::get('key', 'picture')['sort']
				),
				'music' => array(
					'field' 		=> ['musicid', 'title', 'link', 'coverlink'],
					'limitCount' 	=> 18,
					'sort'			=> \core\common\config::get('key', 'music')['sort']
				),
				'video' => array(
					'field' 		=> ['videoid', 'title', 'link', 'coverlink'],
					'limitCount' 	=> 12,
					'sort'			=> \core\common\config::get('key', 'video')['sort']
				)
			),
			'getProduct' => array(
				'normal' => array(
					'product' => array(
						'articel' => ['articelid', 'title', 'content', 'hot', 'commentnumber', 'praisenumber', 'knocknumber', 'collectnumber', 'sharenumber', 'createtime', 'userid'],
						'picture' => ['pictureid', 'title', 'introduce', 'hot', 'commentnumber', 'praisenumber', 'knocknumber', 'collectnumber', 'sharenumber', 'createtime', 'userid', 'link'],
						'music' => ['musicid', 'title', 'author', 'link', 'onlinetime', 'introduce', 'hot', 'commentnumber', 'praisenumber', 'knocknumber', 'collectnumber', 'sharenumber', 'createtime', 'userid', 'coverlink'],
						'video' => ['videoid', 'title', 'director', 'type', 'actor', 'language', 'link', 'onlinetime', 'introduce', 'hot', 'commentnumber', 'praisenumber', 'knocknumber', 'collectnumber', 'sharenumber', 'createtime', 'userid', 'coverlink']
					),
					'comment' => ['commentid', 'content', 'type', 'toid', 'createtime', 'userid']
				)
			)
		),
		'user' => array(
			'getUser' => array(
				'normal' => array(
					'product' => array(
						'articel' => ['articelid', 'title', 'content', 'hot', 'commentnumber', 'praisenumber', 'knocknumber', 'collectnumber', 'sharenumber', 'createtime', 'userid'],
						'picture' => ['pictureid', 'title', 'introduce', 'hot', 'commentnumber', 'praisenumber', 'knocknumber', 'collectnumber', 'sharenumber', 'createtime', 'userid', 'link'],
						'music' => ['musicid', 'title', 'author', 'link', 'onlinetime', 'introduce', 'hot', 'commentnumber', 'praisenumber', 'knocknumber', 'collectnumber', 'sharenumber', 'createtime', 'userid', 'coverlink'],
						'video' => ['videoid', 'title', 'director', 'type', 'actor', 'language', 'link', 'onlinetime', 'introduce', 'hot', 'commentnumber', 'praisenumber', 'knocknumber', 'collectnumber', 'sharenumber', 'createtime', 'userid', 'coverlink']
					),
					'user' => ['userid', 'username', 'sex', 'headlink', 'introduce']
				)
			)
		)
	);