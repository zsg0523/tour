<?php

/**
 * @Author: Eden
 * @Date:   2019-05-23 15:40:17
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-05-24 15:52:45
 */
use App\Models\Book;

return [

	'title' => '封面',

	'single' => '封面',

	'model' => Book::class,

	'columns' => [

		'id' => [
			'title' => 'ID',
		],

		'name' => [
			'title' => '名称',
			'sortable' => false,
		],

		'introduction' => [
			'title' => '简介',
			'sortable' => false,
		],

		'cover' => [
			'title' => '封面图',
			// 默认情况直接输出数据，可是使用 output 选项来定制输出内容
			'output' => function($cover, $model)
			{
				return empty($cover) ? 'N/A' : '<img src="'.$cover.'" width="40">';
			},

			// 是否允许排序
			'sortable' => false,
		],

		'map' => [
			'title' => '小地图',
			// 默认情况直接输出数据，可是使用 output 选项来定制输出内容
			'output' => function($map, $model)
			{
				return empty($map) ? 'N/A' : '<img src="'.$map.'" width="40">';
			},

			// 是否允许排序
			'sortable' => false,
		],

		'view' => [
			'title' => '浏览量',
			'sortable' => true,
		],

		'is_release' => [
			'title' => '是否发布',
			'select' => "IF((:table).is_release, 'Yes', 'No')",
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

		'name' => [
			'title' => '名称',
		],

		'introduction' => [
			'title' => '简介',
		],

		'cover' => [
			'title' => '封面图',
			'type' => 'image',
			// 图片上传路径
			'location' => public_path() . '/uploads/images/covers/'
		],

		'map' => [
			'title' => '小地图',
			'type' => 'image',
			// 图片上传路径
			'location' => public_path() . '/uploads/images/covers/'
		],

		'is_release' => [
			'type' => 'bool',
			'title' => '是否发布'
		],

		'sort' => [
			'title' => '排序',
		],

	],

	'filters' => [
		'id' => [
			'title' => 'ID'
		],
	],

	'rules' => [
		'name' => 'required',
		'cover' => 'required',
		'map' => 'required',
	],

	'messages' => [
        'cover.required' => '请上传封面图',
    ],

























];