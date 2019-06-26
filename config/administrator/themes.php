<?php

/**
 * @Author: Eden
 * @Date:   2019-06-21 15:33:44
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-06-21 15:48:17
 */
use App\Models\Theme;

return [

	'title' => '主题资料',

	'single' => '主题',

	'model' => Theme::class,

	'columns' => [

		'id' => [
			'title' => 'ID',
			'sortable' => true,
		],

		'product_name' => [
			'title' => '名称',
			'sortable' => false,
		],

		'image' => [
			'title' => '图片',
		],

		'code' => [
			'title' => '编号',
		],

		'product_type' => [
			'title' => '类型',
		],

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

		'image' => [
			'title' => '图片',
		],

		'code' => [
			'title' => '编号',
		],

		'product_type' => [
			'title' => '类型',
		],


	],

	'filters' => [
		'id' => [
			'title' => 'ID'
		],

		'product_name' => [
			'title' => '名称',
		],

	],

	

























];