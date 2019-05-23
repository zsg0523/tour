<?php

/**
 * @Author: Eden
 * @Date:   2019-05-23 17:18:31
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-05-23 18:08:35
 */
use App\Models\BookContent;

return [

	'title' => '内容',

	'single' => '内容',

	'model' => BookContent::class,

	'columns' => [

		'id' => [
			'title' => 'ID',
		],

		'book' => [
			'title' => '电子书',

			'sortable' => false,

			'output' => function ($value, $model) {
				return $model->book->name;
			}
		],

		'image' => [
			'title' => '图片',
			// 默认情况直接输出数据，可是使用 output 选项来定制输出内容
			'output' => function($image, $model)
			{
				return empty($image) ? 'N/A' : '<img src="'.$image.'" width="40">';
			},

			// 是否允许排序
			'sortable' => false,
		],

		'file' => [
			'title' => '音频',
			// 默认情况直接输出数据，可是使用 output 选项来定制输出内容
			'output' => function($file, $model)
			{
				// return empty($file) ? 'N/A' : '<embed src="'.$file.'" height="40" width="40">';
				return empty($file) ? 'N/A' : '<a href="'.$file.'">Play song</a>';
			},

			// 是否允许排序
			'sortable' => false,
		],


		'sort' => [
			'title' => '排序',
			'sortable' => true,
		],

		'operation' => [
			'title' => '管理',
			'sortable' => false,
		],
	],

	'edit_fields' => [

		'book' => [
			'title'        => '电子书',
			'type'         => 'relationship',
			'name_field'   => 'name',
			// 自动补全
			'autocomplete' => false,
			// 自动补全搜索字段
			'search_fields' => ["CONCAT(id,'', name)"],
			// 自动补全排序
			'options_sort_field' => 'id',
		],

		'image' => [
			'title' => '图片',
			'type' => 'image',
			// 图片上传路径
			'location' => public_path() . '/uploads/images/contents/'
		],

		'file' => [
			'title' => '音频',
			'type' => 'file',
			'location' => public_path() . '/uploads/images/contents/',
			'naming' => 'random',
			'display_raw_value' => false,
		],

		'sort' => [
			'title' => '排序',
		]
	],

	'filters' => [
		'id' => [
			'title' => 'ID'
		],

		'book' => [
			'title' => '电子书',
			'type' => 'relationship',
			'name_field' => 'name',
			'autocomplete' => true,
			'search_fields' => ["CONCAT(id,'', name)"],
			'options_sort_field' => 'id'
		],
	],

	'rules' => [
		'book_id' => 'required',
	],

	'messages' => [
        'book_id.required' => '请选择电子书',
    ],

























];