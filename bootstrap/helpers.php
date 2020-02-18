<?php

/**
 * @Author: eden
 * @Date:   2020-02-18 14:53:35
 * @Last Modified by:   eden
 * @Last Modified time: 2020-02-18 15:15:33
 */
function test_helper() {
	return 'OK';
}


function route_class() {
	return str_replace('.', '-', Route::currentRouteName());
}