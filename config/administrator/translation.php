<?php

/**
 * @Author: Eden
 * @Date:   2019-06-12 17:59:50
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-06-14 17:14:17
 */
use App\Models\AnimalTranslation;

return [

	'title' => '详细资料',

	'single' => '详细资料',

	'model' => AnimalTranslation::class,

	'columns' => [

		'id' => [
			'title' => 'ID',
			'sortable' => true,
		],

		'lang' => [
			'title' => '语言',
			'sortable' => false,
		],

		'title' => [
			'title' => '名称',
			'sortable' => false,
		],

		'family' => [
			'title' => '科',
			'sortable' => false,
		],

		'habitat' => [
			'title' => '栖息地',
			'sortable' => false,
		],

		'location' => [
			'title' => '地点',
			'sortable' => false,
		],

		'diet' => [
			'title' => '饮食',
			'sortable' => false,
		],

		'weight' => [
			'title' => '重量',
			'sortable' => false,
		],

		'speed' => [
			'title' => '速度',
			'sortable' => false,
		],

		'animal_height' => [
			'title' => '高度',
			'sortable' => false,
		],

		// 'genus' => [
		// 	'title' => '属',
		// 	'sortable' => false,
		// ],

		// 'title_classification' => [
		// 	'title' => '类别标题',
		// 	'sortable' => false,
		// ],

		// 'classification' => [
		// 	'title' => '类别',
		// 	'sortable' => false,
		// ],

		// 'title_lifespan' => [
		// 	'title' => '寿命标题',
		// 	'sortable' => false,
		// ],

		// 'lifespan' => [
		// 	'title' => '寿命',
		// 	'sortable' => false,
		// ],

		// 'title_diet' => [
		// 	'title' => '饮食标题',
		// 	'sortable' => false,
		// ],

		// 'title_fun_tips' => [
		// 	'title' => '趣味标题',
		// 	'sortable' => false,
		// ],

		// 'fun_tips' => [
		// 	'title' => '趣味知识',
		// 	'sortable' => false,
		// ],

		// 'endangered_level' => [
		// 	'title' => '濒危级别',
		// 	'sortable' => false,
		// ],

		// 'theme_name' => [
		// 	'title' => '主题',
		// 	'sortable' => false,
		// ],

		'operation' => [
			'title' => '管理',
			'sortable' => false,
		],
	],

	'edit_fields' => [

		'lang' => [
			'title' => '语言',
			'sortable' => false,
		],

		'title' => [
			'title' => '名称',
			'sortable' => false,
		],

		'family' => [
			'title' => '科',
			'sortable' => false,
		],

		'habitat' => [
			'title' => '栖息地',
			'sortable' => false,
		],

		'location' => [
			'title' => '地点',
			'sortable' => false,
		],

		'diet' => [
			'title' => '饮食',
			'sortable' => false,
		],

		'weight' => [
			'title' => '重量',
			'sortable' => false,
		],

		'speed' => [
			'title' => '速度',
			'sortable' => false,
		],

		'animal_height' => [
			'title' => '高度',
			'sortable' => false,
		],

		// 'genus' => [
		// 	'title' => '属',
		// 	'sortable' => false,
		// ],

		// 'title_classification' => [
		// 	'title' => '类别标题',
		// 	'sortable' => false,
		// ],

		// 'classification' => [
		// 	'title' => '类别',
		// 	'sortable' => false,
		// ],

		// 'title_lifespan' => [
		// 	'title' => '寿命标题',
		// 	'sortable' => false,
		// ],

		// 'lifespan' => [
		// 	'title' => '寿命',
		// 	'sortable' => false,
		// ],

		// 'title_diet' => [
		// 	'title' => '饮食标题',
		// 	'sortable' => false,
		// ],

		// 'title_fun_tips' => [
		// 	'title' => '趣味标题',
		// 	'sortable' => false,
		// ],

		// 'fun_tips' => [
		// 	'title' => '趣味知识',
		// 	'sortable' => false,
		// ],

		// 'endangered_level' => [
		// 	'title' => '濒危级别',
		// 	'sortable' => false,
		// ],

		// 'theme_name' => [
		// 	'title' => '主题',
		// 	'sortable' => false,
		// ],

	],

	'filters' => [
		'lang' => [
			'title' => '语言'
		],

		'title' => [
			'title' => '名称'
		],

		'family' => [
			'title' => '科'
		],

		'habitat' => [
			'title' => '栖息地'
		],

		'location' => [
			'title' => '地点'
		],

		'diet' => [
			'title' => '饮食'
		],

		'weight' => [
			'title' => '重量'
		],

		'speed' => [
			'title' => '速度'
		],

		'animal_height' => [
			'title' => '高度'
		],

		// 'genus' => [
		// 	'title' => '属',
	
		// ],

		// 'title_classification' => [
		// 	'title' => '类别标题',
	
		// ],

		// 'classification' => [
		// 	'title' => '类别',
	
		// ],

		// 'title_lifespan' => [
		// 	'title' => '寿命标题',
	
		// ],

		// 'lifespan' => [
		// 	'title' => '寿命',
	
		// ],

		// 'title_diet' => [
		// 	'title' => '饮食标题',
	
		// ],

		// 'title_fun_tips' => [
		// 	'title' => '趣味标题',
	
		// ],

		// 'fun_tips' => [
		// 	'title' => '趣味知识',
	
		// ],

		// 'endangered_level' => [
		// 	'title' => '濒危级别',
	
		// ],

		// 'theme_name' => [
		// 	'title' => '主题',
	
		// ],
	],

	

























];