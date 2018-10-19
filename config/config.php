<?php
/**
 * Author: tegic
 * DateTime: 2018/10/19 9:25
 */

return [
	//图片存储位置
	'disks'      => [
		'MiniProgramShare' => [
			'driver'     => 'local',
			'root'       => env('root_path') . '/public/upload/share',
			'url'        => env('root_path') . '/public/upload/share',
			'visibility' => 'public',
		],
	],
	//图片宽度
	'width'      => '575px',
	//放大倍数
	'zoomfactor' => 1.5,
	//0-100,100质量最高
	'quality'    => 100,
	//是否压缩图片
	'compress'   => true,
];