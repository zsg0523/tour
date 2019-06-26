<?php

/**
 * @Author: Eden
 * @Date:   2019-06-21 15:33:56
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-06-21 15:54:06
 */
use App\Models\ThemeTranslation;

return [

	'title' => '翻译主题',

	'single' => '主题',

	'model' => ThemeTranslation::class,

	'columns' => [

		'id' => [
			'title' => 'ID',
			'sortable' => true,
		],

		'lang' => [
			'title' => '语言',
			'sortable' => false,
		],

		'title_page' => [
			'title' => '主题',
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