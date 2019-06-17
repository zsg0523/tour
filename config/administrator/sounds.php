<?php

/**
 * @Author: Eden
 * @Date:   2019-06-14 17:51:26
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-06-14 17:54:09
 */
use App\Models\Sound;

return [

	'title' => '音频资料',

	'single' => '音频',

	'model' => Sound::class,

	'columns' => [

		'id' => [
			'title' => 'ID',
			'sortable' => true,
		],

		'lang' => [
			'title' => '语言',
			'sortable' => false,
		],

		'name' => [
			'title' => '名称',
			'sortable' => false,
		],

		'type' => [
			'title' => '类型',
			'sortable' => false,
		],

		// 'file' => [
		// 	'title' => '缩略图',
		// 	// 默认情况直接输出数据，可是使用 output 选项来定制输出内容
		// 	'output' => function($image_thumbnail, $model)
		// 	{
		// 		return empty($image_thumbnail) ? '' : '<a target="_blank" href="'.$image_thumbnail.'"><img src="'.$image_thumbnail.'" width="40"></a>';
		// 	},

		// 	// 是否允许排序
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

		'name' => [
			'title' => '名称',
			'sortable' => false,
		],

		'type' => [
			'title' => '类型',
			'sortable' => false,
		],

	],

	'filters' => [
		'id' => [
			'title' => 'ID'
		],

		'lang' => [
			'title' => '语言',
		],

		'name' => [
			'title' => '名称',
		],

		'type' => [
			'title' => '类型',
		],

	],

	

























];