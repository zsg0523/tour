<?php

/**
 * @Author: Eden
 * @Date:   2019-06-12 17:16:58
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-06-17 17:40:18
 */
use App\Models\Animal;

return [

	'title' => '图片资料',

	'single' => '图片',

	'model' => Animal::class,

	'columns' => [

		'id' => [
			'title' => 'ID',
			'sortable' => true,
		],

		'product_name' => [
			'title' => '名称',
			'sortable' => false,
		],

		'image_family' => [
			'title' => '科',
			'sortable' => false,
		],

		'image' => [
			'title' => '图片',
		],
		
		// 'code' => [
		// 	'title' => 'code',
		// 	'sortable' => false,
		// ],

		// 'image_endangeredLevel' => [
		// 	'title' => 'image_endangeredLevel',
		// 	'sortable' => false,
		// ],

		// 'icon_diet' => [
		// 	'title' => 'icon_diet',
		// 	'sortable' => false,
		// ],

		// 'background' => [
		// 	'title' => 'background',
		// 	'sortable' => false,
		// ],

		// 'back_button' => [
		// 	'title' => 'back_button',
		// 	'sortable' => false,
		// ],

		// 'sound_animal' => [
		// 	'title' => 'sound_animal',
		// 	'sortable' => false,
		// ],

		// 'background_bar' => [
		// 	'title' => 'background_bar',
		// 	'sortable' => false,
		// ],

		// 'youtube_url' => [
		// 	'title' => 'youtube_url',
		// 	'sortable' => false,
		// ],

		'operation' => [
			'title' => '管理',
			'sortable' => false,
		],
	],

	'edit_fields' => [

		'product_name' => [
			'title' => '名称',
			'sortable' => false,
		],

		'image_family' => [
			'title' => '科',
			'sortable' => false,
		],

		'image' => [
			'title' => '原图',
			'type' => 'image',
			// 原图
			'location' => public_path() . '/uploads/animals/original/',
			'naming' => 'keep',
			'sizes' => array(
				// 中图
	 			array(250, 250, 'crop', public_path() . '/uploads/animals/resize/', 100),
	 			// 缩略图
	 			array(200, 200, 'crop', public_path() . '/uploads/animals/thumbnail/', 100),
	 		),
	 		'hint' => '会同时保存大中小三张'
		],


		// 'code' => [
		// 	'title' => 'code',
		// 	'sortable' => true,
		// ],

		// 'image_endangeredLevel' => [
		// 	'title' => 'image_endangeredLevel',
		// 	'sortable' => true,
		// ],

		// 'icon_diet' => [
		// 	'title' => 'icon_diet',
		// 	'sortable' => true,
		// ],

		// 'background' => [
		// 	'title' => 'background',
		// 	'sortable' => true,
		// ],

		// 'back_button' => [
		// 	'title' => 'back_button',
		// 	'sortable' => true,
		// ],

		// 'sound_animal' => [
		// 	'title' => 'sound_animal',
		// 	'sortable' => true,
		// ],

		// 'background_bar' => [
		// 	'title' => 'background_bar',
		// 	'sortable' => true,
		// ],

		// 'youtube_url' => [
		// 	'title' => 'youtube_url',
		// 	'sortable' => true,
		// ],

	],

	'filters' => [
		'id' => [
			'title' => 'ID'
		],

		'product_name' => [
			'title' => '名称',
		],

		'image_family' => [
			'title' => '科',
		],

	],

	

























];