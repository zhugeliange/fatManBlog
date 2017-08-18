<?php 
/**
 * 字典集，格式为： array[control][具体的名字]
 */
	return array(
		'navbar' => array(
			'index' 	=> ['fa-angle-left', 'fa-user-circle'],
			'articel'	=> 'fa-file-word-o',
			'picture'	=> 'fa-file-picture-o',
			'music'		=> 'fa-file-audio-o',
			'video'		=> 'fa-file-video-o',
			'login'		=> 'fa-user-circle'
		),
		'type' => array(1 => 'articel', 2 => 'picture', 3 => 'music', 4 => 'video'),
		'upload' => array(
			'language' => array(
				'CN' => 'China',
				'FR' => 'France',
				'DE' => 'Germany',
				'JP' => 'Japan',
				'KR' => 'Korea',
				'RU' => 'Russia',
				'US' => 'United States of America',
				'GB' => 'United Kiongdom',
				'AU' => 'Australia',
				'CA' => 'Canada'
			), 
			'type' => array(
				'affectional' 	=> '爱情',
				'comedy' 		=> '喜剧',
				'actioner' 		=> '动作',
				'story' 		=> '剧情',
				'evolution'	 	=> '科幻',
				'thriller' 		=> '恐怖',
				'cartoon' 		=> '动画',
				'horror' 		=> '惊悚',
				'crime' 		=> '犯罪',
				'adventure' 	=> '冒险'
			)
		),
		'articel' => array(
			'sort'	=> array(
				'default'	=> array(
					'hot'			=>	'DESC',
					'createtime'	=>	'DESC',
					'articelid'		=>	'ASC'
				),
				'time'		=> array('createtime' => 'DESC'),
				'!time'		=> array('createtime' => 'ASC'),
				'hot'		=> array('hot' => 'DESC'),
				'!hot'		=> array('hot' => 'ASC')
			)
		),
		'picture' => array(
			'sort'	=> array(
				'default'	=> array(
					'hot'			=>	'DESC',
					'createtime'	=>	'DESC',
					'pictureid'		=>	'ASC'
				),
				'time'		=> array('createtime' => 'DESC'),
				'!time'		=> array('createtime' => 'ASC'),
				'hot'		=> array('hot' => 'DESC'),
				'!hot'		=> array('hot' => 'ASC')
			)
		),
		'music' => array(
			'sort'	=> array(
				'default'	=> array(
					'hot'			=>	'DESC',
					'createtime'	=>	'DESC',
					'musicid'		=>	'ASC'
				),
				'time'		=> array('createtime' => 'DESC'),
				'!time'		=> array('createtime' => 'ASC'),
				'hot'		=> array('hot' => 'DESC'),
				'!hot'		=> array('hot' => 'ASC')
			)
		),
		'video' => array(
			'sort'	=> array(
				'default'	=> array(
					'hot'			=>	'DESC',
					'createtime'	=>	'DESC',
					'videoid'		=>	'ASC'
				),
				'time'		=> array('createtime' => 'DESC'),
				'!time'		=> array('createtime' => 'ASC'),
				'hot'		=> array('hot' => 'DESC'),
				'!hot'		=> array('hot' => 'ASC')
			)
		)
	);