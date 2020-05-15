<?php

/**
 * @Author: eden
 * @Date:   2020-02-18 14:53:35
 * @Last Modified by:   eden
 * @Last Modified time: 2020-05-15 14:20:18
 */
function test_helper() {
	return 'OK';
}


function route_class() {
	return str_replace('.', '-', Route::currentRouteName());
}


function convertUrlQuery($query)
{
  $queryParts = explode('&', $query);
  $params = array();
  foreach ($queryParts as $param) {
    $item = explode('=', $param);
    $params[$item[0]] = $item[1];
  }
  return $params;
}